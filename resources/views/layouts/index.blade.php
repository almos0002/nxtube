<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if (request()->is('/'))
            {{ $settings->site_name }} - {{ $settings->tagline }}
        @else
            @yield('title') - {{ $settings->site_name }}
        @endif
    </title>
    <meta name="description" content="@yield('meta_description', $settings->site_description ?? 'Watch cool videos online for free')" />
    <meta name="keywords" content="@yield('meta_keywords', 'Amazing, cool, video,')" />
    <meta name="og:image" content="@yield('og_image', $settings->site_logo)" />

    @if (isset($seoSettings) && $seoSettings->is_active)
        <!-- SEO Verification Tags -->
        {!! \App\Helpers\SeoHelper::getVerificationTags() !!}

        <!-- Canonical URL -->
        @if ($seoSettings->enable_canonical_urls)
            <link rel="canonical" href="{{ \App\Helpers\SeoHelper::getCanonicalUrl(url()->current()) }}" />
        @endif

        <!-- Social Meta Tags -->
        @if ($seoSettings->enable_social_meta)
            <meta property="og:title" content="@yield('title', $settings->site_name)" />
            <meta property="og:description" content="@yield('meta_description', $settings->site_description)" />
            <meta property="og:url" content="{{ url()->current() }}" />
            <meta property="og:type" content="website" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" content="@yield('title', $settings->site_name)" />
            <meta name="twitter:description" content="@yield('meta_description', $settings->site_description)" />
        @endif

        <!-- Custom Meta Tags -->
        {!! $seoSettings->custom_meta_tags ?? '' !!}

        <!-- Structured Data -->
        @if ($seoSettings->structured_data)
            <script type="application/ld+json">
                {!! $seoSettings->structured_data !!}
            </script>
        @endif
    @endif

    <link rel="shortcut icon" href="{{ asset('storage/' . ($settings->favicon ?? 'favicon.ico')) }}"
        type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .video-card {
            transition: all 0.3s ease;
        }

        .video-card:hover {
            transform: translateY(-4px);
        }

        .video-card .thumbnail-wrapper {
            overflow: hidden;
            border-radius: 1rem;
        }

        .video-card .thumbnail {
            transform: scale(1);
            transition: transform 0.5s ease;
        }

        .video-card:hover .thumbnail {
            transform: scale(1.05);
        }

        .video-card .play-icon {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.8);
            transition: all 0.3s ease;
        }

        .video-card:hover .play-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        /* Center the play icon within the circle */
        .video-card .play-icon .fa-play {
            margin-left: 2px;
            /* Adjust for visual centering */
        }

        .video-card .duration {
            opacity: 0.9;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        .video-card:hover .duration {
            opacity: 1;
            transform: translateY(-2px);
        }

        .video-card .metadata {
            transition: color 0.3s ease;
        }

        .video-card:hover .title {
            color: #ef4444;
        }

        /* Mobile Menu Styles */
        .mobile-menu-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .mobile-menu-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu-sidebar.active {
            transform: translateX(0);
        }

        /* Dropdown Menu Styles */
        .categories-dropdown {
            visibility: hidden;
            opacity: 0;
            transform: translateY(-10px);
            transition: visibility 0s linear 0.2s, opacity 0.2s, transform 0.2s;
        }

        .categories-group:hover .categories-dropdown {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0s;
        }

        .categories-dropdown:hover {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }

        /* Breadcrumbs Styles */
        .breadcrumbs {
            overflow: visible;
            white-space: normal;
            padding-bottom: 5px;
        }

        .breadcrumbs ol {
            flex-wrap: wrap;
        }

        .breadcrumbs .truncate {
            max-width: 150px;
        }

        @media (min-width: 640px) {
            .breadcrumbs .truncate {
                max-width: 250px;
            }
        }

        @media (min-width: 768px) {
            .breadcrumbs .truncate {
                max-width: 350px;
            }
        }

        /* Standard container class */
        .nx-container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .nx-container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .nx-container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
    </style>
</head>

<body class="bg-neutral-900 text-neutral-100">
    <!-- Navbar -->
    <nav
        class="fixed top-0 left-0 right-0 z-30 bg-neutral-800/80 backdrop-blur-md border-b border-neutral-700/50 transition-all">
        <div class="nx-container">
            <div class="flex items-center justify-between h-16">
                <!-- Logo and Desktop Navigation -->
                <div class="flex items-center space-x-4 md:space-x-8">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button"
                        class="md:hidden flex items-center justify-center w-10 h-10 text-neutral-100 hover:text-red-500 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <a href="{{ url('/') }}" class="flex items-center space-x-2 md:space-x-3">
                        <img src="{{ asset('storage/' . ($settings->logo ?? 'logo.png')) }}"
                            alt="{{ $settings->site_name ?? 'VideoFlex' }}" class="h-6 md:h-8 w-auto">
                        @if (!isset($settings->logo))
                            <span
                                class="text-lg md:text-xl font-bold truncate">{{ $settings->site_name ?? 'VideoFlex' }}</span>
                        @endif
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ url('/') }}"
                            class="text-neutral-100 hover:text-red-500 transition-colors">Home</a>
                        <div class="relative categories-group">
                            <button class="text-neutral-100 hover:text-red-500 transition-colors flex items-center">
                                Categories
                                <i
                                    class="fas fa-chevron-down ml-2 text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            <!-- Categories Dropdown -->
                            <div
                                class="categories-dropdown absolute left-0 mt-2 w-[520px] bg-neutral-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-neutral-700 
                                      grid grid-cols-3 gap-3 p-6 z-50 transform opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 
                                      transition-all duration-200">
                                <div class="col-span-3 mb-2">
                                    <h3 class="text-sm font-semibold text-neutral-400 uppercase tracking-wider mb-2">
                                        Browse Categories</h3>
                                </div>
                                @foreach ($categories as $category)
                                    <a href="{{ route('category', $category->slug) }}"
                                        class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                        <div
                                            class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                            <span class="text-red-500 text-sm">#</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium group-hover/item:text-red-500 transition-colors">
                                                {{ $category->name }}</h4>
                                            <p class="text-sm text-neutral-400">{{ $category->videos_count }} videos
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('all-actors') }}"
                            class="text-neutral-100 hover:text-red-500 transition-colors">Actors</a>
                        <a href="{{ route('all-channels') }}"
                            class="text-neutral-100 hover:text-red-500 transition-colors">Channels</a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 flex justify-end items-center">
                    <div class="relative">
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                placeholder="Search videos..."
                                class="w-48 md:w-64 lg:w-96 px-4 py-2 rounded-xl bg-neutral-800/50 border border-neutral-700 text-neutral-100 placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <button type="submit"
                                class="absolute right-3 top-1/2 -translate-y-1/2 flex items-center justify-center text-neutral-400 hover:text-red-500 transition-colors">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu-overlay"
        class="md:hidden fixed inset-0 z-40 bg-neutral-900/50 backdrop-blur-sm mobile-menu-overlay hidden"></div>
    <div id="mobile-menu"
        class="md:hidden fixed left-0 top-0 bottom-0 w-80 bg-neutral-800/90 backdrop-blur-md z-50 mobile-menu-sidebar">
        <div class="flex flex-col h-full">
            <!-- Mobile Menu Header -->
            <div class="p-4 border-b border-neutral-700">
                <a href="{{ url('/') }}" class="inline-flex items-center space-x-3">
                    <img src="{{ asset('storage/' . ($settings->logo ?? 'logo.png')) }}"
                        alt="{{ $settings->site_name ?? 'VideoFlex' }}" class="h-8 w-auto">
                    @if (!isset($settings->logo))
                        <span class="text-xl font-bold">{{ $settings->site_name ?? 'VideoFlex' }}</span>
                    @endif
                </a>
            </div>

            <!-- Mobile Menu Items -->
            <div class="flex-1 overflow-y-auto py-4">
                <div class="px-4 space-y-6">
                    <a href="{{ url('/') }}"
                        class="block py-2.5 px-4 rounded-lg text-base font-medium text-neutral-100 hover:text-red-500 hover:bg-neutral-700/50 transition-all">
                        <i class="fas fa-home mr-3"></i>Home
                    </a>
                    <div class="space-y-4">
                        <button id="mobile-categories-button"
                            class="w-full flex items-center justify-between py-2.5 px-4 rounded-lg text-base font-medium text-neutral-100 hover:text-red-500 hover:bg-neutral-700/50 transition-all">
                            <span class="flex items-center">
                                <i class="fas fa-list-ul mr-3"></i>
                                <span>Categories</span>
                            </span>
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="mobile-categories-content" class="hidden">
                            <div class="grid grid-cols-2 gap-2 px-4">
                                @foreach ($categories as $category)
                                    <a href="{{ route('category', $category->slug) }}"
                                        class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                        <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                            <span class="text-red-500 text-sm">#</span>
                                        </div>
                                        <span class="text-sm">{{ $category->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('all-actors') }}"
                        class="block py-2.5 px-4 rounded-lg text-base font-medium text-neutral-100 hover:text-red-500 hover:bg-neutral-700/50 transition-all">
                        <i class="fas fa-user-tie mr-3"></i>Actors
                    </a>
                    <a href="{{ route('all-channels') }}"
                        class="block py-2.5 px-4 rounded-lg text-base font-medium text-neutral-100 hover:text-red-500 hover:bg-neutral-700/50 transition-all">
                        <i class="fas fa-tv mr-3"></i>Channels
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Footer -->
            <div class="p-4 border-t border-neutral-700">
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-neutral-400 hover:text-red-500">
                        <i class="fas fa-cog text-xl"></i>
                    </a>
                    <a href="#" class="text-neutral-400 hover:text-red-500">
                        <i class="fas fa-question-circle text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <main class="nx-container py-8 mt-16">
        <!-- Breadcrumbs -->
        @if (
            !request()->routeIs('home') &&
                !isset($hideBreadcrumbs) &&
                (request()->routeIs('category') ||
                    request()->routeIs('tag') ||
                    request()->routeIs('actor') ||
                    request()->routeIs('channel') ||
                    request()->routeIs('video') ||
                    request()->routeIs('search') ||
                    request()->routeIs('contact') ||
                    request()->routeIs('about') ||
                    request()->routeIs('privacy') ||
                    request()->routeIs('dmca')))
            <div class="nx-container">
                <div class="breadcrumbs mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center text-sm font-medium text-neutral-400 hover:text-red-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 001 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Home
                                </a>
                            </li>

                            @if (request()->routeIs('category') && isset($category))
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <a href="{{ route('all-categories') }}"
                                            class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">Categories</a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium text-neutral-300 truncate">{{ $category->name }}</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('tag') && isset($tag))
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <a href="{{ route('tags') }}"
                                            class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">Tags</a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium text-neutral-300">#{{ $tag->name }}</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('actor') && isset($actor))
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <a href="{{ route('all-actors') }}"
                                            class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">Actors</a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium text-neutral-300">{{ $actor->stagename ?? $actor->firstname . ' ' . $actor->lastname }}</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('channel') && isset($channel))
                                <li>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <a href="{{ route('all-channels') }}"
                                            class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">Channels</a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium text-neutral-300">{{ $channel->handle ? '@' . $channel->handle : $channel->channel_name }}</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('video') && isset($video))
                                @if ($video->categories->count() > 0)
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-neutral-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <a href="{{ route('category', $video->categories->first()->slug) }}"
                                                class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">{{ $video->categories->first()->name }}</a>
                                        </div>
                                    </li>
                                @endif
                                @if ($video->actors->count() > 0)
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-neutral-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <a href="{{ route('actor', $video->actors->first()->slug) }}"
                                                class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">{{ $video->actors->first()->stagename ?? $video->actors->first()->firstname . ' ' . $video->actors->first()->lastname }}</a>
                                        </div>
                                    </li>
                                @endif
                                @if ($video->channels->count() > 0)
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-neutral-500" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <a href="{{ route('channel', $video->channels->first()->handle) }}"
                                                class="ml-1 text-sm font-medium text-neutral-400 hover:text-red-500">{{ $video->channels->first()->channel_name }}</a>
                                        </div>
                                    </li>
                                @endif
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium text-neutral-300 truncate">{{ $video->title }}</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('search') && isset($query))
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-neutral-300">Search Results:
                                            "{{ $query }}"</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('contact'))
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-neutral-300">Contact Us</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('about'))
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-neutral-300">About Us</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('privacy'))
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-neutral-300">Privacy Policy</span>
                                    </div>
                                </li>
                            @endif

                            @if (request()->routeIs('dmca'))
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-neutral-500" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="ml-1 text-sm font-medium text-neutral-300">DMCA Policy</span>
                                    </div>
                                </li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        @endif

        @if ($siteAds->is_active && $siteAds->ads_banner_1 && !request()->route()->named('video'))
            <!-- Top Banner Ad (not shown on video page) -->
            <div class="w-full h-30 overflow-hidden flex justify-center">
                @if (Str::startsWith($siteAds->ads_banner_1, ['http://', 'https://']) ||
                        Str::contains($siteAds->ads_banner_1, ['<script', '<iframe', '<div']))
                    {!! $siteAds->ads_banner_1 !!}
                @else
                    <img src="{{ asset('storage/' . $siteAds->ads_banner_1) }}" alt="Advertisement"
                        class="w-full h-full object-cover rounded-lg">
                @endif
            </div>
        @endif
        @yield('content')
        @if ($siteAds->is_active && $siteAds->ads_banner_1 && !request()->route()->named('video'))
            <!-- Bottom Banner Ad (not shown on video page) -->
            <div class="w-full h-30 overflow-hidden flex justify-center">
                @if (Str::startsWith($siteAds->ads_banner_1, ['http://', 'https://']) ||
                        Str::contains($siteAds->ads_banner_1, ['<script', '<iframe', '<div']))
                    {!! $siteAds->ads_banner_1 !!}
                @else
                    <img src="{{ asset('storage/' . $siteAds->ads_banner_1) }}" alt="Advertisement"
                        class="w-full h-full object-cover rounded-lg">
                @endif
            </div>
        @endif
    </main>
    <!-- Footer -->
    <footer class="bg-gradient-to-b from-neutral-900 to-neutral-800 border-t border-neutral-700">
        <!-- Newsletter Section -->
        <div class="border-b border-neutral-700/50">
            <div class="nx-container py-12">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                        <h3
                            class="text-2xl font-bold bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">
                            Stay Updated</h3>
                        <p class="text-neutral-400 mt-2">Get the latest updates about new videos and features</p>
                    </div>
                    <div class="flex-1 max-w-md w-full">
                        <form class="flex gap-2">
                            <input type="email" placeholder="Enter your email"
                                class="flex-1 px-4 py-2 bg-neutral-700/50 rounded-lg border border-neutral-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <button type="submit"
                                class="px-6 py-2 bg-red-500 hover:bg-red-600 rounded-lg font-medium transition-colors">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="nx-container py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand Section -->
                <div class="space-y-4">
                    <a href="{{ url('/') }}" class="inline-flex items-center space-x-3">
                        <img src="{{ asset('storage/' . ($settings->logo ?? 'logo.png')) }}"
                            alt="{{ $settings->site_name ?? 'VideoFlex' }}" class="h-8 w-auto">
                        @if (!isset($settings->logo))
                            <span class="text-xl font-bold">{{ $settings->site_name ?? 'VideoFlex' }}</span>
                        @endif
                    </a>
                    <p class="text-neutral-400 text-sm">Your ultimate destination for high-quality video content.
                        Stream, share, and enjoy!</p>
                    <div class="flex items-center space-x-4">
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-twitter text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-facebook text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-instagram text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-youtube text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-neutral-400 hover:text-red-500 transition-colors">Contact</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Privacy
                                Policy</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Terms
                                of
                                Service</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">FAQ</a>
                        </li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Top Categories</h4>
                    <ul class="space-y-3">
                        @foreach ($categories->take(5) as $category)
                            <li><a href="{{ route('category', $category->slug) }}"
                                    class="text-neutral-400 hover:text-red-500 transition-colors">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                            <span class="text-neutral-400">123 Video Street, CA 94107</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-red-500"></i>
                            <span class="text-neutral-400">+1 234 567 890</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-red-500"></i>
                            <span class="text-neutral-400">support@videoflex.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="mt-12 pt-8 border-t border-neutral-700">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-neutral-400 text-sm"> 2025 VideoFlex. All rights reserved.</p>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('privacy') }}"
                            class="text-neutral-400 hover:text-red-500 transition-colors text-sm">Privacy</a>
                        <a href="{{ route('dmca') }}"
                            class="text-neutral-400 hover:text-red-500 transition-colors text-sm">DMCA</a>
                        <a href="{{ route('about') }}"
                            class="text-neutral-400 hover:text-red-500 transition-colors text-sm">About</a>
                        <a href="{{ route('contact') }}"
                            class="text-neutral-400 hover:text-red-500 transition-colors text-sm">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Update JavaScript for mobile menu -->
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            const menuIcon = document.querySelector('#mobile-menu-button i');

            mobileMenu.classList.toggle('active');
            mobileMenuOverlay.classList.toggle('hidden');
            menuIcon.classList.toggle('fa-times');
        }

        function toggleMobileCategories() {
            const button = document.getElementById('mobile-categories-button');
            const content = document.getElementById('mobile-categories-content');
            const icon = button.querySelector('i');

            content.classList.toggle('hidden');
            icon.style.transform = content.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        }

        document.getElementById('mobile-menu-button').addEventListener('click', toggleMobileMenu);
        document.getElementById('mobile-menu-overlay').addEventListener('click', toggleMobileMenu);
        document.getElementById('mobile-categories-button').addEventListener('click', toggleMobileCategories);
    </script>

    @if ($siteAds->is_active && $siteAds->ads_video)
        {!! $siteAds->ads_video !!}
    @endif

    @if ($siteAds->is_active && $siteAds->ads_popup)
        {!! $siteAds->ads_popup !!}
    @endif

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent" class="fixed bottom-0 left-0 right-0 bg-gradient-to-r from-neutral-900 via-neutral-800 to-neutral-900 border-t border-red-600/30 shadow-lg transform translate-y-full transition-all duration-300 ease-in-out z-50">
        <div class="nx-container py-4 relative overflow-hidden">
            <!-- Cool decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-600/5 rounded-full filter blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-red-600/5 rounded-full filter blur-2xl translate-y-1/2 -translate-x-1/4"></div>
            
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 relative">
                <div class="text-neutral-200 flex items-center space-x-3">
                    <div class="hidden sm:block text-red-500 text-xl">
                        <i class="fas fa-cookie-bite"></i>
                    </div>
                    <p class="text-sm">
                        This website uses cookies to ensure you get the best experience. 
                        <a href="{{ route('privacy') }}" class="text-red-500 hover:text-red-400 underline transition-colors">Learn more</a>
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <button id="cookie-decline" class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-white text-sm font-medium rounded transition-colors relative overflow-hidden group">
                        <span class="relative z-10">Decline</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-neutral-700 to-neutral-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </button>
                    <button id="cookie-accept" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded transition-colors relative overflow-hidden group">
                        <span class="relative z-10">Accept</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-red-600 to-red-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cookie Consent Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cookieConsent = document.getElementById('cookie-consent');
            const acceptButton = document.getElementById('cookie-accept');
            const declineButton = document.getElementById('cookie-decline');
            
            // Check if user has already made a choice
            if (!localStorage.getItem('cookieConsent')) {
                // Show the banner with a slight delay
                setTimeout(() => {
                    cookieConsent.classList.remove('translate-y-full');
                }, 1000);
            }
            
            // Handle accept button click
            acceptButton.addEventListener('click', function() {
                localStorage.setItem('cookieConsent', 'accepted');
                cookieConsent.classList.add('translate-y-full');
            });
            
            // Handle decline button click
            declineButton.addEventListener('click', function() {
                localStorage.setItem('cookieConsent', 'declined');
                cookieConsent.classList.add('translate-y-full');
            });
        });
    </script>
</body>

</html>
