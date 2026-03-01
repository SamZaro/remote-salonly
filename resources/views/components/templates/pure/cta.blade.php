{{--
    Pure Template: CTA Section
    Natural & Botanical — light call-to-action with teal accents, dual buttons, eco badges
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar Voor Pure Verzorging?';
    $subtitle = $content['subtitle'] ?? 'Boek nu je natuurlijke beauty moment';
    $description = $content['description'] ?? 'Ervaar het verschil van 100% natuurlijke haarverzorging. Goed voor jou, goed voor de planeet.';
    $ctaText = $content['cta_text'] ?? 'Maak Een Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $secondaryCtaText = $content['secondary_cta_text'] ?? 'Bel Ons';
    $secondaryCtaLink = $content['secondary_cta_link'] ?? 'tel:+31612345678';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $accentColor }}15;">
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-10" />
        </div>
    @endif

    {{-- Botanical leaf decoration --}}
    <div class="absolute top-8 right-8 opacity-[0.06]">
        <svg class="w-40 h-40" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
            <path d="M50 35 L30 25" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
            <path d="M50 50 L70 38" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
            <path d="M50 65 L28 55" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
        </svg>
    </div>
    <div class="absolute bottom-12 left-12 opacity-[0.05]">
        <svg class="w-32 h-32" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
        </svg>
    </div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Accent line --}}
        <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>

        {{-- Subtitle label --}}
        <span
            class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block"
            style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            {{ $subtitle }}
        </span>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {{ $title }}
        </h2>

        {{-- Description --}}
        <p
            class="text-lg mb-12 max-w-2xl mx-auto leading-relaxed"
            style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
        >
            {{ $description }}
        </p>

        {{-- CTA Buttons --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-8 py-4 rounded-none text-sm font-semibold tracking-widest uppercase transition-all duration-300 hover:shadow-lg"
                style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
                onmouseover="this.style.backgroundColor='{{ $secondaryColor }}'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a
                href="{{ $secondaryCtaLink }}"
                class="inline-flex items-center justify-center px-8 py-4 rounded-none text-sm font-semibold tracking-widest uppercase transition-all duration-300"
                style="border: 1.5px solid {{ $primaryColor }}; color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
                onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $primaryColor }}';"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $secondaryCtaText }}
            </a>
        </div>

        {{-- Eco badges --}}
        <div class="mt-12 pt-8 flex flex-wrap items-center justify-center gap-6" style="border-top: 1px solid {{ $primaryColor }}20;">
            <div class="flex items-center gap-2 text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Vegan
            </div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Cruelty-free
            </div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Duurzaam
            </div>
        </div>
    </div>
</section>
