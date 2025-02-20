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
                <h2 class="text-2xl font-bold text-neutral-100">Actor Management</h2>
                <p class="text-neutral-400">Manage actors and their videos</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('add-actor') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                <i class="fa-duotone fa-thin fa-plus mr-2"></i>
                Add Actor
            </a>
            <div class="relative">
                <input type="text" placeholder="Search actors..." 
                       class="px-4 py-2 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                <i class="fa-duotone fa-thin fa-search absolute right-3 top-3.5 text-neutral-400"></i>
            </div>
        </div>
    </header>

    <!-- Actor Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Actors -->
        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Actors</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $totalActors }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-users text-purple-500 text-xl"></i>
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

        <!-- Active Actors -->
        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Public Actors</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $activeActors }}</h3>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 
                    {{ $totalActors > 0 ? round(($activeActors / $totalActors) * 100) : 0 }}%
                </span>
                <span class="text-neutral-500 ml-2">visibility rate</span>
            </div>
        </div>

        <!-- Total Videos -->
        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
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
                    {{ round($totalVideos / ($totalActors ?: 1)) }}
                </span>
                <span class="text-neutral-500 ml-2">videos per actor</span>
            </div>
        </div>

        <!-- Most Popular Actor -->
        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Most Popular</p>
                    <h3 class="text-2xl font-bold text-neutral-100">
                        {{ $popularActors->first() ? $popularActors->first()['videos_count'] : 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-star text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-neutral-400">
                    {{ $popularActors->first() ? Str::limit($popularActors->first()['name'], 20) : 'No actors' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Actor Types Distribution -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
        <h3 class="text-lg font-semibold text-neutral-100 mb-4">Actor Types Distribution</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach(App\Enums\ActorType::cases() as $type)
            <div class="bg-neutral-700/30 rounded-xl p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-neutral-300">{{ ucfirst(strtolower($type->value)) }}</span>
                    <span class="text-neutral-100 font-semibold">{{ $actorsByType[$type->value] ?? 0 }}</span>
                </div>
                <div class="w-full bg-neutral-600/30 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $totalActors > 0 ? (($actorsByType[$type->value] ?? 0) / $totalActors) * 100 : 0 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Actor List -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <h3 class="text-lg font-semibold text-neutral-100">Actor List</h3>
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($actors as $actor)
            <div class="bg-neutral-700/30 rounded-xl overflow-hidden">
                <div class="relative">
                    @if($actor->banner_image)
                        <img src="{{ asset('storage/' . $actor->banner_image) }}" class="w-full h-48 object-cover" alt="Actor Banner">
                    @else
                        <div class="w-full h-48 bg-neutral-800 flex items-center justify-center">
                            <i class="fa-duotone fa-thin fa-image text-neutral-600 text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 flex items-center space-x-2">
                        <a href="{{ route('edit-actor', $actor->id) }}" class="p-2 rounded-lg bg-neutral-900/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('delete-actor', $actor->id) }}" method="POST" class="inline">
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
                        @if($actor->profile_image)
                            <img src="{{ asset('storage/' . $actor->profile_image) }}" class="w-16 h-16 rounded-xl border-2 border-neutral-100" alt="Actor Profile">
                        @else
                            <div class="w-16 h-16 rounded-xl border-2 border-neutral-100 bg-neutral-800 flex items-center justify-center">
                                <i class="fa-duotone fa-thin fa-user text-neutral-600 text-2xl"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="text-white font-semibold text-lg">{{ $actor->stagename }}</h4>
                            <p class="text-neutral-200 text-sm">{{ $actor->name }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-neutral-900/50 text-neutral-100 text-sm backdrop-blur-sm ml-2">
                            <i class="fa-duotone fa-thin fa-{{ $actor->type->value === 'actor' ? 'mars' : 'venus' }} text-{{ $actor->type->value === 'actor' ? 'blue' : 'pink' }}-400 mr-1"></i>
                            {{ ucfirst($actor->type->value) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4 text-sm">
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-video mr-1"></i> {{ $actor->videos_count }}
                            </span>
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-flag mr-1"></i> {{ $actor->country }}
                            </span>
                        </div>
                        <span class="px-2 py-1 {{ $actor->visibility->value === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }} rounded text-xs">
                            {{ ucfirst($actor->visibility->value) }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-8">
                <div class="w-16 h-16 bg-neutral-700/30 rounded-full mx-auto flex items-center justify-center mb-4">
                    <i class="fa-duotone fa-thin fa-users text-neutral-400 text-2xl"></i>
                </div>
                <h3 class="text-neutral-300 font-semibold mb-2">No Actors Found</h3>
                <p class="text-neutral-400 text-sm">Start by adding your first actor</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">
                Showing {{ $actors->firstItem() ?? 0 }}-{{ $actors->lastItem() ?? 0 }} of {{ $actors->total() }} actors
            </p>
            {{ $actors->links() }}
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function toggleActorVisibility(actorId, element) {
            fetch(`/toggle-actor-visibility/${actorId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.visibility === 'public') {
                        element.checked = true;
                        element.closest('.bg-neutral-700\\/30').querySelector('.visibility-badge').className = 'visibility-badge px-3 py-1.5 bg-green-500/20 text-green-400 rounded-lg font-medium';
                        element.closest('.bg-neutral-700\\/30').querySelector('.visibility-badge').textContent = 'Public';
                    } else {
                        element.checked = false;
                        element.closest('.bg-neutral-700\\/30').querySelector('.visibility-badge').className = 'visibility-badge px-3 py-1.5 bg-neutral-500/20 text-neutral-400 rounded-lg font-medium';
                        element.closest('.bg-neutral-700\\/30').querySelector('.visibility-badge').textContent = 'Private';
                    }
                } else {
                    element.checked = !element.checked;
                    alert('Failed to update visibility');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                element.checked = !element.checked;
                alert('Failed to update visibility');
            });
        }
    </script>

    @push('scripts')
    @endpush

@endsection