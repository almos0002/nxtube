<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\SeoSetting;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Define the schedule for sitemap generation based on SEO settings
Schedule::command('sitemap:generate')
    ->when(function () {
        // Only schedule if auto-generate is enabled
        $seo = SeoSetting::first();
        return $seo && $seo->auto_generate_sitemap;
    })
    ->cron(function () {
        // Get the frequency from SEO settings
        $seo = SeoSetting::first();
        $frequency = $seo ? $seo->sitemap_frequency : 'daily';
        
        switch ($frequency) {
            case 'hourly':
                return '0 * * * *'; // Run at the start of every hour
            case 'daily':
                return '0 0 * * *'; // Run at midnight every day
            case 'weekly':
                return '0 0 * * 0'; // Run at midnight on Sunday
            case 'monthly':
                return '0 0 1 * *'; // Run at midnight on the first day of the month
            default:
                return '0 0 * * *'; // Default to daily
        }
    });
