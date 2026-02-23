@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? null;
    $categories = $content['categories'] ?? [
        [
            'name' => 'Dames',
            'items' => [
                ['service' => 'Knippen', 'description' => 'Inclusief wasbeurt & styling', 'price' => '€55'],
                ['service' => 'Knippen & Föhnen', 'description' => 'Volledige behandeling', 'price' => '€65'],
                ['service' => 'Föhnen / Brushen', 'description' => 'Wassen & stylen', 'price' => '€35'],
                ['service' => 'Bruidskapsel', 'description' => 'Op afspraak', 'price' => 'Op aanvraag'],
            ],
        ],
        [
            'name' => 'Kleuring',
            'items' => [
                ['service' => 'Uitgroei bijwerken', 'description' => 'Tot 2cm uitgroei', 'price' => '€65'],
                ['service' => 'Volledige kleuring', 'description' => 'Hele lengte', 'price' => '€85'],
                ['service' => 'Balayage / Highlights', 'description' => 'Handgeschilderd of folies', 'price' => 'Vanaf €95'],
                ['service' => 'Toner / Gloss', 'description' => 'Kleurverfrissing', 'price' => '€40'],
            ],
        ],
        [
            'name' => 'Heren',
            'items' => [
                ['service' => 'Knippen', 'description' => 'Wassen & knippen', 'price' => '€35'],
                ['service' => 'Knippen & Baard', 'description' => 'Volledige behandeling', 'price' => '€48'],
                ['service' => 'Baard trimmen', 'description' => 'Vormgeven & verzorgen', 'price' => '€18'],
                ['service' => 'Kids (t/m 12)', 'description' => 'Kinderknippen', 'price' => '€25'],
            ],
        ],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';

    // Dynamic grid based on category count
    $categoryCount = count($categories);
    $gridCols = match(true) {
        $categoryCount === 1 => 'lg:grid-cols-1 max-w-2xl mx-auto',
        $categoryCount === 2 => 'lg:grid-cols-2 max-w-5xl mx-auto',
        $categoryCount >= 3 => 'lg:grid-cols-3',
        default => 'lg:grid-cols-1',
    };
@endphp

<section id="pricing" class="py-16 lg:py-24" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-24"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            @if($subtitle)
                <p class="text-sm uppercase tracking-widest mb-3" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </p>
            @endif
            <h2 class="text-3xl sm:text-4xl font-extrabold mb-4" style="color: {{ $headingColor }};">
                {{ $title }}
            </h2>
        </div>

        {{-- Pricing grid --}}
        <div class="grid gap-12 lg:gap-8 {{ $gridCols }}">
            @foreach($categories as $index => $category)
                <div
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Category title --}}
                    <h3
                        class="text-xl font-semibold mb-6 pb-3 border-b"
                        style="color: {{ $headingColor }}; border-color: {{ $primaryColor }};"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Items --}}
                    <div class="space-y-5">
                        @foreach($category['items'] as $item)
                            <div class="flex justify-between items-baseline gap-4">
                                <div class="min-w-0">
                                    <span class="text-base lg:text-lg font-medium" style="color: {{ $headingColor }};">
                                        {{ $item['service'] }}
                                    </span>
                                    @if(!empty($item['description']))
                                        <p class="text-sm lg:text-base truncate" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                </div>
                                <span
                                    class="text-base lg:text-lg font-medium shrink-0"
                                    style="color: {{ $primaryColor }};"
                                >
                                    @php
                                        $price = $item['price'] ?? '';
                                        // Add € prefix if price is numeric or starts with a number
                                        $displayPrice = (is_numeric($price) || preg_match('/^\d/', $price))
                                            ? '€' . $price
                                            : $price;
                                    @endphp
                                    {{ $displayPrice }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
