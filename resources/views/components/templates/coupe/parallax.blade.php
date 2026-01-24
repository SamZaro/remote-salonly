{{--
    Template-specifieke parallax voor Coupe (Kapsalon)

    Elegante kapsalon stijl met warme bruintinten
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Stijl & Elegantie';
    $subtitle = $content['subtitle'] ?? 'Waar vakmanschap en schoonheid samenkomen';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - elegant kapsalon
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
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

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/60 to-black/70"></div>

    {{-- Decorative circles --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-16 left-16 w-32 h-32 border-2 border-white rounded-full"></div>
        <div class="absolute bottom-16 right-16 w-24 h-24 border border-white rounded-full"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Decorative line --}}
        <div class="flex items-center justify-center gap-4 mb-8">
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light tracking-wide mb-6 text-white"
            style="font-family: 'Playfair Display', serif;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl text-white/80 max-w-2xl mx-auto font-light tracking-wide">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Bottom line --}}
        <div class="flex items-center justify-center mt-10">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
