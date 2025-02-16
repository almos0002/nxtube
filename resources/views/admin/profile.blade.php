@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="ml-64 p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Profile Settings</h2>
            <p class="text-neutral-400">Update your profile information</p>
        </div>
    </header>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-xl mb-8">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Form -->
    <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data" class="w-full">
        @csrf
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Personal Information</h2>
            <div class="space-y-6">
                <!-- Profile Picture -->
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <div class="relative w-32 h-32">
                            <div id="avatarPreview" class="w-full h-full bg-neutral-700 rounded-full overflow-hidden flex items-center justify-center">
                                @if(auth()->user()->avatar)
                                    <img id="avatarImage" src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <img id="avatarImage" class="w-full h-full object-cover hidden">
                                    <i id="avatarPlaceholder" class="fa-duotone fa-thin fa-user text-4xl text-neutral-500"></i>
                                @endif
                            </div>
                            <button type="button" onclick="document.getElementById('avatar').click()" 
                                    class="absolute bottom-0 right-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                                <i class="fa-duotone fa-thin fa-camera text-white"></i>
                            </button>
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-neutral-100 font-medium">Profile Picture</h3>
                        <p class="text-neutral-400 text-sm mt-1">JPG, GIF or PNG. Max size of 800K</p>
                        @error('avatar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">First Name</label>
                        <input type="text" name="first_name" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="{{ old('first_name', auth()->user()->first_name) }}">
                        @error('first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Last Name</label>
                        <input type="text" name="last_name" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="{{ old('last_name', auth()->user()->last_name) }}">
                        @error('last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Contact Information -->
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Email Address</label>
                    <input type="email" name="email" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Security</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Current Password</label>
                    <input type="password" name="current_password" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">New Password</label>
                        <input type="password" name="password" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-red-500 text-white px-6 py-2.5 rounded-lg hover:bg-red-600 transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    // Avatar handling
    const avatarInput = document.getElementById('avatar');
    const avatarImage = document.getElementById('avatarImage');
    const avatarPlaceholder = document.getElementById('avatarPlaceholder');

    avatarInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                avatarImage.src = e.target.result;
                avatarImage.classList.remove('hidden');
                if (avatarPlaceholder) {
                    avatarPlaceholder.classList.add('hidden');
                }
            }
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection