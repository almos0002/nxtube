<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Video;
use App\Models\VideoStats;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();
        $last7Days = Carbon::now()->subDays(7);
        $last30Days = Carbon::now()->subDays(30);

        // Videos stats
        $totalVideos = Video::count();
        $lastMonthVideos = Video::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $videosGrowth = $lastMonthVideos > 0 
            ? (($totalVideos - $lastMonthVideos) / $lastMonthVideos) * 100 
            : 0;

        // Views stats
        $totalViews = VideoStats::sum('views_count') ?? 0;
        $lastMonthViews = VideoStats::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->sum('views_count') ?? 0;
        $viewsGrowth = $lastMonthViews > 0 
            ? (($totalViews - $lastMonthViews) / $lastMonthViews) * 100 
            : 0;

        // Daily views for chart
        $dailyViews = VideoStats::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(views_count) as total_views')
        )
            ->where('created_at', '>=', $last30Days)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('M d'),
                    'views' => $item->total_views
                ];
            });

        // Categories stats
        $totalCategories = Category::count();
        $lastMonthCategories = Category::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $categoriesGrowth = $lastMonthCategories > 0 
            ? (($totalCategories - $lastMonthCategories) / $lastMonthCategories) * 100 
            : 0;

        // Top categories by video count
        $topCategories = Category::withCount('videos')
            ->orderByDesc('videos_count')
            ->take(5)
            ->get();

        // Actors stats
        $totalActors = Actor::count();
        $lastMonthActors = Actor::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $actorsGrowth = $lastMonthActors > 0 
            ? (($totalActors - $lastMonthActors) / $lastMonthActors) * 100 
            : 0;

        // Top actors by video count
        $topActors = Actor::select([
                'actors.id',
                'actors.firstname',
                'actors.lastname',
                'actors.stagename',
                'actor_stats.views_count'
            ])
            ->leftJoin('actor_stats', 'actors.id', '=', 'actor_stats.actor_id')
            ->orderByDesc('actor_stats.views_count')
            ->take(5)
            ->get();

        // Channels stats
        $totalChannels = Channel::count();
        $lastMonthChannels = Channel::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $channelsGrowth = $lastMonthChannels > 0 
            ? (($totalChannels - $lastMonthChannels) / $lastMonthChannels) * 100 
            : 0;

        // Top channels by views
        $topChannels = Channel::select([
                'channels.id',
                'channels.profile_image',
                'channels.channel_name',
                'channels.handle',
                'channels.description',
                'channels.banner_image',
                'channels.youtube',
                'channels.twitter',
                'channels.instagram',
                'channels.visibility',
                'channels.created_at',
                'channels.updated_at',
                DB::raw('SUM(video_stats.views_count) as total_views')
            ])
            ->join('channel_video', 'channels.id', '=', 'channel_video.channel_id')
            ->join('videos', 'channel_video.video_id', '=', 'videos.id')
            ->join('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->groupBy([
                'channels.id',
                'channels.profile_image',
                'channels.channel_name',
                'channels.handle',
                'channels.description',
                'channels.banner_image',
                'channels.youtube',
                'channels.twitter',
                'channels.instagram',
                'channels.visibility',
                'channels.created_at',
                'channels.updated_at'
            ])
            ->orderByDesc('total_views')
            ->take(5)
            ->get();

        // Recent videos with relationships
        $recentVideos = Video::with(['channels', 'categories', 'videoStats'])
            ->latest()
            ->take(5)
            ->get();

        // Popular videos with relationships
        $popularVideos = Video::with(['channels', 'categories', 'videoStats'])
            ->join('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->select('videos.*')
            ->take(5)
            ->get();

        // Video upload trends
        $videoUploadTrends = Video::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_uploads')
        )
            ->where('created_at', '>=', $last7Days)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('M d'),
                    'uploads' => $item->total_uploads
                ];
            });

        // Video duration stats
        $averageDuration = Video::avg(DB::raw('TIME_TO_SEC(duration)'));
        $totalDuration = Video::sum(DB::raw('TIME_TO_SEC(duration)'));

        return view('admin.dashboard', compact(
            'totalVideos',
            'videosGrowth',
            'totalViews',
            'viewsGrowth',
            'dailyViews',
            'totalCategories',
            'categoriesGrowth',
            'topCategories',
            'totalActors',
            'actorsGrowth',
            'topActors',
            'totalChannels',
            'channelsGrowth',
            'topChannels',
            'recentVideos',
            'popularVideos',
            'videoUploadTrends',
            'averageDuration',
            'totalDuration'
        ));
    }
}
