{{--
    Template-specifieke parallax voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Pure Elegance';
    $subtitle = $content['subtitle'] ?? 'Ervaar de ultieme verfijning';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
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

    {{-- Soft overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }}e6 0%, {{ $secondaryColor }}dd 100%);"></div>

    {{-- Subtle line decorations --}}
    <div class="absolute top-16 left-16 w-px h-24 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $primaryColor }}60, transparent);"></div>
    <div class="absolute bottom-16 right-16 w-px h-24 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $primaryColor }}60, transparent);"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Elegant badge --}}
        <div class="inline-flex items-center gap-3 mb-10">
            <div class="w-12 h-px" style="background-color: {{ $primaryColor }}80;"></div>
            <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $primaryColor }};">
                Exclusive
            </span>
            <div class="w-12 h-px" style="background-color: {{ $primaryColor }}80;"></div>
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 leading-tight tracking-tight"
            style="color: {{ $backgroundColor }}; font-family: 'Playfair Display', Georgia, serif;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl max-w-2xl mx-auto font-light leading-relaxed" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Decorative element --}}
        <div class="flex items-center justify-center mt-10">
            <div class="w-px h-10" style="background: linear-gradient(180deg, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
