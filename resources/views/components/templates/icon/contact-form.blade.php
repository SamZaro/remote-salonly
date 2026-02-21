{{--
    Icon Template: Contact Form section
    "Warm Atelier" — gold accents, editorial styling
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
@endphp

<section id="contact-form" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
        >
            <div
                class="relative p-8 lg:p-12"
                style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03);"
            >
                {{-- Label above form --}}
                <div class="text-center mb-8">
                    <div class="inline-flex items-center gap-3 mb-6">
                        <span class="w-8 h-px" style="background-color: {{ $primaryColor }};"></span>
                        <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                            Stuur ons een bericht
                        </span>
                        <span class="w-8 h-px" style="background-color: {{ $primaryColor }};"></span>
                    </div>
                    <h3
                        class="text-2xl sm:text-3xl mb-3"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                    >
                        {{ __('Neem Contact Op') }}
                    </h3>
                    <p class="text-[14px] leading-relaxed" style="color: {{ $textColor }};">
                        {{ __('Heeft u een vraag of wilt u een afspraak maken? Laat het ons weten!') }}
                    </p>
                </div>

                {{-- Gold divider --}}
                <div class="flex items-center justify-center gap-0 mb-8">
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
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
</section>
