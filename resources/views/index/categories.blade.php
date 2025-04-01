@extends('layouts.index')

@section('title', 'All Categories')
@section('meta_description', 'Browse all video categories on ' . $settings->site_name)
@section('meta_keywords', 'categories, videos, browse, ' . $settings->site_name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">All Categories</h2>
            <p class="text-neutral-400">Browse videos by category</p>
        </div>
    </header>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
        @foreach($categories as $category)
        <a href="{{ route('category', $category->slug) }}" class="bg-neutral-800 rounded-xl shadow-sm p-4 hover:bg-neutral-700/50 transition-colors">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 mb-3 rounded-lg bg-purple-500/20 flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-neutral-100 text-lg">{{ $category->name }}</h3>
                <p class="text-sm text-neutral-400 mt-1">{{ number_format($category->videos_count) }} videos</p>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection
