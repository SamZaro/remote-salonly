{{--
    Template-specifieke parallax voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Puur & Natuurlijk';
    $subtitle = $content['subtitle'] ?? 'Ontdek de kracht van natuurlijke schoonheid';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
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

    {{-- Natural green overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }}e6 0%, {{ $primaryColor }}cc 100%);"></div>

    {{-- Organic shapes --}}
    <div class="absolute top-16 left-[10%] w-32 h-32 rounded-full opacity-10 blur-2xl" style="background: {{ $accentColor }};"></div>
    <div class="absolute bottom-20 right-[15%] w-40 h-40 rounded-full opacity-10 blur-2xl" style="background: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Leaf icon --}}
        <div class="inline-flex items-center justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <svg class="w-12 h-12" style="color: {{ $accentColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 text-white tracking-tight"
            style="font-family: '{{ $headingFont }}', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl max-w-2xl mx-auto" style="color: {{ $accentColor }};">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Natural element decoration --}}
        <div class="flex items-center justify-center gap-2 mt-10">
            <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }}40;"></div>
            <div class="h-px w-16" style="background-color: {{ $accentColor }}60;"></div>
            <svg class="w-5 h-5" style="color: {{ $accentColor }};" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75C7 8 17 8 17 8z"/>
            </svg>
            <div class="h-px w-16" style="background-color: {{ $accentColor }}60;"></div>
            <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }}40;"></div>
        </div>
    </div>
</section>
