@extends('layouts.index')
@section('content')
<!-- Main Content -->
<main class="container mx-auto px-4 pt-24 pb-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-8">Privacy Policy</h1>
        
        <!-- Last Updated -->
        <div class="mb-8 text-neutral-400">
            <p>Last updated: February 13, 2025</p>
        </div>

        <!-- Introduction -->
        <section class="mb-12">
            <p class="text-neutral-300 leading-relaxed mb-6">
                At VideoFlex, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our video streaming platform.
            </p>
        </section>

        <!-- Privacy Sections -->
        <div class="space-y-12">
            <!-- Information Collection -->
            <section>
                <h2 class="text-2xl font-semibold mb-4">Information We Collect</h2>
                <div class="bg-neutral-800/30 rounded-xl p-6 space-y-4">
                    <div>
                        <h3 class="font-semibold text-red-500 mb-2">Personal Information</h3>
                        <ul class="list-disc list-inside text-neutral-300 space-y-2">
                            <li>Name and email address</li>
                            <li>Profile information</li>
                            <li>Payment information</li>
                            <li>Device information</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-red-500 mb-2">Usage Data</h3>
                        <ul class="list-disc list-inside text-neutral-300 space-y-2">
                            <li>Viewing history</li>
                            <li>Search queries</li>
                            <li>Interaction with content</li>
                            <li>Technical logs</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- How We Use Information -->
            <section>
                <h2 class="text-2xl font-semibold mb-4">How We Use Your Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-shield-alt text-red-500 mr-3"></i>
                            <h3 class="font-semibold">Service Improvement</h3>
                        </div>
                        <p class="text-neutral-300">We use your information to improve our services, customize content recommendations, and enhance your viewing experience.</p>
                    </div>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-lock text-red-500 mr-3"></i>
                            <h3 class="font-semibold">Security</h3>
                        </div>
                        <p class="text-neutral-300">Your information helps us detect and prevent fraud, abuse, and security incidents on our platform.</p>
                    </div>
                </div>
            </section>

            <!-- Data Protection -->
            <section>
                <h2 class="text-2xl font-semibold mb-4">Data Protection</h2>
                <div class="bg-neutral-800/30 rounded-xl p-6">
                    <p class="text-neutral-300 mb-4">We implement appropriate technical and organizational measures to protect your personal information, including:</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-neutral-800/50 rounded-lg text-center">
                            <i class="fas fa-lock text-red-500 text-2xl mb-2"></i>
                            <h4 class="font-semibold mb-2">Encryption</h4>
                            <p class="text-sm text-neutral-400">Data encryption in transit and at rest</p>
                        </div>
                        <div class="p-4 bg-neutral-800/50 rounded-lg text-center">
                            <i class="fas fa-user-shield text-red-500 text-2xl mb-2"></i>
                            <h4 class="font-semibold mb-2">Access Control</h4>
                            <p class="text-sm text-neutral-400">Strict access controls and authentication</p>
                        </div>
                        <div class="p-4 bg-neutral-800/50 rounded-lg text-center">
                            <i class="fas fa-shield-virus text-red-500 text-2xl mb-2"></i>
                            <h4 class="font-semibold mb-2">Regular Audits</h4>
                            <p class="text-sm text-neutral-400">Security audits and assessments</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Your Rights -->
            <section>
                <h2 class="text-2xl font-semibold mb-4">Your Rights</h2>
                <div class="bg-neutral-800/30 rounded-xl p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-check-circle text-red-500 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">Access and Update</h3>
                                <p class="text-neutral-300">You can access and update your personal information through your account settings.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-check-circle text-red-500 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">Data Portability</h3>
                                <p class="text-neutral-300">You can request a copy of your data in a structured, commonly used format.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <i class="fas fa-check-circle text-red-500 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">Deletion</h3>
                                <p class="text-neutral-300">You can request the deletion of your account and associated data.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Information -->
            <section>
                <h2 class="text-2xl font-semibold mb-4">Contact Us</h2>
                <div class="bg-neutral-800/30 rounded-xl p-6">
                    <p class="text-neutral-300 mb-4">If you have any questions about this Privacy Policy, please contact us:</p>
                    <div class="space-y-2">
                        <p class="text-neutral-300"><span class="font-semibold">Email:</span> privacy@videoflex.com</p>
                        <p class="text-neutral-300"><span class="font-semibold">Address:</span> 123 Tech Street, San Francisco, CA 94105</p>
                        <p class="text-neutral-300"><span class="font-semibold">Phone:</span> +1 (555) 123-4567</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection