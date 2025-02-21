<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoFlex - Stream Your Favorite Videos</title>
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
    </style>
</head>
<body class="bg-neutral-900 text-neutral-100">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-30 bg-neutral-800/80 backdrop-blur-md border-b border-neutral-700/50 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo and Desktop Navigation -->
                <div class="flex items-center space-x-8">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden flex items-center justify-center w-10 h-10 text-neutral-100 hover:text-red-500 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <a href="index.html" class="inline-flex items-center space-x-3">
                        <i class="fas fa-play-circle text-red-500 text-3xl"></i>
                        <span class="text-xl font-bold">VideoFlex</span>
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="index.html" class="text-neutral-100 hover:text-red-500 transition-colors">Home</a>
                        <div class="relative categories-group">
                            <button class="text-neutral-100 hover:text-red-500 transition-colors flex items-center">
                                Categories
                                <i class="fas fa-chevron-down ml-2 text-sm group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                            <!-- Categories Dropdown -->
                            <div class="categories-dropdown absolute left-0 mt-2 w-[520px] bg-neutral-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-neutral-700 
                                      grid grid-cols-3 gap-3 p-6 z-50 transform opacity-0 scale-95 group-hover:opacity-100 group-hover:scale-100 
                                      transition-all duration-200">
                                <div class="col-span-3 mb-2">
                                    <h3 class="text-sm font-semibold text-neutral-400 uppercase tracking-wider mb-2">Browse Categories</h3>
                                    <div class="w-12 h-1 bg-red-500 rounded-full"></div>
                                </div>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Action</span>
                                        <span class="text-xs text-neutral-400">1.2K videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Comedy</span>
                                        <span class="text-xs text-neutral-400">856 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Drama</span>
                                        <span class="text-xs text-neutral-400">643 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Horror</span>
                                        <span class="text-xs text-neutral-400">427 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Romance</span>
                                        <span class="text-xs text-neutral-400">523 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Sci-Fi</span>
                                        <span class="text-xs text-neutral-400">721 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Western</span>
                                        <span class="text-xs text-neutral-400">235 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Animation</span>
                                        <span class="text-xs text-neutral-400">892 videos</span>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-neutral-700/50 transition-colors group/item">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center group-hover/item:bg-red-500/20 transition-colors">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium block">Documentary</span>
                                        <span class="text-xs text-neutral-400">412 videos</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="flex-1 flex justify-end items-center">
                    <div class="relative">
                        <input type="text" placeholder="Search videos..." class="w-36 md:w-64 bg-neutral-700 text-sm rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:bg-neutral-600 transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-neutral-400"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Sidebar -->
    <div id="mobile-menu-overlay" class="md:hidden fixed inset-0 z-40 bg-neutral-900/50 backdrop-blur-sm mobile-menu-overlay hidden"></div>
    <div id="mobile-menu" class="md:hidden fixed left-0 top-0 bottom-0 w-80 bg-neutral-800/90 backdrop-blur-md z-50 mobile-menu-sidebar">
        <div class="flex flex-col h-full">
            <!-- Mobile Menu Header -->
            <div class="p-4 border-b border-neutral-700">
                <a href="index.html" class="inline-flex items-center space-x-3">
                    <i class="fas fa-play-circle text-red-500 text-3xl"></i>
                    <span class="text-xl font-bold">VideoFlex</span>
                </a>
            </div>
            
            <!-- Mobile Menu Items -->
            <div class="flex-1 overflow-y-auto py-4">
                <div class="px-4 space-y-6">
                    <a href="index.html" class="block py-2.5 px-4 rounded-lg text-base font-medium text-neutral-100 hover:text-red-500 hover:bg-neutral-700/50 transition-all">
                        <i class="fas fa-home mr-3"></i>Home
                    </a>
                    <div class="space-y-4">
                        <button id="mobile-categories-button" class="w-full flex items-center justify-between py-2.5 px-4 rounded-lg text-base font-medium text-neutral-100 hover:text-red-500 hover:bg-neutral-700/50 transition-all">
                            <div class="flex items-center">
                                <i class="fas fa-list-ul mr-3"></i>
                                <span>Categories</span>
                            </div>
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div id="mobile-categories-content" class="hidden">
                            <div class="grid grid-cols-2 gap-2 px-4">
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Action</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Comedy</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Drama</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Horror</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Romance</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Sci-Fi</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Western</span>
                                </a>
                                <a href="#" class="flex items-center space-x-3 p-2 rounded-xl hover:bg-neutral-700/50 transition-colors">
                                    <div class="w-6 h-6 rounded-lg bg-red-500/10 flex items-center justify-center">
                                        <span class="text-red-500 text-sm">#</span>
                                    </div>
                                    <span class="text-sm">Animation</span>
                                </a>
                            </div>
                        </div>
                    </div>
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
    @yield('content')
    <!-- Footer -->
    <footer class="bg-gradient-to-b from-neutral-900 to-neutral-800 border-t border-neutral-700">
        <!-- Newsletter Section -->
        <div class="border-b border-neutral-700/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-red-500 to-orange-500 bg-clip-text text-transparent">Stay Updated</h3>
                        <p class="text-neutral-400 mt-2">Get the latest updates about new videos and features</p>
                    </div>
                    <div class="flex-1 max-w-md w-full">
                        <form class="flex gap-2">
                            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 bg-neutral-700/50 rounded-lg border border-neutral-600 focus:outline-none focus:border-red-500 transition-colors">
                            <button type="submit" class="px-6 py-2 bg-red-500 hover:bg-red-600 rounded-lg font-medium transition-colors">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Brand Section -->
                <div class="space-y-4">
                    <a href="index.html" class="inline-flex items-center space-x-3">
                        <i class="fas fa-play-circle text-red-500 text-3xl"></i>
                        <span class="text-xl font-bold">VideoFlex</span>
                    </a>
                    <p class="text-neutral-400 text-sm">Your ultimate destination for high-quality video content. Stream, share, and enjoy!</p>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-twitter text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-facebook text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-instagram text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-neutral-700/50 flex items-center justify-center hover:bg-red-500 transition-colors group">
                            <i class="fab fa-youtube text-neutral-400 group-hover:text-white transition-colors"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">About Us</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Contact</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">FAQ</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Top Categories</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Action</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Comedy</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Drama</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Horror</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-red-500 transition-colors">Sci-Fi</a></li>
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
                        <a href="#" class="text-neutral-400 hover:text-red-500 transition-colors text-sm">Privacy</a>
                        <a href="#" class="text-neutral-400 hover:text-red-500 transition-colors text-sm">Terms</a>
                        <a href="#" class="text-neutral-400 hover:text-red-500 transition-colors text-sm">Cookies</a>
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
</body>
</html>
