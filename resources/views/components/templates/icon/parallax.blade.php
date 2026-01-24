{{--
    Template-specifieke parallax voor Icon (Hair Salon)

    Moderne, frisse kapsalon voor mannen en vrouwen
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

    // Theme kleuren - frisse, zachte kleuren
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
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

    {{-- Gradient overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}e6 0%, {{ $secondaryColor }}dd 100%);"></div>

    {{-- Geometric decorations --}}
    <div class="absolute top-16 right-20 w-20 h-20 border-2 border-white/20 rounded-full"></div>
    <div class="absolute bottom-20 left-16 w-16 h-16 border border-white/15 rounded-lg rotate-45"></div>
    <div class="absolute top-1/2 right-1/4 w-8 h-8 bg-white/10 rounded-full"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Modern badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm text-white text-sm font-medium mb-8">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
            </svg>
            Modern & Fresh
        </div>

        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 text-white">
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl text-white/90 max-w-2xl mx-auto">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Wave decoration --}}
        <div class="flex items-center justify-center gap-1 mt-10">
            @for($i = 0; $i < 5; $i++)
                <div class="w-1.5 h-6 rounded-full bg-white/40" style="transform: scaleY({{ 0.4 + ($i == 2 ? 0.6 : abs(2 - $i) * 0.2) }});"></div>
            @endfor
        </div>
    </div>
</section>
