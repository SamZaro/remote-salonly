{{--
    Template-specifieke accordion voor Icon (Hair Salon)

    Modern en fris met lichtblauw/mint thema
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'Heb je een vraag?';
    $items = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Je kunt online reserveren via onze website of bellen voor een afspraak. Walk-ins zijn welkom maar een reservering garandeert je plek.'],
        ['question' => 'Wat als ik te laat ben?', 'answer' => 'We begrijpen dat het soms druk kan zijn. Bij meer dan 15 minuten vertraging kan het zijn dat we je afspraak moeten inkorten.'],
        ['question' => 'Bieden jullie ook styling advies?', 'answer' => 'Absoluut! Onze stylisten geven graag persoonlijk advies over welke stijl het beste bij jou past.'],
        ['question' => 'Hebben jullie producten te koop?', 'answer' => 'Ja, we verkopen professionele haarproducten zodat je thuis je look kunt onderhouden.'],
    ];

    // Theme kleuren - fresh modern salon
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $sectionBg = $theme['accordion_background'] ?? '#f8fafc';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $sectionBg }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-2xl overflow-hidden transition-all duration-300"
                        :style="openItem === {{ $index }} ? 'box-shadow: 0 10px 40px rgba(14,165,233,0.15)' : 'box-shadow: 0 2px 10px rgba(0,0,0,0.05)'"
                        style="background-color: {{ $backgroundColor }};"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <div class="flex items-center gap-4">
                                <span
                                    class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold transition-all duration-300"
                                    :style="openItem === {{ $index }} ? 'background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); color: white' : 'background: {{ $primaryColor }}15; color: {{ $primaryColor }}'"
                                >
                                    {{ $index + 1 }}
                                </span>
                                <span class="font-semibold text-lg" style="color: {{ $textColor }};">
                                    {{ $item['question'] ?? $item['title'] ?? '' }}
                                </span>
                            </div>
                            <svg
                                class="w-5 h-5 transition-transform duration-300 flex-shrink-0"
                                :class="{ 'rotate-180': openItem === {{ $index }} }"
                                :style="openItem === {{ $index }} ? 'color: {{ $primaryColor }}' : 'color: #9ca3af'"
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
                            <div class="px-6 pb-6 pl-[4.5rem]">
                                <p class="leading-relaxed text-gray-600">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- CTA --}}
        <div class="mt-12 text-center">
            <p class="text-gray-500 mb-4">Staat je vraag er niet tussen?</p>
            <a
                href="#contact"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-white font-medium transition-all duration-300 hover:scale-105"
                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
            >
                Neem contact op
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
