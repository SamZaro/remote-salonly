{{--
    Template-specifieke services voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Services';
    $subtitle = $content['subtitle'] ?? 'Van bold colors tot precision cuts';
    $services = $content['services'] ?? [
        [
            'icon' => 'scissors',
            'title' => 'Cuts & Styling',
            'description' => 'Van classic tot edgy - wij snijden elke stijl.',
            'price' => 'Vanaf €35',
        ],
        [
            'icon' => 'color',
            'title' => 'Color Studio',
            'description' => 'Balayage, highlights, vivids - jouw kleur, jouw rules.',
            'price' => 'Vanaf €75',
        ],
        [
            'icon' => 'sparkles',
            'title' => 'Treatments',
            'description' => 'Olaplex, keratine en deep conditioning voor healthy hair.',
            'price' => 'Vanaf €45',
        ],
        [
            'icon' => 'star',
            'title' => 'Styling Events',
            'description' => 'Bridal, prom, photoshoots - we make you shine!',
            'price' => 'Op aanvraag',
        ],
    ];

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';

    // Icons - synced with IconSets::kappersIcons() + creative studio icons
    $icons = [
        // Kappers icons (from IconSets)
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'comb' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 6v14h16V6M8 6V4m4 2V4m4 2V4M8 10v6m4-6v6m4-6v6"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'child' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',

        // Creative studio icons
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
    ];

    $rotations = ['-rotate-2', 'rotate-1', '-rotate-1', 'rotate-2'];
@endphp

<section id="services" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(white 2px, transparent 2px); background-size: 40px 40px;"></div>



    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6 transform -rotate-2"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                </svg>
                WHAT WE DO
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6"
                style="color: white; font-family: 'Montserrat', 'Poppins', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-xl max-w-2xl mx-auto" style="color: white; opacity: 0.7;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $index => $service)
                <div
                    class="group p-6 rounded-3xl transition-all duration-300 hover:scale-105 {{ $rotations[$index % 4] }} hover:rotate-0"
                    style="background: {{ $index === 0 ? $primaryColor : ($index === 1 ? $accentColor : ($index === 2 ? 'white' : $primaryColor)) }}; box-shadow: 6px 6px 0 {{ $index === 1 || $index === 2 ? $secondaryColor : $accentColor }};"
                >
                    {{-- Icon --}}
                    <div
                        class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6"
                        style="background: {{ $index === 1 || $index === 2 ? $primaryColor : 'white' }}20;"
                    >
                        <svg class="w-8 h-8" style="color: {{ $index === 1 || $index === 2 ? $headingColor : 'white' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$service['icon']] ?? $icons['sparkles'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $index === 1 || $index === 2 ? $headingColor : 'white' }};">
                        {{ $service['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="mb-4" style="color: {{ $index === 1 || $index === 2 ? $headingColor : 'white' }};">
                        {{ $service['description'] }}
                    </p>

                    {{-- Price --}}
                    <div
                        class="inline-block px-4 py-2 rounded-full text-sm font-bold"
                        style="background: {{ $index === 1 || $index === 2 ? $secondaryColor : 'white' }}; color: {{ $index === 1 || $index === 2 ? 'white' : $primaryColor }};"
                    >
                        {{ $service['price'] }}
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="text-center mt-16">
            <a
                href="#pricing"
                class="inline-flex items-center gap-3 px-8 py-4 rounded-full font-bold text-lg transition-all hover:scale-105"
                style="background: white; color: {{ $secondaryColor }}; box-shadow: 6px 6px 0 {{ $primaryColor }};"
            >
                Bekijk alle prijzen
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
