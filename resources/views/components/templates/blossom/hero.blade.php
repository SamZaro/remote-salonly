{{--
    Template-specifieke hero voor Blossom (Luxury Beauty Salon)

    Luxe vrouwelijke beauty salon met spa & fashion vibes
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Bloom Into<br>Your Beauty';
    $subtitle = $content['subtitle'] ?? 'Luxe haarverzorging, beauty & wellness voor de moderne vrouw';
    $ctaText = $content['cta_text'] ?? 'Boek Je Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - luxe vrouwelijke bloemen/spa kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = '#4a3f44';
    $lightBg = '#fdf8f8';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background: linear-gradient(135deg, {{ $lightBg }} 0%, #fff 40%, {{ $primaryColor }}08 100%);"
>
    {{-- Decoratieve bloemblaadjes/cirkels --}}
    <div class="absolute top-20 right-16 w-72 h-72 rounded-full opacity-20 blur-3xl" style="background: {{ $primaryColor }};"></div>
    <div class="absolute bottom-32 left-16 w-96 h-96 rounded-full opacity-15 blur-3xl" style="background: {{ $secondaryColor }};"></div>
    <div class="absolute top-1/3 right-1/3 w-48 h-48 rounded-full opacity-10 blur-2xl" style="background: {{ $accentColor }};"></div>

    {{-- Floating flower petals --}}
    <div class="absolute top-24 left-[20%] w-3 h-3 rounded-full animate-bounce opacity-40" style="background: {{ $primaryColor }}; animation-delay: 0s; animation-duration: 3s;"></div>
    <div class="absolute top-40 right-[25%] w-4 h-4 rounded-full animate-bounce opacity-30" style="background: {{ $secondaryColor }}; animation-delay: 0.5s; animation-duration: 4s;"></div>
    <div class="absolute bottom-40 left-[30%] w-2 h-2 rounded-full animate-bounce opacity-50" style="background: {{ $primaryColor }}; animation-delay: 1s; animation-duration: 3.5s;"></div>
    <div class="absolute top-1/2 right-[15%] w-3 h-3 rounded-full animate-bounce opacity-35" style="background: {{ $secondaryColor }}; animation-delay: 1.5s; animation-duration: 4.5s;"></div>

    {{-- Subtle floral pattern overlay --}}
    <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient({{ $primaryColor }} 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-medium mb-8"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20); color: {{ $primaryColor }};"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Luxury Beauty Experience
                </div>

                {{-- Titel --}}
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 leading-tight"
                    style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {!! $title !!}
                </h1>

                {{-- Subtitel --}}
                <p class="text-lg sm:text-xl mb-10 max-w-xl mx-auto lg:mx-0" style="color: {{ $textColor }}; opacity: 0.7;">
                    {{ $subtitle }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full text-white transition-all duration-300 hover:scale-105 hover:shadow-xl"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}40;"
                    >
                        {{ $ctaText }}
                        <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="#services"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full transition-all duration-300 border-2"
                        style="border-color: {{ $primaryColor }}40; color: {{ $textColor }};"
                    >
                        <svg class="w-5 h-5 mr-2" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Ontdek onze services
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-6 mt-12 pt-8 border-t" style="border-color: {{ $primaryColor }}20;">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            @for($i = 0; $i < 4; $i++)
                                <div
                                    class="w-9 h-9 rounded-full border-2 border-white flex items-center justify-center text-xs font-medium text-white"
                                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                                >
                                    {{ ['E', 'S', 'A', 'M'][$i] }}
                                </div>
                            @endfor
                        </div>
                        <span class="text-sm" style="color: {{ $textColor }}; opacity: 0.7;">2000+ happy clients</span>
                    </div>
                    <div class="flex items-center gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                        <span class="text-sm ml-1" style="color: {{ $textColor }}; opacity: 0.7;">4.9 rating</span>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative">
                @if($backgroundImage)
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-[2rem] opacity-30 blur-2xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                        <img
                            src="{{ $backgroundImage }}"
                            alt="Beauty Salon"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover rounded-[2rem] shadow-2xl"
                        />
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-[2rem] opacity-20 blur-2xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                        <div
                            class="relative w-full h-[500px] lg:h-[600px] rounded-[2rem] flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15);"
                        >
                            <div class="text-center">
                                <svg class="w-24 h-24 mx-auto mb-4" style="color: {{ $primaryColor }}50;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span style="color: {{ $primaryColor }}60;">Hero afbeelding</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Floating card --}}
                <div
                    class="absolute -bottom-6 -left-6 p-5 rounded-2xl bg-white shadow-xl hidden lg:block"
                    style="box-shadow: 0 20px 60px {{ $primaryColor }}20;"
                >
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-xl flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        >
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold" style="color: {{ $textColor }};">Vandaag beschikbaar</p>
                            <p class="text-sm" style="color: {{ $textColor }}; opacity: 0.6;">Book nu online</p>
                        </div>
                    </div>
                </div>

                {{-- Decorative flower accent --}}
                <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full hidden lg:flex items-center justify-center" style="background: linear-gradient(135deg, {{ $accentColor }}, {{ $primaryColor }}30);">
                    <svg class="w-10 h-10" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm0-18c-1.1 0-2 .9-2 2v1.17c-2.36.58-4 2.71-4 5.33 0 2.08.85 3.97 2.22 5.33L12 21l3.78-7.17C17.15 12.47 18 10.58 18 8.5c0-2.62-1.64-4.75-4-5.33V4c0-1.1-.9-2-2-2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2">
            <div class="w-8 h-12 rounded-full border-2 flex items-start justify-center p-2" style="border-color: {{ $primaryColor }}40;">
                <div class="w-1.5 h-3 rounded-full animate-bounce" style="background: {{ $primaryColor }};"></div>
            </div>
        </div>
    </div>
</section>
