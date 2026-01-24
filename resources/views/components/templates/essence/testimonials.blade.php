{{--
    Template-specifieke testimonials voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Ervaringen';
    $subtitle = $content['subtitle'] ?? 'Wat onze gasten zeggen';
    $items = $content['items'] ?? [
        [
            'name' => 'Sophie van den Berg',
            'role' => 'Bruid',
            'quote' => 'Mijn bruidskapsels was precies wat ik had gedroomd. Het team begreep perfect wat ik wilde en de proefafspraak gaf me zoveel vertrouwen.',
            'rating' => 5,
        ],
        [
            'name' => 'Emma Jansen',
            'role' => 'Vaste gast',
            'quote' => 'Al jaren vaste klant. De sfeer, de expertise, de persoonlijke aandacht - alles klopt hier. Mijn balayage ziet er altijd prachtig uit.',
            'rating' => 5,
        ],
        [
            'name' => 'Lisa de Vries',
            'role' => 'Nieuwe klant',
            'quote' => 'Van begin tot eind een verwenervaring. Het consult was uitgebreid en het resultaat overtrof mijn verwachtingen.',
            'rating' => 5,
        ],
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';
@endphp

<section id="testimonials" class="py-24 lg:py-32" style="background-color: {{ $accentColor }}40;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Recensies</span>
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Testimonials grid --}}
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($items as $index => $item)
                <div
                    class="relative bg-white p-8 lg:p-10 transition-all duration-300 hover:shadow-lg"
                    style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;"
                >
                    {{-- Quote mark --}}
                    <div class="absolute top-8 right-8">
                        <svg class="w-10 h-10" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    {{-- Rating --}}
                    <div class="flex gap-1 mb-6">
                        @for($i = 0; $i < ($item['rating'] ?? 5); $i++)
                            <svg class="w-4 h-4" style="color: {{ $secondaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <p class="text-base mb-8 leading-relaxed font-light italic" style="color: {{ $textColor }};">
                        "{{ $item['quote'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="pt-6 border-t" style="border-color: {{ $primaryColor }}60;">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <div
                                class="w-12 h-12 flex items-center justify-center text-sm font-medium"
                                style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }};"
                            >
                                {{ substr($item['name'], 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-sm font-medium" style="color: {{ $secondaryColor }};">
                                    {{ $item['name'] }}
                                </h4>
                                <p class="text-xs" style="color: {{ $textColor }}; opacity: 0.6;">
                                    {{ $item['role'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Rating summary --}}
        <div class="mt-16 text-center">
            <div class="inline-flex items-center gap-6 px-10 py-6 bg-white" style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;">
                <div class="flex gap-1">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    @endfor
                </div>
                <div class="w-px h-8" style="background-color: {{ $primaryColor }};"></div>
                <div>
                    <span class="text-lg font-light" style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;">5.0</span>
                    <span class="text-sm ml-1" style="color: {{ $textColor }}; opacity: 0.6;">uit 200+ reviews</span>
                </div>
            </div>
        </div>
    </div>
</section>
