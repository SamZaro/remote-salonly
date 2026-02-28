{{--
    Spa Template: Pricing Section
    Serene spa & wellness — elegant menu-style price lists with dotted separators
    Fonts: Playfair Display (headings) + Lato (body)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? 'Onze behandelingen en tarieven';
    $categories = $content['categories'] ?? [
        [
            'name' => 'Massages',
            'icon' => 'hair',
            'items' => [
                ['service' => 'Swedish Massage', 'description' => '50 Minute Session', 'price' => '€60'],
                ['service' => 'Combination Massage', 'description' => '60 Minute Session', 'price' => '€65'],
                ['service' => 'Deep Tissue Massage', 'description' => '45 Minute Session', 'price' => '€65'],
                ['service' => 'Hot Stone Massage', 'description' => '55 Minute Session', 'price' => '€84', 'popular' => true],
                ['service' => 'Relaxing Massage', 'description' => '60 Minute Session', 'price' => '€55'],
            ],
        ],
        [
            'name' => 'Treatments',
            'icon' => 'nails',
            'items' => [
                ['service' => 'Aroma-Balance', 'description' => '50 Minute Session', 'price' => '€80'],
                ['service' => 'Supreme Skincare', 'description' => '60 Minute Session', 'price' => '€119', 'popular' => true],
                ['service' => 'Calming Facial', 'description' => '55 Minute Session', 'price' => '€87'],
                ['service' => 'Aromatherapy Facial', 'description' => '70 Minute Session', 'price' => '€95'],
                ['service' => 'Coconut Body', 'description' => '40 Minute Session', 'price' => '€90'],
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

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span
                class="absolute top-[-20px] left-1/2 -translate-x-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.05; color: {{ $secondaryColor }}; font-family: 'Playfair Display', serif;"
            >Pricing</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: 'Lato', sans-serif;">
                Prijzen
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; font-family: 'Lato', sans-serif;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div
                    class="p-8 rounded-lg"
                    style="background-color: #ffffff;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                >
                    {{-- Category header --}}
                    <h3
                        class="text-2xl font-bold mb-8 pb-4 text-center"
                        style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif; border-bottom: 2px solid {{ $primaryColor }};"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Price items --}}
                    <div class="space-y-0">
                        @foreach($category['items'] as $item)
                            <div class="flex items-start justify-between gap-4 py-4" style="border-bottom: 1px solid {{ $accentColor }};">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                                            {{ $item['service'] }}
                                        </h4>
                                        @if($item['popular'] ?? false)
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded"
                                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: 'Lato', sans-serif;"
                                            >
                                                Populair
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm mt-0.5" style="color: {{ $textColor }}; font-family: 'Lato', sans-serif;">
                                        {{ $item['description'] }}
                                    </p>
                                </div>
                                <span class="text-xl font-bold shrink-0" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', serif;">
                                    {{ $item['price'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book button --}}
                    <a
                        href="#contact"
                        class="mt-8 w-full inline-flex items-center justify-center py-3.5 text-sm font-semibold tracking-widest uppercase transition-all duration-300 rounded"
                        style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }}; font-family: 'Lato', sans-serif;"
                        onmouseover="this.style.backgroundColor='{{ $primaryColor }}';"
                        onmouseout="this.style.backgroundColor='{{ $accentColor }}';"
                    >
                        Afspraak maken
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <p class="mt-10 text-center text-sm" style="color: {{ $textColor }}; font-family: 'Lato', sans-serif;">
            Alle prijzen zijn inclusief BTW. Combinatiebehandelingen op aanvraag.
        </p>
    </div>
</section>
