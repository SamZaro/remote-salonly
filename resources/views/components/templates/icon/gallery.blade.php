{{--
    Template-specifieke gallery voor Icon (Hair Salon)

    Modern en fris met lichtblauw/mint thema en card-based design
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Onze Looks';
    $subtitle = $content['subtitle'] ?? 'Inspiratie voor jouw nieuwe stijl';
    $images = $section?->getMedia('images') ?? collect();

    // Theme kleuren - fresh modern salon
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="gallery" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>
        </div>

        {{-- Gallery Grid with modern cards --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-2 md:grid-cols-3 gap-6"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    <div
                        class="group cursor-pointer"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <div
                            class="relative aspect-square overflow-hidden rounded-2xl transition-all duration-500 group-hover:-translate-y-2"
                            style="box-shadow: 0 4px 20px rgba(0,0,0,0.08);"
                            onmouseover="this.style.boxShadow='0 20px 40px rgba(14,165,233,0.2)'"
                            onmouseout="this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'"
                        >
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                            {{-- Gradient overlay --}}
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}90, {{ $secondaryColor }}90);"
                            >
                                <div class="transform scale-75 group-hover:scale-100 transition-transform duration-500">
                                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        style="background: linear-gradient(135deg, {{ $primaryColor }}f0, {{ $secondaryColor }}f0);"
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
                        <button class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-all z-10" @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white/30 transition-all z-10" @click.stop="currentIndex = (currentIndex + 1) % images.length">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <div class="bg-white p-2 rounded-2xl shadow-2xl">
                            <img :src="images[currentIndex]" alt="" class="max-h-[85vh] max-w-[85vw] object-contain rounded-xl" @click.stop />
                        </div>
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @for($i = 0; $i < 9; $i++)
                    <div
                        class="aspect-square rounded-2xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}08, {{ $secondaryColor }}08);"
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
