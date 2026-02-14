{{--
    Template-specifieke services voor Razor (Barbershop)

    Diensten met prijzen in grid layout
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Van klassiek tot modern - wij beheersen elke stijl';
    $items = $content['items'] ?? [
        ['title' => 'Heren Knippen', 'description' => 'Precisie knippen met schaar of tondeuse', 'price' => '€27', 'icon' => 'scissors'],
        ['title' => 'Baard Verzorging', 'description' => 'Trimmen, vormen en verzorgen', 'price' => '€22', 'icon' => 'razor'],
        ['title' => 'Hot Towel Shave', 'description' => 'Luxueuze scheerbeurt met warme doeken', 'price' => '€32', 'icon' => 'towel'],
        ['title' => 'Knippen & Baard', 'description' => 'Complete verzorging in één behandeling', 'price' => '€45', 'icon' => 'star'],
        ['title' => 'Grijs Camouflage', 'description' => 'Subtiele kleurbehandeling voor grijs haar', 'price' => '€35', 'icon' => 'color'],
        ['title' => 'Kids Knippen', 'description' => 'Voor onze jongste gentlemen (t/m 12 jaar)', 'price' => '€19', 'icon' => 'child'],
    ];

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';

    // Icon mapping - synced with IconSets::kappersIcons()
    $icons = [
        // Kappers icons (from IconSets)
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'comb' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 6v14h16V6M8 6V4m4 2V4m4 2V4M8 10v6m4-6v6m4-6v6"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'child' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                Wat wij bieden
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4h16v3H4zM7 7v10a3 3 0 003 3h4a3 3 0 003-3V7"/>
                </svg>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <p class="text-lg max-w-2xl mx-auto opacity-70" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $item)
                <div
                    class="group relative p-8 transition-all duration-300 hover:-translate-y-1"
                    style="background-color: {{ $secondaryColor }};"
                >
                    {{-- Hover accent line --}}
                    <div
                        class="absolute top-0 left-0 w-0 h-1 transition-all duration-500 group-hover:w-full"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    {{-- Icon --}}
                    <div
                        class="w-14 h-14 mb-6 flex items-center justify-center"
                        style="background-color: {{ $primaryColor }}15;"
                    >
                        <svg
                            class="w-7 h-7"
                            style="color: {{ $primaryColor }};"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Content --}}
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $lightTextColor }};">
                        {{ $item['title'] }}
                    </h3>
                    <p class="text-sm mb-6" style="color: {{ $lightTextColor }}; opacity: 0.7;">
                        {{ $item['description'] }}
                    </p>

                    {{-- Price --}}
                    <div class="flex items-center justify-between pt-6 border-t" style="border-color: {{ $primaryColor }}20;">
                        <span class="text-xs font-bold uppercase tracking-wider" style="color: {{ $lightTextColor }}; opacity: 0.5;">Vanaf</span>
                        <span
                            class="text-2xl font-bold"
                            style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                        >
                            {{ $item['price'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-14">
            <p class="text-sm opacity-60 mb-6" style="color: {{ $textColor }};">
                Alle prijzen zijn inclusief BTW. Vraag naar onze combideals.
            </p>
            <a
                href="#pricing"
                class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest transition-colors hover:opacity-80"
                style="color: {{ $primaryColor }};"
            >
                Bekijk volledige prijslijst
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
