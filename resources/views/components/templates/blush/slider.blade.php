{{--
    Blush Template: Slider Section
    Elegant nail studio — fullscreen slider with refined overlay
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Our Treatments');
    $subtitle = $content['subtitle'] ?? __('View our results');
    $ctaText = $content['cta_text'] ?? __('Book a Treatment');
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.6);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
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
                @if($overlayOpacity > 0)<div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,{{ $overlayOpacity * 0.5 }}), rgba(0,0,0,{{ $overlayOpacity * 0.7 }}), rgba(0,0,0,{{ $overlayOpacity }}));"></div>@endif
            </div>
        @endforeach
    </div>

    {{-- Corner accents --}}
    <div class="absolute top-8 left-8 w-20 h-20 border-t border-l opacity-15 z-10" style="border-color: {{ $primaryColor }};"></div>
    <div class="absolute bottom-8 right-8 w-20 h-20 border-b border-r opacity-15 z-10" style="border-color: {{ $primaryColor }};"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        <div class="flex items-center justify-center gap-4 mb-10"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
            </svg>
            <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
        </div>

        @if($title)
            <h1
                class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-light mb-6 tracking-tight"
                style="color: {{ $textColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                {!! $title !!}
            </h1>
        @endif
        @if($subtitle)
            <p
                class="text-lg sm:text-xl md:text-2xl mb-14 max-w-2xl mx-auto font-light tracking-wide"
                style="color: {{ $primaryColor }}; font-family: {{ $bodyFont }}; opacity: 0; transform: translateY(16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                {{ $subtitle }}
            </p>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.5s;"
        >
            @if($ctaText)
                <a href="{{ $ctaLink }}" class="inline-flex items-center justify-center px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium transition-all duration-500 hover:scale-105" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: {{ $bodyFont }};">{{ $ctaText }}</a>
            @endif
            <a href="#services" class="inline-flex items-center justify-center px-10 py-4 text-sm uppercase tracking-[0.2em] font-medium border transition-all duration-500 hover:bg-white/5" style="border-color: {{ $primaryColor }}60; color: {{ $primaryColor }}; font-family: {{ $bodyFont }};">{{ __('Our services') }}</a>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center border transition-all duration-300 hover:bg-white/10" style="border-color: {{ $primaryColor }}40; color: {{ $primaryColor }};" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center border transition-all duration-300 hover:bg-white/10" style="border-color: {{ $primaryColor }}40; color: {{ $primaryColor }};" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button class="w-8 h-px transition-all duration-500" :style="currentSlide === {{ $index }} ? 'background-color: {{ $primaryColor }}; height: 2px;' : 'background-color: rgba(255,255,255,0.3);'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center justify-center" style="background-color: {{ $secondaryColor }};">
    <div class="text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-light mb-6" style="color: {{ $textColor }}; font-family: {{ $headingFont }};">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-xl mb-8 font-light" style="color: {{ $primaryColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
