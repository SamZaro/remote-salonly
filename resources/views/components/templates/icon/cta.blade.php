{{--
    Template-specifieke CTA sectie voor Icon (Hair Salon)

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
    $title = $content['title'] ?? 'Klaar voor jouw nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog een afspraak en ontdek wat wij voor jou kunnen betekenen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
@endphp

<section class="relative py-24 lg:py-32 overflow-hidden">
    {{-- Gradient background --}}
    <div
        class="absolute inset-0"
        style="background: linear-gradient(135deg, {{ $primaryColor }} 0%, {{ $secondaryColor }} 100%);"
    ></div>

    {{-- Background image overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img
                src="{{ $backgroundImage }}"
                alt="Background"
                class="w-full h-full object-cover opacity-10"
            />
        </div>
    @endif

    {{-- Decorative shapes --}}
    <div class="absolute top-0 left-0 w-64 h-64 rounded-full bg-white/5 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-white/5 translate-x-1/2 translate-y-1/2"></div>
    <div class="absolute top-1/2 left-1/4 w-4 h-4 rounded-full bg-white/20 animate-ping"></div>
    <div class="absolute top-1/3 right-1/4 w-3 h-3 rounded-full bg-white/20 animate-ping" style="animation-delay: 0.5s;"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm text-white text-sm font-medium mb-8">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            Direct online boeken
        </div>

        {{-- Title --}}
        <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold mb-6 text-white">
            {{ $title }}
        </h2>

        {{-- Subtitle --}}
        <p class="text-lg sm:text-xl mb-12 max-w-2xl mx-auto text-white/80">
            {{ $subtitle }}
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-10 py-5 text-base font-semibold rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                style="background-color: white; color: {{ $primaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-semibold rounded-xl border-2 border-white/30 text-white transition-all duration-300 hover:bg-white/10"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @else
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-semibold rounded-xl border-2 border-white/30 text-white transition-all duration-300 hover:bg-white/10"
                >
                    Bekijk diensten
                </a>
            @endif
        </div>

        {{-- Features --}}
        <div class="flex flex-wrap items-center justify-center gap-6 mt-14 pt-10 border-t border-white/20">
            <div class="flex items-center gap-2 text-white/80">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm">Gratis consult</span>
            </div>
            <div class="flex items-center gap-2 text-white/80">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm">Premium producten</span>
            </div>
            <div class="flex items-center gap-2 text-white/80">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span class="text-sm">100% tevredenheid</span>
            </div>
        </div>
    </div>
</section>
