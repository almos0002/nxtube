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
                <p class="text-neutral-400">Manage actors and their profiles</p>
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
        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Actors</p>
                    <h3 class="text-2xl font-bold text-neutral-100">524</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-user-tie text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 5%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Active Actors</p>
                    <h3 class="text-2xl font-bold text-neutral-100">486</h3>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 3%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Videos</p>
                    <h3 class="text-2xl font-bold text-neutral-100">2.5K</h3>
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

        <div class="actor-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Avg. Videos/Actor</p>
                    <h3 class="text-2xl font-bold text-neutral-100">4.8</h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-chart-line text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 7%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
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
            <div class="flex space-x-4">
                <select class="px-3 py-2 bg-neutral-700 border-neutral-600 rounded-lg text-sm text-neutral-100">
                    <option>All Actors</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <select class="px-3 py-2 bg-neutral-700 border-neutral-600 rounded-lg text-sm text-neutral-100">
                    <option>Sort by: Name</option>
                    <option>Sort by: Videos</option>
                    <option>Sort by: Views</option>
                    <option>Sort by: Joined Date</option>
                </select>
            </div>
        </div>

        <!-- Actor Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Actor Card 1 -->
            <div class="bg-neutral-700/30 rounded-xl overflow-hidden">
                <div class="relative">
                    <img src="https://placehold.co/1280x720/363636/FFFFFF/webp" class="w-full h-48 object-cover" alt="Actor Banner">
                    <div class="absolute top-4 right-4 flex items-center space-x-2">
                        <button class="p-2 rounded-lg bg-neutral-900/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-neutral-900/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center space-x-3">
                        <img src="https://placehold.co/150x150/404040/FFFFFF/webp?text=JS" class="w-16 h-16 rounded-xl border-2 border-neutral-100" alt="Actor Profile">
                        <div>
                            <h4 class="text-white font-semibold text-lg">John Smith</h4>
                            <p class="text-neutral-200 text-sm">Tech Reviewer</p>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-neutral-900/50 text-neutral-100 text-sm backdrop-blur-sm ml-2">
                            <i class="fa-duotone fa-thin fa-mars text-blue-400 mr-1"></i>
                            Actor
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4 text-sm">
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-video mr-1"></i> 48
                            </span>
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-eye mr-1"></i> 1.2M
                            </span>
                        </div>
                        <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded text-xs">Active</span>
                    </div>
                </div>
            </div>

            <!-- Actor Card 2 -->
            <div class="bg-neutral-700/30 rounded-xl overflow-hidden">
                <div class="relative">
                    <img src="https://placehold.co/1280x720/363636/FFFFFF/webp" class="w-full h-48 object-cover" alt="Actor Banner">
                    <div class="absolute top-4 right-4 flex items-center space-x-2">
                        <button class="p-2 rounded-lg bg-neutral-900/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-neutral-900/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center space-x-3">
                        <img src="https://placehold.co/150x150/404040/FFFFFF/webp?text=SJ" class="w-16 h-16 rounded-xl border-2 border-neutral-100" alt="Actor Profile">
                        <div>
                            <h4 class="text-white font-semibold text-lg">Sarah Johnson</h4>
                            <p class="text-neutral-200 text-sm">Gaming Creator</p>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-neutral-900/50 text-neutral-100 text-sm backdrop-blur-sm ml-2">
                            <i class="fa-duotone fa-thin fa-venus text-pink-400 mr-1"></i>
                            Actress
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4 text-sm">
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-video mr-1"></i> 36
                            </span>
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-eye mr-1"></i> 892K
                            </span>
                        </div>
                        <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded text-xs">Pending</span>
                    </div>
                </div>
            </div>

            <!-- Actor Card 3 -->
            <div class="bg-neutral-700/30 rounded-xl overflow-hidden">
                <div class="relative">
                    <img src="https://placehold.co/1280x720/363636/FFFFFF/webp" class="w-full h-48 object-cover" alt="Actor Banner">
                    <div class="absolute top-4 right-4 flex items-center space-x-2">
                        <button class="p-2 rounded-lg bg-neutral-900/50 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-neutral-900/50 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 backdrop-blur-sm transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="absolute bottom-4 left-4 flex items-center space-x-3">
                        <img src="https://placehold.co/150x150/404040/FFFFFF/webp?text=MG" class="w-16 h-16 rounded-xl border-2 border-neutral-100" alt="Actor Profile">
                        <div>
                            <h4 class="text-white font-semibold text-lg">Michael Garcia</h4>
                            <p class="text-neutral-200 text-sm">Content Creator</p>
                        </div>
                        <span class="px-2 py-1 rounded-lg bg-neutral-900/50 text-neutral-100 text-sm backdrop-blur-sm ml-2">
                            <i class="fa-duotone fa-thin fa-mars text-blue-400 mr-1"></i>
                            Actor
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4 text-sm">
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-video mr-1"></i> 92
                            </span>
                            <span class="text-neutral-400">
                                <i class="fa-duotone fa-thin fa-eye mr-1"></i> 2.1M
                            </span>
                        </div>
                        <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded text-xs">Suspended</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">Showing 1-9 of 524 actors</p>
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
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('md:translate-x-0');
    }
</script>

@endsection