{{--
    Blossom Template: Contact Form section
    "Floral Feminine" — soft pinks, rounded, delicate typography
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6ea';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $headingColor = $theme['heading_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('We horen graag van je');
    $ctaHighlight = $content['cta_highlight'] ?? __('graag');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Stuur ons een bericht');
@endphp

<section id="contact-form" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden" style="border: 1px solid {{ $primaryColor }}20;">

            {{-- Left: CTA / Jumbotron --}}
            <div
                class="relative min-h-[400px] lg:min-h-[540px] flex items-center overflow-hidden"
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
                    <div class="absolute inset-0" style="background: linear-gradient(160deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                    {{-- Decorative petal shapes --}}
                    <div class="absolute top-12 right-12 w-32 h-32 rounded-full opacity-10" style="background-color: #ffffff;"></div>
                    <div class="absolute top-24 right-24 w-20 h-20 rounded-full opacity-[0.07]" style="background-color: #ffffff;"></div>
                    <div class="absolute bottom-32 left-8 w-24 h-24 rounded-full opacity-[0.08]" style="background-color: #ffffff;"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $textColor }}dd 0%, {{ $textColor }}60 50%, transparent 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Bloom icon --}}
                    <div
                        class="mb-6 transition-all duration-1000"
                        :class="shown ? 'opacity-100 scale-100 rotate-0' : 'opacity-0 scale-50 rotate-45'"
                    >
                        <svg class="w-10 h-10" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                    </div>

                    @if($ctaLabel)
                        <span
                            class="block text-xs font-medium uppercase tracking-[0.2em] mb-3 transition-all duration-700 delay-100"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="color: {{ $primaryColor }};"
                        >
                            {{ $ctaLabel }}
                        </span>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-snug mb-6 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', Georgia, serif; font-weight: 700;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span class="italic" style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Soft divider with highlight --}}
                    @if($ctaHighlight)
                        <div
                            class="flex items-center gap-2 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                        >
                            <div class="w-6 h-px" style="background-color: {{ $primaryColor }};"></div>
                            <div class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                            <div class="w-6 h-px" style="background-color: {{ $primaryColor }};"></div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-12 flex flex-col justify-center"
                style="background: linear-gradient(135deg, {{ $primaryColor }}06, {{ $secondaryColor }}06);"
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
                            style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
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
