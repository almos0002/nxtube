@extends('layouts.index')

@section('title', 'DMCA Policy')
@section('meta_description',
    'This Digital Millennium Copyright Act policy ("Policy") applies to the
    {{ $settings->site_name }} website ("Website" or "Service") and any of its related products and services (collectively,
    "Services") and outlines how this Website operator ("Operator", "we", "us" or "our") addresses copyright infringement
    notifications and how you ("you" or "your") may submit a copyright infringement complaint.')
@section('meta_keywords',
    'DMCA, Digital Millennium Copyright Act, Copyright, Infringement, Notification, Policy,
    Compliance, Complaint, Protection')

@section('content')
    <section class="container mx-auto px-4 pt-8 pb-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold mb-8">DMCA Policy</h1>

            <!-- Last Updated -->
            <div class="mb-8 text-neutral-400">
                <p>Last updated: {{ now()->format('F j, Y') }}</p>
            </div>

            <!-- Introduction -->
            <section class="mb-12">
                <p class="text-neutral-300 leading-relaxed mb-6">
                    This Digital Millennium Copyright Act policy ("Policy") applies to the
                    {{ $settings->site_name }} website ("Website" or "Service") and any of its related products and services
                    (collectively, "Services") and outlines how this Website operator ("Operator", "we", "us" or "our")
                    addresses copyright infringement notifications and how you ("you" or "your") may submit a copyright
                    infringement complaint.
                </p>
            </section>

            <!-- DMCA Sections -->
            <div class="space-y-12">
                <!-- What to Consider -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">What to Consider Before Submitting a Copyright Complaint</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6 space-y-4">
                        <p class="text-neutral-300 mb-4">Before submitting a copyright complaint to us, consider whether the
                            use
                            of
                            your copyrighted material may qualify as fair use. Fair use depends on various factors,
                            including:
                        </p>
                        <ul class="list-disc list-inside text-neutral-300 space-y-2">
                            <li>The purpose and character of the use (e.g., commercial vs. educational)</li>
                            <li>The nature of the copyrighted work</li>
                            <li>The amount and substantiality of the portion used</li>
                            <li>The effect on the potential market for the copyrighted work</li>
                        </ul>
                    </div>
                </section>

                <!-- Notifications of Copyright Infringement -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Notifications of Copyright Infringement</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <p class="text-neutral-300 mb-4">If you are a copyright owner or authorized to act on behalf of one,
                            you
                            may
                            submit a notification pursuant to the Digital Millennium Copyright Act (DMCA) by providing us
                            with
                            the
                            following information in writing:</p>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">Identification of the copyrighted work claimed to have been
                                        infringed</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">Identification of the allegedly infringing material that is
                                        requested to be removed, including a
                                        description of where it is located on the Service</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">Information reasonably sufficient to permit us to contact
                                        you,
                                        such as your address, telephone
                                        number, and email address</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">A statement that you have a good faith belief that use of
                                        the
                                        material in the manner complained of
                                        is not authorized by the copyright owner, its agent, or law</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">A statement that the information in the notification is
                                        accurate, and under penalty of perjury, that
                                        you are authorized to act on behalf of the copyright owner</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">A physical or electronic signature of the copyright owner or
                                        a
                                        person authorized to act on their
                                        behalf</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Filing a DMCA Notice -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Filing a DMCA Notice</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <p class="text-neutral-300 mb-4">To submit a DMCA notice, please send the required information to:
                        </p>
                        <div class="space-y-2">
                            <p class="text-neutral-300"><span class="font-semibold">Email:</span>
                                dmca@{{ strtolower($settings - > site_name) }}.com
                            </p>
                            <p class="text-neutral-300"><span class="font-semibold">Address:</span> [Your Physical Address]
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Counter-Notification -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Counter-Notification</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <p class="text-neutral-300 mb-4">If you receive a DMCA notification and believe that material you
                            posted
                            on the
                            Service was removed or access to it was disabled by mistake or misidentification, you may file a
                            counter-notification with us by submitting the following information:</p>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">Identification of the material that has been removed or
                                        disabled
                                        and the location at which the
                                        material appeared before it was removed or disabled</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">A statement under penalty of perjury that you have a good
                                        faith
                                        belief that the material was removed
                                        or disabled as a result of mistake or misidentification</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">Your name, address, telephone number, and email address</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <i class="fas fa-check-circle text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-neutral-300">A statement that you consent to the jurisdiction of the
                                        federal
                                        court in [Your Jurisdiction] and
                                        that you will accept service of process from the person who provided notification of
                                        the
                                        alleged
                                        infringement</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Repeat Infringers -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Repeat Infringers</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <p class="text-neutral-300">It is our policy to terminate the accounts of users who repeatedly
                            infringe
                            copyright or other intellectual property rights of others.</p>
                    </div>
                </section>

                <!-- Changes and Amendments -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Changes and Amendments</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <p class="text-neutral-300">We reserve the right to modify this Policy or its terms relating to the
                            Website
                            and Services at any time, effective upon posting of an updated version of this Policy on the
                            Website.
                            When we do, we will revise the updated date at the bottom of this page.</p>
                    </div>
                </section>

                <!-- Reporting Copyright Infringement -->
                <section>
                    <h2 class="text-2xl font-semibold mb-4">Reporting Copyright Infringement</h2>
                    <div class="bg-neutral-800/30 rounded-xl p-6">
                        <p class="text-neutral-300 mb-4">If you would like to report copyright infringement, please contact
                            us
                            using
                            the information below:</p>
                        <div class="flex justify-center">
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl text-base font-medium text-white bg-red-500 hover:bg-red-600 transition-colors">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
