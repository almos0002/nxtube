@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="ml-64 p-8">
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Add New Video</h2>
            <p class="text-neutral-400">Upload and manage video content</p>
        </div>
        <button type="submit" form="videoForm" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
            Publish Video
        </button>
    </header>

    <form id="videoForm" action="{{ route('store-video') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <!-- Main Content Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Video Upload Section -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Video Link</h3>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Video URL</label>
                            <input type="url" name="video_link" required placeholder="https://example.com/video.mp4" 
                                   class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            <p class="mt-1 text-sm text-neutral-500">Enter a direct link to your video file</p>
                        </div>
                        <div class="w-32">
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Duration</label>
                            <input type="text" name="duration" placeholder="HH:MM:SS" pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" required
                                   class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        </div>
                    </div>
                    <!-- Video Preview -->
                    <div id="videoPreview" class="hidden">
                        <video controls class="w-full rounded-lg bg-neutral-900"></video>
                    </div>
                </div>
            </div>

            <!-- Video Details -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Video Details</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Title</label>
                        <input type="text" name="title" required
                               class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Description</label>
                        <textarea name="description" rows="4" required
                                  class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"></textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Channels (Multiple Select via Search) -->
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Channels</label>
                            <div class="relative">
                                <input type="text" id="channelSearch" placeholder="Search channels..."
                                       class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <div id="channelResults" class="hidden absolute z-10 w-full mt-1 bg-neutral-700 border border-neutral-600 rounded-lg shadow-lg max-h-48 overflow-y-auto"></div>
                            </div>
                            <div id="selectedChannels" class="mt-2 flex flex-wrap gap-2"></div>
                        </div>
                        <!-- Categories (Multiple Select via Search) -->
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Categories</label>
                            <div class="relative">
                                <input type="text" id="categorySearch" placeholder="Search categories..."
                                       class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <div id="categoryResults" class="hidden absolute z-10 w-full mt-1 bg-neutral-700 border border-neutral-600 rounded-lg shadow-lg max-h-48 overflow-y-auto"></div>
                            </div>
                            <div id="selectedCategories" class="mt-2 flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Language -->
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Language</label>
                            <select name="language" required
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <option value="en">English</option>
                                <option value="es">Spanish</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                                <option value="it">Italian</option>
                                <option value="hi">Hindi</option>
                            </select>
                        </div>
                        <!-- Actors (Multiple Select via Search) -->
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Actors</label>
                            <div class="relative">
                                <input type="text" id="actorSearch" placeholder="Search actors..."
                                       class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <div id="actorResults" class="hidden absolute z-10 w-full mt-1 bg-neutral-700 border border-neutral-600 rounded-lg shadow-lg max-h-48 overflow-y-auto"></div>
                            </div>
                            <div id="selectedActors" class="mt-2 flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                    <!-- Tags (Multiple Select via Search) -->
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Tags</label>
                        <div class="relative">
                            <input type="text" id="tagSearch" placeholder="Search tags..."
                                   class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            <div id="tagResults" class="hidden absolute z-10 w-full mt-1 bg-neutral-700 border border-neutral-600 rounded-lg shadow-lg max-h-48 overflow-y-auto"></div>
                        </div>
                        <div id="selectedTags" class="mt-2 flex flex-wrap gap-2"></div>
                        <p class="mt-1 text-sm text-neutral-500">Select up to 10 tags to help viewers find your video</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="space-y-6">
            <!-- Thumbnail Section -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Thumbnail</h3>
                <div id="thumbnailUpload" class="space-y-4">
                    <div id="thumbnailPreview" class="aspect-video bg-neutral-700 rounded-lg overflow-hidden">
                        <img id="thumbnailImage" class="w-full h-full object-cover hidden">
                        <div id="thumbnailPlaceholder" class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-neutral-500"></i>
                        </div>
                    </div>
                    <input type="file" id="thumbnailInput" name="thumbnail" accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('thumbnailInput').click()"
                            class="w-full px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-neutral-100 rounded-lg transition-colors">
                        Upload Thumbnail
                    </button>
                    <p class="text-sm text-neutral-500">Recommended: 1280x720px JPG, PNG</p>
                </div>
            </div>

            <!-- Visibility Section -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Visibility</h3>
                <div class="space-y-3">
                    <input type="radio" name="visibility" value="public" checked class="hidden" id="visibilityPublic">
                    <input type="radio" name="visibility" value="unlisted" class="hidden" id="visibilityUnlisted">
                    <input type="radio" name="visibility" value="private" class="hidden" id="visibilityPrivate">
                    
                    <label for="visibilityPublic" class="block p-3 rounded-lg cursor-pointer transition-all duration-200 hover:bg-neutral-700/70 data-[checked=true]:bg-red-500/10 data-[checked=true]:border-red-500/50 border border-transparent">
                        <div class="flex items-center">
                            <i class="fa-duotone fa-thin fa-globe w-5 text-neutral-400"></i>
                            <div class="ml-3">
                                <p class="text-neutral-100">Public</p>
                                <p class="text-sm text-neutral-400">Everyone can watch your video</p>
                            </div>
                        </div>
                    </label>
                    
                    <label for="visibilityUnlisted" class="block p-3 rounded-lg cursor-pointer transition-all duration-200 hover:bg-neutral-700/70 data-[checked=true]:bg-red-500/10 data-[checked=true]:border-red-500/50 border border-transparent">
                        <div class="flex items-center">
                            <i class="fa-duotone fa-thin fa-link w-5 text-neutral-400"></i>
                            <div class="ml-3">
                                <p class="text-neutral-100">Draft</p>
                                <p class="text-sm text-neutral-400">Only You Can Watch Your Video</p>
                            </div>
                        </div>
                    </label>
                </div>
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
                
                updateVisibilityStyles();
            </script>
        </div>
    </form>
</div>

{{-- Pass controller data as JSON --}}
<script>
    const actorsList = @json($actors->map(function($actor) {
        return ['id' => $actor->id, 'name' => $actor->firstname . ' ' . $actor->lastname];
    }));
    const tagsList = @json($tags->map(function($tag) {
        return ['id' => $tag->id, 'name' => $tag->name];
    }));
    const categoriesList = @json($categories->map(function($category) {
        return ['id' => $category->id, 'name' => $category->name];
    }));
    const channelsList = @json($channels->map(function($channel) {
        return ['id' => $channel->id, 'name' => $channel->channel_name];
    }));
</script>

<script>
    // Hide dropdowns when clicking outside the search fields
    document.addEventListener('click', function(e) {
        ['actorResults', 'tagResults', 'categoryResults', 'channelResults'].forEach(id => {
            const el = document.getElementById(id);
            if(el && !el.contains(e.target) && 
               !document.getElementById(id.replace('Results','Search')).contains(e.target)) {
                el.classList.add('hidden');
            }
        });
    });

    // Video link handling
    const videoLinkInput = document.querySelector('input[name="video_link"]');
    const videoPreview = document.getElementById('videoPreview');
    const videoPlayer = videoPreview.querySelector('video');
    videoLinkInput.addEventListener('change', (e) => {
        const url = e.target.value.trim();
        if(url) {
            videoPlayer.src = url;
            videoPreview.classList.remove('hidden');
        } else {
            videoPreview.classList.add('hidden');
        }
    });

    // Thumbnail handling
    const thumbnailInput = document.getElementById('thumbnailInput');
    const thumbnailImage = document.getElementById('thumbnailImage');
    const thumbnailPlaceholder = document.getElementById('thumbnailPlaceholder');
    thumbnailInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                thumbnailImage.src = e.target.result;
                thumbnailImage.classList.remove('hidden');
                thumbnailPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // ======== Actors Multiple-Select ==========
    let selectedActorsList = [];
    const actorSearch = document.getElementById('actorSearch');
    const actorResults = document.getElementById('actorResults');
    const selectedActors = document.getElementById('selectedActors');

    actorSearch.addEventListener('focus', () => {
        filterActors(actorSearch.value);
        actorResults.classList.remove('hidden');
    });
    actorSearch.addEventListener('input', (e) => {
        filterActors(e.target.value);
        actorResults.classList.remove('hidden');
    });

    function filterActors(searchTerm) {
        let filtered = actorsList.filter(actor => {
            return !selectedActorsList.some(a => a.id === actor.id) &&
                   actor.name.toLowerCase().includes(searchTerm.toLowerCase());
        });
        actorResults.innerHTML = filtered.length ? filtered.map(actor => `
            <div class="p-2 hover:bg-neutral-600 cursor-pointer flex items-center justify-between">
                <span>${actor.name}</span>
            </div>
        `).join('') : '<div class="p-2 text-neutral-400">No results found</div>';

        actorResults.querySelectorAll('div').forEach(option => {
            if(!option.classList.contains('text-neutral-400')){
                option.addEventListener('click', () => {
                    const actorName = option.querySelector('span').textContent;
                    const actor = actorsList.find(a => a.name === actorName);
                    if(actor && !selectedActorsList.some(a => a.id === actor.id)) {
                        selectedActorsList.push(actor);
                        updateSelectedActors();
                    }
                    actorSearch.value = '';
                    filterActors('');
                    actorResults.classList.add('hidden');
                });
            }
        });
    }

    function updateSelectedActors() {
        selectedActors.innerHTML = selectedActorsList.map(actor => `
            <div class="flex items-center gap-1 bg-neutral-600 px-2 py-1 rounded-lg">
                <span class="text-sm text-neutral-100">${actor.name}</span>
                <button type="button" onclick="removeActor(${actor.id})" class="text-neutral-400 hover:text-red-400">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="actor_id[]" value="${actor.id}">
            </div>
        `).join('');
    }

    function removeActor(id) {
        selectedActorsList = selectedActorsList.filter(actor => actor.id !== id);
        updateSelectedActors();
        filterActors(actorSearch.value);
    }

    // ======== Tags Multiple-Select ==========
    let selectedTagsList = [];
    const tagSearch = document.getElementById('tagSearch');
    const tagResults = document.getElementById('tagResults');
    const selectedTags = document.getElementById('selectedTags');

    tagSearch.addEventListener('focus', () => {
        filterTags(tagSearch.value);
        tagResults.classList.remove('hidden');
    });

    tagSearch.addEventListener('input', (e) => {
        filterTags(e.target.value);
        tagResults.classList.remove('hidden');
    });

    function filterTags(searchTerm) {
        let filtered = tagsList.filter(tag => 
            !selectedTagsList.some(t => t.name.toLowerCase() === tag.name.toLowerCase()) &&
            tag.name.toLowerCase().includes(searchTerm.toLowerCase())
        );

        // Add option to create new tag if it doesn't exist
        if (searchTerm && !filtered.some(tag => tag.name.toLowerCase() === searchTerm.toLowerCase())) {
            filtered.push({ id: 'new', name: searchTerm });
        }

        tagResults.innerHTML = filtered.length ? filtered.map(tag => `
            <div class="p-2 hover:bg-neutral-600 cursor-pointer">
                ${tag.id === 'new' ? `Create "${tag.name}"` : tag.name}
            </div>
        `).join('') : '<div class="p-2 text-neutral-400">No results found</div>';

        tagResults.querySelectorAll('div').forEach(option => {
            if(!option.classList.contains('text-neutral-400')){
                option.addEventListener('click', () => {
                    const tagName = option.textContent.trim().replace('Create "', '').replace('"', '');
                    if (!selectedTagsList.some(t => t.name.toLowerCase() === tagName.toLowerCase())) {
                        selectedTagsList.push({ id: 'new', name: tagName });
                        updateSelectedTags();
                    }
                    tagSearch.value = '';
                    filterTags('');
                    tagResults.classList.add('hidden');
                });
            }
        });
    }

    function updateSelectedTags() {
        selectedTags.innerHTML = selectedTagsList.map(tag => `
            <div class="flex items-center gap-1 bg-neutral-600 px-2 py-1 rounded-lg">
                <span class="text-sm text-neutral-100">${tag.name}</span>
                <button type="button" onclick="removeTag('${tag.name}')" class="text-neutral-400 hover:text-red-400">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="tags[]" value="${tag.name}">
            </div>
        `).join('');
    }

    function removeTag(name) {
        selectedTagsList = selectedTagsList.filter(tag => tag.name !== name);
        updateSelectedTags();
        filterTags(tagSearch.value);
    }

    // ======== Categories Multiple-Select ==========
    let selectedCategoriesList = [];
    const categorySearch = document.getElementById('categorySearch');
    const categoryResults = document.getElementById('categoryResults');
    const selectedCategories = document.getElementById('selectedCategories');

    categorySearch.addEventListener('focus', () => {
        filterCategories(categorySearch.value);
        categoryResults.classList.remove('hidden');
    });
    categorySearch.addEventListener('input', (e) => {
        filterCategories(e.target.value);
        categoryResults.classList.remove('hidden');
    });

    function filterCategories(searchTerm) {
        let filtered = categoriesList.filter(cat => {
            return !selectedCategoriesList.some(c => c.id === cat.id) &&
                   cat.name.toLowerCase().includes(searchTerm.toLowerCase());
        });
        categoryResults.innerHTML = filtered.length ? filtered.map(cat => `
            <div class="p-2 hover:bg-neutral-600 cursor-pointer">
                ${cat.name}
            </div>
        `).join('') : '<div class="p-2 text-neutral-400">No results found</div>';

        categoryResults.querySelectorAll('div').forEach(option => {
            if(!option.classList.contains('text-neutral-400')){
                option.addEventListener('click', () => {
                    const catName = option.textContent.trim();
                    const cat = categoriesList.find(c => c.name === catName);
                    if(cat && !selectedCategoriesList.some(c => c.id === cat.id)) {
                        selectedCategoriesList.push(cat);
                        updateSelectedCategories();
                    }
                    categorySearch.value = '';
                    filterCategories('');
                    categoryResults.classList.add('hidden');
                });
            }
        });
    }

    function updateSelectedCategories() {
        selectedCategories.innerHTML = selectedCategoriesList.map(cat => `
            <div class="flex items-center gap-1 bg-neutral-600 px-2 py-1 rounded-lg">
                <span class="text-sm text-neutral-100">${cat.name}</span>
                <button type="button" onclick="removeCategory(${cat.id})" class="text-neutral-400 hover:text-red-400">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="category_id[]" value="${cat.id}">
            </div>
        `).join('');
    }

    function removeCategory(id) {
        selectedCategoriesList = selectedCategoriesList.filter(cat => cat.id !== id);
        updateSelectedCategories();
        filterCategories(categorySearch.value);
    }
    
    // ======== Channels Multiple-Select ==========
    let selectedChannelsList = [];
    const channelSearch = document.getElementById('channelSearch');
    const channelResults = document.getElementById('channelResults');
    const selectedChannels = document.getElementById('selectedChannels');

    channelSearch.addEventListener('focus', () => {
        filterChannels(channelSearch.value);
        channelResults.classList.remove('hidden');
    });

    channelSearch.addEventListener('input', (e) => {
        filterChannels(e.target.value);
        channelResults.classList.remove('hidden');
    });

    function filterChannels(searchTerm) {
        let filtered = channelsList.filter(channel => {
            return !selectedChannelsList.some(c => c.id === channel.id) &&
                   channel.name.toLowerCase().includes(searchTerm.toLowerCase());
        });
        channelResults.innerHTML = filtered.length ? filtered.map(channel => `
            <div class="p-2 hover:bg-neutral-600 cursor-pointer">
                ${channel.name}
            </div>
        `).join('') : '<div class="p-2 text-neutral-400">No results found</div>';

        channelResults.querySelectorAll('div').forEach(option => {
            if(!option.classList.contains('text-neutral-400')){
                option.addEventListener('click', () => {
                    const channelName = option.textContent.trim();
                    const channel = channelsList.find(c => c.name === channelName);
                    if(channel && !selectedChannelsList.some(c => c.id === channel.id)) {
                        selectedChannelsList.push(channel);
                        updateSelectedChannels();
                    }
                    channelSearch.value = '';
                    filterChannels('');
                    channelResults.classList.add('hidden');
                });
            }
        });
    }

    function updateSelectedChannels() {
        selectedChannels.innerHTML = selectedChannelsList.map(channel => `
            <div class="flex items-center gap-1 bg-neutral-600 px-2 py-1 rounded-lg">
                <span class="text-sm text-neutral-100">${channel.name}</span>
                <button type="button" onclick="removeChannel(${channel.id})" class="text-neutral-400 hover:text-red-400">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="channel_id[]" value="${channel.id}">
            </div>
        `).join('');
    }

    function removeChannel(id) {
        selectedChannelsList = selectedChannelsList.filter(channel => channel.id !== id);
        updateSelectedChannels();
        filterChannels(channelSearch.value);
    }

    // Form submission (for demo purposes)
    const videoForm = document.getElementById('videoForm');
    videoForm.addEventListener('submit', (e) => {
        // e.preventDefault(); // Remove this line in production
        console.log('Form submitted');
    });
</script>
@endsection
