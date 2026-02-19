{{--
    Template-specifieke jumbotron voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'New Season, New Look!';
    $subtitle = $content['subtitle'] ?? 'Check onze latest trends en book jouw transformation';
    $ctaText = $content['cta_text'] ?? 'Bekijk Trends';
    $ctaLink = $content['cta_link'] ?? '#services';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
@endphp

<section id="jumbotron" class="relative py-32 lg:py-40 overflow-hidden" style="background: {{ $secondaryColor }};">
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Jumbotron background"
                class="w-full h-full object-cover opacity-30"
            />
        </div>
    @endif

    {{-- Geometric patterns --}}
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 2px, transparent 2px); background-size: 40px 40px;"></div>

    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Badge --}}
        <div class="flex justify-center mb-8">
            <div
                class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-bold transform -rotate-2 animate-pulse"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                HOT RIGHT NOW
            </div>
        </div>

        {{-- Title --}}
        <h2
            class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 leading-tight text-white"
            style="font-family: 'Montserrat', 'Poppins', sans-serif;"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p class="text-xl sm:text-2xl mb-12 max-w-3xl mx-auto" style="color: white; opacity: 0.8;">
            {{ $subtitle }}
        </p>

        {{-- CTA --}}
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold rounded-full transition-all duration-300 hover:scale-105 hover:-rotate-1"
            style="background: {{ $primaryColor }}; color: white; box-shadow: 6px 6px 0 {{ $accentColor }};"
        >
            {{ $ctaText }}
            <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

        {{-- Trending tags --}}
        <div class="mt-12 flex flex-wrap items-center justify-center gap-4">
            @foreach(['Balayage', 'Bold Colors', 'Curtain Bangs', 'Pixie Cut'] as $trend)
                <span
                    class="px-4 py-2 rounded-full text-sm font-bold transform hover:scale-110 transition-transform cursor-pointer"
                    style="background: white; color: {{ $secondaryColor }}; box-shadow: 3px 3px 0 {{ $primaryColor }};"
                >
                    #{{ $trend }}
                </span>
            @endforeach
        </div>
    </div>
</section>
