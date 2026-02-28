{{--
    Template-specifieke about sectie voor Barbero (Barbershop)

    Over de barbershop in vintage stijl
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Ons Verhaal';
    $subtitle = $content['subtitle'] ?? 'Traditie ontmoet moderne stijl';
    $description = $content['description'] ?? 'Al generaties lang bieden wij de beste barberdiensten aan. Onze barbers combineren klassieke technieken met hedendaagse trends voor de perfecte look.';
    $items = $content['items'] ?? [
        ['title' => 'Ervaren Barbers', 'description' => 'Gecertificeerde vakmannen', 'icon' => 'users'],
        ['title' => 'Premium Producten', 'description' => 'Alleen de beste merken', 'icon' => 'star'],
        ['title' => 'Relaxte Sfeer', 'description' => 'Waar mannen mannen zijn', 'icon' => 'home'],
    ];
    // Get featured image from Spatie Media Library or fallback to content
    $featuredImage = $section?->getFirstMediaUrl('background') ?: ($content['featured_image'] ?? null);

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = $theme['text_color'] ?? '#333333';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';

    // Icon mapping
    $icons = [
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'home' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
        'clock' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
    $headingFont = $theme['heading_font_family'] ?? 'Oswald';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="about" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Left: Image/Visual --}}
            <div
                class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($featuredImage)
                    <div class="relative">
                        <img
                            src="{{ $featuredImage }}"
                            alt="Over ons"
                            class="w-full h-[600px] object-cover grayscale"
                        />
                        {{-- Gold frame overlay --}}
                        <div class="absolute inset-4 border-2 pointer-events-none" style="border-color: {{ $primaryColor }};"></div>
                    </div>
                @else
                    {{-- Placeholder visual met barbershop thema --}}
                    <div class="relative">
                        <div
                            class="w-full h-[600px] flex items-center justify-center"
                            style="background-color: {{ $secondaryColor }};"
                        >
                            {{-- Barberpole visual --}}
                            <div class="w-16 h-80" style="background: repeating-linear-gradient(180deg, #ffffff 0px, #ffffff 30px, #c41e3a 30px, #c41e3a 60px, #1a3a8f 60px, #1a3a8f 90px);"></div>
                        </div>
                        {{-- Gold frame --}}
                        <div class="absolute inset-4 border-2 pointer-events-none" style="border-color: {{ $primaryColor }};"></div>
                    </div>
                @endif

                {{-- Experience badge --}}
                <div
                    class="absolute -bottom-6 -right-6 p-6 text-center"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $primaryColor }}; opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                >
                    <span class="block text-4xl font-bold" style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', Georgia, serif;">15+</span>
                    <span class="block text-xs font-bold uppercase tracking-widest" style="color: {{ $secondaryColor }};">Jaar</span>
                </div>
            </div>

            {{-- Right: Content --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Header ornament --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-bold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }};">Over Ons</span>
                </div>

                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 uppercase tracking-wide"
                    style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                >
                    {{ $title }}
                </h2>

                <p
                    class="text-xl mb-6 italic"
                    style="color: {{ $primaryColor }};"
                >
                    "{{ $subtitle }}"
                </p>

                <p
                    class="text-lg mb-10 opacity-75 leading-relaxed"
                    style="color: {{ $textColor }};"
                >
                    {{ $description }}
                </p>

                {{-- Features --}}
                <div class="grid sm:grid-cols-3 gap-6 mb-10">
                    @foreach($items as $index => $item)
                        <div
                            class="text-center p-6 border"
                            style="border-color: {{ $primaryColor }}30; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        >
                            <div
                                class="w-14 h-14 mx-auto mb-4 border-2 flex items-center justify-center"
                                style="border-color: {{ $primaryColor }};"
                            >
                                <svg
                                    class="w-7 h-7"
                                    style="color: {{ $primaryColor }};"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    {!! $icons[$item['icon'] ?? 'star'] ?? $icons['star'] !!}
                                </svg>
                            </div>
                            <h4 class="font-bold mb-1 uppercase tracking-wide text-sm" style="color: {{ $textColor }};">
                                {{ $item['title'] }}
                            </h4>
                            <p class="text-sm opacity-70" style="color: {{ $textColor }};">
                                {{ $item['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="inline-flex items-center gap-3 px-8 py-4 font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:scale-105"
                    style="background-color: {{ $secondaryColor }}; color: {{ $primaryColor }}; border: 2px solid {{ $primaryColor }};"
                >
                    Maak een afspraak
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
