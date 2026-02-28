{{--
    Urban Template: Pricing Section
    Light section — editorial menu-style price list with sharp dividers
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title      = $content['title'] ?? 'Prijslijst';
    $subtitle   = $content['subtitle'] ?? 'Kwaliteit tegen eerlijke prijzen';
    $categories = $content['categories'] ?? [
        [
            'name'  => 'Knippen',
            'items' => [
                ['service' => 'Heren Knippen',    'description' => 'Schaar of tondeuse, inclusief styling',       'price' => '€27'],
                ['service' => 'Fade / Skin Fade',  'description' => 'Strakke fade van laag naar hoog',            'price' => '€30'],
                ['service' => 'Knippen + Wassen',  'description' => 'Inclusief ontspannende hoofdmassage',        'price' => '€32'],
                ['service' => 'Kids Knippen',       'description' => 'Tot en met 12 jaar',                        'price' => '€19'],
                ['service' => 'Senior 65+',         'description' => 'Speciaal senioren tarief',                  'price' => '€22'],
            ],
        ],
        [
            'name'  => 'Baard & Scheren',
            'items' => [
                ['service' => 'Baard Trimmen',     'description' => 'Vormen en bijwerken van de baard',           'price' => '€22'],
                ['service' => 'Baard Modelleren',  'description' => 'Complete baardverzorging met lijn',          'price' => '€25'],
                ['service' => 'Hot Towel Shave',   'description' => 'Klassieke scheerbeurt met warme doeken',     'price' => '€32'],
                ['service' => 'Scheren Gezicht',   'description' => 'Compleet glad scheren',                     'price' => '€28'],
            ],
        ],
        [
            'name'  => 'Combinaties',
            'items' => [
                ['service' => 'Knippen + Baard',   'description' => 'Onze populairste behandeling',              'price' => '€45', 'popular' => true],
                ['service' => 'The Full Package',  'description' => 'Knippen, baard, hot towel shave',            'price' => '€65'],
                ['service' => 'Vader & Zoon',      'description' => 'Samen knippen, samen besparen',             'price' => '€40'],
            ],
        ],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor     = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';

    $formatPrice = fn($price) => str_starts_with((string) $price, '€') ? $price : '€' . $price;
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-5xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Tarieven</span>
            </div>
            <h2
                class="font-black uppercase leading-[0.9] mb-4"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
            <p class="text-lg" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        {{-- Menu card --}}
        <div
            class="overflow-hidden"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
        >
            <div class="space-y-0">
                @foreach($categories as $categoryIndex => $category)

                    {{-- Category header --}}
                    <div class="flex items-center gap-6 py-4 mb-2">
                        <h3
                            class="font-black uppercase tracking-widest text-xl shrink-0"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}';"
                        >
                            {{ $category['name'] }}
                        </h3>
                        <div class="flex-1 h-px" style="background-color: {{ $primaryColor }}30;"></div>
                    </div>

                    {{-- Items --}}
                    <div class="mb-10">
                        @foreach($category['items'] as $item)
                            @php $isPopular = $item['popular'] ?? false; @endphp
                            <div
                                class="group flex items-center justify-between py-4 px-4 -mx-4 transition-colors duration-200"
                                style="{{ $isPopular ? 'background-color: ' . $primaryColor . '10;' : '' }}"
                                onmouseover="{{ !$isPopular ? "this.style.backgroundColor='" . $primaryColor . "08'" : '' }}"
                                onmouseout="{{ !$isPopular ? "this.style.backgroundColor='transparent'" : '' }}"
                            >
                                <div class="flex-1 min-w-0 mr-4">
                                    <div class="flex items-center gap-3 flex-wrap">
                                        <h4 class="font-bold" style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}';">
                                            {{ $item['service'] }}
                                        </h4>
                                        @if($isPopular)
                                            <span
                                                class="text-xs font-bold uppercase tracking-wider px-2 py-0.5 shrink-0"
                                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                                            >
                                                Populair
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm mt-0.5 truncate" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                                        {{ $item['description'] }}
                                    </p>
                                </div>

                                {{-- Dotted line --}}
                                <div class="hidden sm:block flex-1 mx-4 border-b border-dotted" style="border-color: {{ $headingColor }}15;"></div>

                                {{-- Price --}}
                                <span
                                    class="font-black text-2xl shrink-0"
                                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; letter-spacing: -0.02em;"
                                >
                                    {{ $formatPrice($item['price']) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    @if(!$loop->last)
                        <div class="h-px mb-8" style="background-color: {{ $headingColor }}08;"></div>
                    @endif

                @endforeach
            </div>

            {{-- Footer note --}}
            <div class="pt-8 border-t" style="border-color: {{ $headingColor }}10;">
                <p class="text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                    Alle prijzen zijn inclusief BTW. Contante betaling of pin mogelijk.
                </p>
            </div>
        </div>

        {{-- CTA --}}
        <div class="mt-12 flex flex-wrap gap-4 items-center">
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 px-10 py-5 font-bold uppercase tracking-widest text-sm transition-all hover:opacity-85"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                Maak Afspraak
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
