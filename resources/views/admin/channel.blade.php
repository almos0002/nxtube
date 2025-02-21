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
                <h2 class="text-2xl font-bold text-neutral-100">Channel Management</h2>
                <p class="text-neutral-400">Manage and monitor all channels</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('add-channel') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                <i class="fa-duotone fa-thin fa-plus mr-2"></i>
                Add Channel
            </a>
            <form action="{{ route('channels') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Search channels..." value="{{ request('search') }}"
                       class="px-4 py-2 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                <button type="submit" class="absolute right-3 top-3.5 text-neutral-400">
                    <i class="fa-duotone fa-thin fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </header>

    <!-- Channel Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Channels -->
        <div class="channel-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Channels</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $totalChannels }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-tv text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-{{ $growth >= 0 ? 'green' : 'red' }}-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-{{ $growth >= 0 ? 'up' : 'down' }} mr-1"></i> 
                    {{ abs(round($growth)) }}%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

        <!-- Active Channels -->
        <div class="channel-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Active Channels</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $activeChannels }}</h3>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 
                    {{ $totalChannels > 0 ? round(($activeChannels / $totalChannels) * 100) : 0 }}%
                </span>
                <span class="text-neutral-500 ml-2">visibility rate</span>
            </div>
        </div>

        <!-- Total Videos -->
        <div class="channel-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Videos</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $totalVideos }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-video text-blue-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-chart-line mr-1"></i> 
                    {{ round($totalVideos / ($totalChannels ?: 1)) }}
                </span>
                <span class="text-neutral-500 ml-2">videos per channel</span>
            </div>
        </div>

        <!-- Most Popular Channel -->
        <div class="channel-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Most Popular</p>
                    <h3 class="text-2xl font-bold text-neutral-100">
                        {{ $popularChannel ? number_format($popularChannel->views_count) : 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-star text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-neutral-100">
                    {{ $popularChannel ? $popularChannel->channel_name : 'No channels yet' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Channel List -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <h3 class="text-lg font-semibold text-neutral-100">Channels List</h3>
                @if (session('success'))
                <div id="successMessage" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-sm flex items-center space-x-2 text-sm">
                    <i class="fa-duotone fa-check-circle"></i>
                    <p>{{ session('success') }}</p>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('successMessage').style.display = 'none';
                    }, 5000);
                </script>
                @endif
            </div>
            <a href="{{ route('add-channel') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Channel
            </a>
        </div>

        <!-- Channel Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($channels as $channel)
            <div class="bg-neutral-700/30 rounded-xl overflow-hidden">
                <div class="relative">
                    @if($channel->banner_image)
                        <img src="{{ asset('storage/' . $channel->banner_image) }}" class="w-full h-48 object-cover" alt="Channel Banner">
                    @else
                        <div class="w-full h-48 bg-neutral-800 flex items-center justify-center">
                            <i class="fa-duotone fa-thin fa-image text-4xl text-neutral-700"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 flex items-center space-x-2">
                        <a href="{{ route('edit-channel', $channel->id) }}" class="p-2 rounded-lg bg-neutral-900/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('delete-channel', $channel->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-neutral-900/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 backdrop-blur-sm transition-all duration-200" onclick="return confirm('Are you sure you want to delete this actor?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center space-x-3">
                        @if($channel->profile_image)
                            <img src="{{ asset('storage/' . $channel->profile_image) }}" class="w-16 h-16 rounded-xl border-2 border-neutral-100" alt="Channel Logo">
                        @else
                            <div class="w-16 h-16 rounded-xl border-2 border-neutral-100 bg-neutral-800 flex items-center justify-center">
                                <i class="fa-duotone fa-thin fa-user text-2xl text-neutral-600"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="text-white font-semibold text-lg">{{ $channel->channel_name }}</h4>
                            <p class="text-neutral-200 text-sm">{{ '@' . $channel->handle }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4 text-sm">
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-video mr-1"></i> {{ $channel->videos_count }}
                            </span>
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-eye mr-1"></i> {{ number_format($channel->views_count) }}
                            </span>
                        </div>
                        <span class="px-2 py-1 {{ $channel->visibility->value === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }} rounded text-xs">
                            {{ ucfirst($channel->visibility->value) }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8">
                <div class="w-16 h-16 bg-neutral-700/30 rounded-full mx-auto flex items-center justify-center mb-4">
                    <i class="fa-duotone fa-thin fa-tv text-neutral-400 text-2xl"></i>
                </div>
                <h3 class="text-neutral-300 font-semibold mb-2">No Channels Found</h3>
                <p class="text-neutral-400">Start by adding a new channel</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $channels->links() }}
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