{{--
    Template-specifieke gallery voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Ons Werk';
    $subtitle = $content['subtitle'] ?? 'Een selectie van onze creaties';

    // Get images from Spatie Media Library
    $mediaItems = $section?->getMedia('images') ?? collect();

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';
@endphp

<section id="gallery" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Portfolio</span>
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Gallery grid --}}
        @if($mediaItems->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($mediaItems as $index => $media)
                    <div
                        class="group relative aspect-square overflow-hidden cursor-pointer"
                        style="background-color: {{ $accentColor }}; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    >
                        <img
                            src="{{ $media->getUrl() }}"
                            alt="{{ $media->name }}"
                            class="w-full h-full object-cover transition-all duration-500 group-hover:scale-105"
                        />
                        {{-- Hover overlay --}}
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                            style="background-color: {{ $secondaryColor }}90;"
                        >
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Placeholder grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @for($i = 0; $i < 8; $i++)
                    <div
                        class="relative aspect-square flex items-center justify-center"
                        style="background-color: {{ $accentColor }}50;"
                    >
                        <svg class="w-10 h-10" style="color: {{ $secondaryColor }}20;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endfor
            </div>
        @endif

        {{-- CTA --}}
        <div class="text-center mt-12"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="#contact"
                class="inline-flex items-center gap-3 text-sm font-medium uppercase tracking-widest transition-all duration-300 group"
                style="color: {{ $secondaryColor }};"
            >
                <span class="border-b" style="border-color: {{ $secondaryColor }};">Bekijk meer op Instagram</span>
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
