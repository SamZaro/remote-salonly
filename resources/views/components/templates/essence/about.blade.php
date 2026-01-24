{{--
    Template-specifieke about voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Ons Verhaal';
    $subtitle = $content['subtitle'] ?? 'Een passie voor perfectie';
    $description = $content['description'] ?? 'Met meer dan vijftien jaar ervaring in de beauty industrie, creëren wij een verfijnde ervaring waar elke behandeling een moment van pure luxe is. Ons team van experts combineert vakmanschap met de nieuwste technieken.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $items = $content['items'] ?? [
        ['title' => 'Expertise', 'description' => 'Gecertificeerde specialisten', 'icon' => 'star'],
        ['title' => 'Kwaliteit', 'description' => 'Premium producten', 'icon' => 'heart'],
        ['title' => 'Ervaring', 'description' => 'Persoonlijke aandacht', 'icon' => 'sparkles'],
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';

    // Icon mapping
    $icons = [
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
    ];
@endphp

<section id="about" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            {{-- Image side --}}
            <div class="relative order-2 lg:order-1">
                <div class="relative">
                    @if($image)
                        {{-- Main image --}}
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover"
                        />
                        {{-- Decoratieve lijnen --}}
                        <div class="absolute top-6 left-6 right-6 bottom-6 border" style="border-color: {{ $secondaryColor }}20;"></div>
                    @else
                        {{-- Main image placeholder --}}
                        <div
                            class="relative w-full h-[500px] lg:h-[600px]"
                            style="background-color: {{ $accentColor }}50;"
                        >
                            {{-- Decoratieve lijnen --}}
                            <div class="absolute top-6 left-6 right-6 bottom-6 border" style="border-color: {{ $secondaryColor }}20;"></div>

                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16" style="color: {{ $secondaryColor }}20;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    @endif

                    {{-- Experience badge --}}
                    <div
                        class="absolute -bottom-6 -right-6 w-32 h-32 flex flex-col items-center justify-center text-center"
                        style="background-color: {{ $secondaryColor }};"
                    >
                        <span class="text-3xl font-light text-white" style="font-family: 'Playfair Display', Georgia, serif;">15+</span>
                        <span class="text-xs uppercase tracking-widest text-white opacity-80">Jaren</span>
                    </div>
                </div>
            </div>

            {{-- Content side --}}
            <div class="order-1 lg:order-2">
                {{-- Section label --}}
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-10 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                    <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Over Ons</span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-light mb-4 leading-tight"
                    style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-xl mb-8 italic font-light"
                    style="color: {{ $secondaryColor }}; opacity: 0.7;"
                >
                    "{{ $subtitle }}"
                </p>

                {{-- Description --}}
                <p
                    class="text-base mb-12 leading-relaxed"
                    style="color: {{ $textColor }}; opacity: 0.8;"
                >
                    {{ $description }}
                </p>

                {{-- Features --}}
                <div class="grid sm:grid-cols-3 gap-8 mb-12">
                    @foreach($items as $item)
                        <div class="text-center sm:text-left">
                            <div
                                class="w-14 h-14 mx-auto sm:mx-0 mb-4 flex items-center justify-center"
                                style="background-color: {{ $accentColor }};"
                            >
                                <svg class="w-6 h-6" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icons[$item['icon'] ?? 'star'] ?? $icons['star'] !!}
                                </svg>
                            </div>
                            <h4 class="text-sm font-medium uppercase tracking-wider mb-1" style="color: {{ $secondaryColor }};">
                                {{ $item['title'] }}
                            </h4>
                            <p class="text-sm" style="color: {{ $textColor }}; opacity: 0.6;">
                                {{ $item['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="inline-flex items-center gap-3 text-sm font-medium uppercase tracking-widest transition-all duration-300 group"
                    style="color: {{ $secondaryColor }};"
                >
                    <span class="border-b" style="border-color: {{ $secondaryColor }};">Maak kennis</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
