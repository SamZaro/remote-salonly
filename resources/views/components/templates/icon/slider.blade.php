{{--
    Icon Template: Slider Section
    "Warm Atelier" — full-bleed cinematic slider, centered typography, gold ambient accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Your Hair,<br>Your Style';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging voor mannen en vrouwen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.3);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
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
    {{-- Full-bleed slider images --}}
    @foreach($sliderImages as $index => $media)
        <div
            class="absolute inset-0"
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
                class="absolute inset-0 w-full h-full object-cover"
                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
            />
        </div>
    @endforeach

    {{-- Cinematic vignette overlay: radial dark edges, warm center --}}
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, {{ $secondaryColor }}60 0%, {{ $secondaryColor }}d0 70%, {{ $secondaryColor }}f0 100%);"></div>

    {{-- Bottom gradient fade for depth --}}
    <div class="absolute inset-x-0 bottom-0 h-48" style="background: linear-gradient(to top, {{ $secondaryColor }}, transparent);"></div>

    {{-- Gold corner accents — architectural framing --}}
    <div class="absolute top-8 left-8 w-16 h-px hidden lg:block" style="background: linear-gradient(to right, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute top-8 left-8 w-px h-16 hidden lg:block" style="background: linear-gradient(to bottom, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute bottom-8 right-8 w-16 h-px hidden lg:block" style="background: linear-gradient(to left, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute bottom-8 right-8 w-px h-16 hidden lg:block" style="background: linear-gradient(to top, {{ $primaryColor }}80, transparent);"></div>

    {{-- Content — centered magazine cover layout --}}
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 py-32 lg:py-0 max-w-4xl mx-auto">

        {{-- Label --}}
        <div
            class="inline-flex items-center gap-3 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <span class="uppercase text-[14px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                Hairstyling & Verzorging
            </span>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        {{-- Title --}}
        @if($title)
            <h2
                class="text-gray-200 text-[2.6rem] sm:text-6xl lg:text-7xl xl:text-8xl leading-[1.05] mb-8"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="font-family: '{{ $headingFont }}', serif; font-weight: 600; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            >
                {!! $title !!}
            </h2>
        @endif

        {{-- Gold divider --}}
        <div
            class="flex items-center justify-center gap-0 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
        >
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Subtitle --}}
        @if($subtitle)
            <p
                class="text-[15px] sm:text-base max-w-lg mx-auto leading-relaxed mb-12"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}80; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
            >
                {{ $subtitle }}
            </p>
        @endif

        {{-- CTA buttons --}}
      <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            @if($ctaText)
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center px-8 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] text-white transition-all duration-300 hover:brightness-110"
                    style="background-color: {{ $primaryColor }}; box-shadow: 0 4px 24px {{ $primaryColor }}25;"
                >
                    {{ $ctaText }}
                    <svg class="w-3.5 h-3.5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            @endif
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-[12px] font-medium uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
            >
                Bekijk diensten
            </a>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button
            class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center transition-all duration-300 hover:brightness-110"
            style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $primaryColor }}30; color: {{ $primaryColor }};"
            @click="prevSlide()"
            aria-label="Previous slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button
            class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center transition-all duration-300 hover:brightness-110"
            style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $primaryColor }}30; color: {{ $primaryColor }};"
            @click="nextSlide()"
            aria-label="Next slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Dot Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button
                    class="w-2 h-2 rounded-full transition-all duration-300"
                    :style="currentSlide === {{ $index }}
                        ? 'background-color: {{ $primaryColor }}; transform: scale(1.4);'
                        : 'background-color: {{ $backgroundColor }}25;'"
                    @click="goToSlide({{ $index }})"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif
</section>
@else
{{-- Fallback: no slider images --}}
<section
    id="slider"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
>
    {{-- Radial gradient depth --}}
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 60%, {{ $secondaryColor }} 0%, #0d0d0d 100%);"></div>
    {{-- Subtle gold ambient light --}}
    <div class="absolute inset-0" style="background: radial-gradient(circle at 50% 80%, {{ $primaryColor }}06 0%, transparent 50%);"></div>

    {{-- Gold corner accents --}}
    <div class="absolute top-8 left-8 w-16 h-px hidden lg:block" style="background: linear-gradient(to right, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute top-8 left-8 w-px h-16 hidden lg:block" style="background: linear-gradient(to bottom, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute bottom-8 right-8 w-16 h-px hidden lg:block" style="background: linear-gradient(to left, {{ $primaryColor }}80, transparent);"></div>
    <div class="absolute bottom-8 right-8 w-px h-16 hidden lg:block" style="background: linear-gradient(to top, {{ $primaryColor }}80, transparent);"></div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">

        {{-- Label --}}
        <div class="inline-flex items-center gap-3 mb-10">
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                Hairstyling & Verzorging
            </span>
            <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
        </div>

        @if($title)
            <h2
                class="text-[2.6rem] sm:text-6xl lg:text-7xl leading-[1.05] mb-8"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
            >
                {!! $title !!}
            </h2>
        @endif

        {{-- Gold divider --}}
        <div class="flex items-center justify-center gap-0 mb-8">
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        @if($subtitle)
            <p
                class="text-[15px] sm:text-base max-w-lg mx-auto leading-relaxed mb-10"
                style="color: {{ $backgroundColor }}80;"
            >
                {{ $subtitle }}
            </p>
        @endif

        <p class="text-[11px] uppercase tracking-[0.2em]" style="color: {{ $backgroundColor }}20;">
            {{ __('Upload slider images in the admin panel.') }}
        </p>
    </div>
</section>
@endif
