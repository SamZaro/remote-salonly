{{--
    Urban Template: About Section
    Light section — full-height image left, editorial text right, clean stats row
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title        = $content['title'] ?? 'Ons Verhaal';
    $subtitle     = $content['subtitle'] ?? 'Sinds 2015 de vaste stek voor de moderne man';
    $description  = $content['description'] ?? 'Wat begon als een passie voor het vak, groeide uit tot een plek waar mannen terecht kunnen voor meer dan alleen een knipbeurt. Bij ons draait alles om vakmanschap, aandacht voor detail en een moment van rust.';
    $description2 = $content['description2'] ?? 'Onze barbers zijn opgeleid in zowel klassieke technieken als moderne trends. Of je nu komt voor een strakke fade, een traditionele scheerbeurt of gewoon een goed gesprek — je bent welkom.';
    $image        = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats        = $content['stats'] ?? [
        ['value' => '8+',   'label' => 'Jaar ervaring'],
        ['value' => '5k+',  'label' => 'Tevreden klanten'],
        ['value' => '4',    'label' => 'Vakbekwame barbers'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section id="about" class="relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    <div class="grid lg:grid-cols-2 min-h-[80vh]">

        {{-- Image column — full height, no padding --}}
        <div class="relative order-2 lg:order-1 min-h-[400px] lg:min-h-auto">
            @if($image)
                <img
                    src="{{ $image }}"
                    alt="Over ons"
                    class="absolute inset-0 w-full h-full object-cover"
                    style="filter: grayscale(20%) contrast(1.05);"
                />
                {{-- Subtle right-side gradient blend --}}
                <div class="absolute inset-0 lg:hidden" style="background: linear-gradient(to bottom, transparent 60%, {{ $backgroundColor }});"></div>
            @else
                <div class="absolute inset-0 flex items-center justify-center" style="background-color: {{ $secondaryColor }};">
                    <svg class="w-20 h-20 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </div>

        {{-- Text column --}}
        <div
            class="order-1 lg:order-2 flex flex-col justify-center px-8 sm:px-12 lg:px-16 xl:px-20 py-20 lg:py-28"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
            style="opacity: 0; transform: translateX(20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            {{-- Label --}}
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                    Over Ons
                </span>
            </div>

            {{-- Heading --}}
            <h2
                class="font-black uppercase leading-[0.9] mb-8"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>

            {{-- Description --}}
            <p class="text-lg leading-relaxed mb-5" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                {{ $description }}
            </p>
            @if($description2)
                <p class="text-lg leading-relaxed mb-10" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                    {{ $description2 }}
                </p>
            @endif

            {{-- CTA link --}}
            <div class="mb-14">
                <a
                    href="#contact"
                    class="group inline-flex items-center gap-3 font-bold uppercase tracking-widest text-sm transition-colors"
                    style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}';"
                >
                    Maak kennis
                    <span class="w-8 h-px transition-all duration-300 group-hover:w-14" style="background-color: {{ $primaryColor }};"></span>
                </a>
            </div>

            {{-- Stats row —  bottom --}}
            <div class="grid grid-cols-3 gap-8 pt-10 border-t" style="border-color: {{ $headingColor }}15;">
                @foreach($stats as $stat)
                    <div>
                        <span
                            class="block font-black uppercase leading-none mb-2"
                            style="font-family: '{{ $headingFont }}'; font-size: clamp(2rem, 4vw, 3rem); color: {{ $primaryColor }}; letter-spacing: -0.02em;"
                        >
                            {{ $stat['value'] }}
                        </span>
                        <span class="block text-xs uppercase tracking-[0.2em]" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                            {{ $stat['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
