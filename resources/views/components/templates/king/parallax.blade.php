{{--
    King Template: Parallax Section
    "Royal Throne" — cinematic dark parallax interlude, diamond accents, bold typography
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Your Style, Your Reign');
    $subtitle = $content['subtitle'] ?? __('Where tradition meets modern craft');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
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
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }}e0;"></div>
    @else
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 50%, {{ $secondaryColor }} 0%, #0a0a0a 100%);"></div>
        <div class="absolute inset-0" style="background: radial-gradient(circle at 50% 60%, {{ $primaryColor }}06 0%, transparent 50%);"></div>
    @endif

    {{-- Decorative diagonal lines --}}
    <div class="absolute inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 80px);"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">

        {{-- Crown label --}}
        <div
            class="inline-flex items-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2 19h20v2H2v-2zm2-5l4-7 4 4 4-9 4 8v4H4v0z"/>
            </svg>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-[3.2rem] leading-[1.05] mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {!! $title !!}
        </h2>

        {{-- Crown divider --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
        >
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-2.5 h-2.5 rotate-45" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
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
