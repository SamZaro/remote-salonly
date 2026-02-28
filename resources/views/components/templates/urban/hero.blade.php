{{--
    Urban Template: Hero Section
    Editorial luxury barbershop — sharp angles, large typography, gold accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Sharp Looks.<br>Clean Cuts.';
    $subtitle = $content['subtitle'] ?? 'Traditioneel vakmanschap met moderne flair';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor    = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont    = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

{{-- Load Barlow fonts once --}}
@once
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700;800;900&family=Barlow:wght@300;400;500;600;700&display=swap">
@endonce

<section
    id="hero"
    class="relative min-h-screen flex items-end overflow-hidden"
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
            <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $secondaryColor }} 0%, {{ $secondaryColor }}cc 30%, {{ $secondaryColor }}40 70%, transparent 100%);"></div>
        </div>
    @else
        {{-- Solid dark fallback --}}
        <div class="absolute inset-0 z-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    {{-- Vertical gold accent line --}}
    <div class="absolute top-0 bottom-0 left-16 lg:left-24 w-px z-10 hidden lg:block" style="background: linear-gradient(to bottom, transparent, {{ $primaryColor }}, transparent); opacity: 0.4;"></div>

    {{-- Content — bottom-left editorial layout --}}
    <div class="relative z-10 w-full pb-20 lg:pb-28 pt-32">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
            <div class="max-w-4xl lg:pl-12">

                {{-- Eyebrow label --}}
                <div
                    class="flex items-center gap-4 mb-8"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                    style="opacity: 0; transform: translateX(-20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
                >
                    <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <span
                        class="text-xs font-bold uppercase tracking-[0.35em]"
                        style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
                    >
                        Premium Barbershop
                    </span>
                </div>

                {{-- Main heading --}}
                <h1
                    class="font-black uppercase leading-[0.9] mb-10"
                    style="
                        font-family: '{{ $headingFont }}';
                        font-size: clamp(3rem, 8vw, 7rem);
                        letter-spacing: -0.02em;
                        color: #ffffff;
                        opacity: 0;
                        transform: translateY(30px);
                        transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;
                    "
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {!! $title !!}
                </h1>

                {{-- Subtitle --}}
                <p
                    class="text-xl mb-12 max-w-md"
                    style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}'; letter-spacing: 0.02em;"
                >
                    {{ $subtitle }}
                </p>

                {{-- CTA Buttons --}}
                <div
                    class="flex flex-wrap items-center gap-4"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(15px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
                >
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:opacity-85"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                    >
                        {{ $ctaText }}
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="#services"
                        class="inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm border transition-all duration-300 hover:bg-white/5"
                        style="border-color: {{ $primaryColor }}50; color: #ffffff; font-family: '{{ $bodyFont }}';"
                    >
                        Bekijk Diensten
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 right-8 lg:right-12 z-10 flex flex-col items-center gap-3">
        <div class="w-px h-16 animate-pulse" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent);"></div>
        <span class="text-xs uppercase tracking-[0.3em] rotate-90 origin-center translate-y-6" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Scroll</span>
    </div>
</section>
