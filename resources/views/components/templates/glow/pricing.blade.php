{{--
    Glow Template: Pricing Section
    Warm minimalist — clean menu-style price lists without gradient headers
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? __('Price List');
    $subtitle = $content['subtitle'] ?? __('Our treatments and rates');
    $categories = $content['categories'] ?? [
        [
            'name' => __('Hair'),
            'icon' => 'hair',
            'items' => [
                ['service' => __('Cut & Blow-dry'), 'description' => __('Including wash and styling'), 'price' => '€55'],
                ['service' => __('Cut & Style Deluxe'), 'description' => __('With treatment and finishing'), 'price' => '€75'],
                ['service' => __('Root Colour'), 'description' => __('Touch up the roots'), 'price' => '€65'],
                ['service' => __('Full Colour'), 'description' => __('Full hair colouring'), 'price' => '€85'],
                ['service' => __('Balayage / Highlights'), 'description' => __('Hand-painted highlights'), 'price' => __('From €120'), 'popular' => true],
                ['service' => __('Keratin Treatment'), 'description' => __('Smooth, glossy hair'), 'price' => __('From €150')],
            ],
        ],
        [
            'name' => __('Nails'),
            'icon' => 'nails',
            'items' => [
                ['service' => __('Classic Manicure'), 'description' => __('Care and polish'), 'price' => '€35'],
                ['service' => __('Deluxe Manicure'), 'description' => __('With scrub and mask'), 'price' => '€50'],
                ['service' => __('Gel Nails'), 'description' => __('New set or infill'), 'price' => __('From €55')],
                ['service' => __('Nail Art'), 'description' => __('Creative designs'), 'price' => __('From €15')],
                ['service' => __('Spa Pedicure'), 'description' => __('Complete foot care'), 'price' => '€55'],
            ],
        ],
        [
            'name' => 'Lash & Brow',
            'icon' => 'lash',
            'items' => [
                ['service' => __('Brow Design'), 'description' => __('Wax, threading & shaping'), 'price' => '€25'],
                ['service' => __('Brow Lamination'), 'description' => __('Full, defined brows'), 'price' => '€45', 'popular' => true],
                ['service' => __('Lash Lift'), 'description' => __('Natural lash lift'), 'price' => '€55'],
                ['service' => __('Lash Extensions Classic'), 'description' => __('Natural look'), 'price' => '€85'],
                ['service' => __('Lash Extensions Volume'), 'description' => __('Full, dramatic look'), 'price' => '€110'],
            ],
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block" style="color: {{ $secondaryColor }};">
                {{ __('Prices') }}
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing categories --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($categories as $index => $category)
                <div
                    class="p-8"
                    style="background-color: white; border-radius: 12px;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(16px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                >
                    {{-- Category header --}}
                    <h3
                        class="text-2xl font-bold mb-6 pb-4"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif; border-bottom: 2px solid {{ $primaryColor }};"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Price items --}}
                    <div class="space-y-4">
                        @foreach($category['items'] as $item)
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-medium" style="color: {{ $headingColor }};">
                                            {{ $item['service'] }}
                                        </h4>
                                        @if($item['popular'] ?? false)
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5"
                                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-radius: 3px;"
                                            >
                                                {{ __('Popular') }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm mt-0.5" style="color: {{ $textColor }};">
                                        {{ $item['description'] }}
                                    </p>
                                </div>
                                <span class="font-bold shrink-0" style="color: {{ $secondaryColor }};">
                                    {{ $item['price'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Book button --}}
                    <a
                        href="#contact"
                        class="mt-8 w-full inline-flex items-center justify-center py-3 text-sm font-semibold tracking-wide uppercase transition-opacity hover:opacity-80"
                        style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }}; border-radius: 6px;"
                    >
                        {{ __('Make Appointment') }}
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <p class="mt-10 text-center text-sm" style="color: {{ $textColor }};">
            {{ __('All prices include VAT. Long hair from +€10.') }}
        </p>
    </div>
</section>
