{{--
    Blush Template: Accordion / FAQ Section
    Elegant nail studio — clean accordion with gold accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? 'FAQ';
    $items = $content['items'] ?? [
        ['question' => __('Do I need to book in advance?'), 'answer' => __('We recommend booking in advance to secure your preferred time slot. Walk-ins are welcome based on availability.')],
        ['question' => __('How long does a gel manicure last?'), 'answer' => __('A gel manicure typically lasts 2-3 weeks without chipping. We recommend a refill or new application after that period.')],
        ['question' => __('What payment methods do you accept?'), 'answer' => __('We accept debit card, cash and most credit cards. Contactless payment is also possible.')],
        ['question' => __('Can I cancel my appointment?'), 'answer' => __('Yes, we ask that you cancel at least 24 hours in advance so we can offer the time to other clients.')],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';
@endphp

<section id="accordion" class="py-20 lg:py-32" style="background-color: {{ $backgroundColor }}; font-family: {{ $bodyFont }};">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                </svg>
                <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <span class="text-xs font-medium uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light"
                style="color: {{ $headingColor }}; font-family: {{ $headingFont }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $headingColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Accordion Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: 0 }">
                @foreach($items as $index => $item)
                    <div
                        class="overflow-hidden transition-all duration-300"
                        style="border: 1px solid {{ $primaryColor }}20; background-color: #ffffff;"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(12px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.08 }}s;"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-5 text-left flex items-center justify-between gap-4"
                        >
                            <span class="font-medium text-base" style="color: {{ $headingColor }};">
                                {{ $item['question'] ?? $item['title'] ?? '' }}
                            </span>
                            <span
                                class="shrink-0 w-8 h-8 flex items-center justify-center transition-all duration-300"
                                :style="openItem === {{ $index }} ? 'background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}' : 'background-color: {{ $primaryColor }}10; color: {{ $primaryColor }}'"
                            >
                                <svg
                                    class="w-4 h-4 transition-transform duration-300"
                                    :class="{ 'rotate-180': openItem === {{ $index }} }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            x-cloak
                        >
                            <div class="px-6 pb-6">
                                <div class="w-12 h-px mb-4" style="background-color: {{ $primaryColor }}30;"></div>
                                <p class="leading-relaxed text-sm" style="color: {{ $textColor }};">
                                    {{ $item['answer'] ?? $item['content'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: {{ $textColor }};">
                {{ __('No questions defined.') }}
            </p>
        @endif

        {{-- Bottom decorative line --}}
        <div class="flex items-center justify-center mt-20">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}40, transparent);"></div>
        </div>
    </div>
</section>
