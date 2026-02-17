{{--
    Icon Template: Pricing Section
    "Warm Atelier" — editorial menu-style price list, gold accents on dark canvas
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
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

    // Theme kleuren — Warm Atelier palette
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // Icons
    $icons = [
        'women' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'men' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];

    // Helper functie voor prijs formatting
    $formatPrice = function($price) {
        if (empty($price)) return '';
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="py-24 lg:py-36" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                    Prijslijst
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $backgroundColor }}50;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-6 lg:gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div
                    class="group relative transition-all duration-500"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $backgroundColor }}10; opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Gold top accent — expands on hover --}}
                    <div
                        class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    {{-- Category header inside card --}}
                    <div class="pt-10 pb-6 px-8 text-center">
                        {{-- Icon in gold circle --}}
                        <div
                            class="w-14 h-14 mx-auto mb-5 rounded-full flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}20;"
                        >
                            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $icons[$category['icon'] ?? 'women'] ?? $icons['women'] !!}
                            </svg>
                        </div>

                        {{-- Category name --}}
                        <h3
                            class="text-xl mb-4"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                        >
                            {{ $category['name'] }}
                        </h3>

                        {{-- Thin gold separator --}}
                        <div class="flex items-center justify-center gap-0">
                            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                        </div>
                    </div>

                    {{-- Price items --}}
                    <div class="px-8 pb-4">
                        @foreach($category['items'] as $itemIndex => $item)
                            @php
                                $isPopular = $item['popular'] ?? false;
                            @endphp
                            <div
                                class="py-4 {{ $itemIndex < count($category['items']) - 1 ? '' : '' }}"
                                style="{{ $itemIndex < count($category['items']) - 1 ? 'border-bottom: 1px solid ' . $headingColor . '06;' : '' }}"
                            >
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <h4
                                                class="text-[14px] font-semibold"
                                                style="color: {{ $headingColor }};"
                                            >
                                                {{ $item['service'] }}
                                            </h4>
                                            {{-- Popular indicator --}}
                                            @if($isPopular)
                                                <span class="inline-flex items-center gap-1.5 text-[11px] font-medium" style="color: {{ $primaryColor }};">
                                                    <span class="w-1 h-1 rounded-full" style="background-color: {{ $primaryColor }};"></span>
                                                    Populair
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-[13px] mt-0.5 leading-relaxed" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    </div>
                                    <span
                                        class="text-base shrink-0 mt-0.5"
                                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                                    >
                                        {{ $formatPrice($item['price']) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book button --}}
                    <div class="px-8 pb-8 pt-2">
                        <a
                            href="#contact"
                            class="group/link inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 hover:gap-3"
                            style="color: {{ $primaryColor }};"
                        >
                            Boek nu
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <div
            class="text-center mt-14"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <p class="text-[13px] leading-relaxed" style="color: {{ $backgroundColor }}35;">
                Alle prijzen zijn inclusief BTW. Lang haar vanaf +€5. Vraag naar onze combideals!
            </p>
        </div>
    </div>
</section>
