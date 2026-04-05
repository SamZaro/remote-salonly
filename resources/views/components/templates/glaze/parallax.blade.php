{{--
    Glaze Template: Parallax Section
    Fullwidth parallax with rose overlay and outline text
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

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] hidden md:flex items-center justify-center overflow-hidden"
>
    @if($backgroundImage)
        <div
            class="absolute inset-0 bg-cover bg-fixed"
            style="background-image: url('{{ $backgroundImage }}'); background-position: center 40%;"
        ></div>
    @endif

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-(--overlay-color)/60" style="--overlay-color: {{ $secondaryColor }};"></div>

    {{-- Decorative glow --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full blur-3xl opacity-10" style="background: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        @if($title)
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6"
                style="color: transparent; -webkit-text-stroke: 2px {{ $primaryColor }}; font-family: '{{ $headingFont }}', sans-serif;"
            >
                {!! $title !!}
            </h2>
        @endif

        @if($subtitle)
            <p class="text-lg sm:text-xl max-w-2xl mx-auto" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
