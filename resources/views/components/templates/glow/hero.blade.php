{{--
    Glow Template: Hero Section
    Warm minimalist design — clean typography, generous whitespace, no decorative clutter
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Mooi haar begint<br>bij vakmanschap';
    $subtitle = $content['subtitle'] ?? 'Persoonlijke haarverzorging en beauty in een ontspannen sfeer';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center"
    style="background-color: {{ $backgroundColor }};"
>
    <div class="relative z-10 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Content --}}
            <div
                class="text-center lg:text-left"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
            >
                <h1
                    class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                >
                    {!! $title !!}
                </h1>

                <p class="text-xl mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $subtitle }}
                </p>

                <a
                    href="{{ $ctaLink }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-wide uppercase transition-all duration-300 hover:opacity-90"
                    style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }}; border-radius: 6px;"
                >
                    {{ $ctaText }}
                    <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Image --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out 0.15s;"
            >
                @if($backgroundImage)
                    <img
                        src="{{ $backgroundImage }}"
                        alt="Salon"
                        class="w-full h-[480px] lg:h-[580px] object-cover"
                        style="border-radius: 12px;"
                    />
                @else
                    <div
                        class="w-full h-[480px] lg:h-[580px] flex items-center justify-center"
                        style="background-color: {{ $accentColor }}; border-radius: 12px;"
                    >
                        <svg class="w-16 h-16" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
