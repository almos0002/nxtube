<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Validation\Rules\Enum;
use App\Enums\VisibilityStatus;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Actor;
use App\Models\Channel;
use Illuminate\Support\Facades\Storage;
use App\Models\VideoStats;

class VideoController extends Controller
{
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $actors = Actor::all();
        $channels = Channel::all();

        return view('crud.video.add', [
            'tags' => $tags,
            'categories' => $categories,
            'actors' => $actors,
            'channels' => $channels
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'video_link' => 'required|url',
            'duration' => 'required|date_format:H:i:s',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'channel_id' => 'required|array',
            'channel_id.*' => 'exists:channels,id',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'language' => 'required|string|max:50',
            'actor_id' => 'required|array',
            'actor_id.*' => 'exists:actors,id',
            'visibility' => ['required', new Enum(VisibilityStatus::class)],
            'tags' => 'required|array',
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        // Create video with basic data
        $video = Video::create($validatedData);

        // Handle tags - create if they don't exist
        $tagIds = [];
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        
        // Sync relationships
        $video->tags()->sync($tagIds);
        $video->channels()->sync($request->channel_id);
        $video->categories()->sync($request->category_id);
        $video->actors()->sync($request->actor_id);

        return redirect()->route('videos')->with('success', 'Video added successfully.');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        $actors = Actor::all();
        $channels = Channel::all();

        return view('crud.video.update', [
            'video' => $video,
            'tags' => $tags,
            'categories' => $categories,
            'actors' => $actors,
            'channels' => $channels
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_link' => 'required|url',
            'duration' => ['required', 'regex:/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/'],
            'language' => 'required|string|max:50',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'channel_id' => 'required|array',
            'channel_id.*' => 'exists:channels,id',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id',
            'actor_id' => 'required|array',
            'actor_id.*' => 'exists:actors,id',
            'visibility' => ['required', new Enum(VisibilityStatus::class)],
            'tags' => 'required|array',
        ]);

        $video = Video::findOrFail($id);
        
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $video->update($validated);

        // Handle tags - create if they don't exist
        $tagIds = [];
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        
        // Sync relationships
        $video->tags()->sync($tagIds);
        $video->channels()->sync($request->channel_id);
        $video->categories()->sync($request->category_id);
        $video->actors()->sync($request->actor_id);

        return redirect()->route('videos')->with('success', 'Video updated successfully.');
    }

    public function index()
    {
        // Get video statistics
        $total_videos = Video::count();
        $active_videos = Video::where('visibility', VisibilityStatus::PUBLIC->value)->count();
        $draft_videos = Video::where('visibility', VisibilityStatus::DRAFT->value)->count();
        $total_views = VideoStats::sum('views_count');

        // Calculate percentages
        $active_percentage = $total_videos > 0 ? round(($active_videos / $total_videos) * 100) : 0;
        $draft_percentage = $total_videos > 0 ? round(($draft_videos / $total_videos) * 100) : 0;
        
        $stats = [
            'total' => $total_videos,
            'active' => $active_videos,
            'active_percentage' => $active_percentage,
            'processing' => $draft_videos,
            'processing_percentage' => $draft_percentage,
            'total_views' => $total_views,
            'views_per_video' => $total_videos > 0 ? round($total_views / $total_videos) : 0,
        ];

        // Get latest videos with relationships
        $videos = Video::with(['channels', 'actors', 'categories', 'videoStats'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.video', [
            'stats' => $stats,
            'videos' => $videos
        ]);
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        
        // Delete the thumbnail file if it exists
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        
        // Delete the video and its relationships
        $video->delete();
        
        return redirect()->route('videos')->with('success', 'Video deleted successfully.');
    }
}
