{{--
    Essence (Soft Luxury Salon) Slider Section

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Timeless<br>Elegance';
    $subtitle = $content['subtitle'] ?? 'Waar schoonheid en verfijning samenkomen';
    $ctaText = $content['cta_text'] ?? 'Reserveer Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.3);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center overflow-hidden"
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
    {{-- Subtle gradient overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, {{ $backgroundColor }} 0%, {{ $primaryColor }}15 50%, {{ $backgroundColor }} 100%);"></div>

    {{-- Decorative elements --}}
    <div class="absolute top-20 right-20 w-64 h-64 rounded-full opacity-20 blur-3xl" style="background: {{ $primaryColor }};"></div>
    <div class="absolute bottom-20 left-20 w-80 h-80 rounded-full opacity-15 blur-3xl" style="background: {{ $accentColor }};"></div>

    {{-- Subtle line decorations --}}
    <div class="absolute top-32 left-16 w-px h-32 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $secondaryColor }}30, transparent);"></div>
    <div class="absolute bottom-32 right-16 w-px h-32 hidden lg:block" style="background: linear-gradient(180deg, transparent, {{ $secondaryColor }}30, transparent);"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                <div class="inline-flex items-center gap-3 mb-10">
                    <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                    <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Exclusive Beauty</span>
                    <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                </div>

                @if($title)<h1 class="text-5xl sm:text-6xl lg:text-7xl font-light mb-8 leading-tight tracking-tight" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>@endif
                @if($subtitle)<p class="text-lg sm:text-xl mb-12 max-w-md mx-auto lg:mx-0 font-light leading-relaxed" style="color: {{ $textColor }}; opacity: 0.8;">{{ $subtitle }}</p>@endif

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-5">
                    @if($ctaText)
                        <a href="{{ $ctaLink }}" class="group inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest transition-all duration-500 hover:shadow-lg" style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};">
                            {{ $ctaText }}
                            <svg class="w-4 h-4 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                    <a href="#services" class="inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest border transition-all duration-500" style="border-color: {{ $secondaryColor }}30; color: {{ $secondaryColor }};">Ontdek meer</a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex items-center justify-center lg:justify-start gap-8 mt-16">
                    <div class="text-center">
                        <span class="block text-2xl font-light" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;">15+</span>
                        <span class="text-xs uppercase tracking-wider" style="color: {{ $textColor }}; opacity: 0.6;">Jaar ervaring</span>
                    </div>
                    <div class="w-px h-10" style="background-color: {{ $secondaryColor }}20;"></div>
                    <div class="text-center">
                        <span class="block text-2xl font-light" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;">2000+</span>
                        <span class="text-xs uppercase tracking-wider" style="color: {{ $textColor }}; opacity: 0.6;">Happy clients</span>
                    </div>
                </div>
            </div>

            {{-- Image Slider --}}
            <div class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                <div class="absolute -inset-4 border opacity-30" style="border-color: {{ $secondaryColor }};"></div>
                <div class="absolute -inset-8 border opacity-15" style="border-color: {{ $secondaryColor }};"></div>
                <div class="relative w-full h-[550px] lg:h-[650px] overflow-hidden">
                    @foreach($sliderImages as $index => $media)
                        <div class="absolute inset-0 transition-opacity duration-1000" x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                            @if($overlayOpacity > 0)<div class="absolute inset-0" style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"></div>@endif
                        </div>
                    @endforeach
                </div>

                {{-- Floating card --}}
                <div class="absolute -bottom-8 -left-8 p-6 bg-white hidden lg:block" style="box-shadow: 0 20px 60px {{ $secondaryColor }}15;">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 flex items-center justify-center" style="background-color: {{ $accentColor }};">
                            <svg class="w-6 h-6" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium" style="color: {{ $secondaryColor }};">Online reserveren</p>
                            <p class="text-xs" style="color: {{ $textColor }}; opacity: 0.6;">24/7 beschikbaar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 border transition-all duration-300 hover:bg-white" style="border-color: {{ $secondaryColor }}30; color: {{ $secondaryColor }}; background: {{ $backgroundColor }};" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 border transition-all duration-300 hover:bg-white" style="border-color: {{ $secondaryColor }}30; color: {{ $secondaryColor }}; background: {{ $backgroundColor }};" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button class="w-2 h-2 transition-all duration-300" :class="currentSlide === {{ $index }} ? 'scale-150' : 'opacity-40'" :style="currentSlide === {{ $index }} ? 'background-color: {{ $secondaryColor }}' : 'background-color: {{ $secondaryColor }}'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-4xl text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-light mb-8" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8" style="color: {{ $textColor }}; opacity: 0.8;">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
