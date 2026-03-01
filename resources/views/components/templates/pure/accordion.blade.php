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
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'We helpen je graag';
    $items = $content['items'] ?? [
        ['question' => 'Zijn jullie producten echt 100% natuurlijk?', 'answer' => 'Ja! Wij werken uitsluitend met gecertificeerde biologische en plantaardige producten. Geen parabenen, sulfaten of synthetische geurstoffen.'],
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden om teleurstelling te voorkomen. Je kunt online of telefonisch een afspraak maken. Walk-ins zijn welkom, maar we kunnen beschikbaarheid niet garanderen.'],
        ['question' => 'Hoe lang gaat een plantaardige kleuring mee?', 'answer' => 'Plantaardige kleuringen houden gemiddeld 4-6 weken, vergelijkbaar met chemische alternatieven. Het grote verschil is dat je haar gezonder blijft.'],
        ['question' => 'Kan ik cadeaubonnen kopen?', 'answer' => 'Absoluut! Onze cadeaubonnen zijn het perfecte cadeau en zijn verkrijgbaar in elke gewenste waarde. U kunt ze zowel online als in de salon aanschaffen.'],
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
    {{-- Botanical leaf decoration --}}
    <div class="absolute bottom-12 right-10 opacity-[0.04]">
        <svg class="w-32 h-32" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
            <path d="M50 35 L30 25" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
            <path d="M50 50 L70 38" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
        </svg>
    </div>

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
