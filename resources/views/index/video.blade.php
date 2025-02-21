@extends('layouts.index')

@section('title', $video->title ?? 'Video Not Found')

@section('content')
<!-- Main Content with Right Sidebar Layout -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-16">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Video Content -->
        <div class="flex-1">
            <!-- Video Player -->
            <div class="w-full aspect-video bg-neutral-800 rounded-lg mb-4">
                <video class="w-full h-full rounded-lg" controls>
                    <source src="#" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Video Info -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h1 class="text-2xl font-bold mb-2">Awesome Video Title</h1>
                <div class="flex items-center justify-between mb-6">
                    <div class="text-neutral-400 text-sm">
                        <span>1.2M views</span>
                        <span class="mx-2">•</span>
                        <span>2 days ago</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors">
                            <i class="fas fa-thumbs-up"></i>
                            <span>12K</span>
                        </button>
                        <button class="flex items-center space-x-2 text-neutral-100 hover:text-red-500 transition-colors">
                            <i class="fas fa-thumbs-down"></i>
                            <span>24</span>
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
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Categories:</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="#" class="flex items-center space-x-2 text-sm hover:text-red-500 transition-colors">
                                <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-colors">
                                    <span class="text-red-500 text-sm">#</span>
                                </div>
                                <span>Action</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 text-sm hover:text-red-500 transition-colors">
                                <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-colors">
                                    <span class="text-red-500 text-sm">#</span>
                                </div>
                                <span>Adventure</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 text-sm hover:text-red-500 transition-colors">
                                <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-colors">
                                    <span class="text-red-500 text-sm">#</span>
                                </div>
                                <span>Drama</span>
                            </a>
                        </div>
                    </div>

                    <!-- Actors -->
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Actors:</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="#" class="flex items-center space-x-3 group">
                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden">
                                    <img src="https://picsum.photos/32/32" alt="Actor 1" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm group-hover:text-red-500 transition-colors">John Doe</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 group">
                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden">
                                    <img src="https://picsum.photos/32/32" alt="Actor 2" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm group-hover:text-red-500 transition-colors">Jane Smith</span>
                            </a>
                        </div>
                    </div>

                    <!-- Channels -->
                    <div class="flex">
                        <h3 class="text-sm font-semibold text-neutral-400 mr-2">Channels:</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="#" class="flex items-center space-x-3 group">
                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden">
                                    <img src="https://picsum.photos/32/32" alt="Channel 1" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm group-hover:text-red-500 transition-colors">MovieMasters</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 group">
                                <div class="w-8 h-8 rounded-full bg-neutral-600 overflow-hidden">
                                    <img src="https://picsum.photos/32/32" alt="Channel 2" class="w-full h-full object-cover">
                                </div>
                                <span class="text-sm group-hover:text-red-500 transition-colors">CinemaWorld</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Videos Section -->
            <div class="mt-8">
                <h2 class="text-xl font-bold mb-4">Related Videos</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Related Video Card -->
                    <div class="video-card group">
                        <div class="thumbnail-wrapper relative aspect-video rounded-xl overflow-hidden mb-3">
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

                    <!-- More Related Video Cards -->
                    <div class="video-card group">
                        <div class="thumbnail-wrapper relative aspect-video rounded-xl overflow-hidden mb-3">
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

                    <div class="video-card group">
                        <div class="thumbnail-wrapper relative aspect-video rounded-xl overflow-hidden mb-3">
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
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="lg:w-96">
            <div class="sticky top-24">
                <h2 class="text-xl font-bold mb-4">Recommended</h2>
                
                <!-- Recommended Videos -->
                <div class="space-y-2">
                    <!-- Recommended Video -->
                    <div class="video-card group hover:bg-neutral-800/30 rounded-xl p-2 transition-colors">
                        <div class="flex items-start">
                            <div class="thumbnail-wrapper relative w-40 aspect-video rounded-lg overflow-hidden">
                                <img src="https://picsum.photos/401/225" alt="Video thumbnail" class="thumbnail w-full h-full object-cover">
                                <span class="duration absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/90 text-xs font-medium rounded">12:34</span>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="play-icon absolute top-1/2 left-1/2 w-8 h-8 -translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-sm text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 ml-3">
                                <h3 class="title text-sm font-medium line-clamp-2 mb-1.5 group-hover:text-red-500 transition-colors">Amazing Video Title That Might Be Long and Span Multiple Lines</h3>
                                <div class="flex items-center space-x-2 text-xs text-neutral-400">
                                    <div class="flex items-center">
                                        <span>1.2M views</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center">
                                        <span>2 days ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Video -->
                    <div class="video-card group hover:bg-neutral-800/30 rounded-xl p-2 transition-colors">
                        <div class="flex items-start">
                            <div class="thumbnail-wrapper relative w-40 aspect-video rounded-lg overflow-hidden">
                                <img src="https://picsum.photos/402/225" alt="Video thumbnail" class="thumbnail w-full h-full object-cover">
                                <span class="duration absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/90 text-xs font-medium rounded">8:45</span>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="play-icon absolute top-1/2 left-1/2 w-8 h-8 -translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-sm text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 ml-3">
                                <h3 class="title text-sm font-medium line-clamp-2 mb-1.5 group-hover:text-red-500 transition-colors">Another Great Video Title That Could Be Long</h3>
                                <div class="flex items-center space-x-2 text-xs text-neutral-400">
                                    <div class="flex items-center">
                                        <span>856K views</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center">
                                        <span>5 days ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommended Video -->
                    <div class="video-card group hover:bg-neutral-800/30 rounded-xl p-2 transition-colors">
                        <div class="flex items-start">
                            <div class="thumbnail-wrapper relative w-40 aspect-video rounded-lg overflow-hidden">
                                <img src="https://picsum.photos/403/225" alt="Video thumbnail" class="thumbnail w-full h-full object-cover">
                                <span class="duration absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/90 text-xs font-medium rounded">15:20</span>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="play-icon absolute top-1/2 left-1/2 w-8 h-8 -translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-sm text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 ml-3">
                                <h3 class="title text-sm font-medium line-clamp-2 mb-1.5 group-hover:text-red-500 transition-colors">Trending Video Title With Long Description</h3>
                                <div class="flex items-center space-x-2 text-xs text-neutral-400">
                                    <div class="flex items-center">
                                        <span>2.5M views</span>
                                    </div>
                                    <span>•</span>
                                    <div class="flex items-center">
                                        <span>1 day ago</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection