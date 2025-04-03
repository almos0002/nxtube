@extends('layouts.index')

@section('title', $channel->channel_name)
@section('meta_description', $channel->description)
@section('og_image', url('storage/' . $channel->banner_image))

@section('content')
    <!-- Channel Header -->
    <section class="relative mb-8">
        <!-- Banner Image -->
        <div class="h-48 md:h-80 w-full rounded-2xl overflow-hidden">
            <img src="{{ asset('storage/' . ($channel->banner_image ?? 'channels/banner-default.jpg')) }}"
                class="w-full h-full object-cover" alt="{{ $channel->channel_name }} Banner">
        </div>

        <!-- Channel Info Overlay -->
        <div class="relative md:absolute md:bottom-0 md:left-0 md:right-0 p-4 md:p-8 md:bg-gradient-to-t md:from-neutral-900 md:via-neutral-900/80 md:to-transparent">
            <div class="flex flex-col md:flex-row items-center md:items-end space-y-4 md:space-y-0 md:space-x-6">
                <img src="{{ asset('storage/' . ($channel->profile_image ?? 'channels/default.jpg')) }}"
                    class="w-28 h-28 md:w-32 md:h-32 rounded-full border-4 border-neutral-100 shadow-xl -mt-14 md:mt-0"
                    alt="{{ $channel->channel_name }}">
                <div class="flex-1 text-center md:text-left">
                    <!-- Channel Name Section -->
                    <div class="mb-3">
                        <h1 class="text-2xl md:text-3xl font-bold">{{ $channel->channel_name }}</h1>
                        @if($channel->handle)
                            <p class="text-neutral-300 text-sm md:text-base mt-1">
                                <i class="fas fa-at text-neutral-400 mr-1"></i>{{ $channel->handle }}
                            </p>
                        @endif
                    </div>
                    
                    @if ($channel->description)
                        <p class="text-neutral-300 text-base md:text-lg mb-4 line-clamp-2 md:line-clamp-none">{{ Str::limit($channel->description, 120) }}</p>
                    @endif
                    <div class="flex justify-center md:justify-start items-center space-x-6 text-neutral-400">
                        <span><i class="fas fa-video mr-2"></i>{{ $videos->total() }} Videos</span>
                        <span><i class="fas fa-eye mr-2"></i>{{ number_format($totalViews) }} Views</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Channel Description -->
    @if ($channel->description)
        <section class="py-6 md:py-8">
            <div class="bg-neutral-800/30 rounded-xl p-4 md:p-6">
                <h2 class="text-xl font-semibold mb-3 md:mb-4">About the Channel</h2>
                <p class="text-neutral-300 text-sm md:text-base">{{ $channel->description }}</p>
                @if ($channel->youtube || $channel->twitter || $channel->instagram)
                    <div class="mt-4 md:mt-6 flex items-center space-x-4 justify-center md:justify-start">
                        @if ($channel->youtube)
                            <a href="{{ $channel->youtube }}" target="_blank"
                                class="text-neutral-400 hover:text-red-500 transition-colors p-2">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        @endif
                        @if ($channel->twitter)
                            <a href="{{ $channel->twitter }}" target="_blank"
                                class="text-neutral-400 hover:text-red-500 transition-colors p-2">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        @endif
                        @if ($channel->instagram)
                            <a href="{{ $channel->instagram }}" target="_blank"
                                class="text-neutral-400 hover:text-red-500 transition-colors p-2">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- Channel Videos -->
    <section class="py-6 md:py-8">
        <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Videos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($videos as $video)
                <div class="video-card group">
                    <a href="{{ route('video', $video->slug) }}" class="block">
                        <div class="thumbnail-wrapper relative aspect-video mb-2 md:mb-3 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . ($video->thumbnail ?? 'thumbnails/default.jpg')) }}"
                                alt="{{ $video->title }}" class="thumbnail w-full h-full object-cover">
                            <span
                                class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ \App\Http\Controllers\IndexController::formatDuration($video->duration) }}</span>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                <div
                                    class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 bg-red-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-play text-white"></i>
                                </div>
                            </div>
                        </div>
                        <div class="metadata space-y-1">
                            <h3 class="title text-sm md:text-base font-medium line-clamp-2">{{ $video->title }}</h3>
                            <div class="flex items-center text-xs text-neutral-400">
                                <span>{{ number_format($video->videoStats?->views_count ?? 0) }} views</span>
                                <span class="mx-1">•</span>
                                <span>{{ $video->created_at->diffForHumans() }}</span>
                            </div>
                            @if ($video->categories->count() > 0)
                                <div class="flex flex-wrap gap-1 mt-1">
                                    @foreach ($video->categories as $category)
                                        <a href="{{ route('category', $category->slug) }}"
                                            class="text-xs text-neutral-400 hover:text-red-500 transition-colors">#{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-8 md:py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                        <i class="fas fa-video text-2xl text-neutral-600"></i>
                    </div>
                    <h3 class="text-lg font-medium mb-2">No Videos Found</h3>
                    <p class="text-neutral-400">This channel hasn't uploaded any videos yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($videos->hasPages())
            <div class="mt-6 md:mt-8 px-4 md:px-0 pagination-container">
                {{ $videos->links() }}
            </div>
        @endif
    </section>
@endsection
