{{--
    Pure Template: Pricing Section
    Natural & Botanical — massive pricing with dark header per category
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? __('Pricing');
    $subtitle = $content['subtitle'] ?? __('Our rates');
    $categories = $content['categories'] ?? [
        [
            'name' => __('Cutting'),
            'icon' => 'hair',
            'items' => [
                ['service' => __('Organic Cut'), 'description' => __('Includes natural styling'), 'price' => '€55'],
                ['service' => __('Cut & Blow-dry'), 'description' => __('Cut and blow-dry'), 'price' => '€70'],
                ['service' => __('Kids Cut'), 'description' => __('Up to 12 years'), 'price' => '€30'],
                ['service' => __('Fringe Trim'), 'description' => __('Quick trim'), 'price' => '€15'],
                ['service' => __('Bridal Styling'), 'description' => __('Trial session included'), 'price' => '€125', 'popular' => true],
            ],
        ],
        [
            'name' => __('Color'),
            'icon' => 'nails',
            'items' => [
                ['service' => __('Plant Color'), 'description' => __('100% plant-based'), 'price' => '€85', 'popular' => true],
                ['service' => __('Highlights'), 'description' => __('Natural accents'), 'price' => '€95'],
                ['service' => __('Balayage'), 'description' => __('Hand-painted technique'), 'price' => '€120'],
                ['service' => __('Gloss Treatment'), 'description' => __('Color refresh'), 'price' => '€45'],
                ['service' => __('Roots Touch-up'), 'description' => __('Touch up outgrowth'), 'price' => '€65'],
            ],
        ],
        [
            'name' => __('Treatments'),
            'icon' => 'lash',
            'items' => [
                ['service' => __('Scalp Wellness'), 'description' => __('Scalp treatment'), 'price' => '€45'],
                ['service' => __('Hair Detox'), 'description' => __('Purifying treatment'), 'price' => '€55'],
                ['service' => __('Herbal Treatment'), 'description' => __('Intensive herbal treatment'), 'price' => '€65', 'popular' => true],
                ['service' => __('Keratin Treatment'), 'description' => __('Naturally smooth hair'), 'price' => '€95'],
                ['service' => __('Scalp Massage'), 'description' => __('20 minutes of relaxation'), 'price' => '€35'],
            ],
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';

    $formatPrice = fn($price) => str_starts_with((string) $price, '€') ? $price : '€' . $price;
@endphp

<section id="pricing" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $backgroundColor }};">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >Pricing</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ __('Pricing') }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div
                    class="rounded-none overflow-hidden"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s;'"
                >
                    {{-- Category header — dark block --}}
                    <div class="px-8 lg:px-10 py-8" style="background-color: {{ $secondaryColor }};">
                        <div class="w-10 h-px mb-5" style="background-color: {{ $primaryColor }};"></div>
                        <h3
                            class="text-2xl lg:text-3xl font-bold"
                            style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
                        >
                            {{ $category['name'] }}
                        </h3>
                    </div>

                    {{-- Price items — white block --}}
                    <div class="px-8 lg:px-10 py-6" style="background-color: #ffffff;">
                        @foreach($category['items'] as $item)
                            <div class="flex items-start justify-between gap-4 py-5" @if(!$loop->last) style="border-bottom: 1px solid {{ $accentColor }}30;" @endif>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="text-base lg:text-lg font-bold" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                                            {{ $item['service'] }}
                                        </h4>
                                        @if($item['popular'] ?? false)
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-none"
                                                style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
                                            >
                                                {{ __('Popular') }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm mt-1" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                                        {{ $item['description'] }}
                                    </p>
                                </div>
                                <span class="text-xl lg:text-2xl font-bold shrink-0" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;">
                                    {{ $formatPrice($item['price']) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book button — teal block --}}
                    <a
                        href="#contact"
                        class="block w-full px-8 lg:px-10 py-5 text-center text-sm font-semibold tracking-widest uppercase transition-all duration-300"
                        style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
                        onmouseover="this.style.backgroundColor='{{ $secondaryColor }}';"
                        onmouseout="this.style.backgroundColor='{{ $primaryColor }}';"
                    >
                        {{ __('Book an appointment') }}
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <p class="mt-10 text-center text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
            {{ __('All prices include VAT. Only organic products.') }}
        </p>
    </div>
</section>
