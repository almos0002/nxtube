<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\Admin\SeoController;

Route::get('/', [IndexController::class, 'home'])->name('home');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/privacy', [IndexController::class, 'privacy'])->name('privacy');
Route::get('/dmca', [IndexController::class, 'dmca'])->name('dmca');
Route::get('/search', [IndexController::class, 'search'])->name('search');

// Auth routes must come before wildcard routes
Route::prefix('admin')->group(function () {
    Auth::routes();
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Admin Dashboard & Pages
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/videos', [VideoController::class, 'index'])->name('videos');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/actors', [ActorController::class, 'index'])->name('actors');
    Route::get('/channels', [ChannelController::class, 'index'])->name('channels');
    
    // Settings Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/settings/clear-cache', [SettingController::class, 'clearCache'])->name('settings.clear-cache');
    
    // Ads Routes
    Route::get('/ads', [AdsController::class, 'index'])->name('ads');
    Route::put('/ads', [AdsController::class, 'update'])->name('ads.update');
    Route::post('/ads/toggle-status', [AdsController::class, 'toggleStatus'])->name('ads.toggle-status');
    
    // SEO Routes
    Route::get('/seo', [SeoController::class, 'index'])->name('admin.seo.index');
    Route::post('/seo', [SeoController::class, 'update'])->name('admin.seo.update');
    Route::get('/seo/generate-sitemap', [SeoController::class, 'generateSitemap'])->name('admin.seo.generate-sitemap');

    Route::view('/profile', 'admin.profile')->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('update-profile');

    // Category Routes
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::put('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');
    Route::post('/toggle-category-status/{category:id}', [CategoryController::class, 'toggleStatus'])->name('toggle-category-status');

    // Actor Routes
    Route::get('/add-actor', [ActorController::class, 'create'])->name('add-actor');
    Route::post('/store-actor', [ActorController::class, 'store'])->name('store-actor');
    Route::get('/edit-actor/{id}', [ActorController::class, 'edit'])->name('edit-actor');
    Route::put('/update-actor/{id}', [ActorController::class, 'update'])->name('update-actor');
    Route::delete('/delete-actor/{id}', [ActorController::class, 'destroy'])->name('delete-actor');
    Route::post('/toggle-actor-visibility/{actor}', [ActorController::class, 'toggleVisibility'])->name('toggle-actor-visibility');

    // Channel Routes
    Route::get('/add-channel', [ChannelController::class, 'create'])->name('add-channel');
    Route::post('/store-channel', [ChannelController::class, 'store'])->name('store-channel');
    Route::get('/edit-channel/{id}', [ChannelController::class, 'edit'])->name('edit-channel');
    Route::put('/update-channel/{id}', [ChannelController::class, 'update'])->name('update-channel');
    Route::delete('/delete-channel/{id}', [ChannelController::class, 'destroy'])->name('delete-channel');

    // Video Routes
    Route::get('/add-video', [VideoController::class, 'create'])->name('add-video');
    Route::post('/store-video', [VideoController::class, 'store'])->name('store-video');
    Route::get('/edit-video/{id}', [VideoController::class, 'edit'])->name('edit-video');
    Route::put('/update-video/{id}', [VideoController::class, 'update'])->name('update-video');
    Route::delete('/delete-video/{id}', [VideoController::class, 'destroy'])->name('delete-video');
});

// Public routes with slugs - these must come after fixed routes
Route::get('/channel/{handle}', [IndexController::class, 'channelByHandle'])->name('channel');
Route::get('/actor/{actor}', [IndexController::class, 'actor'])->name('actor');
Route::get('/category/{category}', [IndexController::class, 'category'])->name('category');
Route::get('/tag/{tag}', [IndexController::class, 'tag'])->name('tag');

// Public listing pages
Route::get('/categories', [IndexController::class, 'allCategories'])->name('all-categories');
Route::get('/actors', [IndexController::class, 'allActors'])->name('all-actors');
Route::get('/channels', [IndexController::class, 'allChannels'])->name('all-channels');
Route::get('/videos', [IndexController::class, 'allVideos'])->name('all-videos');

// This must be the last route since it's the most generic
Route::get('/{video}', [IndexController::class, 'video'])->name('video');
