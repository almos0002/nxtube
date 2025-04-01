@extends('layouts.index')

@section('title', 'Page Not Found')

@section('content')
@php
    // Explicitly hide breadcrumbs
    $hideBreadcrumbs = true;
@endphp

<div class="min-h-[70vh] flex items-center justify-center">
    <div class="max-w-3xl w-full px-4 py-6">
        <div class="relative overflow-hidden bg-neutral-800/60 backdrop-blur-xl rounded-2xl shadow-xl border border-neutral-700/50 p-6">
            <!-- Background Elements -->
            <div class="absolute -top-20 -right-20 w-48 h-48 bg-red-500/20 rounded-full mix-blend-overlay filter blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-neutral-500/20 rounded-full mix-blend-overlay filter blur-3xl"></div>
            
            <div class="relative z-10">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row items-center gap-6 mb-6">
                    <!-- 404 Text -->
                    <div class="text-center md:text-left md:flex-1">
                        <h1 class="text-7xl md:text-8xl font-black mb-2" style="background: linear-gradient(135deg, #ef4444 0%, #f87171 50%, #ef4444 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-size: 200% 200%; animation: gradient-shift 5s ease infinite;">404</h1>
                        <div class="h-1 w-16 md:w-24 bg-gradient-to-r from-red-500 to-red-600 rounded-full mb-3 mx-auto md:mx-0"></div>
                        <h2 class="text-xl font-bold text-white mb-1">Page Not Found</h2>
                        <p class="text-sm text-neutral-300">This page doesn't exist or has been moved.</p>
                    </div>
                    
                    <!-- Illustration -->
                    <div class="md:flex-shrink-0 flex justify-center">
                        <div class="relative w-32 h-32 md:w-40 md:h-40">
                            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-red-500 opacity-90">
                                <path fill="currentColor" d="M44.5,-76.3C59.3,-69.9,73.9,-60.5,81.8,-47C89.7,-33.4,90.9,-16.7,88.1,-1.6C85.4,13.4,78.8,26.9,70.8,39.8C62.8,52.7,53.4,65.1,41.1,73.5C28.8,81.9,14.4,86.3,-0.2,86.6C-14.8,87,-29.6,83.3,-42.6,75.9C-55.6,68.5,-66.8,57.4,-74.6,44.1C-82.4,30.8,-86.8,15.4,-87.8,-0.6C-88.8,-16.6,-86.4,-33.1,-78.2,-46C-70,-58.8,-56,-67.9,-41.4,-74.4C-26.9,-80.9,-13.4,-84.8,0.9,-86.3C15.2,-87.8,30.4,-86.9,44.5,-76.3Z" transform="translate(100 100)" />
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-video-slash text-4xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Search Box -->
                <div class="bg-neutral-900/50 backdrop-blur-sm rounded-lg p-4 mb-5 border border-neutral-700/50">
                    <form action="{{ route('search') }}" method="GET" class="flex">
                        <input type="text" name="q" placeholder="Search videos..." class="flex-1 bg-neutral-800 border border-neutral-700 rounded-l-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-3 py-2 rounded-r-lg transition-all duration-300">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Navigation Options - New Design -->
                <div class="flex justify-center">
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <a href="{{ route('home') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 rounded-l-lg hover:bg-gradient-to-r hover:from-red-700 hover:to-red-800 focus:z-10 focus:ring-2 focus:ring-red-500 focus:bg-red-700 inline-flex items-center">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                        <button onclick="window.history.back()" class="px-5 py-2.5 text-sm font-medium text-white bg-neutral-800 border-y border-r border-neutral-700 rounded-r-lg hover:bg-neutral-700 focus:z-10 focus:ring-2 focus:ring-neutral-700 focus:bg-neutral-700 inline-flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Popular Categories -->
        <div class="mt-4 text-center">
            <div class="flex flex-wrap justify-center gap-2 mt-2">
                @foreach(\App\Models\Category::take(5)->orderBy('videos_count', 'desc')->get() as $category)
                    <a href="{{ route('category', $category->slug) }}" class="px-3 py-1 bg-neutral-800/50 hover:bg-red-500/80 rounded-full text-xs transition-all duration-300">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Add required styles for animations -->
<style>
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>
@endsection
