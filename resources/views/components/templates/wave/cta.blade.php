{{--
    Template-specifieke CTA sectie voor Wave (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Klaar voor een nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Ontdek wat wij voor jou kunnen betekenen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings
@endphp

<section class="relative py-32 lg:py-40 overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Background"
                class="w-full h-full object-cover opacity-20 grayscale"
            />
        </div>
    @endif

    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 w-64 h-64 border-l border-t opacity-20" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 border-r border-b opacity-20" style="border-color: {{ $primaryColor }};"></div>

    {{-- Gold corner accents --}}
    <div
        class="absolute top-0 left-0 w-32 h-32"
        style="background: linear-gradient(135deg, {{ $primaryColor }}20 50%, transparent 50%);"
    ></div>
    <div
        class="absolute bottom-0 right-0 w-32 h-32"
        style="background: linear-gradient(-45deg, {{ $primaryColor }}20 50%, transparent 50%);"
    ></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Decorative line --}}
        <div class="flex items-center justify-center gap-4 mb-12">
            <div class="h-px w-24" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-3 h-3 rotate-45 border" style="border-color: {{ $primaryColor }};"></div>
            <div class="h-px w-24" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-light mb-8 text-white leading-tight"
            style="font-family: 'Playfair Display', Georgia, serif;"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p class="text-lg sm:text-xl mb-16 max-w-2xl mx-auto text-white/60">
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-12 py-5 text-sm font-medium uppercase tracking-widest transition-all duration-500"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                onmouseover="this.style.backgroundColor='#ffffff';"
                onmouseout="this.style.backgroundColor='{{ $primaryColor }}';"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-12 py-5 text-sm font-medium uppercase tracking-widest border text-white transition-all duration-300"
                    style="border-color: {{ $primaryColor }}40;"
                    onmouseover="this.style.borderColor='{{ $primaryColor }}'; this.style.color='{{ $primaryColor }}';"
                    onmouseout="this.style.borderColor='{{ $primaryColor }}40'; this.style.color='#ffffff';"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-12 py-5 text-sm font-medium uppercase tracking-widest border text-white transition-all duration-300"
                    style="border-color: {{ $primaryColor }}40;"
                    onmouseover="this.style.borderColor='{{ $primaryColor }}'; this.style.color='{{ $primaryColor }}';"
                    onmouseout="this.style.borderColor='{{ $primaryColor }}40'; this.style.color='#ffffff';"
                >
                    Ontdek diensten
                </a>
            @endif
        </div>

        {{-- Trust indicators --}}
        <div class="flex flex-wrap items-center justify-center gap-8 mt-20 pt-12 border-t" style="border-color: {{ $primaryColor }}20;">
            <div class="flex items-center gap-3 text-white/50">
                <div class="w-10 h-10 flex items-center justify-center border" style="border-color: {{ $primaryColor }}40;">
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm uppercase tracking-wider">Gratis consult</span>
            </div>
            <div class="flex items-center gap-3 text-white/50">
                <div class="w-10 h-10 flex items-center justify-center border" style="border-color: {{ $primaryColor }}40;">
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm uppercase tracking-wider">Premium producten</span>
            </div>
            <div class="flex items-center gap-3 text-white/50">
                <div class="w-10 h-10 flex items-center justify-center border" style="border-color: {{ $primaryColor }}40;">
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm uppercase tracking-wider">100% Tevredenheid</span>
            </div>
        </div>
    </div>
</section>
