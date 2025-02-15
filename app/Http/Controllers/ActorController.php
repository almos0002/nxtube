<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;

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
            'biography' => 'required|longtext|max:1000',
            'banner_image' => 'nullable|image|max:2048',
            'type' => 'required|enum',
            'dob' => 'required|date',
            'language' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'specialist' => 'required|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'visibility' => 'required|enum',
        ]);

        $actor = Actor::create($validatedData);

        return redirect()->route('actors.show', $actor->id)->with('success', 'Actor created successfully');
    }
}
