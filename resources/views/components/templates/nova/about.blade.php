@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Alle stijlen en snel geknipt';
    $subtitle = $content['subtitle'] ?? 'De beste kapperszaak van de omgeving.';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $ctaPrimary = $content['cta_primary'] ?? ['text' => 'Maak een afspraak', 'url' => '#contact'];
    $ctaSecondary = $content['cta_secondary'] ?? ['text' => 'Openingstijden', 'url' => '#contact'];

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#14B8A6';       // teal-500 equivalent
    $backgroundColor = $theme['background_color'] ?? '#57534E'; // stone-600 equivalent
    $textColor = $theme['text_color'] ?? '#E7E5E4';             // stone-200 equivalent
    $headingColor = $theme['heading_color'] ?? '#E7E5E4';
    $buttonHoverBg = $theme['button_hover_bg'] ?? '#57534E';    // stone-600
@endphp

<section id="about" class="py-16 lg:py-40" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-screen-xl px-4 mx-auto flex flex-col items-center text-center lg:grid lg:grid-cols-12 lg:gap-20">

        {{-- Afbeelding --}}
        <div class="lg:col-span-6 flex justify-center w-full">
            @if($image)
                <img
                    src="{{ $image }}"
                    class="rounded-lg w-full h-auto object-cover"
                    alt="{{ $title }}"
                >
            @else
                <div
                    class="w-full aspect-video rounded-lg flex items-center justify-center"
                    style="background-color: rgba(0,0,0,0.2);"
                >
                    <svg class="w-16 h-16 opacity-40" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </div>

        {{-- Tekst en CTA --}}
        <div class="lg:col-span-6 flex flex-col items-center lg:items-start text-center lg:text-left mt-8 lg:mt-0">
            <h2
                class="max-w-2xl mb-4 text-3xl sm:text-4xl font-extrabold"
                style="color: {{ $headingColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $title }}
            </h2>

            <p
                class="max-w-2xl mb-6 font-light text-base sm:text-lg lg:text-xl"
                style="color: {{ $textColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $subtitle }}
            </p>

            {{-- CTA Knoppen --}}
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <a
                    href="{{ $ctaPrimary['url'] }}"
                    class="w-full sm:w-auto rounded-sm px-5 py-3 overflow-hidden relative group cursor-pointer font-medium text-white inline-flex items-center justify-center transition duration-300"
                    style="background-color: {{ $primaryColor }};"
                    x-intersect="$el.classList.add('fadeInUp')"
                    onmouseenter="this.style.backgroundColor='{{ $buttonHoverBg }}'"
                    onmouseleave="this.style.backgroundColor='{{ $primaryColor }}'"
                >
                    {{ $ctaPrimary['text'] }}
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>

                <a
                    href="{{ $ctaSecondary['url'] }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-3 text-base font-medium border transition duration-300"
                    style="color: {{ $textColor }}; border-color: {{ $textColor }};"
                    onmouseenter="this.style.backgroundColor='{{ $buttonHoverBg }}'"
                    onmouseleave="this.style.backgroundColor='transparent'"
                >
                    {{ $ctaSecondary['text'] }}
                </a>
            </div>
        </div>
    </div>
</section>
