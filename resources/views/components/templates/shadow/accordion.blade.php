{{--
    Template-specifieke accordion/FAQ voor Shadow (Barbershop)

    Clean en minimaal met scherpe accenten
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'Alles wat je wilt weten';
    $items = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden maar niet verplicht. Op drukke momenten zoals vrijdag en zaterdag raden wij het sterk aan om vooraf een afspraak te maken zodat je zeker bent van je plek.'],
        ['question' => 'Wat zijn de openingstijden?', 'answer' => 'We zijn geopend van dinsdag tot en met zaterdag. Dinsdag tot en met vrijdag van 09:00 tot 18:00 uur en op zaterdag van 09:00 tot 17:00 uur. Op maandag en zondag zijn wij gesloten.'],
        ['question' => 'Welke betaalmethodes accepteren jullie?', 'answer' => 'We accepteren pin, contant en de meeste creditcards. Contactloos betalen via Apple Pay en Google Pay is ook mogelijk.'],
        ['question' => 'Kan ik mijn afspraak annuleren?', 'answer' => 'Ja, we vragen je om minimaal 24 uur van tevoren te annuleren. Zo kunnen we de vrijgekomen plek aanbieden aan andere klanten. Annuleren kan telefonisch of via onze website.'],
    ];

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#171717';
    $secondaryColor = $theme['secondary_color'] ?? '#0a0a0a';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
            >
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                style="color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="bg-gray-100 transition-all duration-300 hover:-translate-y-2"
                        style="border-left: 4px solid {{ $primaryColor }};"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span
                                class="font-bold text-lg"
                                style="color: {{ $headingColor }};"
                            >
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="flex-shrink-0 w-8 h-8 rounded-sm flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; color: #ffffff' : 'background-color: {{ $primaryColor }}20; color: {{ $primaryColor }}'"
                            >
                                <svg
                                    class="w-4 h-4 transition-transform duration-300"
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
                            <div class="px-6 pb-5">
                                <p class="opacity-75 leading-relaxed" style="color: {{ $textColor }};">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bottom CTA --}}
        <div class="mt-14 text-center">
            <p class="text-sm mb-4 opacity-60" style="color: {{ $textColor }};">
                Staat je vraag er niet bij?
            </p>
            <a
                href="#contact"
                class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold uppercase tracking-wider rounded-sm transition-all duration-300 hover:opacity-90"
                style="background-color: {{ $primaryColor }}; color: #ffffff;"
            >
                Neem contact op
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
