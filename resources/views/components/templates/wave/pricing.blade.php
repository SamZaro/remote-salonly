{{--
    Wave Template: Pricing Section
    "Coastal Minimal" — rounded category cards, gradient accents, clean price list, wave divider
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
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

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';

    $formatPrice = function($price) {
        if (empty($price)) return '';
        return str_starts_with($price, '€') ? $price : '€' . $price;
    };
@endphp

<section id="pricing" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Wave divider top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="{{ $backgroundColor }}">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15]"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-6 lg:gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div
                    class="rounded-2xl p-8 lg:p-10 transition-all duration-500 hover:shadow-lg"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; box-shadow: 0 1px 3px {{ $secondaryColor }}06; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Category header --}}
                    <div class="text-center mb-8">
                        <h3
                            class="text-2xl mb-2"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                        >
                            {{ $category['name'] }}
                        </h3>
                        <div class="w-10 h-[2px] mx-auto rounded-full" style="background: linear-gradient(to right, {{ $primaryColor }}, {{ $accentColor }});"></div>
                    </div>

                    {{-- Price items --}}
                    <div class="space-y-0">
                        @foreach($category['items'] as $item)
                            @php
                                $isPopular = $item['popular'] ?? false;
                            @endphp
                            <div
                                class="relative py-5 transition-colors duration-300"
                                style="border-bottom: 1px solid {{ $primaryColor }}08;"
                            >
                                {{-- Popular badge --}}
                                @if($isPopular)
                                    <span
                                        class="absolute -top-2.5 right-0 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-[0.1em] rounded-full"
                                        style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }}); color: #ffffff;"
                                    >
                                        Populair
                                    </span>
                                @endif

                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1">
                                        <h4 class="text-[15px] font-semibold mb-0.5" style="color: {{ $headingColor }};">
                                            {{ $item['service'] }}
                                        </h4>
                                        <p class="text-[13px]" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    </div>
                                    <span
                                        class="text-[15px] font-bold shrink-0"
                                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;"
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
                        class="group mt-8 w-full inline-flex items-center justify-center gap-2 py-3.5 text-sm font-semibold rounded-full transition-all duration-300 hover:shadow-md hover:-translate-y-0.5"
                        style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                    >
                        Reserveren
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <div
            class="mt-14 text-center"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: opacity 0.8s ease 0.3s;"
        >
            <div
                class="inline-flex items-center gap-3 px-6 py-3 rounded-full"
                style="background-color: {{ $primaryColor }}05; border: 1px solid {{ $primaryColor }}08;"
            >
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-[13px]" style="color: {{ $textColor }};">
                    Alle prijzen zijn inclusief BTW. Lang haar vanaf +€10.
                </p>
            </div>
        </div>
    </div>
</section>
