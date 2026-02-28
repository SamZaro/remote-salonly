{{--
    Template-specifieke CTA voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Klaar Voor Pure Verzorging?';
    $subtitle = $content['subtitle'] ?? 'Boek nu je natuurlijke beauty moment';
    $description = $content['description'] ?? 'Ervaar het verschil van 100% natuurlijke haarverzorging. Goed voor jou, goed voor de planeet.';
    $ctaText = $content['cta_text'] ?? 'Maak Een Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $secondaryCtaText = $content['secondary_cta_text'] ?? 'Bel Ons';
    $secondaryCtaLink = $content['secondary_cta_link'] ?? 'tel:+31612345678';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="CTA background"
                class="w-full h-full object-cover opacity-20"
            />
        </div>
    @endif

    {{-- Organic shapes --}}
    <div class="absolute top-0 left-0 w-1/2 h-full opacity-5">
        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $primaryColor }};">
            <path fill="currentColor" d="M45.3,-51.2C58.3,-40.9,68.2,-25.3,71.2,-8.2C74.2,8.9,70.3,27.5,59.5,40.6C48.7,53.7,31,61.3,12.7,65.2C-5.6,69.1,-24.5,69.3,-40.1,61.1C-55.7,52.9,-68,36.3,-72.1,18.1C-76.2,-0.1,-72.1,-19.9,-62,-35.1C-51.9,-50.3,-35.8,-60.9,-19.2,-64.8C-2.6,-68.7,14.5,-65.9,29.9,-59.6C45.3,-53.3,59,-46.5,45.3,-51.2Z" transform="translate(100 100)" />
        </svg>
    </div>
    <div class="absolute bottom-0 right-0 w-1/3 h-2/3 opacity-5">
        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $accentColor }};">
            <path fill="currentColor" d="M39.5,-48.7C52.9,-37.2,66.6,-26.4,72.1,-11.8C77.6,2.8,74.9,21.2,65.4,34.6C55.9,48,39.6,56.4,22.8,61.6C6,66.8,-11.3,68.8,-27.3,63.5C-43.3,58.2,-58,45.6,-65.7,29.5C-73.4,13.4,-74.1,-6.2,-68,-23.1C-61.9,-40,-49,-54.2,-34.4,-65.4C-19.8,-76.6,-3.5,-84.8,9.6,-82.1C22.7,-79.4,26.1,-60.2,39.5,-48.7Z" transform="translate(100 100)" />
        </svg>
    </div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Leaf icon --}}
        <div class="flex justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div
                class="w-16 h-16 rounded-full flex items-center justify-center"
                style="background-color: {{ $primaryColor }}20;"
            >
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 leading-tight"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p
            class="text-xl mb-4"
            style="color: {{ $primaryColor }};"
        >
            {{ $subtitle }}
        </p>

        {{-- Description --}}
        <p
            class="text-base mb-12 max-w-2xl mx-auto leading-relaxed"
            style="color: {{ $backgroundColor }}; opacity: 0.8;"
        >
            {{ $description }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-medium transition-all duration-300 hover:shadow-lg"
                style="background-color: {{ $primaryColor }}; color: white;"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="{{ $secondaryCtaLink }}"
                class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-medium border-2 transition-all duration-300 hover:bg-white/10"
                style="border-color: {{ $backgroundColor }}40; color: {{ $backgroundColor }};"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $secondaryCtaText }}
            </a>
        </div>

        {{-- Eco badges --}}
        <div class="mt-12 pt-8 border-t flex flex-wrap items-center justify-center gap-6" style="border-color: {{ $backgroundColor }}15;">
            <div class="flex items-center gap-2 text-sm" style="color: {{ $backgroundColor }}; opacity: 0.7;">
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Vegan
            </div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $backgroundColor }}; opacity: 0.7;">
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Cruelty-free
            </div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $backgroundColor }}; opacity: 0.7;">
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Duurzaam
            </div>
        </div>
    </div>
</section>
