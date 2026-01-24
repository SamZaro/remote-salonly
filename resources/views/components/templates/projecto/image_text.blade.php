{{--
    Template-specifieke image_text sectie voor Projecto (Aannemer)

    Afbeelding links, tekst rechts met section header.
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Section header
    $title = $content['title'] ?? null;
    $subtitle = $content['subtitle'] ?? null;

    // Block content
    $blockTitle = $content['block_title'] ?? null;
    $blockText = $content['block_text'] ?? null;
    $ctaText = $content['cta_text'] ?? null;
    $ctaLink = $content['cta_link'] ?? '#contact';

    // Image
    $image = $section?->getFirstMediaUrl('image') ?: null;

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="image-text" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        @if($title || $subtitle)
            <div class="mb-24 text-center">
                @if($subtitle)
                    <span
                        class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                        style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                    >
                        {{ $subtitle }}
                    </span>
                @endif
                @if($title)
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                        style="color: {{ $headingColor }};"
                    >
                        {{ $title }}
                    </h2>
                @endif
            </div>
        @endif

        {{-- Two Column Layout: Image Left, Text Right --}}
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-start">
            {{-- Left: Image with background effect --}}
            <div class="relative max-w-md lg:max-w-lg mx-auto">
                {{-- Black square behind image - offset to left and bottom --}}
                <div
                    class="absolute -left-6 -bottom-6 w-full h-full bg-black"
                ></div>

                {{-- Image --}}
                @if($image)
                    <img
                        src="{{ $image }}"
                        alt="{{ $blockTitle ?? $title ?? '' }}"
                        class="relative w-full h-auto object-cover"
                    />
                @else
                    {{-- Placeholder --}}
                    <div
                        class="relative w-full h-[300px] flex items-center justify-center"
                        style="background-color: {{ $secondaryColor }};"
                    >
                        <svg class="w-24 h-24 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Right: Text Content --}}
            <div>
                @if($blockTitle)
                    <h3
                        class="text-2xl sm:text-3xl font-bold mb-6"
                        style="color: {{ $headingColor }};"
                    >
                        {{ $blockTitle }}
                    </h3>
                @endif

                @if($blockText)
                    <div
                        class="text-lg leading-relaxed opacity-75 mb-8 whitespace-pre-line"
                        style="color: {{ $textColor }};"
                    >
                        {{ $blockText }}
                    </div>
                @endif

                @if($ctaText)
                    <a
                        href="{{ $ctaLink }}"
                        class="inline-flex items-center px-8 py-4 text-lg font-semibold transition-all duration-300 hover:opacity-90"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                    >
                        {{ $ctaText }}
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
