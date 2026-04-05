{{--
    King Template: Features Section
    "Royal Throne" — editorial numbered cards, diamond accents, bold barbershop features
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('The Royal Treatment');
    $subtitle = $content['subtitle'] ?? __('What sets us apart from the rest');
    $items = $content['items'] ?? [
        ['title' => __('Master Barbers'), 'description' => __('Every barber in our chair is a craftsman with years of experience and a passion for precision.'), 'icon' => 'scissors'],
        ['title' => __('Premium Products'), 'description' => __('We only use the finest grooming products to ensure your hair looks and feels its best.'), 'icon' => 'star'],
        ['title' => __('Royal Experience'), 'description' => __('From the moment you walk in, expect hot towels, premium beverages, and undivided attention.'), 'icon' => 'crown'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<section id="features" class="py-24 lg:py-36" style="background-color: {{ $primaryColor }}04; font-family: '{{ $bodyFont }}', sans-serif;">
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
                    {{ __('Why King') }}
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

        {{-- Feature cards --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($items as $index => $item)
                <div
                    class="group relative p-8 lg:p-10 text-center transition-all duration-500 hover:shadow-lg"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Gold top accent — expands on hover --}}
                    <div
                        class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    {{-- Editorial number watermark --}}
                    <span
                        class="absolute top-4 right-6 text-[4rem] leading-none select-none pointer-events-none"
                        style="color: {{ $headingColor }}04; font-family: '{{ $headingFont }}', serif;"
                    >
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Icon --}}
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}15;"
                    >
                        @if(($item['icon'] ?? '') === 'scissors')
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/>
                            </svg>
                        @elseif(($item['icon'] ?? '') === 'crown')
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M2 19h20v2H2v-2zm2-5l4-7 4 4 4-9 4 8v4H4v0z"/>
                            </svg>
                        @else
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Title --}}
                    <h3
                        class="text-lg mb-3"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
                    >
                        {{ $item['title'] ?? '' }}
                    </h3>

                    {{-- Diamond divider --}}
                    <div class="flex items-center justify-center gap-0 mb-4">
                        <div class="w-6 h-px" style="background-color: {{ $primaryColor }}40;"></div>
                        <div class="w-1.5 h-1.5 rotate-45 mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                        <div class="w-6 h-px" style="background-color: {{ $primaryColor }}40;"></div>
                    </div>

                    {{-- Description --}}
                    <p class="text-[14px] leading-[1.7]" style="color: {{ $textColor }};">
                        {{ $item['description'] ?? '' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
