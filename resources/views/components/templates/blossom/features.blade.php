{{--
    Template-specifieke features voor Blossom (Luxury Beauty Salon)

    Features: luxe ervaring, gecertificeerd team, premium producten, persoonlijke aandacht
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
    $subtitle = $content['subtitle'] ?? 'Ervaar het verschil van echte vakmanschap en persoonlijke aandacht';
    $items = $content['items'] ?? [
        [
            'title' => 'Luxe Ervaring',
            'description' => 'Vanaf het moment dat je binnenstapt, word je ondergedompeld in een wereld van luxe en comfort',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Gecertificeerd Team',
            'description' => 'Ons team van vakmensen is volledig gecertificeerd en blijft continu bijscholen',
            'icon' => 'shield',
        ],
        [
            'title' => 'Premium Producten',
            'description' => 'Wij werken uitsluitend met hoogwaardige, professionele producten voor het beste resultaat',
            'icon' => 'star',
        ],
        [
            'title' => 'Persoonlijke Aandacht',
            'description' => 'Elke behandeling wordt afgestemd op jouw unieke wensen en behoeften',
            'icon' => 'heart',
        ],
    ];

    // Theme kleuren - luxe vrouwelijke bloemen/spa kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';

    // Icon mapping
    $icons = [
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
    ];

    // Gradient colors per card
    $gradients = [
        ['from' => '#d4919d', 'to' => '#e8b4bc'],
        ['from' => '#c9b8d4', 'to' => '#ddd0e8'],
        ['from' => '#b8c9d4', 'to' => '#d0dce8'],
        ['from' => '#d4c9b8', 'to' => '#e8ddd0'],
    ];
@endphp

<section id="features" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                Onze Kenmerken
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

        {{-- Features grid --}}
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach($items as $index => $item)
                @php
                    $gradient = $gradients[$index % count($gradients)];
                @endphp
                <div
                    class="group relative bg-white p-8 rounded-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl"
                    style="box-shadow: 0 4px 20px {{ $primaryColor }}10; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
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
                            {!! $icons[$item['icon'] ?? 'sparkles'] ?? $icons['sparkles'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="leading-relaxed" style="color: {{ $textColor }}; opacity: 0.7;">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
