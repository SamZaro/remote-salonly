@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'FAQ';
    $items = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?', 'answer' => 'Reserveren is aan te raden maar niet verplicht. Walk-ins zijn welkom, maar met een reservering ben je verzekerd van je plek.'],
        ['question' => 'Wat zijn de openingstijden?', 'answer' => 'We zijn geopend van dinsdag tot en met zaterdag. Kijk op onze contactpagina voor de exacte tijden.'],
        ['question' => 'Welke betaalmethodes accepteren jullie?', 'answer' => 'We accepteren pin, contant en de meeste creditcards. Contactloos betalen is ook mogelijk.'],
        ['question' => 'Kan ik mijn afspraak annuleren?', 'answer' => 'Ja, we vragen je om minimaal 24 uur van tevoren te annuleren zodat we de tijd aan andere klanten kunnen aanbieden.'],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#8b5cf6';
    $secondaryColor = $theme['secondary_color'] ?? '#18181b';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#71717a';
    $headingColor = $theme['heading_color'] ?? '#18181b';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-sm font-medium uppercase tracking-widest mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl font-extrabold"
                style="color: {{ $headingColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-3" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-sm overflow-hidden transition-shadow hover:shadow-md"
                        style="background-color: {{ $secondaryColor }};"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="font-semibold text-lg" style="color: #ffffff;">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="shrink-0 w-8 h-8 rounded-sm flex items-center justify-center transition-colors"
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
            <p class="text-center" style="color: {{ $textColor }};">
                Geen vragen gedefinieerd.
            </p>
        @endif

        {{-- Bottom decorative line --}}
        <div class="flex items-center justify-center mt-16">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
