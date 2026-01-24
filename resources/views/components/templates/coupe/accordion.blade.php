{{--
    Template-specifieke accordion voor Coupe (Kapsalon)

    Elegante kapsalon stijl met warme bruintinten
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

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $textColor = '#ffffff';  // Accordion altijd wit op donkere achtergrond
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings (niet gebruikt in accordion)
    $backgroundColor = $theme['accordion_background'] ?? $secondaryColor;
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-sm font-medium uppercase tracking-widest mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light tracking-wide"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-3" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="overflow-hidden transition-all duration-300"
                        :style="openItem === {{ $index }} ? 'border-left: 3px solid {{ $primaryColor }}' : 'border-left: 3px solid transparent'"
                        style="background-color: {{ $primaryColor }}10;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span
                                class="font-medium text-lg"
                                style="color: {{ $textColor }};"
                            >
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <svg
                                class="w-5 h-5 transition-transform duration-300 flex-shrink-0"
                                :class="{ 'rotate-180': openItem === {{ $index }} }"
                                :style="openItem === {{ $index }} ? 'color: {{ $primaryColor }}' : 'color: {{ $textColor }}'"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-6 pb-6">
                                <p class="leading-relaxed opacity-80" style="color: {{ $textColor }};">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bottom decorative --}}
        <div class="mt-12 text-center">
            <div class="h-px w-32 mx-auto" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
