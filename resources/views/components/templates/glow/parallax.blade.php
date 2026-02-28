{{--
    Glow Template: Parallax Section
    Warm minimalist — clean parallax with subtle overlay, no badges or decorative hearts
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Ontdek Jouw Schoonheid';
    $subtitle = $content['subtitle'] ?? 'Een moment van rust en aandacht, speciaal voor jou';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

<section
    id="parallax"
    class="relative min-h-[45vh] flex items-center justify-center overflow-hidden"
>
    @if($backgroundImage)
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $backgroundImage }}');"></div>
    @endif

    <div class="absolute inset-0" style="background-color: {{ $secondaryColor }}e0;"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-5 leading-tight"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', sans-serif;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-xl max-w-xl mx-auto" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </p>
        @endif

        <div class="w-12 h-px mx-auto mt-8" style="background-color: {{ $primaryColor }}60;"></div>
    </div>
</section>
