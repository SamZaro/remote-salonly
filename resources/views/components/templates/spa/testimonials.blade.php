{{--
    Spa Template: Testimonials Section
    Serene spa & wellness — elegant review cards with star ratings
    Fonts: Lustria (headings) + Lato (body)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'What Our Clients Say';
    $subtitle = $content['subtitle'] ?? 'Ervaringen van onze bezoekers';
    $rating = $content['rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '312';
    $reviews = $content['reviews'] ?? [
        ['name' => 'Sophie van Dijk', 'date' => '1 week geleden', 'rating' => 5, 'text' => 'Absoluut de beste salon waar ik ooit ben geweest! De massage was hemels en de sfeer is ongelooflijk ontspannend. Ik kom zeker terug.', 'service' => 'Relaxing Massage'],
        ['name' => 'Emma Bakker', 'date' => '2 weken geleden', 'rating' => 5, 'text' => 'Heerlijk ontspannen tijdens mijn gezichtsbehandeling. De producten zijn luxe en het resultaat is fantastisch. Aanrader!', 'service' => 'Supreme Skincare'],
        ['name' => 'Lisa de Groot', 'date' => '3 weken geleden', 'rating' => 5, 'text' => 'De hot stone massage was precies wat ik nodig had. Professioneel team en prachtige ambiance. Vijf sterren!', 'service' => 'Hot Stone Massage'],
        ['name' => 'Anna Visser', 'date' => '1 maand geleden', 'rating' => 5, 'text' => 'De aromatherapy facial is een ware verwennerij. Mijn huid voelt zo zacht en stralend. Ik ben verslaafd!', 'service' => 'Aromatherapy Facial'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span
                class="absolute top-[-20px] left-1/2 -translate-x-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.05; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >Testimonials</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                Reviews
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl font-bold" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">{{ $rating }}</span>
                <div class="flex items-center gap-0.5">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ $totalReviews }} reviews</span>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div
                    class="p-8 rounded-lg"
                    style="background-color: #ffffff;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                >
                    {{-- Stars --}}
                    <div class="flex items-center gap-0.5 mb-5">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote icon --}}
                    <svg class="w-8 h-8 mb-4" style="color: {{ $primaryColor }}40;" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>

                    {{-- Review text --}}
                    <p class="text-lg leading-relaxed mb-6 italic" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-sm font-bold block" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">{{ $review['name'] }}</span>
                            <span class="text-xs" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ $review['date'] }}</span>
                        </div>
                        @if(isset($review['service']))
                            <span
                                class="text-xs font-medium px-3 py-1 rounded"
                                style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                            >
                                {{ $review['service'] }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
