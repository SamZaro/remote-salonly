{{--
    Blossom (Luxury Beauty Salon) Slider Section

    Luxe vrouwelijke beauty salon met spa & fashion vibes
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Bloom Into<br>Your Beauty';
    $subtitle = $content['subtitle'] ?? 'Luxe haarverzorging, beauty & wellness voor de moderne vrouw';
    $ctaText = $content['cta_text'] ?? 'Boek Je Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.4);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $textColor = '#4a3f44';
    $lightBg = '#fdf8f8';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center overflow-hidden"
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
    {{-- Decorative blobs --}}
    <div class="absolute top-20 right-16 w-72 h-72 rounded-full opacity-20 blur-3xl z-0" style="background: {{ $primaryColor }};"></div>
    <div class="absolute bottom-32 left-16 w-96 h-96 rounded-full opacity-15 blur-3xl z-0" style="background: {{ $secondaryColor }};"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                <div
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-medium mb-8"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20); color: {{ $primaryColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    Luxury Beauty Experience
                </div>

                @if($title)
                    <h1
                        class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 leading-tight"
                        style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    >{!! $title !!}</h1>
                @endif
                @if($subtitle)
                    <p
                        class="text-lg sm:text-xl mb-10 max-w-xl mx-auto lg:mx-0"
                        style="color: {{ $textColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    >{{ $subtitle }}</p>
                @endif

                <div
                    class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
                >
                    @if($ctaText)
                        <a href="{{ $ctaLink }}" class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full text-white transition-all duration-300 hover:scale-105 hover:shadow-xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}40;">
                            {{ $ctaText }}
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                    <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full transition-all duration-300 border-2" style="border-color: {{ $primaryColor }}40; color: {{ $textColor }};">
                        <svg class="w-5 h-5 mr-2" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Ontdek onze services
                    </a>
                </div>
            </div>

            {{-- Image Slider --}}
            <div
                class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
            >
                <div class="absolute -inset-4 rounded-[2rem] opacity-30 blur-2xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                <div class="relative w-full h-[500px] lg:h-[600px] rounded-[2rem] overflow-hidden shadow-2xl">
                    @foreach($sliderImages as $index => $media)
                        <div class="absolute inset-0 transition-opacity duration-1000" x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                            @if($overlayOpacity > 0)<div class="absolute inset-0" style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"></div>@endif
                        </div>
                    @endforeach
                </div>

                {{-- Floating card --}}
                <div
                    class="absolute -bottom-6 -left-6 p-5 rounded-2xl bg-white shadow-xl hidden lg:block"
                    style="box-shadow: 0 20px 60px {{ $primaryColor }}20; opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.5s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold" style="color: {{ $textColor }};">Vandaag beschikbaar</p>
                            <p class="text-sm" style="color: {{ $textColor }}; opacity: 0.6;">Book nu online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full transition-all duration-300 hover:scale-110" style="background: {{ $primaryColor }}; color: white;" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full transition-all duration-300 hover:scale-110" style="background: {{ $primaryColor }}; color: white;" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            @foreach($sliderImages as $index => $media)
                <button class="w-3 h-3 rounded-full transition-all duration-300" :class="currentSlide === {{ $index }} ? 'scale-125' : 'opacity-50'" :style="currentSlide === {{ $index }} ? 'background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }})' : 'background-color: {{ $textColor }}'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center" style="background: linear-gradient(135deg, {{ $lightBg }} 0%, #fff 40%, {{ $primaryColor }}08 100%);">
    <div class="mx-auto max-w-4xl text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-bold mb-6" style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8" style="color: {{ $textColor }}; opacity: 0.7;">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
