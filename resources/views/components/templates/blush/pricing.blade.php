{{--
    Blush Template: Pricing Section
    Elegant nail studio — refined price list with gold accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? __('Prices');
    $subtitle = $content['subtitle'] ?? __('Our rates');
    $categories = $content['categories'] ?? [
        [
            'name' => __('Manicure'),
            'items' => [
                ['service' => __('Classic Manicure'), 'description' => __('Nail shaping, cuticle care & polish'), 'price' => '€35'],
                ['service' => __('Gel Manicure'), 'description' => __('Long-lasting gel polish application'), 'price' => '€50'],
                ['service' => __('Luxury Manicure'), 'description' => __('Including hand mask & massage'), 'price' => '€65'],
                ['service' => __('Nail Art'), 'description' => __('Custom design per nail'), 'price' => __('From') . ' €5'],
            ],
        ],
        [
            'name' => __('Pedicure'),
            'items' => [
                ['service' => __('Classic Pedicure'), 'description' => __('Foot care, shaping & polish'), 'price' => '€45'],
                ['service' => __('Gel Pedicure'), 'description' => __('With gel polish finish'), 'price' => '€60'],
                ['service' => __('Spa Pedicure'), 'description' => __('Including scrub & massage'), 'price' => '€75'],
                ['service' => __('Express Pedicure'), 'description' => __('Quick refresh treatment'), 'price' => '€30'],
            ],
        ],
        [
            'name' => __('Extensions'),
            'items' => [
                ['service' => __('Acrylic Set'), 'description' => __('Full set with tips or forms'), 'price' => '€70'],
                ['service' => __('Gel Extensions'), 'description' => __('Natural-looking gel overlay'), 'price' => '€75'],
                ['service' => __('Infill / Refill'), 'description' => __('Maintenance after 2-3 weeks'), 'price' => '€50'],
                ['service' => __('Removal'), 'description' => __('Safe removal of extensions'), 'price' => '€25'],
            ],
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';

    $categoryCount = count($categories);
    $gridCols = match(true) {
        $categoryCount === 1 => 'lg:grid-cols-1 max-w-2xl mx-auto',
        $categoryCount === 2 => 'lg:grid-cols-2 max-w-5xl mx-auto',
        $categoryCount >= 3 => 'lg:grid-cols-3',
        default => 'lg:grid-cols-1',
    };
@endphp

<section id="pricing" class="py-20 lg:py-32" style="background-color: {{ $backgroundColor }}; font-family: {{ $bodyFont }};">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                </svg>
                <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            @if($subtitle)
                <span class="text-xs font-medium uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
            @endif
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-light" style="color: {{ $headingColor }}; font-family: {{ $headingFont }};">
                {{ $title }}
            </h2>
        </div>

        {{-- Pricing grid --}}
        <div class="grid gap-12 lg:gap-8 {{ $gridCols }}">
            @foreach($categories as $index => $category)
                <div
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Category title --}}
                    <h3
                        class="text-xl font-light mb-8 pb-4"
                        style="color: {{ $headingColor }}; font-family: {{ $headingFont }}; border-bottom: 1px solid {{ $primaryColor }};"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Items --}}
                    <div class="space-y-6">
                        @foreach($category['items'] as $item)
                            <div class="flex justify-between items-baseline gap-4">
                                <div class="min-w-0">
                                    <span class="text-base font-medium" style="color: {{ $headingColor }};">
                                        {{ $item['service'] }}
                                    </span>
                                    @if(!empty($item['description']))
                                        <p class="text-sm mt-0.5 truncate" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                </div>
                                <span class="text-base font-medium shrink-0" style="color: {{ $primaryColor }};">
                                    @php
                                        $price = $item['price'] ?? '';
                                        $displayPrice = (is_numeric($price) || preg_match('/^\d/', $price))
                                            ? '€' . $price
                                            : $price;
                                    @endphp
                                    {{ $displayPrice }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
