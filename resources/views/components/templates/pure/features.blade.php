{{--
    Template-specifieke features voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness - USP / Waarom kiezen voor ons
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Waarom Pure';
    $subtitle = $content['subtitle'] ?? 'Ontdek wat ons uniek maakt';
    $items = $content['items'] ?? [
        [
            'title' => 'Biologische Producten',
            'description' => 'Wij werken uitsluitend met gecertificeerde biologische en plantaardige producten die zacht zijn voor jouw haar en de planeet.',
            'icon' => 'leaf',
        ],
        [
            'title' => 'Persoonlijke Aanpak',
            'description' => 'Elk bezoek begint met een persoonlijk gesprek. Wij luisteren naar jouw wensen en stemmen alles af op jouw unieke haartype.',
            'icon' => 'heart',
        ],
        [
            'title' => 'Duurzaam & Bewust',
            'description' => 'Van waterbesparende technieken tot recyclebare verpakkingen — duurzaamheid zit in alles wat wij doen.',
            'icon' => 'sparkle',
        ],
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';

    // Icon mapping - wellness/nature icons
    $icons = [
        'leaf' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'sparkle' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
    ];
@endphp

<section id="features" class="py-24 lg:py-32" style="background-color: {{ $primaryColor }}08;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6"
                style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                Onze Kernwaarden
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Features grid --}}
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($items as $item)
                <div
                    class="group relative bg-white p-8 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl text-center"
                    style="box-shadow: 0 4px 20px {{ $primaryColor }}08;"
                >
                    {{-- Icon --}}
                    <div
                        class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 transition-all duration-300 group-hover:scale-110"
                        style="background-color: {{ $primaryColor }}15;"
                    >
                        <svg class="w-7 h-7" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'leaf'] ?? $icons['leaf'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3
                        class="text-xl font-medium mb-4"
                        style="color: {{ $headingColor }};"
                    >
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-sm leading-relaxed" style="color: {{ $textColor }};">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
