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
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 
                    {{ $totalCategories > 0 ? round(($activeCategories / $totalCategories) * 100) : 0 }}%
                </span>
                <span class="text-neutral-500 ml-2">active rate</span>
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
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-400 flex items-center">
                    <i class="fa-duotone fa-thin fa-chart-line mr-1"></i> 
                    {{ round($totalVideos / ($totalCategories ?: 1)) }}
                </span>
                <span class="text-neutral-500 ml-2">videos per category</span>
            </div>
        </div>

        <!-- Avg. Videos/Category -->
        <div class="category-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-neutral-400 text-sm">Most Popular</p>
                    <h3 class="text-2xl font-bold text-neutral-100">
                        {{ $popularCategories->first() ? $popularCategories->first()->videos_count : 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fa-duotone fa-thin fa-chart-line text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-neutral-400">
                    {{ $popularCategories->first() ? Str::limit($popularCategories->first()->name, 20) : 'No categories' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Category List -->
    <div class="bg-neutral-800 rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex gap-3 items-center">
                <h3 class="text-lg font-semibold text-neutral-100">Category List</h3>
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
            @forelse ($categories as $category)
            <div class="bg-neutral-700/30 rounded-xl p-6 hover:bg-neutral-700/50 transition-all duration-200 group">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all duration-200">
                            <span class="text-red-500 text-2xl font-semibold">#</span>
                        </div>
                        <div>
                            <h4 class="text-neutral-100 font-semibold group-hover:text-red-500 transition-colors duration-200">{{ $category->name }}</h4>
                            <p class="text-neutral-400 text-sm">{{ $category->videos_count }} videos</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" 
                                   class="sr-only peer" 
                                   {{ $category->status && $category->status->value === 'active' ? 'checked' : '' }}
                                   onchange="toggleCategoryStatus({{ $category->id }}, this)">
                            <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-500/25 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                        </label>
                        <a href="{{ route('edit-category', $category->id) }}" class="p-2 rounded-lg bg-neutral-600/30 hover:bg-blue-500/20 text-neutral-400 hover:text-blue-400 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('delete-category', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg bg-neutral-600/30 hover:bg-red-500/20 text-neutral-400 hover:text-red-400 transition-all duration-200" onclick="return confirm('Are you sure you want to delete this category?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-neutral-400 group-hover:text-neutral-300 transition-all duration-200">{{ $category->videos_count }} videos</span>
                    <span class="status-badge px-3 py-1.5 {{ $category->status && $category->status->value === 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }} rounded-lg font-medium">
                        {{ $category->status && $category->status->value === 'active' ? 'Active' : 'Inactive' }}
                    </span>
                </div>
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

    function toggleCategoryStatus(categoryId, element) {
        fetch(`/toggle-category-status/${categoryId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.status === 'active') {
                    element.checked = true;
                    element.closest('.bg-neutral-700\\/30').querySelector('.status-badge').className = 'status-badge px-3 py-1.5 bg-green-500/20 text-green-400 rounded-lg font-medium';
                    element.closest('.bg-neutral-700\\/30').querySelector('.status-badge').textContent = 'Active';
                } else {
                    element.checked = false;
                    element.closest('.bg-neutral-700\\/30').querySelector('.status-badge').className = 'status-badge px-3 py-1.5 bg-neutral-500/20 text-neutral-400 rounded-lg font-medium';
                    element.closest('.bg-neutral-700\\/30').querySelector('.status-badge').textContent = 'Inactive';
                }
            } else {
                element.checked = !element.checked;
                alert('Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            element.checked = !element.checked;
            alert('Failed to update status');
        });
    }
</script>

@push('scripts')
@endpush

@endsection