<?php

namespace App\Helpers;

use App\Models\Ads;
use Illuminate\Support\Facades\Cache;

class AdsHelper
{
    /**
     * Get all ads data
     *
     * @return \App\Models\Ads
     */
    public static function getAllAds()
    {
        return Cache::remember('site_ads', 60 * 60, function () {
            return Ads::firstOrCreate(['id' => 1]);
        });
    }

    /**
     * Get a specific ad by key
     *
     * @param string $key
     * @return mixed
     */
    public static function getAd($key)
    {
        $ads = self::getAllAds();
        return $ads->$key ?? null;
    }

    /**
     * Check if ads are enabled
     *
     * @return bool
     */
    public static function isEnabled()
    {
        $ads = self::getAllAds();
        return $ads->is_active;
    }

    /**
     * Clear ads cache
     *
     * @return void
     */
    public static function clearCache()
    {
        Cache::forget('site_ads');
    }
}
