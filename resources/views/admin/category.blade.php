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
                <h2 class="text-2xl font-bold text-neutral-100">Category Management</h2>
                <p class="text-neutral-400">Organize and manage video categories</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('add-category') }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors flex items-center">
                <i class="fa-duotone fa-thin fa-plus mr-2"></i>
                Add Category
            </a>
            <div class="relative">
                <input type="text" placeholder="Search categories..." 
                       class="px-4 py-2 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                <i class="fa-duotone fa-thin fa-search absolute right-3 top-3.5 text-neutral-400"></i>
            </div>
        </div>
    </header>

    <!-- Category Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Categories</p>
                    <h3 class="text-2xl font-bold text-neutral-100">24</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-folder text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 4%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Active Categories</p>
                    <h3 class="text-2xl font-bold text-neutral-100">20</h3>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 2%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
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
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 15%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>

        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Avg. Videos/Category</p>
                    <h3 class="text-2xl font-bold text-neutral-100">51</h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-chart-line text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 8%
                </span>
                <span class="text-neutral-500 ml-2">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Category List -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-neutral-100">Category List</h3>
            <div class="flex space-x-4">
                <select class="px-3 py-2 bg-neutral-700 border-neutral-600 rounded-lg text-sm text-neutral-100">
                    <option>All Categories</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
                <select class="px-3 py-2 bg-neutral-700 border-neutral-600 rounded-lg text-sm text-neutral-100">
                    <option>Sort by: Name</option>
                    <option>Sort by: Videos</option>
                    <option>Sort by: Created</option>
                </select>
            </div>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Category Card 1 -->
            <div class="bg-neutral-700/30 rounded-xl p-6 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                            <span class="text-red-500 text-2xl font-semibold">#</span>
                        </div>
                        <div>
                            <h4 class="text-neutral-100 font-semibold group-hover:text-red-500 transition-colors duration-200">Gaming</h4>
                            <p class="text-neutral-400 text-sm">156 videos</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 rounded-lg bg-neutral-600/30 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-neutral-600/30 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-neutral-400 group-hover:text-neutral-300 transition-all duration-200">124 videos</span>
                    <span class="px-3 py-1.5 bg-green-500/20 text-green-400 rounded-lg font-medium">Active</span>
                </div>
            </div>

            <!-- Category Card 2 -->
            <div class="bg-neutral-700/30 rounded-xl p-6 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                            <span class="text-red-500 text-2xl font-semibold">#</span>
                        </div>
                        <div>
                            <h4 class="text-neutral-100 font-semibold group-hover:text-red-500 transition-colors duration-200">Music</h4>
                            <p class="text-neutral-400 text-sm">89 videos</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 rounded-lg bg-neutral-600/30 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-neutral-600/30 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-neutral-400 group-hover:text-neutral-300 transition-all duration-200">89 videos</span>
                    <span class="px-3 py-1.5 bg-green-500/20 text-green-400 rounded-lg font-medium">Active</span>
                </div>
            </div>

            <!-- Category Card 3 -->
            <div class="bg-neutral-700/30 rounded-xl p-6 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                            <span class="text-red-500 text-2xl font-semibold">#</span>
                        </div>
                        <div>
                            <h4 class="text-neutral-100 font-semibold group-hover:text-red-500 transition-colors duration-200">Technology</h4>
                            <p class="text-neutral-400 text-sm">156 videos</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 rounded-lg bg-neutral-600/30 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-neutral-600/30 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-neutral-400 group-hover:text-neutral-300 transition-all duration-200">156 videos</span>
                    <span class="px-3 py-1.5 bg-neutral-500/20 text-neutral-400 rounded-lg font-medium">Inactive</span>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">Showing 1-9 of 24 categories</p>
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