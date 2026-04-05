{{--
    Fade Template: CTA Section
    Gold fill background — dark text, signature booking section
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title           = $content['title'] ?? __('Ready for a new look?');
    $subtitle        = $content['subtitle'] ?? __('Book your spot today');
    $ctaText         = $content['cta_text'] ?? __('Book Now');
    $ctaLink         = $content['cta_link'] ?? '#contact';
    $phone           = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont    = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

<section class="relative py-24 lg:py-40 overflow-hidden" style="background-color: {{ $primaryColor }};">
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-10" />
        </div>
    @endif

    {{-- Subtle diagonal stripe texture --}}
    <div class="absolute inset-0 opacity-[0.04]" style="background-image: repeating-linear-gradient(45deg, {{ $secondaryColor }} 0, {{ $secondaryColor }} 1px, transparent 0, transparent 50%); background-size: 16px 16px;"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Eyebrow --}}
        <div
            class="flex items-center gap-3 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
            style="opacity: 0; transform: translateX(-20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $secondaryColor }}40;"></div>
            <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $secondaryColor }}90; font-family: '{{ $bodyFont }}';">
                {{ __('Book now') }}
            </span>
        </div>

        {{-- Heading --}}
        <h2
            class="font-bold uppercase leading-[0.85] mb-8"
            style="
                font-family: '{{ $headingFont }}';
                font-size: clamp(2.8rem, 7vw, 6.5rem);
                letter-spacing: -0.03em;
                color: {{ $secondaryColor }};
                opacity: 0;
                transform: translateY(24px);
                transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.12s;
            "
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p
            class="text-xl max-w-xl mb-12 font-light"
            style="color: {{ $secondaryColor }}90; font-family: '{{ $bodyFont }}';"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA buttons --}}
        <div
            class="flex flex-wrap gap-4 items-center"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center gap-3 px-9 py-5 font-semibold uppercase tracking-widest text-sm transition-all hover:opacity-90"
                style="background-color: {{ $secondaryColor }}; color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center gap-3 px-9 py-5 font-semibold uppercase tracking-widest text-sm border-2 transition-all"
                    style="border-color: {{ $secondaryColor }}40; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                    onmouseover="this.style.borderColor='{{ $secondaryColor }}'; this.style.backgroundColor='{{ $secondaryColor }}15'"
                    onmouseout="this.style.borderColor='{{ $secondaryColor }}40'; this.style.backgroundColor='transparent'"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ __('Call directly') }}
                </a>
            @endif
        </div>
    </div>
</section>
