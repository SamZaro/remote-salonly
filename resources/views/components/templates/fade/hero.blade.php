{{--
    Fade Template: Hero Section
    Creative barbershop — split-screen, diagonal energy, gold luxury accent
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Sharp Cuts.<br>Bold Style.');
    $subtitle = $content['subtitle'] ?? __('Where precision meets creativity');
    $ctaText = $content['cta_text'] ?? __('Book Now');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor     = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

@once
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap">
@endonce

<section id="hero" class="relative overflow-hidden" style="background-color: {{ $secondaryColor }}; min-height: 100svh;">

    <div class="flex flex-col lg:grid lg:min-h-screen" style="grid-template-columns: 52% 48%;">

        {{-- Left: full-bleed image --}}
        <div class="relative min-h-[60vh] lg:min-h-screen overflow-hidden order-first">
            @if($backgroundImage)
                <img
                    src="{{ $backgroundImage }}"
                    alt="Fade Barbershop"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(15,15,15,0.3) 0%, rgba(15,15,15,0.6) 100%);"></div>
                <div class="absolute inset-0 lg:hidden" style="background: linear-gradient(to bottom, transparent 40%, {{ $secondaryColor }});"></div>
            @else
                <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <span
                        class="font-bold uppercase leading-none select-none"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(8rem, 25vw, 22rem); color: rgba(200,184,138,0.04); letter-spacing: -0.05em;"
                    >FADE</span>
                </div>
            @endif

            {{-- Diagonal gold accent strip --}}
            <div class="absolute bottom-0 right-0 w-2 h-32 lg:h-48" style="background-color: {{ $primaryColor }};"></div>

            {{-- Floating slide number --}}
            <div class="absolute top-8 left-8 lg:top-12 lg:left-12 z-10">
                <span class="block font-bold leading-none" style="font-family: '{{ $headingFont }}'; font-size: 5rem; color: rgba(200,184,138,0.12);">01</span>
            </div>
        </div>

        {{-- Right: text panel — dark --}}
        <div
            class="relative flex flex-col justify-center px-8 sm:px-12 lg:px-16 xl:px-20 py-24 lg:py-0 z-10"
            style="background-color: {{ $secondaryColor }};"
        >
            {{-- Vertical gold accent line --}}
            <div class="absolute top-0 left-0 w-1 h-full hidden lg:block" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent 70%);"></div>

            {{-- Eyebrow --}}
            <div
                class="flex items-center gap-3 mb-10"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
            >
                <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span
                    class="text-xs font-semibold uppercase tracking-[0.35em]"
                    style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
                >
                    {{ __('Premium Barbershop') }}
                </span>
            </div>

            {{-- Main heading --}}
            <h1
                class="font-bold uppercase leading-[0.85] mb-8"
                style="
                    font-family: '{{ $headingFont }}';
                    font-size: clamp(3.2rem, 7vw, 6rem);
                    letter-spacing: -0.02em;
                    color: #ffffff;
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
                class="text-lg mb-12 max-w-md leading-relaxed"
                style="
                    color: rgba(255,255,255,0.45);
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
                class="flex flex-wrap items-center gap-5"
                style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.36s;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center gap-3 px-8 py-4 font-semibold uppercase tracking-widest text-sm transition-all duration-300 hover:opacity-90"
                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                >
                    {{ $ctaText }}
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a
                    href="#about"
                    class="text-sm font-medium uppercase tracking-widest transition-colors duration-200"
                    style="color: rgba(255,255,255,0.35); font-family: '{{ $bodyFont }}';"
                    onmouseover="this.style.color='{{ $primaryColor }}'"
                    onmouseout="this.style.color='rgba(255,255,255,0.35)'"
                >
                    {{ __('Our story') }}
                </a>
            </div>

            {{-- Bottom scroll hint --}}
            <div class="hidden lg:flex absolute bottom-10 right-16 xl:right-20 items-center gap-3">
                <span class="text-xs uppercase tracking-[0.3em]" style="color: rgba(255,255,255,0.2); font-family: '{{ $bodyFont }}';">Scroll</span>
                <div class="h-10 w-px animate-pulse" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent);"></div>
            </div>
        </div>
    </div>

    {{-- Gold top accent strip --}}
    <div class="absolute top-0 left-0 right-0 h-1 z-20" style="background-color: {{ $primaryColor }};"></div>
</section>
