{{--
    Template-specifieke pricing voor Blossom (Luxury Beauty Salon)

    Luxe vrouwelijke menu-stijl prijslijst
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Prijzen';
    $subtitle = $content['subtitle'] ?? 'Luxe behandelingen voor elke gelegenheid';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Haar',
            'icon' => 'hair',
            'items' => [
                ['service' => 'Knippen & Föhnen', 'description' => 'Inclusief wasbeurt en styling', 'price' => '€55'],
                ['service' => 'Knippen & Stylen Deluxe', 'description' => 'Met behandeling en finishing', 'price' => '€75'],
                ['service' => 'Kleuren Uitgroei', 'description' => 'Bijwerken van de aanzet', 'price' => '€65'],
                ['service' => 'Full Colour', 'description' => 'Volledige haarkleuring', 'price' => '€85'],
                ['service' => 'Balayage / Highlights', 'description' => 'Hand-painted highlights', 'price' => 'Vanaf €120', 'popular' => true],
                ['service' => 'Keratine Behandeling', 'description' => 'Glad, glanzend haar', 'price' => 'Vanaf €150'],
            ],
        ],
        [
            'name' => 'Nagels',
            'icon' => 'nails',
            'items' => [
                ['service' => 'Manicure Classic', 'description' => 'Verzorging en lakken', 'price' => '€35'],
                ['service' => 'Manicure Deluxe', 'description' => 'Met scrub en masker', 'price' => '€50'],
                ['service' => 'Gel Nagels', 'description' => 'Nieuw set of bijwerken', 'price' => 'Vanaf €55'],
                ['service' => 'Nail Art', 'description' => 'Creatieve designs', 'price' => 'Vanaf €15'],
                ['service' => 'Pedicure Spa', 'description' => 'Complete voetverzorging', 'price' => '€55'],
            ],
        ],
        [
            'name' => 'Lash & Brow',
            'icon' => 'lash',
            'items' => [
                ['service' => 'Brow Design', 'description' => 'Wax, epileren & shapen', 'price' => '€25'],
                ['service' => 'Brow Lamination', 'description' => 'Volle, gedefinieerde wenkbrauwen', 'price' => '€45', 'popular' => true],
                ['service' => 'Lash Lift', 'description' => 'Natuurlijke wimper-lift', 'price' => '€55'],
                ['service' => 'Wimperextensions Classic', 'description' => 'Natuurlijke look', 'price' => '€85'],
                ['service' => 'Wimperextensions Volume', 'description' => 'Volle, dramatische look', 'price' => '€110'],
            ],
        ],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';

    // Gradient colors per category
    $gradients = [
        ['from' => '#d4919d', 'to' => '#e8b4bc'],
        ['from' => '#c9b8d4', 'to' => '#ddd0e8'],
        ['from' => '#d4c9b8', 'to' => '#e8ddd0'],
    ];

    // Icons
    $icons = [
        'hair' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'nails' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>',
        'lash' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
    ];
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Prijslijst
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; opacity: 0.7;">
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
                    class="bg-white rounded-[2rem] overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    style="box-shadow: 0 4px 30px {{ $primaryColor }}10;"
                >
                    {{-- Category header --}}
                    <div
                        class="p-8 text-center text-white relative overflow-hidden"
                        style="background: linear-gradient(135deg, {{ $gradient['from'] }}, {{ $gradient['to'] }});"
                    >
                        <div class="relative">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/20 flex items-center justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icons[$category['icon'] ?? 'hair'] ?? $icons['hair'] !!}
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold" style="font-family: 'Playfair Display', Georgia, serif;">
                                {{ $category['name'] }}
                            </h3>
                        </div>
                    </div>

                    {{-- Price items --}}
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($category['items'] as $item)
                                @php
                                    $isPopular = $item['popular'] ?? false;
                                @endphp
                                <div
                                    class="relative p-4 rounded-xl transition-colors"
                                    style="{{ $isPopular ? 'background: linear-gradient(135deg, ' . $gradient['from'] . '10, ' . $gradient['to'] . '10);' : '' }}"
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
                                            <p class="text-sm truncate" style="color: {{ $textColor }}; opacity: 0.6;">
                                                {{ $item['description'] }}
                                            </p>
                                        </div>
                                        <span
                                            class="text-lg font-bold shrink-0"
                                            style="color: {{ $gradient['from'] }};"
                                        >
                                            {{ $item['price'] }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Book button --}}
                        <a
                            href="#contact"
                            class="mt-6 w-full inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg"
                            style="background: linear-gradient(135deg, {{ $gradient['from'] }}15, {{ $gradient['to'] }}15); color: {{ $gradient['from'] }};"
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
            <div
                class="inline-flex items-center gap-3 px-6 py-3 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10);"
            >
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm" style="color: {{ $textColor }};">
                    Alle prijzen zijn inclusief BTW. Lang haar vanaf +€10.
                </p>
            </div>
        </div>
    </div>
</section>
