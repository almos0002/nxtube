@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="ml-64 p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">System Settings</h2>
            <p class="text-neutral-400">Manage your system settings</p>
        </div>
    </header>

    <!-- Settings Form -->
    <div class="w-full">
        <!-- Site Configuration -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Site Configuration</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Site Name</label>
                    <input type="text" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="VideoFlex">
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Site Description</label>
                    <textarea class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" rows="3">A modern video streaming platform</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Contact Email</label>
                        <input type="email" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="support@videoflex.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Support Phone</label>
                        <input type="tel" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="+1 (555) 123-4567">
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
                    <select class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                        <option>Cloudflare</option>
                        <option>Amazon CloudFront</option>
                        <option>Akamai</option>
                        <option>Custom</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">CDN URL</label>
                    <input type="url" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="https://cdn.videoflex.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">API Key</label>
                    <div class="relative">
                        <input type="password" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="••••••••••••••••">
                        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-neutral-400 hover:text-neutral-100">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
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
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Cache Duration (hours)</label>
                    <input type="number" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="24">
                </div>
                <div>
                    <button type="button" class="bg-neutral-700 text-neutral-100 px-4 py-2 rounded-lg hover:bg-neutral-600 transition-colors">
                        Clear Cache
                    </button>
                </div>
            </div>
        </div>

        <!-- Integration Settings -->
        <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-100 mb-6">Integration Settings</h2>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Analytics Provider</label>
                    <select class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none">
                        <option>Google Analytics</option>
                        <option>Mixpanel</option>
                        <option>Custom</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-2">Analytics ID</label>
                    <input type="text" class="form-input w-full bg-neutral-700 border-neutral-600 rounded-lg px-4 py-2.5 text-neutral-100 focus:outline-none" value="UA-XXXXXXXXX-X">
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-neutral-100 font-medium">Enable Error Tracking</h3>
                        <p class="text-neutral-400 text-sm mt-1">Track and report application errors</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                    </label>
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
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
        sidebar.classList.toggle('md:translate-x-0');
    }
</script>
@endsection