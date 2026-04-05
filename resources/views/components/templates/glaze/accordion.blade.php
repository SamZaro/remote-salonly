{{--
    Glaze Template: Accordion / FAQ Section
    Clean accordion with rose accents on light background
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? 'FAQ';
    $items = $content['items'] ?? [
        ['question' => __('Do I need to book in advance?'), 'answer' => __('Booking is recommended but not required. Walk-ins are welcome, but with a reservation you are guaranteed your spot.')],
        ['question' => __('How long does a gel manicure last?'), 'answer' => __('A gel manicure typically lasts 2-3 weeks with proper care. We recommend a refresh every 3 weeks.')],
        ['question' => __('What payment methods do you accept?'), 'answer' => __('We accept debit card, cash and most credit cards. Contactless payment is also possible.')],
        ['question' => __('Can I cancel my appointment?'), 'answer' => __('Yes, we ask that you cancel at least 24 hours in advance so we can offer the time to other customers.')],
    ];

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">{{ $subtitle }}</span>
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-3" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-2xl overflow-hidden transition-all duration-300 border"
                        :style="openItem === {{ $index }} ? 'border-color: {{ $primaryColor }}30; background-color: #ffffff; box-shadow: 0 4px 20px {{ $primaryColor }}08' : 'border-color: transparent; background-color: #ffffff'"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="font-semibold text-lg" style="color: {{ $headingColor }};">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; color: white' : 'background-color: {{ $primaryColor }}10; color: {{ $primaryColor }}'"
                            >
                                <svg
                                    class="w-4 h-4 transition-transform duration-300"
                                    :class="{ 'rotate-180': openItem === {{ $index }} }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>
                        <div x-show="openItem === {{ $index }}" x-collapse x-cloak>
                            <div class="px-6 pb-6">
                                <p class="leading-relaxed" style="color: {{ $textColor }};">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: {{ $textColor }};">{{ __('No questions defined.') }}</p>
        @endif

        <div class="flex items-center justify-center mt-16">
            <div class="h-0.5 w-32 rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
