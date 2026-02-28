{{--
    Urban Template: CTA Section
    Dark section — huge editorial heading, bold gold CTA
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title           = $content['title'] ?? 'Klaar voor een nieuwe look?';
    $subtitle        = $content['subtitle'] ?? 'Boek vandaag nog je afspraak en ervaar het verschil';
    $ctaText         = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink         = $content['cta_link'] ?? '#contact';
    $phone           = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont    = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section class="relative py-24 lg:py-40 overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Background image with strong overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-25" />
            <div class="absolute inset-0" style="background: {{ $secondaryColor }}cc;"></div>
        </div>
    @endif

    {{-- Gold border lines --}}
    <div class="absolute top-0 inset-x-0 h-0.5" style="background-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 inset-x-0 h-0.5" style="background-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Eyebrow --}}
        <div
            class="flex items-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
            style="opacity: 0; transform: translateX(-20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                Boek nu
            </span>
        </div>

        {{-- Huge heading --}}
        <h2
            class="font-black uppercase leading-[0.85] mb-10"
            style="
                font-family: '{{ $headingFont }}';
                font-size: clamp(2.8rem, 7vw, 6.5rem);
                letter-spacing: -0.03em;
                color: #ffffff;
                opacity: 0;
                transform: translateY(25px);
                transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;
            "
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p
            class="text-xl max-w-xl mb-12"
            style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA buttons --}}
        <div
            class="flex flex-wrap gap-4 items-center"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(15px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm transition-all hover:opacity-85"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm border transition-all hover:bg-white/5"
                    style="border-color: rgba(255,255,255,0.2); color: #ffffff; font-family: '{{ $bodyFont }}';"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel direct
                </a>
            @endif
        </div>
    </div>
</section>
