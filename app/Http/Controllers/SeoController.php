<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use App\Models\Video;
use App\Models\Category;
use App\Models\Actor;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SeoController extends Controller
{
    public function index()
    {
        $seo = SeoSetting::first() ?? new SeoSetting();
        return view('admin.seo', compact('seo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'google_verification' => 'nullable|string|max:255',
            'bing_verification' => 'nullable|string|max:255',
            'yandex_verification' => 'nullable|string|max:255',
            'baidu_verification' => 'nullable|string|max:255',
            'pinterest_verification' => 'nullable|string|max:255',
            'robots_txt' => 'nullable|string',
            'sitemap_frequency' => 'required|string|in:always,hourly,daily,weekly,monthly,yearly,never',
            'sitemap_priority' => 'required|numeric|min:0|max:1',
        ]);

        $seo = SeoSetting::first();
        if (!$seo) {
            $seo = new SeoSetting();
        }

        // Handle boolean fields
        $seo->is_active = $request->has('is_active') ? true : false;
        $seo->auto_generate_sitemap = $request->has('auto_generate_sitemap') ? true : false;
        $seo->noindex_pagination = $request->has('noindex_pagination') ? true : false;
        $seo->enable_social_meta = $request->has('enable_social_meta') ? true : false;
        $seo->enable_canonical_urls = $request->has('enable_canonical_urls') ? true : false;

        // Handle text fields
        $textFields = [
            'google_verification',
            'bing_verification',
            'yandex_verification',
            'baidu_verification',
            'pinterest_verification',
            'robots_txt',
            'sitemap_frequency',
            'sitemap_priority',
            'custom_meta_tags',
            'structured_data',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                $seo->{$field} = $request->input($field);
            }
        }

        $seo->save();

        // Generate robots.txt file
        if ($request->filled('robots_txt')) {
            $this->generateRobotsTxt($request->input('robots_txt'));
        }

        // Generate sitemap if auto-generate is enabled
        if ($seo->auto_generate_sitemap) {
            $this->generateSitemap();
        }

        // Clear cache
        Cache::forget('seo_settings');
        
        return redirect()->route('admin.seo.index')->with('success', 'SEO settings updated successfully.');
    }

    public function generateSitemap()
    {
        try {
            $seo = SeoSetting::first() ?? new SeoSetting();
            
            // Start building the sitemap XML
            $content = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            
            // Add home page
            $content .= '
  <url>
    <loc>' . url('/') . '</loc>
    <lastmod>' . now()->toAtomString() . '</lastmod>
    <changefreq>' . $seo->sitemap_frequency . '</changefreq>
    <priority>' . $seo->sitemap_priority . '</priority>
  </url>';
            
            // Add main pages
            $mainPages = [
                '/categories' => 'Categories',
                '/actors' => 'Actors',
                '/channels' => 'Channels',
                '/videos' => 'Videos',
            ];
            
            foreach ($mainPages as $path => $name) {
                $content .= '
  <url>
    <loc>' . url($path) . '</loc>
    <lastmod>' . now()->toAtomString() . '</lastmod>
    <changefreq>' . $seo->sitemap_frequency . '</changefreq>
    <priority>0.8</priority>
  </url>';
            }
            
            // Add videos
            $videos = \App\Models\Video::where('visibility', 'public')
                ->orWhere('visibility', 'published')
                ->latest()
                ->take(500)
                ->get();
                
            foreach ($videos as $video) {
                $content .= '
  <url>
    <loc>' . route('video', $video->slug) . '</loc>
    <lastmod>' . $video->updated_at->toAtomString() . '</lastmod>
    <changefreq>' . $seo->sitemap_frequency . '</changefreq>
    <priority>' . $seo->sitemap_priority . '</priority>
  </url>';
            }
            
            // Add categories
            $categories = \App\Models\Category::all();
            foreach ($categories as $category) {
                $content .= '
  <url>
    <loc>' . route('category', $category->slug) . '</loc>
    <lastmod>' . $category->updated_at->toAtomString() . '</lastmod>
    <changefreq>' . $seo->sitemap_frequency . '</changefreq>
    <priority>0.7</priority>
  </url>';
            }
            
            // Add actors
            $actors = \App\Models\Actor::all();
            foreach ($actors as $actor) {
                $content .= '
  <url>
    <loc>' . route('actor', $actor->slug) . '</loc>
    <lastmod>' . $actor->updated_at->toAtomString() . '</lastmod>
    <changefreq>' . $seo->sitemap_frequency . '</changefreq>
    <priority>0.7</priority>
  </url>';
            }
            
            // Add channels
            $channels = \App\Models\Channel::all();
            foreach ($channels as $channel) {
                $content .= '
  <url>
    <loc>' . route('channel', $channel->handle) . '</loc>
    <lastmod>' . $channel->updated_at->toAtomString() . '</lastmod>
    <changefreq>' . $seo->sitemap_frequency . '</changefreq>
    <priority>0.7</priority>
  </url>';
            }
            
            // Close the sitemap
            $content .= '
</urlset>';
            
            // Save sitemap to public directory with proper permissions
            file_put_contents(public_path('sitemap.xml'), $content);
            
            // Ensure the file has proper permissions
            chmod(public_path('sitemap.xml'), 0644);
            
            Cache::forget('sitemap_last_generated');
            Cache::put('sitemap_last_generated', now(), 60 * 24 * 7);
            
            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Sitemap generated successfully.']);
            }
            
            return redirect()->route('admin.seo.index')->with('success', 'Sitemap generated successfully.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Error generating sitemap: ' . $e->getMessage()], 500);
            }
            
            return redirect()->route('admin.seo.index')->with('error', 'Error generating sitemap: ' . $e->getMessage());
        }
    }

    private function generateRobotsTxt($content)
    {
        File::put(public_path('robots.txt'), $content);
    }
}
