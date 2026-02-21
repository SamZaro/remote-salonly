{{--
    Blossom Template: Contact Form section
    Formulier introductie + Livewire contact form
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="contact-form" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <div
            class="p-8 lg:p-12 rounded-3xl relative overflow-hidden"
            style="background: linear-gradient(135deg, {{ $primaryColor }}08, {{ $secondaryColor }}08); border: 1px solid {{ $primaryColor }}20;"
        >
            <div class="relative">
                <div class="text-center mb-8">
                    <h3
                        class="text-2xl font-bold mb-3"
                        style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ __('Stuur ons een bericht') }}
                    </h3>
                    <p class="text-sm" style="color: {{ $textColor }}; opacity: 0.7;">
                        {{ __('Heeft u een vraag? Wij helpen u graag verder.') }}
                    </p>
                </div>

                <livewire:contact-form :theme="[
                    'primary_color' => $primaryColor,
                    'secondary_color' => $secondaryColor,
                    'background_color' => $backgroundColor,
                    'text_color' => $textColor,
                    'heading_color' => $textColor,
                ]" />
            </div>
        </div>
    </div>
</section>
