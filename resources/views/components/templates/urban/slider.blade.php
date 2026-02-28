{{--
    Urban Template: Slider Section
    Full-screen carousel, editorial layout, slide counter, sharp angles
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title      = $content['title'] ?? 'Sharp Looks.<br>Clean Cuts.';
    $subtitle   = $content['subtitle'] ?? 'Traditioneel vakmanschap met moderne flair';
    $ctaText    = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink    = $content['cta_link'] ?? '#contact';
    $autoplay   = (bool) ($content['autoplay'] ?? true);
    $interval   = (int) ($content['interval'] ?? 5000);
    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

@if($sliderImages->isNotEmpty())
<section
    id="slider"
    class="relative min-h-screen flex items-end overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
    x-data="{
        currentSlide: 0,
        totalSlides: {{ $sliderImages->count() }},
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        interval: {{ $interval }},
        timer: null,
        init() { if (this.autoplay) this.startAutoplay(); },
        startAutoplay() { this.timer = setInterval(() => this.nextSlide(), this.interval); },
        stopAutoplay()  { if (this.timer) { clearInterval(this.timer); this.timer = null; } },
        nextSlide() { this.currentSlide = (this.currentSlide + 1) % this.totalSlides; },
        prevSlide() { this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides; },
    }"
    @mouseenter="stopAutoplay()"
    @mouseleave="autoplay && startAutoplay()"
>
    {{-- Slides --}}
    @foreach($sliderImages as $index => $media)
        <div
            class="absolute inset-0 transition-opacity duration-1000"
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <img
                src="{{ $media->getUrl('slider') ?: $media->getUrl() }}"
                alt="Slide {{ $index + 1 }}"
                class="w-full h-full object-cover"
                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
            />
            <div class="absolute inset-0" style="background: linear-gradient(to top, {{ $secondaryColor }} 0%, {{ $secondaryColor }}cc 25%, {{ $secondaryColor }}40 65%, transparent 100%);"></div>
        </div>
    @endforeach

    {{-- Slide counter — top right --}}
    <div class="absolute top-10 right-8 lg:right-12 z-20 flex items-center gap-3">
        <span class="text-sm font-bold" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
            <span x-text="String(currentSlide + 1).padStart(2, '0')">01</span>
        </span>
        <div class="w-12 h-px" style="background-color: rgba(255,255,255,0.2);"></div>
        <span class="text-sm opacity-40 text-white" style="font-family: '{{ $bodyFont }}';">
            {{ str_pad($sliderImages->count(), 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    {{-- Vertical nav arrows — right side --}}
    @if($sliderImages->count() > 1)
        <div class="absolute right-8 lg:right-12 top-1/2 -translate-y-1/2 z-20 flex flex-col gap-3">
            <button
                @click="prevSlide()"
                class="w-11 h-11 flex items-center justify-center border transition-all duration-300 hover:bg-white/10"
                style="border-color: rgba(255,255,255,0.2); color: #ffffff;"
                aria-label="Vorige slide"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" transform="rotate(0)"/>
                </svg>
            </button>
            <button
                @click="nextSlide()"
                class="w-11 h-11 flex items-center justify-center transition-all duration-300 hover:opacity-85"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                aria-label="Volgende slide"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 w-full pb-20 lg:pb-28 pt-32">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
            <div class="max-w-3xl lg:pl-12">

                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                        Premium Barbershop
                    </span>
                </div>

                <h1
                    class="font-black uppercase leading-[0.9] mb-10"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(2.8rem, 7vw, 6rem); letter-spacing: -0.02em; color: #ffffff;"
                >
                    {!! $title !!}
                </h1>

                @if($subtitle)
                    <p class="text-xl mb-12 max-w-md" style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}';">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($ctaText)
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:opacity-85"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                    >
                        {{ $ctaText }}
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Progress bars — bottom --}}
    @if($sliderImages->count() > 1)
        <div class="absolute bottom-8 left-6 sm:left-8 lg:left-12 z-20 flex gap-2">
            @foreach($sliderImages as $index => $media)
                <button
                    @click="currentSlide = {{ $index }}; stopAutoplay();"
                    class="h-0.5 transition-all duration-300"
                    :style="currentSlide === {{ $index }} ? 'width: 48px; background-color: {{ $primaryColor }};' : 'width: 20px; background-color: rgba(255,255,255,0.3);'"
                    aria-label="Ga naar slide {{ $index + 1 }}"
                ></button>
            @endforeach
        </div>
    @endif
</section>
@else
{{-- Fallback without images --}}
<section
    id="slider"
    class="relative min-h-screen flex items-end overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    <div class="relative z-10 w-full pb-20 lg:pb-28 pt-32">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
            <div class="max-w-3xl lg:pl-12">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Premium Barbershop</span>
                </div>
                <h1 class="font-black uppercase leading-[0.9] mb-10" style="font-family: '{{ $headingFont }}'; font-size: clamp(2.8rem, 7vw, 6rem); letter-spacing: -0.02em; color: #ffffff;">
                    {!! $title !!}
                </h1>
                @if($subtitle)
                    <p class="text-xl mb-12 max-w-md" style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
                @endif
                @if($ctaText)
                    <a href="{{ $ctaLink }}" class="inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm hover:opacity-85" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';">
                        {{ $ctaText }}
                    </a>
                @endif
                <p class="mt-12 text-sm opacity-30 text-white" style="font-family: '{{ $bodyFont }}';">{{ __('Upload slider images in the admin panel.') }}</p>
            </div>
        </div>
    </div>
</section>
@endif
