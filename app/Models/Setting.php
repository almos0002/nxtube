<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'contact_email',
        'support_phone',
        'cdn_provider',
        'cdn_url',
        'cdn_api_key',
        'cache_enabled',
        'cache_duration',
        'cache_static_assets',
        'cache_api_responses',
        'logo',
        'favicon'
    ];

    protected $casts = [
        'cache_enabled' => 'boolean',
        'cache_static_assets' => 'boolean',
        'cache_api_responses' => 'boolean',
        'cache_duration' => 'integer'
    ];

    /**
     * Get a setting value by key
     *
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        $setting = self::first();
        return $setting ? $setting->$key : null;
    }

    /**
     * Set a setting value
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public static function set($key, $value)
    {
        $setting = self::firstOrCreate(['id' => 1]);
        $setting->$key = $value;
        return $setting->save();
    }
}
