@extends('layouts.admin')

@section('content')
<div class="p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Dashboard, Welcome Admin!</h2>
            <p class="text-neutral-400">Overview of your account</p>
        </div>
    </header>
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
                @if(abs(round($videosGrowth)) > 0)
                    <span class="text-{{ $videosGrowth >= 0 ? 'green' : 'red' }}-500 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $videosGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ number_format(abs(round($videosGrowth)), 1) }}%
                    </span>
                @else
                    <span class="text-neutral-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-minus mr-1"></i>
                        0%
                    </span>
                @endif
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
                @if(abs(round($viewsGrowth)) > 0)
                    <span class="text-{{ $viewsGrowth >= 0 ? 'green' : 'red' }}-500 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $viewsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ number_format(abs(round($viewsGrowth)), 1) }}%
                    </span>
                @else
                    <span class="text-neutral-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-minus mr-1"></i>
                        0%
                    </span>
                @endif
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
                @if(abs(round($categoriesGrowth)) > 0)
                    <span class="text-{{ $categoriesGrowth >= 0 ? 'green' : 'red' }}-500 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $categoriesGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ number_format(abs(round($categoriesGrowth)), 1) }}%
                    </span>
                @else
                    <span class="text-neutral-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-minus mr-1"></i>
                        0%
                    </span>
                @endif
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
                @if(abs(round($actorsGrowth)) > 0)
                    <span class="text-{{ $actorsGrowth >= 0 ? 'green' : 'red' }}-500 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $actorsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ number_format(abs(round($actorsGrowth)), 1) }}%
                    </span>
                @else
                    <span class="text-neutral-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-minus mr-1"></i>
                        0%
                    </span>
                @endif
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
                @if(abs(round($channelsGrowth)) > 0)
                    <span class="text-{{ $channelsGrowth >= 0 ? 'green' : 'red' }}-500 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-{{ $channelsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ number_format(abs(round($channelsGrowth)), 1) }}%
                    </span>
                @else
                    <span class="text-neutral-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-minus mr-1"></i>
                        0%
                    </span>
                @endif
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Ads Status -->
            <div class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-neutral-700/20 bg-red-500/5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/10 text-red-400">
                                <i class="fa-duotone fa-thin fa-rectangle-ad text-lg"></i>
                            </div>
                            <h3 class="text-lg font-medium text-neutral-100">Ads Status</h3>
                        </div>
                        <span class="text-xs px-2 py-1 {{ $adsEnabled ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }} rounded-lg">
                            {{ $adsEnabled ? 'Enabled' : 'Disabled' }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Banner Ads 1</p>
                                <span class="text-xs px-2 py-1 {{ !empty($ads->ads_banner_1) ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ !empty($ads->ads_banner_1) ? 'Configured' : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Banner Ads 2</p>
                                <span class="text-xs px-2 py-1 {{ !empty($ads->ads_banner_2) ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ !empty($ads->ads_banner_2) ? 'Configured' : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Popup Ads</p>
                                <span class="text-xs px-2 py-1 {{ !empty($ads->ads_popup) ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ !empty($ads->ads_popup) ? 'Configured' : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Video Ads</p>
                                <span class="text-xs px-2 py-1 {{ !empty($ads->ads_video) ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ !empty($ads->ads_video) ? 'Configured' : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('ads') }}" class="inline-flex items-center text-sm text-red-400 hover:text-red-300 transition-colors group">
                            Manage Ads<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- SEO Configuration -->
            <div class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-neutral-700/20 bg-teal-500/5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-teal-500/10 text-teal-400">
                                <i class="fa-duotone fa-thin fa-search-plus text-lg"></i>
                            </div>
                            <h3 class="text-lg font-medium text-neutral-100">SEO Status</h3>
                        </div>
                        <span class="text-xs px-2 py-1 {{ $seoSettings->is_active ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }} rounded-lg">
                            {{ $seoSettings->is_active ? 'Enabled' : 'Disabled' }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Sitemap</p>
                                <span class="text-xs px-2 py-1 {{ $seoSettings->auto_generate_sitemap ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ $seoSettings->auto_generate_sitemap ? 'Auto-Generated' : 'Manual' }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Social Meta</p>
                                <span class="text-xs px-2 py-1 {{ $seoSettings->enable_social_meta ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ $seoSettings->enable_social_meta ? 'Enabled' : 'Disabled' }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Canonical URLs</p>
                                <span class="text-xs px-2 py-1 {{ $seoSettings->enable_canonical_urls ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ $seoSettings->enable_canonical_urls ? 'Enabled' : 'Disabled' }}
                                </span>
                            </div>
                        </div>
                        <div class="bg-neutral-700/20 p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <p class="text-neutral-300">Verification Tags</p>
                                <span class="text-xs px-2 py-1 {{ !empty($seoSettings->google_verification) || !empty($seoSettings->bing_verification) ? 'bg-green-500/10 text-green-400' : 'bg-neutral-600/30 text-neutral-400' }} rounded-lg">
                                    {{ !empty($seoSettings->google_verification) || !empty($seoSettings->bing_verification) ? 'Configured' : 'Not Set' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.seo.index') }}" class="inline-flex items-center text-sm text-teal-400 hover:text-teal-300 transition-colors group">
                            Manage SEO<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>
            </div>
            
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
                            @if(abs(round($viewsGrowth)) > 0)
                                <span class="text-{{ $viewsGrowth >= 0 ? 'green' : 'red' }}-500 text-sm flex items-center">
                                    <i class="fa-duotone fa-thin fa-arrow-{{ $viewsGrowth >= 0 ? 'up' : 'down' }} mr-1"></i>
                                    {{ number_format(abs(round($viewsGrowth)), 1) }}%
                                </span>
                            @else
                                <span class="text-neutral-400 text-sm flex items-center">
                                    <i class="fa-duotone fa-thin fa-minus mr-1"></i>
                                    0%
                                </span>
                            @endif
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
                <div class="bg-neutral-800 rounded-xl overflow-hidden shadow-lg">
                    <div class="px-6 py-5 border-b border-neutral-700/20 bg-purple-500/5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-purple-500/10 text-purple-400">
                                    <i class="fa-duotone fa-thin fa-folder text-lg"></i>
                                </div>
                                <h3 class="text-lg font-medium text-neutral-100">Top Categories</h3>
                            </div>
                            <span class="text-xs px-2 py-1 bg-purple-500/10 text-purple-400 rounded-lg">{{ $topCategories->count() }}</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1">
                        @foreach($topCategories as $index => $category)
                        <a href="{{ route('category', $category->slug) }}" class="flex items-center justify-between py-3 px-3 {{ $index == 0 ? 'bg-purple-500/5 rounded-lg' : 'hover:bg-neutral-700/20 rounded-lg' }} transition-all duration-200 group">
                            <div class="flex items-center space-x-3">
                                <span class="text-neutral-400 text-sm font-medium w-5">{{ $index + 1 }}</span>
                                <span class="text-neutral-200 font-medium group-hover:text-purple-400 transition-colors">{{ $category->name }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-neutral-400 text-sm">{{ $category->videos_count }}</span>
                                <i class="fa-duotone fa-thin fa-video text-purple-400 text-sm"></i>
                            </div>
                        </a>
                        @endforeach
                        <div class="pt-4 text-right">
                            <a href="{{ route('categories') }}" class="inline-flex items-center text-sm text-purple-400 hover:text-purple-300 transition-colors group">
                                View all<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Top Actors -->
                <div class="bg-neutral-800 rounded-xl overflow-hidden shadow-lg">
                    <div class="px-6 py-5 border-b border-neutral-700/20 bg-yellow-500/5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-yellow-500/10 text-yellow-400">
                                    <i class="fa-duotone fa-thin fa-user-tie text-lg"></i>
                                </div>
                                <h3 class="text-lg font-medium text-neutral-100">Top Actors</h3>
                            </div>
                            <span class="text-xs px-2 py-1 bg-yellow-500/10 text-yellow-400 rounded-lg">{{ $topActors->count() }}</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1">
                        @foreach($topActors as $index => $actor)
                        <a href="{{ route('actor', $actor->slug) }}" class="flex items-center justify-between py-3 px-3 {{ $index == 0 ? 'bg-yellow-500/5 rounded-lg' : 'hover:bg-neutral-700/20 rounded-lg' }} transition-all duration-200 group">
                            <div class="flex items-center space-x-3">
                                <span class="text-neutral-400 text-sm font-medium w-5">{{ $index + 1 }}</span>
                                <span class="text-neutral-200 font-medium truncate max-w-[140px] group-hover:text-yellow-400 transition-colors">{{ $actor->stagename ?: $actor->firstname . ' ' . $actor->lastname }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-neutral-400 text-sm">{{ number_format($actor->views_count) }}</span>
                                <i class="fa-duotone fa-thin fa-eye text-yellow-400 text-sm"></i>
                            </div>
                        </a>
                        @endforeach
                        <div class="pt-4 text-right">
                            <a href="{{ route('actors') }}" class="inline-flex items-center text-sm text-yellow-400 hover:text-yellow-300 transition-colors group">
                                View all<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Top Channels -->
                <div class="bg-neutral-800 rounded-xl overflow-hidden shadow-lg">
                    <div class="px-6 py-5 border-b border-neutral-700/20 bg-blue-500/5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">
                                    <i class="fa-duotone fa-thin fa-hashtag text-lg"></i>
                                </div>
                                <h3 class="text-lg font-medium text-neutral-100">Top Channels</h3>
                            </div>
                            <span class="text-xs px-2 py-1 bg-blue-500/10 text-blue-400 rounded-lg">{{ $topChannels->count() }}</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1">
                        @foreach($topChannels as $index => $channel)
                        <a href="{{ route('channel', $channel->handle) }}" class="flex items-center justify-between py-3 px-3 {{ $index == 0 ? 'bg-blue-500/5 rounded-lg' : 'hover:bg-neutral-700/20 rounded-lg' }} transition-all duration-200 group">
                            <div class="flex items-center space-x-3">
                                <span class="text-neutral-400 text-sm font-medium w-5">{{ $index + 1 }}</span>
                                <span class="text-neutral-200 font-medium truncate max-w-[140px] group-hover:text-blue-400 transition-colors">{{ $channel->channel_name }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-neutral-400 text-sm">{{ number_format($channel->total_views) }}</span>
                                <i class="fa-duotone fa-thin fa-eye text-blue-400 text-sm"></i>
                            </div>
                        </a>
                        @endforeach
                        <div class="pt-4 text-right">
                            <a href="{{ route('channels') }}" class="inline-flex items-center text-sm text-blue-400 hover:text-blue-300 transition-colors group">
                                View all<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Videos -->
            <div class="bg-neutral-800 rounded-xl overflow-hidden shadow-lg">
                <div class="px-6 py-5 border-b border-neutral-700/20 bg-red-500/5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500/10 text-red-400">
                                <i class="fa-duotone fa-thin fa-film text-lg"></i>
                            </div>
                            <h3 class="text-lg font-medium text-neutral-100">Recent Videos</h3>
                        </div>
                        <span class="text-xs px-2 py-1 bg-red-500/10 text-red-400 rounded-lg">{{ $recentVideos->count() }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($recentVideos as $video)
                        <a href="{{ route('edit-video', $video->id) }}" class="group">
                            <div class="bg-neutral-700/20 rounded-lg overflow-hidden hover:bg-neutral-700/40 transition-all duration-300 h-full">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" 
                                         class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-300">
                                    <span class="absolute bottom-2 right-2 px-2 py-1 bg-black/80 text-white text-xs rounded backdrop-blur-sm">
                                        @php
                                            $duration = explode(':', $video->duration);
                                            echo (count($duration) === 3 && $duration[0] !== '00') 
                                                ? $video->duration 
                                                : (count($duration) === 3 ? $duration[1] . ':' . $duration[2] : $video->duration);
                                        @endphp
                                    </span>
                                </div>
                                <div class="p-3">
                                    <h4 class="text-neutral-100 font-medium line-clamp-1 group-hover:text-red-400 transition-colors duration-300">{{ $video->title }}</h4>
                                    <div class="flex items-center mt-2 text-xs">
                                        <span class="text-neutral-400 line-clamp-1">{{ $video->channels->pluck('channel_name')->implode(', ') }}</span>
                                        <span class="text-neutral-500 mx-2">•</span>
                                        <div class="flex items-center text-neutral-400">
                                            <i class="fa-duotone fa-thin fa-eye mr-1"></i>
                                            {{ number_format($video->videoStats->views_count ?? 0) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="pt-4 text-right">
                        <a href="{{ route('videos') }}" class="inline-flex items-center text-sm text-red-400 hover:text-red-300 transition-colors group">
                            View all<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Popular Videos -->
            <div class="bg-neutral-800 rounded-xl overflow-hidden shadow-lg">
                <div class="px-6 py-5 border-b border-neutral-700/20 bg-amber-500/5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-amber-500/10 text-amber-400">
                                <i class="fa-duotone fa-thin fa-fire text-lg"></i>
                            </div>
                            <h3 class="text-lg font-medium text-neutral-100">Popular Videos</h3>
                        </div>
                        <span class="text-xs px-2 py-1 bg-amber-500/10 text-amber-400 rounded-lg">{{ $popularVideos->count() }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($popularVideos as $video)
                        <a href="{{ route('edit-video', $video->id) }}" class="group">
                            <div class="bg-neutral-700/20 rounded-lg overflow-hidden hover:bg-neutral-700/40 transition-all duration-300 h-full">
                                <div class="relative">
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" 
                                         class="w-full aspect-video object-cover transform group-hover:scale-105 transition-all duration-300">
                                    <div class="absolute top-2 left-2 px-2 py-1 bg-amber-500/20 text-amber-400 text-xs rounded-lg backdrop-blur-sm flex items-center">
                                        <i class="fa-duotone fa-thin fa-eye mr-1"></i>
                                        {{ number_format($video->videoStats->views_count ?? 0) }}
                                    </div>
                                    <span class="absolute bottom-2 right-2 px-2 py-1 bg-black/80 text-white text-xs rounded backdrop-blur-sm">
                                        @php
                                            $duration = explode(':', $video->duration);
                                            echo (count($duration) === 3 && $duration[0] !== '00') 
                                                ? $video->duration 
                                                : (count($duration) === 3 ? $duration[1] . ':' . $duration[2] : $video->duration);
                                        @endphp
                                    </span>
                                </div>
                                <div class="p-3">
                                    <h4 class="text-neutral-100 font-medium line-clamp-1 group-hover:text-amber-400 transition-colors duration-300">{{ $video->title }}</h4>
                                    <div class="flex items-center mt-2 text-xs">
                                        <span class="text-neutral-400 line-clamp-1">{{ $video->channels->pluck('channel_name')->implode(', ') }}</span>
                                        <span class="text-neutral-500 mx-2">•</span>
                                        <span class="text-neutral-400">{{ $video->categories->pluck('name')->first() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="pt-4 text-right">
                        <a href="{{ route('videos') }}" class="inline-flex items-center text-sm text-amber-400 hover:text-amber-300 transition-colors group">
                            View all<i class="fa-duotone fa-thin fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
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