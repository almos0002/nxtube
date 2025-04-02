@extends('layouts.index')

@section('title', 'About Us')
@section('meta_description',
    'At VideoFlex, we are committed to providing a seamless and enjoyable video streaming
    experience for our users. Our about page provides an overview of our mission, values, and team.')
@section('meta_keywords', 'about, us, mission, values, team, video, streaming, experience')

@php
$hideBreadcrumbs = true;
@endphp

@section('content')
    <section class="nx-container py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold mb-8">About VideoFlex</h1>

            <!-- Mission Statement -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
                <p class="text-neutral-300 leading-relaxed mb-6">
                    VideoFlex is dedicated to providing a seamless and enjoyable video streaming experience. Our platform
                    brings together content creators and viewers in a dynamic, user-friendly environment.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                    <div class="bg-neutral-800/50 p-6 rounded-xl">
                        <i class="fas fa-video text-3xl text-red-500 mb-4"></i>
                        <h3 class="font-semibold mb-2">Quality Content</h3>
                        <p class="text-sm text-neutral-400">High-quality streaming with adaptive bitrate technology</p>
                    </div>
                    <div class="bg-neutral-800/50 p-6 rounded-xl">
                        <i class="fas fa-users text-3xl text-red-500 mb-4"></i>
                        <h3 class="font-semibold mb-2">Community</h3>
                        <p class="text-sm text-neutral-400">Building connections through shared interests</p>
                    </div>
                    <div class="bg-neutral-800/50 p-6 rounded-xl">
                        <i class="fas fa-shield-alt text-3xl text-red-500 mb-4"></i>
                        <h3 class="font-semibold mb-2">Security</h3>
                        <p class="text-sm text-neutral-400">Protected content delivery and user privacy</p>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="mb-12">
                <h2 class="text-2xl font-semibold mb-6">Our Team</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden">
                            <img src="https://picsum.photos/200" alt="Team Member" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold">John Doe</h3>
                        <p class="text-sm text-neutral-400">CEO & Founder</p>
                    </div>
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden">
                            <img src="https://picsum.photos/201" alt="Team Member" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold">Jane Smith</h3>
                        <p class="text-sm text-neutral-400">Head of Content</p>
                    </div>
                    <div class="text-center">
                        <div class="w-32 h-32 mx-auto mb-4 rounded-full overflow-hidden">
                            <img src="https://picsum.photos/202" alt="Team Member" class="w-full h-full object-cover">
                        </div>
                        <h3 class="font-semibold">Mike Johnson</h3>
                        <p class="text-sm text-neutral-400">Technical Lead</p>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="bg-neutral-800/30 rounded-2xl p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl font-bold text-red-500 mb-2">10M+</div>
                        <div class="text-sm text-neutral-400">Active Users</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-red-500 mb-2">500K+</div>
                        <div class="text-sm text-neutral-400">Content Creators</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-red-500 mb-2">1M+</div>
                        <div class="text-sm text-neutral-400">Videos</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-red-500 mb-2">50+</div>
                        <div class="text-sm text-neutral-400">Countries</div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
