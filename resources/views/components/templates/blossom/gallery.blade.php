{{--
    Template-specifieke gallery voor Blossom (Luxury Beauty Salon)

    Elegante, zachte stijl met roze/lavendel thema en ronde hoeken
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Onze Gallerij';
    $subtitle = $content['subtitle'] ?? 'Schoonheid in elk detail';
    $images = $section?->getMedia('images') ?? collect();

    // Theme kleuren - luxury beauty salon
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#faf8f5';
@endphp

<section id="gallery" class="py-20 lg:py-28 relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Decorative elements --}}
    <div class="absolute top-20 left-0 w-64 h-64 rounded-full opacity-10" style="background: {{ $primaryColor }}; transform: translateX(-50%);"></div>
    <div class="absolute bottom-20 right-0 w-48 h-48 rounded-full opacity-10" style="background: {{ $secondaryColor }}; transform: translateX(50%);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {{-- Header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid - Masonry-like with varying sizes --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-2 md:grid-cols-3 gap-4"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    @php
                        // Create visual interest with varying sizes
                        $isLarge = in_array($index, [0, 4, 8]);
                        $spanClass = $isLarge ? 'md:col-span-1 md:row-span-1' : '';
                    @endphp
                    <div
                        class="group cursor-pointer {{ $spanClass }}"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <div
                            class="relative aspect-square overflow-hidden rounded-3xl transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl"
                            style="box-shadow: 0 10px 40px {{ $primaryColor }}20;"
                        >
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                            {{-- Gradient overlay --}}
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}80, {{ $secondaryColor }}80);"
                            >
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-14 h-14 rounded-full bg-white/30 flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Lightbox --}}
                <template x-teleport="body">
                    <div
                        x-show="lightboxOpen"
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        style="background: linear-gradient(135deg, rgba(212,145,157,0.95), rgba(201,184,212,0.95));"
                        @click="lightboxOpen = false"
                        @keydown.escape.window="lightboxOpen = false"
                        @keydown.arrow-right.window="currentIndex = (currentIndex + 1) % images.length"
                        @keydown.arrow-left.window="currentIndex = (currentIndex - 1 + images.length) % images.length"
                    >
                        <button class="absolute top-4 right-4 text-white hover:opacity-70 transition-opacity z-10" @click="lightboxOpen = false">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:opacity-70 transition-opacity z-10" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:opacity-70 transition-opacity z-10" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="bg-white p-3 rounded-3xl shadow-2xl">
                            <img :src="images[currentIndex]" alt="" class="max-h-[80vh] max-w-[85vw] object-contain rounded-2xl" @click.stop />
                        </div>
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @for($i = 0; $i < 9; $i++)
                    <div
                        class="aspect-square rounded-3xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}28, {{ $secondaryColor }}28);"
                    >
                        <svg class="w-12 h-12 opacity-50" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
