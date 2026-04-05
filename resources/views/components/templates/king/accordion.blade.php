{{--
    King Template: Accordion Section
    "Royal Throne" — editorial FAQ, diamond accents, serif numbers, gold left-border
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? __('Everything you need to know before your visit');
    $items = $content['items'] ?? [
        ['question' => __('Do I need to book in advance?'), 'answer' => __('We recommend booking online for guaranteed availability. Walk-ins are welcome but priority goes to appointments.')],
        ['question' => __('What makes King different?'), 'answer' => __('Every visit is a premium experience — hot towels, professional products, and barbers who treat their craft as an art form.')],
        ['question' => __('Do you do beard grooming?'), 'answer' => __('Absolutely. From simple trims to full beard sculpting and hot towel shaves, we handle it all.')],
        ['question' => __('What products do you use?'), 'answer' => __('We exclusively use premium professional products. All products used during your visit are also available for purchase.')],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<section id="accordion" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-semibold" style="color: {{ $primaryColor }};">
                    FAQ
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Accordion items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="overflow-hidden transition-all duration-500"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        :style="openItem === {{ $index }}
                            ? 'border: 1px solid {{ $headingColor }}06; border-left: 2px solid {{ $primaryColor }}; box-shadow: 0 2px 12px rgba(0,0,0,0.04); background-color: {{ $backgroundColor }};'
                            : 'border: 1px solid {{ $headingColor }}06; border-left: 2px solid transparent; box-shadow: none; background-color: {{ $backgroundColor }};'"
                        style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.08 }}s;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4 cursor-pointer"
                        >
                            <div class="flex items-center gap-4">
                                {{-- Serif number --}}
                                <span
                                    class="shrink-0 text-lg select-none"
                                    style="color: {{ $primaryColor }}20; font-family: '{{ $headingFont }}', serif;"
                                >
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span
                                    class="text-[15px] font-semibold"
                                    style="color: {{ $headingColor }};"
                                >
                                    {{ $item['question'] ?? $item['title'] ?? '' }}
                                </span>
                            </div>
                            {{-- Diamond toggle --}}
                            <div
                                class="w-3 h-3 shrink-0 rotate-45 transition-all duration-300"
                                :style="openItem === {{ $index }}
                                    ? 'background-color: {{ $primaryColor }}; transform: rotate(45deg) scale(1);'
                                    : 'background-color: transparent; border: 1px solid {{ $primaryColor }}40; transform: rotate(45deg) scale(0.8);'"
                            ></div>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-6 pb-6 pl-[4.25rem]">
                                <p class="text-[14px] leading-[1.7]" style="color: {{ $textColor }};">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- CTA --}}
        <div
            class="mt-14 text-center"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <p class="text-[14px] mb-5" style="color: {{ $textColor }};">{{ __("Don't see your question?") }}</p>
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 text-[12px] font-bold uppercase tracking-[0.15em] transition-all duration-300 hover:gap-4"
                style="color: {{ $primaryColor }};"
            >
                {{ __('Get in touch') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
