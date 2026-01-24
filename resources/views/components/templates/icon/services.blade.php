{{--
    Template-specifieke services voor Icon (Hair Salon)

    Diensten: women's haircut, colour, men's haircut
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging voor iedereen';
    $items = $content['items'] ?? [
        [
            'title' => "Women's Haircut",
            'description' => 'Van klassiek tot trendy - wij creëren de perfecte look die bij jou past',
            'price' => 'Vanaf €45',
            'icon' => 'women',
            'features' => ['Wasbeurt', 'Knippen', 'Föhnen & Stylen'],
        ],
        [
            'title' => 'Kleuren & Highlights',
            'description' => 'Breng je haar tot leven met onze premium kleurbehandelingen',
            'price' => 'Vanaf €65',
            'icon' => 'color',
            'features' => ['Balayage', 'Highlights', 'Full colour'],
        ],
        [
            'title' => "Men's Haircut",
            'description' => 'Strakke cuts en moderne stijlen voor de man van nu',
            'price' => 'Vanaf €28',
            'icon' => 'men',
            'features' => ['Knippen', 'Styling', 'Baard trim'],
        ],
    ];

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';

    // Icon mapping - synced with IconSets::kappersIcons() + person icons
    $icons = [
        // Kappers icons (from IconSets)
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'comb' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 6v14h16V6M8 6V4m4 2V4m4 2V4M8 10v6m4-6v6m4-6v6"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'child' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',

        // Person icons for this template
        'women' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        'men' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];

    // Gradient colors per card - zachte, gebalanceerde kleuren
    $gradients = [
        ['from' => '#0ea5e9', 'to' => '#38bdf8'],
        ['from' => '#14b8a6', 'to' => '#2dd4bf'],
        ['from' => '#8b5cf6', 'to' => '#a78bfa'],
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Diensten
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto text-gray-600">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($items as $index => $item)
                @php
                    $gradient = $gradients[$index % count($gradients)];
                @endphp
                <div
                    class="group relative bg-white rounded-2xl p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    style="box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
                >
                    {{-- Gradient top border --}}
                    <div
                        class="absolute top-0 left-6 right-6 h-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"
                        style="background: linear-gradient(90deg, {{ $gradient['from'] }}, {{ $gradient['to'] }});"
                    ></div>

                    {{-- Icon --}}
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:scale-110"
                        style="background: linear-gradient(135deg, {{ $gradient['from'] }}15, {{ $gradient['to'] }}15);"
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
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $textColor }};">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-gray-600 mb-6">
                        {{ $item['description'] }}
                    </p>

                    {{-- Features --}}
                    @if(isset($item['features']))
                        <ul class="space-y-2 mb-6">
                            @foreach($item['features'] as $feature)
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 shrink-0" style="color: {{ $gradient['from'] }};" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Price & CTA --}}
                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <span class="text-lg font-bold" style="color: {{ $gradient['from'] }};">
                            {{ $item['price'] }}
                        </span>
                        <a
                            href="#contact"
                            class="inline-flex items-center gap-1 text-sm font-semibold transition-colors"
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
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-lg"
                style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10); color: {{ $primaryColor }};"
            >
                Bekijk alle prijzen
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
