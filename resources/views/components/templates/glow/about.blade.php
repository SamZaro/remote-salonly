{{--
    Glow Template: About Section
    Warm minimalist — clean two-column layout, no stats overlay or decorative accents
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Over Onze Salon';
    $subtitle = $content['subtitle'] ?? 'Waar vakmanschap en persoonlijke aandacht samenkomen';
    $description = $content['description'] ?? 'Wij geloven dat iedereen verdient om zich goed te voelen. Onze salon is een plek waar je kunt ontspannen en jezelf kunt laten verwennen door ervaren vakmensen.';
    $description2 = $content['description2'] ?? 'Met de juiste technieken en kwalitatieve producten zorgen we ervoor dat je altijd met een goed gevoel naar huis gaat.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
@endphp

<section id="about" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Image --}}
            <div
                class="order-2 lg:order-1"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
            >
                @if($image)
                    <img
                        src="{{ $image }}"
                        alt="Over ons"
                        class="w-full h-[460px] lg:h-[560px] object-cover"
                        style="border-radius: 12px;"
                    />
                @else
                    <div
                        class="w-full h-[460px] lg:h-[560px] flex items-center justify-center"
                        style="background-color: {{ $primaryColor }}; border-radius: 12px;"
                    >
                        <svg class="w-16 h-16" style="color: {{ $secondaryColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Content --}}
            <div
                class="order-1 lg:order-2"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out 0.1s;"
            >
                <span
                    class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block"
                    style="color: {{ $secondaryColor }};"
                >
                    Over Ons
                </span>

                <h2
                    class="text-4xl sm:text-5xl font-bold mb-4"
                    style="color: {{ $headingColor }}; font-family: 'Raleway', sans-serif;"
                >
                    {{ $title }}
                </h2>

                <p class="text-xl mb-8 italic" style="color: {{ $secondaryColor }};">
                    {{ $subtitle }}
                </p>

                <p class="text-lg mb-5 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $description }}
                </p>
                <p class="text-lg mb-10 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $description2 }}
                </p>

                <a
                    href="#contact"
                    class="inline-flex items-center text-sm font-semibold tracking-wide uppercase transition-opacity hover:opacity-70"
                    style="color: {{ $secondaryColor }};"
                >
                    Neem contact op
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
