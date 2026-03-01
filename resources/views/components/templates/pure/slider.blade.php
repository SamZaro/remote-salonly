{{--
    Pure Template: Slider Section
    Natural & Botanical — fullscreen slider with teal overlay and botanical accents
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Puur vakmanschap';
    $subtitle = $content['subtitle'] ?? 'Ontdek de kracht van natuurlijke haarverzorging';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.45);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center overflow-hidden"
    x-data="{
        currentSlide: 0,
        totalSlides: {{ $sliderImages->count() }},
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        interval: {{ $interval }},
        timer: null,
        init() { if (this.autoplay) this.startAutoplay(); },
        startAutoplay() { this.timer = setInterval(() => this.nextSlide(), this.interval); },
        stopAutoplay() { if (this.timer) { clearInterval(this.timer); this.timer = null; } },
        nextSlide() { this.currentSlide = (this.currentSlide + 1) % this.totalSlides; },
        prevSlide() { this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides; },
        goToSlide(index) { this.currentSlide = index; if (this.autoplay) { this.stopAutoplay(); this.startAutoplay(); } }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="autoplay && startAutoplay()"
>
    {{-- Slides --}}
    @foreach($sliderImages as $index => $media)
        <div
            class="absolute inset-0 transition-opacity duration-1000"
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <img
                src="{{ $media->getUrl('slider') ?: $media->getUrl() }}"
                alt="Slide {{ $index + 1 }}"
                class="w-full h-full object-cover"
                style="animation: pureKenBurns 20s ease-in-out infinite;"
                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
            />
        </div>
    @endforeach

    {{-- Overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(0,0,0,{{ $overlayOpacity + 0.1 }}) 0%, rgba(0,0,0,{{ $overlayOpacity - 0.1 }}) 50%, rgba(0,0,0,{{ $overlayOpacity }}) 100%);"></div>

    {{-- Botanical leaf decoration --}}
    <svg class="absolute top-16 right-12 w-24 h-24 opacity-[0.08] z-10" viewBox="0 0 100 100" fill="#ffffff">
        <path d="M50 5C50 5 20 30 20 60C20 80 35 95 50 95C65 95 80 80 80 60C80 30 50 5 50 5Z"/>
    </svg>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-3xl mx-auto text-center">
            <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>

            @if($title)
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight"
                    style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);'"
                >{!! $title !!}</h1>
            @endif

            @if($subtitle)
                <p
                    class="text-lg md:text-xl mb-10 max-w-2xl mx-auto leading-relaxed"
                    style="color: rgba(255,255,255,0.8); font-family: '{{ $bodyFont }}', sans-serif; font-weight: 300;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;'"
                >{{ $subtitle }}</p>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if($ctaText)
                    <a
                        href="{{ $ctaLink }}"
                        class="inline-flex items-center justify-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 rounded-none hover:shadow-lg"
                        style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
                        onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='{{ $secondaryColor }}';"
                        onmouseout="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
                    >
                        {{ $ctaText }}
                    </a>
                @endif
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 rounded-none hover:bg-white/10"
                    style="border: 1.5px solid rgba(255,255,255,0.4); color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    Onze diensten
                </a>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button
            class="absolute left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center rounded-none transition-all duration-300 hover:bg-white/20"
            style="background-color: rgba(255,255,255,0.1); backdrop-filter: blur(4px); color: #ffffff;"
            @click="prevSlide()"
            aria-label="Previous slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button
            class="absolute right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center rounded-none transition-all duration-300 hover:bg-white/20"
            style="background-color: rgba(255,255,255,0.1); backdrop-filter: blur(4px); color: #ffffff;"
            @click="nextSlide()"
            aria-label="Next slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
            @foreach($sliderImages as $index => $media)
                <button
                    class="h-0.5 rounded-full transition-all duration-500"
                    :style="currentSlide === {{ $index }}
                        ? 'background-color: {{ $primaryColor }}; width: 2.5rem;'
                        : 'background-color: rgba(255,255,255,0.4); width: 1rem;'"
                    @click="goToSlide({{ $index }})"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif

    <style>
        @keyframes pureKenBurns {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</section>
@else
<section
    id="slider"
    class="relative min-h-screen flex items-center"
    style="background-color: {{ $secondaryColor }};"
>
    {{-- Botanical decoration --}}
    <svg class="absolute top-16 right-16 w-24 h-24 opacity-[0.06]" viewBox="0 0 100 100" fill="{{ $primaryColor }}">
        <path d="M50 5C50 5 20 30 20 60C20 80 35 95 50 95C65 95 80 80 80 60C80 30 50 5 50 5Z"/>
    </svg>

    <div class="mx-auto max-w-3xl text-center px-4">
        <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>
        @if($title)
            <h1
                class="text-4xl sm:text-5xl lg:text-7xl font-bold mb-6 leading-tight"
                style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
            >{!! $title !!}</h1>
        @endif
        @if($subtitle)
            <p class="text-lg mb-8 leading-relaxed" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ $subtitle }}</p>
        @endif
        <p class="text-sm" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}', sans-serif;">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
