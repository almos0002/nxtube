@extends('layouts.index')

@section('title', 'Search: ' . $query)

@php
$hideBreadcrumbs = true;
@endphp

@section('content')
    <div class="nx-container py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center">
                    <i class="fas fa-search text-red-500" style="font-size: 1.25rem;"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Search Results</h1>
                    <p class="text-neutral-400">{{ $totalResults }} results for "{{ $query }}"</p>
                </div>
            </div>
            
            <!-- Search Type Filter -->
            <div class="flex items-center space-x-2 bg-neutral-800 rounded-full p-1 self-start md:self-auto">
                <a href="{{ route('search', ['q' => $query, 'type' => 'all']) }}" 
                   class="px-4 py-2 rounded-full text-sm {{ $type == 'all' ? 'bg-red-500 text-white' : 'text-neutral-300 hover:bg-neutral-700' }}">
                   All ({{ $totalResults }})
                </a>
                <a href="{{ route('search', ['q' => $query, 'type' => 'videos']) }}" 
                   class="px-4 py-2 rounded-full text-sm {{ $type == 'videos' ? 'bg-red-500 text-white' : 'text-neutral-300 hover:bg-neutral-700' }}">
                   Videos ({{ $contentCounts['videos'] }})
                </a>
                <a href="{{ route('search', ['q' => $query, 'type' => 'channels']) }}" 
                   class="px-4 py-2 rounded-full text-sm {{ $type == 'channels' ? 'bg-red-500 text-white' : 'text-neutral-300 hover:bg-neutral-700' }}">
                   Channels ({{ $contentCounts['channels'] }})
                </a>
                <a href="{{ route('search', ['q' => $query, 'type' => 'actors']) }}" 
                   class="px-4 py-2 rounded-full text-sm {{ $type == 'actors' ? 'bg-red-500 text-white' : 'text-neutral-300 hover:bg-neutral-700' }}">
                   Actors ({{ $contentCounts['actors'] }})
                </a>
            </div>
        </div>

        @if($type == 'all' || $type == 'videos')
            @if(count($videos) > 0)
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold">Videos</h2>
                        @if(count($videos) >= 8 && $type == 'all')
                            <a href="{{ route('search', ['q' => $query, 'type' => 'videos']) }}" class="text-sm text-red-500 hover:text-red-400 transition-colors flex items-center">
                                View all <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        @endif
                    </div>
                    
                    <!-- Videos Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($videos as $video)
                            <div class="video-card group">
                                <a href="{{ route('video', $video->slug) }}" class="block">
                                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                                        <img src="{{ \App\Http\Controllers\IndexController::thumbnailUrl($video->thumbnail, 'medium') }}"
                                            alt="{{ $video->title }}" class="thumbnail w-full h-full object-cover" loading="lazy">
                                        <span
                                            class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ \App\Http\Controllers\IndexController::formatDuration($video->duration) }}</span>
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
                                        @if ($video->categories->count() > 0)
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @foreach ($video->categories as $category)
                                                    <a href="{{ route('category', $category->id) }}"
                                                        class="text-xs text-neutral-400 hover:text-red-500 transition-colors">#{{ $category->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif($type == 'videos' && count($videos) == 0)
                <div class="text-center py-12 mb-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                        <i class="fas fa-video text-2xl text-neutral-600"></i>
                    </div>
                    <h3 class="text-lg font-medium mb-2">No Videos Found</h3>
                    <p class="text-neutral-400">We couldn't find any videos matching your search.</p>
                </div>
            @endif
        @endif
        
        @if($type == 'all' || $type == 'channels')
            @if(count($channels) > 0)
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold">Channels</h2>
                        @if(count($channels) >= 4 && $type == 'all')
                            <a href="{{ route('search', ['q' => $query, 'type' => 'channels']) }}" class="text-sm text-red-500 hover:text-red-400 transition-colors flex items-center">
                                View all <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        @endif
                    </div>
                    
                    <!-- Channels Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($channels as $channel)
                            <a href="{{ route('channel', $channel->handle) }}" class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden hover:bg-neutral-700/50 transition-colors">
                                <div class="relative">
                                    @if($channel->banner_image)
                                        <div class="h-32 overflow-hidden">
                                            <img src="{{ \App\Http\Controllers\IndexController::thumbnailUrl($channel->banner_image, 'medium') }}" 
                                                alt="{{ $channel->channel_name }}" class="w-full h-full object-cover" loading="lazy">
                                        </div>
                                    @else
                                        <div class="h-32 bg-blue-500/20 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute -bottom-8 left-4">
                                        @if($channel->profile_image)
                                            <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-neutral-800">
                                                <img src="{{ \App\Http\Controllers\IndexController::thumbnailUrl($channel->profile_image, 'small') }}" 
                                                    alt="{{ $channel->channel_name }}" class="w-full h-full object-cover" loading="lazy">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-full bg-blue-500/20 flex items-center justify-center border-2 border-neutral-800">
                                                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="pt-10 p-4">
                                    <h3 class="font-medium text-lg mb-1 truncate">{{ $channel->channel_name }}</h3>
                                    <div class="flex items-center text-sm text-neutral-400">
                                        <span>@{{ $channel->handle }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ number_format($channel->videos_count) }} videos</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @elseif($type == 'channels' && count($channels) == 0)
                <div class="text-center py-12 mb-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                        <i class="fas fa-tv text-2xl text-neutral-600"></i>
                    </div>
                    <h3 class="text-lg font-medium mb-2">No Channels Found</h3>
                    <p class="text-neutral-400">We couldn't find any channels matching your search.</p>
                </div>
            @endif
        @endif
        
        @if($type == 'all' || $type == 'actors')
            @if(count($actors) > 0)
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold">Actors</h2>
                        @if(count($actors) >= 4 && $type == 'all')
                            <a href="{{ route('search', ['q' => $query, 'type' => 'actors']) }}" class="text-sm text-red-500 hover:text-red-400 transition-colors flex items-center">
                                View all <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        @endif
                    </div>
                    
                    <!-- Actors Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                        @foreach($actors as $actor)
                            <a href="{{ route('actor', $actor->slug) }}" class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden hover:bg-neutral-700/50 transition-colors group">
                                <div class="relative">
                                    @if($actor->profile_image)
                                        <div class="aspect-square overflow-hidden">
                                            <img src="{{ \App\Http\Controllers\IndexController::thumbnailUrl($actor->profile_image, 'medium') }}" 
                                                alt="{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}" 
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                        </div>
                                    @else
                                        <div class="aspect-square bg-neutral-700 flex items-center justify-center">
                                            <div class="w-20 h-20 rounded-full bg-yellow-500/20 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-4">
                                    <h3 class="font-medium text-neutral-100 text-lg truncate">{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}</h3>
                                    <div class="flex items-center mt-2">
                                        <svg class="w-4 h-4 text-neutral-400 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-sm text-neutral-400">{{ number_format($actor->videos_count) }} videos</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @elseif($type == 'actors' && count($actors) == 0)
                <div class="text-center py-12 mb-8">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                        <i class="fas fa-user text-2xl text-neutral-600"></i>
                    </div>
                    <h3 class="text-lg font-medium mb-2">No Actors Found</h3>
                    <p class="text-neutral-400">We couldn't find any actors matching your search.</p>
                </div>
            @endif
        @endif
        
        @if($type == 'all' && count($videos) == 0 && count($channels) == 0 && count($actors) == 0)
            <div class="text-center py-12 mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-neutral-800 flex items-center justify-center">
                    <i class="fas fa-search text-2xl text-neutral-600"></i>
                </div>
                <h3 class="text-lg font-medium mb-2">No Results Found</h3>
                <p class="text-neutral-400">We couldn't find anything matching your search.</p>
            </div>
        @endif

        <!-- Pagination -->
        @if (($type == 'videos' && $videos instanceof \Illuminate\Pagination\LengthAwarePaginator && $videos->hasPages()) || 
             ($type == 'channels' && $channels instanceof \Illuminate\Pagination\LengthAwarePaginator && $channels->hasPages()) || 
             ($type == 'actors' && $actors instanceof \Illuminate\Pagination\LengthAwarePaginator && $actors->hasPages()))
            <div class="mt-8 pagination-container">
                @if($type == 'videos')
                    {{ $videos->appends(['q' => $query, 'type' => $type])->links() }}
                @elseif($type == 'channels')
                    {{ $channels->appends(['q' => $query, 'type' => $type])->links() }}
                @elseif($type == 'actors')
                    {{ $actors->appends(['q' => $query, 'type' => $type])->links() }}
                @endif
            </div>
        @endif
    </div>
@endsection
