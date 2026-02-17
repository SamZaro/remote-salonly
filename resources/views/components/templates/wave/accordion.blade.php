{{--
    Wave Template: Accordion / FAQ Section
    "Coastal Minimal" — rounded accordion items, gradient left-border, wave accent, x-collapse
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'Goed om te weten';
    $items = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden, vooral in het weekend. Je kunt eenvoudig online of telefonisch een afspraak maken.'],
        ['question' => 'Wat kost een knipbeurt?', 'answer' => 'Onze prijzen variëren afhankelijk van de behandeling. Bekijk onze prijslijst of neem contact op voor meer informatie.'],
        ['question' => 'Doen jullie ook kleuren?', 'answer' => 'Ja, we bieden een uitgebreid assortiment aan kleurbehandelingen, van highlights tot volledige kleuring.'],
        ['question' => 'Hoe kan ik mijn afspraak wijzigen?', 'answer' => 'Je kunt je afspraak tot 24 uur van tevoren kosteloos wijzigen of annuleren via telefoon of online.'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section id="accordion" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Wave divider top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="{{ $backgroundColor }}">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z"/>
        </svg>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {{-- Header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15]"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-3" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-xl overflow-hidden transition-all duration-500"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        :style="openItem === {{ $index }}
                            ? 'background-color: {{ $backgroundColor }}; border-left: 3px solid {{ $primaryColor }}; box-shadow: 0 4px 16px {{ $secondaryColor }}06;'
                            : 'background-color: {{ $backgroundColor }}; border-left: 3px solid transparent;'"
                        style="opacity: 0; transform: translateY(12px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.08 }}s;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span
                                class="font-semibold text-[15px]"
                                :style="openItem === {{ $index }} ? 'color: {{ $headingColor }}' : 'color: {{ $headingColor }}cc'"
                            >
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <div
                                class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 transition-all duration-300"
                                :style="openItem === {{ $index }}
                                    ? 'background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }}); color: #ffffff;'
                                    : 'background-color: {{ $primaryColor }}08; color: {{ $primaryColor }};'"
                            >
                                <svg
                                    class="w-3.5 h-3.5 transition-transform duration-300"
                                    :class="{ 'rotate-180': openItem === {{ $index }} }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-6 pb-6">
                                <p class="text-[14px] leading-[1.75]" style="color: {{ $textColor }};">
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
