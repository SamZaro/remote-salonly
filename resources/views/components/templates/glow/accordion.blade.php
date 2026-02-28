{{--
    Glow Template: Accordion/FAQ Section
    Warm minimalist — clean accordion, no gradient toggles or decorative dividers
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
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden om teleurstelling te voorkomen. Je kunt online of telefonisch een afspraak maken.'],
        ['question' => 'Hoe lang duurt een behandeling?', 'answer' => 'Dit varieert per behandeling. Een gezichtsbehandeling duurt ongeveer 60-90 minuten, een manicure 45 minuten.'],
        ['question' => 'Gebruiken jullie natuurlijke producten?', 'answer' => 'Ja, we werken uitsluitend met hoogwaardige, natuurlijke en dierproefvrije producten voor het beste resultaat.'],
        ['question' => 'Kan ik cadeaubonnen kopen?', 'answer' => 'Absoluut! Onze cadeaubonnen zijn het perfecte cadeau en zijn verkrijgbaar in elke gewenste waarde.'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div
            class="text-center mb-12"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block" style="color: {{ $secondaryColor }};">
                {{ $subtitle }}
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;">
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-3" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="overflow-hidden"
                        style="background-color: white; border-radius: 10px;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="text-lg font-semibold" style="color: {{ $headingColor }};">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <svg
                                class="w-5 h-5 shrink-0 transition-transform duration-300"
                                :class="{ 'rotate-180': openItem === {{ $index }} }"
                                style="color: {{ $secondaryColor }};"
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
                            <div class="px-6 pb-5">
                                <p class="text-lg leading-relaxed" style="color: {{ $textColor }};">
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
