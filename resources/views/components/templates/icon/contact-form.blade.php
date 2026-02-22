{{--
    Icon Template: Contact Form section
    "Warm Atelier" — gold accents, editorial styling, 2-column with CTA + form
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
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Persoonlijk contact');
    $ctaHeading = $content['cta_heading'] ?? __('Wij maken graag kennis');
    $ctaHighlight = $content['cta_highlight'] ?? __('graag kennis');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Stuur ons een bericht');
@endphp

<section id="contact-form" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 overflow-hidden" style="box-shadow: 0 1px 12px rgba(0,0,0,0.04);">

            {{-- Left: CTA / Jumbotron --}}
            <div
                class="relative min-h-[420px] lg:min-h-[560px] flex items-center overflow-hidden"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                {{-- Background image or fallback --}}
                @if($backgroundImage)
                    <img
                        src="{{ $backgroundImage }}"
                        alt="{{ $ctaHeading }}"
                        class="absolute inset-0 w-full h-full object-cover"
                    />
                @else
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}, {{ $secondaryColor }}ee);"></div>
                    {{-- Decorative gold lines --}}
                    <div class="absolute inset-0 opacity-[0.04]" style="background-image: repeating-linear-gradient(45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 40px);"></div>
                @endif

                {{-- Dark overlay --}}
                <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $secondaryColor }}ee 0%, {{ $secondaryColor }}90 40%, {{ $secondaryColor }}40 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Gold accent line --}}
                    <div
                        class="w-12 h-px mb-6 transition-all duration-1000 ease-out"
                        :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    @if($ctaLabel)
                        <span
                            class="block uppercase text-[11px] tracking-[0.35em] font-medium mb-4 transition-all duration-700 delay-200"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="color: {{ $primaryColor }};"
                        >
                            {{ $ctaLabel }}
                        </span>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl leading-tight mb-5 transition-all duration-700 delay-300"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Decorative gold diamond --}}
                    <div
                        class="flex items-center gap-3 transition-all duration-700 delay-500"
                        :class="shown ? 'opacity-100' : 'opacity-0'"
                    >
                        <div class="w-8 h-px" style="background-color: {{ $primaryColor }}60;"></div>
                        <div class="w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }};"></div>
                        <div class="w-8 h-px" style="background-color: {{ $primaryColor }}60;"></div>
                    </div>
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-12 flex flex-col justify-center"
                style="background-color: {{ $backgroundColor }};"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-3 mb-5">
                            <span class="w-8 h-px" style="background-color: {{ $primaryColor }};"></span>
                            <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                                {{ __('Contactformulier') }}
                            </span>
                        </div>
                        <h4
                            class="text-xl sm:text-2xl mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
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
