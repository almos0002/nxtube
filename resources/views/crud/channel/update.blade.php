@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="ml-64 p-8">
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Update Channel</h2>
            <p class="text-neutral-400">Update and customize your channel</p>
        </div>
        <button type="submit" form="channelForm" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
            Update Channel
        </button>
    </header>

    <form id="channelForm" class="w-full space-y-6" action="{{ route('update-channel', $channel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-6">
            <!-- Channel Information -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Channel Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <div class="relative w-32 h-32">
                                <div id="profilePreview" class="w-full h-full bg-neutral-700 rounded-full overflow-hidden flex items-center justify-center">
                                    @if($channel->profile_image)
                                        <img id="profileImage" src="{{ asset('storage/' . $channel->profile_image) }}" class="w-full h-full object-cover">
                                        <i id="profilePlaceholder" class="fas fa-user text-4xl text-neutral-500 hidden"></i>
                                    @else
                                        <img id="profileImage" class="w-full h-full object-cover hidden">
                                        <i id="profilePlaceholder" class="fas fa-user text-4xl text-neutral-500"></i>
                                    @endif
                                </div>
                                <button type="button" onclick="document.getElementById('profileInput').click()" 
                                        class="absolute bottom-0 right-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                                    <i class="fas fa-camera text-white"></i>
                                </button>
                                <input type="file" id="profileInput" name="profile_image" accept="image/*" class="hidden">
                            </div>
                        </div>
                        <div class="flex-grow space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-neutral-300 mb-2">Channel Name</label>
                                <input type="text" name="channel_name" required value="{{ $channel->channel_name }}"
                                       class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                                       placeholder="Your channel name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-neutral-300 mb-2">Handle</label>
                                @error('handle')
                                    <div id="errorMessage" class="mt-2 text-sm text-red-500">
                                        {{ $message }}
                                    </div>
                                    <script>
                                        setTimeout(() => {
                                            document.getElementById('errorMessage').style.display = 'none';
                                        }, 5000);
                                    </script>
                                @enderror
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400">@</span>
                                    <input type="text" name="handle" required value="{{ $channel->handle }}"
                                           class="w-full bg-neutral-700 border border-neutral-600 rounded-lg pl-8 pr-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                                           placeholder="channel_handle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Description</label>
                        <textarea name="description" rows="4" required
                                  class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                                  placeholder="Tell viewers about your channel">{{ $channel->description }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Channel Banner -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Channel Banner</h3>
                <div class="space-y-4">
                    <div class="relative w-full h-48 bg-neutral-700 rounded-lg overflow-hidden">
                        @if($channel->banner_image)
                            <img id="bannerImage" src="{{ asset('storage/' . $channel->banner_image) }}" class="w-full h-full object-cover">
                            <div id="bannerPlaceholder" class="absolute inset-0 flex items-center justify-center hidden">
                                <i class="fas fa-image text-4xl text-neutral-500"></i>
                            </div>
                        @else
                            <img id="bannerImage" class="w-full h-full object-cover hidden">
                            <div id="bannerPlaceholder" class="absolute inset-0 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-neutral-500"></i>
                            </div>
                        @endif
                    </div>
                    <p class="text-sm text-neutral-400">Recommended size: 2048x410 pixels. Max file size: 2MB</p>
                    <div class="flex justify-center">
                        <button type="button" onclick="document.getElementById('bannerInput').click()"
                                class="text-white px-6 py-2 bg-red-500 rounded-lg flex items-center space-x-2 hover:bg-red-600 transition-colors">
                            <i class="fas fa-upload mr-2"></i>
                            <span>Upload Banner</span>
                        </button>
                        <input type="file" id="bannerInput" name="banner_image" accept="image/*" class="hidden">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <!-- Social Media Links -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Social Media Links</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">
                            <i class="fab fa-youtube text-neutral-400 mr-2"></i>YouTube
                        </label>
                        <input type="url" name="youtube" value="{{ $channel->youtube }}"
                               class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                               placeholder="https://youtube.com/channel">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">
                            <i class="fab fa-twitter text-neutral-400 mr-2"></i>Twitter
                        </label>
                        <input type="url" name="twitter" value="{{ $channel->twitter }}"
                               class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                               placeholder="https://twitter.com/username">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">
                            <i class="fab fa-instagram text-neutral-400 mr-2"></i>Instagram
                        </label>
                        <input type="url" name="instagram" value="{{ $channel->instagram }}"
                               class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500"
                               placeholder="https://instagram.com/username">
                    </div>
                </div>
            </div>

            <!-- Visibility Settings -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Visibility Settings</h3>
                <div class="space-y-3">
                    <input type="radio" name="visibility" value="active" {{ $channel->visibility->value === 'active' ? 'checked' : '' }} class="hidden" id="visibilityActive">
                    <input type="radio" name="visibility" value="inactive" {{ $channel->visibility->value === 'inactive' ? 'checked' : '' }} class="hidden" id="visibilityInactive">
                    
                    <label for="visibilityActive" class="block p-3 rounded-lg cursor-pointer transition-all duration-200 hover:bg-neutral-700/70 data-[checked=true]:bg-red-500/10 data-[checked=true]:border-red-500/50 border border-transparent">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle w-5 text-neutral-400"></i>
                            <div class="ml-3">
                                <p class="text-neutral-100">Active</p>
                                <p class="text-sm text-neutral-400">Channel is active and visible to all users</p>
                            </div>
                        </div>
                    </label>
                    
                    <label for="visibilityInactive" class="block p-3 rounded-lg cursor-pointer transition-all duration-200 hover:bg-neutral-700/70 data-[checked=true]:bg-red-500/10 data-[checked=true]:border-red-500/50 border border-transparent">
                        <div class="flex items-center">
                            <i class="fas fa-times-circle w-5 text-neutral-400"></i>
                            <div class="ml-3">
                                <p class="text-neutral-100">Inactive</p>
                                <p class="text-sm text-neutral-400">Channel is hidden from users</p>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Handle visibility selection highlighting
    const visibilityInputs = document.querySelectorAll('input[name="visibility"]');
    const visibilityLabels = document.querySelectorAll('label[for^="visibility"]');
    
    function updateVisibilityStyles() {
        visibilityLabels.forEach(label => {
            const input = document.getElementById(label.getAttribute('for'));
            label.setAttribute('data-checked', input.checked);
        });
    }
    
    visibilityInputs.forEach(input => {
        input.addEventListener('change', updateVisibilityStyles);
    });
    
    // Profile image handling
    const profileInput = document.getElementById('profileInput');
    const profileImage = document.getElementById('profileImage');
    const profilePlaceholder = document.getElementById('profilePlaceholder');
    
    profileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                profileImage.src = e.target.result;
                profileImage.classList.remove('hidden');
                profilePlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Banner image handling
    const bannerInput = document.getElementById('bannerInput');
    const bannerImage = document.getElementById('bannerImage');
    const bannerPlaceholder = document.getElementById('bannerPlaceholder');
    
    bannerInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                bannerImage.src = e.target.result;
                bannerImage.classList.remove('hidden');
                bannerPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Initialize visibility styles
    updateVisibilityStyles();
</script>
@endsection
