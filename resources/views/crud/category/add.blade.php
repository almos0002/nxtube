@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="ml-64 p-8">
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Add New Category</h2>
            <p class="text-neutral-400">Create and organize content categories</p>
        </div>
        <button type="submit" form="categoryForm" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
            Create Category
        </button>
    </header>

    <form id="categoryForm" class="w-full">
        <!-- Basic Information -->
        <div class="bg-neutral-800 rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold text-neutral-100 mb-4">Basic Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Category Name</label>
                    <input type="text" name="name" required
                           class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                           placeholder="e.g., Gaming, Technology, Music">
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Description</label>
                    <textarea name="description" rows="3" required
                              class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                              placeholder="Brief description of the category"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Sidebar toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    // Form submission
    const categoryForm = document.getElementById('categoryForm');
    categoryForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Add your form submission logic here
        alert('Category created successfully!');
    });
</script>
@endsection