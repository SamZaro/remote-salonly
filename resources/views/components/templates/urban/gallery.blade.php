{{--
    Urban Template: Gallery Section
    Dark section — horizontal card carousel with prev/next buttons + lightbox
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title    = $content['title'] ?? 'Ons Werk';
    $subtitle = $content['subtitle'] ?? 'Bekijk onze recente resultaten';
    $images   = $section?->getMedia('images') ?? collect();

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">

    @if($images->isNotEmpty())
        <div x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }">

            {{-- Header with nav buttons --}}
            <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12 mb-10">
                <div
                    class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6"
                    x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
                >
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                            <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                                Galerij
                            </span>
                        </div>
                        <h2
                            class="font-black uppercase leading-[0.9]"
                            style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: #ffffff;"
                        >
                            {{ $title }}
                        </h2>
                        <p class="mt-3 text-base" style="color: rgba(255,255,255,0.45); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
                    </div>

                    @if($images->count() > 3)
                        <div class="flex gap-2 shrink-0">
                            <button
                                class="w-12 h-12 flex items-center justify-center border transition-all duration-300 hover:bg-white/5"
                                style="border-color: rgba(255,255,255,0.2); color: #ffffff;"
                                @click="$refs.carousel.scrollBy({ left: -360, behavior: 'smooth' })"
                                aria-label="Vorige"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center transition-all duration-300 hover:opacity-85"
                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                                @click="$refs.carousel.scrollBy({ left: 360, behavior: 'smooth' })"
                                aria-label="Volgende"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Horizontal carousel --}}
            <div
                x-ref="carousel"
                class="flex gap-4 overflow-x-auto pb-4 px-6 sm:px-8 lg:px-[max(1.5rem,calc((100vw-80rem)/2+3rem))] snap-x snap-mandatory"
                style="-ms-overflow-style: none; scrollbar-width: none;"
            >
                @foreach($images->take(12) as $index => $image)
                    <div
                        class="shrink-0 w-[300px] sm:w-[360px] snap-start cursor-pointer group"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <div class="overflow-hidden w-full h-[260px] sm:h-[300px]">
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                loading="lazy"
                            />
                        </div>
                        {{-- Bottom accent --}}
                        <div class="w-0 h-0.5 group-hover:w-full transition-all duration-400" style="background-color: {{ $primaryColor }};"></div>
                    </div>
                @endforeach
            </div>

            {{-- Lightbox --}}
            <template x-teleport="body">
                <div
                    x-show="lightboxOpen"
                    x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center p-4"
                    style="background-color: rgba(15,15,15,0.97);"
                    @click="lightboxOpen = false"
                    @keydown.escape.window="lightboxOpen = false"
                    @keydown.arrow-right.window="currentIndex = (currentIndex + 1) % images.length"
                    @keydown.arrow-left.window="currentIndex = (currentIndex - 1 + images.length) % images.length"
                >
                    <button class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors z-10" @click="lightboxOpen = false">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <button
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-14 h-14 flex items-center justify-center border transition-all z-10 hover:bg-white/10"
                        style="border-color: {{ $primaryColor }}50; color: {{ $primaryColor }};"
                        @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-14 h-14 flex items-center justify-center transition-all z-10 hover:opacity-85"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        @click.stop="currentIndex = (currentIndex + 1) % images.length"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <img :src="images[currentIndex]" alt="" class="max-h-[88vh] max-w-[88vw] object-contain" @click.stop />
                </div>
            </template>
        </div>

    @else
        {{-- Empty state --}}
        <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Galerij</span>
            </div>
            <h2 class="font-black uppercase leading-[0.9] mb-10" style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: #ffffff;">
                {{ $title }}
            </h2>
            <div class="flex gap-4 overflow-hidden">
                @for($i = 0; $i < 4; $i++)
                    <div class="shrink-0 w-[300px] sm:w-[360px] h-[280px] flex items-center justify-center" style="background-color: #1a1a1a;">
                        <svg class="w-10 h-10 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        </div>
    @endif

</section>
