{{--
    Glaze Template: About Section
    Asymmetric layout with bold rose accent panel
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

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';
@endphp

<section id="about" class="py-20 lg:py-32" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:grid lg:grid-cols-12 lg:gap-16 items-center">

            {{-- Image --}}
            <div class="lg:col-span-6 w-full mb-10 lg:mb-0"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-30px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                <div class="relative">
                    @if($image)
                        <img src="{{ $image }}" class="w-full h-auto object-cover rounded-2xl" alt="{{ $title }}" />
                    @else
                        <div class="w-full aspect-[4/3] rounded-2xl flex items-center justify-center" style="background-color: {{ $primaryColor }}10;">
                            <svg class="w-16 h-16 opacity-30" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    {{-- Accent border offset --}}
                    <div class="absolute -bottom-4 -right-4 w-full h-full rounded-2xl border-2 -z-10 hidden lg:block" style="border-color: {{ $primaryColor }}30;"></div>
                </div>
            </div>

            {{-- Text --}}
            <div class="lg:col-span-6 flex flex-col items-start text-left"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(30px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Eyebrow --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">{{ $subtitle }}</span>
                </div>

                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight mb-6"
                    style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                >
                    {{ $title }}
                </h2>

                <p class="text-base sm:text-lg leading-relaxed mb-8" style="color: {{ $textColor }};">
                    {{ $description }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a
                        href="{{ $ctaPrimary['url'] }}"
                        class="inline-flex items-center justify-center px-7 py-3.5 text-base font-semibold rounded-full transition-all duration-300 hover:scale-105"
                        style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 20px {{ $primaryColor }}30;"
                    >
                        {{ $ctaPrimary['text'] }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="{{ $ctaSecondary['url'] }}"
                        class="inline-flex items-center justify-center px-7 py-3.5 text-base font-semibold rounded-full border-2 transition-all duration-300 hover:bg-white/5"
                        style="color: {{ $backgroundColor }}; border-color: {{ $backgroundColor }}30;"
                    >
                        {{ $ctaSecondary['text'] }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
