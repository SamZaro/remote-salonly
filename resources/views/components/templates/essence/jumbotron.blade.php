{{--
    Template-specifieke jumbotron voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Ontdek Je Stralende Zelf';
    $subtitle = $content['subtitle'] ?? 'Luxury treatments die jouw natuurlijke schoonheid versterken';
    $ctaText = $content['cta_text'] ?? 'Bekijk Treatments';
    $ctaLink = $content['cta_link'] ?? '#services';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="jumbotron" class="relative py-32 lg:py-40 overflow-hidden" style="background-color: {{ $accentColor }};">
    {{-- Achtergrond afbeelding --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Jumbotron background"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $accentColor }}E6 0%, {{ $primaryColor }}CC 100%);"></div>
        </div>
    @else
        {{-- Gradient achtergrond als geen afbeelding --}}
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $accentColor }} 0%, {{ $primaryColor }}60 100%);"></div>
    @endif

    {{-- Decoratieve elementen --}}
    <div class="absolute top-1/4 left-16 w-32 h-32 border opacity-20 hidden lg:block" style="border-color: {{ $secondaryColor }};"></div>
    <div class="absolute bottom-1/4 right-16 w-48 h-48 border opacity-10 hidden lg:block" style="border-color: {{ $secondaryColor }};"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Decoratieve lijn --}}
        <div class="flex items-center justify-center gap-6 mb-10">
            <div class="w-16 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            <svg class="w-6 h-6" style="color: {{ $secondaryColor }}40;" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            <div class="w-16 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
        </div>

        {{-- Titel --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 leading-tight"
            style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
        >
            {{ $title }}
        </h2>

        {{-- Subtitel --}}
        <p
            class="text-lg sm:text-xl mb-12 max-w-2xl mx-auto font-light leading-relaxed"
            style="color: {{ $secondaryColor }}; opacity: 0.8;"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA --}}
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest transition-all duration-300 hover:shadow-lg"
            style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
        >
            {{ $ctaText }}
            <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>
    </div>
</section>
