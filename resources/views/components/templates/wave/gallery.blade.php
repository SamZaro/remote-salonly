{{--
    Wave Template: Gallery Section
    "Coastal Minimal" — rounded grid, soft hover, ocean-blue lightbox, wave accent
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

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section id="gallery" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Wave divider top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="#ffffff">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {{-- Header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15]"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-2 md:grid-cols-3 gap-3 lg:gap-4"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    <div
                        class="group cursor-pointer"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'scale(1)'"
                        style="opacity: 0; transform: scale(0.95); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ ($index % 3) * 0.08 }}s;"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <div class="relative aspect-square overflow-hidden rounded-xl">
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                            {{-- Hover overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-center">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500"
                                        style="background-color: {{ $primaryColor }}; backdrop-filter: blur(8px);"
                                    >
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        style="background-color: {{ $secondaryColor }}f2;"
                        @click="lightboxOpen = false"
                        @keydown.escape.window="lightboxOpen = false"
                        @keydown.arrow-right.window="currentIndex = (currentIndex + 1) % images.length"
                        @keydown.arrow-left.window="currentIndex = (currentIndex - 1 + images.length) % images.length"
                    >
                        {{-- Close --}}
                        <button
                            class="absolute top-6 right-6 w-10 h-10 rounded-full flex items-center justify-center z-10 transition-all duration-300 hover:scale-110"
                            style="background: rgba(255,255,255,0.1); color: #ffffff; backdrop-filter: blur(8px);"
                            @click="lightboxOpen = false"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Previous --}}
                        <button
                            class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full flex items-center justify-center z-10 transition-all duration-300 hover:scale-110"
                            style="background: rgba(255,255,255,0.1); color: #ffffff; backdrop-filter: blur(8px);"
                            @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        {{-- Next --}}
                        <button
                            class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full flex items-center justify-center z-10 transition-all duration-300 hover:scale-110"
                            style="background: rgba(255,255,255,0.1); color: #ffffff; backdrop-filter: blur(8px);"
                            @click.stop="currentIndex = (currentIndex + 1) % images.length"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        {{-- Image --}}
                        <img :src="images[currentIndex]" alt="" class="max-h-[85vh] max-w-[85vw] object-contain rounded-lg" @click.stop />
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 lg:gap-4">
                @for($i = 0; $i < 9; $i++)
                    <div
                        class="aspect-square flex items-center justify-center rounded-xl"
                        style="background-color: {{ $primaryColor }}15; border: 1px dashed {{ $primaryColor }}30;"
                    >
                        <svg class="w-10 h-10" style="color: {{ $primaryColor }}45;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
