{{--
    Template-specifieke about sectie voor Projecto (Barbershop)

    Dit component overschrijft de default demo-sections.features (about variant)
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Over Ons';
    $subtitle = $content['subtitle'] ?? 'Ons verhaal';
    $description = $content['description'] ?? 'Wij zijn een team van gepassioneerde barbers met jarenlange ervaring. Bij ons draait alles om het perfecte kapsel, een ontspannen sfeer en persoonlijke aandacht. Van een klassieke fade tot een stijlvolle baardtrim - wij zorgen ervoor dat je er op je best uitziet.';
    $items = $content['items'] ?? [
        ['title' => 'Ervaren Barbers', 'description' => 'Ons team bestaat uit gecertificeerde professionals met oog voor detail', 'icon' => 'users'],
        ['title' => 'Premium Producten', 'description' => 'Wij werken uitsluitend met hoogwaardige producten', 'icon' => 'shield'],
        ['title' => 'Scherpe Prijzen', 'description' => 'Topkwaliteit voor een eerlijke prijs', 'icon' => 'check'],
    ];
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';

    // Icon mapping
    $icons = [
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        'shield' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
        'check' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'clock' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
@endphp

<section id="about" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Left: Image/Visual --}}
            <div class="relative">
                @if($backgroundImage)
                    <div class="relative">
                        <img
                            src="{{ $backgroundImage }}"
                            alt="Over ons"
                            class="w-full h-[500px] object-cover"
                        />

                    </div>
                @else
                    {{-- Placeholder visual --}}
                    <div class="relative">
                        <div
                            class="w-full h-[500px] flex items-center justify-center"
                            style="background-color: {{ $secondaryColor }};"
                        >
                            <svg class="w-32 h-32 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199"/>
                            </svg>
                        </div>
                        {{-- Accent block --}}
                        <div
                            class="absolute -bottom-6 -right-6 w-32 h-32"
                            style="background-color: {{ $primaryColor }};"
                        ></div>
                    </div>
                @endif

                {{-- Experience badge --}}
                <div
                    class="absolute top-8 -left-4 p-6 shadow-xl"
                    style="background-color: {{ $backgroundColor }};"
                >
                    <span class="block text-4xl font-bold" style="color: {{ $primaryColor }};">10+</span>
                    <span class="block text-sm font-medium uppercase tracking-wider" style="color: {{ $textColor }};">Jaar Ervaring</span>
                </div>
            </div>

            {{-- Right: Content --}}
            <div>
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4"
                    style="color: {{ $headingColor }};"
                >
                    {{ $title }}
                </h2>

                <p
                    class="text-lg mb-8 opacity-75 leading-relaxed"
                    style="color: {{ $textColor }};"
                >
                    {{ $description }}
                </p>

                {{-- Features list --}}
                <div class="space-y-4 mb-8">
                    @foreach($items as $item)
                        <div class="flex items-start gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded flex items-center justify-center"
                                style="background-color: {{ $primaryColor }};"
                            >
                                <svg
                                    class="w-6 h-6"
                                    style="color: {{ $secondaryColor }};"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    {!! $icons[$item['icon'] ?? 'check'] ?? $icons['check'] !!}
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1" style="color: {{ $textColor }};">
                                    {{ $item['title'] }}
                                </h4>
                                <p class="opacity-75" style="color: {{ $textColor }};">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
</section>
