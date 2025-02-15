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

    <form id="videoForm" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Video Upload Section -->
            <div class="bg-neutral-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-neutral-100 mb-4">Video Link</h3>
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Video URL</label>
                            <input type="url" name="videoLink" required placeholder="Enter video URL (e.g., https://example.com/video.mp4)" 
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
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Channel</label>
                            <select name="channel" required
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <option value="">Select Channel</option>
                                <option value="code-masters">Code Masters</option>
                                <option value="gaming-hub">Gaming Hub</option>
                                <option value="music-academy">Music Academy</option>
                                <option value="tech-talks">Tech Talks</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Category</label>
                            <select name="category" required
                                    class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <option value="">Select Category</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="education">Education</option>
                                <option value="gaming">Gaming</option>
                                <option value="music">Music</option>
                                <option value="tech">Technology</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
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
                        <div>
                            <label class="block text-sm font-medium text-neutral-300 mb-2">Actors</label>
                            <div class="relative">
                                <input type="text" id="actorSearch" placeholder="Search actors..."
                                       class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                                <div id="actorResults" class="hidden absolute z-10 w-full mt-1 bg-neutral-700 border border-neutral-600 rounded-lg shadow-lg max-h-48 overflow-y-auto">
                                </div>
                            </div>
                            <div id="selectedActors" class="mt-2 flex flex-wrap gap-2">
                            </div>
                            <input type="hidden" name="actors[]" id="selectedActorsInput">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-2">Tags</label>
                        <input type="text" name="tags" placeholder="Add tags separated by commas"
                               class="w-full bg-neutral-700 border border-neutral-600 rounded-lg px-4 py-2 text-neutral-100 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                        <p class="mt-1 text-sm text-neutral-500">Add up to 10 tags to help viewers find your video</p>
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
                    <input type="file" id="thumbnailInput" accept="image/*" class="hidden">
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
                                <p class="text-sm text-neutral-400">Only Your Can Watch Your Video</p>
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
                
                // Initialize styles
                updateVisibilityStyles();
            </script>
        </div>
    </form>
</div>

<script>
    // Sidebar toggle
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const menuButton = document.getElementById('menuButton');
        sidebar.classList.toggle('-translate-x-full');
        menuButton.classList.toggle('rotate-180');
    }

    // Video link handling
    const videoLinkInput = document.querySelector('input[name="videoLink"]');
    const videoPreview = document.getElementById('videoPreview');
    const videoPlayer = videoPreview.querySelector('video');

    videoLinkInput.addEventListener('change', (e) => {
        const url = e.target.value.trim();
        if (url) {
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
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                thumbnailImage.src = e.target.result;
                thumbnailImage.classList.remove('hidden');
                thumbnailPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Actor search functionality
    const actorSearch = document.getElementById('actorSearch');
    const actorResults = document.getElementById('actorResults');
    const selectedActors = document.getElementById('selectedActors');
    const selectedActorsInput = document.getElementById('selectedActorsInput');
    
    // Sample actor data - in real app, this would come from an API
    const actorsList = [
        { id: 1, name: "John Smith", role: "Actor" },
        { id: 2, name: "Jane Doe", role: "Director" },
        { id: 3, name: "Mike Johnson", role: "Producer" },
        { id: 4, name: "Sarah Wilson", role: "Actor" },
        { id: 5, name: "David Brown", role: "Actor" },
        { id: 6, name: "Emma Davis", role: "Director" },
        { id: 7, name: "Chris Evans", role: "Actor" },
        { id: 8, name: "Anna White", role: "Producer" }
    ];
    
    let selectedActorsList = [];

    actorSearch.addEventListener('focus', () => {
        filterActors(actorSearch.value);
        actorResults.classList.remove('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!actorSearch.contains(e.target) && !actorResults.contains(e.target)) {
            actorResults.classList.add('hidden');
        }
    });

    actorSearch.addEventListener('input', (e) => {
        filterActors(e.target.value);
        actorResults.classList.remove('hidden');
    });

    function filterActors(searchTerm) {
        let filtered = actorsList.filter(actor => {
            // Filter out already selected actors and match search term
            return !selectedActorsList.includes(actor.name) &&
                   (actor.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                    actor.role.toLowerCase().includes(searchTerm.toLowerCase()));
        });

        // If not searching, only show first 5 results
        if (!searchTerm) {
            filtered = filtered.slice(0, 5);
        }

        // Update the results div
        actorResults.innerHTML = filtered.length ? filtered.map(actor => `
            <div class="p-2 hover:bg-neutral-600 cursor-pointer flex items-center justify-between">
                <span>${actor.name}</span>
                <span class="text-sm text-neutral-400">${actor.role}</span>
            </div>
        `).join('') : '<div class="p-2 text-neutral-400">No results found</div>';

        // Add a message showing total results if there are more
        if (!searchTerm && actorsList.length > 5) {
            actorResults.innerHTML += `
                <div class="p-2 text-sm text-neutral-400 border-t border-neutral-600">
                    Type to search more actors...
                </div>
            `;
        }

        // Attach click handlers to new results
        actorResults.querySelectorAll('div').forEach(option => {
            if (!option.classList.contains('text-neutral-400')) { // Skip the info messages
                option.addEventListener('click', () => {
                    const actorName = option.querySelector('span').textContent;
                    if (!selectedActorsList.includes(actorName)) {
                        selectedActorsList.push(actorName);
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
                <span class="text-sm text-neutral-100">${actor}</span>
                <button type="button" onclick="removeActor('${actor}')" class="text-neutral-400 hover:text-red-400">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `).join('');
        selectedActorsInput.value = JSON.stringify(selectedActorsList);
    }

    function removeActor(actor) {
        selectedActorsList = selectedActorsList.filter(a => a !== actor);
        updateSelectedActors();
        filterActors(actorSearch.value); // Refresh the results list
    }

    // Form submission
    const videoForm = document.getElementById('videoForm');
    videoForm.addEventListener('submit', (e) => {
        e.preventDefault();
        // Add your form submission logic here
        console.log('Form submitted');
    });
</script>
@endsection