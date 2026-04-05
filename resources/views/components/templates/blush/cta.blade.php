{{--
    Blush Template: CTA Section
    Elegant nail studio — warm gold background with centered CTA
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme'   => [],
    'section' => null,
])

@php
    $title   = $content['title']    ?? __('Ready to glow?');
    $subtitle = $content['subtitle'] ?? __('Book a treatment today');
    $ctaText = $content['cta_text'] ?? __('Book a Treatment');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor   = $theme['primary_color']   ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color']  ?? '#0F0F0F';
    $accentColor    = $theme['accent_color']     ?? '#D4C4A0';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $primaryColor }}; font-family: {{ $bodyFont }};">

    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-15" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}dd 0%, {{ $primaryColor }}bb 100%);"></div>
        </div>
    @else
        {{-- Subtle pattern --}}
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: radial-gradient(circle at 1px 1px, {{ $secondaryColor }} 1px, transparent 0); background-size: 32px 32px;"></div>
    @endif

    {{-- Corner accents --}}
    <div class="absolute top-6 left-6 w-16 h-16 border-t border-l opacity-20 hidden lg:block" style="border-color: {{ $secondaryColor }};"></div>
    <div class="absolute bottom-6 right-6 w-16 h-16 border-b border-r opacity-20 hidden lg:block" style="border-color: {{ $secondaryColor }};"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">

        {{-- Sparkle icon --}}
        <div class="flex items-center justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <svg class="w-6 h-6" style="color: {{ $secondaryColor }}60;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
            </svg>
        </div>

        {{-- Title --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-light leading-tight mb-4 italic"
            style="color: {{ $secondaryColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(16px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p
            class="text-lg sm:text-xl mb-12 font-light"
            style="color: {{ $secondaryColor }}90; font-family: {{ $bodyFont }}; opacity: 0; transform: translateY(12px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA buttons --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center gap-3 px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium transition-all duration-500 hover:scale-105"
                style="background-color: {{ $secondaryColor }}; color: {{ $primaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            <a
                href="#services"
                class="inline-flex items-center justify-center gap-2 px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium border transition-all duration-500 hover:bg-black/5"
                style="border-color: {{ $secondaryColor }}40; color: {{ $secondaryColor }};"
            >
                {{ __('Our services') }}
            </a>
        </div>

    </div>
</section>
