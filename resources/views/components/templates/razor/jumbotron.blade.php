{{--
    Template-specifieke jumbotron voor Razor (Barbershop)

    Bold barbershop stijl met goud/zwart thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'WORD DE BESTE<br>VERSIE VAN JEZELF';
    $subtitle = $content['subtitle'] ?? 'Premium grooming voor de moderne man';
    $ctaText = $content['cta_text'] ?? 'BOEK NU';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren met defaults (consistent met projecto pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-40 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: {{ $secondaryColor }}e5;"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    {{-- Diagonal lines pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background: repeating-linear-gradient(45deg, {{ $primaryColor }}, {{ $primaryColor }} 1px, transparent 1px, transparent 50px);"></div>
    </div>

    {{-- Corner accents --}}
    <div class="absolute top-8 left-8 w-24 h-24 border-t-4 border-l-4" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute top-8 right-8 w-24 h-24 border-t-4 border-r-4" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-8 left-8 w-24 h-24 border-b-4 border-l-4" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-8 right-8 w-24 h-24 border-b-4 border-r-4" style="border-color: {{ $primaryColor }};"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Top badge --}}
        <div class="inline-flex items-center gap-3 mb-10">
            <div class="h-px w-12" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-bold uppercase tracking-[0.4em]" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <div class="h-px w-12" style="background-color: {{ $primaryColor }};"></div>
        </div>

        <h2
            class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-12 uppercase tracking-wider leading-tight"
            style="color: {{ $lightTextColor }}; font-family: 'Playfair Display', Georgia, serif;"
        >
            {!! $title !!}
        </h2>

        <a
            href="{{ $ctaLink }}"
            class="group inline-flex items-center gap-4 px-12 py-6 text-xl font-bold uppercase tracking-widest transition-all duration-300 border-2"
            style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }}; background: transparent;"
            onmouseover="this.style.background='{{ $primaryColor }}'; this.style.color='{{ $secondaryColor }}'"
            onmouseout="this.style.background='transparent'; this.style.color='{{ $primaryColor }}'"
        >
            {{ $ctaText }}
            <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

        {{-- Bottom decorative --}}
        <div class="flex items-center justify-center gap-6 mt-16">
            <div class="w-3 h-3 rotate-45" style="background-color: {{ $primaryColor }};"></div>
            <div class="h-px w-24" style="background-color: {{ $primaryColor }}60;"></div>
            <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
            <div class="h-px w-24" style="background-color: {{ $primaryColor }}60;"></div>
            <div class="w-3 h-3 rotate-45" style="background-color: {{ $primaryColor }};"></div>
        </div>
    </div>
</section>
