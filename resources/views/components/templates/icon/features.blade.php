{{--
    Template-specifieke features voor Icon (Hair Salon)

    USP / Waarom kiezen voor ons: vakmanschap, advies, producten
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
    $subtitle = $content['subtitle'] ?? 'Ontdek wat ons onderscheidt van de rest';
    $items = $content['items'] ?? [
        [
            'title' => 'Vakmanschap',
            'description' => 'Onze stylisten zijn opgeleid bij de beste academies en blijven continu hun vaardigheden verfijnen met de nieuwste technieken.',
            'icon' => 'scissors',
            'features' => ['Jarenlange ervaring', 'Gecertificeerde stylisten', 'Voortdurende bijscholing'],
        ],
        [
            'title' => 'Persoonlijk Advies',
            'description' => 'Elk bezoek begint met een uitgebreide consultatie zodat we jouw wensen en haartype perfect begrijpen.',
            'icon' => 'chat',
            'features' => ['Gratis consultatie', 'Op maat gemaakt plan', 'Nazorg & tips'],
        ],
        [
            'title' => 'Premium Producten',
            'description' => 'Wij werken uitsluitend met hoogwaardige, professionele producten die je haar gezond en stralend houden.',
            'icon' => 'sparkles',
            'features' => ['Sulfaatvrije formules', 'Dierproefvrij & vegan', 'Salon-exclusieve merken'],
        ],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#f9fafb';

    // Icon mapping - Heroicons outline 24x24
    $icons = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'chat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
    ];

    // Gradient colors per card
    $gradients = [
        ['from' => '#0ea5e9', 'to' => '#38bdf8'],
        ['from' => '#14b8a6', 'to' => '#2dd4bf'],
        ['from' => '#8b5cf6', 'to' => '#a78bfa'],
    ];
@endphp

<section id="features" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Waarom wij
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto text-gray-600">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Features grid --}}
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

                    {{-- Feature list with check circle icons --}}
                    @if(isset($item['features']))
                        <ul class="space-y-2">
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
                </div>
            @endforeach
        </div>
    </div>
</section>
