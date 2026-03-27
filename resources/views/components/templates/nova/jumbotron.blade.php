{{--
    Nova Template: Jumbotron Section

    Grote banner met achtergrond, titel en CTA
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Ready to get started?');
    $subtitle = $content['subtitle'] ?? __('Contact us today');
    $ctaText = $content['cta_text'] ?? __('Get in touch');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $textColor = '#ffffff';
    $buttonRadius = $theme['button_border_radius'] ?? '0px';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-32 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/50 to-black/80"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: {{ $secondaryColor }};"></div>
    @endif

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6"
            style="color: transparent; -webkit-text-stroke: 2px {{ $primaryColor }}; font-family: var(--font-family-heading);"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            x-cloak
            :style="{ opacity: 0, transform: 'translateY(16px)', transition: 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1)' }"
        >
            {{ $title }}
        </h2>
        @if($subtitle)
            <p
                class="text-xl mb-10 opacity-90 max-w-2xl mx-auto"
                style="color: {{ $textColor }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                x-cloak
                :style="{ opacity: 0, transform: 'translateY(16px)', transition: 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s' }"
            >
                {{ $subtitle }}
            </p>
        @endif
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center gap-2 px-8 py-4 text-lg font-semibold transition-all duration-300 hover:scale-105"
            style="background-color: {{ $primaryColor }}; color: #ffffff; border-radius: {{ $buttonRadius }};"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            x-cloak
            :style="{ opacity: 0, transform: 'translateY(10px)', transition: 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s' }"
        >
            {{ $ctaText }}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
