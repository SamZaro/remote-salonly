{{--
    Projecto (Aannemer) Slider Section

    Zakelijk, professioneel - bouw/constructie thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Bouw met vertrouwen';
    $subtitle = $content['subtitle'] ?? 'Vakmanschap en kwaliteit voor elk project';
    $ctaText = $content['cta_text'] ?? 'Vraag een offerte aan';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.7);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = '#ffffff';
    $buttonRadius = $theme['button_border_radius'] ?? '4px';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center overflow-hidden"
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
                @if($overlayOpacity > 0)<div class="absolute inset-0" style="background: linear-gradient(to right, rgba(0,0,0,{{ $overlayOpacity }}), rgba(0,0,0,{{ $overlayOpacity * 0.7 }}), transparent);"></div>@endif
            </div>
        @endforeach
    </div>

    {{-- Geometric decoration --}}
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 800" fill="none">
                <line x1="50" y1="0" x2="50" y2="800" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="150" y1="0" x2="150" y2="800" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="250" y1="0" x2="250" y2="800" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="0" y1="200" x2="400" y2="200" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="0" y1="400" x2="400" y2="400" stroke="{{ $primaryColor }}" stroke-width="1"/>
                <line x1="0" y1="600" x2="400" y2="600" stroke="{{ $primaryColor }}" stroke-width="1"/>
            </svg>
        </div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 w-full">
        <div class="max-w-3xl">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-sm mb-8 bg-gray-100" style="border-left: 3px solid {{ $primaryColor }};">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span class="text-sm font-medium uppercase tracking-wider" style="color: {{ $primaryColor }};">Aannemer & Bouwbedrijf</span>
            </div>

            @if($title)<h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: {{ $textColor }};">{!! $title !!}</h1>@endif
            @if($subtitle)<p class="text-lg sm:text-xl md:text-2xl mb-10 max-w-2xl opacity-90 leading-relaxed" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif

            <div class="flex flex-col sm:flex-row items-start gap-4">
                @if($ctaText)
                    <a href="{{ $ctaLink }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold uppercase tracking-wide border-2 transition-all duration-300 hover:scale-105" style="background-color: {{ $secondaryColor }}; color: {{ $textColor }}; border-color: #f3f4f6; border-radius: {{ $buttonRadius }};">
                        {{ $ctaText }}
                        <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                @endif
                <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold border-2 transition-all duration-300 hover:bg-white/10" style="border-color: {{ $textColor }}; color: {{ $textColor }}; border-radius: {{ $buttonRadius }};">Bekijk onze projecten</a>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 transition-all duration-300 hover:scale-110" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 transition-all duration-300 hover:scale-110" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button class="w-4 h-1 transition-all duration-300" :class="currentSlide === {{ $index }} ? 'w-8' : 'opacity-50'" :style="currentSlide === {{ $index }} ? 'background-color: {{ $primaryColor }}' : 'background-color: {{ $textColor }}'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 right-8 z-10 hidden md:flex flex-col items-center gap-2 animate-bounce">
        <svg class="w-6 h-6 opacity-60" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-4xl px-4">
        @if($title)<h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6" style="color: {{ $textColor }};">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8 opacity-90" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
