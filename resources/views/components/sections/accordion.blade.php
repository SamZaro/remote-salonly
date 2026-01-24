{{--
    Default accordion section

    Veelzijdige accordion component voor FAQ, informatie, etc.
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'Alles wat je wilt weten';
    $items = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden maar niet verplicht. Walk-ins zijn welkom, maar met een reservering ben je verzekerd van je plek.'],
        ['question' => 'Wat zijn de openingstijden?', 'answer' => 'We zijn geopend van dinsdag tot en met zaterdag. Kijk op onze contactpagina voor de exacte tijden.'],
        ['question' => 'Welke betaalmethodes accepteren jullie?', 'answer' => 'We accepteren pin, contant en de meeste creditcards. Contactloos betalen is ook mogelijk.'],
        ['question' => 'Kan ik mijn afspraak annuleren?', 'answer' => 'Ja, we vragen je om minimaal 24 uur van tevoren te annuleren zodat we de tijd aan andere klanten kunnen aanbieden.'],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#3b82f6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $headingColor = $theme['heading_color'] ?? '#111827';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $sectionBg = $theme['accordion_background'] ?? '#f9fafb';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $sectionBg }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            @if($subtitle)
                <p class="text-sm font-semibold uppercase tracking-wider mb-3" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </p>
            @endif
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold" style="color: {{ $headingColor }};">
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-xl overflow-hidden shadow-sm transition-shadow hover:shadow-md"
                        style="background-color: {{ $backgroundColor }};"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="font-semibold text-lg" style="color: {{ $headingColor }};">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; color: white' : 'background-color: {{ $primaryColor }}20; color: {{ $primaryColor }}'"
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
                            </span>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
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
            <p class="text-center text-gray-500">
                Geen items gedefinieerd.
            </p>
        @endif
    </div>
</section>
