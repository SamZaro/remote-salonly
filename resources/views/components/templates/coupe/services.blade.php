{{--
    Template-specifieke services voor Coupe (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Vakmanschap & Stijl';
    $items = $content['items'] ?? [
        [
            'title' => 'Knippen & Stylen',
            'description' => 'Van klassieke elegantie tot moderne trends - wij creëren de perfecte look die bij jouw persoonlijkheid past.',
            'price' => 'Vanaf €55',
            'icon' => 'scissors',
            'features' => ['Wasbeurt', 'Knipbehandeling', 'Finishing & Styling'],
        ],
        [
            'title' => 'Kleuren & Balayage',
            'description' => 'Subtiele highlights of een volledige transformatie - onze kleurspecialisten toveren elke wens werkelijkheid.',
            'price' => 'Vanaf €85',
            'icon' => 'color',
            'features' => ['Kleuradvies', 'Premium producten', 'Nabehandeling'],
        ],
        [
            'title' => 'Treatments',
            'description' => 'Intensieve verzorging voor beschadigd of droog haar. Geef je haar de luxe die het verdient.',
            'price' => 'Vanaf €45',
            'icon' => 'treatment',
            'features' => ['Keratine', 'Olaplex', 'Deep conditioning'],
        ],
    ];

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings

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

        // Extra icons for this template
        'treatment' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
        'women' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    ];
@endphp

<section id="services" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="max-w-3xl mx-auto text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <span
                    class="text-xs font-medium uppercase tracking-[0.3em]"
                    style="color: {{ $primaryColor }};"
                >
                    {{ $subtitle }}
                </span>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-light"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-8 lg:grid-cols-3">
            @foreach($items as $index => $item)
                <div
                    class="group relative p-10 transition-all duration-500 hover:-translate-y-2"
                    style="background-color: {{ $secondaryColor }};"
                >
                    {{-- Gold corner accent --}}
                    <div
                        class="absolute top-0 right-0 w-16 h-16 transition-all duration-500 group-hover:w-20 group-hover:h-20"
                        style="background: linear-gradient(135deg, {{ $primaryColor }} 50%, transparent 50%);"
                    ></div>

                    {{-- Icon --}}
                    <div class="mb-8">
                        <svg
                            class="w-12 h-12"
                            style="color: {{ $primaryColor }};"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Number --}}
                    <span
                        class="absolute top-8 left-10 text-7xl font-light opacity-10"
                        style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Title --}}
                    <h3
                        class="text-2xl font-light mb-4 relative"
                        style="color: #ffffff; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="mb-8 leading-relaxed text-white/60">
                        {{ $item['description'] }}
                    </p>

                    {{-- Features --}}
                    @if(isset($item['features']))
                        <ul class="space-y-3 mb-8">
                            @foreach($item['features'] as $feature)
                                <li class="flex items-center gap-3 text-sm text-white/50">
                                    <span class="w-1.5 h-1.5" style="background-color: {{ $primaryColor }};"></span>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Price & CTA --}}
                    <div class="flex items-center justify-between pt-8 border-t border-white/10">
                        <span
                            class="text-xl font-light"
                            style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                        >
                            {{ $item['price'] }}
                        </span>
                        <a
                            href="#contact"
                            class="inline-flex items-center gap-2 text-xs font-medium uppercase tracking-widest text-white/60 transition-colors hover:text-white"
                        >
                            Reserveren
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-16">
            <a
                href="#pricing"
                class="group inline-flex items-center gap-4 text-sm font-medium uppercase tracking-widest transition-all duration-300"
                style="color: {{ $headingColor }};"
            >
                <span class="border-b pb-1 transition-colors" style="border-color: {{ $primaryColor }};">
                    Bekijk volledige prijslijst
                </span>
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
