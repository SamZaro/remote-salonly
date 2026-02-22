{{--
    Shadow Template: Contact Form section
    "Dark Modern Barbershop" — bold shadows, amber accents, sharp edges
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Inter';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('Laat een bericht achter');
    $ctaHighlight = $content['cta_highlight'] ?? __('bericht');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Stuur ons een bericht');
@endphp

<section id="contact-form" class="py-20 lg:py-28 bg-gray-100" style="font-family: '{{ $bodyFont }}', sans-serif;">
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
                    {{-- Geometric grid pattern --}}
                    <div class="absolute inset-0 opacity-[0.04]" style="background-image: linear-gradient({{ $primaryColor }} 1px, transparent 1px), linear-gradient(90deg, {{ $primaryColor }} 1px, transparent 1px); background-size: 60px 60px;"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}ee 0%, #111827ee 100%);"></div>

                {{-- Amber accent stripe --}}
                <div class="absolute top-0 left-0 bottom-0 w-1" style="background-color: {{ $primaryColor }};"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Badge --}}
                    @if($ctaLabel)
                        <span
                            class="inline-block px-4 py-1.5 text-sm font-semibold uppercase tracking-wider rounded-sm mb-8 transition-all duration-700"
                            :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-6'"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        >
                            {{ $ctaLabel }}
                        </span>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-8 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Feature blocks --}}
                    @if($ctaHighlight)
                        <div
                            class="grid grid-cols-2 gap-4 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        >
                            <div class="p-3" style="background-color: {{ $primaryColor }}10; border-left: 3px solid {{ $primaryColor }};">
                                <div class="text-xs font-semibold uppercase tracking-wider" style="color: {{ $primaryColor }};">{{ __('Snel') }}</div>
                                <div class="text-sm text-white opacity-70 mt-1">{{ __('Binnen 24u reactie') }}</div>
                            </div>
                            <div class="p-3" style="background-color: {{ $primaryColor }}10; border-left: 3px solid {{ $primaryColor }};">
                                <div class="text-xs font-semibold uppercase tracking-wider" style="color: {{ $primaryColor }};">{{ __('Direct') }}</div>
                                <div class="text-sm text-white opacity-70 mt-1">{{ __('Persoonlijk advies') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-10 flex flex-col justify-center"
                style="background-color: {{ $backgroundColor }}; border-left: 4px solid {{ $primaryColor }};"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-8">
                        <h4 class="text-xl sm:text-2xl font-bold mb-2" style="color: {{ $headingColor }};">
                            {{ $formTitle }}
                        </h4>
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
