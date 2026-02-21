{{--
    Default fallback: Contact Form section
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Stuur ons een bericht');
    $subtitle = $content['subtitle'] ?? __('Heeft u een vraag? Wij helpen u graag verder.');
    $primaryColor = $theme['primary_color'] ?? '#3b82f6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $headingColor = $theme['heading_color'] ?? '#111827';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="contact-form" class="py-20 px-4" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-10">
            <h2
                class="text-3xl md:text-4xl font-bold mb-4"
                style="
                    font-family: {{ $theme['heading_font_family'] ?? 'inherit' }};
                    color: {{ $headingColor }};
                "
            >
                {{ $title }}
            </h2>
            <p class="text-lg" style="color: {{ $textColor }}; opacity: 0.7;">
                {{ $subtitle }}
            </p>
        </div>

        <div
            class="p-8 rounded-lg"
            style="background-color: {{ $theme['secondary_color'] ?? '#f3f4f6' }}15;"
        >
            <livewire:contact-form :theme="$theme" />
        </div>
    </div>
</section>
