@extends('layouts.index')

@section('title', $video->title)
@section('meta_description', $video->description)
@section('meta_keywords', implode(', ', $video->tags->pluck('name')->toArray()))
@section('og_image', url('storage/' . $video->thumbnail))

@section('content')
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Video Content -->
        <div class="flex-1">
            <!-- Banner 1 above video -->
            @if ($siteAds->is_active && $siteAds->ads_banner_1)
                <div class="w-full h-30 mb-4 overflow-hidden flex items-center justify-center">
                    @if (Str::startsWith($siteAds->ads_banner_1, ['http://', 'https://']) ||
                            Str::contains($siteAds->ads_banner_1, ['<script', '<iframe', '<div']))
                        {!! $siteAds->ads_banner_1 !!}
                    @else
                        <img src="{{ asset('storage/' . $siteAds->ads_banner_1) }}" alt="Advertisement"
                            class="w-full h-full object-cover rounded-lg">
                    @endif
                </div>
            @endif

            <!-- Video Player -->
            <div class="w-full aspect-video bg-neutral-800 rounded-lg mb-4">
                <video class="w-full h-full rounded-lg" controls>
                    <source src="{{ asset('storage/' . $video->video_link) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Video Info -->
            <div class="bg-neutral-800/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-neutral-700/50">
                <h1 class="text-2xl md:text-3xl font-bold mb-3 text-white">{{ $video->title }}</h1>
                
                <div class="flex flex-wrap items-center justify-between mb-4">
                    <div class="flex items-center space-x-4 text-neutral-300 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-2 text-red-500"></i>
                            <span>{{ number_format($video->videoStats?->views_count ?? 0) }} views</span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-2 text-red-500"></i>
                            <span>{{ $video->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors bg-neutral-700/50 px-4 py-2 rounded-full">
                            <i class="fas fa-share"></i>
                            <span>Share</span>
                        </button>
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors bg-neutral-700/50 px-4 py-2 rounded-full">
                            <i class="fas fa-bookmark"></i>
                            <span>Save</span>
                        </button>
                    </div>
                </div>

                <!-- Channels Section - Always visible -->
                @if ($video->channels->count() > 0)
                    <div class="flex flex-wrap items-center gap-4 mb-4 pb-4 border-b border-neutral-700">
                        @foreach ($video->channels as $channel)
                            <a href="{{ route('channel', $channel->handle ?? $channel->slug) }}"
                                class="flex items-center space-x-3 group">
                                <div class="w-10 h-10 rounded-full bg-neutral-600 overflow-hidden flex-shrink-0 ring-2 ring-red-500/30">
                                    <img src="{{ asset('storage/' . ($channel->profile_image ?? 'channels/default.jpg')) }}"
                                        alt="{{ $channel->channel_name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-medium group-hover:text-red-500 transition-colors">{{ $channel->channel_name }}</span>
                                    <span class="text-xs text-neutral-400">{{ $channel->handle ? '@'.$channel->handle : '' }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Compact Description Preview - Always visible -->
                @if ($video->description)
                    <div class="mb-4">
                        <div id="descriptionContainer" class="relative">
                            <div id="descriptionText" class="text-sm text-neutral-300 whitespace-pre-line overflow-hidden transition-all duration-300" style="max-height: 3rem;">{{ $video->description }}</div>
                            <div id="descriptionGradient" class="absolute bottom-0 left-0 right-0 h-6 bg-gradient-to-t from-neutral-800/80 to-transparent pointer-events-none"></div>
                        </div>
                    </div>
                @endif

                <!-- Toggle Button -->
                <div class="flex justify-center mb-2">
                    <button id="toggleCardDetails" class="text-sm text-red-500 hover:text-red-400 flex items-center px-4 py-1 rounded-full bg-neutral-700/30 hover:bg-neutral-700/50 transition-colors">
                        <span id="toggleText">Show more</span>
                        <i id="toggleIcon" class="fas fa-chevron-down ml-2 transition-transform duration-300"></i>
                    </button>
                </div>

                <!-- Expandable Content Section -->
                <div id="expandableContent" class="hidden space-y-5 mt-4">
                    <!-- Categories, Actors, and Tags Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-5">
                            <!-- Categories -->
                            @if ($video->categories->count() > 0)
                                <div class="flex flex-col">
                                    <h3 class="text-sm font-semibold text-white mb-2">Categories</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($video->categories as $category)
                                            <a href="{{ route('category', $category->slug) }}"
                                                class="px-3 py-1 bg-neutral-700/50 hover:bg-red-500 rounded-full text-sm transition-colors">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Tags -->
                            @if ($video->tags->count() > 0)
                                <div class="flex flex-col">
                                    <h3 class="text-sm font-semibold text-white mb-2">Tags</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($video->tags as $tag)
                                            <a href="{{ route('tag', $tag->slug) }}"
                                                class="px-3 py-1 bg-neutral-700/50 hover:bg-red-500 rounded-full text-sm transition-colors">#{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-5">
                            <!-- Actors -->
                            @if ($video->actors->count() > 0)
                                <div class="flex flex-col">
                                    <h3 class="text-sm font-semibold text-white mb-2">Actors</h3>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach ($video->actors as $actor)
                                            <a href="{{ route('actor', $actor->slug) }}" class="flex items-center space-x-2 group bg-neutral-700/30 px-3 py-2 rounded-lg hover:bg-neutral-700/70 transition-all">
                                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden flex-shrink-0">
                                                    <img src="{{ asset('storage/' . ($actor->profile_image ?? 'actors/default.jpg')) }}"
                                                        alt="{{ $actor->name }}" class="w-full h-full object-cover">
                                                </div>
                                                <span class="text-sm group-hover:text-red-500 transition-colors">{{ $actor->name }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Toggle Button (Bottom) - Only visible when expanded -->
                <div id="bottomToggleContainer" class="hidden justify-center mt-4">
                    <button id="toggleCardDetailsBottom" class="text-sm text-red-500 hover:text-red-400 flex items-center px-4 py-1 rounded-full bg-neutral-700/30 hover:bg-neutral-700/50 transition-colors">
                        <span>Show less</span>
                        <i class="fas fa-chevron-up ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- Add JavaScript for expandable card -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleBtn = document.getElementById('toggleCardDetails');
                    const toggleBtnBottom = document.getElementById('toggleCardDetailsBottom');
                    const bottomToggleContainer = document.getElementById('bottomToggleContainer');
                    const expandableContent = document.getElementById('expandableContent');
                    const toggleText = document.getElementById('toggleText');
                    const toggleIcon = document.getElementById('toggleIcon');
                    const descriptionText = document.getElementById('descriptionText');
                    const descriptionGradient = document.getElementById('descriptionGradient');
                    
                    // Function to expand content
                    function expandContent() {
                        // Expand content
                        expandableContent.classList.remove('hidden');
                        bottomToggleContainer.classList.remove('hidden');
                        bottomToggleContainer.classList.add('flex');
                        
                        // Hide top toggle button
                        toggleBtn.style.display = 'none';
                        
                        // Expand description
                        if(descriptionText) {
                            descriptionText.style.maxHeight = 'none';
                            if(descriptionGradient) descriptionGradient.style.display = 'none';
                        }
                    }
                    
                    // Function to collapse content
                    function collapseContent() {
                        // Collapse content
                        expandableContent.classList.add('hidden');
                        bottomToggleContainer.classList.add('hidden');
                        bottomToggleContainer.classList.remove('flex');
                        
                        // Show top toggle button
                        toggleBtn.style.display = '';
                        
                        // Collapse description
                        if(descriptionText) {
                            descriptionText.style.maxHeight = '3rem';
                            if(descriptionGradient) descriptionGradient.style.display = 'block';
                        }
                        
                        // Scroll back to the top of the card if needed
                        const videoInfoCard = document.querySelector('.bg-neutral-800\\/80');
                        if (videoInfoCard) {
                            videoInfoCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    }
                    
                    if(toggleBtn && expandableContent) {
                        toggleBtn.addEventListener('click', expandContent);
                    }
                    
                    if(toggleBtnBottom) {
                        toggleBtnBottom.addEventListener('click', collapseContent);
                    }
                });
            </script>

            <!-- Related Videos Section -->
            @if ($relatedVideos->count() > 0)
                <div class="mt-8">
                    <h2 class="text-xl font-bold mb-4">Related Videos</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($relatedVideos as $relatedVideo)
                            <div class="video-card group">
                                <a href="{{ route('video', $relatedVideo->slug) }}" class="block">
                                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                                        <img src="{{ asset('storage/' . ($relatedVideo->thumbnail ?? 'thumbnails/default.jpg')) }}"
                                            alt="{{ $relatedVideo->title }}" class="thumbnail w-full h-full object-cover">
                                        <span
                                            class="duration absolute bottom-2 right-2 px-2 py-0.5 bg-black/90 text-xs rounded-md font-medium">{{ $relatedVideo->duration }}</span>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div
                                                class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-play text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="metadata space-y-1">
                                        <h3 class="title text-sm font-medium line-clamp-2">{{ $relatedVideo->title }}</h3>
                                        <div class="flex items-center text-xs text-neutral-400">
                                            <span>{{ number_format($relatedVideo->videoStats?->views_count ?? 0) }}
                                                views</span>
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
                <!-- Banner 2 above Recommended -->
                @if ($siteAds->is_active && $siteAds->ads_banner_2)
                    <div class="w-full h-auto max-h-60 mb-4 overflow-hidden flex items-center justify-center">
                        @if (Str::startsWith($siteAds->ads_banner_2, ['http://', 'https://']) ||
                                Str::contains($siteAds->ads_banner_2, ['<script', '<iframe', '<div']))
                            {!! $siteAds->ads_banner_2 !!}
                        @else
                            <img src="{{ asset('storage/' . $siteAds->ads_banner_2) }}" alt="Advertisement"
                                class="w-full h-full object-cover rounded-lg">
                        @endif
                    </div>
                @endif

                <h2 class="text-xl font-bold mb-4">Recommended</h2>

                <!-- Recommended Videos -->
                <div class="space-y-2">
                    @foreach ($recommendedVideos as $recommendedVideo)
                        <div class="video-card group p-2">
                            <a href="{{ route('video', $recommendedVideo->slug) }}" class="flex items-start">
                                <div class="thumbnail-wrapper relative w-40 aspect-video rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . ($recommendedVideo->thumbnail ?? 'thumbnails/default.jpg')) }}"
                                        alt="{{ $recommendedVideo->title }}" class="thumbnail w-full h-full object-cover">
                                    <span
                                        class="duration absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/90 text-xs font-medium rounded">{{ $recommendedVideo->duration }}</span>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div
                                            class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-white text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 ml-3">
                                    <h3 class="text-sm font-medium line-clamp-2">{{ $recommendedVideo->title }}</h3>
                                    <div class="mt-1 text-xs text-neutral-400">
                                        <span>{{ number_format($recommendedVideo->videoStats?->views_count ?? 0) }}
                                            views</span>
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
@endsection
