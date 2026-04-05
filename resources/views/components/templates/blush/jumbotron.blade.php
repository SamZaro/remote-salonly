{{--
    Blush Template: Jumbotron Section
    Elegant nail studio — full-width banner with serif typography
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Pampering at its Best');
    $subtitle = $content['subtitle'] ?? __('Luxury treatments for a radiant appearance');
    $ctaText = $content['cta_text'] ?? __('Book now');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $textColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section id="jumbotron" class="relative py-28 lg:py-36 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/70"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: {{ $secondaryColor }};"></div>
    @endif

    {{-- Decorative border --}}
    <div class="absolute inset-8 border opacity-10 hidden lg:block" style="border-color: {{ $primaryColor }};"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Sparkle icon --}}
        <div class="flex items-center justify-center mb-8">
            <svg class="w-6 h-6 opacity-60" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
            </svg>
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 tracking-tight italic"
            style="color: {{ $primaryColor }}; font-family: {{ $headingFont }};"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $primaryColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            {{ $title }}
        </h2>
        @if($subtitle)
            <p
                class="text-lg sm:text-xl mb-12 opacity-80 max-w-2xl mx-auto font-light"
                style="color: {{ $textColor }}; font-family: {{ $bodyFont }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $textColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{ $subtitle }}
            </p>
        @endif
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center gap-2 px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium transition-all duration-500 hover:scale-105"
            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: {{ $bodyFont }};"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            {{ $ctaText }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
