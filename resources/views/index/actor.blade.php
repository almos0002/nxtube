@extends('layouts.index')

@section('title', $actor->name ?? 'Actor Not Found')

@section('content')
 <!-- Main Content -->
 <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-16">
    <!-- Actor Profile Header -->
    <section class="relative">
        <!-- Banner Image -->
        <div class="h-80 w-full rounded-2xl overflow-hidden">
            <img src="https://placehold.co/1920x1080/363636/FFFFFF/webp" class="w-full h-full object-cover" alt="Actor Banner">
        </div>
        
        <!-- Actor Info Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-neutral-900 via-neutral-900/80 to-transparent">
            <div class="flex items-center space-x-6">
                <img src="https://placehold.co/200x200/404040/FFFFFF/webp" class="w-32 h-32 rounded-2xl border-4 border-neutral-100 shadow-xl" alt="Actor Profile">
                <div class="flex-1">
                    <div class="flex items-center space-x-4 mb-2">
                        <h1 class="text-3xl font-bold">John Smith</h1>
                        <span class="px-3 py-1 rounded-lg bg-neutral-800/90 text-sm backdrop-blur-sm">
                            <i class="fas fa-mars text-blue-400 mr-1"></i>
                            Actor
                        </span>
                    </div>
                    <p class="text-neutral-300 text-lg mb-4">Tech Reviewer & Content Creator</p>
                    <div class="flex items-center space-x-6 text-neutral-400">
                        <span><i class="fas fa-video mr-2"></i>48 Videos</span>
                        <span><i class="fas fa-eye mr-2"></i>1.2M Views</span>
                        <span><i class="fas fa-users mr-2"></i>250K Followers</span>
                    </div>
                </div>
                <button class="px-6 py-3 bg-red-500 hover:bg-red-600 rounded-xl text-white font-medium transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>Follow
                </button>
            </div>
        </div>
    </section>

    <!-- Actor Bio -->
    <section class="py-8">
        <div class="bg-neutral-800/30 rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">About</h2>
            <p class="text-neutral-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="mt-6 flex items-center space-x-4">
                <a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Videos Section -->
    <section class="py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Videos</h2>
            <div class="flex items-center space-x-4">
                <select class="bg-neutral-800 text-neutral-100 rounded-lg px-4 py-2 border border-neutral-700">
                    <option>Latest</option>
                    <option>Most Viewed</option>
                    <option>Most Liked</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Video Card -->
            <div class="video-card group">
                <div class="thumbnail-wrapper relative mb-4">
                    <img src="https://placehold.co/1280x720/363636/FFFFFF/webp" class="thumbnail w-full rounded-xl" alt="Video Thumbnail">
                    <div class="play-icon absolute top-1/2 left-1/2 w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-play text-white"></i>
                    </div>
                    <span class="duration absolute bottom-2 right-2 px-2 py-1 bg-neutral-900/90 text-white text-sm rounded-md">12:34</span>
                </div>
                <h3 class="title font-medium mb-2 line-clamp-2">Amazing Tech Review 2025 - Must Watch!</h3>
                <div class="metadata text-sm text-neutral-400">
                    <span>1.2M views</span>
                    <span class="mx-2">•</span>
                    <span>2 days ago</span>
                </div>
            </div>
            <!-- More video cards... -->
        </div>
        <!-- Load More Button -->
        <div class="text-center mt-8">
            <button class="px-6 py-3 bg-neutral-800 hover:bg-neutral-700 rounded-xl text-white font-medium transition-colors">
                Load More Videos
            </button>
        </div>
    </section>
</main>
@endsection