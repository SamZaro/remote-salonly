{{--
    Fade Template: Contact Form Section
    Split layout — dark left CTA panel + warm cream form right panel
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $ctaLabel        = $content['cta_label'] ?? __('Contact');
    $ctaHeading      = $content['cta_heading'] ?? __('Let us hear from you');
    $ctaHighlight    = $content['cta_highlight'] ?? __('hear');
    $formTitle       = $content['title'] ?? __('Send a message');
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor     = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

<section id="contact-form" style="background-color: {{ $backgroundColor }};">
    <div class="grid lg:grid-cols-2 min-h-[600px]">

        {{-- Left: dark editorial panel --}}
        <div
            class="relative flex items-center overflow-hidden min-h-[360px] lg:min-h-auto"
            x-data="{ shown: false }"
            x-intersect.once="shown = true"
        >
            @if($backgroundImage)
                <img src="{{ $backgroundImage }}" alt="{{ $ctaHeading }}" class="absolute inset-0 w-full h-full object-cover" />
            @else
                <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
            @endif
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(15,15,15,0.95) 0%, rgba(15,15,15,0.85) 100%);"></div>

            {{-- Gold top accent bar --}}
            <div class="absolute top-0 left-0 right-0 h-1" style="background-color: {{ $primaryColor }};"></div>

            <div class="relative z-10 px-10 lg:px-14 py-16 w-full">
                <div
                    class="transition-all duration-700"
                    :class="shown ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-8'"
                >
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">{{ $ctaLabel }}</span>
                    </div>

                    <h3
                        class="font-bold uppercase leading-[0.85] mb-8"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(2rem, 4vw, 3.5rem); letter-spacing: -0.02em; color: #ffffff;"
                    >
                        @if($ctaHighlight && str_contains($ctaHeading, $ctaHighlight))
                            {!! str_replace($ctaHighlight, '<span style="color: ' . $primaryColor . ';">' . $ctaHighlight . '</span>', e($ctaHeading)) !!}
                        @else
                            {{ $ctaHeading }}
                        @endif
                    </h3>

                    <div class="flex items-center gap-4">
                        <div class="w-14 h-px" style="background-color: rgba(200,184,138,0.2);"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: form panel --}}
        <div
            class="relative flex flex-col justify-center px-8 sm:px-12 lg:px-14 py-14"
            style="background-color: {{ $backgroundColor }};"
            x-data="{ shown: false }"
            x-intersect.once="shown = true"
        >
            <div
                class="transition-all duration-700 delay-200"
                :class="shown ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
            >
                <h4
                    class="font-bold uppercase leading-[0.85] mb-2"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(1.6rem, 3vw, 2.2rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
                >
                    {{ $formTitle }}
                </h4>
                <div class="w-10 h-0.5 mb-8" style="background-color: {{ $primaryColor }};"></div>

                <livewire:contact-form :theme="[
                    'primary_color'        => $primaryColor,
                    'secondary_color'      => $secondaryColor,
                    'accent_color'         => $accentColor,
                    'background_color'     => $backgroundColor,
                    'text_color'           => $textColor,
                    'heading_color'        => $headingColor,
                    'heading_font_family'  => $headingFont,
                    'font_family'          => $bodyFont,
                ]" />
            </div>
        </div>
    </div>
</section>
