    @extends('layouts.admin')
    @section('content')
    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
            <div class="flex items-center">
                <button class="md:hidden mr-4" onclick="toggleSidebar()">
                    <i class="fa-duotone fa-thin fa-bars text-neutral-300"></i>
                </button>
                <div>
                    <h2 class="text-2xl font-bold text-neutral-100">Welcome Back, Admin</h2>
                    <p class="text-neutral-400">Here's what's happening today</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search..." 
                           class="px-4 py-2 rounded-lg bg-neutral-700 border-neutral-600 text-neutral-100 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
                    <i class="fa-duotone fa-thin fa-search absolute right-3 top-3.5 text-neutral-400"></i>
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Videos</p>
                        <h3 class="text-2xl font-bold text-neutral-100">1,234</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-video text-blue-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 12%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <div class="stat-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Views</p>
                        <h3 class="text-2xl font-bold text-neutral-100">2.5M</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-eye text-green-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 18%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <div class="stat-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Actors</p>
                        <h3 class="text-2xl font-bold text-neutral-100">524</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-user-tie text-yellow-500 text-xl"></i> 
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 5%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>

            <div class="stat-card bg-neutral-800 p-6 rounded-xl shadow-sm hover:shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-neutral-400 text-sm">Total Categories</p>
                        <h3 class="text-2xl font-bold text-neutral-100">48</h3>
                    </div>
                    <div class="w-12 h-12 bg-pink-500/20 rounded-xl flex items-center justify-center">
                        <i class="fa-duotone fa-thin fa-list text-pink-500 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="text-green-400 flex items-center">
                        <i class="fa-duotone fa-thin fa-arrow-up mr-1"></i> 3%
                    </span>
                    <span class="text-neutral-500 ml-2">vs last month</span>
                </div>
            </div>
        </div>

        <!-- Recent Videos & Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="chart-container bg-neutral-800 p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Recently Added Videos</h3>
                    <a href="#" class="text-red-400 text-sm hover:text-red-500">View All</a>
                </div>
                <div class="space-y-4">
                    <!-- Video Item -->
                    <div class="flex items-center space-x-4">
                        <div class="relative flex-shrink-0">
                            <img src="https://picsum.photos/100/60" alt="Video thumbnail" class="w-24 h-14 rounded-lg object-cover">
                            <span class="absolute bottom-1 right-1 bg-black bg-opacity-70 px-1 text-xs rounded text-neutral-100">12:34</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-neutral-100 truncate">Amazing Nature Documentary Episode 1</h4>
                            <p class="text-xs text-neutral-400">Added 2 hours ago • 1.2K views</p>
                        </div>
                        <div class="flex-shrink-0">
                            <button class="text-neutral-400 hover:text-neutral-300">
                                <i class="fa-duotone fa-thin fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart-container bg-neutral-800 p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Popular Videos</h3>
                    <a href="#" class="text-red-400 text-sm hover:text-red-500">View All</a>
                </div>
                <div class="space-y-4">
                    <!-- Popular Video Item -->
                    <div class="flex items-center space-x-4">
                        <div class="relative flex-shrink-0">
                            <img src="https://picsum.photos/100/60" alt="Video thumbnail" class="w-24 h-14 rounded-lg object-cover">
                            <span class="absolute bottom-1 right-1 bg-black bg-opacity-70 px-1 text-xs rounded text-neutral-100">25:18</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-neutral-100 truncate">The Ultimate Guide to Filmmaking</h4>
                            <p class="text-xs text-neutral-400">2.5M views • Trending #1</p>
                        </div>
                        <div class="flex-shrink-0 text-sm font-medium text-green-400">
                            <i class="fa-duotone fa-thin fa-chart-line mr-1"></i>
                            +128%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="chart-container bg-neutral-800 p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Views Analytics</h3>
                    <select class="px-3 py-1 bg-neutral-700 border-neutral-600 rounded-lg text-sm text-neutral-100">
                        <option>Last 7 days</option>
                        <option>Last month</option>
                        <option>Last year</option>
                    </select>
                </div>
                <canvas id="viewsChart" width="400" height="200"></canvas>
            </div>

            <div class="chart-container bg-neutral-800 p-6 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-neutral-100">Top Visitors From Countries</h3>
                    <select class="px-3 py-1 bg-neutral-700 border-neutral-600 rounded-lg text-sm text-neutral-100">
                        <option>Last 30 days</option>
                        <option>Last 90 days</option>
                        <option>Last year</option>
                    </select>
                </div>
                <div class="space-y-4">
                    <!-- Country Item -->
                    <div class="group">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex-shrink-0 transform transition-all duration-300 group-hover:scale-110 group-hover:-rotate-3">
                                <div class="w-full h-full rounded-xl shadow-lg overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <img src="https://flagcdn.com/us.svg" alt="USA flag" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 shadow-inner"></div>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-sm font-semibold text-neutral-100 group-hover:text-red-400 transition-colors">United States</span>
                                        <div class="flex items-center text-xs text-neutral-400">
                                            <i class="fa-duotone fa-thin fa-user-group mr-1"></i>
                                            <span>45.2K visitors</span>
                                            <span class="mx-2">•</span>
                                            <span class="text-green-400">+12% <i class="fa-duotone fa-thin fa-trending-up ml-1"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-neutral-100 ml-2">85%</span>
                                </div>
                                <div class="relative h-2.5 bg-neutral-700/30 rounded-full overflow-hidden group-hover:bg-neutral-700/40 transition-colors">
                                    <div class="absolute top-0 left-0 h-full w-[85%] rounded-full
                                            bg-gradient-to-r from-red-600 via-red-500 to-red-400
                                            group-hover:from-red-500 group-hover:via-red-400 group-hover:to-red-300
                                            transition-all duration-300 ease-out group-hover:scale-x-105 origin-left
                                            animate-pulse-subtle">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-shimmer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Country Item -->
                    <div class="group">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex-shrink-0 transform transition-all duration-300 group-hover:scale-110 group-hover:-rotate-3">
                                <div class="w-full h-full rounded-xl shadow-lg overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <img src="https://flagcdn.com/in.svg" alt="India flag" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 shadow-inner"></div>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-sm font-semibold text-neutral-100 group-hover:text-red-400 transition-colors">India</span>
                                        <div class="flex items-center text-xs text-neutral-400">
                                            <i class="fa-duotone fa-thin fa-user-group mr-1"></i>
                                            <span>32.8K visitors</span>
                                            <span class="mx-2">•</span>
                                            <span class="text-green-400">+18% <i class="fa-duotone fa-thin fa-trending-up ml-1"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-neutral-100 ml-2">65%</span>
                                </div>
                                <div class="relative h-2.5 bg-neutral-700/30 rounded-full overflow-hidden group-hover:bg-neutral-700/40 transition-colors">
                                    <div class="absolute top-0 left-0 h-full w-[65%] rounded-full
                                            bg-gradient-to-r from-red-600 via-red-500 to-red-400
                                            group-hover:from-red-500 group-hover:via-red-400 group-hover:to-red-300
                                            transition-all duration-300 ease-out group-hover:scale-x-105 origin-left
                                            animate-pulse-subtle">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-shimmer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Country Item -->
                    <div class="group">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 flex-shrink-0 transform transition-all duration-300 group-hover:scale-110 group-hover:-rotate-3">
                                <div class="w-full h-full rounded-xl shadow-lg overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    <img src="https://flagcdn.com/gb.svg" alt="UK flag" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 shadow-inner"></div>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <span class="text-sm font-semibold text-neutral-100 group-hover:text-red-400 transition-colors">United Kingdom</span>
                                        <div class="flex items-center text-xs text-neutral-400">
                                            <i class="fa-duotone fa-thin fa-user-group mr-1"></i>
                                            <span>28.3K visitors</span>
                                            <span class="mx-2">•</span>
                                            <span class="text-green-400">+8% <i class="fa-duotone fa-thin fa-trending-up ml-1"></i></span>
                                        </div>
                                    </div>
                                    <span class="text-sm font-medium text-neutral-100 ml-2">55%</span>
                                </div>
                                <div class="relative h-2.5 bg-neutral-700/30 rounded-full overflow-hidden group-hover:bg-neutral-700/40 transition-colors">
                                    <div class="absolute top-0 left-0 h-full w-[55%] rounded-full
                                            bg-gradient-to-r from-red-600 via-red-500 to-red-400
                                            group-hover:from-red-500 group-hover:via-red-400 group-hover:to-red-300
                                            transition-all duration-300 ease-out group-hover:scale-x-105 origin-left
                                            animate-pulse-subtle">
                                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-shimmer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        // Views Chart
        const viewsCtx = document.getElementById('viewsChart').getContext('2d');
        new Chart(viewsCtx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Views',
                    data: [15000, 18000, 16000, 25000, 22000, 30000, 35000],
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af'
                        }
                    }
                }
            }
        });
    </script>

    <style>
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }
        
        @keyframes pulse-subtle {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
        
        .animate-shimmer {
            animation: shimmer 2s infinite;
        }
        
        .animate-pulse-subtle {
            animation: pulse-subtle 2s infinite;
        }
    </style>
    @endsection