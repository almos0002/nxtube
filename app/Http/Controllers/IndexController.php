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
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    protected $settings;
    protected $categories;
    protected $videoViewService;
    protected $actorViewService;
    protected $cacheExpiration = 3600; // 1 hour
    
    /**
     * Format video duration to hide hours if they are 00
     *
     * @param string $duration Duration in HH:MM:SS format
     * @return string Formatted duration
     */
    public static function formatDuration($duration)
    {
        $parts = explode(':', $duration);
        if (count($parts) === 3 && $parts[0] === '00') {
            return $parts[1] . ':' . $parts[2];
        }
        return $duration;
    }
    
    /**
     * Get optimized thumbnail URL for different display contexts
     * 
     * @param string|null $path The thumbnail path
     * @param string $size The size of thumbnail ('small', 'medium', 'large')
     * @param string $default The default thumbnail to use if none exists
     * @return string The URL to the thumbnail
     */
    public static function thumbnailUrl($path, $size = 'medium', $default = 'thumbnails/default.jpg')
    {
        if (empty($path)) {
            return asset('storage/' . $default);
        }
        
        // Check if we have an optimized version of the thumbnail
        $pathInfo = pathinfo($path);
        $extension = isset($pathInfo['extension']) ? $pathInfo['extension'] : '';
        $basePath = isset($pathInfo['dirname']) && $pathInfo['dirname'] != '.' ? $pathInfo['dirname'] . '/' : '';
        $filename = isset($pathInfo['filename']) ? $pathInfo['filename'] : '';
        
        // Construct the optimized path based on size
        $optimizedPath = '';
        switch ($size) {
            case 'small':
                $optimizedPath = $basePath . $filename . '-small.' . $extension;
                break;
            case 'medium':
                $optimizedPath = $basePath . $filename . '-medium.' . $extension;
                break;
            case 'large':
                $optimizedPath = $basePath . $filename . '-large.' . $extension;
                break;
            default:
                $optimizedPath = $path;
        }
        
        // Check if the optimized file exists, if not fall back to original
        if (\Storage::disk('public')->exists($optimizedPath)) {
            return asset('storage/' . $optimizedPath);
        }
        
        // Fall back to original file
        return asset('storage/' . $path);
    }

    public function __construct(VideoViewService $videoViewService, ActorViewService $actorViewService)
    {
        // Get settings from cache or database
        if (Cache::has('site_settings')) {
            $this->settings = Cache::get('site_settings');
        } else {
            $this->settings = Setting::firstOrCreate(
                ['id' => 1],
                [
                    'site_name' => 'NxTube',
                    'site_description' => 'Your Video Platform',
                    'logo' => 'logo.png',
                    'favicon' => 'favicon.ico'
                ]
            );
            Cache::put('site_settings', $this->settings, $this->cacheExpiration);
        }
        
        // Get active categories from cache or database
        if (Cache::has('active_categories')) {
            $this->categories = Cache::get('active_categories');
        } else {
            $this->categories = Category::where('status', ActiveStatus::ACTIVE)
                ->withCount('videos')
                ->get();
            Cache::put('active_categories', $this->categories, $this->cacheExpiration);
        }
        
        $this->videoViewService = $videoViewService;
        $this->actorViewService = $actorViewService;
        
        view()->share([
            'settings' => $this->settings,
            'categories' => $this->categories
        ]);
    }

    /**
     * Get public videos with their view stats
     *
     * @param int $limit Number of videos to retrieve
     * @param string $orderBy Field to order by
     * @param string $direction Sort direction
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getPublicVideosWithStats($limit = 8, $orderBy = 'video_stats.views_count', $direction = 'desc')
    {
        return Video::select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy($orderBy, $direction)
            ->take($limit)
            ->with('videoStats')
            ->get();
    }

    public function home()
    {
        $cacheKey = 'home_page_data';
        
        // Clear the cache to ensure fresh content
        Cache::forget($cacheKey);
        
        // If not cached, generate the data
        // Get trending videos by views from video_stats - increased to 10
        $trendingVideos = $this->getPublicVideosWithStats(10, 'video_stats.views_count', 'desc');
        
        // Get recent videos with their stats
        $recentVideos = $this->getPublicVideosWithStats(8, 'videos.created_at', 'desc');
            
        // Get popular actors based on video views and engagement - increased to 20
        $popularActors = Actor::where('actors.visibility', ActiveStatus::ACTIVE)
            ->select('actors.*')
            ->selectRaw('(SELECT COUNT(*) FROM actor_video av 
                JOIN videos v ON av.video_id = v.id AND v.visibility = ?
                WHERE av.actor_id = actors.id) as videos_count', [VisibilityStatus::PUBLIC])
            ->selectRaw('(SELECT COALESCE(SUM(vs.views_count), 0) 
                FROM actor_video av 
                JOIN videos v ON av.video_id = v.id AND v.visibility = ?
                LEFT JOIN video_stats vs ON v.id = vs.video_id
                WHERE av.actor_id = actors.id
                GROUP BY av.actor_id) as total_views', [VisibilityStatus::PUBLIC])
            ->with(['videos' => function($query) {
                $query->where('videos.visibility', VisibilityStatus::PUBLIC)
                      ->select('videos.id', 'videos.title')
                      ->take(1);
            }])
            ->orderBy('total_views', 'desc')
            ->orderBy('videos_count', 'desc')
            ->take(20)
            ->get();
            
        // Get popular channels based on video count and recent activity
        $popularChannels = Channel::where('channels.visibility', ActiveStatus::ACTIVE)
            ->select('channels.*')
            ->selectRaw('(SELECT COUNT(*) FROM channel_video cv 
                JOIN videos v ON cv.video_id = v.id AND v.visibility = ?
                WHERE cv.channel_id = channels.id) as videos_count', [VisibilityStatus::PUBLIC])
            ->selectRaw('(SELECT COALESCE(SUM(vs.views_count), 0) 
                FROM channel_video cv 
                JOIN videos v ON cv.video_id = v.id AND v.visibility = ?
                LEFT JOIN video_stats vs ON v.id = vs.video_id
                WHERE cv.channel_id = channels.id
                GROUP BY cv.channel_id) as total_views', [VisibilityStatus::PUBLIC])
            ->with(['videos' => function($query) {
                $query->where('videos.visibility', VisibilityStatus::PUBLIC)
                      ->select('videos.id', 'videos.title')
                      ->take(1);
            }])
            ->orderBy('total_views', 'desc')
            ->orderBy('videos_count', 'desc')
            ->orderBy('channels.updated_at', 'desc')
            ->take(4)
            ->get();
            
        // Get popular categories with their most viewed videos
        $popularCategories = Category::where('categories.status', ActiveStatus::ACTIVE)
            ->withCount(['videos' => function($query) {
                $query->where('videos.visibility', VisibilityStatus::PUBLIC);
            }])
            ->having('videos_count', '>', 0)
            ->orderBy('videos_count', 'desc')
            ->take(3)
            ->get();
            
        // For each popular category, get its top 10 videos (increased from 4)
        foreach ($popularCategories as $category) {
            $category->topVideos = Video::select('videos.*', 'video_stats.views_count')
                ->where('videos.visibility', VisibilityStatus::PUBLIC)
                ->leftJoin('category_video', 'videos.id', '=', 'category_video.video_id')
                ->where('category_video.category_id', $category->id)
                ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
                ->orderBy('video_stats.views_count', 'desc')
                ->take(10)
                ->with('videoStats')
                ->get();
        }

        $data = compact(
            'trendingVideos', 
            'recentVideos', 
            'popularActors', 
            'popularChannels', 
            'popularCategories'
        );
        
        // Store in cache for 10 minutes
        Cache::put($cacheKey, $data, 600);

        return view('index.home', $data);
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
            return response()
                ->view('errors.404', [
                    'message' => 'This Video is Currently Not Available'
                ], 404);
        }

        // Get the current video with all its relationships
        $video = $video->load(['categories', 'actors', 'channels', 'tags', 'videoStats']);

        // Record the view if not recently viewed
        $ipAddress = request()->ip();
        if (!$this->videoViewService->hasRecentlyViewed($video, $ipAddress)) {
            $this->videoViewService->recordView($video, $ipAddress);
        }

        // Cache key based on video ID
        $cacheKey = "video_page_{$video->id}";
        
        // Clear the cache to ensure fresh content
        Cache::forget($cacheKey);
        
        // Get related videos based on categories and tags
        $relatedVideos = Video::select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
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
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->where('videos.id', '!=', $video->id)
            ->where('videos.created_at', '>=', now()->subDays(3))
            ->with(['videoStats'])
            ->orderBy('video_stats.views_count', 'desc')
            ->take(10)
            ->get();
            
        // Store in cache for future requests (optional)
        Cache::put($cacheKey, [$relatedVideos, $recommendedVideos], 1800);

        return view('index.video', compact('video', 'relatedVideos', 'recommendedVideos'));
    }

    public function channel(Channel $channel)
    {
        // Only allow access to active channels
        if ($channel->visibility !== ActiveStatus::ACTIVE) {
            return response()
                ->view('errors.404', [
                    'message' => 'This Channel is Currently Not Available'
                ], 404);
        }

        // Get channel's videos with stats and categories
        $videos = $channel->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->with(['categories'])
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        // Get total views for the channel - clear cache to ensure fresh data
        $cacheKey = "channel_views_{$channel->id}";
        
        // Clear the cache to ensure fresh content
        Cache::forget($cacheKey);
        
        // Get fresh data
        $totalViews = $channel->videos()
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->sum('video_stats.views_count');
        
        // Store in cache for future requests (optional)
        Cache::put($cacheKey, $totalViews, $this->cacheExpiration);

        return view('index.channel', compact('channel', 'videos', 'totalViews'));
    }

    public function actor(Actor $actor)
    {
        // Only allow access to active actors
        if ($actor->visibility !== ActiveStatus::ACTIVE) {
            return response()
                ->view('errors.404', [
                    'message' => 'This Actor is Currently Not Available'
                ], 404);
        }

        // Get actor's videos with stats
        $videos = $actor->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
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
            return response()
                ->view('errors.404', [
                    'message' => 'This Category is Currently Not Available'
                ], 404);
        }

        $videos = $category->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
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
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        return view('index.tag', compact('tag', 'videos'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return redirect()->route('home');
        }

        $videos = Video::select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->where(function($q) use ($query) {
                $q->where('videos.title', 'like', "%{$query}%")
                  ->orWhere('videos.description', 'like', "%{$query}%");
            })
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        return view('index.search', compact('videos', 'query'));
    }

    public function allCategories()
    {
        $page = request()->page ?? 1;
        $cacheKey = "all_categories_page_{$page}";
        
        if (Cache::has($cacheKey)) {
            $categories = Cache::get($cacheKey);
        } else {
            $categories = Category::where('categories.status', ActiveStatus::ACTIVE)
                ->withCount(['videos' => function($query) {
                    $query->where('videos.visibility', VisibilityStatus::PUBLIC);
                }])
                ->orderBy('name')
                ->paginate(24);
            
            Cache::put($cacheKey, $categories, 1800);
        }
            
        return view('index.categories', compact('categories'));
    }

    public function allActors()
    {
        $page = request()->page ?? 1;
        $cacheKey = "all_actors_page_{$page}";
        
        if (Cache::has($cacheKey)) {
            $actors = Cache::get($cacheKey);
        } else {
            $actors = Actor::where('visibility', ActiveStatus::ACTIVE)
                ->withCount(['videos' => function($query) {
                    $query->where('videos.visibility', VisibilityStatus::PUBLIC);
                }])
                ->orderBy('stagename')
                ->paginate(24);
            
            Cache::put($cacheKey, $actors, 1800);
        }
            
        return view('index.actors', compact('actors'));
    }

    public function allChannels()
    {
        $page = request()->page ?? 1;
        $cacheKey = "all_channels_page_{$page}";
        
        if (Cache::has($cacheKey)) {
            $channels = Cache::get($cacheKey);
        } else {
            $channels = Channel::where('visibility', ActiveStatus::ACTIVE)
                ->withCount(['videos' => function($query) {
                    $query->where('videos.visibility', VisibilityStatus::PUBLIC);
                }])
                ->orderBy('channel_name')
                ->paginate(24);
            
            Cache::put($cacheKey, $channels, 1800);
        }
            
        return view('index.channels', compact('channels'));
    }

    public function channelByHandle($handle)
    {
        // Find the channel by handle
        $cacheKey = "channel_handle_{$handle}";
        
        if (Cache::has($cacheKey)) {
            $channel = Cache::get($cacheKey);
        } else {
            $channel = Channel::where('handle', $handle)
                ->where('visibility', ActiveStatus::ACTIVE)
                ->firstOrFail();
            
            Cache::put($cacheKey, $channel, $this->cacheExpiration);
        }

        // Only allow access to active channels
        if ($channel->visibility !== ActiveStatus::ACTIVE) {
            return response()
                ->view('errors.404', [
                    'message' => 'This Channel is Currently Not Available'
                ], 404);
        }

        // Get channel's videos with stats and categories
        $videos = $channel->videos()
            ->select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->with(['categories'])
            ->orderBy('video_stats.views_count', 'desc')
            ->paginate(12);

        // Get total views for the channel (cached for 1 hour)
        $viewsCacheKey = "channel_views_{$channel->id}";
        
        if (Cache::has($viewsCacheKey)) {
            $totalViews = Cache::get($viewsCacheKey);
        } else {
            $totalViews = $channel->videos()
                ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
                ->sum('video_stats.views_count');
            
            Cache::put($viewsCacheKey, $totalViews, $this->cacheExpiration);
        }

        return view('index.channel', compact('channel', 'videos', 'totalViews'));
    }

    public function allVideos(Request $request)
    {
        $page = request()->page ?? 1;
        $cacheKey = "all_videos_page_{$page}";
        
        // Clear the cache for this page to ensure fresh content
        Cache::forget($cacheKey);
        
        // Get all public videos with pagination
        $videos = Video::select('videos.*', 'video_stats.views_count')
            ->where('videos.visibility', VisibilityStatus::PUBLIC)
            ->leftJoin('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->with(['categories', 'channels'])
            ->orderBy('videos.created_at', 'desc')
            ->paginate(12);
        
        // Store in cache for future requests (optional)
        Cache::put($cacheKey, $videos, 1800);

        return view('index.videos', compact('videos'))->with('hideBreadcrumbs', true);
    }
}
