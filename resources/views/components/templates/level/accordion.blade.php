{{--
    Level Template: Accordion/FAQ Section
    LIGHT section (vs urban's dark) — thin line separators, orange accent open state
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title    = $content['title'] ?? 'Veelgestelde Vragen';
    $subtitle = $content['subtitle'] ?? 'Alles wat je wilt weten';
    $items    = $content['items'] ?? [
        ['question' => 'Moet ik vooraf reserveren?',            'answer' => 'Reserveren is aanbevolen, maar walk-ins zijn altijd welkom — zolang er plek is. Via onze website of telefoon maak je eenvoudig een afspraak.'],
        ['question' => 'Hoe lang duurt een knipbeurt?',         'answer' => 'Een standaard knipbeurt duurt 45-60 minuten inclusief wassen en föhnen. Kleurbehandelingen nemen meer tijd in beslag; hier informeren we je vooraf over.'],
        ['question' => 'Bieden jullie ook kleurbehandelingen?', 'answer' => 'Absoluut! Van highlights tot volledige kleurbehandelingen — we geven je eerlijk advies over wat het beste bij jou past.'],
        ['question' => 'Wat zijn de betaalmogelijkheden?',      'answer' => 'We accepteren contant, pin en alle gangbare creditcards. Contactloos betalen is ook mogelijk.'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#111111';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">FAQ</span>
            </div>
            <h2
                class="font-black leading-[0.9]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.03em; color: #ffffff;"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-base font-light" style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        {{-- FAQ items --}}
        @if(count($items) > 0)
            <div x-data="{ openItem: 0 }" class="border-t" style="border-color: rgba(255,255,255,0.1);">
                @foreach($items as $index => $item)
                    <div
                        class="border-b"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                        style="border-color: rgba(255,255,255,0.1); opacity: 0; transform: translateX(-12px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.08 }}s;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full py-6 flex items-center justify-between gap-6 text-left"
                        >
                            {{-- Question --}}
                            <span
                                class="font-semibold text-base transition-colors duration-200"
                                style="font-family: '{{ $bodyFont }}';"
                                :style="openItem === {{ $index }} ? 'color: {{ $primaryColor }}' : 'color: #ffffff'"
                            >
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>

                            {{-- Toggle --}}
                            <span
                                class="shrink-0 w-10 h-10 flex items-center justify-center border transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; border-color: {{ $primaryColor }}; color: #ffffff' : 'background-color: transparent; border-color: rgba(255,255,255,0.2); color: rgba(255,255,255,0.7)'"
                            >
                                <svg
                                    class="w-4 h-4 transition-transform duration-300"
                                    :class="{ 'rotate-180': openItem === {{ $index }} }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>

                        <div x-show="openItem === {{ $index }}" x-collapse x-cloak>
                            <div class="pb-7 pr-16">
                                <p class="text-base leading-relaxed font-light" style="color: rgba(255,255,255,0.6); font-family: '{{ $bodyFont }}';">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- CTA --}}
        <div class="mt-14 flex flex-wrap items-center gap-5">
            <span class="text-xs uppercase tracking-widest font-light" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">Nog vragen?</span>
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 font-semibold uppercase tracking-widest text-sm transition-colors"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                Neem Contact Op
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
