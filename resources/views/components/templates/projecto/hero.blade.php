{{--
    Template-specifieke hero voor Projecto (Aannemer)

    Dit component overschrijft de default demo-sections.hero
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Bouw met vertrouwen';
    $subtitle = $content['subtitle'] ?? 'Vakmanschap en kwaliteit voor elk project';
    $ctaText = $content['cta_text'] ?? 'Vraag een offerte aan';
    $ctaLink = $content['cta_link'] ?? '#contact';
    // Get background image from Spatie Media Library or fallback to content
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.7;

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = '#ffffff';
    $buttonRadius = $theme['button_border_radius'] ?? '4px';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    {{-- Achtergrond afbeelding met overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Hero background"
                class="w-full h-full object-cover"
            />
            <div
                class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-transparent"
            ></div>
        </div>
    @else
        {{-- Fallback gradient wanneer geen afbeelding --}}
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
    @endif

    {{-- Geometrische decoratie - bouw/constructie thema --}}
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 800" fill="none">
                <line x1="50" y1="0" x2="50" y2="800" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="150" y1="0" x2="150" y2="800" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="250" y1="0" x2="250" y2="800" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="0" y1="200" x2="400" y2="200" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="0" y1="400" x2="400" y2="400" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="0" y1="600" x2="400" y2="600" stroke="{{ $primaryColor }}" stroke-width="1"/>
            </svg>
        </div>
    </div>

    {{-- Content - links uitgelijnd voor zakelijke uitstraling --}}
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="max-w-3xl">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-sm mb-8 bg-gray-100" style="border-left: 3px solid {{ $primaryColor }};">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="text-sm font-medium uppercase tracking-wider" style="color: {{ $primaryColor }};">Aannemer & Bouwbedrijf</span>
            </div>

            {{-- Titel --}}
            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight"
                style="color: {{ $textColor }};"
            >
                {!! $title !!}
            </h1>

            {{-- Subtitel --}}
            <p
                class="text-lg sm:text-xl md:text-2xl mb-10 max-w-2xl opacity-90 leading-relaxed"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <a
                    href="{{ $ctaLink }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold uppercase tracking-wide border-2 transition-all duration-300 hover:scale-105"
                    style="background-color: {{ $secondaryColor }}; color: {{ $textColor }}; border-color: #f3f4f6; border-radius: {{ $buttonRadius }};"
                >
                    {{ $ctaText }}
                    <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold border-2 transition-all duration-300 hover:bg-white/10"
                    style="border-color: {{ $textColor }}; color: {{ $textColor }}; border-radius: {{ $buttonRadius }};"
                >
                    Bekijk onze projecten
                </a>
            </div>

        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2 animate-bounce">
            <svg class="w-6 h-6 opacity-60" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>
