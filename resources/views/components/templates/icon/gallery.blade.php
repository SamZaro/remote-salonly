{{--
    Icon Template: Gallery Section
    "Warm Atelier" — editorial image grid, gold accents, sharp edges, elegant lightbox
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

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section id="gallery" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            {{-- Label --}}
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                    Galerij
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>

            {{-- Heading --}}
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
            >
                {{ $title }}
            </h2>

            {{-- Subtitle --}}
            @if($subtitle)
                <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $textColor }};">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        {{-- Gallery Grid --}}
        @if($images->isNotEmpty())
            <div
                class="grid grid-cols-2 md:grid-cols-3 gap-5 lg:gap-6"
                x-data="{ lightboxOpen: false, currentIndex: 0, images: {{ $images->map(fn($img) => $img->getUrl())->values()->toJson() }} }"
            >
                @foreach($images->take(9) as $index => $image)
                    <div
                        class="group cursor-pointer"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.08 }}s;"
                        @click="currentIndex = {{ $index }}; lightboxOpen = true"
                    >
                        <div
                            class="relative aspect-square overflow-hidden transition-all duration-500"
                            style="border: 1px solid {{ $headingColor }}06;"
                            onmouseover="this.style.borderColor='{{ $primaryColor }}30'"
                            onmouseout="this.style.borderColor='{{ $headingColor }}06'"
                        >
                            <img
                                src="{{ $image->getUrl('thumb') ?: $image->getUrl() }}"
                                alt="{{ $image->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                loading="lazy"
                            />

                            {{-- Hover overlay --}}
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center"
                                style="background-color: {{ $secondaryColor }}99;"
                            >
                                <div class="transform scale-75 group-hover:scale-100 transition-transform duration-500">
                                    {{-- Zoom icon: thin stroke, white --}}
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/>
                                    </svg>
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
                        {{-- Close button --}}
                        <button
                            class="absolute top-6 right-6 text-white transition-opacity duration-300 hover:opacity-70 z-10"
                            @click="lightboxOpen = false"
                        >
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        {{-- Previous button --}}
                        <button
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center text-white transition-all duration-300 hover:brightness-110 z-10"
                            style="background-color: {{ $primaryColor }};"
                            @click.stop="currentIndex = (currentIndex - 1 + images.length) % images.length"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>

                        {{-- Next button --}}
                        <button
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center text-white transition-all duration-300 hover:brightness-110 z-10"
                            style="background-color: {{ $primaryColor }};"
                            @click.stop="currentIndex = (currentIndex + 1) % images.length"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        {{-- Image with white border frame --}}
                        <div
                            class="p-[2px]"
                            style="border: 2px solid {{ $backgroundColor }};"
                            @click.stop
                        >
                            <img
                                :src="images[currentIndex]"
                                alt=""
                                class="max-h-[85vh] max-w-[85vw] object-contain"
                            />
                        </div>
                    </div>
                </template>
            </div>
        @else
            {{-- Placeholder grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5 lg:gap-6">
                @for($i = 0; $i < 9; $i++)
                    <div
                        class="aspect-square flex items-center justify-center"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="background-color: {{ $primaryColor }}04; border: 1px solid {{ $primaryColor }}08; opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $i * 0.08 }}s;"
                    >
                        <svg class="w-12 h-12" style="color: {{ $primaryColor }}15;" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
