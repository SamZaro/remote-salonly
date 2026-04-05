{{--
    Blush Template: About Section
    Elegant nail studio — image left, text right with warm luxury tones
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('About Us');
    $subtitle = $content['subtitle'] ?? __('Our vision');
    $description = $content['description'] ?? __('We believe everyone deserves to feel radiant.');
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $ctaPrimary = $content['cta_primary'] ?? ['text' => __('Book a Treatment'), 'url' => '#contact'];
    $ctaSecondary = $content['cta_secondary'] ?? ['text' => __('Our Services'), 'url' => '#services'];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section id="about" class="py-20 lg:py-32" style="background-color: {{ $backgroundColor }}; font-family: {{ $bodyFont }};">
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image --}}
            <div
                class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-30px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($image)
                    <div class="relative">
                        <img
                            src="{{ $image }}"
                            class="w-full h-auto object-cover aspect-[4/5]"
                            alt="{{ $title }}"
                        />
                        {{-- Decorative frame offset --}}
                        <div class="absolute -bottom-4 -right-4 w-full h-full border -z-10" style="border-color: {{ $primaryColor }}40;"></div>
                    </div>
                @else
                    <div
                        class="w-full aspect-[4/5] flex items-center justify-center"
                        style="background-color: {{ $accentColor }}30;"
                    >
                        <svg class="w-16 h-16 opacity-30" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Text content --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(30px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Eyebrow --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-medium uppercase tracking-[0.25em]" style="color: {{ $primaryColor }}; font-family: {{ $bodyFont }};">
                        {{ $subtitle }}
                    </span>
                </div>

                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-light mb-8 leading-tight"
                    style="color: {{ $headingColor }}; font-family: {{ $headingFont }};"
                >
                    {{ $title }}
                </h2>

                <p
                    class="text-base lg:text-lg leading-relaxed mb-10"
                    style="color: {{ $textColor }};"
                >
                    {{ $description }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a
                        href="{{ $ctaPrimary['url'] }}"
                        class="inline-flex items-center justify-center px-8 py-3.5 text-sm uppercase tracking-[0.15em] font-medium transition-all duration-500 hover:scale-105"
                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                    >
                        {{ $ctaPrimary['text'] }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>

                    <a
                        href="{{ $ctaSecondary['url'] }}"
                        class="inline-flex items-center justify-center px-8 py-3.5 text-sm uppercase tracking-[0.15em] font-medium border transition-all duration-500 hover:bg-black/5"
                        style="color: {{ $headingColor }}; border-color: {{ $headingColor }}30;"
                    >
                        {{ $ctaSecondary['text'] }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
