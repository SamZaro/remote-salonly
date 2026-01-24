{{--
    Template-specifieke about sectie voor Coupe (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Over Ons';
    $subtitle = $content['subtitle'] ?? 'Meer dan knippen. Een stijl die bij jou past.';
    $description = $content['description'] ?? 'Bij ons draait alles om vakmanschap en persoonlijke aandacht. Wij geloven dat je haar meer is dan alleen een kapsel - het is een uitdrukking van wie je bent.';
    $description2 = $content['description2'] ?? 'Ons team van ervaren stylisten combineert klassieke technieken met hedendaagse trends om jouw unieke stijl tot leven te brengen.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats = $content['stats'] ?? [
        ['value' => '15+', 'label' => 'Jaar ervaring'],
        ['value' => '3000+', 'label' => 'Tevreden klanten'],
        ['value' => '8', 'label' => 'Vakspecialisten'],
    ];

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents, decoratieve elementen
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings
@endphp

<section id="about" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            {{-- Image --}}
            <div class="relative order-2 lg:order-1">
                @if($image)
                    <div class="relative">
                        {{-- Decorative frame --}}
                        <div
                            class="absolute -top-4 -left-4 w-full h-full border"
                            style="border-color: {{ $primaryColor }};"
                        ></div>
                        {{-- Main image --}}
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[550px] lg:h-[650px] object-cover grayscale hover:grayscale-0 transition-all duration-700"
                        />
                        {{-- Gold accent corner --}}
                        <div
                            class="absolute -bottom-4 -right-4 w-24 h-24"
                            style="background-color: {{ $primaryColor }};"
                        ></div>
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div
                            class="absolute -top-4 -left-4 w-full h-full border"
                            style="border-color: {{ $primaryColor }};"
                        ></div>
                        <div
                            class="relative w-full h-[550px] lg:h-[650px] flex items-center justify-center"
                            style="background-color: {{ $secondaryColor }}10;"
                        >
                            <div class="text-center">
                                <svg class="w-20 h-20 mx-auto mb-4" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span style="color: {{ $textColor }};">Salon foto</span>
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-4 -right-4 w-24 h-24"
                            style="background-color: {{ $primaryColor }};"
                        ></div>
                    </div>
                @endif

                {{-- Stats bar --}}
                <div
                    class="absolute bottom-8 left-8 right-8 lg:left-12 lg:right-auto p-8 backdrop-blur-sm"
                    style="background-color: {{ $secondaryColor }}F0;"
                >
                    <div class="flex items-center gap-8">
                        @foreach($stats as $index => $stat)
                            <div class="text-center {{ $index > 0 ? 'border-l border-white/20 pl-8' : '' }}">
                                <span
                                    class="block text-3xl lg:text-4xl font-light tracking-tight"
                                    style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                                >
                                    {{ $stat['value'] }}
                                </span>
                                <span class="block text-xs uppercase tracking-widest mt-1 text-white/60">
                                    {{ $stat['label'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="order-1 lg:order-2">
                {{-- Label --}}
                <div class="flex items-center gap-4 mb-8">
                    <div class="h-px w-12" style="background-color: {{ $primaryColor }};"></div>
                    <span
                        class="text-xs font-medium uppercase tracking-[0.3em]"
                        style="color: {{ $primaryColor }};"
                    >
                        Onze Salon
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-4xl sm:text-5xl lg:text-6xl font-light mb-8 leading-tight"
                    style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-xl lg:text-2xl mb-8 font-light italic"
                    style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    "{{ $subtitle }}"
                </p>

                {{-- Description --}}
                <p class="text-lg mb-6 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $description }}
                </p>
                <p class="text-lg mb-12 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $description2 }}
                </p>

                {{-- Features --}}
                <div class="grid sm:grid-cols-2 gap-6 mb-12">
                    @foreach(['Persoonlijk advies', 'Premium producten', 'Ervaren stylisten', 'Ontspannen sfeer'] as $feature)
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 flex items-center justify-center"
                                style="background-color: {{ $primaryColor }}15;"
                            >
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="font-medium" style="color: {{ $headingColor }};">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="group inline-flex items-center gap-4 text-sm font-medium uppercase tracking-widest transition-all duration-300"
                    style="color: {{ $headingColor }};"
                >
                    <span class="border-b-2 pb-1 transition-colors" style="border-color: {{ $primaryColor }};">
                        Ontdek onze salon
                    </span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
