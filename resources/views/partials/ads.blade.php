@if($siteAds->is_active)
    @switch($position)
        @case('banner_1')
            @if($siteAds->ads_banner_1)
                <div class="ad-container ad-banner-1 my-4">
                    @if(Str::startsWith($siteAds->ads_banner_1, ['http://', 'https://']) || Str::contains($siteAds->ads_banner_1, ['<script', '<iframe', '<div']))
                        {!! $siteAds->ads_banner_1 !!}
                    @else
                        <a href="#" class="block">
                            <img src="{{ asset('storage/' . $siteAds->ads_banner_1) }}" alt="Advertisement" class="w-full h-auto rounded-lg">
                        </a>
                    @endif
                </div>
            @endif
            @break
            
        @case('banner_2')
            @if($siteAds->ads_banner_2)
                <div class="ad-container ad-banner-2 my-4">
                    @if(Str::startsWith($siteAds->ads_banner_2, ['http://', 'https://']) || Str::contains($siteAds->ads_banner_2, ['<script', '<iframe', '<div']))
                        {!! $siteAds->ads_banner_2 !!}
                    @else
                        <a href="#" class="block">
                            <img src="{{ asset('storage/' . $siteAds->ads_banner_2) }}" alt="Advertisement" class="w-full h-auto rounded-lg">
                        </a>
                    @endif
                </div>
            @endif
            @break
            
        @case('popup')
            @if($siteAds->ads_popup)
                <div id="ad-popup" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 hidden">
                    <div class="relative bg-neutral-800 p-4 rounded-xl max-w-lg w-full mx-4">
                        <button id="close-popup" class="absolute top-2 right-2 text-white bg-red-600 rounded-full w-6 h-6 flex items-center justify-center">
                            <span>&times;</span>
                        </button>
                        <div class="ad-container ad-popup">
                            @if(Str::startsWith($siteAds->ads_popup, ['http://', 'https://']) || Str::contains($siteAds->ads_popup, ['<script', '<iframe', '<div']))
                                {!! $siteAds->ads_popup !!}
                            @else
                                <a href="#" class="block">
                                    <img src="{{ asset('storage/' . $siteAds->ads_popup) }}" alt="Advertisement" class="w-full h-auto rounded-lg">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(function() {
                            document.getElementById('ad-popup').classList.remove('hidden');
                        }, 3000);
                        
                        document.getElementById('close-popup').addEventListener('click', function() {
                            document.getElementById('ad-popup').classList.add('hidden');
                        });
                    });
                </script>
            @endif
            @break
            
        @case('video')
            @if($siteAds->ads_video)
                <div class="ad-container ad-video my-2">
                    {!! $siteAds->ads_video !!}
                </div>
            @endif
            @break
    @endswitch
@endif
