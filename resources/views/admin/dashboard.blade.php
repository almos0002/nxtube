@extends('layouts.admin')

@section('content')
<div class="p-8">
    <!-- Quick Actions -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-neutral-100">Quick Actions</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('add-video') }}" class="bg-neutral-800 p-4 rounded-xl flex items-center space-x-3 hover:bg-neutral-700/50 transition-colors">
                <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-plus text-orange-500"></i>
                </div>
                <span class="text-neutral-100">Add Video</span>
            </a>
            <a href="{{ route('add-category') }}" class="bg-neutral-800 p-4 rounded-xl flex items-center space-x-3 hover:bg-neutral-700/50 transition-colors">
                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-plus text-purple-500"></i>
                </div>
                <span class="text-neutral-100">Add Category</span>
            </a>
            <a href="{{ route('add-actor') }}" class="bg-neutral-800 p-4 rounded-xl flex items-center space-x-3 hover:bg-neutral-700/50 transition-colors">
                <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-plus text-yellow-500"></i>
                </div>
                <span class="text-neutral-100">Add Actor</span>
            </a>
            <a href="{{ route('add-channel') }}" class="bg-neutral-800 p-4 rounded-xl flex items-center space-x-3 hover:bg-neutral-700/50 transition-colors">
                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-plus text-blue-500"></i>
                </div>
                <span class="text-neutral-100">Add Channel</span>
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
        <!-- Total Videos -->
        <div class="bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-neutral-400 text-sm">Total Videos</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ number_format($totalVideos) }}</h3>
                </div>
                <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-video text-orange-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-{{ $videosGrowth >= 0 ? 'orange' : 'red' }}-400 flex items-center">
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
                <div class="w-12 h-12 bg-lime-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-eye text-lime-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-{{ $viewsGrowth >= 0 ? 'lime' : 'red' }}-400 flex items-center">
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
                <span class="text-{{ $categoriesGrowth >= 0 ? 'purple' : 'red' }}-400 flex items-center">
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
                <span class="text-{{ $actorsGrowth >= 0 ? 'yellow' : 'red' }}-400 flex items-center">
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
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-tv text-blue-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-{{ $channelsGrowth >= 0 ? 'blue' : 'red' }}-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-{{ $channelsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                    {{ abs(round($channelsGrowth)) }}%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Views Analytics -->
            <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Views Analytics</h3>
                    <select id="viewsPeriod" class="bg-neutral-700 text-neutral-300 text-sm rounded-lg px-3 py-2 border-0 focus:ring-2 focus:ring-red-500">
                        <option value="7">Last 7 days</option>
                        <option value="30" selected>Last 30 days</option>
                        <option value="90">Last 90 days</option>
                    </select>
                </div>
                <div class="relative h-64">
                    <canvas id="viewsChart"></canvas>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="bg-neutral-700/30 p-4 rounded-lg">
                        <p class="text-neutral-400 text-sm">Total Views</p>
                        <h4 class="text-xl font-semibold text-neutral-100 mt-1">{{ number_format($totalViews) }}</h4>
                        <div class="flex items-center mt-2">
                            <span class="text-{{ $viewsGrowth >= 0 ? 'green' : 'red' }}-400 text-sm flex items-center">
                                <i class="fa-duotone fa-thin fa-arrow-{{ $viewsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ abs(round($viewsGrowth)) }}%
                            </span>
                            <span class="text-neutral-500 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                    <div class="bg-neutral-700/30 p-4 rounded-lg">
                        <p class="text-neutral-400 text-sm">Avg. Daily Views</p>
                        <h4 class="text-xl font-semibold text-neutral-100 mt-1">{{ number_format($totalViews / 30) }}</h4>
                        <p class="text-neutral-500 text-sm mt-2">Last 30 days</p>
                    </div>
                </div>
            </div>

            <!-- Upload Trends -->
            <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-6">Upload Trends</h3>
                <div class="relative h-48">
                    <canvas id="uploadTrendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Top Performers Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Top Categories -->
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-neutral-100 mb-4">Top Categories</h3>
                    <div class="space-y-4">
                        @foreach($topCategories as $category)
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-300">{{ $category->name }}</span>
                            <span class="text-neutral-400 text-sm"><i class="fa-duotone fa-thin fa-video mr-2"></i>{{ $category->videos_count }} videos</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Actors -->
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-neutral-100 mb-4">Top Actors</h3>
                    <div class="space-y-4">
                        @foreach($topActors as $actor)
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-300">{{ $actor->stagename ?: $actor->firstname . ' ' . $actor->lastname }}</span>
                            <span class="text-neutral-400 text-sm"><i class="fa-duotone fa-thin fa-eye mr-2"></i>{{ number_format($actor->views_count) }} views</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Channels -->
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-neutral-100 mb-4">Top Channels</h3>
                    <div class="space-y-4">
                        @foreach($topChannels as $channel)
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-300">{{ $channel->channel_name }}</span>
                            <span class="text-neutral-400 text-sm"><i class="fa-duotone fa-thin fa-eye mr-2"></i>{{ number_format($channel->total_views) }} views</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Recent Videos -->
            <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Recent Videos</h3>
                    <a href="{{ route('videos') }}" class="text-sm text-red-500 hover:text-red-400 transition-colors duration-300">View All<i class="fa-duotone fa-thin fa-arrow-right ml-2"></i></a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($recentVideos as $video)
                    <div class="group bg-neutral-700/20 rounded-lg overflow-hidden hover:bg-neutral-700/40 transition-all duration-300">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" 
                                 class="w-full aspect-video object-cover transform group-hover:scale-110 transition-all duration-500">
                            <span class="absolute bottom-2 right-2 px-2 py-1 bg-black/80 text-white text-xs rounded backdrop-blur-sm">
                                @php
                                    $duration = explode(':', $video->duration);
                                    echo (count($duration) === 3 && $duration[0] !== '00') 
                                        ? $video->duration 
                                        : (count($duration) === 3 ? $duration[1] . ':' . $duration[2] : $video->duration);
                                @endphp
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="text-neutral-100 font-medium truncate group-hover:text-red-500 transition-colors duration-300">{{ $video->title }}</h4>
                            <div class="flex items-center space-x-3 mt-2">
                                <p class="text-neutral-400 text-sm truncate">{{ $video->channels->pluck('channel_name')->implode(', ') }}</p>
                                <span class="text-neutral-500 text-xs">•</span>
                                <div class="flex items-center space-x-1">
                                    <i class="fa-duotone fa-thin fa-clock text-neutral-400 text-sm"></i>
                                    <span class="text-neutral-400 text-sm">{{ $video->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ route('edit-video', $video->id) }}" class="text-neutral-400 hover:text-red-500 transition-colors duration-300">
                                <i class="fa-duotone fa-thin fa-edit text-lg"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Popular Videos -->
            <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mt-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Popular Videos</h3>
                    <a href="{{ route('videos') }}" class="text-sm text-red-500 hover:text-red-400">View All<i class="fa-duotone fa-thin fa-arrow-right ml-2"></i></a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($popularVideos as $video)
                    <div class="group bg-neutral-700/30 rounded-lg overflow-hidden hover:bg-neutral-700/50 transition-all duration-300">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" 
                                 class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-300">
                            <span class="absolute bottom-2 right-2 px-2 py-1 bg-black/70 text-white text-xs rounded">
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
                        <div class="p-4">
                            <h4 class="text-neutral-100 font-medium truncate group-hover:text-red-500 transition-colors">{{ $video->title }}</h4>
                            <div class="flex items-center space-x-3 mt-2">
                                <p class="text-neutral-400 text-sm truncate">{{ $video->channels->pluck('channel_name')->implode(', ') }}</p>
                                <span class="text-neutral-500">•</span>
                                <div class="flex items-center text-neutral-400 text-sm">
                                    <i class="fa-duotone fa-thin fa-eye mr-1"></i>
                                    {{ number_format($video->videoStats->views_count) }}
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
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
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Views Chart
    const viewsCtx = document.getElementById('viewsChart').getContext('2d');
    const viewsData = @json($dailyViews);
    
    new Chart(viewsCtx, {
        type: 'line',
        data: {
            labels: viewsData.map(item => item.date),
            datasets: [{
                label: 'Views',
                data: viewsData.map(item => item.views),
                borderColor: 'rgb(239, 68, 68)',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                }
            }
        }
    });

    // Upload Trends Chart
    const uploadsCtx = document.getElementById('uploadTrendsChart').getContext('2d');
    const uploadData = @json($videoUploadTrends);
    
    new Chart(uploadsCtx, {
        type: 'bar',
        data: {
            labels: uploadData.map(item => item.date),
            datasets: [{
                label: 'Uploads',
                data: uploadData.map(item => item.uploads),
                backgroundColor: 'rgba(239, 68, 68, 0.2)',
                borderColor: 'rgb(239, 68, 68)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#9ca3af'
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection