{{--
    Icon Template: Jumbotron Section
    "Warm Atelier" — dark cinematic full-width section, two-column grid, gold accents, stats grid
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Klaar voor een nieuwe look?';
    $subtitle = $content['subtitle'] ?? 'Onze stylisten staan voor je klaar om jouw droomkapsel te creëren';
    $ctaText = $content['cta_text'] ?? 'Boek Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    $stats = $content['stats'] ?? [
        ['value' => '10+', 'label' => 'Jaar ervaring'],
        ['value' => '5000+', 'label' => 'Tevreden klanten'],
        ['value' => '4.9', 'label' => 'Google rating'],
        ['value' => '6', 'label' => 'Stylisten'],
    ];
@endphp

<section id="jumbotron" class="relative py-24 lg:py-36 overflow-hidden" style="font-family: '{{ $bodyFont }}', sans-serif;">
    {{-- Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0" style="background-color: {{ $secondaryColor }}e8;"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background-color: {{ $secondaryColor }};"></div>
        {{-- Subtle radial gradient for depth --}}
        <div class="absolute inset-0" style="background: radial-gradient(ellipse at 30% 50%, {{ $secondaryColor }} 0%, #0d0d0d 100%);"></div>
    @endif

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Left column: content --}}
            <div>
                {{-- Gold-line label --}}
                <div
                    class="flex items-center gap-4 mb-8"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
                >
                    <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                    <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                        Jouw nieuwe look wacht
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-5xl leading-[1.1] mb-6"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600; opacity: 0; transform: translateY(16px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
                >
                    {!! $title !!}
                </h2>

                {{-- Gold divider --}}
                <div
                    class="flex items-center gap-0 mb-6"
                    x-data x-intersect.once="$el.style.opacity = 1"
                    style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
                >
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                </div>

                {{-- Subtitle --}}
                @if($subtitle)
                    <p
                        class="text-[15px] sm:text-base leading-relaxed mb-10 max-w-lg"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="color: {{ $backgroundColor }}70; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                    >
                        {{ $subtitle }}
                    </p>
                @endif

                {{-- CTA buttons --}}
                <div
                    class="flex flex-col sm:flex-row items-start gap-4"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.4s;"
                >
                    {{-- Primary CTA --}}
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center justify-center px-8 py-4 text-[12px] font-semibold uppercase tracking-[0.2em] text-white transition-all duration-300 hover:brightness-110"
                        style="background-color: {{ $primaryColor }}; box-shadow: 0 4px 24px {{ $primaryColor }}25;"
                    >
                        {{ $ctaText }}
                        <svg class="w-3.5 h-3.5 ml-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>

                    {{-- Secondary CTA --}}
                    <a
                        href="#services"
                        class="inline-flex items-center justify-center px-8 py-4 text-[12px] font-medium uppercase tracking-[0.2em] transition-all duration-300 hover:bg-white/5"
                        style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
                    >
                        Bekijk diensten
                    </a>
                </div>
            </div>

            {{-- Right column: stats grid (lg only) --}}
            <div
                class="hidden lg:grid grid-cols-2"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
            >
                @foreach($stats as $index => $stat)
                    @php
                        $isTop = $index < 2;
                        $isLeft = $index % 2 === 0;
                        $borderClasses = '';
                        if ($isTop) $borderClasses .= ' border-b';
                        if ($isLeft) $borderClasses .= ' border-r';
                        $staggerDelay = 0.35 + $index * 0.1;
                    @endphp
                    <div
                        class="p-8 text-center{{ $borderClasses }}"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="border-color: {{ $backgroundColor }}08; opacity: 0; transform: translateY(12px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) {{ $staggerDelay }}s;"
                    >
                        <span
                            class="block text-3xl lg:text-4xl mb-2"
                            style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                        >
                            {{ $stat['value'] }}
                        </span>
                        <span class="block text-[10px] uppercase tracking-[0.2em]" style="color: {{ $backgroundColor }}40;">
                            {{ $stat['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
