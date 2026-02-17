{{--
    Icon Template: Testimonials Section
    "Warm Atelier" — editorial review cards, gold accents, clean Google integration
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Wat Onze Klanten Zeggen';
    $subtitle = $content['subtitle'] ?? 'Beoordeeld met een 4.9 op Google';
    $googleRating = $content['google_rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '234';
    $reviews = $content['reviews'] ?? [
        [
            'name' => 'Lisa van der Berg',
            'date' => '1 week geleden',
            'rating' => 5,
            'text' => 'Fantastische ervaring! Mijn haar is nog nooit zo mooi geweest. Het team is super vriendelijk en de salon heeft een heerlijke sfeer.',
            'service' => 'Highlights',
        ],
        [
            'name' => 'Emma de Jong',
            'date' => '2 weken geleden',
            'rating' => 5,
            'text' => 'Eindelijk een kapper die naar je luistert! Ik ben zo blij met mijn nieuwe kleur. Kom hier zeker terug!',
            'service' => 'Kleuren',
        ],
        [
            'name' => 'Mark Jansen',
            'date' => '3 weken geleden',
            'rating' => 5,
            'text' => 'Top barbershop voor mannen. Goede service, eerlijke prijs en altijd tevreden met het resultaat. Aanrader!',
            'service' => "Men's Haircut",
        ],
        [
            'name' => 'Sophie Bakker',
            'date' => '1 maand geleden',
            'rating' => 5,
            'text' => 'De balayage is precies geworden zoals ik wilde. Heel professioneel en ze nemen de tijd om alles uit te leggen.',
            'service' => 'Balayage',
        ],
    ];

    // Theme kleuren — Warm Atelier palette
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section id="testimonials" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            {{-- Label --}}
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                    Reviews
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>

            {{-- Title --}}
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
            >
                {{ $title }}
            </h2>

            {{-- Subtitle --}}
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed mb-10" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>

            {{-- Google rating badge --}}
            <div
                class="inline-flex items-center gap-4 px-7 py-4"
                style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06;"
            >
                {{-- Google logo (colored) --}}
                <svg class="w-7 h-7 shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>

                <div class="flex items-center gap-3">
                    <span
                        class="text-2xl"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                    >
                        {{ $googleRating }}
                    </span>
                    <div>
                        <div class="flex items-center gap-0.5">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-[11px] uppercase tracking-[0.1em]" style="color: {{ $textColor }};">
                            {{ $totalReviews }} reviews
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 lg:gap-8 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div
                    class="group relative p-8 lg:p-10 transition-all duration-500"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Gold top accent — expands on hover --}}
                    <div
                        class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    {{-- Header: avatar + name + Google icon --}}
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <div
                                class="w-11 h-11 flex items-center justify-center rounded-full text-sm font-semibold"
                                style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
                            >
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4
                                    class="text-[17px] mb-0.5"
                                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                                >
                                    {{ $review['name'] }}
                                </h4>
                                <span class="text-[12px]" style="color: {{ $textColor }}80;">
                                    {{ $review['date'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Google icon --}}
                        <svg class="w-5 h-5 shrink-0 opacity-25" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < ($review['rating'] ?? 5); $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="text-[15px] leading-relaxed mb-5" style="color: {{ $textColor }};">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Service tag: gold dot + text --}}
                    @if(isset($review['service']))
                        <div class="flex items-center gap-2.5 pt-5" style="border-top: 1px solid {{ $headingColor }}06;">
                            <div class="w-1 h-1 rounded-full shrink-0" style="background-color: {{ $primaryColor }};"></div>
                            <span class="text-[12px] font-medium uppercase tracking-[0.1em]" style="color: {{ $primaryColor }};">
                                {{ $review['service'] }}
                            </span>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Gold divider --}}
        <div class="flex items-center justify-center gap-0 mt-14 mb-8">
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Bottom CTA --}}
        <div
            class="text-center"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <a
                href="https://www.google.com/maps"
                target="_blank"
                rel="noopener noreferrer"
                class="group inline-flex items-center gap-3 text-[12px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 hover:gap-4"
                style="color: {{ $primaryColor }};"
            >
                Bekijk alle reviews op Google
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>
    </div>
</section>
