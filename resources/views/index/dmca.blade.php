@extends('layouts.index')

@section('title', 'DMCA Policy')
@section('meta_description', 'This Digital Millennium Copyright Act policy ("Policy") applies to the {{ $settings->site_name }} website ("Website" or "Service") and any of its related products and services (collectively, "Services") and outlines how this Website operator ("Operator", "we", "us" or "our") addresses copyright infringement notifications and how you ("you" or "your") may submit a copyright infringement complaint.')
@section('meta_keywords', 'DMCA, Digital Millennium Copyright Act, Copyright, Infringement, Notification, Policy, Compliance, Complaint, Protection')

@section('content')
<!-- Main Content -->
<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mt-16">
    <div class="bg-neutral-800/50 rounded-2xl p-8 space-y-8">
        <div>
            <h1 class="text-3xl font-bold mb-4">DMCA Policy</h1>
            <p class="text-neutral-300">This Digital Millennium Copyright Act policy ("Policy") applies to the {{ $settings->site_name }} website ("Website" or "Service") and any of its related products and services (collectively, "Services") and outlines how this Website operator ("Operator", "we", "us" or "our") addresses copyright infringement notifications and how you ("you" or "your") may submit a copyright infringement complaint.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">What to Consider Before Submitting a Copyright Complaint</h2>
            <p class="text-neutral-300 mb-4">Before submitting a copyright complaint to us, consider whether the use of your copyrighted material may qualify as fair use. Fair use depends on various factors, including:</p>
            <ul class="list-disc pl-6 space-y-2 text-neutral-300">
                <li>The purpose and character of the use (e.g., commercial vs. educational)</li>
                <li>The nature of the copyrighted work</li>
                <li>The amount and substantiality of the portion used</li>
                <li>The effect on the potential market for the copyrighted work</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">Notifications of Copyright Infringement</h2>
            <p class="text-neutral-300">If you are a copyright owner or authorized to act on behalf of one, you may submit a notification pursuant to the Digital Millennium Copyright Act (DMCA) by providing us with the following information in writing:</p>
            <ul class="list-decimal pl-6 space-y-2 text-neutral-300 mt-4">
                <li>Identification of the copyrighted work claimed to have been infringed</li>
                <li>Identification of the allegedly infringing material that is requested to be removed, including a description of where it is located on the Service</li>
                <li>Information reasonably sufficient to permit us to contact you, such as your address, telephone number, and email address</li>
                <li>A statement that you have a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or law</li>
                <li>A statement that the information in the notification is accurate, and under penalty of perjury, that you are authorized to act on behalf of the copyright owner</li>
                <li>A physical or electronic signature of the copyright owner or a person authorized to act on their behalf</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">Filing a DMCA Notice</h2>
            <p class="text-neutral-300 mb-4">To submit a DMCA notice, please send the required information to:</p>
            <div class="bg-neutral-700/50 rounded-xl p-6 space-y-2">
                <p class="text-neutral-300"><strong>Email:</strong> dmca@{{ strtolower($settings->site_name) }}.com</p>
                <p class="text-neutral-300"><strong>Address:</strong> [Your Physical Address]</p>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">Counter-Notification</h2>
            <p class="text-neutral-300">If you receive a DMCA notification and believe that material you posted on the Service was removed or access to it was disabled by mistake or misidentification, you may file a counter-notification with us by submitting the following information:</p>
            <ul class="list-decimal pl-6 space-y-2 text-neutral-300 mt-4">
                <li>Identification of the material that has been removed or disabled and the location at which the material appeared before it was removed or disabled</li>
                <li>A statement under penalty of perjury that you have a good faith belief that the material was removed or disabled as a result of mistake or misidentification</li>
                <li>Your name, address, telephone number, and email address</li>
                <li>A statement that you consent to the jurisdiction of the federal court in [Your Jurisdiction] and that you will accept service of process from the person who provided notification of the alleged infringement</li>
            </ul>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">Repeat Infringers</h2>
            <p class="text-neutral-300">It is our policy to terminate the accounts of users who repeatedly infringe copyright or other intellectual property rights of others.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">Changes and Amendments</h2>
            <p class="text-neutral-300">We reserve the right to modify this Policy or its terms relating to the Website and Services at any time, effective upon posting of an updated version of this Policy on the Website. When we do, we will revise the updated date at the bottom of this page.</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-3">Reporting Copyright Infringement</h2>
            <p class="text-neutral-300 mb-4">If you would like to report copyright infringement, please contact us using the information below:</p>
            <div class="bg-neutral-800 rounded-xl p-6">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl text-base font-medium text-white bg-red-500 hover:bg-red-600 transition-colors">
                    Contact Us
                </a>
            </div>
        </div>

        <div class="pt-8 border-t border-neutral-700">
            <p class="text-sm text-neutral-400">Last updated: {{ now()->format('F j, Y') }}</p>
        </div>
    </div>
</main>
@endsection
