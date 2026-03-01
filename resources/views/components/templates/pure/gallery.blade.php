{{--
    Pure Template: Gallery Section
    Natural & Botanical — masonry grid with hover overlays and lightbox
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Galerij';
    $subtitle = $content['subtitle'] ?? 'Ons werk';
    $images = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';

    // Alternate heights for masonry effect
    $heights = ['h-[380px]', 'h-[480px]', 'h-[420px]', 'h-[500px]', 'h-[360px]', 'h-[450px]'];
@endphp

<section id="gallery" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $accentColor }}20;">
    {{-- Botanical leaf decoration --}}
    <div class="absolute top-16 right-12 opacity-[0.04]">
        <svg class="w-28 h-28" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
        </svg>
    </div>
    <div class="absolute bottom-20 left-8 opacity-[0.03]">
        <svg class="w-24 h-24" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
        </svg>
    </div>

    @if($images->isNotEmpty())
        <div
            x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
        >
            {{-- Header --}}
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="text-center mb-16 relative"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
                >
                    <span
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                        style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
                    >Gallery</span>

                    <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        {{ $subtitle }}
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                        {{ $title }}
                    </h2>
                    <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        Bekijk een selectie van ons werk
                    </p>
                </div>

                {{-- Masonry Grid --}}
                <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
                    @foreach($images->take(12) as $index => $image)
                        <div
                            class="break-inside-avoid group cursor-pointer"
                            @click="currentIndex = {{ $index }}; lightboxOpen = true"
                            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                            x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ ($index % 3) * 0.1 }}s;'"
                        >
                            <div class="relative overflow-hidden rounded-none">
                                <img
                                    src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                    alt="{{ $image->name }}"
                                    class="w-full {{ $heights[$index % count($heights)] }} object-cover transition-transform duration-700 group-hover:scale-105"
                                    loading="{{ $index < 3 ? 'eager' : 'lazy' }}"
                                />
                                {{-- Hover overlay --}}
                                <div
                                    class="absolute inset-0 transition-opacity duration-300 opacity-0 group-hover:opacity-100"
                                    style="background-color: {{ $secondaryColor }}40;"
                                ></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Lightbox --}}
            <template x-teleport="body">
                <div
                    x-show="lightboxOpen"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4"
                    style="background-color: {{ $secondaryColor }}f2;"
                    @click="lightboxOpen = false"
                    @keydown.escape.window="lightboxOpen = false"
                    @keydown.arrow-right.window="lightboxOpen && (currentIndex = (currentIndex + 1) % images.length)"
                    @keydown.arrow-left.window="lightboxOpen && (currentIndex = (currentIndex - 1 + images.length) % images.length)"
                >
                    {{-- Close --}}
                    <button
                        class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center text-white/70 hover:text-white transition-colors z-10"
                        @click="lightboxOpen = false"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- Previous --}}
                    <button
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center rounded-none transition-all duration-300 hover:bg-white/20 z-10"
                        style="background-color: rgba(255,255,255,0.1); backdrop-filter: blur(4px); color: #ffffff;"
                        @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    {{-- Next --}}
                    <button
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center rounded-none transition-all duration-300 hover:bg-white/20 z-10"
                        style="background-color: rgba(255,255,255,0.1); backdrop-filter: blur(4px); color: #ffffff;"
                        @click.stop="currentIndex = (currentIndex + 1) % images.length"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Image --}}
                    <img
                        :src="images[currentIndex]"
                        alt=""
                        class="max-h-[85vh] max-w-[90vw] object-contain rounded-none"
                        @click.stop
                    />

                    {{-- Counter --}}
                    <div
                        class="absolute bottom-6 left-1/2 -translate-x-1/2 text-sm z-10"
                        style="color: rgba(255,255,255,0.6); font-family: '{{ $bodyFont }}', sans-serif;"
                    >
                        <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                    </div>
                </div>
            </template>
        </div>
    @else
        {{-- Empty state --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 relative">
                <span
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                    style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
                >Gallery</span>

                <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                    {{ $subtitle }}
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                    {{ $title }}
                </h2>
            </div>
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
                @for($i = 0; $i < 6; $i++)
                    <div class="break-inside-avoid">
                        <div
                            class="w-full {{ $heights[$i % count($heights)] }} flex items-center justify-center rounded-none"
                            style="background-color: {{ $accentColor }}30;"
                        >
                            <svg class="w-10 h-10" style="color: {{ $primaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    @endif
</section>
