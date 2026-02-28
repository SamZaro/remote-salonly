{{--
    Urban Template: Accordion/FAQ Section
    Dark section — numbered questions, gold toggle, x-collapse animation
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
        ['question' => 'Moet ik vooraf reserveren?',       'answer' => 'Reserveren wordt aanbevolen, maar walk-ins zijn altijd welkom. Met een reservering ben je verzekerd van je plek.'],
        ['question' => 'Hoe lang duurt een behandeling?',  'answer' => 'Een standaard knipbeurt duurt 30-45 minuten. Een hot towel shave neemt ongeveer 45 minuten in beslag.'],
        ['question' => 'Bieden jullie ook baardverzorging?', 'answer' => 'Jazeker. Van trimmen tot een volledige hot towel shave — we verzorgen je baard met precisie.'],
        ['question' => 'Wat zijn de betaalmogelijkheden?', 'answer' => 'We accepteren contant, pin en alle gangbare creditcards. Contactloos betalen is ook mogelijk.'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">FAQ</span>
            </div>
            <h2
                class="font-black uppercase leading-[0.9]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: #ffffff;"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-lg" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        {{-- FAQ items --}}
        @if(count($items) > 0)
            <div x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="border-b"
                        style="border-color: rgba(255,255,255,0.08);"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                        style="opacity: 0; transform: translateX(-15px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full py-7 flex items-center justify-between gap-6 text-left"
                        >
                            {{-- Number + question --}}
                            <div class="flex items-center gap-6 min-w-0">
                                <span
                                    class="font-black shrink-0 leading-none transition-colors duration-300"
                                    style="font-family: '{{ $headingFont }}'; font-size: 1.5rem; letter-spacing: -0.03em;"
                                    :style="openItem === {{ $index }} ? 'color: {{ $primaryColor }}' : 'color: rgba(255,255,255,0.15)'"
                                >
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span
                                    class="font-bold text-xl uppercase tracking-wide truncate"
                                    style="color: #ffffff; font-family: '{{ $headingFont }}';"
                                >
                                    {{ $item['question'] ?? $item['title'] ?? '' }}
                                </span>
                            </div>

                            {{-- Toggle --}}
                            <span
                                class="shrink-0 w-12 h-12 flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}' : 'background-color: transparent; border: 1px solid rgba(255,255,255,0.2); color: #ffffff'"
                            >
                                <svg
                                    class="w-5 h-5 transition-transform duration-300"
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
                            <div class="pb-8 pl-[4.5rem]">
                                <p class="text-lg leading-relaxed" style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}';">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- CTA --}}
        <div class="mt-14 flex flex-wrap items-center gap-6">
            <span class="text-xs uppercase tracking-widest" style="color: rgba(255,255,255,0.3); font-family: '{{ $bodyFont }}';">Nog vragen?</span>
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 font-bold uppercase tracking-widest text-sm"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                Neem Contact Op
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
