@extends('layouts.index')

@section('title', 'All Actors')
@section('meta_description', 'Browse all actors on ' . $settings->site_name)
@section('meta_keywords', 'actors, performers, browse, ' . $settings->site_name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex items-center mb-2">
            <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
            </svg>
            <h2 class="text-3xl font-bold text-white">All Actors</h2>
        </div>
        <p class="text-neutral-400 text-lg ml-11">Browse videos by actor</p>
        <div class="h-px bg-gradient-to-r from-red-500/50 via-neutral-700 to-transparent mt-6"></div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($actors as $actor)
        <a href="{{ route('actor', $actor->slug) }}" class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden hover:bg-neutral-700/50 transition-colors group">
            <div class="relative">
                @if($actor->profile_image)
                <div class="aspect-square overflow-hidden">
                    <img src="{{ asset('storage/' . $actor->profile_image) }}" alt="{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                @else
                <div class="aspect-square bg-neutral-700 flex items-center justify-center">
                    <div class="w-20 h-20 rounded-full bg-yellow-500/20 flex items-center justify-center">
                        <svg class="w-10 h-10 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="p-4">
                <h3 class="font-medium text-neutral-100 text-lg truncate">{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}</h3>
                <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-neutral-400 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-neutral-400">{{ number_format($actor->videos_count) }} videos</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $actors->links() }}
    </div>
</div>
@endsection
