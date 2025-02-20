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
    public function index()
    {
        // Get all actors with their video counts and stats
        $actors = Actor::withCount('videos')
            ->with('stats')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Calculate total actors
        $totalActors = Actor::count();

        // Get active actors count
        $activeActors = Actor::where('visibility', ActiveStatus::ACTIVE)->count();

        // Get last month's actor count for comparison
        $lastMonthActors = Actor::where('created_at', '<', Carbon::now()->startOfMonth())
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->count();

        // Calculate growth percentage
        $growth = $lastMonthActors > 0 
            ? (($totalActors - $lastMonthActors) / $lastMonthActors) * 100 
            : 0;

        // Get total videos featuring actors
        $totalVideos = Video::whereHas('actors')->count();

        // Get actors by type count
        $actorsByType = Actor::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->type->value => $item->count];
            });

        // Get top 3 popular actors
        $popularActors = Actor::withCount('videos')
            ->withCount(['videos as last_month_videos_count' => function($query) {
                $query->where('actor_video.created_at', '<', Carbon::now()->startOfMonth())
                      ->where('actor_video.created_at', '>=', Carbon::now()->subMonth()->startOfMonth());
            }])
            ->having('videos_count', '>', 0)
            ->orderBy('videos_count', 'desc')
            ->limit(3)
            ->get()
            ->map(function($actor) use ($totalVideos) {
                $lastMonthCount = $actor->last_month_videos_count ?: 0;
                $currentCount = $actor->videos_count;
                
                return [
                    'id' => $actor->id,
                    'name' => $actor->name,
                    'videos_count' => $currentCount,
                    'percentage_of_total' => round(($currentCount / ($totalVideos ?: 1)) * 100, 1),
                    'growth' => $lastMonthCount > 0 
                        ? round((($currentCount - $lastMonthCount) / $lastMonthCount) * 100, 1)
                        : 0
                ];
            });

        return view('admin.actor', compact(
            'actors',
            'totalActors',
            'activeActors',
            'totalVideos',
            'growth',
            'actorsByType',
            'popularActors'
        ));
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
