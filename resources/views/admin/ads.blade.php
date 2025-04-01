@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Ads Management</h2>
            <p class="text-neutral-400">Configure advertising settings for your site</p>
        </div>
        <div>
            <form action="{{ route('ads.toggle-status') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-lg {{ $ads->is_active ? 'bg-neutral-700 hover:bg-neutral-600' : 'bg-red-500 hover:bg-red-600' }} text-white transition-colors">
                    {{ $ads->is_active ? 'Disable Ads' : 'Enable Ads' }}
                </button>
            </form>
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

    @if($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-xl mb-8">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Ads Form -->
    <form action="{{ route('ads.update') }}" method="POST" class="w-full" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Banner Ads -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Banner Ads</h2>
            
            <div class="space-y-8">
                <!-- Banner 1 -->
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Banner Ad 1</label>
                    <div class="flex items-start space-x-4">
                        @if($ads->ads_banner_1)
                            <div class="w-64 h-32 bg-neutral-700 rounded-lg overflow-hidden">
                                @if(Str::startsWith($ads->ads_banner_1, ['http://', 'https://']) || Str::contains($ads->ads_banner_1, ['<script', '<iframe', '<div']))
                                    <div class="p-2 text-neutral-300 text-sm">HTML/JS Ad Code</div>
                                @else
                                    <img src="{{ asset('storage/' . $ads->ads_banner_1) }}" alt="Banner 1" class="w-full h-full object-contain">
                                @endif
                            </div>
                        @else
                            <div class="w-64 h-32 bg-neutral-700 rounded-lg flex items-center justify-center">
                                <span class="text-neutral-400">No banner set</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="relative mb-4">
                                <input type="file" id="banner1Input" name="banner_1_image" accept="image/*" class="hidden">
                                <button type="button" onclick="document.getElementById('banner1Input').click()" 
                                        class="px-4 py-2 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600 transition-colors flex items-center">
                                    <i class="fas fa-upload mr-2"></i>
                                    Upload Banner 1
                                </button>
                                <p class="text-neutral-400 text-sm mt-1">Recommended size: 728x90 (max 2MB)</p>
                            </div>
                            <p class="text-neutral-400 text-sm mb-2">Or paste custom HTML/JS code:</p>
                            <textarea name="ads_banner_1" rows="4" class="form-textarea w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">{{ old('ads_banner_1', $ads->ads_banner_1) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Banner 2 -->
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Banner Ad 2</label>
                    <div class="flex items-start space-x-4">
                        @if($ads->ads_banner_2)
                            <div class="w-64 h-32 bg-neutral-700 rounded-lg overflow-hidden">
                                @if(Str::startsWith($ads->ads_banner_2, ['http://', 'https://']) || Str::contains($ads->ads_banner_2, ['<script', '<iframe', '<div']))
                                    <div class="p-2 text-neutral-300 text-sm">HTML/JS Ad Code</div>
                                @else
                                    <img src="{{ asset('storage/' . $ads->ads_banner_2) }}" alt="Banner 2" class="w-full h-full object-contain">
                                @endif
                            </div>
                        @else
                            <div class="w-64 h-32 bg-neutral-700 rounded-lg flex items-center justify-center">
                                <span class="text-neutral-400">No banner set</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <div class="relative mb-4">
                                <input type="file" id="banner2Input" name="banner_2_image" accept="image/*" class="hidden">
                                <button type="button" onclick="document.getElementById('banner2Input').click()" 
                                        class="px-4 py-2 bg-neutral-700 text-neutral-300 rounded-lg hover:bg-neutral-600 transition-colors flex items-center">
                                    <i class="fas fa-upload mr-2"></i>
                                    Upload Banner 2
                                </button>
                                <p class="text-neutral-400 text-sm mt-1">Recommended size: 300x250 (max 2MB)</p>
                            </div>
                            <p class="text-neutral-400 text-sm mb-2">Or paste custom HTML/JS code:</p>
                            <textarea name="ads_banner_2" rows="4" class="form-textarea w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">{{ old('ads_banner_2', $ads->ads_banner_2) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Popup Ad -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Popup Ad</h2>
            
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Popup Ad Code</label>
                <p class="text-neutral-400 text-sm mb-2">Paste HTML/JS code for popup ad:</p>
                <textarea name="ads_popup" rows="6" class="form-textarea w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">{{ old('ads_popup', $ads->ads_popup) }}</textarea>
                <p class="text-neutral-400 text-sm mt-2">This code will be used for popup advertisements on your site.</p>
            </div>
        </div>
        
        <!-- Video Ad -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Video Ad</h2>
            
            <div>
                <label class="block text-sm font-medium text-neutral-300 mb-2">Video Ad Code</label>
                <p class="text-neutral-400 text-sm mb-2">Paste VAST/VPAID ad tag or custom video ad code:</p>
                <textarea name="ads_video" rows="6" class="form-textarea w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">{{ old('ads_video', $ads->ads_video) }}</textarea>
                <p class="text-neutral-400 text-sm mt-2">This code will be used for pre-roll, mid-roll, or post-roll video ads.</p>
            </div>
        </div>
        
        <!-- Status Toggle -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-neutral-100">Enable Ads</h2>
                    <p class="text-neutral-400 text-sm">Turn on/off all ads across the site</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" class="sr-only peer" {{ $ads->is_active ? 'checked' : '' }}>
                    <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                </label>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    // Preview uploaded images
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgContainer = input.closest('div').closest('div').previousElementSibling;
                    if (imgContainer) {
                        if (imgContainer.querySelector('img')) {
                            imgContainer.querySelector('img').src = e.target.result;
                        } else {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Ad Preview';
                            img.className = 'w-full h-full object-contain';
                            imgContainer.appendChild(img);
                        }
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
