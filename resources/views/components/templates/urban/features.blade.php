{{--
    Urban Template: Features Section
    Dark section — numbered cards with transparent gold borders
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title    = $content['title'] ?? 'Waarom Kiezen Voor Ons';
    $subtitle = $content['subtitle'] ?? 'Wat ons onderscheidt van de rest';
    $items    = $content['items'] ?? [
        ['title' => 'Traditioneel Vakmanschap', 'description' => 'Klassieke barbertechnieken gecombineerd met hedendaagse stijlen voor het perfecte resultaat.', 'icon' => 'scissors'],
        ['title' => 'Persoonlijke Service',     'description' => 'Elk bezoek begint met een persoonlijk consult om jouw wensen helder te krijgen.', 'icon' => 'chat'],
        ['title' => 'Premium Producten',        'description' => 'Uitsluitend professionele producten van de hoogste kwaliteit voor het beste resultaat.', 'icon' => 'sparkles'],
        ['title' => 'Ontspannen Sfeer',         'description' => 'Een relaxte omgeving waar je even helemaal tot rust kunt komen en jezelf bent.', 'icon' => 'heart'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';

    $icons = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'chat'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/>',
        'heart'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
    ];
@endphp

<section id="features" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Section header --}}
        <div
            class="mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                    Onze kenmerken
                </span>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <h2
                    class="font-black uppercase leading-[0.9]"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: #ffffff;"
                >
                    {{ $title }}
                </h2>
                <p class="text-base max-w-xs lg:text-right" style="color: rgba(255,255,255,0.45); font-family: '{{ $bodyFont }}';">
                    {{ $subtitle }}
                </p>
            </div>
        </div>

        {{-- Features grid --}}
        <div class="grid gap-px sm:grid-cols-2 lg:grid-cols-4" style="background-color: {{ $primaryColor }}15;">
            @foreach($items as $item)
                <div
                    class="group relative p-8 lg:p-10 flex flex-col transition-colors duration-300"
                    style="background-color: {{ $secondaryColor }}; opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, background-color 0.3s ease;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    onmouseover="this.style.backgroundColor='{{ $primaryColor }}10'"
                    onmouseout="this.style.backgroundColor='{{ $secondaryColor }}'"
                >
                    {{-- Number --}}
                    <span
                        class="block font-black mb-6 leading-none"
                        style="font-family: '{{ $headingFont }}'; font-size: 3.5rem; color: {{ $primaryColor }}20; letter-spacing: -0.03em;"
                    >
                        {{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    {{-- Icon --}}
                    <div class="mb-6">
                        <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3
                        class="text-lg font-bold uppercase tracking-wide mb-3"
                        style="color: #ffffff; font-family: '{{ $headingFont }}';"
                    >
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-sm leading-relaxed mt-auto" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">
                        {{ $item['description'] }}
                    </p>

                    {{-- Bottom gold line on hover --}}
                    <div class="absolute bottom-0 left-0 w-0 h-px group-hover:w-full transition-all duration-500" style="background-color: {{ $primaryColor }};"></div>
                </div>
            @endforeach
        </div>
    </div>
</section>
