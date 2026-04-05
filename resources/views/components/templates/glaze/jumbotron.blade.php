{{--
    Glaze Template: Jumbotron Section
    Bold banner with outline text and rose CTA
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

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $textColor = '#ffffff';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-32 overflow-hidden">
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/80"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: {{ $secondaryColor }};"></div>
    @endif

    {{-- Decorative glow --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full blur-3xl opacity-10" style="background: {{ $primaryColor }};"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6"
            style="color: transparent; -webkit-text-stroke: 2px {{ $primaryColor }}; font-family: '{{ $headingFont }}', sans-serif;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            x-cloak
            :style="{ opacity: 0, transform: 'translateY(16px)', transition: 'all 0.8s cubic-bezier(0.22, 1, 0.36, 1)' }"
        >
            {{ $title }}
        </h2>
        @if($subtitle)
            <p
                class="text-xl mb-10 opacity-80 max-w-2xl mx-auto"
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
            class="inline-flex items-center gap-2 px-8 py-4 text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105"
            style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 24px {{ $primaryColor }}40;"
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
