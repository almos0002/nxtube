<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'robots_txt',
        'sitemap_settings',
        'google_verification',
        'bing_verification',
        'yandex_verification',
        'baidu_verification',
        'pinterest_verification',
        'custom_meta_tags',
        'structured_data',
        'auto_generate_sitemap',
        'sitemap_frequency',
        'sitemap_priority',
        'noindex_pagination',
        'enable_social_meta',
        'enable_canonical_urls',
        'is_active'
    ];

    protected $casts = [
        'auto_generate_sitemap' => 'boolean',
        'noindex_pagination' => 'boolean',
        'enable_social_meta' => 'boolean',
        'enable_canonical_urls' => 'boolean',
        'is_active' => 'boolean',
    ];
}
