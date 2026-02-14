{{--
    Template-specifieke services sectie voor Projecto (Barbershop)

    Professionele barbershop diensten in strakke stijl
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Behandelingen';
    $subtitle = $content['subtitle'] ?? 'Wat wij bieden';
    $items = $content['items'] ?? [
        [
            'title' => 'Knippen',
            'description' => 'Van klassieke coupes tot moderne fades en textured crops. Onze barbers luisteren naar jouw wensen en creëren de perfecte look.',
            'icon' => 'scissors',
        ],
        [
            'title' => 'Baard Trimmen',
            'description' => 'Een strakke baardtrim of een volledige baard verzorging. Wij brengen jouw baard in topvorm met precisie en vakmanschap.',
            'icon' => 'razor',
        ],
        [
            'title' => 'Hot Towel Shave',
            'description' => 'De ultieme barbershop ervaring. Een traditionele scheerbeurt met warme handdoeken voor een gladde en verzorgde huid.',
            'icon' => 'towel',
        ],
        [
            'title' => 'Knippen & Baard',
            'description' => 'Het complete pakket: een stijlvol kapsel gecombineerd met een verzorgde baard. De perfecte combi voor de moderne man.',
            'icon' => 'star',
        ],
        [
            'title' => 'Wenkbrauwen',
            'description' => 'Netjes bijgewerkte wenkbrauwen voor een verzorgde uitstraling. Snel en pijnloos door onze ervaren barbers.',
            'icon' => 'check',
        ],
        [
            'title' => 'Haar & Huid Verzorging',
            'description' => 'Advies en behandelingen voor gezond haar en een verzorgde huid. Met premium producten afgestemd op jouw behoeften.',
            'icon' => 'shield',
        ],
    ];

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';

    // Icon mapping voor barbershop
    $icons = [
        // Barbershop icons
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z M4.867 19.125h.008v.008h-.008v-.008Z"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    ];
@endphp

<section id="services" class="py-20 bg-gray-100 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
            >
                Onze diensten
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4"
                style="color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $index => $item)
                <div
                    class="group relative bg-white p-8 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl"
                    style="border-left: 4px solid {{ $primaryColor }};"
                >

                    {{-- Icon --}}
                    <div
                        class="w-16 h-16 flex items-center justify-center mb-6 transition-transform duration-300 group-hover:scale-110"
                        style="background-color: {{ $backgroundColor }};"
                    >
                        <svg
                            class="w-8 h-8"
                            style="color: {{ $primaryColor }};"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Content --}}
                    <h3
                        class="text-xl font-bold mb-3"
                        style="color: {{ $textColor }};"
                    >
                        {{ $item['title'] }}
                    </h3>
                    <p
                        class="opacity-75 leading-relaxed"
                        style="color: {{ $textColor }};"
                    >
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
