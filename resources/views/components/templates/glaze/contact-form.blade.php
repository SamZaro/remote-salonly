{{--
    Glaze Template: Contact Form Section
    Two-column layout: CTA left, Livewire form right
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    $ctaLabel = $content['cta_label'] ?? __('Get in touch');
    $ctaHeading = $content['cta_heading'] ?? __('Ready to get started?');
    $ctaHighlight = $content['cta_highlight'] ?? __('started');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    $formTitle = $content['title'] ?? __('Send a message');
@endphp

<section id="contact-form" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 rounded-2xl overflow-hidden" style="box-shadow: 0 8px 40px rgba(0,0,0,0.06);">

            {{-- Left: CTA --}}
            <div
                class="relative min-h-[420px] lg:min-h-[560px] flex items-center overflow-hidden"
                x-data="{ shown: false }"
                x-intersect.once="shown = true"
            >
                @if($backgroundImage)
                    <img src="{{ $backgroundImage }}" alt="{{ $ctaHeading }}" class="absolute inset-0 w-full h-full object-cover" />
                @else
                    <div class="absolute inset-0" style="background: linear-gradient(145deg, {{ $secondaryColor }}, {{ $primaryColor }}40);"></div>
                    {{-- Decorative circles --}}
                    <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full opacity-10" style="border: 2px solid {{ $accentColor }};"></div>
                    <div class="absolute -bottom-12 -left-12 w-48 h-48 rounded-full opacity-[0.06]" style="border: 2px solid {{ $accentColor }};"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(145deg, {{ $secondaryColor }}cc 0%, {{ $primaryColor }}60 100%);"></div>

                <div class="relative z-10 p-8 lg:p-12 w-full">
                    @if($ctaLabel)
                        <div
                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold mb-8 transition-all duration-700"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="background-color: {{ $accentColor }}20; color: {{ $accentColor }}; border: 1px solid {{ $accentColor }}30;"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $ctaLabel }}
                        </div>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-8 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', sans-serif;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $accentColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
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
                                <div class="text-2xl font-extrabold text-white">24u</div>
                                <div class="text-xs" style="color: {{ $accentColor }}90;">{{ __('Response time') }}</div>
                            </div>
                            <div class="w-px h-10" style="background-color: {{ $accentColor }}30;"></div>
                            <div>
                                <div class="text-2xl font-extrabold text-white">100%</div>
                                <div class="text-xs" style="color: {{ $accentColor }}90;">{{ __('Personal') }}</div>
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
                            class="text-xl sm:text-2xl font-extrabold mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
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
