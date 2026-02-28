{{--
    Spa Template: Services Section
    Serene spa & wellness — elegant service cards with image overlay and hover effects
    Fonts: Playfair Display (headings) + Lato (body)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'The Art Of Natural Beauty';
    $subtitle = $content['subtitle'] ?? 'Onze behandelingen';
    $items = $content['items'] ?? [
        ['title' => 'Massage Therapy', 'description' => 'Ontspannende en therapeutische massages voor lichaam en geest', 'price' => 'Vanaf €60', 'icon' => 'scissors'],
        ['title' => 'Skin Care', 'description' => 'Gezichtsbehandelingen en huidverzorging op maat', 'price' => 'Vanaf €85', 'icon' => 'color'],
        ['title' => 'Body Treatments', 'description' => 'Luxe lichaamsbehandelingen voor totale ontspanning', 'price' => 'Vanaf €75', 'icon' => 'curls'],
        ['title' => 'Manicure & Pedicure', 'description' => 'Verzorging voor mooie handen en voeten', 'price' => 'Vanaf €35', 'icon' => 'nails'],
        ['title' => 'Aromatherapy', 'description' => 'Holistische behandelingen met essentiële oliën', 'price' => 'Vanaf €70', 'icon' => 'polish'],
        ['title' => 'Lash & Brow', 'description' => 'Wimperextensions, lifting & brow design', 'price' => 'Vanaf €40', 'icon' => 'lash'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';

    $icons = [
        'scissors' => '<circle cx="8" cy="18" r="3" stroke-width="1.5"/><circle cx="16" cy="14" r="4" stroke-width="1.5"/><circle cx="12" cy="8" r="5" stroke-width="1.5"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'curls' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
        'nails' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>',
        'polish' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
        'lash' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span
                class="absolute top-[-20px] left-1/2 -translate-x-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.05; color: {{ $secondaryColor }}; font-family: 'Playfair Display', serif;"
            >Our Services</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: 'Lato', sans-serif;">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; font-family: 'Lato', sans-serif;">
                Aliquam a augue suscipit, luctus neque purus ipsum neque undo dolor primis libero tempus
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $index => $item)
                <div
                    class="text-center p-8 rounded-lg transition-all duration-300 hover:shadow-md group"
                    style="background-color: #ffffff;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $index * 0.08 }}s;'"
                >
                    {{-- Icon --}}
                    <div
                        class="w-20 h-20 rounded-full mx-auto mb-6 flex items-center justify-center transition-all duration-300"
                        style="background-color: {{ $primaryColor }};"
                    >
                        <svg class="w-10 h-10" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $headingColor }}; font-family: 'Playfair Display', serif;">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="mb-5 leading-relaxed" style="color: {{ $textColor }}; font-family: 'Lato', sans-serif;">
                        {{ $item['description'] }}
                    </p>

                    {{-- Price --}}
                    <span class="text-sm font-bold block mb-5" style="color: {{ $secondaryColor }}; font-family: 'Lato', sans-serif;">
                        {{ $item['price'] }}
                    </span>

                    {{-- CTA --}}
                    <a
                        href="#contact"
                        class="inline-flex items-center justify-center px-6 py-2.5 text-xs font-semibold tracking-widest uppercase transition-all duration-300 rounded"
                        style="border: 1.5px solid {{ $secondaryColor }}; color: {{ $secondaryColor }}; font-family: 'Lato', sans-serif;"
                        onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.borderColor='{{ $primaryColor }}';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='{{ $secondaryColor }}';"
                    >
                        Boeken
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div
            class="text-center mt-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s ease-out 0.2s;"
        >
            <a
                href="#pricing"
                class="inline-flex items-center text-sm font-semibold tracking-widest uppercase transition-opacity hover:opacity-70"
                style="color: {{ $secondaryColor }}; font-family: 'Lato', sans-serif;"
            >
                Bekijk volledige prijslijst
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
