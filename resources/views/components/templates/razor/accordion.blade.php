{{--
    Template-specifieke accordion voor Razor (Barbershop)

    Bold barbershop stijl met goud/zwart thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'FAQ';
    $subtitle = $content['subtitle'] ?? 'Veelgestelde Vragen';
    $items = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren wordt aanbevolen, maar walk-ins zijn altijd welkom. Met een reservering ben je verzekerd van je plek.'],
        ['question' => 'Hoe lang duurt een behandeling?', 'answer' => 'Een standaard knipbeurt duurt 30-45 minuten. Een hot towel shave neemt ongeveer 45 minuten in beslag.'],
        ['question' => 'Bieden jullie ook baardverzorging?', 'answer' => 'Jazeker. Van trimmen tot een volledige hot towel shave - we verzorgen je baard met precisie.'],
        ['question' => 'Wat zijn de betaalmogelijkheden?', 'answer' => 'We accepteren contant, pin en alle gangbare creditcards. Contactloos betalen is ook mogelijk.'],
    ];

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    $headingFont = $theme['heading_font_family'] ?? 'Bebas Neue';
    $bodyFont = $theme['font_family'] ?? 'Barlow';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-bold"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-4 mt-6">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <div class="w-3 h-3 rotate-45" style="background-color: {{ $primaryColor }};"></div>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-0" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="border-b transition-all duration-300"
                        style="border-color: {{ $primaryColor }}30;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full py-6 text-left flex items-center justify-between gap-6 group"
                        >
                            <div class="flex items-center gap-6">
                                <span
                                    class="text-4xl font-bold transition-colors"
                                    :style="openItem === {{ $index }} ? 'color: {{ $primaryColor }}' : 'color: {{ $primaryColor }}40'"
                                    style="font-family: '{{ $headingFont }}', Georgia, serif;"
                                >
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span
                                    class="font-bold text-xl uppercase tracking-wider"
                                    style="color: {{ $textColor }};"
                                >
                                    {{ $item['question'] ?? $item['title'] ?? '' }}
                                </span>
                            </div>
                            <span
                                class="flex-shrink-0 w-12 h-12 flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}' : 'background-color: transparent; color: {{ $primaryColor }}'"
                                style="border: 2px solid {{ $primaryColor }};"
                            >
                                <svg
                                    class="w-6 h-6 transition-transform duration-300"
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
                            <div class="pb-6 pl-[4.5rem]">
                                <p class="leading-relaxed max-w-2xl" style="color: {{ $textColor }}; opacity: 0.7;">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bottom CTA --}}
        <div class="mt-16 text-center">
            <p class="mb-6 uppercase tracking-wider text-sm" style="color: {{ $textColor }}; opacity: 0.5;">Nog vragen?</p>
            <a
                href="#contact"
                class="inline-flex items-center gap-3 px-8 py-4 text-sm font-bold uppercase tracking-wider transition-all duration-300 border-2 hover:scale-105"
                style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }}; background: transparent;"
                onmouseover="this.style.background='{{ $primaryColor }}'; this.style.color='{{ $secondaryColor }}'"
                onmouseout="this.style.background='transparent'; this.style.color='{{ $primaryColor }}'"
            >
                Neem Contact Op
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
