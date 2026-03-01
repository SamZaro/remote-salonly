{{--
    Pure Template: Testimonials Section
    Natural & Botanical — review cards with star ratings and transparent watermark
    Fonts: Lustria (headings) + Roboto (body)
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
    $totalReviews = $content['total_reviews'] ?? '150';
    $reviews = $content['reviews'] ?? [
        ['name' => 'Anna de Jong', 'date' => '1 week geleden', 'rating' => 5, 'text' => 'Eindelijk een salon die écht natuurlijk werkt. Mijn haar is gezonder dan ooit en de sfeer is zo rustgevend.', 'service' => 'Organic Cut'],
        ['name' => 'Marloes Bakker', 'date' => '2 weken geleden', 'rating' => 5, 'text' => 'De plantaardige kleuring is geweldig! Geen chemische geuren, prachtig resultaat en mijn haar voelt zo zacht.', 'service' => 'Plant-Based Color'],
        ['name' => 'Sanne van Dijk', 'date' => '3 weken geleden', 'rating' => 5, 'text' => 'Meer dan een kapper - het is een wellness ervaring. De hoofdhuidmassage is echt een moment van rust.', 'service' => 'Scalp Wellness'],
        ['name' => 'Lisa Vermeer', 'date' => '1 maand geleden', 'rating' => 5, 'text' => 'De kruidenbehandeling heeft mijn haar getransformeerd. Nooit meer terug naar chemische producten!', 'service' => 'Herbal Treatment'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="testimonials" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Botanical leaf decoration --}}
    <div class="absolute top-16 left-8 opacity-[0.04]">
        <svg class="w-28 h-28" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
        </svg>
    </div>
    <div class="absolute bottom-12 right-12 opacity-[0.03]">
        <svg class="w-20 h-20" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
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
                    class="p-8 rounded-sm"
                    style="background-color: #ffffff;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s;'"
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
                                class="text-xs font-medium px-3 py-1 rounded-xl"
                                style="background-color: {{ $accentColor }}30; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
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
