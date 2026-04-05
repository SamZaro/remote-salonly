{{--
    Blush Template: Hero Section
    Elegant Nail Studio — luxurious gold on dark, feminine & refined
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Welcome to our studio');
    $subtitle = $content['subtitle'] ?? __('Where nails become art');
    $ctaText = $content['cta_text'] ?? __('Book a Treatment');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.7;

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Hero background"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/70"></div>
        </div>
    @endif

    {{-- Decorative corner accents --}}
    <div class="absolute top-8 left-8 w-24 h-24 border-t border-l opacity-20 z-10" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-8 right-8 w-24 h-24 border-b border-r opacity-20 z-10" style="border-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-20 w-full text-center">
        {{-- Decorative sparkle icon --}}
        <div class="flex items-center justify-center gap-4 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/>
            </svg>
            <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        {{-- Title --}}
        <h1
            class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-light mb-6 tracking-tight"
            style="color: {{ $textColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitle --}}
        <p
            class="text-lg sm:text-xl md:text-2xl mb-14 max-w-2xl mx-auto font-light tracking-wide"
            style="color: {{ $primaryColor }}; font-family: {{ $bodyFont }}; opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.5s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium transition-all duration-500 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: {{ $bodyFont }};"
            >
                {{ $ctaText }}
            </a>
            <a
                href="#services"
                class="inline-flex items-center justify-center px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium border transition-all duration-500 hover:bg-white/5"
                style="border-color: {{ $primaryColor }}60; color: {{ $primaryColor }}; font-family: {{ $bodyFont }};"
            >
                {{ __('Our services') }}
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2 animate-bounce">
            <span class="text-xs uppercase tracking-[0.3em] opacity-40" style="color: {{ $primaryColor }}; font-family: {{ $bodyFont }};">Scroll</span>
            <svg class="w-4 h-4 opacity-40" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>
