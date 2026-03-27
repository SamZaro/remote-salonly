{{--
    Template-specifieke hero voor Nova (Kapsalon)

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
    $title = $content['title'] ?? __('Welcome to our company');
    $subtitle = $content['subtitle'] ?? __('We help you with professional services');
    $ctaText = $content['cta_text'] ?? __('Make an appointment');
    $ctaLink = $content['cta_link'] ?? '#contact';
    // Get background image from Spatie Media Library or fallback to content
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.7;

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = '#ffffff';  // Hero altijd wit op donkere achtergrond
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings (niet gebruikt in hero)
    $buttonRadius = $theme['button_border_radius'] ?? '0px';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-start overflow-hidden"
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
                class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/50 to-black/80"
            ></div>
        </div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 w-full">
        {{-- Decoratieve lijn boven --}}
        <div class="flex items-center justify-start gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-20 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Titel met elegante typografie (gebruikt heading font via CSS) --}}
        <h1
            class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-6"
            style="color: {{ $textColor }}; font-family: var(--font-family-heading); opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitel (ook heading font voor consistentie) --}}
        <p
            class="text-4xl sm:text-5xl md:text-6xl mb-12 max-w-4xl font-extrabold"
            style="color: transparent; -webkit-text-stroke: 2px {{ $primaryColor }}; font-family: var(--font-family-heading); opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-start justify-start gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-8 py-4 text-lg rounded-sm font-medium transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: #ffffff;"
            >
                {{ $ctaText }}
            </a>
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-lg rounded-sm font-medium border-2 transition-all duration-300 hover:bg-white/10"
                style="border-color: {{ $textColor }}; color: {{ $textColor }};"
            >
                {{ __('Our services') }}
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2 animate-bounce">
            <span class="text-xs uppercase tracking-widest opacity-60" style="color: {{ $textColor }};">Scroll</span>
            <svg class="w-5 h-5 opacity-60" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>
