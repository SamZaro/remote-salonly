{{--
    Level Template: Testimonials Section
    Soft orange-tint background — white cards, orange accents, clean reviewer layout
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title        = $content['title'] ?? 'Wat Klanten Zeggen';
    $subtitle     = $content['subtitle'] ?? 'Beoordeeld met 4.9 sterren';
    $googleRating = $content['google_rating'] ?? '4.9';
    $totalReviews = $content['total_reviews'] ?? '203';
    $reviews      = $content['reviews'] ?? [
        ['name' => 'Lisa van den Berg',  'date' => '2 weken geleden',  'rating' => 5, 'text' => 'Eindelijk een kapper die echt luistert. Ze begreep precies wat ik wilde en het resultaat was nog beter dan verwacht. Ik kom hier zeker vaker!'],
        ['name' => 'Sophie Janssen',    'date' => '1 maand geleden',  'rating' => 5, 'text' => 'Geweldige ervaring van begin tot eind. De sfeer is super fijn en mijn haar ziet er prachtig uit. Echt aanrader!'],
        ['name' => 'Emma de Boer',      'date' => '1 maand geleden',  'rating' => 5, 'text' => 'Beste kapsalon in de buurt! De highlights zijn precies zoals ik het wilde — warm, naturel en zo mooi. Zeker terugkomen.'],
        ['name' => 'Maaike Peters',     'date' => '2 maanden geleden','rating' => 5, 'text' => 'Professioneel team, ontspannen sfeer en top kwaliteit. Ze adviseren je eerlijk over wat bij je past. Ik ben superblij!'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#111111';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
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
                        <div class="w-9 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Reviews</span>
                    </div>
                    <h2
                        class="font-black leading-[0.9]"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.03em; color: #ffffff;"
                    >
                        {{ $title }}
                    </h2>
                </div>

                {{-- Rating badge --}}
                <div class="flex items-center gap-4 px-6 py-4 border" style="border-color: {{ $primaryColor }}; background-color: transparent;">
                    <span class="font-black text-3xl" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';">{{ $googleRating }}</span>
                    <div>
                        <div class="flex items-center gap-0.5 mb-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xs font-light" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">{{ $totalReviews }} reviews · Google</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews grid --}}
        <div class="grid gap-4 md:grid-cols-2">
            @foreach($reviews as $review)
                <div
                    class="relative p-8 border transition-all duration-300"
                    style="background-color: transparent; border-color: rgba(255,255,255,0.1); opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, border-color 0.3s ease;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'"
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
                    <p class="text-base leading-relaxed mb-7 font-light" style="color: rgba(255,255,255,0.7); font-family: '{{ $bodyFont }}';">
                        "{{ $review['text'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-4 pt-5 border-t" style="border-color: rgba(255,255,255,0.1);">
                        <div
                            class="w-9 h-9 flex items-center justify-center text-sm font-bold shrink-0"
                            style="background-color: {{ $primaryColor }}30; color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';"
                        >
                            {{ strtoupper(substr($review['name'], 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm" style="color: #ffffff; font-family: '{{ $bodyFont }}';">
                                {{ $review['name'] }}
                            </h4>
                            <span class="text-xs font-light" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">{{ $review['date'] }}</span>
                        </div>
                    </div>

                    {{-- Orange corner accent --}}
                    <div class="absolute top-0 left-0 w-8 h-1" style="background-color: {{ $primaryColor }};"></div>
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
                style="color: rgba(255,255,255,0.7); font-family: '{{ $bodyFont }}';"
                onmouseover="this.style.color='{{ $primaryColor }}'"
                onmouseout="this.style.color='rgba(255,255,255,0.7)'"
            >
                Bekijk alle reviews op Google
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
