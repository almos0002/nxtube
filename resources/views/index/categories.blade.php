@extends('layouts.index')

@section('title', 'All Categories')
@section('meta_description', 'Browse all video categories on ' . $settings->site_name)
@section('meta_keywords', 'categories, videos, browse, ' . $settings->site_name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex items-center mb-2">
            <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"></path>
            </svg>
            <h2 class="text-3xl font-bold text-white">All Categories</h2>
        </div>
        <p class="text-neutral-400 text-lg ml-11">Browse videos by category</p>
        <div class="h-px bg-gradient-to-r from-red-500/50 via-neutral-700 to-transparent mt-6"></div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
        @foreach($categories as $category)
        <a href="{{ route('category', $category->slug) }}" class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden hover:bg-neutral-700/50 transition-colors group">
            <div class="p-5">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-500/30 transition-colors">
                        <svg class="w-6 h-6 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.243 3.03a1 1 0 01.727 1.213L9.53 6h2.94l.56-2.243a1 1 0 111.94.486L14.53 6H17a1 1 0 110 2h-2.97l-1 4H15a1 1 0 110 2h-2.47l-.56 2.242a1 1 0 11-1.94-.485L10.47 14H7.53l-.56 2.242a1 1 0 11-1.94-.485L5.47 14H3a1 1 0 110-2h2.97l1-4H5a1 1 0 110-2h2.47l.56-2.243a1 1 0 011.213-.727zM9.03 8l-1 4h2.938l1-4H9.031z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="font-medium text-neutral-100 text-lg truncate group-hover:text-white transition-colors">{{ $category->name }}</h3>
                </div>
                <div class="flex items-center mt-2 border-t border-neutral-700 pt-3">
                    <svg class="w-4 h-4 text-neutral-400 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-neutral-400 group-hover:text-neutral-300 transition-colors">{{ number_format($category->videos_count) }} videos</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection
