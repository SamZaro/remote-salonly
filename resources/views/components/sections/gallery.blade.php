{{--
    Default gallery section

    Toont een grid van afbeeldingen uit de Media Library met lightbox
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Gallerij';
    $subtitle = $content['subtitle'] ?? 'Bekijk ons werk';
    $images = $section?->getMedia('images') ?? collect();

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#3b82f6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $headingColor = $theme['heading_color'] ?? '#111827';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            @if($subtitle)
                <p
                    class="text-sm font-semibold uppercase tracking-wider mb-3"
                    style="color: {{ $primaryColor }};"
                >
                    {{ $subtitle }}
                </p>
            @endif
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                style="color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-2 md:grid-cols-3 gap-4"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    <div
                        class="relative aspect-square overflow-hidden rounded-lg group cursor-pointer"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <img
                            src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                            alt="{{ $image->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            loading="lazy"
                        />
                        <div
                            class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}80;"
                        >
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                    </div>
                @endforeach

                {{-- Lightbox --}}
                <template x-teleport="body">
                    <div
                        x-show="lightboxOpen"
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        style="background-color: rgba(0,0,0,0.95);"
                        @click="lightboxOpen = false"
                        @keydown.escape.window="lightboxOpen = false"
                        @keydown.arrow-right.window="currentIndex = (currentIndex + 1) % images.length"
                        @keydown.arrow-left.window="currentIndex = (currentIndex - 1 + images.length) % images.length"
                    >
                        {{-- Close button --}}
                        <button
                            class="absolute top-4 right-4 text-white hover:opacity-70 transition-opacity z-10"
                            @click="lightboxOpen = false"
                        >
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Previous button --}}
                        <button
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:opacity-70 transition-opacity z-10"
                            @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length"
                        >
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        {{-- Next button --}}
                        <button
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:opacity-70 transition-opacity z-10"
                            @click.stop="currentIndex = (currentIndex + 1) % images.length"
                        >
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        {{-- Image --}}
                        <img
                            :src="images[currentIndex]"
                            alt=""
                            class="max-h-[90vh] max-w-[90vw] object-contain"
                            @click.stop
                        />
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @for($i = 0; $i < 9; $i++)
                    <div
                        class="aspect-square rounded-lg flex items-center justify-center"
                        style="background-color: {{ $primaryColor }}10;"
                    >
                        <svg class="w-12 h-12 opacity-30" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
