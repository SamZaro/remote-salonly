{{--
    Spa Template: Hero Section
    Serene spa & wellness design — elegant typography, warm tones, calming atmosphere
    Fonts: Playfair Display (headings) + Lato (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Revitalize Your Beauty,<br>Revitalize Your Soul';
    $subtitle = $content['subtitle'] ?? 'Ontdek pure ontspanning en persoonlijke schoonheidsbehandelingen in een sfeer van rust en luxe';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    x-data="{ loaded: false }"
    x-init="setTimeout(() => loaded = true, 100)"
>
    {{-- Background image or gradient --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(0,0,0,0.45) 0%, rgba(0,0,0,0.25) 50%, rgba(0,0,0,0.4) 100%);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }} 0%, {{ $secondaryColor }}dd 50%, {{ $secondaryColor }}bb 100%);"></div>
        {{-- Decorative soft circle --}}
        <div class="absolute -right-32 -top-32 w-[600px] h-[600px] rounded-full opacity-[0.06]" style="background: {{ $primaryColor }};"></div>
        <div class="absolute -left-20 -bottom-20 w-[400px] h-[400px] rounded-full opacity-[0.04]" style="background: {{ $primaryColor }};"></div>
    @endif

    <div class="relative z-10 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-3xl mx-auto text-center">
            {{-- Small decorative line --}}
            <div
                class="w-16 h-px mx-auto mb-8 transition-all duration-1000"
                :class="loaded ? 'opacity-100 scale-x-100' : 'opacity-0 scale-x-0'"
                style="background-color: {{ $primaryColor }};"
            ></div>

            <h1
                class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight transition-all duration-1000 delay-200"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
                style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
            >
                {!! $title !!}
            </h1>

            <p
                class="text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed transition-all duration-1000 delay-400"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
                style="color: rgba(255,255,255,0.8); font-family: '{{ $bodyFont }}', sans-serif; font-weight: 300;"
            >
                {{ $subtitle }}
            </p>

            <div
                class="flex flex-col sm:flex-row items-center justify-center gap-4 transition-all duration-1000 delay-500"
                :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6'"
            >
                <a
                    href="{{ $ctaLink }}"
                    class="inline-flex items-center justify-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 hover:shadow-lg"
                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-radius: 4px; font-family: '{{ $bodyFont }}', sans-serif;"
                    onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='{{ $secondaryColor }}';"
                    onmouseout="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='{{ $secondaryColor }}';"
                >
                    {{ $ctaText }}
                </a>
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 hover:bg-white/10"
                    style="border: 1.5px solid rgba(255,255,255,0.4); color: #ffffff; border-radius: 4px; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    Onze diensten
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div
            class="w-6 h-10 rounded-full border-2 border-white/30 flex items-start justify-center p-1.5"
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 1200)"
            x-show="show"
            x-transition:enter="transition ease-out duration-700"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
        >
            <div class="w-1 h-2.5 rounded-full bg-white/60" style="animation: scrollBounce 2s ease-in-out infinite;"></div>
        </div>
    </div>

    <style>
        @keyframes scrollBounce {
            0%, 100% { transform: translateY(0); opacity: 0.6; }
            50% { transform: translateY(6px); opacity: 1; }
        }
    </style>
</section>
