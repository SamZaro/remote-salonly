{{--
    Fade Template: Jumbotron Section
    Dark section — centered layout, gold accent lines, large heading
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title           = $content['title'] ?? __('Experience the Difference');
    $subtitle        = $content['subtitle'] ?? __('Traditional craftsmanship, modern look');
    $ctaText         = $content['cta_text'] ?? __('Plan your visit');
    $ctaLink         = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont    = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

<section id="jumbotron" class="relative py-28 lg:py-44 overflow-hidden flex items-center justify-center text-center">
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: rgba(15,15,15,0.88);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    {{-- Gold top + bottom border --}}
    <div class="absolute top-0 inset-x-0 h-1" style="background-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 inset-x-0 h-1" style="background-color: {{ $primaryColor }};"></div>

    <div class="relative z-10 w-full mx-auto max-w-5xl px-6 sm:px-8 lg:px-12">

        {{-- Eyebrow --}}
        <div
            class="flex items-center justify-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                {{ $subtitle }}
            </span>
            <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Heading --}}
        <h2
            class="font-bold uppercase leading-[0.85] mb-12"
            style="
                font-family: '{{ $headingFont }}';
                font-size: clamp(3rem, 9vw, 8rem);
                letter-spacing: -0.03em;
                color: #ffffff;
                opacity: 0;
                transform: translateY(24px);
                transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;
            "
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h2>

        {{-- CTA --}}
        <div
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center gap-4 px-10 py-5 font-semibold uppercase tracking-widest text-sm transition-all duration-300 hover:opacity-85"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
