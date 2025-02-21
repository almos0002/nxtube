@extends('layouts.index')
@section('content')
<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-16">
    <!-- Featured Section -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Featured Videos</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Video Cards -->
                <div class="video-card group">
                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                        <img src="https://picsum.photos/400/225" alt="Video thumbnail" class="thumbnail w-full h-full object-cover">
                        <span class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">12:34</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="play-icon absolute top-1/2 left-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="metadata space-y-1">
                        <h3 class="title text-sm font-medium line-clamp-2">Amazing Video Title That Might Be Long and Span Multiple Lines</h3>
                        <div class="flex items-center text-xs text-neutral-400">
                            <span>1.2M views</span>
                            <span class="mx-1">•</span>
                            <span>2 days ago</span>
                        </div>
                    </div>
                </div>
                <!-- Repeat video cards with different images and titles -->
                <div class="video-card group">
                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                        <img src="https://picsum.photos/401/225" alt="Video thumbnail" class="thumbnail w-full h-full object-cover">
                        <span class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">8:45</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="play-icon absolute top-1/2 left-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="metadata space-y-1">
                        <h3 class="title text-sm font-medium line-clamp-2">Epic Adventure Video</h3>
                        <div class="flex items-center text-xs text-neutral-400">
                            <span>856K views</span>
                            <span class="mx-1">•</span>
                            <span>5 days ago</span>
                        </div>
                    </div>
                </div>
                <!-- More video cards... -->
            </div>
        </div>
    </section>

    <!-- Trending Section -->
    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Trending Now</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Video Cards -->
                <div class="video-card group">
                    <div class="thumbnail-wrapper relative aspect-video mb-3">
                        <img src="https://picsum.photos/402/225" alt="Video thumbnail" class="thumbnail w-full h-full object-cover">
                        <span class="duration absolute bottom-2 right-2 px-2 py-1 bg-black/90 text-xs rounded-md font-medium">15:20</span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="play-icon absolute top-1/2 left-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="metadata space-y-1">
                        <h3 class="title text-sm font-medium line-clamp-2">Trending Video Title</h3>
                        <div class="flex items-center text-xs text-neutral-400">
                            <span>2.5M views</span>
                            <span class="mx-1">•</span>
                            <span>1 day ago</span>
                        </div>
                    </div>
                </div>
                <!-- More video cards... -->
            </div>
        </div>
    </section>
</main>
@endsection