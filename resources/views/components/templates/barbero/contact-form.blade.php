{{--
    Barbero Template: Contact Form section
    "Vintage Barbershop" — dark & moody, gold accents, bold uppercase
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? '#ffffff';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('Maak een afspraak');
    $ctaHighlight = $content['cta_highlight'] ?? __('afspraak');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Schrijf ons');
@endphp

<section id="contact-form" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
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
                    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }} 0%, #0a0a0a 100%);"></div>
                    {{-- Vintage crosshatch pattern --}}
                    <div class="absolute inset-0 opacity-[0.03]" style="background-image: repeating-linear-gradient(45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 20px), repeating-linear-gradient(-45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 20px);"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(to top, #000000ee 0%, #000000aa 40%, {{ $secondaryColor }}60 100%);"></div>

                {{-- Gold corner accents --}}
                <div class="absolute top-6 left-6 w-12 h-12" style="border-top: 2px solid {{ $primaryColor }}; border-left: 2px solid {{ $primaryColor }};"></div>
                <div class="absolute bottom-6 right-6 w-12 h-12" style="border-bottom: 2px solid {{ $primaryColor }}; border-right: 2px solid {{ $primaryColor }};"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Scissors icon --}}
                    <div
                        class="mb-6 transition-all duration-1000"
                        :class="shown ? 'opacity-100 rotate-0' : 'opacity-0 -rotate-90'"
                    >
                        <svg class="w-10 h-10" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                        </svg>
                    </div>

                    @if($ctaLabel)
                        <div class="flex items-center gap-4 mb-5">
                            <div
                                class="w-12 h-px transition-all duration-700"
                                :class="shown ? 'opacity-100' : 'opacity-0'"
                                style="background-color: {{ $primaryColor }};"
                            ></div>
                            <span
                                class="text-xs font-bold uppercase tracking-[0.3em] transition-all duration-700"
                                :class="shown ? 'opacity-100' : 'opacity-0'"
                                style="color: {{ $primaryColor }};"
                            >
                                {{ $ctaLabel }}
                            </span>
                        </div>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold uppercase tracking-wider mb-6 transition-all duration-700 delay-200"
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
                            class="flex items-center gap-4 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                        >
                            <div class="w-8 h-px" style="background-color: {{ $primaryColor }}60;"></div>
                            <div class="w-2 h-2 rotate-45 border" style="border-color: {{ $primaryColor }};"></div>
                            <div class="w-8 h-px" style="background-color: {{ $primaryColor }}60;"></div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-10 flex flex-col justify-center"
                style="background-color: {{ $secondaryColor }}; border: 2px solid {{ $primaryColor }};"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-8">
                        <span class="block text-xs font-bold uppercase tracking-[0.3em] mb-3" style="color: {{ $primaryColor }};">
                            {{ __('Contactformulier') }}
                        </span>
                        <h4
                            class="text-xl sm:text-2xl font-bold uppercase tracking-wider mb-2"
                            style="color: #ffffff; font-family: '{{ $headingFont }}', Georgia, serif;"
                        >
                            {{ $formTitle }}
                        </h4>
                        <div class="w-8 h-px mt-3" style="background-color: {{ $primaryColor }};"></div>
                    </div>

                    <livewire:contact-form :theme="[
                        'primary_color' => $primaryColor,
                        'secondary_color' => $secondaryColor,
                        'accent_color' => $accentColor,
                        'background_color' => $secondaryColor,
                        'text_color' => '#ffffff',
                        'heading_color' => '#ffffff',
                        'heading_font_family' => $headingFont,
                        'font_family' => $bodyFont,
                    ]" />
                </div>
            </div>

        </div>
    </div>
</section>
