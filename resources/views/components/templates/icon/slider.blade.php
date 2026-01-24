{{--
    Icon (Hair Salon) Slider Section

    Moderne, frisse kapsalon voor mannen en vrouwen
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Your Hair,<br>Your Style';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging voor mannen en vrouwen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.3);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = '#1f2937';
    $lightBg = '#f8fafc';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background: linear-gradient(135deg, {{ $lightBg }} 0%, #fff 50%, {{ $primaryColor }}08 100%);"
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
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-8" style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background: {{ $primaryColor }};"></span>
                    Nu beschikbaar voor afspraken
                </div>

                @if($title)<h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 leading-tight" style="color: {{ $textColor }};">{!! $title !!}</h1>@endif
                @if($subtitle)<p class="text-lg sm:text-xl mb-10 max-w-xl mx-auto lg:mx-0 text-gray-600">{{ $subtitle }}</p>@endif

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @if($ctaText)
                        <a href="{{ $ctaLink }}" class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl text-white transition-all duration-300 hover:scale-105 hover:shadow-xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}40;">
                            {{ $ctaText }}
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                    <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl transition-all duration-300 hover:bg-gray-100" style="color: {{ $textColor }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Bekijk diensten
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-6 mt-12 pt-8 border-t border-gray-200">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            @for($i = 0; $i < 4; $i++)
                                <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center text-xs font-bold text-white" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});">{{ ['A', 'S', 'M', 'L'][$i] }}</div>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600">500+ happy clients</span>
                    </div>
                    <div class="flex items-center gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        @endfor
                        <span class="text-sm text-gray-600 ml-1">4.9 rating</span>
                    </div>
                </div>
            </div>

            {{-- Image Slider --}}
            <div class="relative">
                <div class="absolute -inset-4 rounded-3xl opacity-20 blur-2xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                <div class="relative w-full h-[500px] lg:h-[600px] rounded-3xl overflow-hidden shadow-2xl">
                    @foreach($sliderImages as $index => $media)
                        <div class="absolute inset-0 transition-opacity duration-1000" x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                            @if($overlayOpacity > 0)<div class="absolute inset-0" style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"></div>@endif
                        </div>
                    @endforeach
                </div>

                {{-- Floating card --}}
                <div class="absolute -bottom-6 -left-6 p-4 rounded-2xl bg-white shadow-xl hidden lg:block" style="box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Direct boeken</p>
                            <p class="text-sm text-gray-500">Online beschikbaar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-xl transition-all duration-300 hover:scale-110" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); color: white;" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-xl transition-all duration-300 hover:scale-110" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); color: white;" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            @foreach($sliderImages as $index => $media)
                <button class="w-3 h-3 rounded-full transition-all duration-300" :class="currentSlide === {{ $index }} ? 'scale-125' : 'opacity-40'" :style="currentSlide === {{ $index }} ? 'background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }})' : 'background-color: #9ca3af'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center" style="background: linear-gradient(135deg, {{ $lightBg }} 0%, #fff 50%, {{ $primaryColor }}08 100%);">
    <div class="mx-auto max-w-4xl text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-bold mb-6" style="color: {{ $textColor }};">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8 text-gray-600">{{ $subtitle }}</p>@endif
        <p class="text-sm text-gray-400">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
