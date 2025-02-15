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

    <!-- Profile Form -->
    <div class="w-full">
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Personal Information</h2>
            <div class="space-y-6">
                <!-- Profile Picture -->
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <div class="relative w-32 h-32">
                            <div id="avatarPreview" class="w-full h-full bg-neutral-700 rounded-full overflow-hidden flex items-center justify-center">
                                <img id="avatarImage" class="w-full h-full object-cover hidden">
                                <i id="avatarPlaceholder" class="fa-duotone fa-thin fa-user text-4xl text-neutral-500"></i>
                            </div>
                            <button type="button" onclick="document.getElementById('avatarInput').click()" 
                                    class="absolute bottom-0 right-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                                <i class="fa-duotone fa-thin fa-camera text-white"></i>
                            </button>
                            <input type="file" id="avatarInput" accept="image/*" class="hidden">
                        </div>
                    </div>
                    <div>
                        <h3 class="text-neutral-100 font-medium">Profile Picture</h3>
                            <p class="text-neutral-400 text-sm mt-1">JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">First Name</label>
                        <input type="text" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="John">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Last Name</label>
                        <input type="text" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="Doe">
                    </div>
                </div>

                <!-- Contact Information -->
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Email Address</label>
                    <input type="email" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="john.doe@example.com">
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Notification Settings</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-neutral-100 font-medium">Email Notifications</h3>
                        <p class="text-neutral-400 text-sm mt-1">Receive email about your account activity</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-neutral-100 font-medium">System Alerts</h3>
                        <p class="text-neutral-400 text-sm mt-1">Get notified about system updates and maintenance</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Security</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Current Password</label>
                    <input type="password" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">New Password</label>
                        <input type="password" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Confirm New Password</label>
                        <input type="password" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                    </div>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-start">
            <button type="button" class="bg-red-500 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-red-600 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-neutral-900">
                Save Changes
            </button>
        </div>
    </div>
</div>

<script>
    // Avatar handling
            const avatarInput = document.getElementById('avatarInput');
            const avatarImage = document.getElementById('avatarImage');
            const avatarPlaceholder = document.getElementById('avatarPlaceholder');

            avatarInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        avatarImage.src = e.target.result;
                        avatarImage.classList.remove('hidden');
                        avatarPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('md:translate-x-0');
    }
</script>
@endsection