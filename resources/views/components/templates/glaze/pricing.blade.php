{{--
    Glaze Template: Pricing Section
    Clean pricing cards with rose accent borders for nail studio
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
                ['service' => __('Classic Manicure'), 'description' => __('Filing, cuticle care & polish'), 'price' => '€30'],
                ['service' => __('Gel Manicure'), 'description' => __('Long-lasting gel polish'), 'price' => '€45'],
                ['service' => __('Gel Extensions'), 'description' => __('Full set with tips or forms'), 'price' => '€65'],
                ['service' => __('Nail Art'), 'description' => __('Per nail, designs on request'), 'price' => __('From') . ' €3'],
            ],
        ],
        [
            'name' => __('Pedicure'),
            'items' => [
                ['service' => __('Classic Pedicure'), 'description' => __('Foot care & polish'), 'price' => '€35'],
                ['service' => __('Gel Pedicure'), 'description' => __('Including gel polish'), 'price' => '€50'],
                ['service' => __('Luxe Pedicure'), 'description' => __('With scrub & mask treatment'), 'price' => '€60'],
                ['service' => __('Callus Treatment'), 'description' => __('Professional removal'), 'price' => '€25'],
            ],
        ],
        [
            'name' => __('Extras'),
            'items' => [
                ['service' => __('Gel Removal'), 'description' => __('Safe soak-off removal'), 'price' => '€15'],
                ['service' => __('Nail Repair'), 'description' => __('Per nail'), 'price' => '€8'],
                ['service' => __('Paraffin Treatment'), 'description' => __('Hydrating hand/foot care'), 'price' => '€20'],
                ['service' => __('Hand Massage'), 'description' => __('Relaxing 15-minute massage'), 'price' => '€15'],
            ],
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    $categoryCount = count($categories);
    $gridCols = match(true) {
        $categoryCount === 1 => 'lg:grid-cols-1 max-w-2xl mx-auto',
        $categoryCount === 2 => 'lg:grid-cols-2 max-w-5xl mx-auto',
        $categoryCount >= 3 => 'lg:grid-cols-3',
        default => 'lg:grid-cols-1',
    };
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">{{ $subtitle }}</span>
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;">
                {{ $title }}
            </h2>
        </div>

        {{-- Pricing grid --}}
        <div class="grid gap-10 lg:gap-8 {{ $gridCols }}">
            @foreach($categories as $index => $category)
                <div
                    class="bg-white rounded-2xl p-8 border transition-all duration-500 hover:shadow-lg"
                    style="border-color: {{ $primaryColor }}10;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Category title --}}
                    <h3
                        class="text-xl font-bold mb-6 pb-4 border-b-2"
                        style="color: {{ $headingColor }}; border-color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                    >
                        {{ $category['name'] }}
                    </h3>

                    {{-- Items --}}
                    <div class="space-y-5">
                        @foreach($category['items'] as $item)
                            <div class="flex justify-between items-baseline gap-4">
                                <div class="min-w-0">
                                    <span class="text-base font-semibold" style="color: {{ $headingColor }};">
                                        {{ $item['service'] }}
                                    </span>
                                    @if(!empty($item['description']))
                                        <p class="text-sm truncate" style="color: {{ $textColor }};">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                </div>
                                <span class="text-base font-bold shrink-0" style="color: {{ $primaryColor }};">
                                    @php
                                        $price = $item['price'] ?? '';
                                        $displayPrice = (is_numeric($price) || preg_match('/^\d/', $price)) ? '€' . $price : $price;
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
