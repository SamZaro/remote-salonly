{{--
    Blush Template: Testimonials Section
    Elegant nail studio — client reviews on dark background with gold accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? __('What Customers Say');
    $subtitle = $content['subtitle'] ?? __('Experiences');
    $googleRating = $content['google_rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '120';
    $reviews = $content['reviews'] ?? [
        [
            'name' => 'Emma de Vries',
            'date' => __('2 weeks ago'),
            'rating' => 5,
            'text' => __('Absolutely love my nails! The attention to detail is incredible. Best nail studio in town.'),
        ],
        [
            'name' => 'Lisa Jansen',
            'date' => __('1 month ago'),
            'rating' => 5,
            'text' => __('Such a relaxing experience. The gel manicure lasted over three weeks without a single chip.'),
        ],
        [
            'name' => 'Sophie Bakker',
            'date' => __('1 month ago'),
            'rating' => 5,
            'text' => __('Beautiful nail art designs. They really listen to what you want and deliver perfection.'),
        ],
        [
            'name' => 'Anna Visser',
            'date' => __('2 months ago'),
            'rating' => 5,
            'text' => __('The hygiene standards are top notch and the results are always flawless. Highly recommended!'),
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section id="testimonials" class="py-20 lg:py-32" style="background-color: {{ $secondaryColor }}; font-family: {{ $bodyFont }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                </svg>
                <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <span class="text-xs font-medium uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-light mb-8" style="color: {{ $backgroundColor }}; font-family: {{ $headingFont }};">
                {{ $title }}
            </h2>

            {{-- Google rating badge --}}
            <div class="inline-flex items-center gap-4 px-6 py-3" style="background-color: {{ $primaryColor }}10; border: 1px solid {{ $primaryColor }}20;">
                <svg class="w-6 h-6" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-bold" style="color: {{ $backgroundColor }};">{{ $googleRating }}</span>
                    <div class="flex items-center gap-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>
                </div>
                <span class="text-sm opacity-50" style="color: {{ $backgroundColor }};">{{ $totalReviews }} reviews</span>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div
                    class="p-8 lg:p-10 transition-all duration-500 hover:-translate-y-1"
                    style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}12; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-5">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-11 h-11 flex items-center justify-center text-sm font-medium"
                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                            >
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-medium text-sm" style="color: {{ $backgroundColor }};">
                                    {{ $review['name'] }}
                                </h4>
                            </div>
                        </div>
                        <svg class="w-5 h-5 opacity-20" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-1 mb-5">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                        @for($i = $review['rating']; $i < 5; $i++)
                            <svg class="w-4 h-4 opacity-20" style="color: {{ $backgroundColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="leading-relaxed text-sm italic" style="color: {{ $textColor }};">
                        "{{ $review['text'] }}"
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
