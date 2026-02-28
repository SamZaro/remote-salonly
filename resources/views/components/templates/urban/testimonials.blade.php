{{--
    Urban Template: Testimonials Section
    Light section — dark review cards, large quote mark, stars
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title        = $content['title'] ?? 'Wat Klanten Zeggen';
    $subtitle     = $content['subtitle'] ?? 'Beoordeeld met 4.9 sterren op Google';
    $googleRating = $content['google_rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '127';
    $reviews      = $content['reviews'] ?? [
        ['name' => 'Mark de Vries',    'date' => '2 weken geleden',  'rating' => 5, 'text' => 'Eindelijk een barber die begrijpt wat ik wil. De fade is perfect en de sfeer is super relaxed. Kom hier al een jaar en ga nergens anders meer heen.'],
        ['name' => 'Thomas Bakker',    'date' => '1 maand geleden',  'rating' => 5, 'text' => 'Top barbershop! De hot towel shave is echt een ervaring. Ze nemen de tijd en doen hun werk met passie. Aanrader!'],
        ['name' => 'Kevin Jansen',     'date' => '1 maand geleden',  'rating' => 5, 'text' => 'Beste barbershop in de buurt. Altijd vriendelijk, professioneel en het resultaat is elke keer weer top. Prijs-kwaliteit is uitstekend.'],
        ['name' => 'Rick Smits',       'date' => '2 maanden geleden','rating' => 5, 'text' => 'Ga hier nu een half jaar en ben super tevreden. Ze onthouden hoe je het wilt en de baard trim is precies goed. Echte vakmannen!'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';
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
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                        <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Reviews</span>
                    </div>
                    <h2
                        class="font-black uppercase leading-[0.9]"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
                    >
                        {{ $title }}
                    </h2>
                </div>

                {{-- Rating badge --}}
                <div class="flex items-center gap-4 px-6 py-4" style="background-color: {{ $secondaryColor }};">
                    <span class="font-black text-3xl" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';">{{ $googleRating }}</span>
                    <div>
                        <div class="flex items-center gap-0.5 mb-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xs" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">{{ $totalReviews }} reviews · Google</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-4 md:grid-cols-2">
            @foreach($reviews as $review)
                <div
                    class="relative p-8 transition-all duration-300 hover:-translate-y-1"
                    style="background-color: {{ $secondaryColor }}; box-shadow: 0 4px 30px rgba(0,0,0,0.12); opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{-- Large quote mark --}}
                    <div
                        class="absolute top-6 right-8 font-black leading-none select-none pointer-events-none"
                        style="font-family: '{{ $headingFont }}'; font-size: 6rem; color: {{ $primaryColor }}15; line-height: 1;"
                    >
                        "
                    </div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-0.5 mb-6">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Review text --}}
                    <p class="text-base leading-relaxed mb-8" style="color: rgba(255,255,255,0.75); font-family: '{{ $bodyFont }}';">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-4 pt-6 border-t" style="border-color: rgba(255,255,255,0.08);">
                        <div
                            class="w-10 h-10 flex items-center justify-center text-sm font-black shrink-0"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}';"
                        >
                            {{ strtoupper(substr($review['name'], 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-sm uppercase tracking-wide" style="color: #ffffff; font-family: '{{ $bodyFont }}';">
                                {{ $review['name'] }}
                            </h4>
                            <span class="text-xs" style="color: rgba(255,255,255,0.35); font-family: '{{ $bodyFont }}';">{{ $review['date'] }}</span>
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
                class="group inline-flex items-center gap-3 font-bold uppercase tracking-widest text-sm transition-colors"
                style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}';"
            >
                Bekijk alle reviews op Google
                <span class="w-8 h-px transition-all duration-300 group-hover:w-14" style="background-color: {{ $primaryColor }};"></span>
            </a>
        </div>
    </div>
</section>
