<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Admin Dashboard & Pages
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/videos', 'admin.video')->name('videos');
    Route::view('/actors', 'admin.actor')->name('actors');
    Route::view('/categories', 'admin.category')->name('categories');
    Route::view('/channels', 'admin.channel')->name('channels');
    Route::view('/settings', 'admin.setting')->name('settings');
    Route::view('/profile', 'admin.profile')->name('profile');

    // Category Routes
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');

    // Actor Routes
    Route::get('/add-actor', [ActorController::class, 'create'])->name('add-actor');
    Route::post('/store-actor', [ActorController::class, 'store'])->name('store-actor');

    // Channel Routes
    Route::get('/add-channel', [ChannelController::class, 'create'])->name('add-channel');
    Route::post('/store-channel', [ChannelController::class, 'store'])->name('store-channel');

    // Video Routes
    Route::get('/add-video', [VideoController::class, 'create'])->name('add-video');
    Route::post('/store-video', [VideoController::class, 'store'])->name('store-video');
});
