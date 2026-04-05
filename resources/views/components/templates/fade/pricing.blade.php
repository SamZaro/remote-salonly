{{--
    Fade Template: Pricing Section
    Dark section — pricing cards with gold category headers and dotted separators
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title      = $content['title'] ?? __('Price List');
    $subtitle   = $content['subtitle'] ?? __('Our rates');
    $categories = $content['categories'] ?? [
        [
            'name'  => __('Cuts'),
            'items' => [
                ['service' => __('Classic Cut'),              'description' => __('Precision cut with wash and styling'),      'price' => '€27'],
                ['service' => __('Skin Fade'),                'description' => __('Clean fade with sharp lines'),              'price' => '€32'],
                ['service' => __('Buzz Cut'),                 'description' => __('Clipper cut all over'),                     'price' => '€18'],
                ['service' => __('Junior Cut (under 12)'),    'description' => __('For young gentlemen'),                      'price' => '€19'],
            ],
        ],
        [
            'name'  => __('Beard & Shave'),
            'items' => [
                ['service' => __('Beard Trim'),               'description' => __('Shape and groom to perfection'),            'price' => '€18'],
                ['service' => __('Hot Towel Shave'),          'description' => __('Traditional straight razor experience'),    'price' => '€35', 'popular' => true],
                ['service' => __('Cut & Beard Combo'),        'description' => __('Complete grooming package'),                'price' => '€42'],
            ],
        ],
        [
            'name'  => __('Extras'),
            'items' => [
                ['service' => __('Hair Wash & Style'),        'description' => __('Wash with professional styling'),           'price' => '€15'],
                ['service' => __('Head Massage'),             'description' => __('Relaxing scalp treatment'),                 'price' => '€12'],
                ['service' => __('Eyebrow Trim'),             'description' => __('Clean and defined brows'),                  'price' => '€8'],
            ],
        ],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor     = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';

    $formatPrice = fn($price) => str_starts_with((string) $price, '€') ? $price : '€' . $price;
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Section header --}}
        <div
            class="mb-16 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">{{ __('Rates') }}</span>
                </div>
                <h2
                    class="font-bold uppercase leading-[0.85]"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(2.4rem, 4.5vw, 4rem); letter-spacing: -0.02em; color: #ffffff;"
                >{{ $title }}</h2>
                <p class="mt-4 text-base font-light" style="color: rgba(255,255,255,0.45); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
            </div>

            <a
                href="#contact"
                class="group inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-widest shrink-0 transition-colors"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ __('Book Now') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Pricing grid --}}
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($categories as $categoryIndex => $category)
                <div
                    class="group relative p-10 md:p-12 border transition-all duration-300"
                    style="
                        background-color: transparent;
                        border-color: rgba(200,184,138,0.15);
                        opacity: 0;
                        transform: translateY(16px);
                        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $categoryIndex * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $categoryIndex * 0.1 }}s, border-color 0.3s ease;
                    "
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                    onmouseout="this.style.borderColor='rgba(200,184,138,0.15)'"
                >
                    {{-- Category header --}}
                    <h3
                        class="font-bold uppercase mb-8 pb-5"
                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.35rem; letter-spacing: 0.1em; border-bottom: 2px solid {{ $primaryColor }}30;"
                    >{{ $category['name'] }}</h3>

                    {{-- Price rows --}}
                    <div class="space-y-6">
                        @foreach($category['items'] as $item)
                            @php $isPopular = $item['popular'] ?? false; @endphp
                            <div class="flex items-end gap-3">
                                <div class="shrink-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-bold text-lg" style="color: #ffffff; font-family: '{{ $bodyFont }}';">
                                            {{ $item['service'] }}
                                        </span>
                                        @if($isPopular)
                                            <span
                                                class="text-xs font-bold uppercase tracking-wider px-2 py-0.5 shrink-0"
                                                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                                            >{{ __('Popular') }}</span>
                                        @endif
                                    </div>
                                    @if(!empty($item['description']))
                                        <p class="text-base font-light mt-0.5" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                </div>
                                <div class="flex-1 border-b border-dotted self-end" style="border-color: rgba(200,184,138,0.2); margin-bottom: 6px;"></div>
                                <span
                                    class="font-bold shrink-0"
                                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.6rem; letter-spacing: -0.02em;"
                                >{{ $formatPrice($item['price']) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <p class="mt-10 text-sm font-light" style="color: rgba(255,255,255,0.3); font-family: '{{ $bodyFont }}';">
            {{ __('All prices include VAT. Cash or card payment accepted.') }}
        </p>
    </div>
</section>
