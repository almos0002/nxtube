@extends('layouts.admin')

@section('content')
<!-- Main Content -->
<div class="p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">License Verification</h2>
            <p class="text-neutral-400">Verify your CodeCanyon purchase code</p>
        </div>
    </header>

    @if(session('error'))
        <div id="errorMessage" class="bg-red-500 text-white p-4 rounded-xl mb-8">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('errorMessage').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <!-- License Verification Form -->
    <div class="max-w-3xl mx-auto">
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <div class="mb-6 flex items-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-lg bg-green-500/10 text-green-400 mr-4">
                    <i class="fa-duotone fa-thin fa-key text-xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-neutral-100">Enter Your Purchase Code</h2>
            </div>
            
            <form method="POST" action="{{ route('license.verify.post') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="purchase_code" class="block text-sm font-medium text-neutral-300 mb-2">Envato Purchase Code</label>
                    <input id="purchase_code" type="text" 
                           class="w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-green-500 @error('purchase_code') border-red-500 @enderror" 
                           name="purchase_code" value="{{ old('purchase_code') }}" 
                           placeholder="e.g. 8f8c5a5e-3c1d-4c5e-8c8d-5c8d5c8d5c8d" required autofocus>

                    @error('purchase_code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-neutral-700/30 p-4 rounded-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <i class="fa-duotone fa-thin fa-info-circle text-blue-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-neutral-300">
                                Enter your CodeCanyon purchase code to verify your license. You can find your purchase code in your 
                                <a href="https://codecanyon.net/downloads" target="_blank" class="text-green-400 hover:text-green-300 underline">CodeCanyon Downloads</a> page.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center">
                        <i class="fa-duotone fa-thin fa-check-circle mr-2"></i>
                        Verify License
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
