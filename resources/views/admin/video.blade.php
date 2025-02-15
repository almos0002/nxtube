@extends('layouts.admin')
@section('content')
    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
            <div class="flex items-center">
                <button class="md:hidden mr-4" onclick="toggleSidebar()">
                    <i class="fa-duotone fa-thin fa-bars text-neutral-300"></i>
                </button>
                <div>
                    <h2 class="text-2xl font-bold text-neutral-100">Video Management</h2>
                    <p class="text-neutral-400">Upload and manage your video content</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                    <i class="fa-duotone fa-thin fa-plus mr-2"></i>
                    Upload Video
                </button>
                <div class="relative">
                    <input type="text" placeholder="Search videos..." 
                           class="px-4 py-2 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                    <i class="fa-duotone fa-thin fa-magnifying-glass absolute right-3 top-3.5 text-neutral-400"></i>
                </div>
            </div>
        </header>

        <!-- Video Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">1,234</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-video text-blue-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 12%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Active Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">1,156</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 8%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Processing</p>
                        <h3 class="text-2xl font-bold text-neutral-100">45</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-clock text-yellow-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-red-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 15%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Failed</p>
                        <h3 class="text-2xl font-bold text-neutral-100">33</h3>
                    </div>
                    <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-exclamation-circle text-red-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-down mr-1"></i> 5%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>
        </div>

        <!-- Video List -->
        <div class="space-y-4">
            <!-- Video Item 1 -->
            <div class="bg-neutral-800 rounded-xl p-4 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-start space-x-4">
                    <!-- Thumbnail -->
                    <div class="relative w-64 flex-shrink-0 overflow-hidden rounded-lg">
                        <img src="https://picsum.photos/400/225" class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-500">
                        <span class="absolute bottom-2 right-2 px-2.5 py-1 bg-black/80 text-white text-xs font-medium rounded-md backdrop-blur-sm">15:20</span>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-grow min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-neutral-100 font-semibold text-lg group-hover:text-red-500 transition-colors duration-200">Getting Started with Web Development</h4>
                                <div class="flex items-center space-x-3 mt-2 text-sm">
                                    <span class="text-neutral-400">2.1K views</span>
                                    <span class="text-neutral-500">•</span>
                                    <span class="text-neutral-400">2 hours ago</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 rounded-lg bg-neutral-700/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 rounded-lg bg-neutral-700/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Meta Information -->
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <!-- Channel -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Channel :</span>
                                <div class="flex items-center space-x-2">
                                    <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full" alt="Channel Avatar">
                                    <span class="text-neutral-300">Code Masters</span>
                                </div>
                            </div>
                            
                            <!-- Actors -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Actors :</span>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2 mr-3">
                                        <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="Actor 1">
                                        <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="Actor 2">
                                    </div>
                                    <span class="text-neutral-300">John Smith, Jane Doe</span>
                                </div>
                            </div>
                            
                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Status :</span>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-lg font-xs">Published</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories and Tags -->
                        <div class="flex flex-wrap gap-3 mt-4">
                            <span class="text-xs text-neutral-500 uppercase mr-2">Categories:</span>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Web Development</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Tutorial</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Programming</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Item 2 -->
            <div class="bg-neutral-800 rounded-xl p-4 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-start space-x-4">
                    <!-- Thumbnail -->
                    <div class="relative w-64 flex-shrink-0 overflow-hidden rounded-lg">
                        <img src="https://picsum.photos/400/225" class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-500">
                        <span class="absolute bottom-2 right-2 px-2.5 py-1 bg-black/80 text-white text-xs font-medium rounded-md backdrop-blur-sm">08:45</span>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-grow min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-neutral-100 font-semibold text-lg group-hover:text-red-500 transition-colors duration-200">Top 10 Gaming Moments</h4>
                                <div class="flex items-center space-x-3 mt-2 text-sm">
                                    <span class="text-neutral-400">8.7K views</span>
                                    <span class="text-neutral-500">•</span>
                                    <span class="text-neutral-400">5 days ago</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 rounded-lg bg-neutral-700/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 rounded-lg bg-neutral-700/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Meta Information -->
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <!-- Channel -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Channel :</span>
                                <div class="flex items-center space-x-2">
                                    <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full" alt="Channel Avatar">
                                    <span class="text-neutral-300">Gaming Hub</span>
                                </div>
                            </div>
                            
                            <!-- Actors -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Actors :</span>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2 mr-3">
                                        <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="Actor 1">
                                        <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="Actor 2">
                                    </div>
                                    <span class="text-neutral-300">Jane Smith</span>
                                </div>
                            </div>
                            
                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Status :</span>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded-lg font-xs">Draft</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories and Tags -->
                        <div class="flex flex-wrap gap-3 mt-4">
                            <span class="text-xs text-neutral-500 uppercase mr-2">Categories:</span>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Gaming</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Entertainment</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Top 10</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Item 3 -->
            <div class="bg-neutral-800 rounded-xl p-4 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-start space-x-4">
                    <!-- Thumbnail -->
                    <div class="relative w-64 flex-shrink-0 overflow-hidden rounded-lg">
                        <img src="https://picsum.photos/400/225" class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-500">
                        <span class="absolute bottom-2 right-2 px-2.5 py-1 bg-black/80 text-white text-xs font-medium rounded-md backdrop-blur-sm">12:30</span>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-grow min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-neutral-100 font-semibold text-lg group-hover:text-red-500 transition-colors duration-200">Music Production Basics</h4>
                                <div class="flex items-center space-x-3 mt-2 text-sm">
                                    <span class="text-neutral-400">5.1K views</span>
                                    <span class="text-neutral-500">•</span>
                                    <span class="text-neutral-400">1 week ago</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 rounded-lg bg-neutral-700/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button class="p-2 rounded-lg bg-neutral-700/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Meta Information -->
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <!-- Channel -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Channel :</span>
                                <div class="flex items-center space-x-2">
                                    <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full" alt="Channel Avatar">
                                    <span class="text-neutral-300">Music Academy</span>
                                </div>
                            </div>
                            
                            <!-- Actors -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Actors :</span>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2 mr-3">
                                        <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="Actor 1">
                                        <img src="https://picsum.photos/400/225" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="Actor 2">
                                    </div>
                                    <span class="text-neutral-300">Mike Johnson</span>
                                </div>
                            </div>
                            
                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Status :</span>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-lg font-xs">Published</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories and Tags -->
                        <div class="flex flex-wrap gap-3 mt-4">
                            <span class="text-xs text-neutral-500 uppercase mr-2">Categories:</span>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Music</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Production</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">Tutorial</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">Showing 1-9 of 1,234 videos</p>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600">
                    <i class="fa-duotone fa-thin fa-chevron-left"></i>
                </button>
                <button class="px-3 py-1 bg-red-500 text-white rounded-lg">1</button>
                <button class="px-3 py-1 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600">2</button>
                <button class="px-3 py-1 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600">3</button>
                <button class="px-3 py-1 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600">
                    <i class="fa-duotone fa-thin fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('md:translate-x-0');
        }
    </script>
    @endsection