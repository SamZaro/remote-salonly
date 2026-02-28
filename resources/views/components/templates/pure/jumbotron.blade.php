{{--
    Template-specifieke jumbotron voor Pure (Natural & Wellness Salon)

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
    $title = $content['title'] ?? 'Ontdek De Kracht Van De Natuur';
    $subtitle = $content['subtitle'] ?? 'Waar schoonheid en duurzaamheid samenkomen';
    $ctaText = $content['cta_text'] ?? 'Ontdek Onze Producten';
    $ctaLink = $content['cta_link'] ?? '#services';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
@endphp

<section id="jumbotron" class="relative py-32 lg:py-40 overflow-hidden" style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $accentColor }}10);">
    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Jumbotron background"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}E6, {{ $accentColor }}CC);"></div>
        </div>
    @endif

    {{-- Organic shapes --}}
    <div class="absolute top-0 left-0 w-1/2 h-full opacity-10">
        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $primaryColor }};">
            <path fill="currentColor" d="M45.3,-51.2C58.3,-40.9,68.2,-25.3,71.2,-8.2C74.2,8.9,70.3,27.5,59.5,40.6C48.7,53.7,31,61.3,12.7,65.2C-5.6,69.1,-24.5,69.3,-40.1,61.1C-55.7,52.9,-68,36.3,-72.1,18.1C-76.2,-0.1,-72.1,-19.9,-62,-35.1C-51.9,-50.3,-35.8,-60.9,-19.2,-64.8C-2.6,-68.7,14.5,-65.9,29.9,-59.6C45.3,-53.3,59,-46.5,45.3,-51.2Z" transform="translate(100 100)" />
        </svg>
    </div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Leaf icon --}}
        <div class="flex justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div
                class="w-14 h-14 rounded-full flex items-center justify-center"
                style="background-color: {{ $primaryColor }}20;"
            >
                <svg class="w-7 h-7" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light mb-6 leading-tight"
            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p
            class="text-lg sm:text-xl mb-12 max-w-2xl mx-auto leading-relaxed"
            style="color: {{ $headingColor }}; opacity: 0.7;"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA --}}
        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-medium transition-all duration-300 hover:shadow-lg"
            style="background-color: {{ $primaryColor }}; color: white; opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $ctaText }}
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </a>

        {{-- Eco certifications --}}
        <div class="mt-12 flex flex-wrap items-center justify-center gap-8">
            <div class="flex items-center gap-2 text-sm" style="color: {{ $headingColor }}; opacity: 0.6;">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Eco-Certified
            </div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $headingColor }}; opacity: 0.6;">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                CO2 Neutraal
            </div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $headingColor }}; opacity: 0.6;">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Cruelty Free
            </div>
        </div>
    </div>
</section>
