<?php

namespace App\Providers;

use App\Models\Ads;
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
            $ads = Ads::firstOrCreate(['id' => 1]);
            $view->with('siteAds', $ads);
        });
    }
}
