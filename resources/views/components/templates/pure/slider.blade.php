{{--
    Pure (Natural & Wellness Salon) Slider Section

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Puur.<br>Natuurlijk.<br>Jij.';
    $subtitle = $content['subtitle'] ?? 'Ontdek de kracht van natuurlijke haarverzorging';
    $ctaText = $content['cta_text'] ?? 'Boek Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.3);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
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
    {{-- Organic shape decorations --}}
    <div class="absolute top-0 right-0 w-1/2 h-full opacity-5">
        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $primaryColor }};"><path fill="currentColor" d="M45.3,-51.2C58.3,-40.9,68.2,-25.3,71.2,-8.2C74.2,8.9,70.3,27.5,59.5,40.6C48.7,53.7,31,61.3,12.7,65.2C-5.6,69.1,-24.5,69.3,-40.1,61.1C-55.7,52.9,-68,36.3,-72.1,18.1C-76.2,-0.1,-72.1,-19.9,-62,-35.1C-51.9,-50.3,-35.8,-60.9,-19.2,-64.8C-2.6,-68.7,14.5,-65.9,29.9,-59.6C45.3,-53.3,59,-46.5,45.3,-51.2Z" transform="translate(100 100)"/></svg>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-8" style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    100% Natuurlijk
                </div>

                @if($title)<h1 class="text-5xl sm:text-6xl lg:text-7xl font-light mb-8 leading-tight" style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>@endif
                @if($subtitle)<p class="text-lg sm:text-xl mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @if($ctaText)
                        <a href="{{ $ctaLink }}" class="group inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full text-white transition-all duration-300 hover:shadow-lg" style="background-color: {{ $primaryColor }};">
                            {{ $ctaText }}
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                    <a href="#about" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full transition-all duration-300" style="color: {{ $primaryColor }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Ontdek meer
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8 mt-12 pt-8 border-t" style="border-color: {{ $primaryColor }}20;">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Vegan producten</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Duurzaam</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Cruelty-free</span>
                    </div>
                </div>
            </div>

            {{-- Image Slider --}}
            <div class="relative">
                <div class="absolute -inset-4 rounded-[3rem] opacity-20 blur-2xl" style="background-color: {{ $primaryColor }};"></div>
                <div class="relative w-full h-[500px] lg:h-[600px] rounded-[2rem] overflow-hidden">
                    @foreach($sliderImages as $index => $media)
                        <div class="absolute inset-0 transition-opacity duration-1000" x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                            @if($overlayOpacity > 0)<div class="absolute inset-0" style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"></div>@endif
                        </div>
                    @endforeach
                </div>

                {{-- Floating leaf card --}}
                <div class="absolute -bottom-6 -left-6 p-5 rounded-2xl bg-white shadow-xl hidden lg:block" style="box-shadow: 0 20px 60px {{ $primaryColor }}15;">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: {{ $primaryColor }}15;">
                            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <div>
                            <p class="font-medium text-sm" style="color: {{ $headingColor }};">Eco-Certified</p>
                            <p class="text-xs" style="color: {{ $textColor }};">Groene salon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full transition-all duration-300 hover:scale-110" style="background-color: {{ $primaryColor }}; color: white;" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full transition-all duration-300 hover:scale-110" style="background-color: {{ $primaryColor }}; color: white;" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            @foreach($sliderImages as $index => $media)
                <button class="w-3 h-3 rounded-full transition-all duration-300" :class="currentSlide === {{ $index }} ? 'scale-125' : 'opacity-40'" :style="currentSlide === {{ $index }} ? 'background-color: {{ $primaryColor }}' : 'background-color: {{ $textColor }}'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-4xl text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-light mb-8" style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
