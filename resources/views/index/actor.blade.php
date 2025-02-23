@extends('layouts.index')

@section('title', $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname)
@section('meta_description', $actor->biography)
@section('meta_keywords', $actor->specialties)
@section('og_image', asset('storage/' . $actor->banner_image))

@section('content')
<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-16">
    <!-- Actor Profile Header -->
    <section class="relative">
        <!-- Banner Image -->
        <div class="h-80 w-full rounded-2xl overflow-hidden">
            <img src="{{ asset('storage/' . ($actor->banner_image ?? 'actors/banner-default.jpg')) }}" 
                 class="w-full h-full object-cover" 
                 alt="{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }} Banner">
        </div>
        
        <!-- Actor Info Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-neutral-900 via-neutral-900/80 to-transparent">
            <div class="flex items-center space-x-6">
                <img src="{{ asset('storage/' . ($actor->profile_image ?? 'actors/default.jpg')) }}" 
                     class="w-32 h-32 rounded-2xl border-4 border-neutral-100 shadow-xl" 
                     alt="{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}">
                <div class="flex-1">
                    <div class="flex items-center space-x-4 mb-2">
                        <h1 class="text-3xl font-bold">{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}</h1>
                        <span class="px-3 py-1 rounded-lg bg-neutral-800/90 text-sm backdrop-blur-sm">
                            <i class="fas fa-user text-neutral-400 mr-1"></i>
                            {{ $actor->type }}
                        </span>
                    </div>
                    @if($actor->specialties)
                    <p class="text-neutral-300 text-lg mb-4">{{ $actor->specialties }}</p>
                    @endif
                    <div class="flex items-center space-x-6 text-neutral-400">
                        <span><i class="fas fa-video mr-2"></i>{{ $videos->total() }} Videos</span>
                        <span><i class="fas fa-eye mr-2"></i>{{ number_format($actor->actorStats?->views_count ?? 0) }} Views</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Actor Bio -->
    @if($actor->biography)
    <section class="py-8">
        <div class="bg-neutral-800/30 rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">About</h2>
            <p class="text-neutral-300">{{ $actor->biography }}</p>
        </div>
    </section>
    @endif

    <!-- Actor's Videos -->
    <section class="py-8">
        <h2 class="text-2xl font-bold mb-6">Videos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($videos as $video)
            <div class="video-card group">
                <a href="{{ route('video', $video->slug) }}" class="block">
                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                        <img src="{{ asset('storage/' . ($video->thumbnail ?? 'thumbnails/default.jpg')) }}" 
                             alt="{{ $video->title }}" 
                             class="thumbnail w-full h-full object-cover">
                        <span class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">{{ $video->duration }}</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="play-icon absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
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
                <h3 class="text-lg font-medium mb-2">No Videos Found</h3>
                <p class="text-neutral-400">This actor hasn't uploaded any videos yet.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($videos->hasPages())
        <div class="mt-8">
            {{ $videos->links() }}
        </div>
        @endif
    </section>
</main>
@endsection