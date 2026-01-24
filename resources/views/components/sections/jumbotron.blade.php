{{--
    Default jumbotron section

    Grote banner met achtergrond, titel en CTA
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar om te beginnen?';
    $subtitle = $content['subtitle'] ?? 'Neem vandaag nog contact met ons op';
    $ctaText = $content['cta_text'] ?? 'Neem contact op';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#3b82f6';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = '#ffffff';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-32 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-black/60"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
            {{ $title }}
        </h2>
        @if($subtitle)
            <p class="text-xl mb-10 opacity-90 max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        @endif
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center gap-2 px-8 py-4 text-lg font-semibold rounded-lg transition-all duration-300 hover:scale-105"
            style="background-color: {{ $primaryColor }}; color: white;"
        >
            {{ $ctaText }}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
