{{--
    Template-specifieke hero voor Razor (Barbershop)

    Stoere, trendy barbershop stijl met vintage scheermes thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Sharp Looks.<br>Clean Cuts.';
    $subtitle = $content['subtitle'] ?? 'Traditioneel vakmanschap met moderne flair';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.85;

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    // Lichte tekstkleur voor donkere hero achtergrond (consistent patroon)
    $textColor = '#ffffff';
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
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(15,15,15,0.95) 0%, rgba(15,15,15,0.8) 100%);"></div>
        </div>
    @endif

    {{-- Subtiele lijn patronen --}}
    <div class="absolute inset-0 z-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(0deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 1px, transparent 80px);"></div>
    </div>

    {{-- Decoratieve scheermes element links --}}
    <div class="absolute left-8 top-1/2 -translate-y-1/2 hidden xl:block opacity-10">
        <svg class="w-32 h-64" viewBox="0 0 60 120" fill="none" stroke="{{ $primaryColor }}" stroke-width="0.5">
            {{-- Straight razor silhouette --}}
            <rect x="25" y="10" width="10" height="80" rx="2"/>
            <path d="M25 90 Q30 110 35 90" />
            <rect x="20" y="5" width="20" height="10" rx="1"/>
        </svg>
    </div>

    {{-- Decoratieve scheermes element rechts (gespiegeld) --}}
    <div class="absolute right-8 top-1/2 -translate-y-1/2 hidden xl:block opacity-10 rotate-180">
        <svg class="w-32 h-64" viewBox="0 0 60 120" fill="none" stroke="{{ $primaryColor }}" stroke-width="0.5">
            <rect x="25" y="10" width="10" height="80" rx="2"/>
            <path d="M25 90 Q30 110 35 90" />
            <rect x="20" y="5" width="20" height="10" rx="1"/>
        </svg>
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Vintage scheermes icon --}}
        <div class="flex justify-center mb-8">
            <div class="relative">
                <div class="absolute -inset-4 border rotate-45 opacity-30" style="border-color: {{ $primaryColor }};"></div>
                <svg class="w-16 h-16 relative" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
                    {{-- Straight razor icon --}}
                    <path d="M4 4h16v3H4z M7 7v10a3 3 0 0 0 3 3h4a3 3 0 0 0 3-3V7"/>
                    <path d="M9 7v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V7"/>
                </svg>
            </div>
        </div>

        {{-- Badge --}}
        <div class="flex items-center justify-center gap-6 mb-10">
            <div class="h-px w-20" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <span class="text-xs font-bold uppercase tracking-[0.4em]" style="color: {{ $primaryColor }};">
                Premium Barbershop
            </span>
            <div class="h-px w-20" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        {{-- Titel --}}
        <h1
            class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-8 uppercase tracking-tight leading-none"
            style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitel --}}
        <p
            class="text-lg sm:text-xl mb-14 max-w-2xl mx-auto tracking-wide opacity-70"
            style="color: {{ $textColor }};"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="#services"
                class="inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest border-2 transition-all duration-300 hover:bg-white/5"
                style="border-color: {{ $primaryColor }}40; color: {{ $textColor }};"
            >
                Bekijk Diensten
            </a>
        </div>

        {{-- Trust indicators --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-8 mt-16 pt-16 border-t" style="border-color: {{ $primaryColor }}20;">
            <div class="flex items-center gap-2">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                @endfor
                <span class="ml-2 text-sm opacity-70" style="color: {{ $textColor }};">4.9/5 Google</span>
            </div>
            <div class="hidden sm:block w-px h-6 opacity-30" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-sm opacity-70" style="color: {{ $textColor }};">1000+ tevreden klanten</span>
            <div class="hidden sm:block w-px h-6 opacity-30" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-sm opacity-70" style="color: {{ $textColor }};">Est. 2015</span>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-3">
            <span class="text-xs uppercase tracking-widest opacity-50" style="color: {{ $textColor }};">Scroll</span>
            <div class="w-px h-16 animate-pulse" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
