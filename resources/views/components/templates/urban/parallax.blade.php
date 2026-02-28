{{--
    Urban Template: Parallax Section
    Full-width parallax with dark overlay, minimal text, gold horizontal rule
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title           = $content['title'] ?? 'Sharp & Clean';
    $subtitle        = $content['subtitle'] ?? 'Traditioneel vakmanschap, moderne stijl';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont    = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section
    id="parallax"
    class="relative min-h-[55vh] flex items-center justify-center overflow-hidden"
>
    {{-- Parallax background --}}
    @if($backgroundImage)
        <div
            class="absolute inset-0 bg-cover bg-center bg-fixed"
            style="background-image: url('{{ $backgroundImage }}');"
        ></div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    {{-- Overlay --}}
    <div class="absolute inset-0" style="background-color: {{ $secondaryColor }}e0;"></div>

    {{-- Full-width gold lines top/bottom --}}
    <div class="absolute top-0 inset-x-0 h-px" style="background-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 inset-x-0 h-px" style="background-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 text-center max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-24">

        {{-- Gold line above --}}
        <div
            class="flex items-center justify-center gap-6 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(15px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="flex-1 h-px max-w-[80px]" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                {{ $subtitle }}
            </span>
            <div class="flex-1 h-px max-w-[80px]" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Heading --}}
        <h2
            class="font-black uppercase leading-[0.85]"
            style="
                font-family: '{{ $headingFont }}';
                font-size: clamp(2.8rem, 7vw, 6rem);
                letter-spacing: -0.03em;
                color: #ffffff;
                opacity: 0;
                transform: translateY(20px);
                transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;
            "
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h2>
    </div>
</section>
