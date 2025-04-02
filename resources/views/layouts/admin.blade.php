<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name }} - Admin Dashboard</title>
    @if ($settings->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Responsive scaling implementation */
        :root {
            --scale-factor: 0.9;
        }
        
        /* Scale based on screen size */
        @media (max-width: 1366px) {
            :root {
                --scale-factor: 0.85;
            }
        }
        
        @media (max-width: 1024px) {
            :root {
                --scale-factor: 0.9;
            }
        }
        
        @media (min-width: 1920px) {
            :root {
                --scale-factor: 0.95;
            }
        }
        
        html {
            font-size: calc(100% * var(--scale-factor));
        }
        
        @supports (zoom: 1) {
            body {
                zoom: var(--scale-factor);
            }
        }
        
        @supports not (zoom: 1) {
            body {
                transform: scale(var(--scale-factor));
                transform-origin: 0 0;
                width: calc(100% / var(--scale-factor));
                min-height: calc(100vh / var(--scale-factor));
            }
        }
        
        /* Adjust font sizes for better readability */
        .sidebar-content {
            font-size: calc(1rem / var(--scale-factor));
        }
        
        /* Increase icon sizes for better visibility */
        .fa-duotone {
            font-size: 1.2em;
        }

        /* UI Element Styles */
        .nav-item {
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 0 12px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            transition: all 0.3s ease;
        }

        .chart-container:hover {
            transform: scale(1.02);
        }

        /* Added styles for scrollable sidebar */
        #sidebar {
            display: flex;
            flex-direction: column;
        }

        #sidebar>div:first-child {
            flex-shrink: 0;
        }

        .sidebar-content {
            flex-grow: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.1) transparent;
        }

        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-content::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-neutral-900">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-neutral-800 text-neutral-100 transition-transform duration-300 transform md:translate-x-0 shadow-2xl z-30"
            id="sidebar">
            <div class="p-6 border-b border-neutral-700/30">
                <div class="flex items-center space-x-4">
                    @if ($settings->logo)
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name }}"
                            class="h-8 w-auto">
                    @else
                        <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-play-circle text-white text-xl"></i>
                        </div>
                    @endif
                    <h1 class="text-2xl font-bold">{{ $settings->site_name }}</h1>
                </div>
            </div>
            <div class="sidebar-content">
                <div class="mt-6 px-4">
                    <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-4 px-4">Content
                        Management</p>
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('dashboard') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-house text-lg w-8"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('videos') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('videos') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-video text-lg w-8"></i>
                            <span>Videos</span>
                        </a>

                        <a href="{{ route('categories') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('categories') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-list text-lg w-8"></i>
                            <span>Categories</span>
                        </a>

                        <a href="{{ route('actors') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('actors') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-user-tie text-lg w-8"></i>
                            <span>Actors</span>
                        </a>

                        <a href="{{ route('channels') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('channels') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-hashtag text-lg w-8"></i>
                            <span>Channels</span>
                        </a>
                    </nav>

                    <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider mb-4 mt-8 px-4">System</p>
                    <nav class="space-y-2">
                        <a href="{{ route('profile') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('profile') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-user-circle text-lg w-8"></i>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('settings') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('settings') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-cog text-lg w-8"></i>
                            <span>Settings</span>
                        </a>
                        <a href="{{ route('ads') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('ads') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-rectangle-ad text-lg w-8"></i>
                            <span>Ads</span>
                        </a>
                        <a href="{{ route('admin.seo.index') }}"
                            class="nav-item px-4 py-3 flex items-center transition-colors hover:bg-neutral-700/30 {{ request()->routeIs('admin.seo.index') ? 'bg-neutral-700/30' : '' }}">
                            <i class="fa-duotone fa-thin fa-search-plus text-lg w-8"></i>
                            <span>SEO</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>

                        <a href="#" class="nav-item px-4 py-3 flex items-center cursor-pointer text-red-400"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-duotone fa-thin fa-sign-out-alt text-lg w-8"></i>
                            <span>Logout</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Content Area -->
            <main class="min-h-screen">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
