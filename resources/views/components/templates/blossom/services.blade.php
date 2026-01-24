{{--
    Template-specifieke services voor Blossom (Luxury Beauty Salon)

    Services: haircut, colors, curls, manicure, nails, lash, brow
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Beauty Services';
    $subtitle = $content['subtitle'] ?? 'Ontdek ons complete aanbod van luxe behandelingen';
    $items = $content['items'] ?? [
        [
            'title' => 'Knippen & Stylen',
            'description' => 'Van klassiek tot trendy - jouw perfecte coupe',
            'price' => 'Vanaf €55',
            'icon' => 'scissors',
        ],
        [
            'title' => 'Kleuren & Highlights',
            'description' => 'Balayage, ombre, full colour & meer',
            'price' => 'Vanaf €85',
            'icon' => 'color',
        ],
        [
            'title' => 'Krullen & Styling',
            'description' => 'Permanenten, krulbehandelingen & blowouts',
            'price' => 'Vanaf €75',
            'icon' => 'curls',
        ],
        [
            'title' => 'Manicure & Pedicure',
            'description' => 'Verzorging voor prachtige handen en voeten',
            'price' => 'Vanaf €35',
            'icon' => 'nails',
        ],
        [
            'title' => 'Nagelstyling',
            'description' => 'Gel, acryl, nail art & extensions',
            'price' => 'Vanaf €45',
            'icon' => 'polish',
        ],
        [
            'title' => 'Lash & Brow',
            'description' => 'Wimperextensions, lifting & brow design',
            'price' => 'Vanaf €40',
            'icon' => 'lash',
        ],
    ];

    // Theme kleuren - luxe vrouwelijke bloemen/spa kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';

    // Icon mapping - synced with IconSets::kappersIcons() + beauty icons
    $icons = [
        // Kappers icons (from IconSets)
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'comb' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 6v14h16V6M8 6V4m4 2V4m4 2V4M8 10v6m4-6v6m4-6v6"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'child' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',

        // Beauty salon specific icons
        'curls' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>',
        'nails' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>',
        'polish' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
        'lash' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
    ];

    // Gradient colors per card
    $gradients = [
        ['from' => '#d4919d', 'to' => '#e8b4bc'],
        ['from' => '#c9b8d4', 'to' => '#ddd0e8'],
        ['from' => '#b8c9d4', 'to' => '#d0dce8'],
        ['from' => '#d4c9b8', 'to' => '#e8ddd0'],
        ['from' => '#d4919d', 'to' => '#c9b8d4'],
        ['from' => '#c9b8d4', 'to' => '#d4919d'],
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Onze Services
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; opacity: 0.7;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $index => $item)
                @php
                    $gradient = $gradients[$index % count($gradients)];
                @endphp
                <div
                    class="group relative bg-white p-8 rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    style="box-shadow: 0 4px 20px {{ $primaryColor }}10;"
                >
                    {{-- Decorative corner --}}
                    <div
                        class="absolute top-0 right-0 w-20 h-20 rounded-bl-[3rem] opacity-10"
                        style="background: linear-gradient(135deg, {{ $gradient['from'] }}, {{ $gradient['to'] }});"
                    ></div>

                    {{-- Icon --}}
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:scale-110"
                        style="background: linear-gradient(135deg, {{ $gradient['from'] }}20, {{ $gradient['to'] }}20);"
                    >
                        <svg
                            class="w-8 h-8"
                            style="color: {{ $gradient['from'] }};"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="mb-6" style="color: {{ $textColor }}; opacity: 0.7;">
                        {{ $item['description'] }}
                    </p>

                    {{-- Price & CTA --}}
                    <div class="flex items-center justify-between pt-6 border-t" style="border-color: {{ $primaryColor }}15;">
                        <span class="text-lg font-bold" style="color: {{ $gradient['from'] }};">
                            {{ $item['price'] }}
                        </span>
                        <a
                            href="#contact"
                            class="inline-flex items-center gap-1 text-sm font-semibold transition-colors group-hover:gap-2"
                            style="color: {{ $gradient['from'] }};"
                        >
                            Boeken
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-14">
            <a
                href="#pricing"
                class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold transition-all duration-300 hover:shadow-lg"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Bekijk volledige prijslijst
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
