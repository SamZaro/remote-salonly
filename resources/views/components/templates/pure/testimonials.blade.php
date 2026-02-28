{{--
    Template-specifieke testimonials voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
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
            'name' => 'Anna de Jong',
            'role' => 'Vaste gast',
            'quote' => 'Eindelijk een salon die écht natuurlijk werkt. Mijn haar is gezonder dan ooit en de sfeer is zo rustgevend.',
            'rating' => 5,
        ],
        [
            'name' => 'Marloes Bakker',
            'role' => 'Nieuwe klant',
            'quote' => 'De plantaardige kleuring is geweldig! Geen chemische geuren, prachtig resultaat en mijn haar voelt zo zacht.',
            'rating' => 5,
        ],
        [
            'name' => 'Sanne van Dijk',
            'role' => 'Vaste gast',
            'quote' => 'Meer dan een kapper - het is een wellness ervaring. De hoofdhuidmassage is echt een moment van rust.',
            'rating' => 5,
        ],
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
@endphp

<section id="testimonials" class="py-24 lg:py-32" style="background-color: {{ $primaryColor }}08;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6"
                style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Reviews
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Testimonials grid --}}
        <div class="grid gap-8 md:grid-cols-3">
            @foreach($items as $item)
                <div
                    class="bg-white p-8 rounded-2xl transition-all duration-300 hover:shadow-xl"
                    style="box-shadow: 0 4px 20px {{ $primaryColor }}08; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.12 }}s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{-- Quote icon --}}
                    <div class="mb-6">
                        <svg class="w-10 h-10" style="color: {{ $primaryColor }}30;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    {{-- Rating --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < ($item['rating'] ?? 5); $i++)
                            <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <p class="mb-8 leading-relaxed" style="color: {{ $textColor }};">
                        "{{ $item['quote'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-3 pt-6 border-t" style="border-color: {{ $primaryColor }}15;">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-medium text-white"
                            style="background-color: {{ $primaryColor }};"
                        >
                            {{ substr($item['name'], 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-medium" style="color: {{ $headingColor }};">
                                {{ $item['name'] }}
                            </h4>
                            <p class="text-xs" style="color: {{ $textColor }};">
                                {{ $item['role'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Rating summary --}}
        <div class="mt-12 text-center">
            <div
                class="inline-flex items-center gap-6 px-8 py-4 rounded-full bg-white"
                style="box-shadow: 0 4px 20px {{ $primaryColor }}08;"
            >
                <div class="flex gap-1">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    @endfor
                </div>
                <span class="text-sm" style="color: {{ $textColor }};">
                    <strong style="color: {{ $headingColor }};">4.9</strong> uit 150+ reviews
                </span>
            </div>
        </div>
    </div>
</section>
