{{--
    Pure Template: Services Section
    Natural & Botanical — service cards with hover line, icon shift + bg transition
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Wat wij bieden';
    $items = $content['items'] ?? [
        ['title' => 'Organic Cut', 'description' => 'Knippen met biologische styling producten', 'price' => 'Vanaf €55', 'icon' => 'scissors'],
        ['title' => 'Plant-Based Color', 'description' => 'Kleuring met 100% plantaardige verven', 'price' => 'Vanaf €85', 'icon' => 'color'],
        ['title' => 'Scalp Wellness', 'description' => 'Hoofdhuidbehandeling met essentiële oliën', 'price' => 'Vanaf €45', 'icon' => 'spa'],
        ['title' => 'Herbal Treatment', 'description' => 'Intensieve kruidenbehandeling voor haar', 'price' => 'Vanaf €65', 'icon' => 'leaf'],
        ['title' => 'Mindful Styling', 'description' => 'Ontspannen föhnen en stylen', 'price' => 'Vanaf €40', 'icon' => 'heart'],
        ['title' => 'Detox Ritual', 'description' => 'Zuiverende haardetox behandeling', 'price' => 'Vanaf €55', 'icon' => 'sparkle'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';

    $icons = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'spa' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'leaf' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'sparkle' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>',
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >Our Services</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                Natuurlijke verzorging voor lichaam en geest
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-px sm:grid-cols-2 lg:grid-cols-3" style="background-color: {{ $primaryColor }}10;">
            @foreach($items as $index => $item)
                <div
                    class="group relative p-8 lg:p-10 flex flex-col transition-colors duration-300"
                    style="background-color: #ffffff;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s, background-color 0.3s ease;'"
                    onmouseover="this.style.backgroundColor='{{ $primaryColor }}06'"
                    onmouseout="this.style.backgroundColor='#ffffff'"
                >
                    {{-- Icon with hover scale --}}
                    <div
                        class="w-16 h-16 rounded-sm mb-6 flex items-center justify-center transition-all duration-400 group-hover:scale-110"
                        style="background-color: {{ $primaryColor }}10;"
                    >
                        <svg class="w-8 h-8 transition-transform duration-300 group-hover:rotate-3" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3 transition-colors duration-300" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="mb-5 leading-relaxed text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        {{ $item['description'] }}
                    </p>

                    {{-- Price --}}
                    <span class="text-sm font-bold block mb-6 mt-auto" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        {{ $item['price'] }}
                    </span>

                    {{-- CTA with arrow slide --}}
                    <a
                        href="#contact"
                        class="inline-flex items-center justify-center px-6 py-2.5 text-xs font-semibold tracking-widest uppercase transition-all duration-300 rounded-none overflow-hidden relative"
                        style="border: 1.5px solid {{ $primaryColor }}; color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                        onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $primaryColor }}';"
                    >
                        <span>Boeken</span>
                        <svg class="w-3.5 h-3.5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>

                    {{-- Bottom accent line on hover --}}
                    <div
                        class="absolute bottom-0 left-0 w-0 h-0.5 group-hover:w-full transition-all duration-500 ease-out"
                        style="background-color: {{ $primaryColor }};"
                    ></div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div
            class="text-center mt-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
        >
            <a
                href="#pricing"
                class="group/link inline-flex items-center text-sm font-semibold tracking-widest uppercase transition-opacity hover:opacity-70"
                style="color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
            >
                Bekijk volledige prijslijst
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
