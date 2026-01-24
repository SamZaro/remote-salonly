{{--
    Template-specifieke accordion voor Barbero (Barbershop)

    Vintage barbershop stijl met goud/donker thema
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
        ['question' => 'Hoe lang duurt een knipbeurt?', 'answer' => 'Een standaard knipbeurt duurt ongeveer 30-45 minuten. Voor een complete behandeling met scheren moet je rekenen op 60-75 minuten.'],
        ['question' => 'Welke betaalmethodes accepteren jullie?', 'answer' => 'We accepteren pin, contant en de meeste creditcards. Contactloos betalen is ook mogelijk.'],
        ['question' => 'Bieden jullie ook baardverzorging aan?', 'answer' => 'Jazeker! We zijn gespecialiseerd in baardtrimmen, scheren met een klassiek mes en complete baardverzorging.'],
    ];

    // Theme kleuren - vintage barbershop
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = '#ffffff';
    $backgroundColor = $theme['accordion_background'] ?? '#0f0f0f';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-xs font-bold uppercase tracking-[0.3em] mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold uppercase tracking-wider"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="border transition-all duration-300"
                        :style="openItem === {{ $index }} ? 'border-color: {{ $primaryColor }}' : 'border-color: {{ $primaryColor }}40'"
                        style="background-color: {{ $secondaryColor }};"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="font-bold text-lg uppercase tracking-wider" style="color: {{ $textColor }};">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="flex-shrink-0 w-10 h-10 border-2 flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; border-color: {{ $primaryColor }}; color: {{ $secondaryColor }}' : 'background-color: transparent; border-color: {{ $primaryColor }}; color: {{ $primaryColor }}'"
                            >
                                <svg
                                    class="w-5 h-5 transition-transform duration-300"
                                    :class="{ 'rotate-45': openItem === {{ $index }} }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-6 pb-6 border-t" style="border-color: {{ $primaryColor }}40;">
                                <p class="pt-4 leading-relaxed text-gray-300">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bottom decorative --}}
        <div class="flex items-center justify-center gap-4 mt-12">
            <div class="h-px w-24" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}40);"></div>
            <div class="w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }};"></div>
            <div class="h-px w-24" style="background: linear-gradient(to left, transparent, {{ $primaryColor }}40);"></div>
        </div>
    </div>
</section>
