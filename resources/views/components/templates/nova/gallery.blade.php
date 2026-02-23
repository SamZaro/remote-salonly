{{--
    Template-specifieke gallery voor Nova (Kapsalon)

    Elegante kapsalon stijl met warme bruintinten
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Portfolio';
    $subtitle = $content['subtitle'] ?? 'Onze creaties';
    $images = $section?->getMedia('images') ?? collect();

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $textColor = '#ffffff';  // Gallery altijd wit op donkere achtergrond
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings (niet gebruikt in gallery)
    $backgroundColor = $theme['gallery_background'] ?? $secondaryColor;
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-sm font-medium uppercase tracking-widest mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl font-extrabold mb-4"
                style="color: {{ $textColor }};"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid with hover cards --}}
        @if($images->isNotEmpty())
            <div
                class="lg:max-w-4xl lg:mx-auto grid grid-cols-3 lg:grid-cols-4 gap-2"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(16) as $index => $image)
                    <div
                        class="group cursor-pointer relative"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                    >
                        <div class="relative aspect-square overflow-hidden">
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:brightness-75"
                                loading="lazy"
                            />
                            {{-- Hover overlay with border effect --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                <div class="absolute inset-4 border-2 transition-all duration-500" style="border-color: {{ $primaryColor }};"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                        <svg class="w-10 h-10" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
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
                        style="background-color: {{ $secondaryColor }}f5;"
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
                        <div class="relative">
                            <div class="absolute -inset-4 border" style="border-color: {{ $primaryColor }}40;"></div>
                            <img :src="images[currentIndex]" alt="" class="max-h-[85vh] max-w-[85vw] object-contain" @click.stop />
                        </div>
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="lg:max-w-4xl lg:mx-auto grid grid-cols-3 lg:grid-cols-4 gap-2">
                @for($i = 0; $i < 9; $i++)
                    <div class="aspect-square flex items-center justify-center" style="background-color: {{ $primaryColor }}10;">
                        <svg class="w-12 h-12 opacity-30" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif

        {{-- Bottom decorative line --}}
        <div class="flex items-center justify-center mt-16">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
