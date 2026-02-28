{{--
    Spa Template: Contact Form Section
    Serene spa & wellness — split layout with CTA left, form right
    Fonts: Lustria (headings) + Lato (body)
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
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';

    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('We horen graag van je');
    $ctaHighlight = $content['cta_highlight'] ?? __('graag');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    $formTitle = $content['title'] ?? __('Stuur ons een bericht');
@endphp

<section id="contact-form" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 overflow-hidden rounded-lg">

            {{-- Left: CTA --}}
            <div
                class="relative min-h-[380px] lg:min-h-[500px] flex items-end overflow-hidden"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                @if($backgroundImage)
                    <img src="{{ $backgroundImage }}" alt="{{ $ctaHeading }}" class="absolute inset-0 w-full h-full object-cover" />
                @else
                    <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $secondaryColor }}ee 0%, {{ $secondaryColor }}40 60%, transparent 100%);"></div>

                {{-- Decorative circle --}}
                <div class="absolute top-8 right-8 w-24 h-24 rounded-full opacity-[0.06]" style="border: 2px solid #ffffff;"></div>

                <div class="relative z-10 p-8 lg:p-12 w-full">
                    @if($ctaLabel)
                        <span
                            class="block text-xs font-semibold uppercase tracking-[0.25em] mb-3 transition-all duration-700 delay-100"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                        >
                            {{ $ctaLabel }}
                        </span>
                    @endif

                    <h3
                        class="text-4xl sm:text-5xl leading-snug transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-12 flex flex-col justify-center"
                style="background-color: {{ $accentColor }};"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-8">
                        <h4
                            class="text-2xl sm:text-3xl font-bold"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;"
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
