{{--
    Wave Template: Contact Form section
    "Coastal Minimal" — ocean blues, rounded cards, flowing motion
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';

    // CTA content (left column)
    $ctaLabel = $content['cta_label'] ?? __('Contact');
    $ctaHeading = $content['cta_heading'] ?? __('Laten we in contact komen');
    $ctaHighlight = $content['cta_highlight'] ?? __('contact');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    // Form content (right column)
    $formTitle = $content['title'] ?? __('Stuur een bericht');
@endphp

<section id="contact-form" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-0 rounded-2xl overflow-hidden" style="box-shadow: 0 8px 32px {{ $secondaryColor }}0a;">

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
                    <div class="absolute inset-0" style="background: linear-gradient(160deg, {{ $secondaryColor }}, {{ $primaryColor }});"></div>
                    {{-- Wave pattern overlay --}}
                    <svg class="absolute bottom-0 left-0 right-0 opacity-10" viewBox="0 0 1440 320" preserveAspectRatio="none" style="height: 180px; width: 100%;">
                        <path fill="{{ $accentColor }}" d="M0,160L48,170.7C96,181,192,203,288,192C384,181,480,139,576,133.3C672,128,768,160,864,176C960,192,1056,192,1152,176C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    </svg>
                    <svg class="absolute bottom-0 left-0 right-0 opacity-[0.06]" viewBox="0 0 1440 320" preserveAspectRatio="none" style="height: 220px; width: 100%;">
                        <path fill="#ffffff" d="M0,224L60,213.3C120,203,240,181,360,186.7C480,192,600,224,720,234.7C840,245,960,235,1080,213.3C1200,192,1320,160,1380,144L1440,128L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                    </svg>
                @endif

                <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}dd 0%, {{ $primaryColor }}bb 100%);"></div>

                {{-- Content --}}
                <div class="relative z-10 p-8 lg:p-12 w-full">
                    {{-- Accent circle --}}
                    <div
                        class="w-14 h-14 rounded-full flex items-center justify-center mb-8 transition-all duration-700"
                        :class="shown ? 'opacity-100 scale-100' : 'opacity-0 scale-50'"
                        style="background-color: {{ $accentColor }}30; border: 2px solid {{ $accentColor }}60;"
                    >
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>

                    @if($ctaLabel)
                        <span
                            class="block text-xs font-medium uppercase tracking-[0.2em] mb-4 transition-all duration-700 delay-100"
                            :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                            style="color: {{ $accentColor }};"
                        >
                            {{ $ctaLabel }}
                        </span>
                    @endif

                    <h3
                        class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-tight mb-6 transition-all duration-700 delay-200"
                        :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $accentColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    {{-- Decorative dots --}}
                    @if($ctaHighlight)
                        <div
                            class="flex items-center gap-2 transition-all duration-700 delay-500"
                            :class="shown ? 'opacity-100' : 'opacity-0'"
                        >
                            <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }};"></div>
                            <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }}80;"></div>
                            <div class="w-2 h-2 rounded-full" style="background-color: {{ $accentColor }}40;"></div>
                            <span class="text-xs ml-2" style="color: {{ $accentColor }}80;">{{ $ctaHighlight }}</span>
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
                            class="text-xl sm:text-2xl mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
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
