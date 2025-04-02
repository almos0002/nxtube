<?php

namespace App\Providers;

use App\Helpers\AdsHelper;
use App\Helpers\SeoHelper;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share ads data with all views
        View::composer('*', function ($view) {
            $ads = AdsHelper::getAllAds();
            $view->with('siteAds', $ads);
        });

        // Share SEO settings with all views
        View::composer('*', function ($view) {
            $seoSettings = SeoHelper::getSeoSettings();
            $view->with('seoSettings', $seoSettings);
        });
    }
}
