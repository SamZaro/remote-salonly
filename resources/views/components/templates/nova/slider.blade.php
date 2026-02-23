{{--
    Nova Slider Section

    Modern en bold - consistent met nova hero stijl
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Welkom bij ons bedrijf';
    $subtitle = $content['subtitle'] ?? 'Wij helpen u met professionele dienstverlening';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.6);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
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
                @if($overlayOpacity > 0)<div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,{{ $overlayOpacity * 0.7 }}), rgba(0,0,0,{{ $overlayOpacity }}), rgba(0,0,0,{{ $overlayOpacity }}));"></div>@endif
            </div>
        @endforeach
    </div>

    {{-- Decorative circles --}}
    <div class="absolute inset-0 z-0 opacity-5">
        <div class="absolute top-20 left-10 w-32 h-32 border-2 border-white rounded-full"></div>
        <div class="absolute top-40 right-20 w-24 h-24 border border-white rounded-full"></div>
        <div class="absolute bottom-32 left-1/4 w-16 h-16 border border-white rounded-full"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Decorative line --}}
        <div class="flex items-center justify-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        @if($title)<h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold mb-6" style="color: {{ $textColor }}; font-family: var(--font-family-heading); opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;" x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-5xl sm:text-6xl md:text-7xl mb-12 max-w-4xl mx-auto font-extrabold" style="color: {{ $primaryColor }}; font-family: var(--font-family-heading); opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;" x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'">{{ $subtitle }}</p>@endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        >
            @if($ctaText)<a href="{{ $ctaLink }}" class="inline-flex items-center justify-center px-8 py-4 text-lg rounded-sm font-medium transition-all duration-300 hover:scale-105" style="background-color: {{ $primaryColor }}; color: #ffffff;">{{ $ctaText }}</a>@endif
            <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-lg rounded-sm font-medium border-2 transition-all duration-300 hover:bg-white/10" style="border-color: {{ $textColor }}; color: {{ $textColor }};">Onze diensten</a>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 border transition-all duration-300 hover:bg-white/10" style="border-color: {{ $primaryColor }}; color: {{ $textColor }};" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 border transition-all duration-300 hover:bg-white/10" style="border-color: {{ $primaryColor }}; color: {{ $textColor }};" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button class="w-3 h-3 transition-all duration-300" :class="currentSlide === {{ $index }} ? 'scale-125' : 'opacity-50'" :style="currentSlide === {{ $index }} ? 'background-color: {{ $primaryColor }}' : 'background-color: {{ $textColor }}'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hidden md:flex flex-col items-center gap-2 animate-bounce">
        <span class="text-xs uppercase tracking-widest opacity-60" style="color: {{ $textColor }};">Scroll</span>
        <svg class="w-5 h-5 opacity-60" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center justify-center" style="background-color: {{ $secondaryColor }};">
    <div class="text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-extrabold mb-6" style="color: {{ $textColor }};">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-3xl mb-8" style="color: {{ $primaryColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
