{{--
    King Template: Hero Section
    "Royal Throne" — full-bleed cinematic hero, crown motifs, bold barbershop energy
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Rule Your<br>Style';
    $subtitle = $content['subtitle'] ?? __('Premium grooming for the modern king');
    $ctaText = $content['cta_text'] ?? __('Book Your Throne');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $rating = $content['rating'] ?? '5.0';
    $ratingCount = $content['rating_count'] ?? '200+';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

@once
    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @endpush
@endonce

<section
    id="hero"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
>
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt="{{ strip_tags($title) }}"
                class="absolute inset-0 w-full h-full object-cover"
                loading="eager"
            />
        </div>
    @endif

    {{-- Cinematic vignette --}}
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 40%, {{ $secondaryColor }}40 0%, {{ $secondaryColor }}c0 55%, {{ $secondaryColor }}f5 100%);"></div>

    {{-- Bottom gradient --}}
    <div class="absolute inset-x-0 bottom-0 h-56" style="background: linear-gradient(to top, {{ $secondaryColor }}, transparent);"></div>

    {{-- Crown corner accents — sharp angular lines --}}
    <div class="absolute top-8 left-8 hidden lg:block">
        <div class="w-20 h-px" style="background: linear-gradient(to right, {{ $primaryColor }}90, transparent);"></div>
        <div class="w-px h-20" style="background: linear-gradient(to bottom, {{ $primaryColor }}90, transparent);"></div>
        <div class="absolute top-3 left-3 w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }}40;"></div>
    </div>
    <div class="absolute top-8 right-8 hidden lg:block">
        <div class="w-20 h-px ml-auto" style="background: linear-gradient(to left, {{ $primaryColor }}90, transparent);"></div>
        <div class="w-px h-20 ml-auto" style="background: linear-gradient(to bottom, {{ $primaryColor }}90, transparent);"></div>
        <div class="absolute top-3 right-3 w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }}40;"></div>
    </div>
    <div class="absolute bottom-8 left-8 hidden lg:block">
        <div class="w-px h-20" style="background: linear-gradient(to top, {{ $primaryColor }}90, transparent);"></div>
        <div class="w-20 h-px" style="background: linear-gradient(to right, {{ $primaryColor }}90, transparent);"></div>
    </div>
    <div class="absolute bottom-8 right-8 hidden lg:block">
        <div class="w-px h-20 ml-auto" style="background: linear-gradient(to top, {{ $primaryColor }}90, transparent);"></div>
        <div class="w-20 h-px ml-auto" style="background: linear-gradient(to left, {{ $primaryColor }}90, transparent);"></div>
    </div>

    {{-- Content — centered magazine cover --}}
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">

        {{-- Label with crown icon --}}
        <div
            class="inline-flex items-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2 19h20v2H2v-2zm2-5l4-7 4 4 4-9 4 8v4H4v0z"/>
            </svg>
            <span class="uppercase text-[11px] tracking-[0.35em] font-semibold" style="color: {{ $primaryColor }};">
                {{ __('Barbershop') }}
            </span>
            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2 19h20v2H2v-2zm2-5l4-7 4 4 4-9 4 8v4H4v0z"/>
            </svg>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        @if($title)
            <h1
                class="text-[3rem] sm:text-7xl lg:text-8xl xl:text-9xl leading-[0.95] mb-8"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400; opacity: 0; transform: translateY(24px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            >
                {!! $title !!}
            </h1>
        @endif

        {{-- Crown divider — diamond-line-diamond --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
        >
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-2.5 h-2.5 rotate-45" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
        </div>

        {{-- Subtitle --}}
        @if($subtitle)
            <p
                class="text-[15px] sm:text-base max-w-lg mx-auto leading-relaxed mb-12"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}80; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
            >
                {{ $subtitle }}
            </p>
        @endif

        {{-- CTA buttons --}}
        <div
            class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            @if($ctaText)
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center px-10 py-4 text-[12px] font-bold uppercase tracking-[0.25em] transition-all duration-300 hover:brightness-110"
                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; box-shadow: 0 4px 24px {{ $primaryColor }}25;"
                >
                    {{ $ctaText }}
                    <svg class="w-3.5 h-3.5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            @endif
            <a
                href="#services"
                class="inline-flex items-center justify-center px-10 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
            >
                {{ __('Our Services') }}
            </a>
        </div>
    </div>

    {{-- Trust bar — bottom --}}
    <div
        class="absolute bottom-0 left-0 right-0 z-20 py-5"
        x-data x-intersect.once="$el.style.opacity = 1"
        style="background: linear-gradient(to top, {{ $secondaryColor }}f0, {{ $secondaryColor }}80); border-top: 1px solid {{ $primaryColor }}10; opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.6s;"
    >
        <div class="flex items-center justify-center gap-2">
            {{-- Stars --}}
            @for($i = 0; $i < 5; $i++)
                <svg class="w-3.5 h-3.5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
            <span class="text-[12px] font-bold ml-1" style="color: {{ $primaryColor }};">{{ $rating }}</span>
            <span class="text-[11px] ml-1" style="color: {{ $backgroundColor }}40;">{{ $ratingCount }} {{ __('reviews') }}</span>
        </div>
    </div>

    {{-- Scroll cue --}}
    <div
        class="absolute bottom-16 left-1/2 -translate-x-1/2 z-10 hidden lg:block"
        x-data x-intersect.once="$el.style.opacity = 1"
        style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.7s;"
    >
        <div class="w-5 h-8 rounded-full border flex items-start justify-center pt-1.5" style="border-color: {{ $primaryColor }}30;">
            <div class="w-0.5 h-2 rounded-full animate-bounce" style="background-color: {{ $primaryColor }};"></div>
        </div>
    </div>
</section>
