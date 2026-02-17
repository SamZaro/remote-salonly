{{--
    Wave Template: Hero Section
    "Coastal Minimal" — clean full-screen hero, wave bottom, ocean-depth gradient, rounded CTAs
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Welkom bij ons bedrijf';
    $subtitle = $content['subtitle'] ?? 'Wij helpen u met professionele dienstverlening';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.7;

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
>
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Hero background"
                class="w-full h-full object-cover"
            />
            <div
                class="absolute inset-0"
                style="background: linear-gradient(180deg, {{ $secondaryColor }}{{ dechex((int)($overlayOpacity * 255)) }} 0%, {{ $secondaryColor }}80 50%, {{ $primaryColor }}20 100%);"
            ></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }} 0%, {{ $primaryColor }}15 100%);"></div>
    @endif

    {{-- Wave-shaped bottom transition --}}
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg class="w-full h-24 sm:h-32 lg:h-40" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="{{ $backgroundColor }}">
            <path d="M0,80 C240,120 480,40 720,80 C960,120 1200,40 1440,80 L1440,120 L0,120 Z" opacity="0.5"/>
            <path d="M0,90 C360,50 720,110 1080,60 C1260,40 1380,70 1440,90 L1440,120 L0,120 Z" opacity="0.8"/>
            <path d="M0,100 C180,80 360,110 540,95 C720,80 900,110 1080,95 C1260,80 1380,100 1440,100 L1440,120 L0,120 Z"/>
        </svg>
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center pb-32 lg:pb-40">

        {{-- Overline badge --}}
        <div
            class="mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="inline-block px-5 py-2 text-[11px] uppercase tracking-[0.25em] font-medium rounded-full"
                style="color: {{ $backgroundColor }}; background: {{ $primaryColor }}25; border: 1px solid {{ $primaryColor }}40; backdrop-filter: blur(8px);"
            >
                Kapsalon & Hairstyling
            </span>
        </div>

        {{-- Title --}}
        <h1
            class="text-4xl sm:text-5xl lg:text-7xl xl:text-8xl leading-[1.08] mb-6"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitle --}}
        <p
            class="text-base sm:text-lg max-w-xl mx-auto leading-relaxed mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}b3; opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA buttons --}}
        <div
            class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-wide rounded-full transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5"
                style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 20px {{ $primaryColor }}40;"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium tracking-wide rounded-full transition-all duration-300 hover:bg-white/10"
                style="color: {{ $backgroundColor }}; border: 1px solid {{ $backgroundColor }}30;"
            >
                Onze diensten
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div
        class="absolute bottom-36 sm:bottom-40 lg:bottom-48 left-1/2 -translate-x-1/2 z-20"
        x-data x-intersect.once="$el.style.opacity = 1"
        style="opacity: 0; transition: opacity 1s ease 0.8s;"
    >
        <div class="flex flex-col items-center gap-2 animate-bounce">
            <span class="text-[10px] uppercase tracking-[0.2em]" style="color: {{ $backgroundColor }}50;">Scroll</span>
            <svg class="w-4 h-4" style="color: {{ $backgroundColor }}50;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>
