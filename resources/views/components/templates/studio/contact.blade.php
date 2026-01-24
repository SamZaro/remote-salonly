{{--
    Template-specifieke contact voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Let\'s Connect';
    $subtitle = $content['subtitle'] ?? 'Kom langs, bel, of slide in onze DM\'s';
    $address = $content['address'] ?? "Creativelaan 42\n1012 AB Amsterdam";
    $phone = $content['phone'] ?? '+31 20 123 4567';
    $email = $content['email'] ?? 'hey@studio-hair.nl';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => 'Maandag', 'hours' => 'Gesloten'],
        ['day' => 'Dinsdag - Vrijdag', 'hours' => '10:00 - 20:00'],
        ['day' => 'Zaterdag', 'hours' => '09:00 - 18:00'],
        ['day' => 'Zondag', 'hours' => '12:00 - 17:00'],
    ];

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
@endphp

<section id="contact" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Background elements --}}
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full -translate-y-1/2 translate-x-1/2" style="background: {{ $accentColor }}50;"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 -translate-x-1/2" style="background: {{ $primaryColor }}20;"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6 transform rotate-1"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                SAY HI!
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6"
                style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-xl max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Contact info cards --}}
            <div class="space-y-6">
                {{-- Address --}}
                <div
                    class="p-6 rounded-3xl transform -rotate-1 hover:rotate-0 transition-transform"
                    style="background: white; box-shadow: 6px 6px 0 {{ $primaryColor }};"
                >
                    <div class="flex items-start gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0"
                            style="background: {{ $primaryColor }};"
                        >
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2" style="color: {{ $headingColor }};">Location</h4>
                            <p class="whitespace-pre-line" style="color: {{ $textColor }};">{{ $address }}</p>
                        </div>
                    </div>
                </div>

                {{-- Phone --}}
                <div
                    class="p-6 rounded-3xl transform rotate-1 hover:rotate-0 transition-transform"
                    style="background: white; box-shadow: 6px 6px 0 {{ $secondaryColor }};"
                >
                    <div class="flex items-start gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0"
                            style="background: {{ $secondaryColor }};"
                        >
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2" style="color: {{ $headingColor }};">Call Us</h4>
                            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-lg font-medium hover:opacity-70 transition-opacity" style="color: {{ $primaryColor }};">
                                {{ $phone }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Email --}}
                <div
                    class="p-6 rounded-3xl transform -rotate-1 hover:rotate-0 transition-transform"
                    style="background: white; box-shadow: 6px 6px 0 {{ $accentColor }};"
                >
                    <div class="flex items-start gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0"
                            style="background: {{ $accentColor }};"
                        >
                            <svg class="w-7 h-7" style="color: {{ $headingColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-2" style="color: {{ $headingColor }};">Email</h4>
                            <a href="mailto:{{ $email }}" class="text-lg font-medium hover:opacity-70 transition-opacity" style="color: {{ $primaryColor }};">
                                {{ $email }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Social links --}}
                <div class="flex gap-4 justify-center lg:justify-start">
                    @foreach(['instagram', 'tiktok', 'facebook'] as $social)
                        <a
                            href="#"
                            class="w-14 h-14 rounded-2xl flex items-center justify-center transform hover:scale-110 hover:-rotate-6 transition-all"
                            style="background: {{ $secondaryColor }};"
                        >
                            @if($social === 'instagram')
                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            @elseif($social === 'tiktok')
                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                                </svg>
                            @else
                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Opening hours & Map --}}
            <div class="space-y-6">
                {{-- Opening hours --}}
                <div
                    class="p-8 rounded-3xl"
                    style="background: white; box-shadow: 8px 8px 0 {{ $secondaryColor }};"
                >
                    <h4 class="font-bold text-xl mb-6 flex items-center gap-2" style="color: {{ $headingColor }};">
                        <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Openingstijden
                    </h4>
                    <div class="space-y-4">
                        @foreach($openingHours as $index => $time)
                            <div
                                class="flex items-center justify-between py-3 border-b-2 border-dashed"
                                style="border-color: {{ $accentColor }};"
                            >
                                <span class="font-medium" style="color: {{ $headingColor }};">{{ $time['day'] }}</span>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-bold"
                                    style="background: {{ $time['hours'] === 'Gesloten' ? $accentColor : $primaryColor }}; color: {{ $time['hours'] === 'Gesloten' ? $headingColor : 'white' }};"
                                >
                                    {{ $time['hours'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Map placeholder --}}
                <div
                    class="h-64 rounded-3xl flex items-center justify-center transform rotate-1"
                    style="background: {{ $accentColor }}; box-shadow: 6px 6px 0 {{ $primaryColor }};"
                >
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-3" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="font-bold" style="color: {{ $headingColor }};">Kaart komt hier</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
