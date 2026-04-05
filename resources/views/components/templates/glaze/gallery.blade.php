{{--
    Glaze Template: Gallery Section
    Masonry-style grid with rose hover accents and lightbox
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Gallery';
    $subtitle = $content['subtitle'] ?? __('Results');
    $images = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';
    $textColor = '#ffffff';
    $backgroundColor = $theme['gallery_background'] ?? $secondaryColor;
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">{{ $subtitle }}</span>
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold"
                style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', sans-serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid --}}
        @if($images->isNotEmpty())
            <div
                class="lg:max-w-5xl lg:mx-auto grid grid-cols-2 md:grid-cols-3 gap-3"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(12) as $index => $image)
                    <div
                        class="group cursor-pointer relative rounded-xl overflow-hidden"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'scale(1)'"
                        style="opacity: 0; transform: scale(0.95); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.08 }}s;"
                    >
                        <div class="relative aspect-square overflow-hidden">
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-400" style="background: linear-gradient(to top, {{ $primaryColor }}90, transparent);">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <button class="absolute top-4 right-4 w-10 h-10 rounded-full flex items-center justify-center hover:opacity-70 transition-opacity z-10" style="background-color: {{ $primaryColor }}30; color: #ffffff;" @click="lightboxOpen = false">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full flex items-center justify-center hover:opacity-70 transition-opacity z-10" style="background-color: {{ $primaryColor }}30; color: #ffffff;" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full flex items-center justify-center hover:opacity-70 transition-opacity z-10" style="background-color: {{ $primaryColor }}30; color: #ffffff;" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <img :src="images[currentIndex]" alt="" class="max-h-[85vh] max-w-[85vw] object-contain rounded-xl" @click.stop />
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="lg:max-w-5xl lg:mx-auto grid grid-cols-2 md:grid-cols-3 gap-3">
                @for($i = 0; $i < 6; $i++)
                    <div class="aspect-square rounded-xl flex items-center justify-center" style="background-color: {{ $primaryColor }}08;">
                        <svg class="w-12 h-12 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif

        {{-- Bottom decorative line --}}
        <div class="flex items-center justify-center mt-16">
            <div class="h-0.5 w-32 rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
