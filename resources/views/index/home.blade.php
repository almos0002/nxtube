@extends('layouts.index')

@section('title', 'Home')

@section('content')
    <!-- Add CSS for scrollable sections -->
    <style>
        .scrollable-section {
            position: relative;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            padding-bottom: 10px;
            scroll-behavior: smooth;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE and Edge */
        }

        .scrollable-section::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .scrollable-grid {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 300px;
            /* Fixed width for consistent sizing */
            gap: 1.5rem;
        }

        @media (max-width: 1023px) {
            .scrollable-grid {
                grid-auto-columns: 280px;
                /* Fixed width for consistent sizing */
            }
        }

        @media (max-width: 767px) {
            .scrollable-grid {
                grid-auto-columns: 240px;
                /* Fixed width for consistent sizing */
            }
        }

        @media (max-width: 639px) {
            .scrollable-grid {
                grid-auto-columns: 220px;
                /* Fixed width for consistent sizing */
            }
        }

        .actors-grid {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 120px;
            gap: 1rem;
        }

        .channels-grid {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 300px;
            gap: 1.5rem;
        }

        .scroll-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .scroll-button {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .scroll-button:hover {
            background-color: rgba(239, 68, 68, 0.2);
        }

        .scroll-button svg {
            width: 18px;
            height: 18px;
            color: white;
        }

        /* Hide scroll buttons on mobile */
        @media (max-width: 768px) {
            .scroll-buttons {
                display: none;
            }
        }
    </style>

    <!-- Trending Section -->
    <section class="py-8">
        <div class="nx-container">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Trending Videos</h2>
                    <div class="flex items-center">
                        <div class="scroll-buttons mr-3">
                            <button class="scroll-button scroll-left" onclick="scrollSection('trending-videos', -600)">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="scroll-button scroll-right" onclick="scrollSection('trending-videos', 600)">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route('all-videos') }}"
                            class="text-red-500 hover:text-red-400 text-sm font-medium flex items-center whitespace-nowrap">
                            View All
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="scrollable-section" id="trending-videos">
                <div class="scrollable-grid">
                    @forelse($trendingVideos as $video)
                        <div class="video-card group">
                            <a href="{{ route('video', $video->slug) }}" class="block">
                                <div class="thumbnail-wrapper relative aspect-video mb-3">
                                    <img src="{{ asset('storage/' . ($video->thumbnail ?? 'thumbnails/default.jpg')) }}"
                                        alt="{{ $video->title }}" class="thumbnail w-full h-full object-cover">
                                    <span
                                        class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ $video->duration }}</span>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div
                                            class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="metadata space-y-1">
                                    <h3 class="title text-sm font-medium line-clamp-2">{{ $video->title }}</h3>
                                    <div class="flex items-center text-xs text-neutral-400">
                                        <span>{{ number_format($video->videoStats?->views_count ?? 0) }} views</span>
                                        <span class="mx-1">•</span>
                                        <span>{{ $video->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div
                                class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                                <i class="fas fa-video text-2xl text-neutral-600"></i>
                            </div>
                            <h3 class="text-lg font-medium mb-2">No Trending Videos</h3>
                            <p class="text-neutral-400">There are no trending videos at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Actors Section -->
    <section class="py-8">
        <div class="nx-container">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Popular Actors</h2>
                    <div class="flex items-center">
                        <div class="scroll-buttons mr-3">
                            <button class="scroll-button scroll-left" onclick="scrollSection('popular-actors', -600)">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="scroll-button scroll-right" onclick="scrollSection('popular-actors', 600)">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route('all-actors') }}"
                            class="text-red-500 hover:text-red-400 text-sm font-medium flex items-center whitespace-nowrap">
                            View All
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="scrollable-section" id="popular-actors">
                <div class="actors-grid">
                    @forelse($popularActors as $actor)
                        <a href="{{ route('actor', $actor->slug) }}" class="block group text-center">
                            <div class="w-20 h-20 mx-auto rounded-full overflow-hidden border-2 border-neutral-700 mb-2">
                                @if ($actor->profile_image)
                                    <img src="{{ asset('storage/' . $actor->profile_image) }}"
                                        alt="{{ $actor->stagename }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-red-500/10">
                                        <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <h3
                                class="text-sm font-medium text-neutral-100 group-hover:text-red-500 transition-colors truncate">
                                {{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}
                            </h3>
                            <p class="text-xs text-neutral-400">{{ number_format($actor->videos_count) }}</p>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-neutral-400">No popular actors found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Categories with Videos (Only first category) -->
    @if (count($popularCategories) > 0)
        <section class="py-8">
            <div class="nx-container">
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-red-500/10 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-red-500 text-sm font-bold">#</span>
                            </div>
                            <h2 class="text-2xl font-bold text-white">{{ $popularCategories[0]->name }}</h2>
                        </div>
                        <div class="flex items-center">
                            <div class="scroll-buttons mr-3">
                                <button class="scroll-button scroll-left"
                                    onclick="scrollSection('popular-category', -600)">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button class="scroll-button scroll-right"
                                    onclick="scrollSection('popular-category', 600)">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                            <a href="{{ route('category', $popularCategories[0]->slug) }}"
                                class="text-red-500 hover:text-red-400 text-sm font-medium flex items-center whitespace-nowrap">
                                View All
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="scrollable-section" id="popular-category">
                    <div class="scrollable-grid">
                        @forelse($popularCategories[0]->topVideos as $video)
                            <div class="video-card group">
                                <a href="{{ route('video', $video->slug) }}" class="block">
                                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                                        <img src="{{ asset('storage/' . ($video->thumbnail ?? 'thumbnails/default.jpg')) }}"
                                            alt="{{ $video->title }}" class="thumbnail w-full h-full object-cover">
                                        <span
                                            class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ $video->duration }}</span>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div
                                                class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-play text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="metadata space-y-1">
                                        <h3 class="title text-sm font-medium line-clamp-2">{{ $video->title }}</h3>
                                        <div class="flex items-center text-xs text-neutral-400">
                                            <span>{{ number_format($video->videoStats?->views_count ?? 0) }} views</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $video->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-neutral-400">No videos found in this category.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Popular Channels Section -->
    <section class="py-8">
        <div class="nx-container">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Popular Channels</h2>
                    <div class="flex items-center">
                        <div class="scroll-buttons mr-3">
                            <button class="scroll-button scroll-left" onclick="scrollSection('popular-channels', -600)">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="scroll-button scroll-right" onclick="scrollSection('popular-channels', 600)">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route('all-channels') }}"
                            class="text-red-500 hover:text-red-400 text-sm font-medium flex items-center whitespace-nowrap">
                            View All
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="scrollable-section" id="popular-channels">
                <div class="channels-grid">
                    @forelse($popularChannels as $channel)
                        <a href="{{ route('channel', $channel->handle ?? $channel->slug) }}"
                            class="block group bg-neutral-800 rounded-xl overflow-hidden hover:bg-neutral-700/50 transition-colors">
                            <div class="h-24 bg-neutral-700 relative">
                                @if ($channel->banner_image)
                                    <img src="{{ asset('storage/' . $channel->banner_image) }}"
                                        alt="{{ $channel->channel_name }} banner" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute -bottom-6 left-4">
                                    <div
                                        class="w-12 h-12 rounded-full overflow-hidden border-2 border-neutral-800 bg-neutral-700">
                                        @if ($channel->profile_image)
                                            <img src="{{ asset('storage/' . $channel->profile_image) }}"
                                                alt="{{ $channel->channel_name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-red-500/10">
                                                <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 pt-8">
                                <h3 class="font-medium text-neutral-100 group-hover:text-red-500 transition-colors">
                                    {{ $channel->channel_name }}</h3>
                                @if ($channel->handle)
                                    <p class="text-xs text-neutral-400 mb-1">{{ '@' . $channel->handle }}</p>
                                @endif
                                <p class="text-xs text-neutral-400">{{ number_format($channel->videos_count) }} videos</p>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-neutral-400">No popular channels found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Videos Section -->
    <section class="py-8">
        <div class="nx-container">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Recent Videos</h2>
                    <div class="flex items-center">
                        <a href="{{ route('all-videos') }}"
                            class="text-red-500 hover:text-red-400 text-sm font-medium flex items-center whitespace-nowrap">
                            View All
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($recentVideos as $video)
                    <div class="video-card group">
                        <a href="{{ route('video', $video->slug) }}" class="block">
                            <div class="thumbnail-wrapper relative aspect-video mb-3">
                                <img src="{{ asset('storage/' . ($video->thumbnail ?? 'thumbnails/default.jpg')) }}"
                                    alt="{{ $video->title }}" class="thumbnail w-full h-full object-cover">
                                <span
                                    class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ $video->duration }}</span>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div
                                        class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="metadata space-y-1">
                                <h3 class="title text-sm font-medium line-clamp-2">{{ $video->title }}</h3>
                                <div class="flex items-center text-xs text-neutral-400">
                                    <span>{{ number_format($video->videoStats?->views_count ?? 0) }} views</span>
                                    <span class="mx-1">•</span>
                                    <span>{{ $video->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                            <i class="fas fa-video text-2xl text-neutral-600"></i>
                        </div>
                        <h3 class="text-lg font-medium mb-2">No Recent Videos</h3>
                        <p class="text-neutral-400">There are no recent videos at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- JavaScript for scroll buttons -->
    <script>
        // Function to scroll sections horizontally
        function scrollSection(sectionId, scrollAmount) {
            const scrollContainer = document.getElementById(sectionId);
            if (scrollContainer) {
                scrollContainer.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }
    </script>
@endsection
