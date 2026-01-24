{{--
    Template-specifieke pricing voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Prijzen';
    $subtitle = $content['subtitle'] ?? 'Eerlijke prijzen voor eerlijke producten';
    $items = $content['items'] ?? [
        ['service' => 'Organic Cut', 'price' => '€55', 'description' => 'Inclusief natuurlijke styling'],
        ['service' => 'Cut & Blow-dry', 'price' => '€70', 'description' => 'Knippen en föhnen'],
        ['service' => 'Plant Color', 'price' => '€85', 'description' => '100% plantaardig', 'popular' => true],
        ['service' => 'Highlights', 'price' => '€95', 'description' => 'Natuurlijke accenten'],
        ['service' => 'Scalp Treatment', 'price' => '€45', 'description' => 'Ontspannende hoofdhuidmassage'],
        ['service' => 'Hair Detox', 'price' => '€55', 'description' => 'Zuiverende behandeling'],
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        // Als de prijs niet begint met €, voeg deze toe
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6"
                style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Prijzen
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing card --}}
        <div class="bg-white rounded-3xl p-8 lg:p-12" style="box-shadow: 0 10px 40px {{ $primaryColor }}10;">
            {{-- Price items --}}
            <div class="space-y-0">
                @foreach($items as $index => $item)
                    @php
                        $isPopular = $item['popular'] ?? false;
                    @endphp
                    <div class="relative py-5 {{ $index > 0 ? 'border-t' : '' }}" style="border-color: {{ $primaryColor }}15;">
                        {{-- Popular badge --}}
                        @if($isPopular)
                            <span
                                class="absolute -right-2 top-1/2 -translate-y-1/2 px-3 py-1 text-xs font-medium rounded-full hidden sm:block"
                                style="background-color: {{ $primaryColor }}; color: white;"
                            >
                                Populair
                            </span>
                        @endif

                        <div class="flex items-center justify-between gap-4 {{ $isPopular ? 'pr-20' : '' }}">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-medium" style="color: {{ $headingColor }};">
                                        {{ $item['service'] }}
                                    </h3>
                                    @if($isPopular)
                                        <span class="sm:hidden text-xs font-medium px-2 py-0.5 rounded-full" style="background-color: {{ $primaryColor }}; color: white;">
                                            Top
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm mt-1" style="color: {{ $textColor }};">
                                    {{ $item['description'] }}
                                </p>
                            </div>

                            {{-- Dotted line --}}
                            <div class="flex-1 border-b border-dotted hidden sm:block" style="border-color: {{ $primaryColor }}30;"></div>

                            {{-- Price --}}
                            <div class="text-xl font-light" style="color: {{ $primaryColor }};">
                                {{ $formatPrice($item['price']) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Note --}}
            <div class="mt-8 pt-6 border-t text-center" style="border-color: {{ $primaryColor }}15;">
                <div class="flex items-center justify-center gap-2 text-sm" style="color: {{ $textColor }};">
                    <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Alle prijzen inclusief BTW • Alleen biologische producten</span>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-10">
            <a
                href="#contact"
                class="inline-flex items-center justify-center px-8 py-4 rounded-full text-base font-medium transition-all duration-300 hover:shadow-lg"
                style="background-color: {{ $primaryColor }}; color: white;"
            >
                Boek Je Afspraak
            </a>
        </div>
    </div>
</section>
