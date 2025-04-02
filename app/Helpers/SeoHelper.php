<?php

namespace App\Helpers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Cache;

class SeoHelper
{
    public static function getSeoSettings()
    {
        return Cache::remember('seo_settings', 60 * 24, function () {
            return SeoSetting::first() ?? new SeoSetting();
        });
    }

    public static function getVerificationTags()
    {
        $seo = self::getSeoSettings();
        $tags = [];

        if ($seo->google_verification) {
            $tags[] = '<meta name="google-site-verification" content="' . $seo->google_verification . '" />';
        }

        if ($seo->bing_verification) {
            $tags[] = '<meta name="msvalidate.01" content="' . $seo->bing_verification . '" />';
        }

        if ($seo->yandex_verification) {
            $tags[] = '<meta name="yandex-verification" content="' . $seo->yandex_verification . '" />';
        }

        if ($seo->baidu_verification) {
            $tags[] = '<meta name="baidu-site-verification" content="' . $seo->baidu_verification . '" />';
        }

        if ($seo->pinterest_verification) {
            $tags[] = '<meta name="p:domain_verify" content="' . $seo->pinterest_verification . '" />';
        }

        return implode("\n    ", $tags);
    }

    public static function getCustomMetaTags()
    {
        $seo = self::getSeoSettings();
        return $seo->custom_meta_tags ?? '';
    }

    public static function getStructuredData()
    {
        $seo = self::getSeoSettings();
        return $seo->structured_data ?? '';
    }

    public static function shouldIndexPage($isPaginated = false)
    {
        $seo = self::getSeoSettings();
        
        if (!$seo->is_active) {
            return false;
        }

        if ($isPaginated && $seo->noindex_pagination) {
            return false;
        }

        return true;
    }

    public static function getCanonicalUrl($url = null)
    {
        $seo = self::getSeoSettings();
        
        if (!$seo->enable_canonical_urls) {
            return null;
        }

        if ($url) {
            // Remove query parameters for canonical URL
            $parsedUrl = parse_url($url);
            $canonical = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
            
            if (isset($parsedUrl['port'])) {
                $canonical .= ':' . $parsedUrl['port'];
            }
            
            if (isset($parsedUrl['path'])) {
                $canonical .= $parsedUrl['path'];
            }
            
            return $canonical;
        }

        return url()->current();
    }
}
