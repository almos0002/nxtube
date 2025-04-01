@extends('layouts.index')

@section('title', 'All Channels')
@section('meta_description', 'Browse all channels on ' . $settings->site_name)
@section('meta_keywords', 'channels, content creators, browse, ' . $settings->site_name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-10">
        <div class="flex items-center mb-2">
            <svg class="w-8 h-8 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
            </svg>
            <h2 class="text-3xl font-bold text-white">All Channels</h2>
        </div>
        <p class="text-neutral-400 text-lg ml-11">Browse videos by channel</p>
        <div class="h-px bg-gradient-to-r from-red-500/50 via-neutral-700 to-transparent mt-6"></div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($channels as $channel)
        <a href="{{ route('channel', $channel->handle) }}" class="bg-neutral-800 rounded-xl shadow-sm overflow-hidden hover:bg-neutral-700/50 transition-colors">
            <div class="relative">
                @if($channel->banner_image)
                <div class="h-32 overflow-hidden">
                    <img src="{{ asset('storage/' . $channel->banner_image) }}" alt="{{ $channel->channel_name }}" class="w-full h-full object-cover">
                </div>
                @else
                <div class="h-32 bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                @endif
                
                <div class="absolute -bottom-8 left-4">
                    @if($channel->profile_image)
                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-neutral-800">
                        <img src="{{ asset('storage/' . $channel->profile_image) }}" alt="{{ $channel->channel_name }}" class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="w-16 h-16 rounded-full bg-blue-500/20 flex items-center justify-center border-2 border-neutral-800">
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="p-4 pt-10">
                <h3 class="font-medium text-neutral-100 text-lg">{{ $channel->channel_name }}</h3>
                @if($channel->handle)
                <p class="text-sm text-neutral-400 mb-2">{{ '@' . $channel->handle }}</p>
                @endif
                <div class="flex items-center mt-2">
                    <svg class="w-4 h-4 text-neutral-400 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm text-neutral-400">{{ number_format($channel->videos_count) }} videos</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <div class="mt-8 flex justify-center">
        {{ $channels->links() }}
    </div>
</div>
@endsection
