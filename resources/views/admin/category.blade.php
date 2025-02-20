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
        <!-- Total Categories -->
        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Categories</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $totalCategories }}</h3>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-folder text-purple-500 text-xl"></i>
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

        <!-- Total Videos -->
        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Total Videos</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $totalVideos }}</h3>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-video text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Active Categories -->
        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Active Categories</p>
                    <h3 class="text-2xl font-bold text-neutral-100">{{ $activeCategories }}</h3>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-neutral-400">Categories with videos</span>
            </div>
        </div>

        <!-- Popular Categories -->
        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Most Videos</p>
                    <h3 class="text-2xl font-bold text-neutral-100">
                        {{ $popularCategories->first() ? $popularCategories->first()->videos_count : 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-star text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-neutral-400">{{ $popularCategories->first() ? $popularCategories->first()->name : 'No categories' }}</span>
            </div>
        </div>
    </div>

    <!-- Category List -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <h3 class="text-lg font-semibold text-neutral-100">Category List</h3>
                @if (session('success'))
                    <div class="bg-green-500/10 text-green-500 px-3 py-1 rounded-full text-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $category)
            <div class="bg-neutral-700/30 rounded-xl p-6 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                            <i class="fa-duotone fa-thin fa-folder text-red-500"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-100">{{ $category->name }}</h4>
                            <p class="text-neutral-400 text-sm">{{ $category->videos_count }} videos</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('edit-category', $category->id) }}" class="p-2 hover:bg-neutral-600/50 rounded-lg transition-colors">
                            <i class="fa-duotone fa-thin fa-pen-to-square text-neutral-400 hover:text-neutral-100"></i>
                        </a>
                        <form action="{{ route('delete-category', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-neutral-600/50 rounded-lg transition-colors" onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fa-duotone fa-thin fa-trash text-neutral-400 hover:text-red-500"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="text-neutral-400 text-sm line-clamp-2">{{ $category->description }}</p>
            </div>
            @empty
            <div class="col-span-3 text-center py-8">
                <div class="w-16 h-16 bg-neutral-700/30 rounded-full mx-auto flex items-center justify-center mb-4">
                    <i class="fa-duotone fa-thin fa-folder-open text-neutral-400 text-2xl"></i>
                </div>
                <h3 class="text-neutral-300 font-semibold mb-2">No Categories Found</h3>
                <p class="text-neutral-400 text-sm">Start by adding your first category</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-8">
            <p class="text-neutral-400 text-sm">
                Showing {{ $categories->firstItem() ?? 0 }}-{{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} categories
            </p>
            {{ $categories->links() }}
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }
</script>
@endsection