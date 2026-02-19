{{--
    Studio (Creative Hair Studio) Slider Section

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Create Your<br>Signature Look';
    $subtitle = $content['subtitle'] ?? 'Waar creativiteit en stijl samenkomen. Jouw haar, jouw statement.';
    $ctaText = $content['cta_text'] ?? 'Book Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $autoplay = (bool) ($content['autoplay'] ?? true);
    $interval = (int) ($content['interval'] ?? 5000);
    $overlayOpacity = (float) ($content['overlay_opacity'] ?? 0.3);
    $showIndicators = (bool) ($content['show_indicators'] ?? true);
    $showArrows = (bool) ($content['show_arrows'] ?? true);

    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
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
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold mb-8 transform -rotate-2" style="background: {{ $primaryColor }}; color: white;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    NEW VIBES ONLY
                </div>

                @if($title)<h1 class="text-5xl sm:text-6xl lg:text-7xl font-black mb-6 leading-tight tracking-tight" style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;">{!! $title !!}</h1>@endif
                @if($subtitle)<p class="text-lg sm:text-xl mb-10 max-w-xl mx-auto lg:mx-0" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @if($ctaText)
                        <a href="{{ $ctaLink }}" class="group inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full text-white transition-all duration-300 hover:scale-105 hover:-rotate-1" style="background: {{ $primaryColor }}; box-shadow: 4px 4px 0 {{ $secondaryColor }};">
                            {{ $ctaText }}
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    @endif
                    <a href="#services" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold rounded-full transition-all duration-300 hover:scale-105" style="border: 3px solid {{ $secondaryColor }}; color: {{ $secondaryColor }};">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Bekijk ons werk
                    </a>
                </div>

                {{-- Social proof --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8 mt-12">
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-3">
                            @for($i = 0; $i < 4; $i++)
                                <div class="w-10 h-10 rounded-full border-3 border-white flex items-center justify-center text-sm font-bold text-white" style="background: {{ $i % 2 == 0 ? $primaryColor : $secondaryColor }};">{{ ['L', 'M', 'S', 'J'][$i] }}</div>
                            @endfor
                        </div>
                        <div>
                            <p class="font-bold" style="color: {{ $headingColor }};">1.5K+</p>
                            <p class="text-sm" style="color: {{ $textColor }};">Happy clients</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image Slider --}}
            <div class="relative">
                <div class="absolute -inset-2 rounded-3xl rotate-3" style="background: {{ $primaryColor }};"></div>
                <div class="relative w-full h-[500px] lg:h-[600px] rounded-3xl overflow-hidden" style="box-shadow: 8px 8px 0 {{ $secondaryColor }};">
                    @foreach($sliderImages as $index => $media)
                        <div class="absolute inset-0 transition-opacity duration-1000" x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                            <img src="{{ $media->getUrl('slider') ?: $media->getUrl() }}" alt="Slide {{ $index + 1 }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}"/>
                            @if($overlayOpacity > 0)<div class="absolute inset-0" style="background-color: rgba(0, 0, 0, {{ $overlayOpacity }});"></div>@endif
                        </div>
                    @endforeach
                </div>

                {{-- Floating badge --}}
                <div class="absolute -bottom-4 -left-4 px-6 py-4 rounded-2xl bg-white hidden lg:block transform -rotate-3" style="box-shadow: 4px 4px 0 {{ $primaryColor }};">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center" style="background: {{ $primaryColor }};">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold" style="color: {{ $headingColor }};">Walk-ins Welcome!</p>
                            <p class="text-sm" style="color: {{ $textColor }};">Of boek online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows && $sliderImages->count() > 1)
        <button class="absolute left-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full transition-all duration-300 hover:scale-110 hover:-rotate-6" style="background: {{ $primaryColor }}; color: white; box-shadow: 3px 3px 0 {{ $secondaryColor }};" @click="prevSlide()" aria-label="Previous slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button class="absolute right-4 top-1/2 -translate-y-1/2 z-20 p-3 rounded-full transition-all duration-300 hover:scale-110 hover:rotate-6" style="background: {{ $primaryColor }}; color: white; box-shadow: 3px 3px 0 {{ $secondaryColor }};" @click="nextSlide()" aria-label="Next slide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    @endif

    {{-- Indicators --}}
    @if($showIndicators && $sliderImages->count() > 1)
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-3">
            @foreach($sliderImages as $index => $media)
                <button class="w-4 h-4 rounded-full transition-all duration-300" :class="currentSlide === {{ $index }} ? 'scale-125 rotate-45' : 'opacity-50'" :style="currentSlide === {{ $index }} ? 'background: {{ $primaryColor }}' : 'background: {{ $secondaryColor }}'" @click="goToSlide({{ $index }})" aria-label="Go to slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>
@else
<section id="slider" class="relative min-h-screen flex items-center" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-4xl text-center px-4">
        @if($title)<h1 class="text-5xl sm:text-6xl font-black mb-6" style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;">{!! $title !!}</h1>@endif
        @if($subtitle)<p class="text-lg mb-8" style="color: {{ $textColor }};">{{ $subtitle }}</p>@endif
        <p class="text-sm opacity-50" style="color: {{ $textColor }};">{{ __('Upload slider images in the admin panel.') }}</p>
    </div>
</section>
@endif
