<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Validation\Rules\Enum;
use App\VisibilityStatus;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Actor;
use App\Models\Channel;

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
        $video = Video::create([
            'title' => $validatedData['title'],
            'video_link' => $validatedData['video_link'],
            'duration' => $validatedData['duration'],
            'description' => $validatedData['description'],
            'thumbnail' => $validatedData['thumbnail'],
            'language' => $validatedData['language'],
            'visibility' => $validatedData['visibility'],
        ]);

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
}
