<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\SeoSetting;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Define the schedule for sitemap generation based on SEO settings
Schedule::call(function () {
    // Only run if auto-generate is enabled
    $seo = SeoSetting::first();
    
    if (!$seo || !$seo->auto_generate_sitemap) {
        return;
    }
    
    // Check if we should run based on frequency
    $frequency = $seo->sitemap_frequency ?? 'daily';
    $now = now();
    
    $shouldRun = match ($frequency) {
        'hourly' => true, // Always run on hourly schedule
        'daily' => $now->hour === 0 && $now->minute === 0, // Run at midnight
        'weekly' => $now->dayOfWeek === 0 && $now->hour === 0 && $now->minute === 0, // Run on Sunday at midnight
        'monthly' => $now->day === 1 && $now->hour === 0 && $now->minute === 0, // Run on the 1st of the month at midnight
        default => $now->hour === 0 && $now->minute === 0, // Default to daily at midnight
    };
    
    if ($shouldRun) {
        Artisan::call('sitemap:generate');
    }
})
->hourly() // Run every hour but internal logic will determine if action is needed
->description('Generate sitemap based on configured frequency');
