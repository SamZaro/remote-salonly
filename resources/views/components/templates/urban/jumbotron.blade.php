{{--
    Urban Template: Jumbotron Section
    Dark full-width with background image — huge editorial heading, one CTA
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title           = $content['title'] ?? 'WORD DE BESTE<br>VERSIE VAN JEZELF';
    $subtitle        = $content['subtitle'] ?? 'Premium grooming voor de moderne man';
    $ctaText         = $content['cta_text'] ?? 'Boek Nu';
    $ctaLink         = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont    = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section id="jumbotron" class="relative py-28 lg:py-44 overflow-hidden flex items-center">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: {{ $secondaryColor }}e0;"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
    @endif

    {{-- Full-width gold top border --}}
    <div class="absolute top-0 inset-x-0 h-0.5" style="background-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-0 inset-x-0 h-0.5" style="background-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 w-full mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Eyebrow --}}
        <div
            class="flex items-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
            style="opacity: 0; transform: translateX(-20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                {{ $subtitle }}
            </span>
        </div>

        {{-- Heading --}}
        <h2
            class="font-black uppercase leading-[0.85] mb-14"
            style="
                font-family: '{{ $headingFont }}';
                font-size: clamp(3rem, 9vw, 8rem);
                letter-spacing: -0.03em;
                color: #ffffff;
                opacity: 0;
                transform: translateY(30px);
                transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;
            "
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h2>

        {{-- CTA --}}
        <div
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(15px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center gap-4 px-12 py-6 font-black uppercase tracking-widest text-lg transition-all duration-300 hover:opacity-85"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}'; letter-spacing: 0.1em;"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
