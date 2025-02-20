<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actor;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ActiveStatus;
use App\Enums\ActorType;
use App\Models\Video;
use Carbon\Carbon;

class ActorController extends Controller
{
    public function index(Request $request)
    {
        $query = Actor::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('firstname', 'like', "%{$searchTerm}%")
                  ->orWhere('lastname', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%");
        }

        $totalActors = Actor::count();
        $growth = 0; // You can calculate this based on your requirements

        $actors = $query->withCount('videos')
                       ->latest()
                       ->paginate(12);

        return view('admin.actor', compact('actors', 'totalActors', 'growth'));
    }

    public function create(){
        return view('crud.actor.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_image' => 'required|image|max:2048',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'stagename' => 'required|unique:actors|max:255',
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
            'visibility' => ['required', 'string', 'in:' . implode(',', array_column(ActiveStatus::cases(), 'value'))],
        ]);
    
        // If Stagename is Duplicate
        if (Actor::where('stagename', $validatedData['stagename'])->exists()) {
            return redirect()->back()->withErrors(['stagename' => 'This stagename is already taken.'])->withInput();
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

        $actor = Actor::create($validatedData);
        $actor->visibility = ActiveStatus::from($validatedData['visibility']);

        return redirect()->route('actors')->with('success', 'Actor created successfully');
    }

    public function edit($id)
    {
        $actor = Actor::findOrFail($id);
        return view('crud.actor.update', compact('actor'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'profile_image' => 'nullable|image|max:2048',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'stagename' => 'required|max:255|unique:actors,stagename,'.$id,
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
            'visibility' => ['required', 'string', 'in:' . implode(',', array_column(ActiveStatus::cases(), 'value'))],
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

        $actor = Actor::findOrFail($id);
        $actor->update($validatedData);
        $actor->visibility = ActiveStatus::from($validatedData['visibility']);

        return redirect()->route('actors')->with('success', 'Actor updated successfully');
    }

    public function toggleVisibility(Actor $actor)
    {
        try {
            $actor->visibility = $actor->visibility === ActiveStatus::ACTIVE 
                ? ActiveStatus::INACTIVE 
                : ActiveStatus::ACTIVE;
            $actor->save();

            return response()->json([
                'success' => true,
                'visibility' => $actor->visibility->value,
                'message' => 'Actor visibility updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update actor visibility'
            ], 500);
        }
    }
}
