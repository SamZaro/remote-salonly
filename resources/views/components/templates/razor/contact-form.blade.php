{{--
    Razor Template: Contact Form section
    "Sharp Barbershop" — angular, gold borders, editorial precision
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $accentColor = $theme['accent_color'] ?? '#f5f0e0';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('Let us hear from you');
    $ctaHighlight = $content['cta_highlight'] ?? __('hear');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Send us a message');
@endphp

<section id="contact-form" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 overflow-hidden">

            {{-- Left: CTA / Jumbotron --}}
            <div
                class="relative min-h-[420px] lg:min-h-[560px] flex items-center overflow-hidden"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                @if($backgroundImage)
                    <img
                        src="{{ $backgroundImage }}"
                        alt="{{ $ctaHeading }}"
                        class="absolute inset-0 w-full h-full object-cover"
                    />
                @else
                    <div class="absolute inset-0" style="background: {{ $secondaryColor }};"></div>
                    {{-- Diagonal stripe pattern --}}
                    <div class="absolute inset-0 opacity-[0.03]" style="background-image: repeating-linear-gradient(-45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 24px);"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $secondaryColor }}f0 0%, {{ $secondaryColor }}80 50%, {{ $secondaryColor }}50 100%);"></div>

                {{-- Accent border --}}
                <div class="absolute top-0 left-0 bottom-0 w-1" style="background-color: {{ $primaryColor }};"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    @if($ctaLabel)
                        <span
                            class="block text-xs font-bold uppercase tracking-[0.3em] mb-5 transition-all duration-700"
                            :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-6'"
                            style="color: {{ $primaryColor }};"
                        >
                            {{ $ctaLabel }}
                        </span>
                    @endif

                    <div
                        class="flex items-center gap-4 mb-6 transition-all duration-700 delay-100"
                        :class="shown ? 'opacity-100' : 'opacity-0'"
                    >
                        <div class="h-px w-12" style="background-color: {{ $primaryColor }};"></div>
                    </div>

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', Georgia, serif;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    @if($ctaHighlight)
                        <div
                            class="flex items-center gap-3 transition-all duration-700 delay-400"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                        >
                            <div class="w-8 h-px" style="background-color: {{ $primaryColor }}60;"></div>
                            <span class="text-xs uppercase tracking-wider" style="color: {{ $primaryColor }}80;">{{ $ctaHighlight }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-10 flex flex-col justify-center"
                style="background-color: {{ $backgroundColor }}; border: 2px solid {{ $primaryColor }};"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-8">
                        <h4
                            class="text-xl sm:text-2xl font-bold mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                        >
                            {{ $formTitle }}
                        </h4>
                        <div class="flex items-center gap-4 mt-3">
                            <div class="h-px w-8" style="background-color: {{ $primaryColor }};"></div>
                        </div>
                    </div>

                    <livewire:contact-form :theme="[
                        'primary_color' => $primaryColor,
                        'secondary_color' => $secondaryColor,
                        'accent_color' => $accentColor,
                        'background_color' => $backgroundColor,
                        'text_color' => $textColor,
                        'heading_color' => $headingColor,
                        'heading_font_family' => $headingFont,
                        'font_family' => $bodyFont,
                    ]" />
                </div>
            </div>

        </div>
    </div>
</section>
