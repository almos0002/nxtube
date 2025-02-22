<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Video;
use App\Models\Channel;
use App\Models\Actor;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $settings;
    protected $categories;

    public function __construct()
    {
        $this->settings = Setting::first();
        $this->categories = Category::all();
        view()->share([
            'settings' => $this->settings,
            'categories' => $this->categories
        ]);
    }

    public function home()
    {
        // Get trending videos by views from video_stats
        $trendingVideos = Video::select('videos.*', 'video_stats.views_count')
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->orderBy('videos.created_at', 'desc')
            ->take(8)
            ->with('videoStats')
            ->get();

        // Get recent videos with their stats
        $recentVideos = Video::select('videos.*', 'video_stats.views_count')
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->latest('videos.created_at')
            ->take(8)
            ->with('videoStats')
            ->get();

        return view('index.home', compact('trendingVideos', 'recentVideos'));
    }

    public function about()
    {
        return view('index.about');
    }

    public function contact()
    {
        return view('index.contact');
    }

    public function privacy()
    {
        return view('index.privacy');
    }

    public function video($id)
    {
        // Get the current video with all its relationships
        $video = Video::with(['categories', 'actors', 'channels', 'tags', 'videoStats'])
            ->findOrFail($id);

        // Get related videos based on categories and tags
        $relatedVideos = Video::select('videos.*', 'video_stats.views_count')
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->whereHas('categories', function($query) use ($video) {
                $query->whereIn('categories.id', $video->categories->pluck('id'));
            })
            ->orWhereHas('tags', function($query) use ($video) {
                $query->whereIn('tags.id', $video->tags->pluck('id'));
            })
            ->where('videos.id', '!=', $video->id)
            ->with(['videoStats'])
            ->orderBy('video_stats.views_count', 'desc')
            ->take(8)
            ->get();

        // Get recommended videos (most viewed videos)
        $recommendedVideos = Video::select('videos.*', 'video_stats.views_count')
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->where('videos.id', '!=', $video->id)
            ->with(['videoStats'])
            ->orderBy('video_stats.views_count', 'desc')
            ->take(10)
            ->get();

        return view('index.video', compact('video', 'relatedVideos', 'recommendedVideos'));
    }

    public function channel($id)
    {
        $channel = Channel::findOrFail($id);
        return view('index.channel', compact('channel'));
    }

    public function actor($id)
    {
        $actor = Actor::findOrFail($id);
        return view('index.actor', compact('actor'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $videos = $category->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->with('videoStats')
            ->paginate(12);
        return view('index.category', compact('category', 'videos'));
    }
}
