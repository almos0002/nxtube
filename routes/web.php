<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Admin Dashboard & Pages
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/videos', 'admin.video')->name('videos');
    Route::get('/actors', [ActorController::class, 'index'])->name('actors');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/channels', [ChannelController::class, 'index'])->name('channels');
    
    // Settings Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/settings/clear-cache', [SettingController::class, 'clearCache'])->name('settings.clear-cache');

    Route::view('/profile', 'admin.profile')->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('update-profile');

    // Category Routes
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::put('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');
    Route::post('/toggle-category-status/{category}', [CategoryController::class, 'toggleStatus'])->name('toggle-category-status');

    // Actor Routes
    Route::get('/actors', [ActorController::class, 'index'])->name('actors');
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

    // Video Routes
    Route::get('/add-video', [VideoController::class, 'create'])->name('add-video');
    Route::post('/store-video', [VideoController::class, 'store'])->name('store-video');
    Route::get('/edit-video/{id}', [VideoController::class, 'edit'])->name('edit-video');
    Route::put('/update-video/{id}', [VideoController::class, 'update'])->name('update-video');
});
