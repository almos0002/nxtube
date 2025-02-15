<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');
Route::get('/videos', function () {
    return view('admin.video');
})->name('videos');
Route::get('/actors', function () {
    return view('admin.actor');
})->name('actors');
Route::get('/categories', function () {
    return view('admin.category');
})->name('categories');
Route::get('/channels', function () {
    return view('admin.channel');
})->name('channels');
Route::get('/settings', function () {
    return view('admin.setting');
})->name('settings');
Route::get('/profile', function () {
    return view('admin.profile');
})->name('profile');
Route::get('/add-video', function () {
    return view('crud.video.add');
})->name('add-video');

Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');

Route::get('/add-actor', [ActorController::class, 'create'])->name('add-actor');
Route::post('/store-actor', [ActorController::class, 'store'])->name('store-actor');



Route::get('/add-channel', function () {
    return view('crud.channel.add');
})->name('add-channel');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
