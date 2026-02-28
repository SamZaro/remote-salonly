{{--
    Template-specifieke accordion/FAQ voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'Alles over onze natuurlijke aanpak';
    $items = $content['items'] ?? [
        [
            'question' => 'Zijn jullie producten echt 100% natuurlijk?',
            'answer' => 'Ja! Wij werken uitsluitend met gecertificeerde biologische en plantaardige producten. Geen parabenen, sulfaten of synthetische geurstoffen.',
        ],
        [
            'question' => 'Kan ik allergisch reageren op natuurlijke producten?',
            'answer' => 'Hoewel onze producten natuurlijk zijn, kunnen sommige mensen allergisch zijn voor bepaalde plantaardige ingrediënten. We doen altijd een patch test bij nieuwe klanten.',
        ],
        [
            'question' => 'Hoe lang gaat een plantaardige kleuring mee?',
            'answer' => 'Plantaardige kleuringen houden gemiddeld 4-6 weken, vergelijkbaar met chemische alternatieven. Het grote verschil is dat je haar gezonder blijft.',
        ],
        [
            'question' => 'Zijn jullie een duurzame salon?',
            'answer' => 'Absoluut! We zijn CO2-neutraal, gebruiken alleen hernieuwbare energie, recyclen al ons afval en werken met refillable productverpakkingen.',
        ],
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
@endphp

<section id="accordion" class="py-24 lg:py-32" style="background-color: {{ $primaryColor }}08;">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6"
                style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                FAQ
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Accordion items --}}
        <div class="space-y-4" x-data="{ openItem: null }">
            @foreach($items as $index => $item)
                <div
                    class="bg-white rounded-2xl transition-all duration-300 overflow-hidden"
                    style="box-shadow: 0 4px 20px {{ $primaryColor }}08;"
                >
                    <button
                        @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                        class="w-full px-6 py-5 flex items-center justify-between text-left"
                    >
                        <span class="font-medium pr-8" style="color: {{ $headingColor }};">
                            {{ $item['question'] }}
                        </span>
                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-all duration-300"
                            :class="{ 'rotate-180': openItem === {{ $index }} }"
                            style="background-color: {{ $primaryColor }}15;"
                        >
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="openItem === {{ $index }}"
                        x-collapse
                    >
                        <div class="px-6 pb-5">
                            <div class="pt-3 border-t" style="border-color: {{ $primaryColor }}15;">
                                <p class="leading-relaxed" style="color: {{ $textColor }};">
                                    {{ $item['answer'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Contact prompt --}}
        <div class="mt-12 text-center">
            <p class="text-sm mb-4" style="color: {{ $textColor }};">
                Heb je een andere vraag?
            </p>
            <a
                href="#contact"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-medium transition-all duration-300"
                style="background-color: {{ $primaryColor }}; color: white;"
            >
                Neem contact op
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
