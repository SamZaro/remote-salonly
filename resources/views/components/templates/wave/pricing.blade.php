{{--
    Template-specifieke pricing voor Wave (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? 'Transparante Tarieven';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Dames',
            'icon' => 'women',
            'items' => [
                ['service' => 'Knippen', 'description' => 'Inclusief wasbeurt & styling', 'price' => '€55'],
                ['service' => 'Knippen & Föhnen', 'description' => 'Volledige behandeling', 'price' => '€65'],
                ['service' => 'Föhnen / Brushen', 'description' => 'Wassen & stylen', 'price' => '€35'],
                ['service' => 'Bruidskapsel', 'description' => 'Op afspraak', 'price' => 'Op aanvraag', 'popular' => true],
            ],
        ],
        [
            'name' => 'Kleuring',
            'icon' => 'color',
            'items' => [
                ['service' => 'Uitgroei bijwerken', 'description' => 'Tot 2cm uitgroei', 'price' => '€65'],
                ['service' => 'Volledige kleuring', 'description' => 'Hele lengte', 'price' => '€85'],
                ['service' => 'Balayage / Highlights', 'description' => 'Handgeschilderd of folies', 'price' => 'Vanaf €95', 'popular' => true],
                ['service' => 'Toner / Gloss', 'description' => 'Kleurverfrissing', 'price' => '€40'],
            ],
        ],
        [
            'name' => 'Heren',
            'icon' => 'men',
            'items' => [
                ['service' => 'Knippen', 'description' => 'Wassen & knippen', 'price' => '€35'],
                ['service' => 'Knippen & Baard', 'description' => 'Volledige behandeling', 'price' => '€48'],
                ['service' => 'Baard trimmen', 'description' => 'Vormgeven & verzorgen', 'price' => '€18'],
                ['service' => 'Kids (t/m 12)', 'description' => 'Kinderknippen', 'price' => '€25'],
            ],
        ],
    ];

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        // Als de prijs niet begint met €, voeg deze toe
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="max-w-3xl mx-auto text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <span
                    class="text-xs font-medium uppercase tracking-[0.3em]"
                    style="color: {{ $primaryColor }};"
                >
                    {{ $subtitle }}
                </span>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-light"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div class="relative">
                    {{-- Category header --}}
                    <div class="text-center mb-8">
                        <h3
                            class="text-2xl font-light"
                            style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                        >
                            {{ $category['name'] }}
                        </h3>
                        <div class="w-12 h-px mx-auto mt-4" style="background-color: {{ $primaryColor }};"></div>
                    </div>

                    {{-- Price items --}}
                    <div class="space-y-0">
                        @foreach($category['items'] as $item)
                            @php
                                $isPopular = $item['popular'] ?? false;
                            @endphp
                            <div
                                class="relative py-6 border-b transition-colors hover:bg-white/50"
                                style="border-color: {{ $secondaryColor }}10;"
                            >
                                {{-- Popular badge --}}
                                @if($isPopular)
                                    <span
                                        class="absolute -top-3 right-0 px-3 py-1 text-xs font-medium uppercase tracking-wider"
                                        style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                                    >
                                        Populair
                                    </span>
                                @endif

                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <h4
                                            class="font-medium mb-1"
                                            style="color: {{ $headingColor }};"
                                        >
                                            {{ $item['service'] }}
                                        </h4>
                                        <p class="text-sm" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    </div>
                                    <span
                                        class="text-lg font-light shrink-0"
                                        style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                                    >
                                        {{ $formatPrice($item['price']) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book button --}}
                    <a
                        href="#contact"
                        class="group mt-8 w-full inline-flex items-center justify-center gap-3 py-4 border transition-all duration-300 hover:bg-{{ $secondaryColor }}"
                        style="border-color: {{ $secondaryColor }}; color: {{ $secondaryColor }};"
                        onmouseover="this.style.backgroundColor='{{ $secondaryColor }}'; this.style.color='#ffffff';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $secondaryColor }}';"
                    >
                        <span class="text-sm font-medium uppercase tracking-widest">Reserveren</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <div class="mt-16 text-center">
            <div
                class="inline-flex items-center gap-3 px-8 py-4"
                style="background-color: {{ $secondaryColor }}08;"
            >
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm" style="color: {{ $textColor }};">
                    Alle prijzen zijn inclusief BTW. Lang haar vanaf +€10.
                </p>
            </div>
        </div>
    </div>
</section>
