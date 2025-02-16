@extends('layouts.admin')
@section('content')
<!-- Main Content -->
<div class="ml-64 p-8">
    <header class="bg-neutral-800 shadow-sm rounded-xl p-4 mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-neutral-100">Update Video</h2>
            <p class="text-neutral-400">Edit and update video content</p>
        </div>
        <button type="submit" form="videoForm" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
            Update Video
        </button>
    </header>

    <form id="videoForm" action="{{ route('update-video', $video->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')
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
                                   value="{{ old('video_link', $video->video_link) }}"
                                   class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                            <p class="mt-1 text-sm text-neutral-500">Enter a direct link to your video file</p>
                        </div>
                        <div class="w-32">
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Duration</label>
                            <input type="text" name="duration" placeholder="HH:MM:SS" pattern="^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$" required
                                   value="{{ old('duration', $video->duration) }}"
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
                        <input type="text" name="title" required value="{{ old('title', $video->title) }}"
                               class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Description</label>
                        <textarea name="description" rows="4" required
                                  class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">{{ old('description', $video->description) }}</textarea>
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
                                <option value="en" {{ old('language', $video->language) == 'en' ? 'selected' : '' }}>English</option>
                                <option value="es" {{ old('language', $video->language) == 'es' ? 'selected' : '' }}>Spanish</option>
                                <option value="fr" {{ old('language', $video->language) == 'fr' ? 'selected' : '' }}>French</option>
                                <option value="de" {{ old('language', $video->language) == 'de' ? 'selected' : '' }}>German</option>
                                <option value="it" {{ old('language', $video->language) == 'it' ? 'selected' : '' }}>Italian</option>
                                <option value="hi" {{ old('language', $video->language) == 'hi' ? 'selected' : '' }}>Hindi</option>
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
                        <div id="tagInputsContainer"></div>
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
                        @if($video->thumbnail)
                            <img id="thumbnailImage" src="{{ asset('storage/' . $video->thumbnail) }}" class="w-full h-full object-cover">
                        @else
                            <img id="thumbnailImage" class="w-full h-full object-cover hidden">
                            <div id="thumbnailPlaceholder" class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-neutral-500"></i>
                            </div>
                        @endif
                    </div>
                    <input type="file" id="thumbnailInput" name="thumbnail" accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('thumbnailInput').click()"
                            class="w-full px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-neutral-100 rounded-lg transition-colors">
                        Change Thumbnail
                    </button>
                    <p class="text-sm text-neutral-500">Recommended: 1280x720px JPG, PNG</p>
                </div>
            </div>

            <!-- Visibility Section -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Visibility</h3>
                <div class="space-y-4">
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="visibility" value="public" {{ old('visibility', $video->visibility) == 'public' ? 'checked' : '' }}
                               class="text-red-500 focus:ring-red-500">
                        <span class="text-neutral-100">Public</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="visibility" value="unlisted" {{ old('visibility', $video->visibility) == 'unlisted' ? 'checked' : '' }}
                               class="text-red-500 focus:ring-red-500">
                        <span class="text-neutral-100">Unlisted</span>
                    </label>
                    <label class="flex items-center space-x-3">
                        <input type="radio" name="visibility" value="private" {{ old('visibility', $video->visibility) == 'private' ? 'checked' : '' }}
                               class="text-red-500 focus:ring-red-500">
                        <span class="text-neutral-100">Private</span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Available lists for searching
    const actorsList = @json($actors->map(function($actor) {
        return ['id' => $actor->id, 'name' => $actor->name];
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

    // Initialize with existing relationships
    let selectedActorsList = @json($video->actors->map(function($actor) {
        return ['id' => $actor->id, 'name' => $actor->name];
    }));
    let selectedTagsList = @json($video->tags->map(function($tag) {
        return ['id' => $tag->id, 'name' => $tag->name];
    }));
    let selectedCategoriesList = @json($video->categories->map(function($category) {
        return ['id' => $category->id, 'name' => $category->name];
    }));
    let selectedChannelsList = @json($video->channels->map(function($channel) {
        return ['id' => $channel->id, 'name' => $channel->channel_name];
    }));

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
                thumbnailPlaceholder?.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // ======== Actors Multiple-Select ==========
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
                        updateTagInputs();
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
            </div>
        `).join('');
    }

    function removeTag(name) {
        selectedTagsList = selectedTagsList.filter(tag => tag.name !== name);
        updateSelectedTags();
        updateTagInputs();
    }

    function updateTagInputs() {
        const container = document.getElementById('tagInputsContainer');
        container.innerHTML = '';
        selectedTagsList.forEach(tag => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'tags[]';
            input.value = tag.name;
            container.appendChild(input);
        });
    }

    // ======== Categories Multiple-Select ==========
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
        let filtered = categoriesList.filter(category => {
            return !selectedCategoriesList.some(c => c.id === category.id) &&
                   category.name.toLowerCase().includes(searchTerm.toLowerCase());
        });
        categoryResults.innerHTML = filtered.length ? filtered.map(category => `
            <div class="p-2 hover:bg-neutral-600 cursor-pointer">
                ${category.name}
            </div>
        `).join('') : '<div class="p-2 text-neutral-400">No results found</div>';

        categoryResults.querySelectorAll('div').forEach(option => {
            if(!option.classList.contains('text-neutral-400')){
                option.addEventListener('click', () => {
                    const categoryName = option.textContent.trim();
                    const category = categoriesList.find(c => c.name === categoryName);
                    if(category && !selectedCategoriesList.some(c => c.id === category.id)) {
                        selectedCategoriesList.push(category);
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
        selectedCategories.innerHTML = selectedCategoriesList.map(category => `
            <div class="flex items-center gap-1 bg-neutral-600 px-2 py-1 rounded-lg">
                <span class="text-sm text-neutral-100">${category.name}</span>
                <button type="button" onclick="removeCategory(${category.id})" class="text-neutral-400 hover:text-red-400">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" name="category_id[]" value="${category.id}">
            </div>
        `).join('');
    }

    function removeCategory(id) {
        selectedCategoriesList = selectedCategoriesList.filter(category => category.id !== id);
        updateSelectedCategories();
        filterCategories(categorySearch.value);
    }

    // ======== Channels Multiple-Select ==========
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

    // Initialize selections
    window.addEventListener('load', function() {
        updateSelectedActors();
        updateSelectedTags();
        updateTagInputs();
        updateSelectedCategories();
        updateSelectedChannels();
    });
</script>
@endsection
