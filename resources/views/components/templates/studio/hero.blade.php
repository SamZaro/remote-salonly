{{--
    Template-specifieke hero voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Create Your<br>Signature Look';
    $subtitle = $content['subtitle'] ?? 'Waar creativiteit en stijl samenkomen. Jouw haar, jouw statement.';
    $ctaText = $content['cta_text'] ?? 'Book Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background-color: {{ $backgroundColor }};"
>
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold mb-8 transform -rotate-2"
                    style="background: {{ $primaryColor }}; color: white;"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    NEW VIBES ONLY
                </div>

                {{-- Titel --}}
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 leading-tight tracking-tight"
                    style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;"
                >
                    {!! $title !!}
                </h1>

                {{-- Subtitel --}}
                <p class="text-lg sm:text-xl mb-10 max-w-xl mx-auto lg:mx-0" style="color: {{ $textColor }};">
                    {{ $subtitle }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full text-white transition-all duration-300 hover:scale-105 hover:-rotate-1"
                        style="background: {{ $primaryColor }}; box-shadow: 4px 4px 0 {{ $secondaryColor }};"
                    >
                        {{ $ctaText }}
                        <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="#services"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full transition-all duration-300 border-3 hover:scale-105"
                        style="border: 3px solid {{ $secondaryColor }}; color: {{ $secondaryColor }};"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Bekijk ons werk
                    </a>
                </div>

                {{-- Social proof --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8 mt-12">
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-3">
                            @for($i = 0; $i < 4; $i++)
                                <div
                                    class="w-10 h-10 rounded-full border-3 border-white flex items-center justify-center text-sm font-bold text-white"
                                    style="background: {{ $i % 2 == 0 ? $primaryColor : $secondaryColor }};"
                                >
                                    {{ ['L', 'M', 'S', 'J'][$i] }}
                                </div>
                            @endfor
                        </div>
                        <div>
                            <p class="font-bold" style="color: {{ $headingColor }};">1.5K+</p>
                            <p class="text-sm" style="color: {{ $textColor }};">Happy clients</p>
                        </div>
                    </div>
                    <div class="h-10 w-px" style="background: {{ $secondaryColor }}20;"></div>
                    <div class="flex items-center gap-2">
                        <div class="flex">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="font-bold" style="color: {{ $headingColor }};">5.0</span>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative">
                @if($backgroundImage)
                    <div class="relative">
                        <div class="absolute -inset-2 rounded-3xl rotate-3" style="background: {{ $primaryColor }};"></div>
                        <img
                            src="{{ $backgroundImage }}"
                            alt="Creative Studio"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover rounded-3xl"
                            style="box-shadow: 8px 8px 0 {{ $secondaryColor }};"
                        />
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div class="absolute -inset-2 rounded-3xl rotate-3" style="background: {{ $primaryColor }};"></div>
                        <div
                            class="relative w-full h-[500px] lg:h-[600px] rounded-3xl flex items-center justify-center"
                            style="background: {{ $accentColor }}; box-shadow: 8px 8px 0 {{ $secondaryColor }};"
                        >
                            <div class="text-center">
                                <svg class="w-24 h-24 mx-auto mb-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/>
                                </svg>
                                <span class="font-bold" style="color: {{ $primaryColor }};">Hero afbeelding</span>
                            </div>
                        </div>
                    </div>
                @endif

{{-- Social icons floating --}}
                <div class="absolute -top-4 -right-4 hidden lg:flex flex-col gap-3">
                    @foreach(['instagram', 'tiktok'] as $social)
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center transform rotate-6 hover:rotate-0 transition-transform cursor-pointer"
                            style="background: {{ $secondaryColor }};"
                        >
                            @if($social === 'instagram')
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                                </svg>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>
