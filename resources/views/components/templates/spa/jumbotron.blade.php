{{--
    Spa Template: Jumbotron Section
    Serene spa & wellness — elegant banner with warm overlay and centered typography
    Fonts: Playfair Display (headings) + Lato (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Verwennerij begint hier';
    $subtitle = $content['subtitle'] ?? 'Boek uw behandeling en ontdek pure ontspanning';
    $ctaText = $content['cta_text'] ?? 'Afspraak Maken';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-32 overflow-hidden">
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}dd 0%, {{ $secondaryColor }}bb 100%);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }} 0%, {{ $secondaryColor }}cc 100%);"></div>
    @endif

    {{-- Decorative watermark --}}
    <span
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
        style="font-size: clamp(4rem, 12vw, 8rem); opacity: 0.04; color: #ffffff; font-family: 'Playfair Display', serif;"
    >Spa & Wellness</span>

    <div
        class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
    >
        <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
            style="color: #ffffff; font-family: 'Playfair Display', serif;"
        >
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-xl mb-10 max-w-xl mx-auto leading-relaxed" style="color: {{ $primaryColor }}; font-family: 'Lato', sans-serif; font-weight: 300;">
                {{ $subtitle }}
            </p>
        @endif

        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 hover:shadow-lg"
            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-radius: 4px; font-family: 'Lato', sans-serif;"
            onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='{{ $secondaryColor }}';"
            onmouseout="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='{{ $secondaryColor }}';"
        >
            {{ $ctaText }}
            <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
