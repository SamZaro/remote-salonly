{{--
    Wave Template: Parallax Section
    "Coastal Minimal" — bg-fixed parallax with ocean-depth overlay, wave transitions, gradient accents
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

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
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
    @endif

    {{-- Ocean-depth overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }}cc 0%, {{ $secondaryColor }}90 50%, {{ $primaryColor }}20 100%);"></div>

    {{-- Wave top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-12 sm:h-16" viewBox="0 0 1440 60" preserveAspectRatio="none">
            <path d="M0,60 L0,20 C360,0 720,40 1080,20 C1260,10 1380,30 1440,20 L1440,60 Z" fill="{{ $backgroundColor }}"/>
        </svg>
    </div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-12 sm:h-16" viewBox="0 0 1440 60" preserveAspectRatio="none">
            <path d="M0,40 C360,0 720,60 1080,40 C1260,30 1380,50 1440,40 L1440,60 L0,60 Z" fill="{{ $backgroundColor }}" opacity="0.6"/>
            <path d="M0,45 C180,30 360,55 540,42 C720,30 900,55 1080,42 C1260,30 1380,48 1440,45 L1440,60 L0,60 Z" fill="{{ $backgroundColor }}"/>
        </svg>
    </div>

    {{-- Content --}}
    <div
        class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        {{-- Decorative --}}
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <div class="w-2 h-2 rounded-full" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }});"></div>
            <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl leading-tight mb-6"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-base sm:text-lg max-w-2xl mx-auto leading-relaxed" style="color: {{ $backgroundColor }}80;">
                {{ $subtitle }}
            </p>
        @endif
    </div>
</section>
