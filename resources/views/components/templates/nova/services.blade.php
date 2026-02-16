@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Wat wij bieden';
    $items = $content['items'] ?? [
        ['title' => 'Knippen',         'description' => 'Precisieknippen afgestemd op jouw gezichtsvorm en persoonlijke stijl.', 'icon' => 'scissors'],
        ['title' => 'Kleuren',         'description' => 'Van subtiele highlights tot volledige kleurveranderingen met premium producten.', 'icon' => 'swatch'],
        ['title' => 'Styling',         'description' => 'Professionele styling voor elke gelegenheid, van casual tot feestelijk.', 'icon' => 'sparkles'],
        ['title' => 'Behandelingen',   'description' => 'Herstellende treatments voor gezond, glanzend en sterk haar.', 'icon' => 'heart'],
        ['title' => 'Bruidskapsels',   'description' => 'Maak jouw speciale dag compleet met een prachtig bruidskapsel.', 'icon' => 'star'],
        ['title' => 'Advies',          'description' => 'Persoonlijk advies over haarverzorging en de juiste producten voor thuis.', 'icon' => 'chat'],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#8b5cf6';
    $secondaryColor = $theme['secondary_color'] ?? '#18181b';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#71717a';
    $headingColor = $theme['heading_color'] ?? '#18181b';

    // Dynamic grid
    $itemCount = count($items);
    $gridCols = match(true) {
        $itemCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $itemCount <= 4 => 'md:grid-cols-2',
        default => 'md:grid-cols-2 lg:grid-cols-3',
    };

    $iconMap = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'swatch' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>',
        'chat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>',
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-sm font-medium uppercase tracking-widest mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl font-extrabold"
                style="color: {{ $headingColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Services Grid --}}
        @if(count($items) > 0)
            <div class="grid gap-6 {{ $gridCols }}" x-intersect="$el.classList.add('fadeInUp')">
                @foreach($items as $item)
                    <div
                        class="group p-8 rounded-sm transition-all duration-300 hover:-translate-y-1"
                        style="background-color: {{ $secondaryColor }}; box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
                    >
                        <div class="flex items-start gap-5">
                            {{-- Icon --}}
                            <div
                                class="w-12 h-12 rounded-sm flex items-center justify-center shrink-0 transition-colors duration-300"
                                style="background-color: {{ $primaryColor }}20;"
                            >
                                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $iconMap[$item['icon'] ?? 'sparkles'] ?? $iconMap['sparkles'] !!}
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold mb-2" style="color: #ffffff;">
                                    {{ $item['title'] ?? '' }}
                                </h3>
                                <p class="leading-relaxed text-sm" style="color: {{ $textColor }};">
                                    {{ $item['description'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: {{ $textColor }};">
                Geen diensten gedefinieerd.
            </p>
        @endif
    </div>
</section>
