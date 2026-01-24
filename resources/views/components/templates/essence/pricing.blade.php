{{--
    Template-specifieke pricing voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Prijslijst';
    $subtitle = $content['subtitle'] ?? 'Transparante prijzen voor onze verfijnde behandelingen';
    $items = $content['items'] ?? [
        ['service' => 'Knippen', 'price' => '€65', 'description' => 'Inclusief consult en styling'],
        ['service' => 'Knippen + Föhnen', 'price' => '€85', 'description' => 'Complete behandeling'],
        ['service' => 'Balayage', 'price' => '€145', 'description' => 'Natuurlijke highlights', 'popular' => true],
        ['service' => 'Full Colour', 'price' => '€95', 'description' => 'Volledige kleuring'],
        ['service' => 'Bridal Package', 'price' => '€295', 'description' => 'Proefkap + trouwdag styling'],
        ['service' => 'Luxury Treatment', 'price' => '€55', 'description' => 'Intensieve haarverzorging'],
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';

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
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Prijzen</span>
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing card --}}
        <div class="relative bg-white p-10 lg:p-14" style="box-shadow: 0 4px 40px {{ $secondaryColor }}08;">
            {{-- Decoratieve hoeken --}}
            <div class="absolute top-6 left-6 w-12 h-12">
                <div class="absolute top-0 left-0 w-full h-px" style="background-color: {{ $primaryColor }};"></div>
                <div class="absolute top-0 left-0 w-px h-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <div class="absolute top-6 right-6 w-12 h-12">
                <div class="absolute top-0 right-0 w-full h-px" style="background-color: {{ $primaryColor }};"></div>
                <div class="absolute top-0 right-0 w-px h-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <div class="absolute bottom-6 left-6 w-12 h-12">
                <div class="absolute bottom-0 left-0 w-full h-px" style="background-color: {{ $primaryColor }};"></div>
                <div class="absolute bottom-0 left-0 w-px h-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <div class="absolute bottom-6 right-6 w-12 h-12">
                <div class="absolute bottom-0 right-0 w-full h-px" style="background-color: {{ $primaryColor }};"></div>
                <div class="absolute bottom-0 right-0 w-px h-full" style="background-color: {{ $primaryColor }};"></div>
            </div>

            {{-- Price items --}}
            <div class="space-y-0">
                @foreach($items as $index => $item)
                    @php
                        $isPopular = $item['popular'] ?? false;
                    @endphp
                    <div class="relative py-6 {{ $index > 0 ? 'border-t' : '' }}" style="border-color: {{ $primaryColor }}60;">
                        {{-- Popular badge --}}
                        @if($isPopular)
                            <div
                                class="absolute -right-2 top-1/2 -translate-y-1/2 px-3 py-1 text-xs font-medium uppercase tracking-wider hidden sm:block"
                                style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
                            >
                                Populair
                            </div>
                        @endif

                        <div class="flex items-center justify-between gap-4 pr-20 sm:pr-24">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-base font-medium" style="color: {{ $secondaryColor }};">
                                        {{ $item['service'] }}
                                    </h3>
                                    @if($isPopular)
                                        <span class="sm:hidden text-xs font-medium uppercase px-2 py-0.5" style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};">
                                            Top
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm mt-1" style="color: {{ $textColor }}; opacity: 0.6;">
                                    {{ $item['description'] }}
                                </p>
                            </div>

                            {{-- Dotted line --}}
                            <div class="flex-1 border-b border-dotted hidden sm:block" style="border-color: {{ $primaryColor }};"></div>

                            {{-- Price --}}
                            <div class="text-lg font-light" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;">
                                {{ $formatPrice($item['price']) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Note --}}
            <div class="mt-10 pt-8 border-t text-center" style="border-color: {{ $primaryColor }}60;">
                <p class="text-sm italic" style="color: {{ $textColor }}; opacity: 0.6;">
                    Prijzen zijn inclusief BTW • Consult altijd inbegrepen
                </p>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a
                href="#contact"
                class="inline-flex items-center justify-center px-10 py-4 text-sm font-medium uppercase tracking-widest transition-all duration-300 hover:opacity-90"
                style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
            >
                Reserveer Nu
            </a>
        </div>
    </div>
</section>
