{{--
    Template-specifieke jumbotron voor Coupe (Kapsalon)

    Elegante kapsalon stijl met warme bruintinten
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Jouw stijl, onze passie';
    $subtitle = $content['subtitle'] ?? 'Laat je inspireren en boek je volgende afspraak';
    $ctaText = $content['cta_text'] ?? 'Maak een Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = '#ffffff';  // Jumbotron altijd wit op donkere achtergrond
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings (niet gebruikt in jumbotron)
@endphp

<section id="jumbotron" class="relative py-24 lg:py-36 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/50 to-black/70"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Top decorative --}}
        <div class="flex items-center justify-center gap-4 mb-10">
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light tracking-wide mb-8 text-white"
            style="font-family: 'Playfair Display', serif;"
        >
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-xl mb-12 text-white/80 max-w-2xl mx-auto font-light tracking-wide">
                {{ $subtitle }}
            </p>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center gap-3 px-10 py-4 text-lg font-medium transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="#services"
                class="inline-flex items-center gap-2 px-8 py-4 text-lg font-medium border transition-all duration-300 hover:bg-white/10 text-white"
                style="border-color: {{ $primaryColor }}40;"
            >
                Bekijk diensten
            </a>
        </div>

        {{-- Bottom decorative --}}
        <div class="mt-16">
            <div class="h-px w-48 mx-auto" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
