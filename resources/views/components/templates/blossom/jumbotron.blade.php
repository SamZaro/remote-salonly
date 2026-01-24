{{--
    Template-specifieke jumbotron voor Blossom (Luxury Beauty Salon)

    Elegante, zachte stijl met roze/lavendel thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Verwennerij begint hier';
    $subtitle = $content['subtitle'] ?? 'Boek uw behandeling en ontdek pure ontspanning';
    $ctaText = $content['cta_text'] ?? 'Afspraak Maken';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - luxury beauty salon
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $textColor = $theme['text_color'] ?? '#4a3f44';
@endphp

<section id="jumbotron" class="relative py-24 lg:py-36 overflow-hidden">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}e0, {{ $secondaryColor }}e0);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
    @endif

    {{-- Decorative circles --}}
    <div class="absolute top-10 left-10 w-64 h-64 rounded-full bg-white/10"></div>
    <div class="absolute bottom-10 right-10 w-48 h-48 rounded-full bg-white/10"></div>
    <div class="absolute top-1/2 left-1/4 w-32 h-32 rounded-full bg-white/5"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        {{-- Decorative icon --}}
        <div class="w-16 h-16 mx-auto mb-8 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-8 text-white"
            style="font-family: 'Playfair Display', Georgia, serif;"
        >
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-xl mb-12 text-white/90 max-w-2xl mx-auto">
                {{ $subtitle }}
            </p>
        @endif

        <a
            href="{{ $ctaLink }}"
            class="inline-flex items-center gap-3 px-10 py-5 text-lg font-semibold rounded-full transition-all duration-300 hover:scale-105 hover:shadow-2xl bg-white"
            style="color: {{ $primaryColor }};"
        >
            {{ $ctaText }}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>

        {{-- Trust badges --}}
        <div class="flex items-center justify-center gap-8 mt-12 text-white/70 text-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Ervaren stylisten</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Premium producten</span>
            </div>
        </div>
    </div>
</section>
