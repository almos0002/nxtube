@extends('layouts.index')

@section('title', 'Contact Us')

@section('content')
<!-- Main Content -->
<main class="container mx-auto px-4 pt-24 pb-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-8">Contact Us</h1>
        
        <!-- Contact Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div>
                <h2 class="text-2xl font-semibold mb-6">Get in Touch</h2>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-red-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Email</h3>
                            <p class="text-neutral-400">support@videoflex.com</p>
                            <p class="text-neutral-400">business@videoflex.com</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-red-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Phone</h3>
                            <p class="text-neutral-400">+1 (555) 123-4567</p>
                            <p class="text-neutral-400">Mon-Fri, 9:00 AM - 6:00 PM EST</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-location-dot text-red-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-1">Address</h3>
                            <p class="text-neutral-400">123 Tech Street</p>
                            <p class="text-neutral-400">San Francisco, CA 94105</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-neutral-800/30 p-6 rounded-xl">
                <h2 class="text-2xl font-semibold mb-6">Send Message</h2>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700 focus:border-red-500 focus:outline-none transition-colors" placeholder="Your name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700 focus:border-red-500 focus:outline-none transition-colors" placeholder="your@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Subject</label>
                        <input type="text" class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700 focus:border-red-500 focus:outline-none transition-colors" placeholder="Message subject">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Message</label>
                        <textarea rows="4" class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700 focus:border-red-500 focus:outline-none transition-colors" placeholder="Your message"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                        Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- FAQ Section -->
        <section>
            <h2 class="text-2xl font-semibold mb-6">Frequently Asked Questions</h2>
            <div class="space-y-4">
                <div class="bg-neutral-800/30 p-6 rounded-xl">
                    <h3 class="font-semibold mb-2">How do I report a technical issue?</h3>
                    <p class="text-neutral-400">You can report technical issues through our support portal or by emailing support@videoflex.com with detailed information about the problem you're experiencing.</p>
                </div>
                <div class="bg-neutral-800/30 p-6 rounded-xl">
                    <h3 class="font-semibold mb-2">What are your business hours?</h3>
                    <p class="text-neutral-400">Our support team is available Monday through Friday, 9:00 AM to 6:00 PM EST. For urgent matters, we also provide 24/7 emergency support.</p>
                </div>
                <div class="bg-neutral-800/30 p-6 rounded-xl">
                    <h3 class="font-semibold mb-2">How can I become a content creator?</h3>
                    <p class="text-neutral-400">To become a content creator, sign up for an account and visit your profile settings. Click on "Become a Creator" and follow the verification process.</p>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection