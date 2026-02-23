{{--
    Template-specifieke about voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Filosofie';
    $subtitle = $content['subtitle'] ?? 'Schoonheid in harmonie met de natuur';
    $description = $content['description'] ?? 'Bij Pure geloven we dat echte schoonheid begint bij gezond haar en een gezonde planeet. Wij gebruiken uitsluitend biologische en plantaardige producten die zacht zijn voor jou én het milieu.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $items = $content['items'] ?? [
        ['title' => 'Biologisch', 'description' => '100% natuurlijke ingrediënten', 'icon' => 'leaf'],
        ['title' => 'Duurzaam', 'description' => 'Eco-vriendelijke salon', 'icon' => 'globe'],
        ['title' => 'Mindful', 'description' => 'Rustgevende ervaring', 'icon' => 'heart'],
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';

    // Icon mapping
    $icons = [
        'leaf' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'globe' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
    ];
@endphp

<section id="about" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Image side --}}
            <div class="relative order-2 lg:order-1"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                <div class="relative">
                    {{-- Organic shape background --}}
                    <div class="absolute -inset-8 opacity-10">
                        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $primaryColor }};">
                            <path fill="currentColor" d="M45.3,-51.2C58.3,-40.9,68.2,-25.3,71.2,-8.2C74.2,8.9,70.3,27.5,59.5,40.6C48.7,53.7,31,61.3,12.7,65.2C-5.6,69.1,-24.5,69.3,-40.1,61.1C-55.7,52.9,-68,36.3,-72.1,18.1C-76.2,-0.1,-72.1,-19.9,-62,-35.1C-51.9,-50.3,-35.8,-60.9,-19.2,-64.8C-2.6,-68.7,14.5,-65.9,29.9,-59.6C45.3,-53.3,59,-46.5,45.3,-51.2Z" transform="translate(100 100)" />
                        </svg>
                    </div>

                    @if($image)
                        {{-- Main image --}}
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[500px] lg:h-[550px] rounded-[2rem] object-cover"
                        />
                    @else
                        {{-- Image placeholder --}}
                        <div
                            class="relative w-full h-[500px] lg:h-[550px] rounded-[2rem] flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $accentColor }}10);"
                        >
                            <svg class="w-16 h-16" style="color: {{ $primaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Stats card --}}
                <div
                    class="absolute -bottom-8 -right-8 p-6 rounded-2xl bg-white hidden lg:block"
                    style="box-shadow: 0 20px 60px {{ $primaryColor }}15;"
                >
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <span class="block text-3xl font-light" style="color: {{ $primaryColor }};">10+</span>
                            <span class="text-xs" style="color: {{ $textColor }};">Jaar ervaring</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-3xl font-light" style="color: {{ $primaryColor }};">100%</span>
                            <span class="text-xs" style="color: {{ $textColor }};">Natuurlijk</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content side --}}
            <div class="order-1 lg:order-2"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Section label --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6"
                    style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    Over Ons
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6 leading-tight"
                    style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-xl mb-6 italic"
                    style="color: {{ $primaryColor }};"
                >
                    "{{ $subtitle }}"
                </p>

                {{-- Description --}}
                <p
                    class="text-base mb-10 leading-relaxed"
                    style="color: {{ $textColor }};"
                >
                    {{ $description }}
                </p>

                {{-- Features --}}
                <div class="space-y-6 mb-10">
                    @foreach($items as $item)
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center"
                                style="background-color: {{ $primaryColor }}15;"
                            >
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icons[$item['icon'] ?? 'leaf'] ?? $icons['leaf'] !!}
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium mb-1" style="color: {{ $headingColor }};">
                                    {{ $item['title'] }}
                                </h4>
                                <p class="text-sm" style="color: {{ $textColor }};">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-medium transition-all duration-300 hover:shadow-lg"
                    style="background-color: {{ $primaryColor }}; color: white;"
                >
                    Maak kennis
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
