@extends('layouts.index')

@section('title', $category->name)
@section('meta_description', $category->description)

@section('content')
    <!-- Category Header -->
    <section class="py-8">
        <div class="nx-container">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center">
                    <span class="text-red-500 text-2xl">#</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ $category->name }}</h1>
                    <p class="text-neutral-400">{{ $videos->total() }} videos</p>
                </div>
            </div>

            <!-- Videos Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($videos as $video)
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
                        <h3 class="text-lg font-medium mb-2">No Videos Found</h3>
                        <p class="text-neutral-400">There are no videos in this category yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($videos->hasPages())
                <div class="mt-8 pagination-container">
                    {{ $videos->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
