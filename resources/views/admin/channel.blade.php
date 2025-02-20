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
                <h2 class="text-2xl font-bold text-neutral-100">Channel Management</h2>
                <p class="text-neutral-400">Manage and monitor all channels</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('add-channel') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                <i class="fa-duotone fa-thin fa-plus mr-2"></i>
                Add New Channel
            </a>
            <div class="relative">
                <input type="text" placeholder="Search channels..." 
                       class="px-4 py-2 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                <i class="fa-duotone fa-thin fa-search absolute right-3 top-3.5 text-neutral-400"></i>
            </div>
        </div>
    </header>

    <!-- Channel Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
                    <i class="fa-duotone fa-thin fa-arrow-{{ $growth >= 0 ? 'up' : 'down' }} mr-1"></i> {{ abs(round($growth)) }}%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

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
                <span class="text-{{ ($activeChannels / ($totalChannels ?: 1)) * 100 >= 75 ? 'green' : 'yellow' }}-400 flex items-center">
                    {{ round(($activeChannels / ($totalChannels ?: 1)) * 100) }}%
                </span>
                <span class="text-neutral-500 ml-2">of total channels</span>
            </div>
        </div>

        <div class="channel-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Pending Review</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $pendingChannels }}</h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-clock text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-{{ ($pendingChannels / ($totalChannels ?: 1)) * 100 > 20 ? 'red' : 'green' }}-400 flex items-center">
                    {{ round(($pendingChannels / ($totalChannels ?: 1)) * 100) }}%
                </span>
                <span class="text-neutral-500 ml-2">of total channels</span>
            </div>
        </div>

        <div class="channel-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Suspended</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $suspendedChannels }}</h3>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-ban text-red-500 text-xl"></i> 
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-{{ ($suspendedChannels / ($totalChannels ?: 1)) * 100 > 5 ? 'red' : 'green' }}-400 flex items-center">
                    {{ round(($suspendedChannels / ($totalChannels ?: 1)) * 100) }}%
                </span>
                <span class="text-neutral-500 ml-2">of total channels</span>
            </div>
        </div>
    </div>

    <!-- Channel List -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <h3 class="text-lg font-semibold text-neutral-100">Channel List</h3>
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
                            <i class="fa-duotone fa-thin fa-edit"></i>
                        </a>
                        <form action="{{ route('delete-channel', $channel->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this channel?')" class="p-2 rounded-lg bg-neutral-900/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 backdrop-blur-sm transition-all duration-200">
                                <i class="fa-duotone fa-thin fa-trash"></i>
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
                                <i class="fa-duotone fa-thin fa-eye mr-1"></i> {{ $channel->views_count ?? 0 }}
                            </span>
                        </div>
                        <span class="px-2 py-1 {{ $channel->visibility->value === 'active' ? 'bg-green-500/20 text-green-400' : ($channel->visibility->value === 'inactive' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }} rounded text-xs">
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
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">
                Showing {{ $channels->firstItem() ?? 0 }}-{{ $channels->lastItem() ?? 0 }} of {{ $channels->total() }} channels
            </p>
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