{{--
    Wave Template: About Section
    "Coastal Minimal" — asymmetric layout, rounded image, floating stats, wave accent
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Over Onze Salon';
    $subtitle = $content['subtitle'] ?? 'Waar creativiteit en vakmanschap samenkomen';
    $description = $content['description'] ?? 'Bij ons draait alles om jou. Ons team van ervaren stylisten combineert de nieuwste trends met tijdloze technieken om een look te creëren die perfect bij jou past.';
    $description2 = $content['description2'] ?? 'Met jarenlange ervaring en een passie voor ons vak zorgen we ervoor dat je onze salon altijd verlaat met een glimlach en fantastisch haar.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats = $content['stats'] ?? [
        ['value' => '10+', 'label' => 'Jaar ervaring'],
        ['value' => '5000+', 'label' => 'Tevreden klanten'],
        ['value' => '6', 'label' => 'Stylisten'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section id="about" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Decorative wave accent top-right --}}
    <div class="absolute top-0 right-0 w-1/3 h-full pointer-events-none opacity-[0.03]">
        <svg class="w-full h-full" viewBox="0 0 400 800" preserveAspectRatio="none" fill="none">
            <path d="M200,0 C350,100 100,200 300,300 C500,400 50,500 250,600 C450,700 100,800 400,800 L400,0 Z" fill="{{ $primaryColor }}"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Image column --}}
            <div
                class="relative order-2 lg:order-1"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($image)
                    <div class="relative">
                        {{-- Blue glow behind image --}}
                        <div
                            class="absolute -inset-4 rounded-3xl blur-2xl opacity-10"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }});"
                        ></div>

                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="relative w-full h-[420px] lg:h-[540px] object-cover rounded-2xl"
                            style="box-shadow: 0 20px 50px {{ $secondaryColor }}15;"
                        />

                        {{-- Accent border strip --}}
                        <div
                            class="absolute -right-3 top-8 bottom-8 w-1 rounded-full"
                            style="background: linear-gradient(to bottom, {{ $primaryColor }}, {{ $accentColor }}40);"
                        ></div>
                    </div>
                @else
                    <div class="relative">
                        <div
                            class="absolute -inset-4 rounded-3xl blur-2xl opacity-5"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }});"
                        ></div>
                        <div
                            class="relative w-full h-[420px] lg:h-[540px] flex items-center justify-center rounded-2xl"
                            style="background-color: {{ $primaryColor }}05; border: 1px dashed {{ $primaryColor }}15;"
                        >
                            <div class="text-center">
                                <svg class="w-14 h-14 mx-auto mb-3" style="color: {{ $primaryColor }}20;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-[11px] uppercase tracking-[0.2em]" style="color: {{ $textColor }}60;">Team foto</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Floating stats card --}}
                <div
                    class="absolute -bottom-6 left-4 right-4 lg:left-8 lg:right-8"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                >
                    <div
                        class="flex items-center justify-between rounded-xl p-5 lg:p-6"
                        style="background-color: #ffffff; box-shadow: 0 8px 30px {{ $secondaryColor }}10; border: 1px solid {{ $primaryColor }}08;"
                    >
                        @foreach($stats as $index => $stat)
                            <div class="text-center flex-1" style="{{ $index < count($stats) - 1 ? 'border-right: 1px solid ' . $primaryColor . '10;' : '' }}">
                                <span
                                    class="block text-2xl lg:text-3xl font-bold"
                                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;"
                                >
                                    {{ $stat['value'] }}
                                </span>
                                <span class="block text-[10px] uppercase tracking-[0.12em] mt-1" style="color: {{ $textColor }};">
                                    {{ $stat['label'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Content column --}}
            <div
                class="order-1 lg:order-2"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Overline --}}
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, {{ $primaryColor }}, {{ $accentColor }});"></div>
                    <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                        Over Ons
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15] mb-4"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p
                    class="text-lg mb-6 font-medium"
                    style="color: {{ $accentColor }};"
                >
                    {{ $subtitle }}
                </p>

                {{-- Body text --}}
                <p class="text-[15px] mb-4 leading-[1.8]" style="color: {{ $textColor }};">
                    {{ $description }}
                </p>
                <p class="text-[15px] mb-8 leading-[1.8]" style="color: {{ $textColor }};">
                    {{ $description2 }}
                </p>

                {{-- Feature highlights --}}
                <div class="grid sm:grid-cols-2 gap-3 mb-8">
                    @foreach(['Gecertificeerde stylisten', 'Premium producten', 'Persoonlijk advies', 'Ontspannen sfeer'] as $index => $feature)
                        <div
                            class="flex items-center gap-3 px-4 py-3 rounded-lg"
                            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                            style="background-color: {{ $primaryColor }}05; opacity: 0; transform: translateX(-8px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ 0.4 + ($index * 0.08) }}s;"
                        >
                            <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-[13px] font-medium" style="color: {{ $headingColor }};">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="group inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold rounded-full transition-all duration-300 hover:shadow-md hover:-translate-y-0.5"
                    style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 2px 12px {{ $primaryColor }}30;"
                >
                    Maak kennis met ons team
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
