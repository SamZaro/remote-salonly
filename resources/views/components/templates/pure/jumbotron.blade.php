{{--
    Pure Template: Jumbotron Section
    Natural & Botanical — elegant banner with teal overlay and botanical watermark
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Jouw Nieuwe Look Begint Hier';
    $subtitle = $content['subtitle'] ?? 'Professioneel, persoonlijk en met passie';
    $ctaText = $content['cta_text'] ?? 'Afspraak Maken';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
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

    {{-- Decorative botanical watermark --}}
    <span
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
        style="font-size: clamp(4rem, 12vw, 8rem); opacity: 0.04; color: #ffffff; font-family: '{{ $headingFont }}', serif;"
    >Natural Beauty</span>

    {{-- Leaf decoration --}}
    <svg class="absolute bottom-8 left-8 w-20 h-20 opacity-[0.06]" viewBox="0 0 100 100" fill="{{ $primaryColor }}">
        <path d="M50 5C50 5 20 30 20 60C20 80 35 95 50 95C65 95 80 80 80 60C80 30 50 5 50 5Z"/>
    </svg>

    <div
        class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
            style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
        >
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-xl mb-10 max-w-xl mx-auto leading-relaxed" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif; font-weight: 300;">
                {{ $subtitle }}
            </p>
        @endif

        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 rounded-none hover:shadow-lg"
            style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
            onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='{{ $secondaryColor }}';"
            onmouseout="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
        >
            {{ $ctaText }}
            <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
