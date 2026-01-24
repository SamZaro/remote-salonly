{{--
    Template-specifieke about sectie voor Icon (Hair Salon)

    Over ons met grayscale foto
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Over Icon Salon';
    $subtitle = $content['subtitle'] ?? 'Waar passie en vakmanschap samenkomen';
    $description = $content['description'] ?? 'Bij Icon geloven we dat iedereen een look verdient die past bij wie ze zijn. Ons team van ervaren stylisten combineert de nieuwste trends met tijdloze technieken om jouw perfecte stijl te creëren.';
    $description2 = $content['description2'] ?? 'Met jarenlange ervaring en een passie voor ons vak, zorgen we ervoor dat je onze salon altijd verlaat met een glimlach én fantastisch haar.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats = $content['stats'] ?? [
        ['value' => '10+', 'label' => 'Jaar ervaring'],
        ['value' => '5000+', 'label' => 'Tevreden klanten'],
        ['value' => '6', 'label' => 'Stylisten'],
    ];

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8fafc';
@endphp

<section id="about" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Image --}}
            <div class="relative order-2 lg:order-1">
                @if($image)
                    <div class="relative">
                        {{-- Decorative background --}}
                        <div
                            class="absolute -inset-4 rounded-3xl opacity-30 blur-2xl"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        ></div>
                        {{-- Main image with grayscale --}}
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover rounded-3xl grayscale shadow-2xl"
                        />
                        {{-- Gradient overlay for subtle color --}}
                        <div
                            class="absolute inset-0 rounded-3xl mix-blend-overlay opacity-30"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        ></div>
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div
                            class="absolute -inset-4 rounded-3xl opacity-20 blur-2xl"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        ></div>
                        <div
                            class="relative w-full h-[500px] lg:h-[600px] rounded-3xl flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10);"
                        >
                            <div class="text-center">
                                <svg class="w-24 h-24 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-400">Team foto</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Stats card --}}
                <div
                    class="absolute -bottom-6 left-6 right-6 lg:left-auto lg:right-auto lg:-right-6 lg:w-80 p-6 rounded-2xl bg-white shadow-xl grid grid-cols-3 gap-4"
                    style="box-shadow: 0 20px 60px rgba(0,0,0,0.1);"
                >
                    @foreach($stats as $stat)
                        <div class="text-center">
                            <span
                                class="block text-2xl lg:text-3xl font-bold"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"
                            >
                                {{ $stat['value'] }}
                            </span>
                            <span class="block text-xs text-gray-500 mt-1">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Content --}}
            <div class="order-1 lg:order-2">
                {{-- Label --}}
                <span
                    class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
                >
                    Over Ons
                </span>

                {{-- Title --}}
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-xl mb-8 font-medium"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"
                >
                    {{ $subtitle }}
                </p>

                {{-- Description --}}
                <p class="text-lg mb-6 text-gray-600 leading-relaxed">
                    {{ $description }}
                </p>
                <p class="text-lg mb-10 text-gray-600 leading-relaxed">
                    {{ $description2 }}
                </p>

                {{-- Features --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-10">
                    @foreach(['Gecertificeerde stylisten', 'Premium producten', 'Persoonlijk advies', 'Ontspannen sfeer'] as $index => $feature)
                        <div class="flex items-center gap-3 p-4 rounded-xl" style="background-color: {{ $backgroundColor }};">
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15);"
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
                    class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-semibold text-white transition-all duration-300 hover:scale-105 hover:shadow-xl"
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
