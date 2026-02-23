{{--
    Template-specifieke parallax voor Nova (Premium Salon)

    Elegante stijl met warme bruintinten
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

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
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

    {{-- Decorative border --}}
    <div class="absolute inset-6 border opacity-20" style="border-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        {{-- Top decoration
        <div class="flex items-center justify-center gap-4 mb-8">
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>
        --}}

        @if($title)
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 text-white"
            >
                {!! $title !!}
            </h2>
        @endif

        @if($subtitle)
            <p class="text-lg sm:text-xl max-w-2xl mx-auto" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Bottom decoration
        <div class="flex items-center justify-center mt-10">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
        --}}
    </div>
</section>
