{{--
    Template-specifieke hero voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Timeless<br>Elegance';
    $subtitle = $content['subtitle'] ?? 'Waar schoonheid en verfijning samenkomen';
    $ctaText = $content['cta_text'] ?? 'Reserveer Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';      // Nude roze
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';        // Poeder roze
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';  // Donker taupe
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8'; // Roomwit
    $textColor = $theme['text_color'] ?? '#6E5F5B';

    $headingFont = $theme['heading_font_family'] ?? 'Cormorant';
    $bodyFont = $theme['font_family'] ?? 'Source Sans 3';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background-color: {{ $backgroundColor }};"
>
    {{-- Subtiele gradient overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $backgroundColor }} 0%, {{ $primaryColor }}15 50%, {{ $backgroundColor }} 100%);"></div>

    {{-- Delicate decoratieve elementen --}}
    <div class="absolute top-20 right-20 w-64 h-64 rounded-full opacity-20 blur-3xl" style="background: {{ $primaryColor }};"></div>
    <div class="absolute bottom-20 left-20 w-80 h-80 rounded-full opacity-15 blur-3xl" style="background: {{ $accentColor }};"></div>

    {{-- Subtiele lijn decoraties --}}
    <div class="absolute top-32 left-16 w-px h-32 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $secondaryColor }}30, transparent);"></div>
    <div class="absolute bottom-32 right-16 w-px h-32 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $secondaryColor }}30, transparent);"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                {{-- Elegante badge --}}
                <div class="inline-flex items-center gap-3 mb-10">
                    <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                    <span
                        class="text-xs font-medium uppercase tracking-[0.3em]"
                        style="color: {{ $secondaryColor }};"
                    >
                        Exclusive Beauty
                    </span>
                    <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                </div>

                {{-- Titel --}}
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-light mb-8 leading-tight tracking-tight"
                    style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                >
                    {!! $title !!}
                </h1>

                {{-- Subtitel --}}
                <p
                    class="text-lg sm:text-xl mb-12 max-w-md mx-auto lg:mx-0 font-light leading-relaxed"
                    style="color: {{ $textColor }}; opacity: 0.8;"
                >
                    {{ $subtitle }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-5">
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest transition-all duration-500 hover:shadow-lg"
                        style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
                    >
                        {{ $ctaText }}
                        <svg class="w-4 h-4 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="#services"
                        class="inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest border transition-all duration-500"
                        style="border-color: {{ $secondaryColor }}30; color: {{ $secondaryColor }};"
                    >
                        Ontdek meer
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex items-center justify-center lg:justify-start gap-8 mt-16">
                    <div class="text-center">
                        <span class="block text-2xl font-light" style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;">15+</span>
                        <span class="text-xs uppercase tracking-wider" style="color: {{ $textColor }}; opacity: 0.6;">Jaar ervaring</span>
                    </div>
                    <div class="w-px h-10" style="background-color: {{ $secondaryColor }}20;"></div>
                    <div class="text-center">
                        <span class="block text-2xl font-light" style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;">2000+</span>
                        <span class="text-xs uppercase tracking-wider" style="color: {{ $textColor }}; opacity: 0.6;">Happy clients</span>
                    </div>
                    <div class="w-px h-10" style="background-color: {{ $secondaryColor }}20;"></div>
                    <div class="text-center">
                        <div class="flex items-center justify-center gap-0.5 mb-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" style="color: {{ $secondaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xs uppercase tracking-wider" style="color: {{ $textColor }}; opacity: 0.6;">5.0 rating</span>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative">
                @if($backgroundImage)
                    <div class="relative">
                        {{-- Decoratief frame --}}
                        <div class="absolute -inset-4 border opacity-30" style="border-color: {{ $secondaryColor }};"></div>
                        <div class="absolute -inset-8 border opacity-15" style="border-color: {{ $secondaryColor }};"></div>
                        <img
                            src="{{ $backgroundImage }}"
                            alt="Essence Salon"
                            class="relative w-full h-[550px] lg:h-[650px] object-cover"
                        />
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div class="absolute -inset-4 border opacity-30" style="border-color: {{ $secondaryColor }};"></div>
                        <div class="absolute -inset-8 border opacity-15" style="border-color: {{ $secondaryColor }};"></div>
                        <div
                            class="relative w-full h-[550px] lg:h-[650px] flex items-center justify-center"
                            style="background-color: {{ $accentColor }}40;"
                        >
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto mb-4" style="color: {{ $secondaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm" style="color: {{ $secondaryColor }}50;">Hero afbeelding</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Elegante floating card --}}
                <div
                    class="absolute -bottom-8 -left-8 p-6 bg-white hidden lg:block"
                    style="box-shadow: 0 20px 60px {{ $secondaryColor }}15;"
                >
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 flex items-center justify-center"
                            style="background-color: {{ $accentColor }};"
                        >
                            <svg class="w-6 h-6" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: {{ $secondaryColor }};">Online reserveren</p>
                            <p class="text-xs" style="color: {{ $textColor }}; opacity: 0.6;">24/7 beschikbaar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
