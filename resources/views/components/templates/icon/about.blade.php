{{--
    Icon Template: About Section
    "Warm Atelier" — the reveal after the dark hero, warm light, editorial two-column
    Image with gold frame accent, overlapping stats bar, refined typography
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
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

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section id="about" class="py-24 lg:py-36 relative" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image column --}}
            <div
                class="relative order-2 lg:order-1"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-16px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($image)
                    <div class="relative">
                        {{-- Offset gold frame --}}
                        <div
                            class="absolute -bottom-3 -right-3 lg:-bottom-4 lg:-right-4 w-full h-full pointer-events-none"
                            style="border: 1px solid {{ $primaryColor }}25;"
                        ></div>
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[400px] lg:h-[540px] object-cover"
                            style="box-shadow: 0 16px 48px rgba(0,0,0,0.08);"
                        />
                    </div>
                @else
                    <div class="relative">
                        <div
                            class="absolute -bottom-3 -right-3 lg:-bottom-4 lg:-right-4 w-full h-full pointer-events-none"
                            style="border: 1px solid {{ $primaryColor }}15;"
                        ></div>
                        <div
                            class="relative w-full h-[400px] lg:h-[540px] flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}03; border: 1px solid {{ $primaryColor }}08;"
                        >
                            <div class="text-center">
                                <svg class="w-14 h-14 mx-auto mb-3" style="color: {{ $primaryColor }}18;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-[11px] uppercase tracking-[0.2em]" style="color: {{ $textColor }}50;">Team foto</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Stats bar overlapping image bottom --}}
                <div
                    class="relative -mt-10 mx-4 lg:mx-6 p-5 lg:p-6 flex items-center justify-between"
                    style="background-color: {{ $secondaryColor }}; box-shadow: 0 10px 36px rgba(0,0,0,0.12);"
                >
                    @foreach($stats as $index => $stat)
                        <div class="text-center flex-1 {{ $index < count($stats) - 1 ? 'border-r border-white/[0.06]' : '' }}">
                            <span
                                class="block text-xl lg:text-2xl"
                                style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                            >
                                {{ $stat['value'] }}
                            </span>
                            <span class="block text-[10px] uppercase tracking-[0.15em] text-white/35 mt-1">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Content column --}}
            <div
                class="order-1 lg:order-2"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Label --}}
                <div class="flex items-center gap-4 mb-8">
                    <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                    <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                        Over Ons
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-lg mb-7"
                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-style: italic;"
                >
                    {{ $subtitle }}
                </p>

                {{-- Gold divider --}}
                <div class="flex items-center gap-0 mb-7">
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                </div>

                {{-- Body text --}}
                <p class="text-[15px] mb-4 leading-[1.75]" style="color: {{ $textColor }};">
                    {{ $description }}
                </p>
                <p class="text-[15px] mb-9 leading-[1.75]" style="color: {{ $textColor }};">
                    {{ $description2 }}
                </p>

                {{-- Feature bullets --}}
                <div class="grid sm:grid-cols-2 gap-x-8 gap-y-3 mb-9">
                    @foreach(['Gecertificeerde stylisten', 'Premium producten', 'Persoonlijk advies', 'Ontspannen sfeer'] as $feature)
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 rounded-full shrink-0" style="background-color: {{ $primaryColor }};"></div>
                            <span class="text-[13px] font-medium" style="color: {{ $headingColor }};">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CTA link --}}
                <a
                    href="#contact"
                    class="group inline-flex items-center gap-3 text-[13px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 hover:gap-4"
                    style="color: {{ $primaryColor }};"
                >
                    Maak kennis met ons team
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
