{{--
    Default Slider Section

    Full-width hero-style slider with up to 6 background images.
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
    $title = $content['title'] ?? '';
    $subtitle = $content['subtitle'] ?? '';
    $ctaText = $content['cta_text'] ?? null;
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.5);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    // Get slider images from media library
    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    // Theme colors
    $primaryColor = $theme['primary_color'] ?? '#3b82f6';
    $accentColor = $theme['accent_color'] ?? '#f59e0b';
    $headingFont = $theme['heading_font_family'] ?? 'inherit';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-[80vh] flex items-center justify-center overflow-hidden"
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
                {{-- Overlay --}}
                @if($overlayOpacity > 0)
                    <div
                        class="absolute inset-0"
                        style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"
                    ></div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Content overlay --}}
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        @if($title)
            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6"
                style="font-family: {{ $headingFont }}; color: #ffffff;"
            >
                {!! $title !!}
            </h1>
        @endif

        @if($subtitle)
            <p
                class="text-xl md:text-2xl mb-8 opacity-90"
                style="color: #ffffff;"
            >
                {{ $subtitle }}
            </p>
        @endif

        @if($ctaText)
            <a
                href="{{ $ctaLink }}"
                class="inline-block px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 hover:scale-105"
                style="background-color: {{ $accentColor }}; color: #ffffff;"
            >
                {{ $ctaText }}
            </a>
        @endif
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button
            class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-black/30 text-white hover:bg-black/50 transition-colors"
            @click="prevSlide()"
            aria-label="Previous slide"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button
            class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full bg-black/30 text-white hover:bg-black/50 transition-colors"
            @click="nextSlide()"
            aria-label="Next slide"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            @foreach($sliderImages as $index => $media)
                <button
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="currentSlide === {{ $index }} ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75'"
                    @click="goToSlide({{ $index }})"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif
</section>
@else
{{-- Fallback when no images are uploaded --}}
<section
    id="slider"
    class="relative min-h-[80vh] flex items-center justify-center"
    style="background-color: {{ $primaryColor }};"
>
    <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
        @if($title)
            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6"
                style="font-family: {{ $headingFont }}; color: #ffffff;"
            >
                {!! $title !!}
            </h1>
        @endif

        @if($subtitle)
            <p
                class="text-xl md:text-2xl mb-8 opacity-90"
                style="color: #ffffff;"
            >
                {{ $subtitle }}
            </p>
        @endif

        @if($ctaText)
            <a
                href="{{ $ctaLink }}"
                class="inline-block px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 hover:scale-105"
                style="background-color: {{ $accentColor }}; color: #ffffff;"
            >
                {{ $ctaText }}
            </a>
        @endif

        <p class="mt-8 text-white/60 text-sm">
            {{ __('Upload slider images in the admin panel to display the slider.') }}
        </p>
    </div>
</section>
@endif
