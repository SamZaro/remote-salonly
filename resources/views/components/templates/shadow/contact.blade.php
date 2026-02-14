{{--
    Template-specifieke contact sectie voor Shadow (Barbershop)

    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Contact';
    $subtitle = $content['subtitle'] ?? 'Neem contact op';
    $featuredImage = $section?->getFirstMediaUrl('background') ?: null;

    // Theme kleuren met defaults (zelfde als andere Shadow sections)
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';

    // Logo
    $template = app(\App\Services\TemplateService::class)->getActiveTemplate();
    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<section id="contact" class="py-20 lg:py-28 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-24">
            <span
                class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
            >
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4" style="color: {{ $headingColor }};">
                {{ $title }}
            </h2>
        </div>

        {{-- Contact grid - 3 blokken --}}
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- E-mail --}}
            <div
                class="text-center p-10 transition-all duration-300 hover:-translate-y-1"
                style="background-color: {{ $backgroundColor }}; border-left: 4px solid {{ $primaryColor }};"
            >
                {{-- Icon --}}
                <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center bg-gray-200">
                    <svg class="w-7 h-7" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-4" style="color: {{ $textColor }};">
                    E-mail
                </h3>
                <a
                    href="mailto:info@uwbedrijf.nl"
                    class="text-lg block transition-opacity hover:opacity-80"
                    style="color: {{ $textColor }};"
                >
                    info@uwbarbershop.nl
                </a>
                <p class="text-sm mt-4 opacity-60" style="color: {{ $textColor }};">
                    KvK: 12345678
                </p>
            </div>

            {{-- Featured Image --}}
            <div
                class="transition-all duration-300 hover:-translate-y-1 overflow-hidden"
                style="background-color: {{ $secondaryColor }};"
            >
                @if($featuredImage)
                    <img
                        src="{{ $featuredImage }}"
                        alt="{{ $title }}"
                        class="w-full h-full min-h-[280px] object-cover"
                    />
                @else
                    <div class="w-full h-full min-h-[280px] flex items-center justify-center">
                        <svg class="w-20 h-20 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Social Media --}}
            <div
                class="text-center p-10 transition-all duration-300 hover:-translate-y-1"
                style="background-color: {{ $backgroundColor }}; border-left: 4px solid {{ $primaryColor }};"
            >
                {{-- Logo --}}
                <div class="mx-auto mb-6 flex items-center justify-center">
                    @if($logoImage)
                        <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-20 w-auto">
                    @else
                        <span class="text-2xl font-bold" style="color: {{ $secondaryColor }};">{{ $logoText }}</span>
                    @endif
                </div>
                <h3 class="text-lg font-bold mb-6" style="color: {{ $textColor }};">
                    Volg ons
                </h3>
                {{-- Social icons --}}
                <div class="flex items-center justify-center gap-4">
                    {{-- Facebook --}}
                    <a
                        href="#"
                        class="w-12 h-12 flex items-center justify-center bg-gray-200 transition-all duration-300 hover:scale-110"
                        style="color: {{ $secondaryColor }};"
                        aria-label="Facebook"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    {{-- Instagram --}}
                    <a
                        href="#"
                        class="w-12 h-12 flex items-center justify-center bg-gray-200 transition-all duration-300 hover:scale-110"
                        style="color: {{ $secondaryColor }};"
                        aria-label="Instagram"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                    {{-- TikTok --}}
                    <a
                        href="#"
                        class="w-12 h-12 flex items-center justify-center bg-gray-200 transition-all duration-300 hover:scale-110"
                        style="color: {{ $secondaryColor }};"
                        aria-label="TikTok"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                    {{-- X (Twitter) --}}
                    <a
                        href="#"
                        class="w-12 h-12 flex items-center justify-center bg-gray-200 transition-all duration-300 hover:scale-110"
                        style="color: {{ $secondaryColor }};"
                        aria-label="X"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
