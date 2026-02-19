{{--
    Template-specifieke parallax voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Create & Inspire';
    $subtitle = $content['subtitle'] ?? 'Waar creativiteit geen grenzen kent';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
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

    {{-- Vibrant gradient overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}e6 0%, {{ $secondaryColor }}ee 100%);"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Creative badge --}}
        <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-bold uppercase tracking-wider mb-8">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Creative Studio
        </div>

        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6 text-white uppercase tracking-tight">
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl text-white/90 max-w-2xl mx-auto font-medium">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Creative line decoration --}}
        <div class="flex items-center justify-center gap-3 mt-10">
            <div class="w-8 h-1 rounded-full" style="background-color: {{ $accentColor }};"></div>
            <div class="w-4 h-1 rounded-full bg-white/60"></div>
            <div class="w-8 h-1 rounded-full" style="background-color: {{ $accentColor }};"></div>
        </div>
    </div>
</section>
