{{--
    Template-specifieke about sectie voor Blossom (Luxury Beauty Salon)

    Our Beauty Salon - luxe vrouwelijke stijl
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Onze Beauty Salon';
    $subtitle = $content['subtitle'] ?? 'Waar schoonheid en welzijn samenkomen';
    $description = $content['description'] ?? 'Bij Blossom geloven we dat elke vrouw verdient om zich prachtig te voelen. Onze salon is een oase van rust waar je kunt ontsnappen aan de drukte van alledag en jezelf kunt laten verwennen door onze ervaren beauty experts.';
    $description2 = $content['description2'] ?? 'Met de nieuwste technieken en premium producten zorgen we ervoor dat je onze salon altijd verlaat met een stralende glimlach en het perfecte resultaat.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats = $content['stats'] ?? [
        ['value' => '12+', 'label' => 'Jaar ervaring'],
        ['value' => '2000+', 'label' => 'Happy clients'],
        ['value' => '8', 'label' => 'Beauty experts'],
    ];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $lightBg = '#fdf8f8';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section id="about" class="py-20 lg:py-28" style="background-color: {{ $lightBg }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Image --}}
            <div
                class="relative order-2 lg:order-1"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($image)
                    <div class="relative">
                        {{-- Decorative background --}}
                        <div
                            class="absolute -inset-4 rounded-[2rem] opacity-30 blur-2xl"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        ></div>
                        {{-- Main image --}}
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover rounded-[2rem] shadow-2xl"
                        />
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div
                            class="absolute -inset-4 rounded-[2rem] opacity-20 blur-2xl"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        ></div>
                        <div
                            class="relative w-full h-[500px] lg:h-[600px] rounded-[2rem] flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15);"
                        >
                            <div class="text-center">
                                <svg class="w-24 h-24 mx-auto mb-4" style="color: {{ $primaryColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span style="color: {{ $primaryColor }}60;">Salon foto</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Stats card --}}
                <div
                    class="absolute -bottom-6 left-6 right-6 lg:left-auto lg:right-auto lg:-right-6 lg:w-80 p-6 rounded-2xl bg-white shadow-xl grid grid-cols-3 gap-4"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="box-shadow: 0 20px 60px {{ $primaryColor }}15; opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                >
                    @foreach($stats as $stat)
                        <div class="text-center">
                            <span
                                class="block text-2xl lg:text-3xl font-bold"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-family: '{{ $headingFont }}', Georgia, serif;"
                            >
                                {{ $stat['value'] }}
                            </span>
                            <span class="block text-xs mt-1" style="color: {{ $textColor }}; opacity: 0.6;">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- Decorative flower --}}
                <div
                    class="absolute -top-4 -left-4 w-16 h-16 rounded-full hidden lg:flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $accentColor }}, {{ $primaryColor }}30);"
                >
                    <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm0-18c-1.1 0-2 .9-2 2v1.17c-2.36.58-4 2.71-4 5.33 0 2.08.85 3.97 2.22 5.33L12 21l3.78-7.17C17.15 12.47 18 10.58 18 8.5c0-2.62-1.64-4.75-4-5.33V4c0-1.1-.9-2-2-2z"/>
                    </svg>
                </div>
            </div>

            {{-- Content --}}
            <div
                class="order-1 lg:order-2"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Label --}}
                <span
                    class="inline-flex items-center gap-2 text-sm font-medium mb-6 px-5 py-2 rounded-full"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Over Ons
                </span>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                    style="color: {{ $textColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-xl mb-8 italic font-medium"
                    style="color: {{ $primaryColor }};"
                >
                    "{{ $subtitle }}"
                </p>

                {{-- Description --}}
                <p class="text-lg mb-6 leading-relaxed" style="color: {{ $textColor }}; opacity: 0.8;">
                    {{ $description }}
                </p>
                <p class="text-lg mb-10 leading-relaxed" style="color: {{ $textColor }}; opacity: 0.8;">
                    {{ $description2 }}
                </p>

                {{-- Features --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-10">
                    @foreach(['Premium producten', 'Ervaren stylisten', 'Persoonlijke aanpak', 'Ontspannen sfeer'] as $feature)
                        <div
                            class="flex items-center gap-3 p-4 rounded-xl"
                            style="background-color: {{ $backgroundColor }};"
                        >
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20);"
                            >
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="font-medium" style="color: {{ $textColor }};">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}40;"
                >
                    Maak kennis met ons team
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
