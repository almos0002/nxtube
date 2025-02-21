@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">System Settings</h2>
            <p class="text-neutral-400">Manage your system settings</p>
        </div>
    </header>

    @if(session('success'))
        <div id="successMessage" class="bg-green-500 text-white p-4 rounded-xl mb-8">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <!-- Settings Form -->
    <form action="{{ route('settings.update') }}" method="POST" class="w-full" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Site Configuration -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Site Configuration</h2>
            <div class="space-y-6">
                <!-- Logo Upload -->
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Site Logo</label>
                    <div class="flex items-center space-x-4">
                        @if($settings->logo)
                            <div class="w-32 h-12 bg-neutral-700 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $settings->logo) }}" alt="Site Logo" class="w-full h-full object-contain">
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" id="logoInput" name="logo" accept="image/*" class="hidden">
                            <button type="button" onclick="document.getElementById('logoInput').click()" 
                                    class="px-4 py-2 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600 transition-colors flex items-center">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Logo
                            </button>
                            <p class="text-neutral-400 text-sm mt-1">Recommended: PNG or SVG (max 2MB)</p>
                        </div>
                    </div>
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Favicon Upload -->
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Site Favicon</label>
                    <div class="flex items-center space-x-4">
                        @if($settings->favicon)
                            <div class="w-8 h-8 bg-neutral-700 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Site Favicon" class="w-full h-full object-contain">
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" id="faviconInput" name="favicon" accept="image/x-icon,image/png" class="hidden">
                            <button type="button" onclick="document.getElementById('faviconInput').click()" 
                                    class="px-4 py-2 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600 transition-colors flex items-center">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Favicon
                            </button>
                            <p class="text-neutral-400 text-sm mt-1">Recommended: .ico or .png file (32x32px)</p>
                        </div>
                    </div>
                    @error('favicon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Site Name</label>
                    <input type="text" name="site_name" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                           value="{{ old('site_name', $settings->site_name) }}">
                    @error('site_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Site Description</label>
                    <textarea name="site_description" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                              rows="3">{{ old('site_description', $settings->site_description) }}</textarea>
                    @error('site_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Contact Email</label>
                        <input type="email" name="contact_email" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                               value="{{ old('contact_email', $settings->contact_email) }}">
                        @error('contact_email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Support Phone</label>
                        <input type="tel" name="support_phone" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                               value="{{ old('support_phone', $settings->support_phone) }}">
                        @error('support_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- CDN Settings -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">CDN Configuration</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">CDN Provider</label>
                    <select name="cdn_provider" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                        @foreach(['Cloudflare', 'Amazon CloudFront', 'Akamai', 'Custom'] as $provider)
                            <option value="{{ $provider }}" {{ old('cdn_provider', $settings->cdn_provider) == $provider ? 'selected' : '' }}>
                                {{ $provider }}
                            </option>
                        @endforeach
                    </select>
                    @error('cdn_provider')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">CDN URL</label>
                    <input type="url" name="cdn_url" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                           value="{{ old('cdn_url', $settings->cdn_url) }}">
                    @error('cdn_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">API Key</label>
                    <div class="relative">
                        <input type="password" name="cdn_api_key" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                               value="{{ old('cdn_api_key', $settings->cdn_api_key) }}">
                        <button type="button" onclick="togglePassword(this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-neutral-100">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('cdn_api_key')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Cache Settings -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Cache Settings</h2>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-neutral-100 font-medium">Enable Caching</h3>
                        <p class="text-neutral-400 text-sm mt-1">Improve performance by caching static content</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="cache_enabled" value="1" class="sr-only peer" 
                               {{ old('cache_enabled', $settings->cache_enabled) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
                </div>
                @error('cache_enabled')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Cache Duration (minutes)</label>
                    <input type="number" name="cache_duration" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" 
                           value="{{ old('cache_duration', $settings->cache_duration) }}" min="1">
                    @error('cache_duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-neutral-100 font-medium">Cache Static Assets</h3>
                        <p class="text-neutral-400 text-sm mt-1">Cache CSS, JavaScript, and image files</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="cache_static_assets" value="1" class="sr-only peer" 
                               {{ old('cache_static_assets', $settings->cache_static_assets) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-neutral-100 font-medium">Cache API Responses</h3>
                        <p class="text-neutral-400 text-sm mt-1">Cache API responses for improved performance</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="cache_api_responses" value="1" class="sr-only peer" 
                               {{ old('cache_api_responses', $settings->cache_api_responses) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('settings.clear-cache') }}" 
               class="bg-neutral-700 text-white px-6 py-2.5 rounded-lg hover:bg-neutral-600 transition-colors">
                Clear Cache
            </a>
            <button type="submit" class="bg-red-500 text-white px-6 py-2.5 rounded-lg hover:bg-red-600 transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    function togglePassword(button) {
        const input = button.previousElementSibling;
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        button.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    }
</script>

<script>
    // Image preview handlers
    function handleImagePreview(input, previewContainer) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                let img = previewContainer.querySelector('img');
                if (!img) {
                    const div = document.createElement('div');
                    div.className = input.id === 'logoInput' ? 'w-32 h-12' : 'w-8 h-8';
                    div.className += ' bg-neutral-700 rounded-lg overflow-hidden';
                    img = document.createElement('img');
                    img.className = 'w-full h-full object-contain';
                    div.appendChild(img);
                    previewContainer.insertBefore(div, previewContainer.firstChild);
                }
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Logo preview
    document.getElementById('logoInput').addEventListener('change', function(e) {
        handleImagePreview(this, this.closest('.flex.items-center.space-x-4'));
    });

    // Favicon preview
    document.getElementById('faviconInput').addEventListener('change', function(e) {
        handleImagePreview(this, this.closest('.flex.items-center.space-x-4'));
    });
</script>
@endsection