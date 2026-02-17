{{--
    Wave Template: Testimonials Section
    "Coastal Minimal" — rounded review cards on soft background, wave accent, Google rating, staggered reveal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
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

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section id="testimonials" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Wave divider top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="{{ $backgroundColor }}">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {{ $title }}
            </h2>

            {{-- Google rating --}}
            <div
                class="flex flex-wrap items-center justify-center gap-5 mt-8"
                x-data x-intersect.once="$el.style.opacity = 1"
                style="opacity: 0; transition: opacity 0.8s ease 0.3s;"
            >
                <div class="flex items-center gap-2.5">
                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <span
                        class="text-2xl font-bold"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;"
                    >
                        {{ $googleRating }}
                    </span>
                </div>
                <div class="h-6 w-px" style="background-color: {{ $primaryColor }}20;"></div>
                <div class="flex items-center gap-1.5">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    @endfor
                    <span class="text-[13px] ml-1" style="color: {{ $textColor }};">{{ $totalReviews }} reviews</span>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div
                    class="group relative rounded-2xl p-8 lg:p-10 transition-all duration-500 hover:-translate-y-1 hover:shadow-lg"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; box-shadow: 0 1px 3px {{ $secondaryColor }}06; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s;"
                >
                    {{-- Quote accent --}}
                    <span
                        class="absolute top-6 right-8 text-6xl leading-none select-none pointer-events-none"
                        style="color: {{ $primaryColor }}08; font-family: '{{ $headingFont }}', serif;"
                    >
                        &ldquo;
                    </span>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-5">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="text-[15px] leading-[1.75] mb-6 relative" style="color: {{ $headingColor }}e6;">
                        &ldquo;{{ $review['text'] }}&rdquo;
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center justify-between relative">
                        <div class="flex items-center gap-3.5">
                            {{-- Avatar --}}
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }}); color: #ffffff;"
                            >
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-[14px] font-semibold" style="color: {{ $headingColor }};">
                                    {{ $review['name'] }}
                                </h4>
                                <span class="text-[12px]" style="color: {{ $textColor }};">
                                    {{ $review['date'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Service tag --}}
                        @if(isset($review['service']))
                            <span
                                class="text-[11px] font-medium uppercase tracking-[0.1em] px-3 py-1.5 rounded-full"
                                style="color: {{ $primaryColor }}; background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}15;"
                            >
                                {{ $review['service'] }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div
            class="text-center mt-14"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: opacity 0.8s ease 0.3s;"
        >
            <a
                href="https://www.google.com/maps"
                target="_blank"
                rel="noopener noreferrer"
                class="group inline-flex items-center gap-3 px-6 py-3 text-sm font-semibold rounded-full transition-all duration-300 hover:shadow-md hover:-translate-y-0.5"
                style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
            >
                Bekijk alle reviews
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>
        </div>
    </div>
</section>
