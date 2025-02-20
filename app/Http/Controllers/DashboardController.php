<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Video;
use App\Models\VideoStats;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate current and last month's stats
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

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

        // Categories stats
        $totalCategories = Category::count();
        $lastMonthCategories = Category::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $categoriesGrowth = $lastMonthCategories > 0 
            ? (($totalCategories - $lastMonthCategories) / $lastMonthCategories) * 100 
            : 0;

        // Actors stats
        $totalActors = Actor::count();
        $lastMonthActors = Actor::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $actorsGrowth = $lastMonthActors > 0 
            ? (($totalActors - $lastMonthActors) / $lastMonthActors) * 100 
            : 0;

        // Channels stats
        $totalChannels = Channel::count();
        $lastMonthChannels = Channel::where('created_at', '<', $now->startOfMonth())
            ->where('created_at', '>=', $lastMonth->startOfMonth())
            ->count();
        $channelsGrowth = $lastMonthChannels > 0 
            ? (($totalChannels - $lastMonthChannels) / $lastMonthChannels) * 100 
            : 0;

        // Get recent videos with relationships
        $recentVideos = Video::with(['channels', 'categories', 'videoStats'])
            ->latest()
            ->take(5)
            ->get();

        // Get popular videos with relationships
        $popularVideos = Video::with(['channels', 'categories', 'videoStats'])
            ->join('video_stats', 'videos.id', '=', 'video_stats.video_id')
            ->orderBy('video_stats.views_count', 'desc')
            ->select('videos.*')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVideos',
            'videosGrowth',
            'totalViews',
            'viewsGrowth',
            'totalCategories',
            'categoriesGrowth',
            'totalActors',
            'actorsGrowth',
            'totalChannels',
            'channelsGrowth',
            'recentVideos',
            'popularVideos'
        ));
    }
}
