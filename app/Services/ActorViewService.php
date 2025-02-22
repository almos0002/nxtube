<?php

namespace App\Services;

use App\Models\Actor;
use App\Models\ActorStats;
use App\Models\RecentActorView;
use Illuminate\Support\Facades\DB;

class ActorViewService
{
    public function recordView(Actor $actor, string $ipAddress)
    {
        try {
            DB::transaction(function () use ($actor, $ipAddress) {
                // Update or create actor stats
                ActorStats::updateOrCreate(
                    ['actor_id' => $actor->id],
                    ['views_count' => DB::raw('views_count + 1')]
                );

                // Record recent view
                RecentActorView::create([
                    'actor_id' => $actor->id,
                    'ip_address' => $ipAddress,
                    'viewed_at' => now()
                ]);
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('Failed to record actor view: ' . $e->getMessage());
            return false;
        }
    }

    public function hasRecentlyViewed(Actor $actor, string $ipAddress): bool
    {
        return RecentActorView::where('actor_id', $actor->id)
            ->where('ip_address', $ipAddress)
            ->where('viewed_at', '>=', now()->subMinutes(30))
            ->exists();
    }
}
