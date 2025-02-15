<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use App\VisibilityStatus;
use App\Models\Channel;

class ChannelController extends Controller
{
    public function create()
    {
        return view('crud.channel.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'profile_image' => 'required|image|max:2048',
            'channel_name' => 'required|max:255',
            'handle' => 'required|unique:channels|max:50',
            'description' => 'required',
            'banner_image' => 'nullable|image|max:2048',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'visibility' => ['required', new Enum(VisibilityStatus::class)],
        ]);

        // If Handle is Duplicate
        if (Channel::where('handle', $validatedData['handle'])->exists()) {
            return redirect()->back()->withErrors(['handle' => 'This handle is already taken.'])->withInput();
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profilePath = $request->file('profile_image')->store('profiles', 'public');
            $validatedData['profile_image'] = $profilePath;
        }
    
        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('banners', 'public');
            $validatedData['banner_image'] = $bannerPath;
        }

        $channel = Channel::create($validatedData);

        return redirect()->route('channels')->with('success', 'Channel created successfully.');
    }
}
