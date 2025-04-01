<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Helpers\AdsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        // Log the request data for debugging
        Log::info('Ads update request data:', $request->all());
        
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
            Log::info('Banner 1 image uploaded:', ['path' => $banner1Path]);
        } elseif ($request->has('ads_banner_1')) {
            // Only update if it's not an image path
            if (!$request->ads_banner_1 || !Storage::disk('public')->exists($request->ads_banner_1)) {
                $ads->ads_banner_1 = $request->ads_banner_1;
                Log::info('Banner 1 text/code updated:', ['content' => $request->ads_banner_1]);
            }
        }

        // Handle banner 2 image upload
        if ($request->hasFile('banner_2_image')) {
            if ($ads->ads_banner_2 && Storage::disk('public')->exists($ads->ads_banner_2)) {
                Storage::disk('public')->delete($ads->ads_banner_2);
            }
            $banner2Path = $request->file('banner_2_image')->store('ads', 'public');
            $ads->ads_banner_2 = $banner2Path;
            Log::info('Banner 2 image uploaded:', ['path' => $banner2Path]);
        } elseif ($request->has('ads_banner_2')) {
            // Only update if it's not an image path
            if (!$request->ads_banner_2 || !Storage::disk('public')->exists($request->ads_banner_2)) {
                $ads->ads_banner_2 = $request->ads_banner_2;
                Log::info('Banner 2 text/code updated:', ['content' => $request->ads_banner_2]);
            }
        }

        // Handle popup image upload
        if ($request->hasFile('popup_image')) {
            if ($ads->ads_popup && Storage::disk('public')->exists($ads->ads_popup)) {
                Storage::disk('public')->delete($ads->ads_popup);
            }
            $popupPath = $request->file('popup_image')->store('ads', 'public');
            $ads->ads_popup = $popupPath;
            Log::info('Popup image uploaded:', ['path' => $popupPath]);
        } elseif ($request->has('ads_popup')) {
            // Only update if it's not an image path
            if (!$request->ads_popup || !Storage::disk('public')->exists($request->ads_popup)) {
                $ads->ads_popup = $request->ads_popup;
                Log::info('Popup text/code updated:', ['content' => $request->ads_popup]);
            }
        }

        // Handle video ad code
        if ($request->has('ads_video')) {
            $ads->ads_video = $request->ads_video;
            Log::info('Video ad code updated:', ['content' => $request->ads_video]);
        }

        // Handle active status - checkboxes are only included in the request when checked
        $ads->is_active = $request->has('is_active');
        Log::info('Ads active status:', ['is_active' => $ads->is_active, 'request_has' => $request->has('is_active')]);
        
        $result = $ads->save();
        Log::info('Ads save result:', ['success' => $result, 'ads_id' => $ads->id]);
        
        // Clear the ads cache
        AdsHelper::clearCache();

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
        
        // Clear the ads cache
        AdsHelper::clearCache();

        $status = $ads->is_active ? 'enabled' : 'disabled';
        return redirect()->route('ads')->with('success', "Ads have been {$status}");
    }
}
