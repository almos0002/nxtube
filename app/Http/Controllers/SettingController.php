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
            'cache_api_responses' => 'boolean',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:2048|dimensions:min_width=16,min_height=16'
        ]);

        $settings = Setting::firstOrCreate(['id' => 1]);
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($settings->logo) {
                \Storage::disk('public')->delete($settings->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
            $settings->logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            if ($settings->favicon) {
                \Storage::disk('public')->delete($settings->favicon);
            }
            $faviconPath = $request->file('favicon')->store('favicons', 'public');
            $settings->favicon = $faviconPath;
        }

        $settings->update($request->except(['logo', 'favicon']));

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
