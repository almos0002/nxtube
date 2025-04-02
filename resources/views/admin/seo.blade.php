@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="p-8">
    <!-- Header -->
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">SEO Management</h2>
            <p class="text-neutral-400">Configure search engine optimization settings for your site</p>
        </div>
        <div>
            <a href="{{ route('admin.seo.generate-sitemap') }}" class="px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition-colors">
                <i class="fa-duotone fa-thin fa-sync mr-2"></i>Generate Sitemap
            </a>
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

    <!-- SEO Form -->
    <form action="{{ route('admin.seo.update') }}" method="POST" class="w-full">
        @csrf
        
        <!-- Tabs Navigation -->
        <div class="mb-6 border-b border-neutral-700">
            <ul class="flex flex-wrap -mb-px font-medium text-center overflow-x-auto" id="seoTabs" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-red-500 rounded-t-lg text-white text-base hover:text-white hover:border-red-400 active-tab transition-colors" 
                            id="general-tab" data-tab="general" type="button" role="tab" aria-controls="general" aria-selected="true">
                        <i class="fa-duotone fa-thin fa-gear mr-2"></i>General
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-neutral-300 text-base hover:text-red-400 hover:border-red-400 transition-colors" 
                            id="verification-tab" data-tab="verification" type="button" role="tab" aria-controls="verification" aria-selected="false">
                        <i class="fa-duotone fa-thin fa-badge-check mr-2"></i>Verification
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-neutral-300 text-base hover:text-red-400 hover:border-red-400 transition-colors" 
                            id="robots-tab" data-tab="robots" type="button" role="tab" aria-controls="robots" aria-selected="false">
                        <i class="fa-duotone fa-thin fa-robot mr-2"></i>Robots.txt
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-neutral-300 text-base hover:text-red-400 hover:border-red-400 transition-colors" 
                            id="sitemap-tab" data-tab="sitemap" type="button" role="tab" aria-controls="sitemap" aria-selected="false">
                        <i class="fa-duotone fa-thin fa-sitemap mr-2"></i>Sitemap
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-neutral-300 text-base hover:text-red-400 hover:border-red-400 transition-colors" 
                            id="advanced-tab" data-tab="advanced" type="button" role="tab" aria-controls="advanced" aria-selected="false">
                        <i class="fa-duotone fa-thin fa-code mr-2"></i>Advanced
                    </button>
                </li>
            </ul>
        </div>
        
        <!-- Tab Content -->
        <div class="tab-content">
            <!-- General Settings Tab -->
            <div class="tab-pane active" id="general-content">
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-neutral-100 mb-6">General SEO Settings</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $seo->is_active ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                <span class="ms-3 text-sm font-medium text-neutral-300">Enable SEO Features</span>
                            </label>
                        </div>
                        
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="enable_social_meta" value="1" class="sr-only peer" {{ $seo->enable_social_meta ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                <span class="ms-3 text-sm font-medium text-neutral-300">Enable Social Media Meta Tags</span>
                            </label>
                            <div class="ml-4 text-neutral-400 text-sm">Adds Open Graph and Twitter Card meta tags</div>
                        </div>
                        
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="enable_canonical_urls" value="1" class="sr-only peer" {{ $seo->enable_canonical_urls ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                <span class="ms-3 text-sm font-medium text-neutral-300">Enable Canonical URLs</span>
                            </label>
                            <div class="ml-4 text-neutral-400 text-sm">Prevents duplicate content issues</div>
                        </div>
                        
                        <div class="flex items-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="noindex_pagination" value="1" class="sr-only peer" {{ $seo->noindex_pagination ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                <span class="ms-3 text-sm font-medium text-neutral-300">No-index Paginated Pages</span>
                            </label>
                            <div class="ml-4 text-neutral-400 text-sm">Prevents paginated pages from appearing in search results</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Verification Tab -->
            <div class="tab-pane hidden" id="verification-content">
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-neutral-100 mb-6">Search Engine Verification</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-neutral-700/30 p-4 rounded-lg mb-6">
                            <p class="text-neutral-300"><i class="fa-duotone fa-thin fa-info-circle mr-2"></i>Enter the verification codes provided by search engines to verify ownership of your site.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="google_verification" class="block text-sm font-medium text-neutral-300 mb-2">Google Search Console</label>
                                <input type="text" id="google_verification" name="google_verification" value="{{ $seo->google_verification }}" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                <p class="mt-1 text-sm text-neutral-400">Enter the content value from the meta tag provided by Google</p>
                            </div>
                            
                            <div>
                                <label for="bing_verification" class="block text-sm font-medium text-neutral-300 mb-2">Microsoft Bing</label>
                                <input type="text" id="bing_verification" name="bing_verification" value="{{ $seo->bing_verification }}" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                <p class="mt-1 text-sm text-neutral-400">Enter the content value from the meta tag provided by Bing</p>
                            </div>
                            
                            <div>
                                <label for="yandex_verification" class="block text-sm font-medium text-neutral-300 mb-2">Yandex</label>
                                <input type="text" id="yandex_verification" name="yandex_verification" value="{{ $seo->yandex_verification }}" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                <p class="mt-1 text-sm text-neutral-400">Enter the content value from the meta tag provided by Yandex</p>
                            </div>
                            
                            <div>
                                <label for="baidu_verification" class="block text-sm font-medium text-neutral-300 mb-2">Baidu</label>
                                <input type="text" id="baidu_verification" name="baidu_verification" value="{{ $seo->baidu_verification }}" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                <p class="mt-1 text-sm text-neutral-400">Enter the content value from the meta tag provided by Baidu</p>
                            </div>
                            
                            <div>
                                <label for="pinterest_verification" class="block text-sm font-medium text-neutral-300 mb-2">Pinterest</label>
                                <input type="text" id="pinterest_verification" name="pinterest_verification" value="{{ $seo->pinterest_verification }}" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                <p class="mt-1 text-sm text-neutral-400">Enter the content value from the meta tag provided by Pinterest</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Robots.txt Tab -->
            <div class="tab-pane hidden" id="robots-content">
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-neutral-100 mb-6">Robots.txt Configuration</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-yellow-500/20 border border-yellow-500/30 p-4 rounded-lg mb-6">
                            <p class="text-yellow-200"><i class="fa-duotone fa-thin fa-exclamation-triangle mr-2"></i>Be careful when editing robots.txt. Incorrect settings can prevent search engines from indexing your site.</p>
                        </div>
                        
                        <div>
                            <label for="robots_txt" class="block text-sm font-medium text-neutral-300 mb-2">Robots.txt Content</label>
                            <textarea id="robots_txt" name="robots_txt" rows="15" 
                                class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500 font-mono">{{ $seo->robots_txt ?? "User-agent: *\nAllow: /\nDisallow: /admin/\nDisallow: /login\nDisallow: /register\n\nSitemap: " . url('/sitemap.xml') }}</textarea>
                            <p class="mt-1 text-sm text-neutral-400">This content will be used to generate the robots.txt file at the root of your site</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sitemap Tab -->
            <div class="tab-pane hidden" id="sitemap-content">
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-neutral-100 mb-6">Sitemap Configuration</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-neutral-700/30 p-4 rounded-lg mb-6">
                            <p class="text-neutral-300"><i class="fa-duotone fa-thin fa-info-circle mr-2"></i>Configure your sitemap settings to help search engines discover your content.</p>
                        </div>
                        
                        <div class="flex items-center mb-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="auto_generate_sitemap" value="1" class="sr-only peer" {{ $seo->auto_generate_sitemap ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-neutral-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-500"></div>
                                <span class="ms-3 text-sm font-medium text-neutral-300">Auto-generate Sitemap</span>
                            </label>
                            <div class="ml-4 text-neutral-400 text-sm">Automatically generate sitemap.xml when content is updated</div>
                        </div>
                        
                        @if($seo->auto_generate_sitemap)
                        <div class="bg-neutral-800/50 p-4 rounded-lg border border-neutral-700 mb-6">
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-thin fa-clock mr-2 text-neutral-400"></i>
                                    <span class="text-neutral-300 text-sm">Last generated: 
                                        <span class="text-neutral-100">
                                            {{ Cache::has('sitemap_last_generated') ? Cache::get('sitemap_last_generated')->format('M d, Y - h:i A') : 'Never' }}
                                        </span>
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fa-duotone fa-thin fa-calendar-clock mr-2 text-neutral-400"></i>
                                    <span class="text-neutral-300 text-sm">Next scheduled: 
                                        <span class="text-neutral-100">
                                            @php
                                                $nextTime = null;
                                                if ($seo->sitemap_frequency == 'hourly') {
                                                    $nextTime = Cache::has('sitemap_last_generated') ? Cache::get('sitemap_last_generated')->addHour() : null;
                                                } elseif ($seo->sitemap_frequency == 'daily') {
                                                    $nextTime = Cache::has('sitemap_last_generated') ? Cache::get('sitemap_last_generated')->addDay() : null;
                                                } elseif ($seo->sitemap_frequency == 'weekly') {
                                                    $nextTime = Cache::has('sitemap_last_generated') ? Cache::get('sitemap_last_generated')->addWeek() : null;
                                                } elseif ($seo->sitemap_frequency == 'monthly') {
                                                    $nextTime = Cache::has('sitemap_last_generated') ? Cache::get('sitemap_last_generated')->addMonth() : null;
                                                }
                                            @endphp
                                            {{ $nextTime ? $nextTime->format('M d, Y - h:i A') : 'Based on your selected frequency' }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="sitemap_frequency" class="block text-sm font-medium text-neutral-300 mb-2">Default Change Frequency</label>
                                <select id="sitemap_frequency" name="sitemap_frequency" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                    <option value="always" {{ $seo->sitemap_frequency == 'always' ? 'selected' : '' }}>Always</option>
                                    <option value="hourly" {{ $seo->sitemap_frequency == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                    <option value="daily" {{ $seo->sitemap_frequency == 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ $seo->sitemap_frequency == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ $seo->sitemap_frequency == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="yearly" {{ $seo->sitemap_frequency == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="never" {{ $seo->sitemap_frequency == 'never' ? 'selected' : '' }}>Never</option>
                                </select>
                                <p class="mt-1 text-sm text-neutral-400">How frequently the content is likely to change</p>
                            </div>
                            
                            <div>
                                <label for="sitemap_priority" class="block text-sm font-medium text-neutral-300 mb-2">Default Priority</label>
                                <input type="number" id="sitemap_priority" name="sitemap_priority" min="0" max="1" step="0.1" value="{{ $seo->sitemap_priority ?? '0.8' }}" 
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500">
                                <p class="mt-1 text-sm text-neutral-400">The priority of URLs relative to other URLs on your site (0.0 to 1.0)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Advanced Tab -->
            <div class="tab-pane hidden" id="advanced-content">
                <div class="bg-neutral-800 rounded-xl shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-neutral-100 mb-6">Advanced SEO Settings</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-yellow-500/20 border border-yellow-500/30 p-4 rounded-lg mb-6">
                            <p class="text-yellow-200"><i class="fa-duotone fa-thin fa-exclamation-triangle mr-2"></i>Advanced settings should only be modified by users with knowledge of HTML and SEO.</p>
                        </div>
                        
                        <div>
                            <label for="custom_meta_tags" class="block text-sm font-medium text-neutral-300 mb-2">Custom Meta Tags</label>
                            <textarea id="custom_meta_tags" name="custom_meta_tags" rows="6" 
                                class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500 font-mono">{{ $seo->custom_meta_tags }}</textarea>
                            <p class="mt-1 text-sm text-neutral-400">Add custom meta tags to be included in the &lt;head&gt; section of all pages</p>
                        </div>
                        
                        <div>
                            <label for="structured_data" class="block text-sm font-medium text-neutral-300 mb-2">Structured Data (JSON-LD)</label>
                            <textarea id="structured_data" name="structured_data" rows="10" 
                                class="w-full bg-neutral-700 border border-neutral-600 rounded-lg p-2.5 text-white focus:ring-red-500 focus:border-red-500 font-mono">{{ $seo->structured_data }}</textarea>
                            <p class="mt-1 text-sm text-neutral-400">Add structured data in JSON-LD format to improve rich snippets in search results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                <i class="fa-duotone fa-thin fa-save mr-2"></i>Save SEO Settings
            </button>
        </div>
    </form>
</div>

<script>
    // Tab navigation
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('[data-tab]');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabs.forEach(t => {
                    t.classList.remove('active-tab', 'text-red-500', 'border-red-500');
                    t.classList.add('border-transparent');
                });
                
                // Add active class to clicked tab
                this.classList.add('active-tab', 'text-red-500', 'border-red-500');
                this.classList.remove('border-transparent');
                
                // Hide all tab content
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                    pane.classList.remove('active');
                });
                
                // Show selected tab content
                const tabId = this.getAttribute('data-tab');
                const tabContent = document.getElementById(tabId + '-content');
                tabContent.classList.remove('hidden');
                tabContent.classList.add('active');
            });
        });
    });
</script>

<style>
    .active-tab {
        color: rgb(239, 68, 68);
        border-color: rgb(239, 68, 68);
    }
</style>
@endsection
