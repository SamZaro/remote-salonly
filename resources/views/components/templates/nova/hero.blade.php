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
    $title = $content['title'] ?? 'Welkom bij ons bedrijf';
    $subtitle = $content['subtitle'] ?? 'Wij helpen u met professionele dienstverlening';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
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
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
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

    {{-- Decoratieve elementen - schaar/kam patroon --}}
    <div class="absolute inset-0 z-0 opacity-5">
        <div class="absolute top-20 left-10 w-32 h-32 border-2 border-white rounded-full"></div>
        <div class="absolute top-40 right-20 w-24 h-24 border border-white rounded-full"></div>
        <div class="absolute bottom-32 left-1/4 w-16 h-16 border border-white rounded-full"></div>
    </div>

    {{-- Content - centered en elegant --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Decoratieve lijn boven --}}
        <div class="flex items-center justify-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Titel met elegante typografie (gebruikt heading font via CSS) --}}
        <h1
            class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-6"
            style="color: {{ $textColor }}; font-family: var(--font-family-heading); opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitel (ook heading font voor consistentie) --}}
        <p
            class="text-3xl sm:text-4xl md:text-5xl mb-12 max-w-4xl mx-auto font-extrabold"
            style="color: {{ $primaryColor }}; font-family: var(--font-family-heading); opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
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
                Onze diensten
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
