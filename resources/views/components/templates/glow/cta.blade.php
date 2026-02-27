{{--
    Glow Template: CTA Section
    Warm minimalist — clean call-to-action, no decorative icons or feature badges
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar voor een afspraak?';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog en laat je verwennen door ons team';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section class="relative py-24 lg:py-32 overflow-hidden">
    <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>

    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-15" />
        </div>
    @endif

    <div class="relative z-10 mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center">
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6"
            style="color: {{ $backgroundColor }}; font-family: 'Raleway', sans-serif;"
        >
            {{ $title }}
        </h2>

        <p class="text-xl mb-10 max-w-xl mx-auto" style="color: {{ $primaryColor }};">
            {{ $subtitle }}
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center px-8 py-4 text-sm font-semibold tracking-wide uppercase transition-opacity hover:opacity-90"
                style="background-color: {{ $backgroundColor }}; color: {{ $secondaryColor }}; border-radius: 6px;"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center px-8 py-4 text-sm font-semibold tracking-wide uppercase transition-opacity hover:opacity-80"
                    style="border: 1.5px solid {{ $primaryColor }}40; color: {{ $backgroundColor }}; border-radius: 6px;"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @endif
        </div>
    </div>
</section>
