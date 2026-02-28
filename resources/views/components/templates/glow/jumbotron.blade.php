{{--
    Glow Template: Jumbotron Section
    Warm minimalist — clean full-width banner, no decorative icons or trust badges
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Verwennerij begint hier';
    $subtitle = $content['subtitle'] ?? 'Boek uw behandeling en ontdek pure ontspanning';
    $ctaText = $content['cta_text'] ?? 'Afspraak Maken';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-32 overflow-hidden">
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background-color: {{ $secondaryColor }}dd;"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', sans-serif;"
        >
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-xl mb-10 max-w-xl mx-auto" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </p>
        @endif

        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center px-8 py-4 text-sm font-semibold tracking-wide uppercase transition-opacity hover:opacity-90"
            style="background-color: {{ $backgroundColor }}; color: {{ $secondaryColor }}; border-radius: 6px;"
        >
            {{ $ctaText }}
            <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
