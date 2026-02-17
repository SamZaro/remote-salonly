{{--
    Icon Template: Parallax Section
    "Warm Atelier" -- dramatic cinematic interlude, dark parallax with gold accents
    A visual breather between content sections
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Jouw Stijl, Onze Passie';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging met een moderne twist';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] flex items-center justify-center overflow-hidden"
    style="font-family: '{{ $bodyFont }}', sans-serif;"
>
    {{-- Parallax Background --}}
    @if($backgroundImage)
        <div
            class="absolute inset-0 bg-cover bg-center bg-fixed"
            style="background-image: url('{{ $backgroundImage }}');"
        ></div>
        {{-- Dark overlay --}}
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }}e0;"></div>
    @else
        {{-- No image: solid secondary with subtle radial warmth --}}
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 50%, {{ $secondaryColor }} 0%, #0d0d0d 100%);"></div>
        <div class="absolute inset-0" style="background: radial-gradient(circle at 50% 60%, {{ $primaryColor }}06 0%, transparent 50%);"></div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">

        {{-- Gold-line label --}}
        <div
            class="inline-flex items-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                Exclusief
            </span>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-[3.2rem] leading-[1.1] mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {!! $title !!}
        </h2>

        {{-- Gold divider (line-dot-line) --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
        >
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Subtitle --}}
        @if($subtitle)
            <p
                class="text-[15px] max-w-xl mx-auto leading-relaxed"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}70; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
            >
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
