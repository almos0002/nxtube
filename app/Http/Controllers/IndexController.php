<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Video;
use App\Models\Channel;
use App\Models\Actor;
use App\Models\Tag;
use App\Services\VideoViewService;
use App\Services\ActorViewService;
use Illuminate\Http\Request;
use App\Enums\VisibilityStatus;
use App\Enums\ActiveStatus;

class IndexController extends Controller
{
    protected $settings;
    protected $categories;
    protected $videoViewService;
    protected $actorViewService;

    public function __construct(VideoViewService $videoViewService, ActorViewService $actorViewService)
    {
        $this->settings = Setting::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'NxTube',
                'site_description' => 'Your Video Platform',
                'logo' => 'logo.png',
                'favicon' => 'favicon.ico'
            ]
        );
        $this->categories = Category::where('status', ActiveStatus::ACTIVE)
            ->withCount('videos')
            ->get();
        $this->videoViewService = $videoViewService;
        $this->actorViewService = $actorViewService;
        view()->share([
            'settings' => $this->settings,
            'categories' => $this->categories
        ]);
    }

    public function home()
    {
        // Get trending videos by views from video_stats
        $trendingVideos = Video::select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->orderBy('videos.created_at', 'desc')
            ->take(8)
            ->with('videoStats')
            ->get();

        // Get recent videos with their stats
        $recentVideos = Video::select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
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

    public function dmca()
    {
        return view('index.dmca');
    }

    public function video(Video $video)
    {
        // Only allow access to public videos
        if ($video->visibility !== VisibilityStatus::PUBLIC) {
            abort(404);
        }

        // Get the current video with all its relationships
        $video = $video->load(['categories', 'actors', 'channels', 'tags', 'videoStats']);

        // Record the view if not recently viewed
        $ipAddress = request()->ip();
        if (!$this->videoViewService->hasRecentlyViewed($video, $ipAddress)) {
            $this->videoViewService->recordView($video, $ipAddress);
        }

        // Get related videos based on categories and tags
        $relatedVideos = Video::select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->whereHas('categories', function($query) use ($video) {
                $query->whereIn('categories.id', $video->categories->pluck('id'))
                      ->where('status', ActiveStatus::ACTIVE);
            })
            ->orWhereHas('tags', function($query) use ($video) {
                $query->whereIn('tags.id', $video->tags->pluck('id'));
            })
            ->where('videos.id', '!=', $video->id)
            ->with(['videoStats'])
            ->orderBy('video_stats.views_count', 'desc')
            ->take(6)
            ->get();

        // Get recommended videos (most viewed videos in last 3 days)
        $recommendedVideos = Video::select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->where('videos.id', '!=', $video->id)
            ->where('videos.created_at', '>=', now()->subDays(3))
            ->with(['videoStats'])
            ->orderBy('video_stats.views_count', 'desc')
            ->take(10)
            ->get();

        return view('index.video', compact('video', 'relatedVideos', 'recommendedVideos'));
    }

    public function channel(Channel $channel)
    {
        // Only allow access to active channels
        if ($channel->visibility !== ActiveStatus::ACTIVE) {
            abort(404);
        }

        // Get channel's videos with stats and categories
        $videos = $channel->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->with(['categories'])
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        // Get total views for the channel
        $totalViews = $channel->videos()
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->sum('video_stats.views_count');

        return view('index.channel', compact('channel', 'videos', 'totalViews'));
    }

    public function actor(Actor $actor)
    {
        // Only allow access to active actors
        if ($actor->visibility !== ActiveStatus::ACTIVE) {
            abort(404);
        }

        // Get actor's videos with stats
        $videos = $actor->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        // Record the view if not recently viewed
        $ipAddress = request()->ip();
        if (!$this->actorViewService->hasRecentlyViewed($actor, $ipAddress)) {
            $this->actorViewService->recordView($actor, $ipAddress);
        }

        return view('index.actor', compact('actor', 'videos'));
    }

    public function category(Category $category)
    {
        // Only allow access to active categories
        if ($category->status !== ActiveStatus::ACTIVE) {
            abort(404);
        }

        $videos = $category->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->with('videoStats')
            ->paginate(12);

        return view('index.category', compact('category', 'videos'));
    }

    public function tag(Tag $tag)
    {
        // Get tag's videos with stats
        $videos = $tag->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        return view('index.tag', compact('tag', 'videos'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return redirect()->route('home');
        }

        // Search in videos
        $videos = Video::select('videos.*', 'video_stats.views_count')
            ->where('visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->where(function($q) use ($query) {
                $q->where('videos.title', 'like', "%{$query}%")
                  ->orWhere('videos.description', 'like', "%{$query}%")
                  ->orWhereHas('tags', function($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%");
                  })
                  ->orWhereHas('categories', function($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%")
                        ->where('status', ActiveStatus::ACTIVE);
                  })
                  ->orWhereHas('actors', function($q) use ($query) {
                      $q->where(function($q) use ($query) {
                          $q->where('stagename', 'like', "%{$query}%")
                            ->orWhere('firstname', 'like', "%{$query}%")
                            ->orWhere('lastname', 'like', "%{$query}%");
                      })
                      ->where('visibility', ActiveStatus::ACTIVE);
                  })
                  ->orWhereHas('channels', function($q) use ($query) {
                      $q->where('channel_name', 'like', "%{$query}%")
                        ->orWhere('handle', 'like', "%{$query}%")
                        ->where('visibility', ActiveStatus::ACTIVE);
                  });
            })
            ->with(['categories', 'videoStats'])
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        return view('index.search', compact('videos', 'query'));
    }
}
