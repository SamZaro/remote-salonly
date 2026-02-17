{{--
    Wave Template: Slider Section
    "Coastal Minimal" — full-bleed ocean-depth slider, wave-shaped bottom, horizontal progress
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Jouw Stijl,<br>Onze Passie';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging in een ontspannen sfeer';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.45);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
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
        progress: 0,
        progressTimer: null,
        init() {
            if (this.autoplay) this.startAutoplay();
        },
        startAutoplay() {
            this.progress = 0;
            const step = 50;
            this.progressTimer = setInterval(() => {
                this.progress += (step / this.interval) * 100;
                if (this.progress >= 100) {
                    this.nextSlide();
                    this.progress = 0;
                }
            }, step);
        },
        stopAutoplay() {
            if (this.progressTimer) { clearInterval(this.progressTimer); this.progressTimer = null; }
        },
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.progress = 0;
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.progress = 0;
        },
        goToSlide(index) {
            this.currentSlide = index;
            this.progress = 0;
        }
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="autoplay && startAutoplay()"
>
    {{-- Slide images --}}
    @foreach($sliderImages as $index => $media)
        <div
            class="absolute inset-0"
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition ease-out duration-[1200ms]"
            x-transition:enter-start="opacity-0 scale-105"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-[800ms]"
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

    {{-- Ocean-depth gradient overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }}{{ dechex((int)($overlayOpacity * 255)) }} 0%, {{ $secondaryColor }}90 40%, {{ $primaryColor }}30 100%);"></div>

    {{-- Wave-shaped bottom transition --}}
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg class="w-full h-24 sm:h-32 lg:h-40" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="{{ $backgroundColor }}">
            <path d="M0,80 C240,120 480,40 720,80 C960,120 1200,40 1440,80 L1440,120 L0,120 Z" opacity="0.5"/>
            <path d="M0,90 C360,50 720,110 1080,60 C1260,40 1380,70 1440,90 L1440,120 L0,120 Z" opacity="0.8"/>
            <path d="M0,100 C180,80 360,110 540,95 C720,80 900,110 1080,95 C1260,80 1380,100 1440,100 L1440,120 L0,120 Z"/>
        </svg>
    </div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 pb-32 lg:pb-40 max-w-4xl mx-auto">

        {{-- Overline badge --}}
        <div
            class="mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="inline-block px-5 py-2 text-[11px] uppercase tracking-[0.25em] font-medium rounded-full"
                style="color: {{ $backgroundColor }}; background: {{ $primaryColor }}25; border: 1px solid {{ $primaryColor }}40; backdrop-filter: blur(8px);"
            >
                Kapsalon & Hairstyling
            </span>
        </div>

        {{-- Title --}}
        @if($title)
            <h1
                class="text-4xl sm:text-5xl lg:text-7xl xl:text-8xl leading-[1.08] mb-6"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700; opacity: 0; transform: translateY(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {!! $title !!}
            </h1>
        @endif

        {{-- Subtitle --}}
        @if($subtitle)
            <p
                class="text-base sm:text-lg max-w-xl mx-auto leading-relaxed mb-10"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}b3; opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            >
                {{ $subtitle }}
            </p>
        @endif

        {{-- CTA buttons --}}
        <div
            class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            @if($ctaText)
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-wide rounded-full transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5"
                    style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 20px {{ $primaryColor }}40;"
                >
                    {{ $ctaText }}
                    <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            @endif
            <a
                href="#services"
                class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium tracking-wide rounded-full transition-all duration-300 hover:bg-white/10"
                style="color: {{ $backgroundColor }}; border: 1px solid {{ $backgroundColor }}30;"
            >
                Bekijk diensten
            </a>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button
            class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
            style="background: {{ $backgroundColor }}15; border: 1px solid {{ $backgroundColor }}20; color: {{ $backgroundColor }}; backdrop-filter: blur(8px);"
            @click="prevSlide()"
            aria-label="Vorige slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        <button
            class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
            style="background: {{ $backgroundColor }}15; border: 1px solid {{ $backgroundColor }}20; color: {{ $backgroundColor }}; backdrop-filter: blur(8px);"
            @click="nextSlide()"
            aria-label="Volgende slide"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Progress bar indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-32 sm:bottom-36 lg:bottom-44 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
            @foreach($sliderImages as $index => $media)
                <button
                    class="relative h-1 rounded-full overflow-hidden transition-all duration-300"
                    :style="currentSlide === {{ $index }} ? 'width: 2.5rem; background: {{ $backgroundColor }}20;' : 'width: 1rem; background: {{ $backgroundColor }}15;'"
                    @click="goToSlide({{ $index }})"
                    aria-label="Ga naar slide {{ $index + 1 }}"
                >
                    <span
                        class="absolute inset-y-0 left-0 rounded-full"
                        :style="currentSlide === {{ $index }}
                            ? 'width: ' + progress + '%; background-color: {{ $primaryColor }}; transition: width 50ms linear;'
                            : 'width: 0%; background-color: {{ $backgroundColor }}60;'"
                    ></span>
                </button>
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
    {{-- Gradient depth --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $secondaryColor }} 0%, {{ $primaryColor }}15 100%);"></div>

    {{-- Wave bottom --}}
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg class="w-full h-24 sm:h-32" viewBox="0 0 1440 120" preserveAspectRatio="none" fill="{{ $backgroundColor }}">
            <path d="M0,80 C240,120 480,40 720,80 C960,120 1200,40 1440,80 L1440,120 L0,120 Z" opacity="0.5"/>
            <path d="M0,90 C360,50 720,110 1080,60 C1260,40 1380,70 1440,90 L1440,120 L0,120 Z" opacity="0.8"/>
            <path d="M0,100 C180,80 360,110 540,95 C720,80 900,110 1080,95 C1260,80 1380,100 1440,100 L1440,120 L0,120 Z"/>
        </svg>
    </div>

    {{-- Content --}}
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 pb-32 max-w-4xl mx-auto">
        <div class="mb-8">
            <span
                class="inline-block px-5 py-2 text-[11px] uppercase tracking-[0.25em] font-medium rounded-full"
                style="color: {{ $backgroundColor }}; background: {{ $primaryColor }}25; border: 1px solid {{ $primaryColor }}40;"
            >
                Kapsalon & Hairstyling
            </span>
        </div>

        @if($title)
            <h1
                class="text-4xl sm:text-5xl lg:text-7xl leading-[1.08] mb-6"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {!! $title !!}
            </h1>
        @endif

        @if($subtitle)
            <p class="text-base max-w-xl mx-auto leading-relaxed mb-10" style="color: {{ $backgroundColor }}80;">
                {{ $subtitle }}
            </p>
        @endif

        <p class="text-[11px] uppercase tracking-[0.2em]" style="color: {{ $backgroundColor }}30;">
            {{ __('Upload slider images in the admin panel.') }}
        </p>
    </div>
</section>
@endif
