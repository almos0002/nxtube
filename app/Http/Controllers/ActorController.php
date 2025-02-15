<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use Illuminate\Validation\Rules\Enum;
use App\VisibilityStatus;
use App\ActorType;

class ActorController extends Controller
{
    public function create(){
        return view('crud.actor.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_image' => 'required|image|max:2048',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'stagename' => 'required|string|max:255',
            'biography' => 'required|string|max:1000',
            'banner_image' => 'nullable|image|max:2048',
            'type' => ['required', new Enum(ActorType::class)],
            'dob' => 'required|date',
            'language' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'specialties' => 'required|string|max:255',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'website' => 'nullable|url',
            'visibility' => ['required', new Enum(VisibilityStatus::class)],
        ]);
    
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

        $actor = Actor::create($validatedData);

        return redirect()->route('actors')->with('success', 'Actor created successfully');
    }
}
