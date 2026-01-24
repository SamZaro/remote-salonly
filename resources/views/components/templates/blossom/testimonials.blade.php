{{--
    Template-specifieke testimonials voor Blossom (Luxury Beauty Salon)

    Reviews met 5 sterren
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Wat Onze Klanten Zeggen';
    $subtitle = $content['subtitle'] ?? 'Beoordeeld met 4.9 sterren door onze lovely clients';
    $rating = $content['rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '312';
    $reviews = $content['reviews'] ?? [
        [
            'name' => 'Sophie van Dijk',
            'date' => '1 week geleden',
            'rating' => 5,
            'text' => 'Absoluut de beste salon waar ik ooit ben geweest! Mijn balayage is precies wat ik wilde. Het team is zo lief en professioneel.',
            'service' => 'Balayage',
        ],
        [
            'name' => 'Emma Bakker',
            'date' => '2 weken geleden',
            'rating' => 5,
            'text' => 'Heerlijk ontspannen tijdens mijn behandeling. De manicure is perfect en de sfeer in de salon is geweldig. Aanrader!',
            'service' => 'Manicure Deluxe',
        ],
        [
            'name' => 'Lisa de Groot',
            'date' => '3 weken geleden',
            'rating' => 5,
            'text' => 'Mijn wimperextensions zijn prachtig! Ze luisteren echt naar wat je wilt en het resultaat overtreft elke keer mijn verwachtingen.',
            'service' => 'Wimperextensions',
        ],
        [
            'name' => 'Anna Visser',
            'date' => '1 maand geleden',
            'rating' => 5,
            'text' => 'De brow lamination heeft mijn ochtend routine zo veel makkelijker gemaakt. Super blij met het resultaat en de service!',
            'service' => 'Brow Lamination',
        ],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $lightBg = '#fdf8f8';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $lightBg }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Reviews
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>

            {{-- Rating badge --}}
            <div
                class="inline-flex items-center gap-4 px-8 py-4 rounded-2xl bg-white"
                style="box-shadow: 0 10px 40px {{ $primaryColor }}15;"
            >
                <div class="flex items-center gap-3">
                    <span
                        class="text-4xl font-bold"
                        style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ $rating }}
                    </span>
                    <div>
                        <div class="flex items-center gap-0.5">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm" style="color: {{ $textColor }}; opacity: 0.6;">{{ $totalReviews }} reviews</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $review)
                <div
                    class="bg-white p-8 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl relative overflow-hidden"
                    style="box-shadow: 0 4px 20px {{ $primaryColor }}10;"
                >
                    {{-- Decorative corner --}}
                    <div
                        class="absolute top-0 right-0 w-24 h-24 rounded-bl-[4rem] opacity-10"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                    ></div>

                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-4 relative">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <div
                                class="w-14 h-14 rounded-full flex items-center justify-center text-lg font-bold text-white"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                            >
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-semibold" style="color: {{ $textColor }};">
                                    {{ $review['name'] }}
                                </h4>
                                <span class="text-sm" style="color: {{ $textColor }}; opacity: 0.5;">
                                    {{ $review['date'] }}
                                </span>
                            </div>
                        </div>
                        {{-- Quote icon --}}
                        <svg class="w-8 h-8 opacity-20" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="leading-relaxed mb-4 italic" style="color: {{ $textColor }}; opacity: 0.8;">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Service tag --}}
                    @if(isset($review['service']))
                        <span
                            class="inline-flex items-center gap-2 text-xs font-medium px-3 py-1.5 rounded-full"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10); color: {{ $primaryColor }};"
                        >
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            {{ $review['service'] }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-12">
            <a
                href="#contact"
                class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold transition-all duration-300 hover:shadow-lg"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Word ook een happy client
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </a>
        </div>
    </div>
</section>
