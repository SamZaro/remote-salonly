{{--
    Template-specifieke gallery voor Razor (Barbershop)

    Bold barbershop stijl met goud/zwart thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Gallery';
    $subtitle = $content['subtitle'] ?? 'Premium Grooming';
    $images = $section?->getMedia('images') ?? collect();

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Bebas Neue';
    $bodyFont = $theme['font_family'] ?? 'Barlow';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-4 mt-6">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <div class="w-3 h-3" style="background-color: {{ $primaryColor }}; transform: rotate(45deg);"></div>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
        </div>

        {{-- Gallery Grid with bold frames --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-3 gap-1"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    <div
                        class="group cursor-pointer relative"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.08 }}s;"
                    >
                        <div class="relative aspect-square overflow-hidden">
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                                style="filter: contrast(1.05);"
                                loading="lazy"
                            />
                            {{-- Bold overlay --}}
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center"
                                style="background-color: {{ $secondaryColor }}e0;"
                            >
                                <div class="relative">
                                    {{-- Corner accents --}}
                                    <div class="absolute -top-4 -left-4 w-6 h-6 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                                    <div class="absolute -top-4 -right-4 w-6 h-6 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                                    <div class="absolute -bottom-4 -left-4 w-6 h-6 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                                    <div class="absolute -bottom-4 -right-4 w-6 h-6 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                                    <svg class="w-10 h-10" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        {{-- Bottom accent line --}}
                        <div class="absolute bottom-0 left-0 right-0 h-1 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left" style="background-color: {{ $primaryColor }};"></div>
                    </div>
                @endforeach

                {{-- Lightbox --}}
                <template x-teleport="body">
                    <div
                        x-show="lightboxOpen"
                        x-cloak
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        style="background-color: {{ $secondaryColor }}fa;"
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
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 w-14 h-14 flex items-center justify-center transition-all z-10 border-2 hover:bg-white/10" style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }};" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 w-14 h-14 flex items-center justify-center transition-all z-10 border-2 hover:bg-white/10" style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }};" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="relative">
                            {{-- Frame corners --}}
                            <div class="absolute -top-3 -left-3 w-8 h-8 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                            <div class="absolute -bottom-3 -left-3 w-8 h-8 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                            <div class="absolute -bottom-3 -right-3 w-8 h-8 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                            <img :src="images[currentIndex]" alt="" class="max-h-[85vh] max-w-[85vw] object-contain" @click.stop />
                        </div>
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-3 gap-1">
                @for($i = 0; $i < 9; $i++)
                    <div class="aspect-square flex items-center justify-center" style="background-color: {{ $secondaryColor }};">
                        <svg class="w-10 h-10 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
