{{--
    Icon Template: Hero Section
    "Warm Atelier" — full-bleed magazine cover, centered cinematic typography, gold ambient accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Your Hair,<br>Your Style';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging voor mannen en vrouwen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
>
    {{-- Background layer --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover"
            />
            {{-- Cinematic vignette: radial dark edges, warm center --}}
            <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, {{ $secondaryColor }}60 0%, {{ $secondaryColor }}d0 70%, {{ $secondaryColor }}f0 100%);"></div>
            {{-- Bottom fade for seamless transition to next section --}}
            <div class="absolute inset-x-0 bottom-0 h-48" style="background: linear-gradient(to top, {{ $secondaryColor }}, transparent);"></div>
        </div>
    @else
        {{-- No-image: warm radial glow --}}
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 60%, {{ $secondaryColor }} 0%, #0d0d0d 100%);"></div>
        {{-- Subtle gold ambient light --}}
        <div class="absolute inset-0" style="background: radial-gradient(circle at 50% 80%, {{ $primaryColor }}06 0%, transparent 50%);"></div>
    @endif

    {{-- Gold corner accents — architectural framing --}}
    <div class="absolute top-8 left-8 w-16 h-px hidden lg:block" style="background: linear-gradient(to right, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute top-8 left-8 w-px h-16 hidden lg:block" style="background: linear-gradient(to bottom, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute bottom-8 right-8 w-16 h-px hidden lg:block" style="background: linear-gradient(to left, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute bottom-8 right-8 w-px h-16 hidden lg:block" style="background: linear-gradient(to top, {{ $primaryColor }}80, transparent);"></div>

    {{-- Content — centered magazine cover layout --}}
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 py-32 lg:py-0 max-w-4xl mx-auto">

        {{-- Label --}}
        <div
            class="inline-flex items-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <span class="uppercase text-[14px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                Hairstyling & Verzorging
            </span>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        <h1
            class="text-gray-200 text-[2.6rem] sm:text-6xl lg:text-7xl xl:text-8xl leading-[1.05] mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="font-family: '{{ $headingFont }}', serif; font-weight: 600; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {!! $title !!}
        </h1>

        {{-- Gold divider --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
        >
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Subtitle --}}
        <p
            class="text-[15px] sm:text-base max-w-lg mx-auto leading-relaxed mb-12"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}80; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA buttons --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-8 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] text-white transition-all duration-300 hover:brightness-110"
                style="background-color: {{ $primaryColor }}; box-shadow: 0 4px 24px {{ $primaryColor }}25;"
            >
                {{ $ctaText }}
                <svg class="w-3.5 h-3.5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-[12px] font-medium uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
            >
                Bekijk diensten
            </a>
        </div>

        {{-- Trust --}}
        <div
            class="inline-flex items-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.6s;"
        >
            <div class="flex items-center gap-0.5">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-3 h-3" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                    </svg>
                @endfor
            </div>
            <span class="text-gray-200 text-[11px] tracking-wide">
                4.9 — 500+ beoordelingen
            </span>
        </div>
    </div>

    {{-- Scroll cue --}}
    <div
        class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2"
        x-data x-intersect.once="$el.style.opacity = 1"
        style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.8s;"
    >
        <span class="text-[10px] uppercase tracking-[0.25em]" style="color: {{ $backgroundColor }}20;">Scroll</span>
        <div class="w-px h-8 overflow-hidden">
            <div class="w-px h-8 animate-bounce" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
