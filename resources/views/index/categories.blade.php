@extends('layouts.index')

@section('title', 'All Categories')
@section('meta_description', 'Browse all video categories on ' . $settings->site_name)
@section('meta_keywords', 'categories, videos, browse, ' . $settings->site_name)

@section('content')
<div class="nx-container py-8">
    <!-- Header -->
    <div class="flex items-center space-x-4 mb-8">
        <div class="w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center">
            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div>
            <h1 class="text-2xl font-bold">All Categories</h1>
            <p class="text-neutral-400">Browse videos by category</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('category', $category->slug) }}" class="flex items-center space-x-3 p-4 rounded-xl bg-neutral-800 hover:bg-neutral-700/50 transition-colors group/item">
            <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors flex-shrink-0">
                <span class="text-red-500 text-lg font-bold">#</span>
            </div>
            <div class="min-w-0"> <!-- This ensures text truncation works properly -->
                <h3 class="font-medium text-neutral-100 text-lg group-hover/item:text-red-500 transition-colors truncate">{{ $category->name }}</h3>
                <p class="text-sm text-neutral-400">{{ number_format($category->videos_count) }} videos</p>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 pagination-container">
        {{ $categories->links() }}
    </div>
</div>
@endsection
