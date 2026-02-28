{{--
    Spa Template: Features Section
    Serene spa & wellness — icon-led feature cards with centered layout
    Fonts: Lustria (headings) + Lato (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Feel Natural, Be Natural';
    $subtitle = $content['subtitle'] ?? 'Wat ons onderscheidt';
    $items = $content['items'] ?? [
        ['title' => 'Luxe Ervaring', 'description' => 'Een ontspannen sfeer waar je jezelf kunt verwennen en tot rust kunt komen', 'icon' => 'sparkles'],
        ['title' => 'Gecertificeerd Team', 'description' => 'Vakmensen die continu bijscholen voor het beste resultaat', 'icon' => 'shield'],
        ['title' => 'Premium Producten', 'description' => 'Alleen hoogwaardige, professionele producten voor langdurig resultaat', 'icon' => 'star'],
        ['title' => 'Persoonlijke Aandacht', 'description' => 'Elke behandeling wordt zorgvuldig afgestemd op jouw wensen', 'icon' => 'heart'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';

    $icons = [
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
    ];
@endphp

<section id="features" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header with transparent watermark --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            {{-- Large transparent watermark text --}}
            <span
                class="absolute top-[-20px] left-1/2 -translate-x-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.05; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >Experience</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                Aliquam a augue suscipit, luctus neque purus ipsum neque undo dolor primis libero tempus
            </p>
        </div>

        {{-- Features grid --}}
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($items as $index => $item)
                <div
                    class="text-center p-8 rounded-lg transition-all duration-300 hover:shadow-md group"
                    style="background-color: {{ $backgroundColor }};"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                >
                    {{-- Icon circle --}}
                    <div
                        class="w-20 h-20 rounded-full mx-auto mb-6 flex items-center justify-center transition-all duration-300 group-hover:shadow-sm"
                        style="background-color: {{ $primaryColor }};"
                    >
                        <svg class="w-9 h-9" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'sparkles'] ?? $icons['sparkles'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-lg font-bold mb-3" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="leading-relaxed" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        {{ $item['description'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
