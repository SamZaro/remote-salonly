{{--
    Template-specifieke about sectie voor Razor (Barbershop)

    Over ons met grayscale foto
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? __('Our Story');
    $subtitle = $content['subtitle'] ?? __('Since 2015 the go-to spot for the modern man');
    $description = $content['description'] ?? __('What started as a passion for the craft grew into a place where men can come for more than just a haircut. Everything here revolves around craftsmanship, attention to detail, and a moment of calm in a busy world.');
    $description2 = $content['description2'] ?? __('Our barbers are trained in both classic techniques and modern trends. Whether you come for a sharp fade, a traditional shave, or just a good conversation, you are welcome.');
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats = $content['stats'] ?? [
        ['value' => '8+', 'label' => __('Years of experience')],
        ['value' => '5000+', 'label' => __('Satisfied customers')],
        ['value' => '4', 'label' => __('Skilled barbers')],
    ];

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Bebas Neue';
    $bodyFont = $theme['font_family'] ?? 'Barlow';
@endphp

<section id="about" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Image --}}
            <div class="relative order-2 lg:order-1">
                @if($image)
                    <div class="relative">
                        {{-- Main image with grayscale --}}
                        <img
                            src="{{ $image }}"
                            alt="{{ __('About us') }}"
                            class="w-full h-[500px] lg:h-[600px] object-cover"
                        />
                        {{-- Overlay accent --}}
                        <div
                            class="absolute inset-0 mix-blend-multiply opacity-20"
                            style="background-color: {{ $primaryColor }};"
                        ></div>
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div
                        class="relative w-full h-[500px] lg:h-[600px] flex items-center justify-center"
                        style="background-color: {{ $secondaryColor }};"
                    >
                        <div class="text-center">
                            <svg class="w-24 h-24 mx-auto mb-4 opacity-30" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 4h16v3H4zM7 7v10a3 3 0 003 3h4a3 3 0 003-3V7"/>
                            </svg>
                            <span class="text-sm uppercase tracking-widest" style="color: {{ $lightTextColor }}; opacity: 0.3;">{{ __('Photo placeholder') }}</span>
                        </div>
                    </div>
                @endif

                {{-- Decorative frame --}}
                <div
                    class="absolute -top-4 -left-4 w-32 h-32 border-t-2 border-l-2"
                    style="border-color: {{ $primaryColor }};"
                ></div>
                <div
                    class="absolute -bottom-4 -right-4 w-32 h-32 border-b-2 border-r-2"
                    style="border-color: {{ $primaryColor }};"
                ></div>

                {{-- Stats overlay --}}
                <div
                    class="absolute -bottom-8 left-8 right-8 lg:left-12 lg:right-auto lg:w-80 p-6 grid grid-cols-3 gap-4"
                    style="background-color: {{ $secondaryColor }};"
                >
                    @foreach($stats as $stat)
                        <div class="text-center">
                            <span
                                class="block text-2xl lg:text-3xl font-bold"
                                style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                            >
                                {{ $stat['value'] }}
                            </span>
                            <span class="block text-xs uppercase tracking-wider mt-1" style="color: {{ $lightTextColor }}; opacity: 0.6;">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Content --}}
            <div class="order-1 lg:order-2 lg:pl-8">
                {{-- Label --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-px w-12" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }};">
                        {{ __('About Us') }}
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle quote --}}
                <p
                    class="text-xl mb-8 italic"
                    style="color: {{ $primaryColor }};"
                >
                    "{{ $subtitle }}"
                </p>

                {{-- Description --}}
                <p class="text-lg mb-6 leading-relaxed" style="color: {{ $headingColor }}; opacity: 0.75;">
                    {{ $description }}
                </p>
                <p class="text-lg mb-10 leading-relaxed" style="color: {{ $headingColor }}; opacity: 0.75;">
                    {{ $description2 }}
                </p>

                {{-- Features list --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-10">
                    @foreach([__('Classic techniques'), __('Modern styles'), __('Premium products'), __('Relaxed atmosphere')] as $feature)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span style="color: {{ $headingColor }};">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="inline-flex items-center gap-3 px-8 py-4 font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:scale-105"
                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                >
                    {{ __('Get acquainted') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
