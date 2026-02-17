{{--
    Wave Template: Jumbotron Section
    "Coastal Minimal" — ocean-depth banner, wave transitions top & bottom, rounded pill CTAs
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Jouw stijl, onze passie';
    $subtitle = $content['subtitle'] ?? 'Laat je inspireren en boek je volgende afspraak';
    $ctaText = $content['cta_text'] ?? 'Maak een Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
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

<section id="jumbotron" class="relative py-28 lg:py-40 overflow-hidden" style="font-family: '{{ $bodyFont }}', sans-serif;">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }}cc 0%, {{ $secondaryColor }}90 50%, {{ $primaryColor }}25 100%);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }} 0%, {{ $primaryColor }}15 100%);"></div>
    @endif

    {{-- Wave top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-12 sm:h-16" viewBox="0 0 1440 60" preserveAspectRatio="none" fill="{{ $secondaryColor }}">
            <path d="M0,60 L0,20 C360,0 720,40 1080,20 C1260,10 1380,30 1440,20 L1440,60 Z" fill="{{ $backgroundColor }}"/>
        </svg>
    </div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-12 sm:h-16" viewBox="0 0 1440 60" preserveAspectRatio="none">
            <path d="M0,40 C360,0 720,60 1080,40 C1260,30 1380,50 1440,40 L1440,60 L0,60 Z" fill="{{ $backgroundColor }}" opacity="0.6"/>
            <path d="M0,45 C180,30 360,55 540,42 C720,30 900,55 1080,42 C1260,30 1380,48 1440,45 L1440,60 L0,60 Z" fill="{{ $backgroundColor }}"/>
        </svg>
    </div>

    {{-- Content --}}
    <div
        class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        {{-- Decorative --}}
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <div class="w-2 h-2 rounded-full" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }});"></div>
            <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        <h2
            class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl leading-tight mb-6"
            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
        >
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-base sm:text-lg mb-10 max-w-2xl mx-auto leading-relaxed" style="color: {{ $backgroundColor }}80;">
                {{ $subtitle }}
            </p>
        @endif

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
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium tracking-wide rounded-full transition-all duration-300 hover:bg-white/10"
                style="color: {{ $backgroundColor }}; border: 1px solid {{ $backgroundColor }}25;"
            >
                Bekijk diensten
            </a>
        </div>
    </div>
</section>
