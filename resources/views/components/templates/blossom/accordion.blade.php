{{--
    Template-specifieke accordion voor Blossom (Luxury Beauty Salon)

    Elegante, zachte stijl met roze/lavendel thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? __('We are happy to help');
    $items = $content['items'] ?? [
        ['question' => __('Do I need to book in advance?'), 'answer' => __('Booking ahead is recommended to avoid disappointment. You can make an appointment online or by phone.')],
        ['question' => __('How long does a treatment take?'), 'answer' => __('This varies per treatment. A facial takes about 60-90 minutes, a manicure around 45 minutes.')],
        ['question' => __('Do you use natural products?'), 'answer' => __('Yes, we work exclusively with high-quality, natural and cruelty-free products for the best results.')],
        ['question' => __('Can I buy gift vouchers?'), 'answer' => __('Absolutely! Our gift vouchers are the perfect present and are available in any value you choose.')],
    ];

    // Theme kleuren - luxury beauty salon
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $sectionBg = $theme['accordion_background'] ?? '#faf8f5';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section id="accordion" class="py-20 lg:py-28 relative overflow-hidden" style="background-color: {{ $sectionBg }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {{-- Header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-lg"
                        style="background-color: {{ $backgroundColor }}; box-shadow: 0 4px 20px {{ $primaryColor }}10;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span
                                class="font-semibold text-lg"
                                style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                            >
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); color: white' : 'background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20); color: {{ $primaryColor }}'"
                            >
                                <svg
                                    class="w-5 h-5 transition-transform duration-300"
                                    :class="{ 'rotate-180': openItem === {{ $index }} }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-6 pb-6">
                                <div class="h-px mb-4" style="background: linear-gradient(to right, {{ $primaryColor }}40, transparent);"></div>
                                <p class="leading-relaxed" style="color: {{ $textColor }}; opacity: 0.8;">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
