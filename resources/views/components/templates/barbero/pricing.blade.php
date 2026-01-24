{{--
    Template-specifieke pricing/prijslijst voor Barbero (Barbershop)

    Klassieke barbershop prijslijst in menu stijl
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? 'Eerlijke prijzen voor premium service';
    $items = $content['items'] ?? [
        [
            'service' => 'Knippen',
            'price' => '€25',
            'description' => 'Inclusief wassen en stylen',
        ],
        [
            'service' => 'Baard Trim',
            'price' => '€18',
            'description' => 'Perfecte lijnen en vorm',
        ],
        [
            'service' => 'Knippen + Baard',
            'price' => '€38',
            'description' => 'Complete behandeling',
            'popular' => true,
        ],
        [
            'service' => 'Hot Towel Shave',
            'price' => '€30',
            'description' => 'Luxe scheerervaring',
        ],
        [
            'service' => 'Kids Knippen',
            'price' => '€18',
            'description' => 'Tot 12 jaar',
        ],
        [
            'service' => 'Senior Knippen',
            'price' => '€20',
            'description' => '65+ korting',
        ],
    ];

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = $theme['text_color'] ?? '#333333';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        // Als de prijs niet begint met €, voeg deze toe
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-12 h-px" style="background-color: {{ $textColor }};"></div>
                <svg class="w-8 h-8" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-12 h-px" style="background-color: {{ $textColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 uppercase tracking-wider"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p
                class="text-lg max-w-xl mx-auto opacity-70 uppercase tracking-widest"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing menu card --}}
        <div
            class="relative p-8 lg:p-12"
            style="background-color: {{ $backgroundColor }}; border: 2px solid {{ $primaryColor }};"
        >
            {{-- Corner decorations --}}
            <div class="absolute top-4 left-4 w-8 h-8 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
            <div class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
            <div class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
            <div class="absolute bottom-4 right-4 w-8 h-8 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>

            {{-- Price items --}}
            <div class="space-y-0">
                @foreach($items as $index => $item)
                    @php
                        $isPopular = $item['popular'] ?? false;
                    @endphp
                    <div
                        class="relative py-6 {{ $index > 0 ? 'border-t' : '' }}"
                        style="border-color: {{ $primaryColor }}20;"
                    >
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-baseline gap-2">
                                    <h3
                                        class="text-lg font-bold uppercase tracking-wide"
                                        style="color: {{ $textColor }};"
                                    >
                                        {{ $item['service'] }}
                                    </h3>
                                    @if($isPopular)
                                        <span class="text-xs font-bold uppercase px-2 py-0.5" style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};">
                                            Populair
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm opacity-60 mt-1" style="color: {{ $textColor }};">
                                    {{ $item['description'] }}
                                </p>
                            </div>

                            {{-- Dotted line --}}
                            <div class="flex-1 border-b border-dotted mx-4 hidden sm:block" style="border-color: {{ $primaryColor }}40;"></div>

                            {{-- Price --}}
                            <div
                                class="text-2xl font-bold"
                                style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                            >
                                {{ $formatPrice($item['price']) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a
                href="#contact"
                class="inline-flex items-center justify-center px-10 py-5 text-sm font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
            >
                Boek Nu
            </a>
        </div>
    </div>
</section>
