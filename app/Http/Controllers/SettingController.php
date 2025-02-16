<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::firstOrCreate(['id' => 1]);
        return view('admin.setting', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'support_phone' => 'nullable|string|max:20',
            'cdn_provider' => 'required|string|in:Cloudflare,Amazon CloudFront,Akamai,Custom',
            'cdn_url' => 'nullable|url',
            'cdn_api_key' => 'nullable|string',
            'cache_enabled' => 'boolean',
            'cache_duration' => 'required_if:cache_enabled,true|integer|min:1',
            'cache_static_assets' => 'boolean',
            'cache_api_responses' => 'boolean'
        ]);

        $settings = Setting::firstOrCreate(['id' => 1]);
        $settings->update($request->all());

        // Clear cache if cache settings are modified
        if ($request->has('cache_enabled') || $request->has('cache_duration')) {
            Cache::flush();
        }

        return redirect()->route('settings')->with('success', 'Settings updated successfully');
    }

    public function clearCache()
    {
        Cache::flush();
        return redirect()->route('settings')->with('success', 'Cache cleared successfully');
    }
}
