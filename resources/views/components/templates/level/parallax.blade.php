{{--
    Level Template: Parallax Section
    Dark parallax — orange eyebrow lines, large centered heading
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title           = $content['title'] ?? 'Mooi Haar Begint Hier';
    $subtitle        = $content['subtitle'] ?? 'Vakmanschap en persoonlijke aandacht';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#f97316';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $headingFont    = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Jost, sans-serif';
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

    {{-- Overlay — lighter than urban --}}
    <div class="absolute inset-0" style="background: rgba(43,43,43,0.78);"></div>

    {{-- Orange top/bottom border lines --}}
    <div class="absolute top-0 inset-x-0 h-px" style="background-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 inset-x-0 h-px" style="background-color: {{ $primaryColor }};"></div>

    {{-- Content —  centered --}}
    <div class="relative z-10 text-center max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-24">

        {{-- Eyebrow with orange lines --}}
        <div
            class="flex items-center justify-center gap-5 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="flex-1 h-px max-w-[60px]" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                {{ $subtitle }}
            </span>
            <div class="flex-1 h-px max-w-[60px]" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Heading --}}
        <h2
            class="font-black leading-[0.85]"
            style="
                font-family: '{{ $headingFont }}';
                font-size: clamp(2.8rem, 7vw, 6rem);
                letter-spacing: -0.04em;
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
