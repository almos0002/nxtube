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
                    <h2 class="text-2xl font-bold text-neutral-100">Dashboard</h2>
                    <p class="text-neutral-400">Overview of your content</p>
                </div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <!-- Total Videos -->
            <div class="bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($totalVideos) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-video text-blue-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-{{ $videosGrowth >= 0 ? 'green' : 'red' }}-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $videosGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ abs(round($videosGrowth)) }}%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <!-- Total Views -->
            <div class="bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Views</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($totalViews) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-eye text-green-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-{{ $viewsGrowth >= 0 ? 'green' : 'red' }}-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $viewsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ abs(round($viewsGrowth)) }}%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Categories</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($totalCategories) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-folder text-purple-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-{{ $categoriesGrowth >= 0 ? 'green' : 'red' }}-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $categoriesGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ abs(round($categoriesGrowth)) }}%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <!-- Total Actors -->
            <div class="bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Actors</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($totalActors) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-user text-yellow-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-{{ $actorsGrowth >= 0 ? 'green' : 'red' }}-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $actorsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ abs(round($actorsGrowth)) }}%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <!-- Total Channels -->
            <div class="bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Channels</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($totalChannels) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-tv text-red-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-{{ $channelsGrowth >= 0 ? 'green' : 'red' }}-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $channelsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ abs(round($channelsGrowth)) }}%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Videos -->
            <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Recent Videos</h3>
                    <a href="{{ route('videos') }}" class="text-sm text-red-500 hover:text-red-400">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($recentVideos as $video)
                    <div class="group flex items-center space-x-4 p-4 bg-neutral-700/30 rounded-lg hover:bg-neutral-700/50 transition-all duration-300">
                        <div class="relative flex-shrink-0">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" 
                                 class="w-32 h-20 object-cover rounded-lg transform group-hover:scale-105 transition-all duration-300">
                            <span class="absolute bottom-1.5 right-1.5 px-1.5 py-0.5 bg-black/70 text-white text-xs rounded">{{ $video->duration }}</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h4 class="text-neutral-100 font-medium truncate group-hover:text-red-500 transition-colors">{{ $video->title }}</h4>
                            <div class="flex items-center space-x-3 mt-1">
                                <p class="text-neutral-400 text-sm truncate">{{ $video->channels->pluck('channel_name')->implode(', ') }}</p>
                                <span class="text-neutral-500">•</span>
                                <span class="text-neutral-400 text-sm">{{ $video->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('edit-video', $video->id) }}" class="text-neutral-400 hover:text-red-500 transition-colors">
                                <i class="fa-duotone fa-thin fa-edit text-lg"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Popular Videos -->
            <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Popular Videos</h3>
                    <a href="{{ route('videos') }}" class="text-sm text-red-500 hover:text-red-400">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($popularVideos as $video)
                    <div class="group flex items-center space-x-4 p-4 bg-neutral-700/30 rounded-lg hover:bg-neutral-700/50 transition-all duration-300">
                        <div class="relative flex-shrink-0">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" 
                                 class="w-32 h-20 object-cover rounded-lg transform group-hover:scale-105 transition-all duration-300">
                            <span class="absolute bottom-1.5 right-1.5 px-1.5 py-0.5 bg-black/70 text-white text-xs rounded">{{ $video->duration }}</span>
                        </div>
                        <div class="flex-grow min-w-0">
                            <h4 class="text-neutral-100 font-medium truncate group-hover:text-red-500 transition-colors">{{ $video->title }}</h4>
                            <div class="flex items-center space-x-3 mt-1">
                                <p class="text-neutral-400 text-sm truncate">{{ $video->channels->pluck('channel_name')->implode(', ') }}</p>
                                <span class="text-neutral-500">•</span>
                                <div class="flex items-center text-neutral-400 text-sm">
                                    <i class="fa-duotone fa-thin fa-eye mr-1"></i>
                                    {{ number_format($video->videoStats->views_count) }}
                                </div>
                            </div>
                        </div>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('edit-video', $video->id) }}" class="text-neutral-400 hover:text-red-500 transition-colors">
                                <i class="fa-duotone fa-thin fa-edit text-lg"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection