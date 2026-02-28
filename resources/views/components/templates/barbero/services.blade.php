{{--
    Template-specifieke services voor Barbero (Barbershop)

    Diensten in vintage barbershop stijl
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Vakmanschap voor de moderne gentleman';
    $items = $content['items'] ?? [
        ['title' => 'Klassiek Knippen', 'description' => 'Traditioneel geknipt met schaar en tondeuse', 'icon' => 'scissors', 'price' => '€25'],
        ['title' => 'Baard Trimmen', 'description' => 'Perfecte baard met het mes', 'icon' => 'razor', 'price' => '€20'],
        ['title' => 'Hot Towel Shave', 'description' => 'Luxe scheerbeurt met warme handdoeken', 'icon' => 'towel', 'price' => '€35'],
        ['title' => 'The Full Experience', 'description' => 'Knippen, baard én gezichtsbehandeling', 'icon' => 'star', 'price' => '€55'],
    ];

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = $theme['text_color'] ?? '#333333';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';

    // Icon mapping voor barbershop - synced with IconSets::kappersIcons()
    $icons = [
        // Kappers icons (from IconSets)
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'comb' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 6v14h16V6M8 6V4m4 2V4m4 2V4M8 10v6m4-6v6m4-6v6"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'child' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
    $headingFont = $theme['heading_font_family'] ?? 'Oswald';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 uppercase tracking-wider"
                style="color: #ffffff; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p
                class="text-lg max-w-2xl mx-auto opacity-70 uppercase tracking-widest"
                style="color: #ffffff;"
            >
                {{ $subtitle }}
            </p>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($items as $index => $item)
                <div
                    class="group relative p-8 border transition-all duration-300 hover:border-opacity-100"
                    style="border-color: {{ $primaryColor }}40; background-color: {{ $secondaryColor }}; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{-- Corner accents --}}
                    <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                    <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>

                    <div class="flex items-start justify-between gap-6">
                        <div class="flex items-start gap-6">
                            {{-- Icon --}}
                            <div
                                class="flex-shrink-0 w-16 h-16 border-2 flex items-center justify-center transition-all duration-300 group-hover:bg-opacity-100"
                                style="border-color: {{ $primaryColor }}; background-color: transparent;"
                            >
                                <svg
                                    class="w-8 h-8 transition-colors duration-300"
                                    style="color: {{ $primaryColor }};"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                                </svg>
                            </div>

                            {{-- Content --}}
                            <div>
                                <h3
                                    class="text-xl font-bold mb-2 uppercase tracking-wide"
                                    style="color: #ffffff;"
                                >
                                    {{ $item['title'] }}
                                </h3>
                                <p
                                    class="opacity-70"
                                    style="color: #ffffff;"
                                >
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Price --}}
                        @if(isset($item['price']))
                            <div
                                class="flex-shrink-0 text-2xl font-bold"
                                style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                            >
                                {{ $item['price'] }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div
            class="text-center mt-12"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            <a
                href="#contact"
                class="inline-flex items-center justify-center px-10 py-4 text-sm font-bold uppercase tracking-widest border-2 transition-all duration-300 hover:bg-opacity-100"
                style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }}; background-color: transparent;"
            >
                Bekijk alle diensten
            </a>
        </div>
    </div>
</section>
