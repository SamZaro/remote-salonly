{{--
    Template-specifieke parallax voor Blossom (Luxury Beauty Salon)

    Luxe vrouwelijke beauty salon met spa & fashion vibes
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Bloom Into Beauty';
    $subtitle = $content['subtitle'] ?? 'Ontdek jouw unieke schoonheid bij ons';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - luxe vrouwelijke bloemen/spa kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] flex items-center justify-center overflow-hidden"
>
    {{-- Parallax Background --}}
    @if($backgroundImage)
        <div
            class="absolute inset-0 bg-cover bg-center bg-fixed"
            style="background-image: url('{{ $backgroundImage }}');"
        ></div>
    @endif

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}e6 0%, {{ $secondaryColor }}cc 100%);"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-medium mb-8 bg-white/20 text-white">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm0-18c-1.1 0-2 .9-2 2v1.17c-2.36.58-4 2.71-4 5.33 0 2.08.85 3.97 2.22 5.33L12 21l3.78-7.17C17.15 12.47 18 10.58 18 8.5c0-2.62-1.64-4.75-4-5.33V4c0-1.1-.9-2-2-2z"/>
            </svg>
            Luxury Experience
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 text-white leading-tight"
            style="font-family: '{{ $headingFont }}', Georgia, serif;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl text-white/90 max-w-2xl mx-auto">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Decorative hearts --}}
        <div class="flex items-center justify-center gap-4 mt-10">
            <svg class="w-5 h-5 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <div class="h-px w-20 bg-white/30"></div>
            <svg class="w-5 h-5 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
    </div>
</section>
