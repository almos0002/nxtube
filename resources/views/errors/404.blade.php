@extends('layouts.index')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-neutral-900">
    <div class="max-w-2xl w-full px-4 py-8">
        <div class="text-center">
            <!-- Animated 404 Text -->
            <div class="relative mb-8">
                <div class="text-9xl font-extrabold" style="background: linear-gradient(to right, #ef4444, #f87171); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 0 4px 8px rgba(239, 68, 68, 0.2);">
                    <span class="inline-block transform hover:scale-110 transition-transform duration-300">4</span>
                    <span class="inline-block transform hover:scale-110 transition-transform duration-300">0</span>
                    <span class="inline-block transform hover:scale-110 transition-transform duration-300">4</span>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-4 -left-4 w-72 h-72 bg-red-500/10 rounded-full mix-blend-overlay filter blur-xl opacity-70 animate-blob"></div>
                <div class="absolute -bottom-4 -right-4 w-72 h-72 bg-neutral-500/10 rounded-full mix-blend-overlay filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            </div>

            <!-- Error Message -->
            <div class="relative z-10 bg-neutral-800/50 backdrop-blur-lg rounded-2xl shadow-2xl border border-neutral-700/50 p-8 mb-8 transform hover:scale-105 transition-transform duration-300">
                @if(isset($message))
                    <h2 class="text-3xl font-bold text-neutral-100 mb-4">{{ $message }}</h2>
                @else
                    <h2 class="text-3xl font-bold text-neutral-100 mb-4">Oops! Page Not Found</h2>
                @endif
                <p class="text-lg text-neutral-300 mb-6">The page you're looking for seems to have gone on vacation. 🏖️</p>
                
                <!-- Animated Divider -->
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-1 bg-gradient-to-r from-red-500 to-red-600 rounded-full"></div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('home') }}" class="group w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transform transition-all duration-300 hover:scale-105 hover:shadow-lg shadow-red-500/20">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Back to Home
                    </a>
                    <button onclick="window.history.back()" class="group w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-neutral-700 rounded-lg text-base font-medium text-neutral-300 bg-neutral-800/50 hover:bg-neutral-700/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transform transition-all duration-300 hover:scale-105 hover:shadow-md backdrop-blur-lg">
                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Go Back
                    </button>
                </div>
            </div>

            <!-- Fun Element -->
            <div class="text-neutral-400 text-sm animate-bounce">
                <span class="inline-block transform hover:scale-110 transition-transform duration-300">💡</span> 
                Try refreshing the page or navigating back
            </div>
        </div>
    </div>
</div>

<!-- Add required styles for animations -->
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>
@endsection
