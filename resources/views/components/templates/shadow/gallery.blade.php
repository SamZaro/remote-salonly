{{--
    Template-specifieke gallery voor Shadow (Barbershop)


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

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          {{-- Section header --}}
        <div class="text-center mb-24">
            <span
                class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
            >
                Ons Werk
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4"
                style="color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
            <p
                class="text-lg max-w-2xl mx-auto opacity-75"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>
        </div>

        {{-- Gallery Grid with hover cards --}}
        @if($images->isNotEmpty())
            <div
                class="lg:max-w-5xl lg:mx-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(16) as $index => $image)
                    <div
                        class="group cursor-pointer relative"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
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
                        <button class="absolute top-4 right-4 hover:opacity-70 transition-opacity z-10 text-gray-300" @click="lightboxOpen = false">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 hover:opacity-70 transition-opacity z-10 text-gray-300" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 hover:opacity-70 transition-opacity z-10 text-gray-300" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="lg:max-w-5xl lg:mx-auto grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
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
