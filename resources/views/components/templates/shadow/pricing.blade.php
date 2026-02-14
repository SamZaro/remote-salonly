{{--
    Template-specifieke pricing sectie voor Shadow (Barbershop)

    Dit component overschrijft de default demo-sections.pricing
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Projecttypes & Indicaties';
    $subtitle = $content['subtitle'] ?? 'Transparante richtprijzen voor uw bouwproject';
    $items = $content['items'] ?? [
        [
            'service' => 'Kleine Verbouwing',
            'price' => 'Vanaf €5.000',
            'description' => 'Badkamer, keuken of andere ruimtes',
            'features' => ['Gratis inmeting', 'Vaste prijs offerte', 'Materiaal inclusief']
        ],
        [
            'service' => 'Aanbouw / Uitbouw',
            'price' => 'Vanaf €25.000',
            'description' => 'Vergroot uw woonruimte',
            'popular' => true,
            'features' => ['Complete begeleiding', 'Vergunningsaanvraag', 'Sleutelklaar opgeleverd']
        ],
        [
            'service' => 'Nieuwbouw',
            'price' => 'Op aanvraag',
            'description' => 'Uw droomhuis van de grond af',
            'features' => ['Architect samenwerking', 'Volledig bouwmanagement', 'Alle garanties']
        ],
    ];

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';
    $buttonRadius = $theme['button_border_radius'] ?? '4px';
@endphp

<section id="pricing" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
            >
                Richtprijzen
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4"
                style="color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
            <p
                class="text-lg max-w-2xl mx-auto opacity-75"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>
        </div>

        {{-- Pricing cards --}}
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 max-w-6xl mx-auto">
            @foreach($items as $item)
                @php
                    $isPopular = $item['popular'] ?? false;
                @endphp
                <div
                    class="relative p-8 transition-all duration-300 hover:-translate-y-2 {{ $isPopular ? 'ring-2' : '' }}"
                    style="
                        background-color: {{ $isPopular ? $secondaryColor : $accentColor }};
                        {{ $isPopular ? 'ring-color: ' . $primaryColor . ';' : '' }}
                    "
                >
                    {{-- Popular badge --}}
                    @if($isPopular)
                        <div
                            class="absolute -top-4 left-1/2 -translate-x-1/2 px-6 py-2 text-sm font-bold uppercase tracking-wider"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        >
                            Meest gekozen
                        </div>
                    @endif

                    {{-- Project type --}}
                    <h3
                        class="text-xl font-bold mb-2"
                        style="color: {{ $isPopular ? '#ffffff' : $textColor }};"
                    >
                        {{ $item['service'] }}
                    </h3>

                    {{-- Prijs --}}
                    <div class="mb-4">
                        <span
                            class="text-3xl lg:text-4xl font-extrabold"
                            style="color: {{ $primaryColor }};"
                        >
                            {{ $item['price'] }}
                        </span>
                    </div>

                    {{-- Beschrijving --}}
                    <p
                        class="mb-6 opacity-75"
                        style="color: {{ $isPopular ? '#ffffff' : $textColor }};"
                    >
                        {{ $item['description'] }}
                    </p>

                    {{-- Features lijst --}}
                    @if(isset($item['features']) && is_array($item['features']))
                        <ul class="space-y-3 mb-8">
                            @foreach($item['features'] as $feature)
                                @php
                                    $featureText = is_array($feature) ? ($feature['feature'] ?? '') : $feature;
                                @endphp
                                <li class="flex items-center gap-3">
                                    <div
                                        class="flex-shrink-0 w-5 h-5 rounded-sm flex items-center justify-center"
                                        style="background-color: {{ $primaryColor }};"
                                    >
                                        <svg
                                            class="w-3 h-3"
                                            style="color: {{ $secondaryColor }};"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span style="color: {{ $isPopular ? '#ffffff' : $textColor }};">{{ $featureText }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- CTA Button --}}
                    <a
                        href="#contact"
                        class="block w-full py-4 text-center font-bold uppercase tracking-wide transition-all duration-300 hover:opacity-90"
                        style="
                            background-color: {{ $isPopular ? $primaryColor : 'transparent' }};
                            color: {{ $isPopular ? $secondaryColor : $primaryColor }};
                            border: 2px solid {{ $primaryColor }};
                            border-radius: {{ $buttonRadius }};
                        "
                    >
                        Offerte aanvragen
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Disclaimer --}}
        <p class="text-center mt-12 text-sm opacity-60" style="color: {{ $textColor }};">
            * Genoemde prijzen zijn indicatief. Exacte prijzen op basis van persoonlijke offerte.
        </p>
    </div>
</section>
