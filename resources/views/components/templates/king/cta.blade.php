{{--
    King Template: CTA Section
    "Royal Throne" — dark bg, bold centered call-to-action, diamond accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Ready to Rule Your Look?');
    $subtitle = $content['subtitle'] ?? __('Book your appointment and experience the royal treatment');
    $ctaText = $content['cta_text'] ?? __('Book Your Throne');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    {{-- Background image as subtle texture --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" style="opacity: 0.1;" />
        </div>
    @endif

    {{-- Decorative diagonal lines --}}
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: repeating-linear-gradient(45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 60px);"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Crown icon --}}
        <div
            class="flex items-center justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <svg class="w-5 h-5 mx-3" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2 19h20v2H2v-2zm2-5l4-7 4 4 4-9 4 8v4H4v0z"/>
            </svg>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-[3.5rem] leading-[1.1] mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {{ $title }}
        </h2>

        {{-- Crown divider --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
        >
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-2.5 h-2.5 rotate-45" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
        </div>

        {{-- Subtitle --}}
        <p
            class="text-[15px] sm:text-base max-w-xl mx-auto leading-relaxed mb-12"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}60; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.4s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-10 py-4 text-[12px] font-bold uppercase tracking-[0.25em] transition-all duration-300 hover:brightness-110"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; box-shadow: 0 4px 24px {{ $primaryColor }}25;"
            >
                {{ $ctaText }}
                <svg class="w-3.5 h-3.5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-10 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                    style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                >
                    <svg class="w-3.5 h-3.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ __('Call Us') }}
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                    style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                >
                    {{ __('Our Services') }}
                </a>
            @endif
        </div>

        {{-- Bottom features --}}
        <div
            class="pt-10"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.55s; border-top: 1px solid {{ $backgroundColor }}10;"
        >
            <div class="flex items-center justify-center gap-0 flex-wrap">
                <span class="text-[12px] uppercase tracking-[0.15em]" style="color: {{ $backgroundColor }}40;">
                    {{ __('Walk-ins welcome') }}
                </span>
                <span class="mx-4 w-1.5 h-1.5 rotate-45 inline-block" style="background-color: {{ $primaryColor }};"></span>
                <span class="text-[12px] uppercase tracking-[0.15em]" style="color: {{ $backgroundColor }}40;">
                    {{ __('Premium products') }}
                </span>
                <span class="mx-4 w-1.5 h-1.5 rotate-45 inline-block" style="background-color: {{ $primaryColor }};"></span>
                <span class="text-[12px] uppercase tracking-[0.15em]" style="color: {{ $backgroundColor }}40;">
                    {{ __('Master barbers') }}
                </span>
            </div>
        </div>
    </div>
</section>
