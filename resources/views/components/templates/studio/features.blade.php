{{--
    Template-specifieke features voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Waarom Wij?';
    $subtitle = $content['subtitle'] ?? 'Dit maakt ons uniek in de game';
    $features = $content['features'] ?? [
        [
            'icon' => 'sparkles',
            'title' => 'Creatieve Visie',
            'description' => 'Wij zien haar als een canvas. Elke look is een uniek kunstwerk, afgestemd op jouw persoonlijkheid en vibe.',
        ],
        [
            'icon' => 'star',
            'title' => 'Trendsettend',
            'description' => 'Altijd up-to-date met de laatste trends. Van TikTok-viral looks tot runway-inspired styles - wij kennen ze allemaal.',
        ],
        [
            'icon' => 'check',
            'title' => 'Premium Kwaliteit',
            'description' => 'Alleen de beste producten en technieken. Olaplex, K18, en premium color lines voor een result dat blijft.',
        ],
        [
            'icon' => 'heart',
            'title' => 'Persoonlijk & Fun',
            'description' => 'Bij ons geen stijve sfeer. Goede muziek, leuke gesprekken en een experience waar je blij van wordt.',
        ],
    ];

    // Theme kleuren - dynamisch met defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';

    // Icons - Heroicons outline 24x24
    $icons = [
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
    ];

    $rotations = ['-rotate-2', 'rotate-1', '-rotate-1', 'rotate-2'];
@endphp

<section id="features" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(white 2px, transparent 2px); background-size: 40px 40px;"></div>

    {{-- Decorative shapes --}}
    <div class="absolute top-20 left-20 w-32 h-32 rounded-full" style="background: {{ $primaryColor }}30;"></div>
    <div class="absolute bottom-20 right-20 w-48 h-48 rotate-45" style="background: {{ $accentColor }}20;"></div>
    <div class="absolute top-1/2 right-10 w-24 h-24 rounded-full" style="background: {{ $primaryColor }}15;"></div>

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
                WHY US
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

        {{-- Features grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($features as $index => $feature)
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
                            {!! $icons[$feature['icon']] ?? $icons['sparkles'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3" style="color: {{ $index === 1 || $index === 2 ? $headingColor : 'white' }};">
                        {{ $feature['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p style="color: {{ $index === 1 || $index === 2 ? $textColor : 'white' }}; opacity: 0.9;">
                        {{ $feature['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
