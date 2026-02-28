{{--
    Template-specifieke hero voor Barbero (Barbershop)

    Stoere, masculine barbershop stijl met vintage vibes
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Classic Cuts.<br>Modern Style.';
    $subtitle = $content['subtitle'] ?? 'Waar traditie en vakmanschap samenkomen';
    $ctaText = $content['cta_text'] ?? 'Boek een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    // Get background image from Spatie Media Library or fallback to content
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.8;
    // Background position: top, center, bottom
    $bgPosition = $content['background_position'] ?? 'center';
    $objectPositionClass = match($bgPosition) {
        'top' => 'object-top',
        'bottom' => 'object-bottom',
        default => 'object-center',
    };

    // Theme kleuren met defaults - donker/goud voor barbershop
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = '#ffffff';
    $buttonRadius = $theme['button_border_radius'] ?? '0px';
    $headingFont = $theme['heading_font_family'] ?? 'Oswald';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    {{-- Achtergrond afbeelding met donkere overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Hero background"
                class="w-full h-full object-cover {{ $objectPositionClass }}"
            />
            <div class="absolute inset-0 bg-gray-900/60"></div>
        </div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Vintage badge/emblem --}}
        <div
            class="flex items-center justify-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="px-4 py-2 border-2 text-xs font-bold uppercase tracking-[0.3em]" style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }};">
                Est. 2024
            </div>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Schaar icon --}}
        <div
            class="flex justify-center mb-6"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
        >
            <svg class="w-12 h-12" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
        </div>

        {{-- Titel met vintage serif font --}}
        <h1
            class="text-4xl sm:text-3xl md:text-5xl lg:text-7xl font-bold mb-6 uppercase tracking-wider"
            style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitel --}}
        <p
            class="text-lg sm:text-xl mb-12 max-w-xl mx-auto uppercase tracking-[0.2em] opacity-80"
            style="color: {{ $textColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Button --}}
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105 border-2"
            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-color: {{ $primaryColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.6s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $ctaText }}
        </a>

        {{-- Social proof --}}
        <div class="flex items-center justify-center gap-1 mt-12">
            @for($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            @endfor
            <span class="ml-3 text-sm uppercase tracking-wider opacity-70" style="color: {{ $textColor }};">500+ Reviews</span>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2 animate-bounce">
            <div class="w-px h-12" style="background: linear-gradient(to bottom, transparent, {{ $primaryColor }});"></div>
        </div>
    </div>
</section>
