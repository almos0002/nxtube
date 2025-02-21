@extends('layouts.admin')
@section('content')
    <!-- Main Content -->
    <div class="p-8">
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
                <a href="{{ route('add-video') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                    <i class="fa-duotone fa-thin fa-plus mr-2"></i>
                    Add Video
                </a>
                <form action="{{ route('videos') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Search videos..." value="{{ request('search') }}"
                           class="px-4 py-2.5 pl-10 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                    <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-neutral-300 transition-colors">
                        <i class="fa-duotone fa-thin fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Video Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ $total }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-video text-blue-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-neutral-500 text-sm flex items-center gap-1">
                    <i class="fa-duotone fa-thin fa-chart-line text-blue-400"></i>
                    <span class="text-blue-400 font-medium">{{ number_format($views_per_video) }}</span>
                    average views
                </p>
            </div>

            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Published Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ $active }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-neutral-500 text-sm flex items-center gap-1">
                    <i class="fa-duotone fa-thin fa-arrow-trend-up text-green-400"></i>
                    <span class="text-green-400 font-medium">{{ $active_percentage }}%</span>
                    of total videos
                </p>
            </div>

            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Draft Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ $processing }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-clock text-yellow-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-neutral-500 text-sm flex items-center gap-1">
                    <i class="fa-duotone fa-thin fa-arrow-trend-up text-yellow-400"></i>
                    <span class="text-yellow-400 font-medium">{{ $processing_percentage }}%</span>
                    of total videos
                </p>
            </div>

            <div class="video-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Views</p>
                        <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($total_views) }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-eye text-purple-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-neutral-500 text-sm flex items-center gap-1">
                    <i class="fa-duotone fa-thin fa-chart-mixed text-purple-400"></i>
                    <span class="text-purple-400 font-medium">All time</span>
                    views count
                </p>
            </div>
        </div>

        <!-- Video List -->
        <div class="space-y-4">
            @foreach($videos as $video)
            <!-- Video Item -->
            <div class="bg-neutral-800 rounded-xl p-4 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-start space-x-4">
                    <!-- Thumbnail -->
                    <div class="relative w-64 flex-shrink-0 overflow-hidden rounded-lg">
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-500">
                        <span class="absolute bottom-2 right-2 px-2.5 py-1 bg-black/80 text-white text-xs font-medium rounded-md backdrop-blur-sm">
                            @php
                                $duration = explode(':', $video->duration);
                                if (count($duration) === 3) {
                                    if ($duration[0] !== '00') {
                                        echo $video->duration;
                                    } else {
                                        echo $duration[1] . ':' . $duration[2];
                                    }
                                } else {
                                    echo $video->duration;
                                }
                            @endphp
                        </span>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-grow min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="text-neutral-100 font-semibold text-lg group-hover:text-red-500 transition-colors duration-200">{{ $video->title }}</h4>
                                <div class="flex items-center space-x-3 mt-2 text-sm">
                                    <span class="text-neutral-400">{{ $video->videoStats->views_count ?? 0 }} views</span>
                                    <span class="text-neutral-500">•</span>
                                    <span class="text-neutral-400">{{ $video->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('edit-video', $video->id) }}" class="p-2 rounded-lg bg-neutral-700/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('delete-video', $video->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-neutral-700/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Meta Information -->
                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <!-- Channel -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Channel :</span>
                                <div class="flex items-center space-x-2">
                                    @foreach($video->channels as $channel)
                                        <img src="{{ asset('storage/' . $channel->profile_image) }}" class="w-6 h-6 rounded-full" alt="{{ $channel->channel_name }} Avatar">
                                        <span class="text-neutral-300">{{ $channel->channel_name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Actors -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Actors :</span>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2 mr-3">
                                        @foreach($video->actors as $actor)
                                            <img src="{{ asset('storage/' . $actor->profile_image) }}" class="w-6 h-6 rounded-full ring-2 ring-neutral-800" alt="{{ $actor->stagename }}">
                                        @endforeach
                                    </div>
                                    <span class="text-neutral-300">{{ $video->actors->pluck('stagename')->join(', ') }}</span>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-neutral-500 uppercase">Status :</span>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 {{ $video->visibility->value === 'public' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }} rounded-lg text-xs">
                                        {{ ucfirst($video->visibility->value) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories -->
                        <div class="flex flex-wrap gap-3 mt-4">
                            <span class="text-xs text-neutral-500 uppercase mr-2">Categories:</span>
                            <div class="flex flex-wrap gap-3">
                                @foreach($video->categories as $category)
                                <div class="flex items-center space-x-1">
                                    <div class="w-6 h-6 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                                        <span class="text-red-500 text-sm font-semibold">#</span>
                                    </div>
                                    <span class="text-neutral-300 text-sm">{{ $category->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">
                Showing {{ $videos->firstItem() }}-{{ $videos->lastItem() }} of {{ $videos->total() }} videos
            </p>
            {{ $videos->links() }}
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
@endsection