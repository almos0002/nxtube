<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\SeoSetting;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Get SEO settings
        $seo = SeoSetting::first();
        
        // Schedule sitemap generation based on frequency setting
        if ($seo && $seo->auto_generate_sitemap) {
            $frequency = $seo->sitemap_frequency ?? 'daily';
            
            switch ($frequency) {
                case 'hourly':
                    $schedule->command('sitemap:generate')->hourly();
                    break;
                case 'daily':
                    $schedule->command('sitemap:generate')->daily();
                    break;
                case 'weekly':
                    $schedule->command('sitemap:generate')->weekly();
                    break;
                case 'monthly':
                    $schedule->command('sitemap:generate')->monthly();
                    break;
                default:
                    $schedule->command('sitemap:generate')->daily();
                    break;
            }
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
