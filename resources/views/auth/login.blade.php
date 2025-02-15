@extends('layouts.auth') 
        
@section('content')
        <!-- Login Form -->
        <div class="bg-neutral-800 rounded-xl p-8 shadow-xl">
            <h2 class="text-2xl font-bold text-neutral-100 mb-6 text-center">Welcome Back</h2>
            @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('password')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100" 
                           placeholder="Enter your email">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100" 
                           placeholder="Enter your password"
                           @error('password') is-invalid @enderror>
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center" for="remember">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 bg-neutral-700 border-neutral-600 rounded focus:ring-red-500 text-red-500" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-neutral-300">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-400 hover:text-red-500">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" 
                        class="w-full py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Sign In
                </button>
            </form>
            <p class="mt-6 text-center text-neutral-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-red-400 hover:text-red-500">Sign up</a>
            </p>
        </div>
@endsection