{{--
    Blush Template: Parallax Section
    Elegant nail studio — atmospheric parallax with refined typography
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] hidden md:flex items-center justify-center overflow-hidden"
>
    {{-- Parallax Background --}}
    @if($backgroundImage)
        <div
            class="absolute inset-0 bg-cover bg-fixed"
            style="background-image: url('{{ $backgroundImage }}'); background-position: center 40%;"
        ></div>
    @endif

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-(--overlay-color)/60" style="--overlay-color: {{ $secondaryColor }};"></div>

    {{-- Decorative corners --}}
    <div class="absolute top-8 left-8 w-20 h-20 border-t border-l opacity-15" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-8 right-8 w-20 h-20 border-b border-r opacity-15" style="border-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        @if($title)
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 tracking-tight italic"
                style="color: {{ $primaryColor }}; font-family: {{ $headingFont }};"
            >
                {!! $title !!}
            </h2>
        @endif

        @if($subtitle)
            <p class="text-lg sm:text-xl max-w-2xl mx-auto font-light tracking-wide" style="color: rgba(255,255,255,0.70); font-family: {{ $bodyFont }};">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
