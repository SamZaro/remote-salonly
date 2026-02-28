{{--
    Razor (Barbershop) Slider Section

    Stoere, trendy barbershop stijl slider met vintage elementen.
    Uses Alpine.js for transitions and autoplay functionality.
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content with defaults
    $title = $content['title'] ?? 'Sharp Looks.<br>Clean Cuts.';
    $subtitle = $content['subtitle'] ?? 'Traditioneel vakmanschap met moderne flair';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.85);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    // Get slider images from media library
    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    // Theme colors (consistent with razor hero)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Bebas Neue';
    $bodyFont = $theme['font_family'] ?? 'Barlow';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
    x-data="{
        currentSlide: 0,
        totalSlides: {{ $sliderImages->count() }},
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        interval: {{ $interval }},
        timer: null,
        init() {
            if (this.autoplay) {
                this.startAutoplay();
            }
        },
        startAutoplay() {
            this.timer = setInterval(() => {
                this.nextSlide();
            }, this.interval);
        },
        stopAutoplay() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        },
        goToSlide(index) {
            this.currentSlide = index;
            if (this.autoplay) {
                this.stopAutoplay();
                this.startAutoplay();
            }
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="autoplay && startAutoplay()"
>
    {{-- Slides --}}
    <div class="absolute inset-0">
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
                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                />
                {{-- Gradient overlay consistent with razor hero --}}
                @if($overlayOpacity > 0)
                    <div
                        class="absolute inset-0"
                        style="background: linear-gradient(135deg, rgba(15,15,15,{{ $overlayOpacity }}) 0%, rgba(15,15,15,{{ $overlayOpacity * 0.8 }}) 100%);"
                    ></div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Subtle line patterns (consistent with razor hero) --}}
    <div class="absolute inset-0 z-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(0deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 1px, transparent 80px);"></div>
    </div>

    {{-- Decorative razor element left --}}
    <div class="absolute left-8 top-1/2 -translate-y-1/2 hidden xl:block opacity-10">
        <svg class="w-32 h-64" viewBox="0 0 60 120" fill="none" stroke="{{ $primaryColor }}" stroke-width="0.5">
            <rect x="25" y="10" width="10" height="80" rx="2"/>
            <path d="M25 90 Q30 110 35 90" />
            <rect x="20" y="5" width="20" height="10" rx="1"/>
        </svg>
    </div>

    {{-- Decorative razor element right (mirrored) --}}
    <div class="absolute right-8 top-1/2 -translate-y-1/2 hidden xl:block opacity-10 rotate-180">
        <svg class="w-32 h-64" viewBox="0 0 60 120" fill="none" stroke="{{ $primaryColor }}" stroke-width="0.5">
            <rect x="25" y="10" width="10" height="80" rx="2"/>
            <path d="M25 90 Q30 110 35 90" />
            <rect x="20" y="5" width="20" height="10" rx="1"/>
        </svg>
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Vintage razor icon --}}
        <div class="flex justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="relative">
                <div class="absolute -inset-4 border rotate-45 opacity-30" style="border-color: {{ $primaryColor }};"></div>
                <svg class="w-16 h-16 relative" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
                    <path d="M4 4h16v3H4z M7 7v10a3 3 0 0 0 3 3h4a3 3 0 0 0 3-3V7"/>
                    <path d="M9 7v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V7"/>
                </svg>
            </div>
        </div>

        {{-- Badge --}}
        <div class="flex items-center justify-center gap-6 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            <div class="h-px w-20" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <span class="text-xs font-bold uppercase tracking-[0.4em]" style="color: {{ $primaryColor }};">
                Premium Barbershop
            </span>
            <div class="h-px w-20" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        {{-- Title --}}
        @if($title)
            <h1
                class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-8 uppercase tracking-tight leading-none"
                style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {!! $title !!}
            </h1>
        @endif

        {{-- Subtitle --}}
        @if($subtitle)
            <p
                class="text-lg sm:text-xl mb-14 max-w-2xl mx-auto tracking-wide opacity-70"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>
        @endif

        {{-- CTA Buttons --}}
        @if($ctaText)
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105"
                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                >
                    {{ $ctaText }}
                    <svg class="w-5 h-5 ml-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a
                    href="#services"
                    class="inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest border-2 transition-all duration-300 hover:bg-white/5"
                    style="border-color: {{ $primaryColor }}40; color: {{ $textColor }};"
                >
                    Bekijk Diensten
                </a>
            </div>
        @endif
    </div>

    {{-- Navigation Arrows (styled for razor theme) --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button
            class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-20 p-4 border transition-all duration-300 hover:bg-white/5"
            style="border-color: {{ $primaryColor }}40; color: {{ $textColor }};"
            @click="prevSlide()"
            aria-label="Previous slide"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button
            class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-20 p-4 border transition-all duration-300 hover:bg-white/5"
            style="border-color: {{ $primaryColor }}40; color: {{ $textColor }};"
            @click="nextSlide()"
            aria-label="Next slide"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Indicators (styled for razor theme) --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button
                    class="w-2 h-2 transition-all duration-300"
                    :class="currentSlide === {{ $index }} ? 'scale-150' : 'opacity-50 hover:opacity-75'"
                    :style="currentSlide === {{ $index }} ? 'background-color: {{ $primaryColor }}' : 'background-color: {{ $textColor }}'"
                    @click="goToSlide({{ $index }})"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 hidden md:flex flex-col items-center gap-3" x-show="currentSlide === 0">
        <span class="text-xs uppercase tracking-widest opacity-50" style="color: {{ $textColor }};">Scroll</span>
        <div class="w-px h-16 animate-pulse" style="background: linear-gradient(to bottom, {{ $primaryColor }}, transparent);"></div>
    </div>
</section>
@else
{{-- Fallback when no images - show as hero-style with primary color --}}
<section
    id="slider"
    class="relative min-h-screen flex items-center justify-center overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    {{-- Subtle line patterns --}}
    <div class="absolute inset-0 z-0 opacity-[0.03]">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(0deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 1px, transparent 80px);"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Badge --}}
        <div class="flex items-center justify-center gap-6 mb-10">
            <div class="h-px w-20" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <span class="text-xs font-bold uppercase tracking-[0.4em]" style="color: {{ $primaryColor }};">
                Premium Barbershop
            </span>
            <div class="h-px w-20" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        @if($title)
            <h1
                class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-8 uppercase tracking-tight leading-none"
                style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {!! $title !!}
            </h1>
        @endif

        @if($subtitle)
            <p
                class="text-lg sm:text-xl mb-14 max-w-2xl mx-auto tracking-wide opacity-70"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>
        @endif

        @if($ctaText)
            <a
                href="{{ $ctaLink }}"
                class="group inline-flex items-center justify-center px-10 py-5 text-base font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        @endif

        <p class="mt-16 opacity-40 text-sm" style="color: {{ $textColor }};">
            {{ __('Upload slider images in the admin panel to display the slider.') }}
        </p>
    </div>
</section>
@endif
