{{--
    Essence Template: Contact Form section
    "Soft Luxury" — refined, feminine, warm neutrals, understated elegance
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#6E5F5B';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('Uw schoonheid begint hier');
    $ctaHighlight = $content['cta_highlight'] ?? __('Persoonlijke aandacht, altijd');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Stuur ons een bericht');
@endphp

<section id="contact-form" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 overflow-hidden" style="box-shadow: 0 2px 24px {{ $secondaryColor }}08;">

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
                    <div class="absolute inset-0" style="background: linear-gradient(160deg, {{ $secondaryColor }}, #4a3f3a);"></div>
                    {{-- Soft fabric-like texture --}}
                    <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient({{ $primaryColor }} 1px, transparent 1px); background-size: 20px 20px;"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(160deg, {{ $secondaryColor }}cc 0%, #4a3f3acc 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Delicate label --}}
                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-12 h-px transition-all duration-1000"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                            style="background-color: {{ $primaryColor }}80;"
                        ></div>
                        @if($ctaLabel)
                            <span
                                class="text-xs font-medium uppercase tracking-[0.3em] transition-all duration-700"
                                :class="shown ? 'opacity-100' : 'opacity-0'"
                                style="color: {{ $primaryColor }};"
                            >
                                {{ $ctaLabel }}
                            </span>
                        @endif
                    </div>

                    <h3
                        class="text-3xl sm:text-4xl lg:text-[2.75rem] font-light leading-snug mb-6 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', Georgia, serif;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span class="italic" style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Elegant quote accent with highlight text --}}
                    @if($ctaHighlight)
                        <div
                            class="transition-all duration-700 delay-300"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                        >
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-px" style="background-color: {{ $primaryColor }}60;"></div>
                                <span class="text-4xl leading-none" style="color: {{ $primaryColor }}40; font-family: '{{ $headingFont }}', Georgia, serif;">&ldquo;</span>
                                <span class="text-xs italic" style="color: {{ $primaryColor }};">{{ $ctaHighlight }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-12 flex flex-col justify-center bg-white"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-10">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-8 h-px" style="background-color: {{ $secondaryColor }}30;"></div>
                            <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }}80;">
                                {{ __('Bericht') }}
                            </span>
                        </div>
                        <h4
                            class="text-xl sm:text-2xl font-light mb-3"
                            style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                        >
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
