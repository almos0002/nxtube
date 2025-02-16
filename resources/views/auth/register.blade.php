@extends('layouts.auth')
@section('content')
        <!-- Registration Form -->
        <div class="bg-neutral-800 rounded-xl p-8 shadow-xl">
            <h2 class="text-2xl font-bold mb-6 text-center">Create Your Account</h2>
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
                
                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-neutral-300 mb-2">First Name</label>
                        <input type="text" id="first_name" name="first_name" 
                               class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100"
                               placeholder="John"
                               value="{{ old('first_name') }}">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-neutral-300 mb-2">Last Name</label>
                        <input type="text" id="last_name" name="last_name" 
                               class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100"
                               placeholder="Singh"
                               value="{{ old('last_name') }}">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-300 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100"
                           placeholder="john@example.com"
                           value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-300 mb-2">Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100"
                           placeholder="••••••••">
                </div>
                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-neutral-300 mb-2">Confirm Password</label>
                    <input type="password" id="password-confirm" name="password_confirmation" 
                           class="w-full px-4 py-3 bg-neutral-700 border border-neutral-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-neutral-100"
                           placeholder="••••••••">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="terms" class="w-4 h-4 bg-neutral-700 border-neutral-600 rounded focus:ring-red-500 text-red-500" required>
                    <label for="terms" class="ml-2 text-sm text-neutral-300">
                        I agree to the <a href="#" class="text-red-400 hover:text-red-500">Terms of Service</a> and 
                        <a href="#" class="text-red-400 hover:text-red-500">Privacy Policy</a>
                    </label>
                </div>
                <button type="submit" 
                        class="w-full py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Create Account
                </button>
            </form>
            <p class="mt-6 text-center text-neutral-400">
                Already have an account? <a href="{{ route('login') }}" class="text-red-400 hover:text-red-500">Sign in</a>
            </p>
        </div>
@endsection