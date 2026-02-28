{{--
    Level Template: Hero Section
    Trendy kapsalon — split-screen, editorial magazine, Syne font, orange accent
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Jouw Haar.<br>Jouw Verhaal.';
    $subtitle = $content['subtitle'] ?? 'Creatief knippen met oog voor detail';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor     = $theme['accent_color'] ?? '#ffedd5';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';
@endphp

{{-- Load Syne + Jost fonts once --}}
@once
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Jost:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap">
@endonce

<section id="hero" class="relative overflow-hidden" style="background-color: {{ $backgroundColor }}; min-height: 100svh;">

    <div class="flex flex-col lg:grid lg:min-h-screen" style="grid-template-columns: 48% 52%;">

        {{-- Left: text panel — clean white --}}
        <div
            class="relative flex flex-col justify-center px-8 sm:px-12 lg:px-16 xl:px-24 py-32 lg:py-0 z-10"
            style="background-color: {{ $backgroundColor }};"
        >
            {{-- Eyebrow --}}
            <div
                class="flex items-center gap-3 mb-10"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
            >
                <div class="w-9 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span
                    class="text-xs font-semibold uppercase tracking-[0.3em]"
                    style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
                >
                    Premium Kapsalon
                </span>
            </div>

            {{-- Main heading --}}
            <h1
                class="font-black leading-[0.9] mb-8"
                style="
                    font-family: '{{ $headingFont }}';
                    font-size: clamp(3rem, 7vw, 6.5rem);
                    letter-spacing: -0.03em;
                    color: {{ $secondaryColor }};
                    opacity: 0;
                    transform: translateY(24px);
                    transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.12s;
                "
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                {!! $title !!}
            </h1>

            {{-- Subtitle --}}
            <p
                class="text-lg mb-12 max-w-sm leading-relaxed"
                style="
                    color: #888888;
                    font-family: '{{ $bodyFont }}';
                    font-weight: 300;
                    opacity: 0;
                    transform: translateY(12px);
                    transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.24s;
                "
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                {{ $subtitle }}
            </p>

            {{-- CTA --}}
            <div
                class="flex flex-wrap items-center gap-4"
                style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.36s;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center gap-3 px-8 py-4 font-semibold uppercase tracking-widest text-sm transition-all duration-300 hover:opacity-90"
                    style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}';"
                >
                    {{ $ctaText }}
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a
                    href="#about"
                    class="text-sm font-medium uppercase tracking-widest transition-colors duration-200"
                    style="color: #aaaaaa; font-family: '{{ $bodyFont }}';"
                    onmouseover="this.style.color='{{ $secondaryColor }}'"
                    onmouseout="this.style.color='#aaaaaa'"
                >
                    Ons verhaal
                </a>
            </div>

            {{-- Thin bottom border line --}}
            <div class="absolute bottom-0 left-0 right-0 h-px lg:hidden" style="background-color: #e8e8e8;"></div>
        </div>

        {{-- Right: full-bleed image --}}
        <div class="relative min-h-[60vh] lg:min-h-screen overflow-hidden order-first lg:order-last">
            @if($backgroundImage)
                <img
                    src="{{ $backgroundImage }}"
                    alt="Level Kapsalon"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                {{-- Subtle bottom-left gradient for mobile readability --}}
                <div class="absolute inset-0 lg:hidden" style="background: linear-gradient(to bottom, transparent 50%, {{ $backgroundColor }});"></div>
            @else
                {{-- Warm charcoal fallback --}}
                <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span
                        class="font-black uppercase leading-none select-none"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(6rem, 20vw, 18rem); color: rgba(255,255,255,0.04); letter-spacing: -0.05em;"
                    >Level</span>
                </div>
            @endif

            {{-- Orange accent strip — top of image --}}
            <div class="absolute top-0 left-0 right-0 h-1" style="background-color: {{ $primaryColor }};"></div>

            {{-- Floating number indicator --}}
            <div class="absolute bottom-8 right-8 text-right">
                <span class="block font-black text-xs uppercase tracking-widest" style="color: rgba(255,255,255,0.3); font-family: '{{ $bodyFont }}';">Kapsalon</span>
                <span class="block font-black leading-none" style="font-family: '{{ $headingFont }}'; font-size: 4rem; color: rgba(255,255,255,0.06);">01</span>
            </div>
        </div>

    </div>

    {{-- Scroll hint — bottom of left panel on desktop --}}
    <div class="hidden lg:flex absolute bottom-8 left-16 xl:left-24 items-center gap-3 z-10">
        <div class="w-px h-10 animate-pulse" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent);"></div>
        <span class="text-xs uppercase tracking-[0.3em]" style="color: #bbbbbb; font-family: '{{ $bodyFont }}';">Scroll</span>
    </div>
</section>
