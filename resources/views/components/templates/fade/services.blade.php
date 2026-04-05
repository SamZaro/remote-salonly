{{--
    Fade Template: Services Section
    Warm cream section — service cards with gold left border accent
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title    = $content['title'] ?? __('Our Services');
    $subtitle = $content['subtitle'] ?? __('Premium services');
    $items    = $content['items'] ?? [
        ['title' => __('Classic Cut'),        'description' => __('Precision cut with wash and styling'),             'price' => '€27', 'icon' => 'scissors'],
        ['title' => __('Skin Fade'),          'description' => __('Clean fade with sharp lines and detail'),          'price' => '€32', 'icon' => 'razor'],
        ['title' => __('Beard Trim'),         'description' => __('Shape and groom your beard to perfection'),        'price' => '€18', 'icon' => 'towel'],
        ['title' => __('Hot Towel Shave'),    'description' => __('Traditional straight razor shave experience'),     'price' => '€35', 'icon' => 'sparkles'],
        ['title' => __('Cut & Beard'),        'description' => __('Complete grooming: haircut and beard trim'),       'price' => '€42', 'icon' => 'star'],
        ['title' => __('Junior Cut'),         'description' => __('Haircut for young gentlemen (up to 12)'),          'price' => '€19', 'icon' => 'child'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor     = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';

    $icons = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'towel'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/>',
        'star'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'child'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
@endphp

<section id="services" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Section header --}}
        <div
            class="mb-16 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">{{ __('What we offer') }}</span>
                </div>
                <h2
                    class="font-bold uppercase leading-[0.85]"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(2.4rem, 4.5vw, 4rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
                >
                    {{ $title }}
                </h2>
            </div>
            <a
                href="#pricing"
                class="group inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-widest shrink-0 transition-colors"
                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                {{ __('Full price list') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Services grid — 3 columns, cards with left gold border --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($items as $item)
                <div
                    class="group flex items-center gap-5 p-6 border-l-2 transition-all duration-300"
                    style="
                        background-color: #ffffff;
                        border-left-color: transparent;
                        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
                        opacity: 0;
                        transform: translateY(16px);
                        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.08 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.08 }}s, border-color 0.3s ease, box-shadow 0.3s ease;
                    "
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    onmouseover="this.style.borderLeftColor='{{ $primaryColor }}'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.08)'"
                    onmouseout="this.style.borderLeftColor='transparent'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.04)'"
                >
                    {{-- Icon --}}
                    <div class="shrink-0">
                        <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <h3
                            class="text-base font-bold mb-0.5"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}';"
                        >
                            {{ $item['title'] }}
                        </h3>
                        <p class="text-sm font-light truncate" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                            {{ $item['description'] }}
                        </p>
                    </div>

                    {{-- Price --}}
                    <div class="shrink-0 text-right">
                        <span
                            class="font-bold text-xl"
                            style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; letter-spacing: -0.02em;"
                        >
                            {{ $item['price'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="mt-8 text-sm font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
            {{ __('All prices include VAT. Ask about our combination deals.') }}
        </p>
    </div>
</section>
