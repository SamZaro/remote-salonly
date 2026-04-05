{{--
    Fade Template: Testimonials Section
    Warm cream background — review cards with gold accents
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title        = $content['title'] ?? __('What Customers Say');
    $subtitle     = $content['subtitle'] ?? __('Experiences');
    $googleRating = $content['google_rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '187';
    $reviews      = $content['reviews'] ?? [
        ['name' => 'Thomas van Dijk',   'date' => __('2 weeks ago'),   'rating' => 5, 'text' => __('Best barbershop in town! The fade was absolutely perfect and the atmosphere is great. Already booked my next appointment.')],
        ['name' => 'Jayden de Groot',   'date' => __('1 month ago'),   'rating' => 5, 'text' => __('Always leave looking sharp. The barbers here really know their craft. Top service every single time.')],
        ['name' => 'Noah Bakker',       'date' => __('1 month ago'),   'rating' => 5, 'text' => __('The hot towel shave was an incredible experience. Professional, relaxing and the result was flawless.')],
        ['name' => 'Daan Smit',         'date' => __('2 months ago'),  'rating' => 5, 'text' => __('Found my go-to barbershop. Great vibes, skilled barbers and always consistent quality. Highly recommended!')],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Reviews</span>
                    </div>
                    <h2
                        class="font-bold uppercase leading-[0.85]"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(2.4rem, 4.5vw, 4rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
                    >
                        {{ $title }}
                    </h2>
                </div>

                {{-- Rating badge --}}
                <div class="flex items-center gap-4 px-6 py-4 border" style="border-color: {{ $primaryColor }}; background-color: #ffffff;">
                    <span class="font-bold text-3xl" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';">{{ $googleRating }}</span>
                    <div>
                        <div class="flex items-center gap-0.5 mb-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xs font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">{{ $totalReviews }} reviews · Google</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-4 md:grid-cols-2">
            @foreach($reviews as $review)
                <div
                    class="relative p-8 bg-white border-l-2 transition-all duration-300"
                    style="border-left-color: transparent; box-shadow: 0 1px 3px rgba(0,0,0,0.04); opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, border-color 0.3s ease, box-shadow 0.3s ease;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    onmouseover="this.style.borderLeftColor='{{ $primaryColor }}'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'"
                    onmouseout="this.style.borderLeftColor='transparent'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)'"
                >
                    {{-- Stars --}}
                    <div class="flex items-center gap-0.5 mb-5">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="text-base leading-relaxed mb-7 font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-4 pt-5 border-t" style="border-color: {{ $primaryColor }}15;">
                        <div
                            class="w-9 h-9 flex items-center justify-center text-sm font-bold shrink-0"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}';"
                        >
                            {{ strtoupper(substr($review['name'], 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm" style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}';">
                                {{ $review['name'] }}
                            </h4>
                            <span class="text-xs font-light" style="color: #aaaaaa; font-family: '{{ $bodyFont }}';">{{ $review['date'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Google link --}}
        <div class="mt-10">
            <a
                href="https://www.google.com/maps"
                target="_blank"
                rel="noopener noreferrer"
                class="group inline-flex items-center gap-3 font-semibold uppercase tracking-widest text-sm transition-colors"
                style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';"
                onmouseover="this.style.color='{{ $primaryColor }}'"
                onmouseout="this.style.color='{{ $textColor }}'"
            >
                {{ __('View all reviews on Google') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
