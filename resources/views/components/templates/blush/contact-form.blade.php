{{--
    Blush Template: Contact Form Section
    Elegant nail studio — two-column layout with CTA left, form right
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';

    $ctaLabel = $content['cta_label'] ?? __('Get in touch');
    $ctaHeading = $content['cta_heading'] ?? __('Ready to get started?');
    $ctaHighlight = $content['cta_highlight'] ?? __('started');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;
    $formTitle = $content['title'] ?? __('Send a message');
@endphp

<section id="contact-form" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: {{ $bodyFont }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 overflow-hidden" style="box-shadow: 0 4px 30px {{ $secondaryColor }}08;">

            {{-- Left: CTA --}}
            <div
                class="relative min-h-[420px] lg:min-h-[560px] flex items-center overflow-hidden"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                @if($backgroundImage)
                    <img src="{{ $backgroundImage }}" alt="{{ $ctaHeading }}" class="absolute inset-0 w-full h-full object-cover" />
                @else
                    <div class="absolute inset-0" style="background: linear-gradient(145deg, {{ $secondaryColor }}, #1a1a1a);"></div>
                    {{-- Decorative elements --}}
                    <div class="absolute top-8 left-8 w-20 h-20 border-t border-l opacity-10" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute bottom-8 right-8 w-20 h-20 border-b border-r opacity-10" style="border-color: {{ $primaryColor }};"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(145deg, {{ $secondaryColor }}cc 0%, #1a1a1acc 100%);"></div>

                <div class="relative z-10 p-8 lg:p-12 w-full">
                    @if($ctaLabel)
                        <div
                            class="inline-flex items-center gap-2 px-4 py-1.5 text-xs uppercase tracking-[0.2em] font-medium mb-10 transition-all duration-700"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}25;"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $ctaLabel }}
                        </div>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl font-light leading-tight mb-10 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: {{ $headingFont }};"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    @if($ctaHighlight)
                        <div
                            class="flex items-center gap-6 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        >
                            <div>
                                <div class="text-2xl font-light" style="color: {{ $primaryColor }}; font-family: {{ $headingFont }};">24u</div>
                                <div class="text-xs uppercase tracking-wider" style="color: {{ $primaryColor }}60;">{{ __('Response time') }}</div>
                            </div>
                            <div class="w-px h-10" style="background-color: {{ $primaryColor }}25;"></div>
                            <div>
                                <div class="text-2xl font-light" style="color: {{ $primaryColor }}; font-family: {{ $headingFont }};">100%</div>
                                <div class="text-xs uppercase tracking-wider" style="color: {{ $primaryColor }}60;">{{ __('Personal') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div
                class="relative p-8 lg:p-12 flex flex-col justify-center"
                style="background-color: #ffffff;"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                <div
                    class="transition-all duration-700 delay-300"
                    :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                >
                    <div class="mb-8">
                        <h4
                            class="text-2xl sm:text-3xl font-light mb-2"
                            style="color: {{ $headingColor }}; font-family: {{ $headingFont }};"
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
