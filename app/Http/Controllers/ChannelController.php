<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ActiveStatus;
use App\Models\Channel;
use App\Models\Video;
use Carbon\Carbon;

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
            'visibility' => ['required', new Enum(ActiveStatus::class)],
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

    public function index(Request $request)
    {
        $query = Channel::query();

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('channel_name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
        }

        // Get all stats
        $totalChannels = Channel::count();
        $activeChannels = Channel::where('visibility', ActiveStatus::ACTIVE)->count();
        $totalVideos = Video::whereHas('channels')->count();

        // Calculate growth
        $lastMonthChannels = Channel::where('created_at', '<', Carbon::now()->startOfMonth())
            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
            ->count();

        $growth = $lastMonthChannels > 0 
            ? (($totalChannels - $lastMonthChannels) / $lastMonthChannels) * 100 
            : ($totalChannels > 0 ? 100 : 0);

        // Get popular channel
        $popularChannel = Channel::withCount('videos')
            ->orderBy('videos_count', 'desc')
            ->first();

        // Get channels with video counts
        $channels = $query->withCount('videos')
                        ->latest()
                        ->paginate(12);

        return view('admin.channel', compact(
            'channels',
            'totalChannels',
            'activeChannels',
            'totalVideos',
            'popularChannel',
            'growth'
        ));
    }

    public function edit($id)
    {
        $channel = Channel::findOrFail($id);
        return view('crud.channel.update', compact('channel'));
    }

    public function update(Request $request, $id)
    {
        $channel = Channel::findOrFail($id);
        
        $validatedData = $request->validate([
            'profile_image' => 'nullable|image|max:2048',
            'channel_name' => 'required|max:255',
            'handle' => 'required|max:50|unique:channels,handle,' . $id,
            'description' => 'required',
            'banner_image' => 'nullable|image|max:2048',
            'youtube' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'visibility' => ['required', new Enum(ActiveStatus::class)],
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

        $channel->update($validatedData);

        return redirect()->route('channels')->with('success', 'Channel updated successfully.');
    }

    public function destroy($id)
    {
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return redirect()->route('channels')->with('success', 'Channel deleted successfully.');
    }
}
