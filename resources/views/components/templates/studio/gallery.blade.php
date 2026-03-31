{{--
    Template-specifieke gallery voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Our Work';
    $subtitle = $content['subtitle'] ?? __('Scroll through our latest creations');

    // Get images from Spatie Media Library
    $mediaItems = $section?->getMedia('images') ?? collect();

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
    $headingFont = $theme['heading_font_family'] ?? 'Abril Fatface';
    $bodyFont = $theme['font_family'] ?? 'Nunito';

    $rotations = ['rotate-2', '-rotate-1', 'rotate-1', '-rotate-2', 'rotate-3', '-rotate-1', 'rotate-1', '-rotate-3'];
@endphp

<section id="gallery" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $backgroundColor }};">


    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6 transform -rotate-1"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                GALLERY
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-xl max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Gallery grid --}}
        @if($mediaItems->count() > 0)
            <div
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                x-data="{
                    open: false,
                    currentSrc: '',
                    currentAlt: '',
                    images: {{ json_encode($mediaItems->map(fn($m) => ['src' => $m->getUrl(), 'alt' => $m->name])->values()) }},
                    currentIndex: 0,
                    openLightbox(index) {
                        this.currentIndex = index;
                        this.currentSrc = this.images[index].src;
                        this.currentAlt = this.images[index].alt;
                        this.open = true;
                    },
                    prev() {
                        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                        this.currentSrc = this.images[this.currentIndex].src;
                        this.currentAlt = this.images[this.currentIndex].alt;
                    },
                    next() {
                        this.currentIndex = (this.currentIndex + 1) % this.images.length;
                        this.currentSrc = this.images[this.currentIndex].src;
                        this.currentAlt = this.images[this.currentIndex].alt;
                    }
                }"
                @keydown.escape.window="open = false"
                @keydown.arrow-left.window="if(open) prev()"
                @keydown.arrow-right.window="if(open) next()"
            >
                @foreach($mediaItems as $index => $media)
                    <div
                        class="group relative aspect-square overflow-hidden rounded-3xl cursor-pointer transform transition-all duration-300 hover:scale-105 hover:rotate-0 {{ $rotations[$index % 8] }}"
                        style="box-shadow: 6px 6px 0 {{ $index % 2 === 0 ? $primaryColor : $secondaryColor }};"
                        @click="openLightbox({{ $index }})"
                    >
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $media->name }}"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110"
                        />
                        {{-- Hover overlay --}}
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                            style="background: {{ $primaryColor }}E6;"
                        >
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                    </div>
                @endforeach

                {{-- Lightbox modal --}}
                <template x-teleport="body">
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                    style="background: rgba(0,0,0,0.9);"
                    @click.self="open = false"
                >
                    {{-- Close button --}}
                    <button
                        @click="open = false"
                        class="absolute top-4 right-4 hover:opacity-70 transition-opacity z-10"
                        style="color: {{ $primaryColor }};"
                    >
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- Prev button --}}
                    <button
                        @click="prev()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 hover:opacity-70 transition-opacity z-10"
                        style="color: {{ $primaryColor }};"
                    >
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    {{-- Image --}}
                    <img
                        :src="currentSrc"
                        :alt="currentAlt"
                        class="max-h-[85vh] max-w-[85vw] object-contain rounded-2xl"
                    />

                    {{-- Next button --}}
                    <button
                        @click="next()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 hover:opacity-70 transition-opacity z-10"
                        style="color: {{ $primaryColor }};"
                    >
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Counter --}}
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/70 text-sm">
                        <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                    </div>
                </div>
                </template>
            </div>
        @else
            {{-- Placeholder grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @for($i = 0; $i < 8; $i++)
                    <div
                        class="relative aspect-square rounded-3xl flex items-center justify-center transform {{ $rotations[$i % 8] }}"
                        style="background: {{ $i % 2 === 0 ? $accentColor : $primaryColor }}30; box-shadow: 6px 6px 0 {{ $i % 2 === 0 ? $primaryColor : $secondaryColor }};"
                    >
                        <svg class="w-12 h-12" style="color: {{ $i % 2 === 0 ? $primaryColor : $secondaryColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>
