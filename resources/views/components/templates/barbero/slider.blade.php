{{--
    Barbero (Barbershop) Slider Section

    Stoere, masculine barbershop stijl met vintage vibes
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Classic Cuts.<br>Modern Style.';
    $subtitle = $content['subtitle'] ?? 'Waar traditie en vakmanschap samenkomen';
    $ctaText = $content['cta_text'] ?? 'Boek een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.6);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
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
                <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                @if($overlayOpacity > 0)<div class="absolute inset-0" style="background-color: rgba(26, 26, 26, {{ $overlayOpacity }});"></div>@endif
            </div>
        @endforeach
    </div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Vintage badge --}}
        <div class="flex items-center justify-center gap-4 mb-8">
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="px-4 py-2 border-2 text-xs font-bold uppercase tracking-[0.3em]" style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }};">Est. 2024</div>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Scissors icon --}}
        <div class="flex justify-center mb-6">
            <svg class="w-12 h-12" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
        </div>

        @if($title)
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-6 uppercase tracking-wider" style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>
        @endif

        @if($subtitle)
            <p class="text-lg sm:text-xl mb-12 max-w-xl mx-auto uppercase tracking-[0.2em] opacity-80" style="color: {{ $textColor }};">{{ $subtitle }}</p>
        @endif

        @if($ctaText)
            <a href="{{ $ctaLink }}" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105 border-2" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-color: {{ $primaryColor }};">{{ $ctaText }}</a>
        @endif

        {{-- Stars --}}
        <div class="flex items-center justify-center gap-1 mt-12">
            @for($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            @endfor
            <span class="ml-3 text-sm uppercase tracking-wider opacity-70" style="color: {{ $textColor }};">500+ Reviews</span>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 border-2 transition-all duration-300 hover:bg-white/10" style="border-color: {{ $primaryColor }}; color: {{ $textColor }};" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 border-2 transition-all duration-300 hover:bg-white/10" style="border-color: {{ $primaryColor }}; color: {{ $textColor }};" @click="nextSlide()" aria-label="Next slide">
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
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center justify-center" style="background-color: {{ $secondaryColor }};">
    <div class="text-center px-4">
        @if($title)<h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 uppercase" style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8 opacity-80" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
