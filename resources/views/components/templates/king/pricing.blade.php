{{--
    King Template: Pricing Section
    "Royal Throne" — dark bg, 3-column pricing cards, gold accents, barbershop menu
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Price List');
    $subtitle = $content['subtitle'] ?? __('Transparent pricing, royal results');
    $categories = $content['categories'] ?? [
        [
            'name' => __('Haircuts'),
            'items' => [
                ['name' => __('Classic Cut'), 'price' => '€25', 'popular' => false],
                ['name' => __('Fade'), 'price' => '€28', 'popular' => true],
                ['name' => __('Skin Fade'), 'price' => '€30', 'popular' => false],
                ['name' => __('Kids Cut'), 'price' => '€18', 'popular' => false],
            ],
        ],
        [
            'name' => __('Beard'),
            'items' => [
                ['name' => __('Beard Trim'), 'price' => '€15', 'popular' => false],
                ['name' => __('Beard Shape-Up'), 'price' => '€20', 'popular' => true],
                ['name' => __('Hot Towel Shave'), 'price' => '€25', 'popular' => false],
            ],
        ],
        [
            'name' => __('Packages'),
            'items' => [
                ['name' => __('Cut & Beard'), 'price' => '€38', 'popular' => true],
                ['name' => __('King Package'), 'price' => '€55', 'popular' => false],
                ['name' => __('Royal VIP'), 'price' => '€75', 'popular' => false],
            ],
        ],
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

<section id="pricing" class="py-24 lg:py-36" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
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
                    {{ __('Pricing') }}
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $backgroundColor }}60;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing cards --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($categories as $catIndex => $category)
                <div
                    class="group relative p-8 lg:p-10 transition-all duration-500 hover:shadow-lg"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $catIndex * 0.12 }}s;"
                >
                    {{-- Gold top accent --}}
                    <div
                        class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    {{-- Category icon --}}
                    <div
                        class="w-11 h-11 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}15;"
                    >
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2 19h20v2H2v-2zm2-5l4-7 4 4 4-9 4 8v4H4v0z"/>
                        </svg>
                    </div>

                    {{-- Category name --}}
                    <h3
                        class="text-xl text-center mb-2"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Diamond divider --}}
                    <div class="flex items-center justify-center gap-0 mb-6">
                        <div class="w-6 h-px" style="background-color: {{ $primaryColor }}40;"></div>
                        <div class="w-1.5 h-1.5 rotate-45 mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                        <div class="w-6 h-px" style="background-color: {{ $primaryColor }}40;"></div>
                    </div>

                    {{-- Price items --}}
                    <div class="space-y-4">
                        @foreach($category['items'] as $item)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-[14px] font-medium" style="color: {{ $headingColor }};">
                                        {{ $item['name'] }}
                                    </span>
                                    @if($item['popular'] ?? false)
                                        <span
                                            class="text-[9px] font-bold uppercase tracking-[0.1em] px-2 py-0.5"
                                            style="background-color: {{ $primaryColor }}12; color: {{ $primaryColor }};"
                                        >
                                            Popular
                                        </span>
                                    @endif
                                </div>
                                <div class="flex-1 mx-3 border-b border-dotted" style="border-color: {{ $headingColor }}10;"></div>
                                <span class="text-[15px] font-bold shrink-0" style="color: {{ $primaryColor }};">
                                    {{ $item['price'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book CTA --}}
                    <div class="mt-8 text-center">
                        <a
                            href="#contact"
                            class="group/btn inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.2em] transition-all duration-300 hover:gap-3"
                            style="color: {{ $primaryColor }};"
                        >
                            {{ __('Book Now') }}
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
