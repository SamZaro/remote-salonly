{{--
    Template-specifieke testimonials voor Icon (Hair Salon)

    Google reviews met 5 sterren
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
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

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8fafc';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Reviews
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>

            {{-- Google rating badge --}}
            <div
                class="inline-flex items-center gap-4 px-6 py-3 rounded-2xl bg-white"
                style="box-shadow: 0 4px 20px rgba(0,0,0,0.08);"
            >
                {{-- Google logo --}}
                <svg class="w-8 h-8" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <div class="flex items-center gap-3">
                    <span class="text-3xl font-bold" style="color: {{ $textColor }};">{{ $googleRating }}</span>
                    <div>
                        <div class="flex items-center gap-0.5">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">{{ $totalReviews }} reviews</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div
                    class="bg-white p-8 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                    style="box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
                >
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <div
                                class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold text-white"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                            >
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-semibold" style="color: {{ $textColor }};">
                                    {{ $review['name'] }}
                                </h4>
                                <span class="text-sm text-gray-500">
                                    {{ $review['date'] }}
                                </span>
                            </div>
                        </div>
                        {{-- Google icon --}}
                        <svg class="w-6 h-6 opacity-30" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="text-gray-600 leading-relaxed mb-4">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Service tag --}}
                    @if(isset($review['service']))
                        <span
                            class="inline-flex items-center gap-1 text-xs font-medium px-3 py-1 rounded-full"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10); color: {{ $primaryColor }};"
                        >
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
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
                href="https://www.google.com/maps"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg"
                style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10); color: {{ $primaryColor }};"
            >
                Bekijk alle reviews op Google
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>
    </div>
</section>
