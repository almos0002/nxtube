<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    /**
     * Display the ads management page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $ads = Ads::firstOrCreate(['id' => 1]);
        return view('admin.ads', compact('ads'));
    }

    /**
     * Update the ads settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'ads_banner_1' => 'nullable|string',
            'ads_banner_2' => 'nullable|string',
            'ads_popup' => 'nullable|string',
            'ads_video' => 'nullable|string',
            'is_active' => 'boolean',
            'banner_1_image' => 'nullable|image|max:2048',
            'banner_2_image' => 'nullable|image|max:2048',
            'popup_image' => 'nullable|image|max:2048',
        ]);

        $ads = Ads::firstOrCreate(['id' => 1]);
        
        // Handle banner 1 image upload
        if ($request->hasFile('banner_1_image')) {
            if ($ads->ads_banner_1 && Storage::disk('public')->exists($ads->ads_banner_1)) {
                Storage::disk('public')->delete($ads->ads_banner_1);
            }
            $banner1Path = $request->file('banner_1_image')->store('ads', 'public');
            $ads->ads_banner_1 = $banner1Path;
        }

        // Handle banner 2 image upload
        if ($request->hasFile('banner_2_image')) {
            if ($ads->ads_banner_2 && Storage::disk('public')->exists($ads->ads_banner_2)) {
                Storage::disk('public')->delete($ads->ads_banner_2);
            }
            $banner2Path = $request->file('banner_2_image')->store('ads', 'public');
            $ads->ads_banner_2 = $banner2Path;
        }

        // Handle popup image upload
        if ($request->hasFile('popup_image')) {
            if ($ads->ads_popup && Storage::disk('public')->exists($ads->ads_popup)) {
                Storage::disk('public')->delete($ads->ads_popup);
            }
            $popupPath = $request->file('popup_image')->store('ads', 'public');
            $ads->ads_popup = $popupPath;
        }

        // Handle video ad code
        if ($request->has('ads_video')) {
            $ads->ads_video = $request->ads_video;
        }

        // Handle active status
        $ads->is_active = $request->has('is_active');
        
        $ads->save();

        return redirect()->route('ads')->with('success', 'Ads settings updated successfully');
    }

    /**
     * Toggle the active status of ads.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus()
    {
        $ads = Ads::firstOrCreate(['id' => 1]);
        $ads->is_active = !$ads->is_active;
        $ads->save();

        $status = $ads->is_active ? 'enabled' : 'disabled';
        return redirect()->route('ads')->with('success', "Ads have been {$status}");
    }
}
