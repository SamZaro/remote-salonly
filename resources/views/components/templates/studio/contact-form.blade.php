{{--
    Studio Template: Contact Form section
    "Creative Hair Studio" — bold, playful, offset shadows, rotated elements
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $headingFont = $theme['heading_font_family'] ?? 'Montserrat';
    $bodyFont = $theme['font_family'] ?? 'Poppins';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('SAY HI!');
    $ctaHeading = $content['cta_heading'] ?? __("Let's Talk!");
    $ctaHighlight = $content['cta_highlight'] ?? __('Talk!');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Drop a line');
@endphp

<section id="contact-form" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden" style="box-shadow: 10px 10px 0 {{ $secondaryColor }};">

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
                    <div class="absolute inset-0" style="background: linear-gradient(150deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                    {{-- Fun geometric shapes --}}
                    <div class="absolute top-12 right-12 w-24 h-24 rounded-full opacity-20 transform rotate-12" style="border: 4px solid #ffffff;"></div>
                    <div class="absolute bottom-20 left-8 w-16 h-16 opacity-15 transform -rotate-12" style="border: 4px solid #ffffff;"></div>
                    <div class="absolute top-1/3 left-1/3 w-32 h-32 rounded-full opacity-10" style="background-color: {{ $accentColor }};"></div>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(150deg, {{ $secondaryColor }}dd 0%, {{ $primaryColor }}bb 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Playful badge --}}
                    @if($ctaLabel)
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-8 transform -rotate-2 transition-all duration-700"
                            :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-75'"
                            style="background: #ffffff; color: {{ $secondaryColor }};"
                        >
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            {{ $ctaLabel }}
                        </div>
                    @endif

                    <h3
                        class="text-4xl sm:text-5xl lg:text-6xl font-black leading-none mb-8 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', 'Poppins', sans-serif;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span class="inline-block transform -rotate-2" style="color: ' . $accentColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Fun CTA pills --}}
                    @if($ctaHighlight)
                        <div
                            class="flex items-center gap-4 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        >
                            <div
                                class="px-5 py-2.5 rounded-full text-sm font-bold transform rotate-1"
                                style="background-color: {{ $primaryColor }}; color: #ffffff;"
                            >
                                {{ __('Snel antwoord') }}
                            </div>
                            <div
                                class="px-5 py-2.5 rounded-full text-sm font-bold transform -rotate-1"
                                style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }};"
                            >
                                {{ __('No stress') }}
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
                    <div class="mb-8">
                        <h4
                            class="text-2xl sm:text-3xl font-black mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', 'Poppins', sans-serif;"
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
