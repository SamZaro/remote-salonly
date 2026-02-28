{{--
    Spa Template: Gallery Section
    Serene spa & wellness — horizontal scrolling gallery with hover captions and lightbox
    Fonts: Playfair Display (headings) + Lato (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Beautiful Skin Starts Here';
    $subtitle = $content['subtitle'] ?? 'Onze galerij';
    $images = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    @if($images->isNotEmpty())
        <div
            x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
        >
            {{-- Header with navigation --}}
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-12"
                    x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
                >
                    <div class="relative">
                        <span
                            class="absolute top-[-20px] left-0 whitespace-nowrap pointer-events-none select-none font-bold"
                            style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.05; color: {{ $secondaryColor }}; font-family: 'Playfair Display', serif;"
                        >Gallery</span>

                        <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: 'Lato', sans-serif;">
                            {{ $subtitle }}
                        </span>
                        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                            {{ $title }}
                        </h2>
                    </div>

                    @if($images->count() > 3)
                        <div class="flex gap-2 shrink-0">
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300 hover:shadow-sm"
                                style="border: 1.5px solid {{ $secondaryColor }}30; color: {{ $secondaryColor }};"
                                @click="$refs.carousel.scrollBy({ left: -340, behavior: 'smooth' })"
                                aria-label="Vorige"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <button
                                class="w-12 h-12 flex items-center justify-center rounded-full transition-all duration-300"
                                style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
                                @click="$refs.carousel.scrollBy({ left: 340, behavior: 'smooth' })"
                                aria-label="Volgende"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Horizontal Carousel --}}
            <div
                x-ref="carousel"
                class="flex gap-5 overflow-x-auto pb-4 px-4 sm:px-6 lg:px-[max(1.5rem,calc((100vw-80rem)/2+1.5rem))] snap-x snap-mandatory"
                style="-ms-overflow-style: none; scrollbar-width: thin; scrollbar-color: {{ $primaryColor }} transparent;"
            >
                @foreach($images->take(12) as $index => $image)
                    <div
                        class="shrink-0 w-[280px] sm:w-[320px] snap-start cursor-pointer group"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <div class="relative overflow-hidden rounded-lg">
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-[240px] sm:h-[280px] object-cover transition-transform duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                            {{-- Hover overlay with caption --}}
                            <div
                                class="absolute inset-0 flex items-end p-5 transition-opacity duration-300 opacity-0 group-hover:opacity-100"
                                style="background: linear-gradient(transparent 40%, rgba(0,0,0,0.5) 100%);"
                            >
                                <div>
                                    <h6 class="text-white text-base font-bold" style="font-family: 'Playfair Display', serif;">{{ $image->name ?: 'Spa & Wellness' }}</h6>
                                    <p class="text-white/70 text-sm" style="font-family: 'Lato', sans-serif;">Spa & Beauty</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Lightbox --}}
            <template x-teleport="body">
                <div
                    x-show="lightboxOpen"
                    x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center p-4"
                    style="background-color: rgba(110, 95, 91, 0.95);"
                    @click="lightboxOpen = false"
                    @keydown.escape.window="lightboxOpen = false"
                    @keydown.arrow-right.window="currentIndex = (currentIndex + 1) % images.length"
                    @keydown.arrow-left.window="currentIndex = (currentIndex - 1 + images.length) % images.length"
                >
                    <button class="absolute top-4 right-4 text-white/70 hover:text-white transition-colors z-10" @click="lightboxOpen = false">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors z-10" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors z-10" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <img :src="images[currentIndex]" alt="" class="max-h-[85vh] max-w-[90vw] object-contain rounded-lg" @click.stop />
                </div>
            </template>
        </div>
    @else
        {{-- Empty state --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: 'Lato', sans-serif;">
                    {{ $subtitle }}
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-2" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                    {{ $title }}
                </h2>
            </div>
            <div class="flex gap-5 overflow-hidden">
                @for($i = 0; $i < 4; $i++)
                    <div class="shrink-0 w-[280px] sm:w-[320px]">
                        <div
                            class="w-full h-[240px] sm:h-[280px] flex items-center justify-center rounded-lg"
                            style="background-color: {{ $primaryColor }};"
                        >
                            <svg class="w-10 h-10" style="color: {{ $secondaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    @endif
</section>
