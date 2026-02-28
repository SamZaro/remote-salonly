{{--
    Spa Template: Accordion/FAQ Section
    Serene spa & wellness — clean accordion with elegant toggle indicators
    Fonts: Playfair Display (headings) + Lato (body)
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
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden om teleurstelling te voorkomen. Je kunt online of telefonisch een afspraak maken. Walk-ins zijn welkom, maar we kunnen beschikbaarheid niet garanderen.'],
        ['question' => 'Hoe lang duurt een behandeling?', 'answer' => 'Dit varieert per behandeling. Een massage duurt 45-90 minuten, een gezichtsbehandeling 60-90 minuten, en een manicure 45 minuten. We raden aan om 10 minuten voor uw afspraak aanwezig te zijn.'],
        ['question' => 'Gebruiken jullie natuurlijke producten?', 'answer' => 'Ja, we werken uitsluitend met hoogwaardige, natuurlijke en dierproefvrije producten. Onze merken zijn zorgvuldig geselecteerd voor hun effectiviteit en duurzaamheid.'],
        ['question' => 'Kan ik cadeaubonnen kopen?', 'answer' => 'Absoluut! Onze cadeaubonnen zijn het perfecte cadeau en zijn verkrijgbaar in elke gewenste waarde. U kunt ze zowel online als in de salon aanschaffen.'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: 'Lato', sans-serif;">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                {{ $title }}
            </h2>
            <div class="w-16 h-px mx-auto" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-3" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="overflow-hidden rounded-lg transition-shadow duration-300"
                        :class="openItem === {{ $index }} ? 'shadow-sm' : ''"
                        style="background-color: #ffffff;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-7 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="text-lg font-semibold" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <div
                                class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 transition-all duration-300"
                                :style="openItem === {{ $index }}
                                    ? 'background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};'
                                    : 'background-color: {{ $accentColor }}; color: {{ $secondaryColor }};'"
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
                            </div>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-7 pb-6">
                                <div class="w-12 h-px mb-4" style="background-color: {{ $primaryColor }};"></div>
                                <p class="text-lg leading-relaxed" style="color: {{ $textColor }}; font-family: 'Lato', sans-serif;">
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
