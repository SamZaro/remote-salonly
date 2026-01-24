{{--
    Template-specifieke testimonials voor Coupe (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Wat Klanten Zeggen';
    $subtitle = $content['subtitle'] ?? 'Ervaringen';
    $googleRating = $content['google_rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '180';
    $reviews = $content['reviews'] ?? [
        [
            'name' => 'Charlotte van den Berg',
            'date' => '2 weken geleden',
            'rating' => 5,
            'text' => 'Een oase van rust in de stad. Het team heeft niet alleen oog voor detail, maar ook voor wie je bent. Mijn balayage is precies geworden zoals ik wilde - natuurlijk en elegant.',
            'service' => 'Balayage',
        ],
        [
            'name' => 'Sophie de Vries',
            'date' => '1 maand geleden',
            'rating' => 5,
            'text' => 'Eindelijk een salon die écht luistert. De sfeer is heerlijk en het resultaat overtreft elke keer mijn verwachtingen. Premium kwaliteit.',
            'service' => 'Knippen & Stylen',
        ],
        [
            'name' => 'Emma Jansen',
            'date' => '3 weken geleden',
            'rating' => 5,
            'text' => 'Van het moment dat je binnenkomt voel je je welkom. De aandacht voor detail en het persoonlijke advies maken dit tot mijn favoriete salon.',
            'service' => 'Kleuren',
        ],
        [
            'name' => 'Isabelle Bakker',
            'date' => '1 week geleden',
            'rating' => 5,
            'text' => 'Professioneel, vriendelijk en vakkundig. Mijn bruidskapsel was adembenemend. Kan deze salon niet genoeg aanbevelen!',
            'service' => 'Bruidskapsel',
        ],
    ];

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings
@endphp

<section id="testimonials" class="py-24 lg:py-32" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="max-w-3xl mx-auto text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <span
                    class="text-xs font-medium uppercase tracking-[0.3em]"
                    style="color: {{ $primaryColor }};"
                >
                    {{ $subtitle }}
                </span>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-light text-white"
                style="font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>

            {{-- Google rating --}}
            <div class="flex items-center justify-center gap-6 mt-10">
                <div class="flex items-center gap-3">
                    {{-- Google logo --}}
                    <svg class="w-8 h-8 opacity-80" viewBox="0 0 24 24">
                        <path fill="#ffffff" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#ffffff" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#ffffff" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#ffffff" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span
                        class="text-4xl font-light"
                        style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ $googleRating }}
                    </span>
                </div>
                <div class="h-8 w-px bg-white/20"></div>
                <div class="flex items-center gap-2">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    @endfor
                    <span class="text-sm text-white/50 ml-2">{{ $totalReviews }} reviews</span>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div class="relative p-10 transition-all duration-300 hover:-translate-y-1" style="background-color: {{ $secondaryColor }};">
                    {{-- Quote mark --}}
                    <span
                        class="absolute top-8 right-10 text-8xl font-serif opacity-10"
                        style="color: {{ $primaryColor }};"
                    >
                        "
                    </span>

                    {{-- Border --}}
                    <div class="absolute inset-0 border" style="border-color: {{ $primaryColor }}20;"></div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-6 relative">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p
                        class="text-lg leading-relaxed mb-8 relative text-white/80 italic"
                        style="font-family: 'Playfair Display', Georgia, serif;"
                    >
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center justify-between relative">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <div
                                class="w-12 h-12 flex items-center justify-center text-lg font-light"
                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                            >
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-medium text-white">
                                    {{ $review['name'] }}
                                </h4>
                                <span class="text-sm text-white/40">
                                    {{ $review['date'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Service tag --}}
                        @if(isset($review['service']))
                            <span
                                class="text-xs uppercase tracking-wider px-3 py-1"
                                style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}40;"
                            >
                                {{ $review['service'] }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-16">
            <a
                href="https://www.google.com/maps"
                target="_blank"
                rel="noopener noreferrer"
                class="group inline-flex items-center gap-4 text-sm font-medium uppercase tracking-widest transition-all duration-300"
                style="color: {{ $primaryColor }};"
            >
                <span class="border-b pb-1" style="border-color: {{ $primaryColor }}40;">
                    Bekijk alle reviews
                </span>
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>
    </div>
</section>
