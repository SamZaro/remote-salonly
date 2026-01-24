{{--
    Template-specifieke jumbotron voor Icon (Hair Salon)

    Modern en fris met lichtblauw/mint thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar voor een nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Onze stylisten staan voor je klaar om jouw droomkapsel te creëren';
    $ctaText = $content['cta_text'] ?? 'Boek Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - fresh modern salon
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
@endphp

<section id="jumbotron" class="relative py-20 lg:py-28 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}e8, {{ $secondaryColor }}e8);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
    @endif

    {{-- Decorative shapes --}}
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/10 -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full bg-white/10 translate-y-1/2 -translate-x-1/2"></div>

    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                <span class="inline-block px-4 py-2 rounded-full bg-white/20 text-white text-sm font-medium mb-6 backdrop-blur-sm">
                    ✨ Jouw nieuwe look wacht
                </span>

                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 text-white">
                    {{ $title }}
                </h2>

                @if($subtitle)
                    <p class="text-xl mb-10 text-white/90 max-w-xl">
                        {{ $subtitle }}
                    </p>
                @endif

                <div class="flex flex-col sm:flex-row items-center lg:items-start gap-4">
                    <a
                        href="{{ $ctaLink }}"
                        class="inline-flex items-center gap-3 px-8 py-4 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-2xl bg-white"
                        style="color: {{ $primaryColor }};"
                    >
                        {{ $ctaText }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="tel:+31201234567"
                        class="inline-flex items-center gap-2 px-6 py-4 text-lg font-medium text-white hover:bg-white/10 rounded-xl transition-all"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Bel ons
                    </a>
                </div>
            </div>

            {{-- Stats/Features --}}
            <div class="hidden lg:grid grid-cols-2 gap-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white mb-2">10+</div>
                    <div class="text-white/80">Jaar ervaring</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white mb-2">5000+</div>
                    <div class="text-white/80">Tevreden klanten</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white mb-2">4.9</div>
                    <div class="text-white/80">Google rating</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-white mb-2">6</div>
                    <div class="text-white/80">Stylisten</div>
                </div>
            </div>
        </div>
    </div>
</section>
