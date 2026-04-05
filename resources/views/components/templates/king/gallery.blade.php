{{--
    King Template: Gallery Section
    "Royal Throne" — editorial 3x3 grid, diamond accents, lightbox with gold nav
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Signature Styles');
    $subtitle = $content['subtitle'] ?? __('Our finest work, your next look');
    $galleryImages = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<section id="gallery" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ __('Gallery') }}
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Gallery grid with lightbox --}}
        @if($galleryImages->isNotEmpty())
            <div
                x-data="{ lightbox: false, current: 0, images: {{ $galleryImages->map(fn($m) => $m->getUrl())->toJson() }} }"
                @keydown.escape.window="lightbox = false"
                @keydown.left.window="current = (current - 1 + images.length) % images.length"
                @keydown.right.window="current = (current + 1) % images.length"
            >
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 lg:gap-4">
                    @foreach($galleryImages as $index => $media)
                        <div
                            class="group relative aspect-square overflow-hidden cursor-pointer"
                            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                            style="opacity: 0; transform: translateY(14px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.08 }}s;"
                            @click="current = {{ $index }}; lightbox = true"
                        >
                            <img
                                src="{{ $media->getUrl('thumb') ?: $media->getUrl() }}"
                                alt="Gallery {{ $index + 1 }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                loading="lazy"
                            />
                            {{-- Hover overlay --}}
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                                style="background-color: {{ $secondaryColor }}60;"
                            >
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Lightbox --}}
                <div
                    x-show="lightbox"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4"
                    style="background-color: {{ $secondaryColor }}f5;"
                    @click.self="lightbox = false"
                >
                    {{-- Close --}}
                    <button
                        class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center transition-opacity duration-300 hover:opacity-70"
                        style="color: {{ $primaryColor }};"
                        @click="lightbox = false"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    {{-- Prev --}}
                    <button
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center transition-all duration-300 hover:brightness-110"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        @click.stop="current = (current - 1 + images.length) % images.length"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    {{-- Image --}}
                    <div class="max-w-4xl w-full mx-auto p-2" style="border: 1px solid {{ $primaryColor }}20;">
                        <img :src="images[current]" class="w-full max-h-[80vh] object-contain" alt="Gallery image" />
                    </div>

                    {{-- Next --}}
                    <button
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 flex items-center justify-center transition-all duration-300 hover:brightness-110"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        @click.stop="current = (current + 1) % images.length"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Counter --}}
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-[12px] tracking-[0.15em]" style="color: {{ $primaryColor }};">
                        <span x-text="current + 1"></span> / <span x-text="images.length"></span>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-[15px]" style="color: {{ $textColor }};">{{ __('Upload gallery images via the dashboard.') }}</p>
            </div>
        @endif
    </div>
</section>
