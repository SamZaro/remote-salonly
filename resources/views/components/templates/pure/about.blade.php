{{--
    Pure Template: About Section
    Natural & Botanical — split layout with transparent watermark text
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Onze Filosofie';
    $subtitle = $content['subtitle'] ?? 'Welkom bij onze salon';
    $description = $content['description'] ?? 'Wij zijn gepassioneerde kappers met jarenlange ervaring. Ons team staat klaar om jou de beste service te bieden.';
    $description2 = $content['description2'] ?? 'Met de juiste technieken en kwalitatieve producten zorgen we ervoor dat je altijd met een goed gevoel naar huis gaat.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="about" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Botanical leaf decoration --}}
    <div class="absolute top-12 right-8 opacity-[0.04]">
        <svg class="w-36 h-36" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
        </svg>
    </div>
    <div class="absolute bottom-16 left-6 opacity-[0.03]">
        <svg class="w-24 h-24" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header with watermark --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >About Us</span>

            <span
                class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
            >
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl md:text-5xl font-bold mb-5"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;"
            >
                {{ $title }}
            </h2>
            <div class="w-16 h-px mx-auto" style="background-color: {{ $primaryColor }};"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Image --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-30px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($image)
                    <div class="relative">
                        <img
                            src="{{ $image }}"
                            alt="Over ons"
                            class="w-full h-[460px] lg:h-[560px] object-cover rounded-none"
                        />
                        {{-- Accent border frame --}}
                        <div
                            class="absolute -bottom-4 -right-4 w-full h-full rounded-none -z-10"
                            style="border: 2px solid {{ $primaryColor }};"
                        ></div>
                    </div>
                @else
                    <div
                        class="w-full h-[460px] lg:h-[560px] flex items-center justify-center rounded-none relative"
                        style="background-color: {{ $accentColor }}30;"
                    >
                        <svg class="w-16 h-16" style="color: {{ $primaryColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div
                            class="absolute -bottom-4 -right-4 w-full h-full rounded-none -z-10"
                            style="border: 2px solid {{ $primaryColor }};"
                        ></div>
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(30px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                <p
                    class="text-lg mb-6 leading-relaxed"
                    style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    {{ $description }}
                </p>
                <p
                    class="text-lg mb-10 leading-relaxed"
                    style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    {{ $description2 }}
                </p>

                {{-- Small feature highlights --}}
                <div class="grid grid-cols-2 gap-6 mb-10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background-color: {{ $accentColor }}30;">
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold" style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Gecertificeerd team</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0" style="background-color: {{ $accentColor }}30;">
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold" style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Natuurlijke producten</span>
                    </div>
                </div>

                <a
                    href="#contact"
                    class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 rounded-none"
                    style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                    onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
                    onmouseout="this.style.backgroundColor='{{ $secondaryColor }}'; this.style.color='{{ $backgroundColor }}';"
                >
                    Neem contact op
                    <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
