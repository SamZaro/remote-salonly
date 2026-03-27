{{--
    Level Template: Pricing Section
    Light section — grid cards with orange left-accent hover, dotted price rows
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title      = $content['title'] ?? __('Price List');
    $subtitle   = $content['subtitle'] ?? __('Transparent pricing, honest quality');
    $categories = $content['categories'] ?? [
        [
            'name'  => __('Women'),
            'items' => [
                ['service' => __('Cut'),                        'description' => __('Wash, cut and blow-dry'),                   'price' => '€45'],
                ['service' => __('Dry Cut'),                    'description' => __('Cut only, without washing'),                 'price' => '€35'],
                ['service' => __('Blow-dry & Style'),           'description' => __('Professional blow-dry to suit your look'),   'price' => '€22'],
                ['service' => __('Children (up to 12)'),        'description' => __('Haircut for the youngest clients'),          'price' => '€19'],
            ],
        ],
        [
            'name'  => __('Men'),
            'items' => [
                ['service' => __('Men\'s Cut'),                 'description' => __('Classic or modern — always sharp'),          'price' => '€27'],
                ['service' => __('Cut + Wash'),                 'description' => __('Including head massage and styling'),        'price' => '€32'],
                ['service' => __('Children (up to 12)'),        'description' => __('Youngest clients welcome'),                  'price' => '€19'],
            ],
        ],
        [
            'name'  => __('Colour & Treatment'),
            'items' => [
                ['service' => __('Highlights'),                 'description' => __('Partial or full highlights'),                'price' => '€65', 'popular' => true],
                ['service' => __('Colour'),                     'description' => __('Full hair colour treatment'),                'price' => '€55'],
                ['service' => __('Intensive Treatment'),        'description' => __('Nourishing hair and scalp care'),            'price' => '€30'],
            ],
        ],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor     = $theme['accent_color'] ?? '#ffedd5';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#111111';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';

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
                    <div class="w-9 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">{{ __('Rates') }}</span>
                </div>
                <h2
                    class="font-black leading-[0.9]"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.03em; color: #ffffff;"
                >{{ $title }}</h2>
                <p class="mt-4 text-base font-light" style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
            </div>

            <a
                href="#contact"
                class="group inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-widest shrink-0 transition-colors"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ __('Book Appointment') }}
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
                        border-color: rgba(255,255,255,0.1);
                        opacity: 0;
                        transform: translateY(16px);
                        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $categoryIndex * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $categoryIndex * 0.1 }}s, border-color 0.3s ease;
                    "
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                    onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'"
                >
                    {{-- Category header --}}
                    <h3
                        class="font-black uppercase mb-8 pb-5"
                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.35rem; letter-spacing: 0.1em; border-bottom: 2px solid {{ $primaryColor }}30;"
                    >{{ $category['name'] }}</h3>

                    {{-- Price rows --}}
                    <div class="space-y-6">
                        @foreach($category['items'] as $item)
                            @php $isPopular = $item['popular'] ?? false; @endphp
                            <div class="flex items-end gap-3">

                                {{-- Service + popular badge --}}
                                <div class="shrink-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-bold text-lg" style="color: #ffffff; font-family: '{{ $bodyFont }}';">
                                            {{ $item['service'] }}
                                        </span>
                                        @if($isPopular)
                                            <span
                                                class="text-xs font-bold uppercase tracking-wider px-2 py-0.5 shrink-0"
                                                style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}';"
                                            >{{ __('Popular') }}</span>
                                        @endif
                                    </div>
                                    @if(!empty($item['description']))
                                        <p class="text-base font-light mt-0.5" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">
                                            {{ $item['description'] }}
                                        </p>
                                    @endif
                                </div>

                                {{-- Dotted line --}}
                                <div class="flex-1 border-b border-dotted self-end" style="border-color: rgba(255,255,255,0.15); margin-bottom: 6px;"></div>

                                {{-- Price --}}
                                <span
                                    class="font-black shrink-0"
                                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.6rem; letter-spacing: -0.03em;"
                                >{{ $formatPrice($item['price']) }}</span>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Footer note --}}
        <p class="mt-10 text-sm font-light" style="color: rgba(255,255,255,0.35); font-family: '{{ $bodyFont }}';">
            {{ __('All prices include VAT. Cash or card payment accepted.') }}
        </p>

    </div>
</section>
