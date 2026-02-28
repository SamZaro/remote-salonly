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
    $subtitle = $content['subtitle'] ?? 'Scroll door onze latest creaties';

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
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($mediaItems as $index => $media)
                    <div
                        class="group relative aspect-square overflow-hidden rounded-3xl cursor-pointer transform transition-all duration-300 hover:scale-105 hover:rotate-0 {{ $rotations[$index % 8] }}"
                        style="box-shadow: 6px 6px 0 {{ $index % 2 === 0 ? $primaryColor : $secondaryColor }};"
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

        {{-- Instagram CTA --}}
        <div class="text-center mt-12">
            <a
                href="#"
                class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-bold text-lg transition-all hover:scale-105 hover:-rotate-1"
                style="background: {{ $secondaryColor }}; color: white; box-shadow: 6px 6px 0 {{ $primaryColor }};"
            >
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                Volg ons op Instagram
            </a>
        </div>
    </div>
</section>
