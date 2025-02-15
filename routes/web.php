<?php

use Illuminate\Support\Facades\Route;

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