{{--
    King Template: Testimonials Section
    "Royal Throne" — light bg, review cards, Google rating badge, diamond accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('What Our Kings Say');
    $subtitle = $content['subtitle'] ?? __('Real reviews from our loyal clients');
    $googleRating = $content['google_rating'] ?? '4.9';
    $googleReviewCount = $content['google_review_count'] ?? '200+';
    $reviews = $content['reviews'] ?? [
        ['name' => 'Marcus V.', 'rating' => 5, 'text' => __('Best barbershop in town. The attention to detail is unmatched. I always leave feeling like a king.'), 'service' => __('King Package')],
        ['name' => 'David R.', 'rating' => 5, 'text' => __('Clean fades, great vibes, and the hot towel shave is an experience. Highly recommended!'), 'service' => __('Fade + Shave')],
        ['name' => 'James K.', 'rating' => 5, 'text' => __('Professional barbers who actually listen to what you want. Been coming here for years.'), 'service' => __('Classic Cut')],
        ['name' => 'Ahmed B.', 'rating' => 5, 'text' => __('The Royal VIP package is worth every penny. Premium service from start to finish.'), 'service' => __('Royal VIP')],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<section id="testimonials" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ __('Reviews') }}
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed mb-8" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>

            {{-- Google rating badge --}}
            <div class="inline-flex items-center gap-3 px-5 py-2.5" style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $secondaryColor }};">
                <span class="text-[13px] font-bold" style="color: {{ $backgroundColor }};">
                    <span style="color: #4285F4;">G</span><span style="color: #EA4335;">o</span><span style="color: #FBBC05;">o</span><span style="color: #4285F4;">g</span><span style="color: #34A853;">l</span><span style="color: #EA4335;">e</span>
                </span>
                <div class="flex gap-0.5">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-3.5 h-3.5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-[13px] font-bold" style="color: {{ $primaryColor }};">{{ $googleRating }}</span>
                <span class="text-[11px]" style="color: {{ $backgroundColor }}40;">({{ $googleReviewCount }})</span>
            </div>
        </div>

        {{-- Review cards --}}
        <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
            @foreach($reviews as $index => $review)
                <div
                    class="group relative p-8 transition-all duration-500 hover:shadow-lg"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Gold top accent --}}
                    <div
                        class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    <div class="flex items-start gap-4">
                        {{-- Avatar initial --}}
                        <div
                            class="w-11 h-11 shrink-0 flex items-center justify-center text-[14px] font-bold"
                            style="background-color: {{ $secondaryColor }}; color: {{ $primaryColor }};"
                        >
                            {{ mb_strtoupper(mb_substr($review['name'] ?? 'A', 0, 1)) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            {{-- Name and stars --}}
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <h4 class="text-[14px] font-bold" style="color: {{ $headingColor }};">
                                    {{ $review['name'] }}
                                </h4>
                                <div class="flex gap-0.5 shrink-0">
                                    @for($i = 0; $i < ($review['rating'] ?? 5); $i++)
                                        <svg class="w-3 h-3" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            {{-- Service tag --}}
                            @if(!empty($review['service']))
                                <span
                                    class="inline-block text-[10px] uppercase tracking-[0.1em] font-semibold px-2 py-0.5 mb-3"
                                    style="color: {{ $primaryColor }}; background-color: {{ $primaryColor }}08;"
                                >
                                    {{ $review['service'] }}
                                </span>
                            @endif

                            {{-- Review text --}}
                            <p class="text-[14px] leading-[1.7]" style="color: {{ $textColor }};">
                                "{{ $review['text'] }}"
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
