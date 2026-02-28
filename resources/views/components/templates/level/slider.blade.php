{{--
    Level Template: Slider Section
    Full-screen carousel — white text-card anchored at bottom, clean slide counter
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title      = $content['title'] ?? 'Onze Stijlen';
    $subtitle   = $content['subtitle'] ?? 'Creatief. Persoonlijk. On-trend.';
    $ctaText    = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink    = $content['cta_link'] ?? '#contact';
    $autoplay   = (bool) ($content['autoplay'] ?? true);
    $interval   = (int) ($content['interval'] ?? 5000);
    $sliderImages = $section?->getMedia('slider_images') ?? collect();

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';
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
                alt="Look {{ $index + 1 }}"
                class="w-full h-full object-cover"
                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
            />
            {{-- Light gradient for text card legibility --}}
            <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 40%, transparent 70%);"></div>
        </div>
    @endforeach

    {{-- Slide counter — top left --}}
    <div class="absolute top-10 left-8 lg:left-12 z-20 flex items-baseline gap-2">
        <span class="font-black text-white" style="font-family: '{{ $headingFont }}'; font-size: 1.5rem; letter-spacing: -0.03em;">
            <span x-text="String(currentSlide + 1).padStart(2, '0')">01</span>
        </span>
        <div class="w-px h-4 self-center" style="background-color: rgba(255,255,255,0.4);"></div>
        <span class="text-sm font-light" style="color: rgba(255,255,255,0.45); font-family: '{{ $bodyFont }}';">
            {{ str_pad($sliderImages->count(), 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    {{-- Orange top line --}}
    <div class="absolute top-0 inset-x-0 h-1 z-20" style="background-color: {{ $primaryColor }};"></div>

    {{-- Content card — white panel anchored bottom --}}
    <div class="relative z-10 w-full">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12 pb-8">
            <div
                class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 p-8 sm:p-10 lg:p-12"
                style="background-color: {{ $backgroundColor }};"
            >
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-6 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Kapsalon</span>
                    </div>
                    <h2
                        class="font-black leading-[0.9] mb-3"
                        style="font-family: '{{ $headingFont }}'; font-size: clamp(2rem, 5vw, 4rem); letter-spacing: -0.03em; color: {{ $secondaryColor }};"
                    >
                        {!! $title !!}
                    </h2>
                    @if($subtitle)
                        <p class="text-base font-light" style="color: #888888; font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
                    @endif
                </div>

                <div class="flex items-center gap-4 shrink-0">
                    @if($ctaText)
                        <a
                            href="{{ $ctaLink }}"
                            class="group inline-flex items-center gap-2 px-7 py-4 font-semibold uppercase tracking-widest text-sm transition-all hover:opacity-90"
                            style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}';"
                        >
                            {{ $ctaText }}
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @endif

                    {{-- Prev/Next arrows --}}
                    @if($sliderImages->count() > 1)
                        <div class="flex gap-1">
                            <button
                                @click="prevSlide()"
                                class="w-12 h-12 flex items-center justify-center border transition-all duration-200"
                                style="border-color: #e0e0e0; color: {{ $secondaryColor }};"
                                onmouseover="this.style.borderColor='{{ $primaryColor }}'; this.style.color='{{ $primaryColor }}'"
                                onmouseout="this.style.borderColor='#e0e0e0'; this.style.color='{{ $secondaryColor }}'"
                                aria-label="Vorige"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button
                                @click="nextSlide()"
                                class="w-12 h-12 flex items-center justify-center transition-all duration-200"
                                style="background-color: {{ $secondaryColor }}; color: #ffffff;"
                                onmouseover="this.style.backgroundColor='{{ $primaryColor }}'"
                                onmouseout="this.style.backgroundColor='{{ $secondaryColor }}'"
                                aria-label="Volgende"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Progress dots --}}
            @if($sliderImages->count() > 1)
                <div class="flex gap-1.5 mt-3">
                    @foreach($sliderImages as $index => $media)
                        <button
                            @click="currentSlide = {{ $index }}; stopAutoplay();"
                            class="h-0.5 transition-all duration-400"
                            :style="currentSlide === {{ $index }} ? 'width: 32px; background-color: {{ $primaryColor }};' : 'width: 12px; background-color: #d0d0d0;'"
                            aria-label="Slide {{ $index + 1 }}"
                        ></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@else
{{-- Fallback without images --}}
<section
    id="slider"
    class="relative min-h-screen flex items-end overflow-hidden"
    style="background-color: {{ $secondaryColor }};"
>
    <div class="absolute top-0 inset-x-0 h-1" style="background-color: {{ $primaryColor }};"></div>
    <div class="relative z-10 w-full">
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12 pb-8">
            <div class="p-10 lg:p-14" style="background-color: {{ $backgroundColor }};">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-6 h-1" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Kapsalon</span>
                </div>
                <h2 class="font-black leading-[0.9] mb-4" style="font-family: '{{ $headingFont }}'; font-size: clamp(2rem, 5vw, 4rem); letter-spacing: -0.03em; color: {{ $secondaryColor }};">
                    {!! $title !!}
                </h2>
                @if($subtitle)
                    <p class="text-base font-light mb-6" style="color: #888888; font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
                @endif
                @if($ctaText)
                    <a href="{{ $ctaLink }}" class="inline-flex items-center gap-2 px-7 py-4 font-semibold uppercase tracking-widest text-sm hover:opacity-90" style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}';">
                        {{ $ctaText }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif
