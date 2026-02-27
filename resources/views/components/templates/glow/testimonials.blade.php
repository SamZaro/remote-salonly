{{--
    Glow Template: Testimonials Section
    Warm minimalist — clean review cards, no decorative corners or gradient avatars
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Wat Klanten Zeggen';
    $subtitle = $content['subtitle'] ?? 'Ervaringen van onze bezoekers';
    $rating = $content['rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '312';
    $reviews = $content['reviews'] ?? [
        ['name' => 'Sophie van Dijk', 'date' => '1 week geleden', 'rating' => 5, 'text' => 'Absoluut de beste salon waar ik ooit ben geweest! Mijn balayage is precies wat ik wilde. Het team is professioneel en vriendelijk.', 'service' => 'Balayage'],
        ['name' => 'Emma Bakker', 'date' => '2 weken geleden', 'rating' => 5, 'text' => 'Heerlijk ontspannen tijdens mijn behandeling. De manicure is perfect en de sfeer in de salon is geweldig.', 'service' => 'Manicure Deluxe'],
        ['name' => 'Lisa de Groot', 'date' => '3 weken geleden', 'rating' => 5, 'text' => 'Mijn wimperextensions zijn prachtig! Ze luisteren echt naar wat je wilt en het resultaat overtreft mijn verwachtingen.', 'service' => 'Wimperextensions'],
        ['name' => 'Anna Visser', 'date' => '1 maand geleden', 'rating' => 5, 'text' => 'De brow lamination heeft mijn ochtend routine zo veel makkelijker gemaakt. Super blij met het resultaat!', 'service' => 'Brow Lamination'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block" style="color: {{ $secondaryColor }};">
                Reviews
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold mb-4" style="color: {{ $headingColor }}; font-family: 'Raleway', sans-serif;">
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl font-bold" style="color: {{ $headingColor }};">{{ $rating }}</span>
                <div class="flex items-center gap-0.5">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4" style="color: {{ $secondaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-sm" style="color: {{ $textColor }};">{{ $totalReviews }} reviews</span>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($reviews as $index => $review)
                <div
                    class="p-8"
                    style="background-color: white; border-radius: 12px;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(16px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                >
                    {{-- Stars --}}
                    <div class="flex items-center gap-0.5 mb-4">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4" style="color: {{ $secondaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="text-lg leading-relaxed mb-5" style="color: {{ $textColor }};">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-sm font-bold block" style="color: {{ $headingColor }};">{{ $review['name'] }}</span>
                            <span class="text-xs" style="color: {{ $textColor }};">{{ $review['date'] }}</span>
                        </div>
                        @if(isset($review['service']))
                            <span
                                class="text-xs font-medium px-3 py-1"
                                style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }}; border-radius: 4px;"
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
