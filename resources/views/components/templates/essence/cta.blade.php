{{--
    Template-specifieke CTA voor Essence (Soft Luxury Salon)

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
    $title = $content['title'] ?? 'Begin Jouw Transformatie';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog een afspraak';
    $description = $content['description'] ?? 'Laat je verwennen door ons team van experts en ontdek de perfecte look die bij jou past.';
    $ctaText = $content['cta_text'] ?? 'Reserveer Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $secondaryCtaText = $content['secondary_cta_text'] ?? 'Neem Contact Op';
    $secondaryCtaLink = $content['secondary_cta_link'] ?? 'tel:+31612345678';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Achtergrond afbeelding met overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="CTA background"
                class="w-full h-full object-cover opacity-20"
            />
        </div>
    @endif

    {{-- Subtiele decoratieve elementen --}}
    <div class="absolute top-0 left-0 w-64 h-64 rounded-full opacity-10 blur-3xl" style="background: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full opacity-10 blur-3xl" style="background: {{ $accentColor }};"></div>

    {{-- Decoratieve lijnen --}}
    <div class="absolute top-16 left-16 w-px h-24 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $backgroundColor }}30, transparent);"></div>
    <div class="absolute bottom-16 right-16 w-px h-24 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $backgroundColor }}30, transparent);"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Badge --}}
        <div class="flex items-center justify-center gap-4 mb-10">
            <div class="w-12 h-px" style="background-color: {{ $primaryColor }}60;"></div>
            <span
                class="text-xs font-medium uppercase tracking-[0.3em]"
                style="color: {{ $primaryColor }};"
            >
                Reserveren
            </span>
            <div class="w-12 h-px" style="background-color: {{ $primaryColor }}60;"></div>
        </div>

        {{-- Titel --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 leading-tight"
            style="color: {{ $backgroundColor }}; font-family: 'Playfair Display', Georgia, serif;"
        >
            {{ $title }}
        </h2>

        {{-- Subtitel --}}
        <p
            class="text-xl mb-4 font-light"
            style="color: {{ $primaryColor }};"
        >
            {{ $subtitle }}
        </p>

        {{-- Description --}}
        <p
            class="text-base mb-12 max-w-2xl mx-auto font-light leading-relaxed"
            style="color: {{ $backgroundColor }}; opacity: 0.8;"
        >
            {{ $description }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest transition-all duration-300 hover:opacity-90"
                style="background-color: {{ $backgroundColor }}; color: {{ $secondaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="{{ $secondaryCtaLink }}"
                class="inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest border transition-all duration-300 hover:bg-white/10"
                style="border-color: {{ $backgroundColor }}40; color: {{ $backgroundColor }};"
            >
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $secondaryCtaText }}
            </a>
        </div>

        {{-- Trust element --}}
        <div class="mt-12 pt-10 border-t" style="border-color: {{ $backgroundColor }}15;">
            <p class="text-sm" style="color: {{ $backgroundColor }}; opacity: 0.6;">
                ✓ Gratis consult &nbsp;&nbsp; ✓ Flexibel omboeken &nbsp;&nbsp; ✓ Persoonlijke aandacht
            </p>
        </div>
    </div>
</section>
