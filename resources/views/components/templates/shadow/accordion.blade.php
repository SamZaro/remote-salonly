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
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? __('Everything you want to know');
    $items = $content['items'] ?? [
        ['question' => __('Do I need to book in advance?'), 'answer' => __('Booking is recommended but not required. On busy days like Friday and Saturday we strongly advise making an appointment in advance to secure your spot.')],
        ['question' => __('What are your opening hours?'), 'answer' => __('We are open Tuesday through Saturday. Tuesday to Friday from 09:00 to 18:00 and Saturday from 09:00 to 17:00. We are closed on Monday and Sunday.')],
        ['question' => __('Which payment methods do you accept?'), 'answer' => __('We accept card, cash and most credit cards. Contactless payment via Apple Pay and Google Pay is also available.')],
        ['question' => __('Can I cancel my appointment?'), 'answer' => __('Yes, we ask you to cancel at least 24 hours in advance. This allows us to offer the slot to other clients. You can cancel by phone or via our website.')],
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
                {{ __("Don't see your question?") }}
            </p>
            <a
                href="#contact"
                class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold uppercase tracking-wider rounded-sm transition-all duration-300 hover:opacity-90"
                style="background-color: {{ $primaryColor }}; color: #ffffff;"
            >
                {{ __('Contact us') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
