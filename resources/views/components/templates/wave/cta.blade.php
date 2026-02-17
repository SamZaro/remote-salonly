{{--
    Wave Template: CTA Section
    "Coastal Minimal" — ocean-depth background, wave transitions, rounded pill CTAs, trust indicators
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar voor een nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Ontdek wat wij voor jou kunnen betekenen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section class="relative py-32 lg:py-44 overflow-hidden" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Background"
                class="w-full h-full object-cover opacity-20"
            />
        </div>
    @endif

    {{-- Ocean-depth gradient --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }}e6 0%, {{ $secondaryColor }}cc 50%, {{ $primaryColor }}20 100%);"></div>

    {{-- Wave top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="{{ $secondaryColor }}">
            <path d="M0,80 L0,30 C360,0 720,60 1080,30 C1260,15 1380,40 1440,30 L1440,80 Z" fill="#ffffff"/>
        </svg>
    </div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z" fill="{{ $secondaryColor }}"/>
            <path d="M0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,80 L0,80 Z" fill="{{ $backgroundColor }}"/>
        </svg>
    </div>

    {{-- Content --}}
    <div
        class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        {{-- Decorative dots --}}
        <div class="flex items-center justify-center gap-2 mb-10">
            <div class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $primaryColor }}40;"></div>
            <div class="w-2 h-2 rounded-full" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }});"></div>
            <div class="w-1.5 h-1.5 rounded-full" style="background-color: {{ $primaryColor }}40;"></div>
        </div>

        {{-- Title --}}
        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl leading-tight mb-6"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
        >
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p class="text-base sm:text-lg mb-12 max-w-2xl mx-auto leading-relaxed" style="color: {{ $backgroundColor }}70;">
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-wide rounded-full transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5"
                style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 20px {{ $primaryColor }}40;"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium tracking-wide rounded-full transition-all duration-300 hover:bg-white/10"
                    style="color: {{ $backgroundColor }}; border: 1px solid {{ $backgroundColor }}25;"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium tracking-wide rounded-full transition-all duration-300 hover:bg-white/10"
                    style="color: {{ $backgroundColor }}; border: 1px solid {{ $backgroundColor }}25;"
                >
                    Ontdek diensten
                </a>
            @endif
        </div>

        {{-- Trust indicators --}}
        <div class="flex flex-wrap items-center justify-center gap-6 mt-16 pt-10" style="border-top: 1px solid {{ $primaryColor }}15;">
            @foreach(['Gratis consult', 'Premium producten', '100% Tevredenheid'] as $trust)
                <div class="flex items-center gap-2.5">
                    <div
                        class="w-5 h-5 rounded-full flex items-center justify-center"
                        style="background: {{ $primaryColor }}20;"
                    >
                        <svg class="w-3 h-3" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-[13px]" style="color: {{ $backgroundColor }}60;">{{ $trust }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
