{{--
    Template-specifieke CTA sectie voor Blossom (Luxury Beauty Salon)

    Call to action met "Maak Afspraak" button
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Klaar om te stralen?';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog jouw afspraak en laat je verwennen door ons team van experts';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section class="relative py-24 lg:py-32 overflow-hidden">
    {{-- Gradient background --}}
    <div
        class="absolute inset-0"
        style="background: linear-gradient(135deg, {{ $primaryColor }} 0%, {{ $secondaryColor }} 100%);"
    ></div>

    {{-- Background image overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Background"
                class="w-full h-full object-cover opacity-15"
            />
        </div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Decorative icon --}}
        <div class="flex justify-center mb-8">
            <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold mb-6 text-white"
            style="font-family: '{{ $headingFont }}', Georgia, serif;"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p class="text-lg sm:text-xl mb-12 max-w-2xl mx-auto text-white/80">
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-10 py-5 text-base font-semibold rounded-full transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                style="background-color: white; color: {{ $primaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-semibold rounded-full border-2 border-white/30 text-white transition-all duration-300 hover:bg-white/10"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-semibold rounded-full border-2 border-white/30 text-white transition-all duration-300 hover:bg-white/10"
                >
                    Bekijk services
                </a>
            @endif
        </div>

        {{-- Features --}}
        <div class="flex flex-wrap items-center justify-center gap-6 mt-14 pt-10 border-t border-white/20">
            <div class="flex items-center gap-2 text-white/80">
                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm">Gratis consult</span>
            </div>
            <div class="flex items-center gap-2 text-white/80">
                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm">Premium producten</span>
            </div>
            <div class="flex items-center gap-2 text-white/80">
                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm">Ontspannen sfeer</span>
            </div>
        </div>
    </div>
</section>
