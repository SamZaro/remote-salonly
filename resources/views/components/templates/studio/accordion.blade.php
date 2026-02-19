{{--
    Template-specifieke accordion/FAQ voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Got Questions?';
    $subtitle = $content['subtitle'] ?? 'We got answers!';
    $items = $content['items'] ?? [
        [
            'question' => 'Moet ik van tevoren boeken?',
            'answer' => 'Walk-ins zijn welkom, maar we raden aan om te boeken voor de beste ervaring. Zo ben je zeker van jouw favoriete stylist en tijdslot!',
        ],
        [
            'question' => 'Hoe lang duurt een balayage behandeling?',
            'answer' => 'Een balayage duurt gemiddeld 2-3 uur, afhankelijk van de lengte en dikte van je haar. Neem een drankje, relax en geniet!',
        ],
        [
            'question' => 'Kan ik ook komen voor alleen styling?',
            'answer' => 'Absoluut! Of het nu voor een feestje, bruiloft of gewoon een night out is - we stylen je graag. Check onze styling services!',
        ],
        [
            'question' => 'Werken jullie met bepaalde merken?',
            'answer' => 'We werken met premium merken zoals Olaplex, Kevin Murphy en L\'Oréal Professionnel. Allemaal salon-quality products!',
        ],
    ];

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
@endphp

<section id="accordion" class="py-24 lg:py-32 relative overflow-hidden" style="background: {{ $accentColor }}50;">


    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6 transform rotate-1"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                FAQ
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-4"
                style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-2xl font-bold" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Accordion items --}}
        <div class="space-y-4" x-data="{ openItem: null }">
            @foreach($items as $index => $item)
                <div
                    class="rounded-3xl overflow-hidden transition-all duration-300 transform hover:scale-[1.02]"
                    style="background: white; box-shadow: 6px 6px 0 {{ $index % 2 === 0 ? $primaryColor : $secondaryColor }};"
                    :class="{ 'rotate-0': openItem === {{ $index }}, '{{ $index % 2 === 0 ? '-rotate-1' : 'rotate-1' }}': openItem !== {{ $index }} }"
                >
                    <button
                        @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                        class="w-full px-6 py-5 flex items-center justify-between text-left"
                    >
                        <span class="font-bold text-lg pr-8" style="color: {{ $headingColor }};">
                            {{ $item['question'] }}
                        </span>
                        <span
                            class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300"
                            :class="{ 'rotate-45': openItem === {{ $index }} }"
                            style="background: {{ $primaryColor }};"
                        >
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="openItem === {{ $index }}"
                        x-collapse
                    >
                        <div class="px-6 pb-6">
                            <div class="pt-4 border-t-2 border-dashed" style="border-color: {{ $accentColor }};">
                                <p class="text-lg leading-relaxed" style="color: {{ $textColor }};">
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
            <p class="mb-4" style="color: {{ $textColor }};">
                Nog meer vragen?
            </p>
            <a
                href="#contact"
                class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-bold transition-all hover:scale-105"
                style="background: {{ $secondaryColor }}; color: white; box-shadow: 4px 4px 0 {{ $primaryColor }};"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Stuur ons een bericht
            </a>
        </div>
    </div>
</section>
