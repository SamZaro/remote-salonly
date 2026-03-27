{{--
    Pure Template: Accordion/FAQ Section
    Natural & Botanical — clean accordion with teal toggle indicators
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? __('Happy to help');
    $items = $content['items'] ?? [
        ['question' => __('Are your products truly 100% natural?'), 'answer' => __('Yes! We work exclusively with certified organic and plant-based products. No parabens, sulfates, or synthetic fragrances.')],
        ['question' => __('Do I need to book in advance?'), 'answer' => __('Booking is recommended to avoid disappointment. You can make an appointment online or by phone. Walk-ins are welcome, but availability cannot be guaranteed.')],
        ['question' => __('How long does a plant-based color treatment last?'), 'answer' => __('Plant-based colors typically last 4 to 6 weeks, comparable to chemical alternatives. The big difference is that your hair stays healthier.')],
        ['question' => __('Can I buy gift vouchers?'), 'answer' => __('Absolutely! Our gift vouchers make the perfect present and are available in any value. You can purchase them online or in the salon.')],
    ];

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="accordion" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $backgroundColor }};">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header with watermark --}}
        <div
            class="text-center mb-14 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >FAQ</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <div class="w-16 h-px mx-auto" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="overflow-hidden rounded-none transition-shadow duration-300"
                        :class="openItem === {{ $index }} ? 'shadow-md' : ''"
                        style="background-color: #ffffff;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-8 lg:px-10 py-7 lg:py-8 text-left flex items-center justify-between gap-6"
                        >
                            <span class="text-xl lg:text-2xl font-bold" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <div
                                class="w-12 h-12 rounded-none flex items-center justify-center shrink-0 transition-all duration-300"
                                :style="openItem === {{ $index }}
                                    ? 'background-color: {{ $primaryColor }}; color: #ffffff;'
                                    : 'background-color: {{ $accentColor }}30; color: {{ $primaryColor }};'"
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
                            </div>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-8 lg:px-10 pb-8">
                                <div class="w-16 h-px mb-5" style="background-color: {{ $primaryColor }};"></div>
                                <p class="text-lg lg:text-xl leading-relaxed" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
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
