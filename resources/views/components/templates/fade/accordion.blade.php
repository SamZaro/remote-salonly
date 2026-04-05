{{--
    Fade Template: Accordion/FAQ Section
    Warm cream section — gold accent open state, clean separators
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title    = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? __('FAQ');
    $items    = $content['items'] ?? [
        ['question' => __('Do I need to book in advance?'),          'answer' => __('Booking is recommended, but walk-ins are always welcome — as long as there is availability. You can easily make an appointment via our website or phone.')],
        ['question' => __('How long does a haircut take?'),          'answer' => __('A standard haircut takes 30-45 minutes. Beard trims take about 20 minutes. Combination services take more time; we will inform you in advance.')],
        ['question' => __('Do you also offer beard treatments?'),    'answer' => __('Absolutely! From beard trims to hot towel shaves — we offer a full range of grooming services.')],
        ['question' => __('What payment methods do you accept?'),    'answer' => __('We accept cash, debit card and all major credit cards. Contactless payment is also possible.')],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

<section id="accordion" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-4xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">FAQ</span>
            </div>
            <h2
                class="font-bold uppercase leading-[0.85]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.4rem, 4.5vw, 4rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-base font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        {{-- FAQ items --}}
        @if(count($items) > 0)
            <div x-data="{ openItem: 0 }" class="border-t" style="border-color: {{ $primaryColor }}20;">
                @foreach($items as $index => $item)
                    <div
                        class="border-b"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                        style="border-color: {{ $primaryColor }}20; opacity: 0; transform: translateX(-12px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.08 }}s;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full py-6 flex items-center justify-between gap-6 text-left"
                        >
                            <span
                                class="font-semibold text-base transition-colors duration-200"
                                style="font-family: '{{ $bodyFont }}';"
                                :style="openItem === {{ $index }} ? 'color: {{ $primaryColor }}' : 'color: {{ $headingColor }}'"
                            >
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>

                            <span
                                class="shrink-0 w-10 h-10 flex items-center justify-center border transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; border-color: {{ $primaryColor }}; color: {{ $secondaryColor }}' : 'background-color: transparent; border-color: {{ $primaryColor }}40; color: {{ $primaryColor }}'"
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
                                <p class="text-base leading-relaxed font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
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
            <span class="text-xs uppercase tracking-widest font-light" style="color: #aaaaaa; font-family: '{{ $bodyFont }}';">{{ __('Still have questions?') }}</span>
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 font-semibold uppercase tracking-widest text-sm transition-colors"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ __('Contact Us') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
