{{--
    Glaze Template: Hero Section
    Trendy & Flashy nail studio — bold rose accents, Outfit headings, Inter body
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Welcome to our company');
    $subtitle = $content['subtitle'] ?? __('We help you with professional services');
    $ctaText = $content['cta_text'] ?? __('Book a Treatment');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);
    $overlayOpacity = $content['overlay_opacity'] ?? 0.7;

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-start overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ $backgroundImage }}" alt="Hero background" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-transparent"></div>
        </div>
    @endif

    {{-- Decorative diagonal accent stripe --}}
    <div class="absolute top-0 right-0 w-1/3 h-full z-[1] opacity-10 hidden lg:block"
        style="background: linear-gradient(135deg, transparent 40%, {{ $primaryColor }} 40%, {{ $primaryColor }} 42%, transparent 42%);"
    ></div>

    {{-- Floating accent dot --}}
    <div class="absolute top-1/4 right-1/4 w-64 h-64 rounded-full blur-3xl opacity-15 z-[1]"
        style="background: {{ $primaryColor }};"
    ></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 w-full">
        {{-- Eyebrow with accent line --}}
        <div class="flex items-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
            style="opacity: 0; transform: translateX(-20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">
                Nail Studio
            </span>
        </div>

        {{-- Title --}}
        <h1
            class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-extrabold leading-[0.95] mb-8"
            style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', sans-serif; opacity: 0; transform: translateY(24px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h1>

        {{-- Subtitle with outline text --}}
        <p
            class="text-3xl sm:text-4xl md:text-5xl mb-12 max-w-3xl font-extrabold"
            style="color: transparent; -webkit-text-stroke: 1.5px {{ $primaryColor }}; font-family: '{{ $headingFont }}', sans-serif; opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-start gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 hover:shadow-lg"
                style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 24px {{ $primaryColor }}40;"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold rounded-full border-2 transition-all duration-300 hover:bg-white/10"
                style="border-color: rgba(255,255,255,0.3); color: {{ $textColor }};"
            >
                {{ __('Our services') }}
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2 animate-bounce">
            <span class="text-xs uppercase tracking-widest opacity-50" style="color: {{ $textColor }};">Scroll</span>
            <svg class="w-5 h-5 opacity-50" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </div>
</section>
