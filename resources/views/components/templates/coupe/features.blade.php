{{--
    Template-specifieke features (USP/Why Choose Us) voor Coupe (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Waarom Kiezen Voor Ons';
    $subtitle = $content['subtitle'] ?? 'Onze Belofte';
    $items = $content['items'] ?? [
        [
            'title' => 'Vakmanschap',
            'description' => 'Jarenlange ervaring en voortdurende bijscholing garanderen een resultaat dat elke verwachting overtreft. Wij beheersen zowel klassieke als hedendaagse technieken.',
            'icon' => 'scissors',
        ],
        [
            'title' => 'Persoonlijk Advies',
            'description' => 'Elk bezoek begint met een uitgebreid gesprek. Wij luisteren naar jouw wensen en vertalen ze naar een look die perfect bij jou past.',
            'icon' => 'chat',
        ],
        [
            'title' => 'Premium Producten',
            'description' => 'Wij werken uitsluitend met de beste producten in de industrie. Geen compromissen, alleen het beste voor jouw haar.',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Ontspannen Sfeer',
            'description' => 'Stap binnen in een wereld van rust en elegantie. Bij ons is elk bezoek een moment van pure verwennerij en ontspanning.',
            'icon' => 'heart',
        ],
    ];

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings

    // Icon mapping - Heroicons outline paths
    $icons = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'chat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
    ];
@endphp

<section id="features" class="py-24 lg:py-32" style="background-color: {{ $secondaryColor }};">
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
                class="text-4xl sm:text-5xl lg:text-6xl font-light text-white"
                style="font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Features grid --}}
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            @foreach($items as $index => $item)
                <div
                    class="group relative p-10 transition-all duration-500 hover:-translate-y-2"
                    style="background-color: {{ $backgroundColor }};"
                >
                    {{-- Gold corner accent --}}
                    <div
                        class="absolute top-0 right-0 w-16 h-16 transition-all duration-500 group-hover:w-20 group-hover:h-20"
                        style="background: linear-gradient(135deg, {{ $primaryColor }} 50%, transparent 50%);"
                    ></div>

                    {{-- Number --}}
                    <span
                        class="absolute top-8 left-10 text-7xl font-light opacity-10"
                        style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Icon --}}
                    <div class="relative mb-8">
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

                    {{-- Title --}}
                    <h3
                        class="text-2xl font-light mb-4 relative"
                        style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ $item['title'] }}
                    </h3>

                    {{-- Divider --}}
                    <div class="w-12 h-px mb-6" style="background-color: {{ $primaryColor }}40;"></div>

                    {{-- Description --}}
                    <p class="leading-relaxed relative" style="color: {{ $textColor }};">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Bottom decorative element --}}
        <div class="flex items-center justify-center gap-4 mt-20">
            <div class="h-px w-24" style="background-color: {{ $primaryColor }}40;"></div>
            <div class="w-3 h-3 rotate-45 border" style="border-color: {{ $primaryColor }}40;"></div>
            <div class="h-px w-24" style="background-color: {{ $primaryColor }}40;"></div>
        </div>
    </div>
</section>
