{{--
    Template-specifieke accordion/FAQ voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? __('Frequently Asked Questions');
    $subtitle = $content['subtitle'] ?? __('Everything you want to know');
    $items = $content['items'] ?? [
        [
            'question' => __('How do I book an appointment?'),
            'answer' => __('You can easily book online via our website, call us, or send a message via WhatsApp. We always respond within 24 hours.'),
        ],
        [
            'question' => __('What can I expect on my first visit?'),
            'answer' => __('On your first visit we take plenty of time for a personal consultation. We discuss your wishes, analyze your hair and advise on the best treatment.'),
        ],
        [
            'question' => __('Do you offer bridal packages?'),
            'answer' => __('Yes, we have special bridal packages including a trial style, wedding day styling and optional make-up. Contact us for a personal consultation.'),
        ],
        [
            'question' => __('Which products do you use?'),
            'answer' => __('We work exclusively with premium, sulfate-free products from renowned brands that are gentle on hair and scalp.'),
        ],
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';

    $headingFont = $theme['heading_font_family'] ?? 'Cormorant';
    $bodyFont = $theme['font_family'] ?? 'Source Sans 3';
@endphp

<section id="accordion" class="py-24 lg:py-32" style="background-color: {{ $accentColor }}40;">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">FAQ</span>
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Accordion items --}}
        <div class="space-y-4" x-data="{ openItem: null }"
            x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
        >
            @foreach($items as $index => $item)
                <div
                    class="bg-white transition-all duration-300"
                    style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;"
                >
                    <button
                        @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                        class="w-full px-8 py-6 flex items-center justify-between text-left transition-colors"
                    >
                        <span class="text-base font-medium pr-8" style="color: {{ $secondaryColor }};">
                            {{ $item['question'] }}
                        </span>
                        <span
                            class="flex-shrink-0 w-8 h-8 flex items-center justify-center transition-transform duration-300"
                            :class="{ 'rotate-45': openItem === {{ $index }} }"
                            style="background-color: {{ $accentColor }};"
                        >
                            <svg class="w-4 h-4" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                            </svg>
                        </span>
                    </button>
                    <div
                        x-show="openItem === {{ $index }}"
                        x-collapse
                        class="overflow-hidden"
                    >
                        <div class="px-8 pb-6">
                            <div class="pt-4 border-t" style="border-color: {{ $primaryColor }}60;">
                                <p class="text-base leading-relaxed font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                                    {{ $item['answer'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Contact prompt --}}
        <div class="mt-12 text-center"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <p class="text-sm mb-4" style="color: {{ $textColor }}; opacity: 0.7;">
                {{ __('Have another question?') }}
            </p>
            <a
                href="#contact"
                class="inline-flex items-center gap-3 text-sm font-medium uppercase tracking-widest transition-all duration-300 group"
                style="color: {{ $secondaryColor }};"
            >
                <span class="border-b" style="border-color: {{ $secondaryColor }};">{{ __('Contact us') }}</span>
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
