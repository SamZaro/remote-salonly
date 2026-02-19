{{--
    Template-specifieke pricing voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Prijzen';
    $subtitle = $content['subtitle'] ?? 'Transparant & fair - geen verrassingen';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Knippen',
            'items' => [
                ['service' => 'Dames knippen', 'price' => '€45'],
                ['service' => 'Heren knippen', 'price' => '€35'],
                ['service' => 'Kinderen (t/m 12)', 'price' => '€25'],
                ['service' => 'Pony bijknippen', 'price' => '€15'],
            ],
        ],
        [
            'name' => 'Kleuren',
            'items' => [
                ['service' => 'Balayage', 'price' => 'Vanaf €120'],
                ['service' => 'Highlights', 'price' => 'Vanaf €95'],
                ['service' => 'Full color', 'price' => 'Vanaf €75'],
                ['service' => 'Vivid colors', 'price' => 'Op aanvraag'],
            ],
        ],
        [
            'name' => 'Styling',
            'items' => [
                ['service' => 'Blow-dry', 'price' => '€35'],
                ['service' => 'Updo / Opsteek', 'price' => '€55'],
                ['service' => 'Bridal styling', 'price' => 'Vanaf €95'],
                ['service' => 'Waves & curls', 'price' => '€45'],
            ],
        ],
    ];

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';

    $rotations = ['rotate-1', '-rotate-1', 'rotate-2'];

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        // Als de prijs niet begint met €, voeg deze toe
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                PRICING
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6"
                style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-xl max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing cards --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($categories as $index => $category)
                <div
                    class="rounded-3xl overflow-hidden transition-all duration-300 hover:scale-105 {{ $rotations[$index % 3] }} hover:rotate-0"
                    style="background: white; box-shadow: 8px 8px 0 {{ $index === 1 ? $primaryColor : $secondaryColor }};"
                >
                    {{-- Category header --}}
                    <div
                        class="p-6 text-center"
                        style="background: {{ $index === 0 ? $primaryColor : ($index === 1 ? $secondaryColor : $accentColor) }};"
                    >
                        <h3 class="text-2xl font-black" style="color: {{ $index === 2 ? $headingColor : 'white' }};">
                            {{ $category['name'] }}
                        </h3>
                    </div>

                    {{-- Items --}}
                    <div class="p-6">
                        @foreach($category['items'] as $itemIndex => $item)
                            <div
                                class="flex items-center justify-between py-4 {{ $itemIndex < count($category['items']) - 1 ? 'border-b-2 border-dashed' : '' }}"
                                style="border-color: {{ $accentColor }};"
                            >
                                <span class="font-medium" style="color: {{ $headingColor }};">{{ $item['service'] }}</span>
                                <span
                                    class="font-bold px-3 py-1 rounded-full text-sm"
                                    style="background: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                                >
                                    {{ $formatPrice($item['price']) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- CTA --}}
                    <div class="px-6 pb-6">
                        <a
                            href="#contact"
                            class="block text-center py-3 rounded-full font-bold transition-all hover:scale-105"
                            style="background: {{ $secondaryColor }}; color: white;"
                        >
                            Boek nu
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Note --}}
        <div class="text-center mt-12">
            <p class="inline-flex items-center gap-2 px-6 py-3 rounded-full" style="background: {{ $accentColor }}; color: {{ $headingColor }};">
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">Prijzen zijn indicatief. Vraag naar onze packages voor extra voordeel!</span>
            </p>
        </div>
    </div>
</section>
