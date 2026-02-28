{{--
    Template-specifieke CTA voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Ready For Your Glow Up?';
    $description = $content['description'] ?? 'Book vandaag nog en laat ons jouw nieuwe signature look creëren!';
    $ctaText = $content['cta_text'] ?? 'Book Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $secondaryCtaText = $content['secondary_cta_text'] ?? 'Volg ons op Instagram';
    $secondaryCtaLink = $content['secondary_cta_link'] ?? '#';

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
    $headingFont = $theme['heading_font_family'] ?? 'Abril Fatface';
    $bodyFont = $theme['font_family'] ?? 'Nunito';
@endphp

<section id="cta" class="py-24 lg:py-32 relative overflow-hidden" style="background: {{ $primaryColor }};">
    {{-- Geometric patterns --}}
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(white 3px, transparent 3px); background-size: 50px 50px;"></div>

    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            {{-- Badge --}}
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-8 transform -rotate-2"
                style="background: white; color: {{ $primaryColor }};"
            >
                <svg class="w-5 h-5 animate-spin" style="animation-duration: 3s;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                LET'S GO!
            </div>

            {{-- Title --}}
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6 text-white leading-tight"
                style="font-family: '{{ $headingFont }}', sans-serif;"
            >
                {{ $title }}
            </h2>

            {{-- Description --}}
            <p class="text-xl mb-10 max-w-2xl mx-auto" style="color: white; opacity: 0.9;">
                {{ $description }}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center px-10 py-5 text-lg font-bold rounded-full transition-all duration-300 hover:scale-105 hover:-rotate-1"
                    style="background: white; color: {{ $primaryColor }}; box-shadow: 6px 6px 0 {{ $secondaryColor }};"
                >
                    {{ $ctaText }}
                    <svg class="w-6 h-6 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a
                    href="{{ $secondaryCtaLink }}"
                    class="inline-flex items-center justify-center px-8 py-5 text-lg font-bold rounded-full transition-all duration-300 border-3 hover:scale-105"
                    style="border: 3px solid white; color: white;"
                >
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    {{ $secondaryCtaText }}
                </a>
            </div>

            {{-- Fun stats --}}
            <div class="mt-16 grid grid-cols-3 gap-8 max-w-xl mx-auto">
                @foreach([
                    ['number' => '1.5K+', 'label' => 'Happy Clients'],
                    ['number' => '10+', 'label' => 'Years Experience'],
                    ['number' => '50+', 'label' => 'Awards Won'],
                ] as $stat)
                    <div class="text-center">
                        <p class="text-3xl font-black text-white">{{ $stat['number'] }}</p>
                        <p class="text-sm text-white opacity-80">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
