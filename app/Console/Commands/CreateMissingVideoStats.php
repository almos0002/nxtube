<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Video;
use App\Models\VideoStats;

class CreateMissingVideoStats extends Command
{
    protected $signature = 'video:create-missing-stats';
    protected $description = 'Create missing video stats entries for videos';

    public function handle()
    {
        $videos = Video::whereNotExists(function ($query) {
            $query->select('id')
                  ->from('video_stats')
                  ->whereRaw('video_stats.video_id = videos.id');
        })->get();

        $count = 0;
        foreach ($videos as $video) {
            VideoStats::create([
                'video_id' => $video->id,
                'views_count' => 0
            ]);
            $count++;
        }

        $this->info("Created {$count} missing video stats entries.");
    }
}
