{{--
    Icon Template: CTA Section
    "Warm Atelier" — elegant centered call-to-action on dark, gold accents, refined typography
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar voor jouw nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog een afspraak en ontdek wat wij voor jou kunnen betekenen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    {{-- Background image as subtle texture --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt=""
                class="w-full h-full object-cover"
                style="opacity: 0.1;"
            />
        </div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Gold-line label --}}
        <div
            class="inline-flex items-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                Direct boeken
            </span>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-[3.5rem] leading-[1.1] mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {{ $title }}
        </h2>

        {{-- Gold divider --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
        >
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
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
                class="group inline-flex items-center justify-center px-8 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] text-white transition-all duration-300 hover:brightness-110"
                style="background-color: {{ $primaryColor }}; box-shadow: 0 4px 24px {{ $primaryColor }}25;"
            >
                {{ $ctaText }}
                <svg class="w-3.5 h-3.5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-[12px] font-medium uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                    style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                >
                    <svg class="w-3.5 h-3.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-8 py-4 text-[12px] font-medium uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                    style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                >
                    Bekijk diensten
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
                    Gratis consult
                </span>
                <span class="mx-4 w-1 h-1 rounded-full inline-block" style="background-color: {{ $primaryColor }};"></span>
                <span class="text-[12px] uppercase tracking-[0.15em]" style="color: {{ $backgroundColor }}40;">
                    Premium producten
                </span>
                <span class="mx-4 w-1 h-1 rounded-full inline-block" style="background-color: {{ $primaryColor }};"></span>
                <span class="text-[12px] uppercase tracking-[0.15em]" style="color: {{ $backgroundColor }}40;">
                    100% tevredenheid
                </span>
            </div>
        </div>
    </div>
</section>
