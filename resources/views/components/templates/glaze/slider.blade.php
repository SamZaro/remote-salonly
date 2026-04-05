{{--
    Glaze Template: Slider Section
    Full-screen image slider with bold rose accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Welcome to our company');
    $subtitle = $content['subtitle'] ?? __('We help you with professional services');
    $ctaText = $content['cta_text'] ?? __('Book a Treatment');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.6);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $textColor = '#ffffff';
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
    <div class="absolute inset-0">
        @foreach($sliderImages as $index => $media)
            <div class="absolute inset-0 transition-opacity duration-1000" x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                @if($overlayOpacity > 0)<div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,{{ $overlayOpacity * 0.5 }}), rgba(0,0,0,{{ $overlayOpacity }}));"></div>@endif
            </div>
        @endforeach
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Eyebrow --}}
        <div class="flex items-center justify-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">Nail Studio</span>
            <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
        </div>

        @if($title)
            <h1
                class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-6"
                style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', sans-serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >{!! $title !!}</h1>
        @endif

        @if($subtitle)
            <p
                class="text-4xl sm:text-5xl md:text-6xl mb-12 max-w-4xl mx-auto font-extrabold"
                style="color: transparent; -webkit-text-stroke: 1.5px {{ $primaryColor }}; font-family: '{{ $headingFont }}', sans-serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >{{ $subtitle }}</p>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            @if($ctaText)
                <a href="{{ $ctaLink }}" class="inline-flex items-center justify-center px-8 py-4 text-lg rounded-full font-semibold transition-all duration-300 hover:scale-105" style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 24px {{ $primaryColor }}40;">{{ $ctaText }}</a>
            @endif
            <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-lg rounded-full font-semibold border-2 transition-all duration-300 hover:bg-white/10" style="border-color: rgba(255,255,255,0.3); color: {{ $textColor }};">{{ __('Our services') }}</a>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110" style="background-color: {{ $primaryColor }}30; color: {{ $textColor }}; backdrop-filter: blur(4px);" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110" style="background-color: {{ $primaryColor }}30; color: {{ $textColor }}; backdrop-filter: blur(4px);" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            @foreach($sliderImages as $index => $media)
                <button
                    class="h-1 rounded-full transition-all duration-300"
                    :class="currentSlide === {{ $index }} ? 'w-8' : 'w-3 opacity-40'"
                    :style="currentSlide === {{ $index }} ? 'background-color: {{ $primaryColor }}' : 'background-color: {{ $textColor }}'"
                    @click="goToSlide({{ $index }})"
                    aria-label="Go to slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center justify-center" style="background-color: {{ $secondaryColor }};">
    <div class="text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-extrabold mb-6" style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', sans-serif;">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-3xl mb-8" style="color: {{ $primaryColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
