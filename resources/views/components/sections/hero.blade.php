@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Welcome';
    $subtitle = $content['subtitle'] ?? '';
    $ctaText = $content['cta_text'] ?? null;
    $ctaUrl = $content['cta_url'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background');
    // Background position: top, center, bottom
    $bgPosition = $content['background_position'] ?? 'center';
@endphp

<section
    id="hero"
    class="relative min-h-[80vh] flex items-center justify-center px-4"
    style="
        background-color: {{ $theme['primary_color'] ?? '#3b82f6' }};
        @if($backgroundImage) background-image: url('{{ $backgroundImage }}'); background-size: cover; background-position: {{ $bgPosition }}; @endif
    "
>
    {{-- Overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 bg-black/50"></div>
    @endif

    <div class="relative z-10 max-w-4xl mx-auto text-center">
        <h1
            class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6"
            style="
                font-family: {{ $theme['heading_font_family'] ?? 'inherit' }};
                color: #ffffff;
            "
        >
            {{ $title }}
        </h1>

        @if($subtitle)
            <p
                class="text-xl md:text-2xl mb-8 opacity-90"
                style="color: #ffffff;"
            >
                {{ $subtitle }}
            </p>
        @endif

        @if($ctaText)
            <a
                href="{{ $ctaUrl }}"
                class="inline-block px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 hover:scale-105"
                style="
                    background-color: {{ $theme['accent_color'] ?? '#f59e0b' }};
                    color: #ffffff;
                "
            >
                {{ $ctaText }}
            </a>
        @endif
    </div>
</section>
