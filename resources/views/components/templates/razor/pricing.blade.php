{{--
    Template-specifieke pricing voor Razor (Barbershop)

    Klassieke menu-stijl prijslijst
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? 'Kwaliteit tegen eerlijke prijzen';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Knippen',
            'items' => [
                ['service' => 'Heren Knippen', 'description' => 'Schaar of tondeuse, inclusief styling', 'price' => '€27'],
                ['service' => 'Fade / Skin Fade', 'description' => 'Strakke fade van laag naar hoog', 'price' => '€30'],
                ['service' => 'Knippen + Wassen', 'description' => 'Inclusief ontspannende hoofdmassage', 'price' => '€32'],
                ['service' => 'Kids Knippen', 'description' => 'Tot en met 12 jaar', 'price' => '€19'],
                ['service' => 'Senior 65+', 'description' => 'Speciaal senioren tarief', 'price' => '€22'],
            ],
        ],
        [
            'name' => 'Baard & Scheren',
            'items' => [
                ['service' => 'Baard Trimmen', 'description' => 'Vormen en bijwerken van de baard', 'price' => '€22'],
                ['service' => 'Baard Modelleren', 'description' => 'Complete baardverzorging met lijn', 'price' => '€25'],
                ['service' => 'Hot Towel Shave', 'description' => 'Klassieke scheerbeurt met warme doeken', 'price' => '€32'],
                ['service' => 'Scheren Gezicht', 'description' => 'Compleet glad scheren', 'price' => '€28'],
            ],
        ],
        [
            'name' => 'Combinaties',
            'items' => [
                ['service' => 'Knippen + Baard', 'description' => 'Onze populairste behandeling', 'price' => '€45', 'popular' => true],
                ['service' => 'The Full Package', 'description' => 'Knippen, baard, hot towel shave', 'price' => '€65'],
                ['service' => 'Vader & Zoon', 'description' => 'Samen knippen, samen besparen', 'price' => '€40'],
            ],
        ],
    ];

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        // Als de prijs niet begint met €, voeg deze toe
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
    $headingFont = $theme['heading_font_family'] ?? 'Bebas Neue';
    $bodyFont = $theme['font_family'] ?? 'Barlow';
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                Tarieven
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $lightTextColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-20" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4h16v3H4zM7 7v10a3 3 0 003 3h4a3 3 0 003-3V7"/>
                </svg>
                <div class="h-px w-20" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $lightTextColor }}; opacity: 0.6;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Menu card --}}
        <div
            class="relative p-8 lg:p-12"
            style="background-color: {{ $backgroundColor }}; border: 3px solid {{ $primaryColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{-- Decorative corners --}}
            <div class="absolute top-3 left-3 w-6 h-6 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
            <div class="absolute top-3 right-3 w-6 h-6 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
            <div class="absolute bottom-3 left-3 w-6 h-6 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
            <div class="absolute bottom-3 right-3 w-6 h-6 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>

            {{-- Categories --}}
            <div class="space-y-12">
                @foreach($categories as $categoryIndex => $category)
                    <div>
                        {{-- Category header --}}
                        <div class="text-center mb-8">
                            <h3
                                class="text-2xl font-bold uppercase tracking-wider inline-block px-6 relative"
                                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                            >
                                <span class="absolute left-0 top-1/2 w-full h-px -z-10" style="background-color: {{ $primaryColor }}30;"></span>
                                <span class="px-4" style="background-color: {{ $backgroundColor }};">{{ $category['name'] }}</span>
                            </h3>
                        </div>

                        {{-- Menu items --}}
                        <div class="space-y-1">
                            @foreach($category['items'] as $item)
                                @php
                                    $isPopular = $item['popular'] ?? false;
                                @endphp
                                <div
                                    class="group flex flex-col sm:flex-row sm:items-center justify-between py-4 px-4 transition-colors"
                                    style="background-color: {{ $isPopular ? $primaryColor . '10' : 'transparent' }};"
                                    onmouseover="{{ $isPopular ? '' : "this.style.backgroundColor='" . $accentColor . "'" }}"
                                    onmouseout="{{ $isPopular ? '' : "this.style.backgroundColor='transparent'" }}"
                                >
                                    <div class="flex-1 mb-2 sm:mb-0">
                                        <div class="flex items-center gap-3">
                                            <h4 class="font-bold" style="color: {{ $textColor }};">
                                                {{ $item['service'] }}
                                            </h4>
                                            @if($isPopular)
                                                <span
                                                    class="text-xs font-bold uppercase tracking-wider px-2 py-0.5"
                                                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                                                >
                                                    Populair
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm opacity-60 mt-1" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    </div>

                                    {{-- Dotted line --}}
                                    <div class="hidden sm:block flex-1 mx-4 border-b border-dotted" style="border-color: {{ $primaryColor }}30;"></div>

                                    {{-- Price --}}
                                    <div
                                        class="text-xl font-bold shrink-0"
                                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                                    >
                                        {{ $formatPrice($item['price']) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Separator between categories --}}
                    @if(!$loop->last)
                        <div class="flex items-center justify-center gap-4">
                            <div class="h-px w-24" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}40);"></div>
                            <div class="w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }};"></div>
                            <div class="h-px w-24" style="background: linear-gradient(to left, transparent, {{ $primaryColor }}40);"></div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Footer note --}}
            <div class="mt-12 pt-8 border-t text-center" style="border-color: {{ $primaryColor }}20;">
                <p class="text-sm italic opacity-60" style="color: {{ $textColor }};">
                    Alle prijzen zijn inclusief BTW. Contante betaling of pin mogelijk.
                </p>
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-12">
            <a
                href="#contact"
                class="inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:scale-105"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
            >
                Maak Afspraak
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
