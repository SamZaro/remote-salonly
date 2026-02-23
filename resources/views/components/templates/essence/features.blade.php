{{--
    Template-specifieke features voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - kenmerken van een luxe schoonheidssalon
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Waarom Wij';
    $subtitle = $content['subtitle'] ?? 'De kenmerken die ons onderscheiden';
    $items = $content['items'] ?? [
        [
            'title' => 'Verfijnde Expertise',
            'description' => 'Jarenlange ervaring en voortdurende bijscholing garanderen een onberispelijk resultaat',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Luxe Producten',
            'description' => 'Uitsluitend geselecteerde premium producten voor de meest veeleisende huid en haar',
            'icon' => 'star',
        ],
        [
            'title' => 'Persoonlijke Benadering',
            'description' => 'Elke behandeling wordt zorgvuldig afgestemd op jouw individuele wensen',
            'icon' => 'heart',
        ],
        [
            'title' => 'Ontspannen Sfeer',
            'description' => 'Een serene omgeving waar je volledig tot rust kunt komen en kunt genieten',
            'icon' => 'shield',
        ],
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';

    // Icon mapping
    $icons = [
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
    ];
@endphp

<section id="features" class="py-24 lg:py-32" style="background-color: {{ $accentColor }}40;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Kenmerken</span>
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Features grid --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($items as $index => $item)
                <div
                    class="group relative p-8 bg-white transition-all duration-500 hover:shadow-xl"
                    style="box-shadow: 0 2px 20px {{ $secondaryColor }}08; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{-- Subtle corner accent --}}
                    <div class="absolute top-0 right-0 w-16 h-16">
                        <div class="absolute top-4 right-4 w-8 h-px transition-all duration-300 group-hover:w-12" style="background-color: {{ $primaryColor }};"></div>
                        <div class="absolute top-4 right-4 w-px h-8 transition-all duration-300 group-hover:h-12" style="background-color: {{ $primaryColor }};"></div>
                    </div>

                    {{-- Icon --}}
                    <div
                        class="w-14 h-14 mb-6 flex items-center justify-center transition-all duration-300 group-hover:scale-105"
                        style="background-color: {{ $accentColor }};"
                    >
                        <svg class="w-6 h-6" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'sparkles'] ?? $icons['sparkles'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3
                        class="text-lg font-medium mb-3"
                        style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-sm leading-relaxed" style="color: {{ $textColor }}; opacity: 0.7;">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
