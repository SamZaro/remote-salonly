{{--
    Template-specifieke gallery voor Barbero (Barbershop)

    Vintage barbershop stijl met goud/donker thema en polaroid-achtige frames
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Ons Werk';
    $subtitle = $content['subtitle'] ?? 'Craftsmanship in elk detail';
    $images = $section?->getMedia('images') ?? collect();

    // Theme kleuren - vintage barbershop
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['gallery_background'] ?? '#0f0f0f';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-xs font-bold uppercase tracking-[0.3em] mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold uppercase tracking-wider text-white"
                style="font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-2 lg:grid-cols-3 gap-6"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    <div
                        class="group cursor-pointer"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        {{-- Polaroid-style frame --}}
                        <div
                            class="p-3 pb-12 transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl relative"
                            style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                        >
                            <div class="relative aspect-square overflow-hidden">
                                <img
                                    src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                    alt="{{ $image->name }}"
                                    class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
                                    style="filter: sepia(20%);"
                                    loading="lazy"
                                />
                                <div
                                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"
                                    style="background-color: {{ $primaryColor }}60;"
                                >
                                    <svg class="w-12 h-12" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </div>
                            {{-- Corner accent --}}
                            <div class="absolute bottom-3 right-3 w-8 h-8" style="border-right: 2px solid {{ $primaryColor }}; border-bottom: 2px solid {{ $primaryColor }};"></div>
                        </div>
                    </div>
                @endforeach

                {{-- Lightbox --}}
                <template x-teleport="body">
                    <div
                        x-show="lightboxOpen"
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        style="background-color: rgba(0,0,0,0.98);"
                        @click="lightboxOpen = false"
                        @keydown.escape.window="lightboxOpen = false"
                        @keydown.arrow-right.window="currentIndex = (currentIndex + 1) % images.length"
                        @keydown.arrow-left.window="currentIndex = (currentIndex - 1 + images.length) % images.length"
                    >
                        <button class="absolute top-4 right-4 hover:opacity-70 transition-opacity z-10" style="color: {{ $primaryColor }};" @click="lightboxOpen = false">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 hover:opacity-70 transition-opacity z-10" style="color: {{ $primaryColor }};" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 hover:opacity-70 transition-opacity z-10" style="color: {{ $primaryColor }};" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="p-4" style="background-color: {{ $secondaryColor }}; border: 2px solid {{ $primaryColor }};">
                            <img :src="images[currentIndex]" alt="" class="max-h-[80vh] max-w-[85vw] object-contain" @click.stop />
                        </div>
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 0; $i < 9; $i++)
                    <div class="p-3 pb-12" style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $primaryColor }}30;">
                        <div class="aspect-square flex items-center justify-center" style="background-color: {{ $primaryColor }}10;">
                            <svg class="w-12 h-12 opacity-30" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
