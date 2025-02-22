<?php

namespace App\Services;

use App\Models\Video;
use App\Models\VideoStats;
use App\Models\RecentVideoView;
use Illuminate\Support\Facades\DB;

class VideoViewService
{
    public function recordView(Video $video, string $ipAddress)
    {
        try {
            DB::transaction(function () use ($video, $ipAddress) {
                // Update or create video stats
                VideoStats::updateOrCreate(
                    ['video_id' => $video->id],
                    ['views_count' => DB::raw('views_count + 1')]
                );

                // Record recent view
                RecentVideoView::create([
                    'video_id' => $video->id,
                    'ip_address' => $ipAddress,
                    'viewed_at' => now()
                ]);
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to record video view: ' . $e->getMessage());
            return false;
        }
    }

    public function hasRecentlyViewed(Video $video, string $ipAddress): bool
    {
        return RecentVideoView::where('video_id', $video->id)
            ->where('ip_address', $ipAddress)
            ->where('viewed_at', '>=', now()->subMinutes(30))
            ->exists();
    }
}
