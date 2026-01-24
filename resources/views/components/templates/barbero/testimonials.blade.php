{{--
    Template-specifieke testimonials voor Barbero (Barbershop)

    Reviews in vintage barbershop stijl met goud accenten
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Wat Onze Klanten Zeggen';
    $subtitle = $content['subtitle'] ?? 'Echte verhalen van echte gentlemen';
    $items = $content['items'] ?? [
        [
            'name' => 'Thomas van der Berg',
            'role' => 'Vaste klant sinds 2020',
            'quote' => 'De beste barbershop in de stad. Het team neemt echt de tijd voor je en het resultaat is altijd perfect. Die hot towel shave is een must!',
            'rating' => 5
        ],
        [
            'name' => 'Jeroen Bakker',
            'role' => 'Ondernemer',
            'quote' => 'Eindelijk een plek waar ze weten hoe ze met een baard moeten omgaan. Professioneel, relaxed en altijd een goed gesprek erbij.',
            'rating' => 5
        ],
        [
            'name' => 'Mark de Vries',
            'role' => 'Vaste klant sinds 2019',
            'quote' => 'Al jaren kom ik hier en het niveau blijft constant hoog. De sfeer is geweldig en je loopt er altijd scherp uit.',
            'rating' => 5
        ],
    ];

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = $theme['text_color'] ?? '#333333';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                {{-- Quote icon --}}
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 uppercase tracking-wider"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p
                class="text-lg max-w-2xl mx-auto opacity-70 uppercase tracking-widest"
                style="color: {{ $textColor }};"
            >
                {{ $subtitle }}
            </p>
        </div>

        {{-- Testimonials grid --}}
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($items as $index => $item)
                <div
                    class="relative p-8 border transition-all duration-300 hover:border-opacity-100"
                    style="border-color: {{ $primaryColor }}40; background-color: {{ $backgroundColor }};"
                >
                    {{-- Corner accents --}}
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>

                    {{-- Quote icon --}}
                    <div class="mb-6">
                        <svg class="w-10 h-10 opacity-30" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    {{-- Rating stars --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < ($item['rating'] ?? 5); $i++)
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <p
                        class="text-base mb-8 leading-relaxed italic"
                        style="color: {{ $textColor }}; opacity: 0.85;"
                    >
                        "{{ $item['quote'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="pt-6 border-t" style="border-color: {{ $primaryColor }}30;">
                        <div class="flex items-center gap-4">
                            {{-- Avatar placeholder --}}
                            <div
                                class="w-12 h-12 flex items-center justify-center text-lg font-bold uppercase"
                                style="background-color: {{ $secondaryColor }}; color: {{ $primaryColor }};"
                            >
                                {{ substr($item['name'], 0, 1) }}
                            </div>
                            <div>
                                <h4
                                    class="font-bold uppercase tracking-wide text-sm"
                                    style="color: {{ $textColor }};"
                                >
                                    {{ $item['name'] }}
                                </h4>
                                <p
                                    class="text-xs uppercase tracking-wider opacity-60"
                                    style="color: {{ $textColor }};"
                                >
                                    {{ $item['role'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Trust indicators --}}
        <div class="mt-16 text-center">
            <div class="flex items-center justify-center gap-8 flex-wrap">
                <div class="flex items-center gap-2">
                    <div class="flex gap-0.5">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-sm uppercase tracking-wider font-bold" style="color: {{ $textColor }};">4.9/5</span>
                </div>
                <div class="w-px h-6" style="background-color: {{ $primaryColor }}40;"></div>
                <span class="text-sm uppercase tracking-wider opacity-70" style="color: {{ $textColor }};">500+ Reviews</span>
                <div class="w-px h-6" style="background-color: {{ $primaryColor }}40;"></div>
                <span class="text-sm uppercase tracking-wider opacity-70" style="color: {{ $textColor }};">Sinds 2010</span>
            </div>
        </div>
    </div>
</section>
