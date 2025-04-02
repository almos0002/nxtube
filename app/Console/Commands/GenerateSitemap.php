<?php

namespace App\Console\Commands;

use App\Models\SeoSetting;
use Illuminate\Console\Command;
use App\Http\Controllers\SeoController;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting sitemap generation...');
        
        $seo = SeoSetting::first();
        
        // Only generate sitemap if auto-generate is enabled or if forced
        if (!$seo || $seo->auto_generate_sitemap) {
            $controller = app()->make(SeoController::class);
            $controller->generateSitemap();
            
            $this->info('Sitemap generated successfully!');
            return Command::SUCCESS;
        }
        
        $this->info('Sitemap generation is disabled in settings. Use --force to override.');
        return Command::SUCCESS;
    }
}
