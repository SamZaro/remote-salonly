{{--
    Template-specifieke CTA sectie voor Razor (Barbershop)

    Call to action met "Maak Afspraak" button
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Klaar voor een nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog je afspraak en ervaar het verschil';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $secondaryCtaText = $content['secondary_cta_text'] ?? 'Bel direct';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';
@endphp

<section class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Background image with overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Background"
                class="w-full h-full object-cover opacity-30"
            />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}ee 0%, {{ $secondaryColor }}cc 100%);"></div>
        </div>
    @endif

    {{-- Decorative elements --}}
    <div class="absolute inset-0 z-0 opacity-5">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(90deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 1px, transparent 100px);"></div>
    </div>

    {{-- Decorative corners --}}
    <div class="absolute top-8 left-8 w-24 h-24 border-t-2 border-l-2 opacity-30" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-8 right-8 w-24 h-24 border-b-2 border-r-2 opacity-30" style="border-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Icon --}}
        <div class="flex justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="relative">
                <div class="absolute -inset-3 border rotate-45 opacity-30" style="border-color: {{ $primaryColor }};"></div>
                <svg class="w-12 h-12" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold mb-6"
            style="color: {{ $lightTextColor }}; font-family: 'Playfair Display', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p class="text-lg sm:text-xl mb-10 max-w-2xl mx-auto" style="color: {{ $lightTextColor }}; opacity: 0.7;">
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest border-2 transition-all duration-300 hover:bg-white/5"
                    style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }};"
                >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ $secondaryCtaText }}
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest border-2 transition-all duration-300 hover:bg-white/5"
                    style="border-color: {{ $primaryColor }}40; color: white;"
                >
                    Bekijk Diensten
                </a>
            @endif
        </div>

        {{-- Trust note --}}
        <div class="flex items-center justify-center gap-6 mt-12 pt-12 border-t" style="border-color: {{ $primaryColor }}20;">
            <div class="flex items-center gap-2 text-sm" style="color: {{ $lightTextColor }}; opacity: 0.6;">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Walk-ins welkom
            </div>
            <div class="hidden sm:block w-px h-4" style="background-color: {{ $lightTextColor }}; opacity: 0.2;"></div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $lightTextColor }}; opacity: 0.6;">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Gratis parkeren
            </div>
            <div class="hidden sm:block w-px h-4" style="background-color: {{ $lightTextColor }}; opacity: 0.2;"></div>
            <div class="flex items-center gap-2 text-sm" style="color: {{ $lightTextColor }}; opacity: 0.6;">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Koffie van het huis
            </div>
        </div>
    </div>
</section>
