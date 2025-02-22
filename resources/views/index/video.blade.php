@extends('layouts.index')

@section('title', $video->title)

@section('content')
<!-- Main Content with Right Sidebar Layout -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-16">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Video Content -->
        <div class="flex-1">
            <!-- Video Player -->
            <div class="w-full aspect-video bg-neutral-800 rounded-lg mb-4">
                <video class="w-full h-full rounded-lg" controls>
                    <source src="{{ asset('storage/' . $video->video_link) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Video Info -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h1 class="text-2xl font-bold mb-2">{{ $video->title }}</h1>
                <div class="flex items-center justify-between mb-6">
                    <div class="text-neutral-400 text-sm">
                        <span>{{ number_format($video->videoStats?->views_count ?? 0) }} views</span>
                        <span class="mx-2">•</span>
                        <span>{{ $video->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors">
                            <i class="fas fa-thumbs-up"></i>
                            <span>{{ number_format($video->videoStats?->likes ?? 0) }}</span>
                        </button>
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors">
                            <i class="fas fa-thumbs-down"></i>
                            <span>{{ number_format($video->videoStats?->dislikes ?? 0) }}</span>
                        </button>
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors">
                            <i class="fas fa-share"></i>
                            <span>Share</span>
                        </button>
                    </div>
                </div>

                <!-- Categories, Actors, and Channels Section -->
                <div class="space-y-4 mb-6 pt-6 border-t border-neutral-700">
                    <!-- Categories -->
                    @if($video->categories->count() > 0)
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Categories:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($video->categories as $category)
                            <a href="{{ route('category', $category->id) }}" class="flex items-center space-x-2 text-sm hover:text-red-500 transition-colors">
                                <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-colors">
                                    <span class="text-red-500 text-sm">#</span>
                                </div>
                                <span>{{ $category->name }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Tags -->
                    @if($video->tags->count() > 0)
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Tags:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($video->tags as $tag)
                            <span class="text-sm text-neutral-400">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Actors -->
                    @if($video->actors->count() > 0)
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Actors:</h3>
                        <div class="flex flex-wrap gap-4">
                            @foreach($video->actors as $actor)
                            <a href="{{ route('actor', $actor->id) }}" class="flex items-center space-x-3 group">
                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden">
                                    <img src="{{ asset('storage/' . ($actor->profile_image ?? 'actors/default.jpg')) }}" alt="{{ $actor->name }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm group-hover:text-red-500 transition-colors">{{ $actor->name }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Channels -->
                    @if($video->channels->count() > 0)
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Channels:</h3>
                        <div class="flex flex-wrap gap-4">
                            @foreach($video->channels as $channel)
                            <a href="{{ route('channel', $channel->id) }}" class="flex items-center space-x-3 group">
                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden">
                                    <img src="{{ asset('storage/' . ($channel->profile_image ?? 'channels/default.jpg')) }}" alt="{{ $channel->channel_name }}" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm group-hover:text-red-500 transition-colors">{{ $channel->channel_name }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Description -->
                @if($video->description)
                <div class="pt-6 border-t border-neutral-700">
                    <p class="text-sm text-neutral-400 whitespace-pre-line">{{ $video->description }}</p>
                </div>
                @endif
            </div>

            <!-- Related Videos Section -->
            @if($relatedVideos->count() > 0)
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4">Related Videos</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($relatedVideos as $relatedVideo)
                    <div class="video-card group">
                        <a href="{{ route('video', $relatedVideo->id) }}" class="block">
                            <div class="thumbnail-wrapper relative aspect-video mb-3">
                                <img src="{{ asset('storage/' . ($relatedVideo->thumbnail ?? 'thumbnails/default.jpg')) }}" 
                                     alt="{{ $relatedVideo->title }}" 
                                     class="thumbnail w-full h-full object-cover">
                                <span class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ $relatedVideo->duration }}</span>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="metadata space-y-1">
                                <h3 class="title text-sm font-medium line-clamp-2">{{ $relatedVideo->title }}</h3>
                                <div class="flex items-center text-xs text-neutral-400">
                                    <span>{{ number_format($relatedVideo->videoStats?->views_count ?? 0) }} views</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $relatedVideo->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Right Sidebar -->
        <div class="lg:w-96">
            <div class="sticky top-24">
                <h2 class="text-xl font-bold mb-4">Recommended</h2>
                
                <!-- Recommended Videos -->
                <div class="space-y-2">
                    @foreach($recommendedVideos as $recommendedVideo)
                    <div class="video-card group hover:bg-neutral-800/30 rounded-xl p-2 transition-colors">
                        <a href="{{ route('video', $recommendedVideo->id) }}" class="flex items-start">
                            <div class="thumbnail-wrapper relative w-40 aspect-video rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . ($recommendedVideo->thumbnail ?? 'thumbnails/default.jpg')) }}" 
                                     alt="{{ $recommendedVideo->title }}" 
                                     class="thumbnail w-full h-full object-cover">
                                <span class="duration absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/90 text-xs font-medium rounded">{{ $recommendedVideo->duration }}</span>
                            </div>
                            <div class="flex-1 ml-3">
                                <h3 class="text-sm font-medium line-clamp-2 group-hover:text-red-500 transition-colors">{{ $recommendedVideo->title }}</h3>
                                <div class="mt-1 text-xs text-neutral-400">
                                    <span>{{ number_format($recommendedVideo->videoStats?->views_count ?? 0) }} views</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $recommendedVideo->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection