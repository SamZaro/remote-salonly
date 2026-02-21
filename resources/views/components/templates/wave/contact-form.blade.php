{{--
    Wave Template: Contact Form section
    "Coastal Minimal" — rounded cards, wave accent, Livewire form
    Props: $content, $theme
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
@endphp

<section id="contact-form" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="rounded-2xl p-8 lg:p-12" style="background-color: #ffffff; box-shadow: 0 4px 20px {{ $secondaryColor }}06;">
                <div class="text-center mb-8">
                    <h3
                        class="text-2xl mb-2"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                    >
                        {{ __('Stuur een bericht') }}
                    </h3>
                    <p class="text-[14px]" style="color: {{ $textColor }};">
                        {{ __('Vragen of opmerkingen? Wij horen graag van u.') }}
                    </p>
                </div>

                <livewire:contact-form :theme="[
                    'primary_color' => $primaryColor,
                    'secondary_color' => $secondaryColor,
                    'background_color' => $backgroundColor,
                    'text_color' => $textColor,
                    'heading_color' => $headingColor,
                ]" />
            </div>
        </div>
    </div>
</section>
