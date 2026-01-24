{{--
    Template-specifieke pricing voor Icon (Hair Salon)

    Moderne menu-stijl prijslijst
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Prijzen';
    $subtitle = $content['subtitle'] ?? 'Transparante prijzen voor al onze behandelingen';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Dames',
            'icon' => 'women',
            'items' => [
                ['service' => 'Knippen', 'description' => 'Wassen, knippen, föhnen', 'price' => '€45'],
                ['service' => 'Knippen + Stylen', 'description' => 'Inclusief styling advies', 'price' => '€55'],
                ['service' => 'Föhnen / Stylen', 'description' => 'Wassen en stylen', 'price' => '€30'],
                ['service' => 'Opsteken', 'description' => 'Feest- of bruidskapsel', 'price' => 'Vanaf €65'],
            ],
        ],
        [
            'name' => 'Kleuren',
            'icon' => 'color',
            'items' => [
                ['service' => 'Uitgroei kleuren', 'description' => 'Bijwerken van de uitgroei', 'price' => '€55'],
                ['service' => 'Full colour', 'description' => 'Volledige haarkleuring', 'price' => '€75'],
                ['service' => 'Highlights', 'description' => 'Folies of balayage', 'price' => 'Vanaf €85', 'popular' => true],
                ['service' => 'Toner / Gloss', 'description' => 'Kleurverfrissing', 'price' => '€35'],
            ],
        ],
        [
            'name' => 'Heren',
            'icon' => 'men',
            'items' => [
                ['service' => 'Knippen', 'description' => 'Wassen en knippen', 'price' => '€28'],
                ['service' => 'Knippen + Baard', 'description' => 'Complete behandeling', 'price' => '€38'],
                ['service' => 'Baard trimmen', 'description' => 'Trimmen en vormen', 'price' => '€15'],
                ['service' => 'Kids (t/m 12)', 'description' => 'Kinderknippen', 'price' => '€22'],
            ],
        ],
    ];

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';

    // Gradient colors per category - zachte, gebalanceerde kleuren
    $gradients = [
        ['from' => '#0ea5e9', 'to' => '#38bdf8'],
        ['from' => '#14b8a6', 'to' => '#2dd4bf'],
        ['from' => '#8b5cf6', 'to' => '#a78bfa'],
    ];

    // Icons
    $icons = [
        'women' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'men' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        // Als de prijs niet begint met €, voeg deze toe
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Prijslijst
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto text-gray-600">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                @php
                    $gradient = $gradients[$index % count($gradients)];
                @endphp
                <div
                    class="bg-white rounded-3xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    style="box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
                >
                    {{-- Category header --}}
                    <div
                        class="p-6 text-center text-white"
                        style="background: linear-gradient(135deg, {{ $gradient['from'] }}, {{ $gradient['to'] }});"
                    >
                        <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-white/20 flex items-center justify-center">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $icons[$category['icon'] ?? 'women'] ?? $icons['women'] !!}
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">{{ $category['name'] }}</h3>
                    </div>

                    {{-- Price items --}}
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($category['items'] as $item)
                                @php
                                    $isPopular = $item['popular'] ?? false;
                                @endphp
                                <div
                                    class="relative p-4 rounded-xl transition-colors {{ $isPopular ? '' : 'hover:bg-gray-50' }}"
                                    style="{{ $isPopular ? 'background: linear-gradient(135deg, ' . $gradient['from'] . '08, ' . $gradient['to'] . '08);' : '' }}"
                                >
                                    {{-- Popular badge --}}
                                    @if($isPopular)
                                        <span
                                            class="absolute -top-2 right-4 px-3 py-1 rounded-full text-xs font-bold text-white"
                                            style="background: linear-gradient(135deg, {{ $gradient['from'] }}, {{ $gradient['to'] }});"
                                        >
                                            Populair
                                        </span>
                                    @endif

                                    <div class="flex items-center justify-between gap-4">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold truncate" style="color: {{ $textColor }};">
                                                {{ $item['service'] }}
                                            </h4>
                                            <p class="text-sm text-gray-500 truncate">
                                                {{ $item['description'] }}
                                            </p>
                                        </div>
                                        <span
                                            class="text-lg font-bold shrink-0"
                                            style="color: {{ $gradient['from'] }};"
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
                            class="mt-6 w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg"
                            style="background: linear-gradient(135deg, {{ $gradient['from'] }}10, {{ $gradient['to'] }}10); color: {{ $gradient['from'] }};"
                        >
                            Boek nu
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <div class="mt-12 text-center">
            <div class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gray-50">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-gray-600">
                    Alle prijzen zijn inclusief BTW. Lang haar vanaf +€5. Vraag naar onze combideals!
                </p>
            </div>
        </div>
    </div>
</section>
