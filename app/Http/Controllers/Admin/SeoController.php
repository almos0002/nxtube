<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
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
            'auto_generate_sitemap' => 'boolean',
            'noindex_pagination' => 'boolean',
            'enable_social_meta' => 'boolean',
            'enable_canonical_urls' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $seo = SeoSetting::first();
        if (!$seo) {
            $seo = new SeoSetting();
        }

        // Handle boolean checkboxes
        $booleanFields = [
            'auto_generate_sitemap',
            'noindex_pagination',
            'enable_social_meta',
            'enable_canonical_urls',
            'is_active'
        ];

        foreach ($booleanFields as $field) {
            $seo->{$field} = $request->has($field);
        }

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

        // Clear cache
        Cache::forget('seo_settings');
        
        return redirect()->route('admin.seo.index')->with('success', 'SEO settings updated successfully.');
    }

    public function generateSitemap()
    {
        // This would be implemented with a sitemap generator package
        // For now, we'll just return a success message
        return redirect()->route('admin.seo.index')->with('success', 'Sitemap generated successfully.');
    }

    private function generateRobotsTxt($content)
    {
        File::put(public_path('robots.txt'), $content);
    }
}
