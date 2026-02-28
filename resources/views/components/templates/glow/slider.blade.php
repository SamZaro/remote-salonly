{{--
    Glow Template: Slider Section
    Warm minimalist — clean image carousel, no floating cards or decorative blobs
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Mooi haar begint<br>bij vakmanschap';
    $subtitle = $content['subtitle'] ?? 'Persoonlijke haarverzorging en beauty in een ontspannen sfeer';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.4);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center"
    style="background-color: {{ $backgroundColor }};"
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
    <div class="relative z-10 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Content --}}
            <div
                class="text-center lg:text-left"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
            >
                @if($title)
                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                    >{!! $title !!}</h1>
                @endif

                @if($subtitle)
                    <p class="text-xl mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed" style="color: {{ $textColor }};">
                        {{ $subtitle }}
                    </p>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @if($ctaText)
                        <a
                            href="{{ $ctaLink }}"
                            class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-wide uppercase transition-all duration-300 hover:opacity-90"
                            style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }}; border-radius: 6px;"
                        >
                            {{ $ctaText }}
                            <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @endif
                    <a
                        href="#services"
                        class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-wide uppercase transition-all duration-300 hover:opacity-70"
                        style="color: {{ $secondaryColor }}; border: 1.5px solid {{ $secondaryColor }}40; border-radius: 6px;"
                    >
                        Onze services
                    </a>
                </div>
            </div>

            {{-- Image Slider --}}
            <div
                class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out 0.15s;"
            >
                <div class="relative w-full h-[480px] lg:h-[580px] overflow-hidden" style="border-radius: 12px;">
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
                            @if($overlayOpacity > 0)
                                <div class="absolute inset-0" style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"></div>
                            @endif
                        </div>
                    @endforeach

                    {{-- Navigation Arrows --}}
                    @if($showArrows && $sliderImages->count() > 1)
                        <button
                            class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center transition-opacity hover:opacity-70"
                            style="background-color: {{ $backgroundColor }}; color: {{ $secondaryColor }}; border-radius: 6px;"
                            @click="prevSlide()"
                            aria-label="Previous slide"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button
                            class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 flex items-center justify-center transition-opacity hover:opacity-70"
                            style="background-color: {{ $backgroundColor }}; color: {{ $secondaryColor }}; border-radius: 6px;"
                            @click="nextSlide()"
                            aria-label="Next slide"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    @endif
                </div>

                {{-- Indicators --}}
                @if($showIndicators && $sliderImages->count() > 1)
                    <div class="flex justify-center gap-2 mt-4">
                        @foreach($sliderImages as $index => $media)
                            <button
                                class="h-1 rounded-full transition-all duration-300"
                                :style="currentSlide === {{ $index }}
                                    ? 'background-color: {{ $secondaryColor }}; width: 2rem;'
                                    : 'background-color: {{ $secondaryColor }}40; width: 0.75rem;'"
                                @click="goToSlide({{ $index }})"
                                aria-label="Go to slide {{ $index + 1 }}"
                            ></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@else
<section
    id="slider"
    class="relative min-h-screen flex items-center"
    style="background-color: {{ $backgroundColor }};"
>
    <div class="mx-auto max-w-4xl text-center px-4">
        @if($title)
            <h1
                class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
            >{!! $title !!}</h1>
        @endif
        @if($subtitle)
            <p class="text-lg mb-8 leading-relaxed" style="color: {{ $textColor }};">{{ $subtitle }}</p>
        @endif
        <p class="text-sm" style="color: {{ $textColor }}; opacity: 0.5;">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
