{{--
    Pure Template: Contact Form Section
    Natural & Botanical — split layout with botanical decorations
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Neem contact op');
    $ctaHeading = $content['cta_heading'] ?? __('Natuurlijke verzorging begint met een gesprek');
    $ctaHighlight = $content['cta_highlight'] ?? __('verzorging');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Stuur ons een bericht');
@endphp

<section id="contact-form" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 rounded-sm overflow-hidden" style="box-shadow: 0 4px 24px {{ $primaryColor }}0a;">

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
                    <div class="absolute inset-0" style="background: linear-gradient(170deg, {{ $secondaryColor }}, {{ $secondaryColor }}dd);"></div>
                    {{-- Organic leaf-like shapes --}}
                    <div class="absolute top-16 right-16 w-40 h-40 rounded-full opacity-[0.06]" style="background-color: {{ $accentColor }};"></div>
                    <div class="absolute top-32 right-8 w-20 h-20 rounded-full opacity-[0.04]" style="background-color: {{ $accentColor }};"></div>
                    <div class="absolute bottom-24 left-10 w-28 h-28 rounded-full opacity-[0.05]" style="background-color: {{ $accentColor }};"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $secondaryColor }}dd 0%, {{ $secondaryColor }}99 40%, {{ $secondaryColor }}50 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Leaf/nature badge --}}
                    @if($ctaLabel)
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-8 transition-all duration-700"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="background-color: {{ $primaryColor }}25; color: {{ $accentColor }};"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                            {{ $ctaLabel }}
                        </div>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-5xl font-light leading-tight mb-8 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', Georgia, serif;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span class="font-semibold" style="color: ' . $accentColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Trust indicators --}}
                    @if($ctaHighlight)
                        <div
                            class="flex items-center gap-3 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                        >
                            <div class="flex -space-x-1">
                                <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }};"></div>
                                <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }}80;"></div>
                                <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }}50;"></div>
                            </div>
                            <span class="text-xs" style="color: {{ $accentColor }};">{{ $ctaHighlight }}</span>
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
                    <div class="mb-8">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-medium mb-4"
                            style="background-color: {{ $primaryColor }}12; color: {{ $primaryColor }};"
                        >
                            {{ __('Formulier') }}
                        </div>
                        <h4
                            class="text-xl sm:text-2xl font-light mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
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
