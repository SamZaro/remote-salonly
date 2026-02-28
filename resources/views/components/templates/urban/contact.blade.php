{{--
    Urban Template: Contact Section
    Dark section — 3-column info (address, phone, hours) + optional map
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title        = $content['title'] ?? 'Bezoek Ons';
    $subtitle     = $content['subtitle'] ?? 'Walk-ins welkom, afspraak aanbevolen';
    $address      = $content['address'] ?? 'Hoofdstraat 123, 1234 AB Amsterdam';
    $phone        = $content['phone'] ?? '020 - 123 4567';
    $email        = $content['email'] ?? '';
    $mapEmbed     = $content['map_embed'] ?? '';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => 'Maandag',   'hours' => 'Gesloten'],
        ['day' => 'Dinsdag',   'hours' => '09:00 - 18:00'],
        ['day' => 'Woensdag',  'hours' => '09:00 - 18:00'],
        ['day' => 'Donderdag', 'hours' => '09:00 - 21:00'],
        ['day' => 'Vrijdag',   'hours' => '09:00 - 18:00'],
        ['day' => 'Zaterdag',  'hours' => '09:00 - 17:00'],
        ['day' => 'Zondag',    'hours' => 'Gesloten'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Contact</span>
            </div>
            <h2
                class="font-black uppercase leading-[0.9]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: #ffffff;"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-lg" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        {{-- 3-column info --}}
        <div class="grid gap-px lg:grid-cols-3" style="background-color: rgba(255,255,255,0.06);">

            {{-- Address --}}
            <div
                class="p-8 lg:p-10"
                style="background-color: {{ $secondaryColor }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
            >
                <div class="w-10 h-10 flex items-center justify-center mb-6" style="background-color: {{ $primaryColor }};">
                    <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-black uppercase tracking-wide text-base mb-4" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';">
                    Adres
                </h3>
                <p class="text-base leading-relaxed mb-6" style="color: rgba(255,255,255,0.65); font-family: '{{ $bodyFont }}';">
                    {{ $address }}
                </p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="group inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest transition-opacity hover:opacity-70"
                    style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';"
                >
                    Route plannen
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            {{-- Phone --}}
            <div
                class="p-8 lg:p-10"
                style="background-color: {{ $primaryColor }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            >
                <div class="w-10 h-10 flex items-center justify-center mb-6 border" style="border-color: {{ $secondaryColor }}30;">
                    <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="font-black uppercase tracking-wide text-base mb-4" style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}';">
                    Bel Ons
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="block font-black transition-opacity hover:opacity-70 mb-4"
                    style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.75rem; letter-spacing: -0.02em;"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm" style="color: {{ $secondaryColor }}80; font-family: '{{ $bodyFont }}';">
                    Direct een afspraak maken? Bel ons!
                </p>
            </div>

            {{-- Hours --}}
            <div
                class="p-8 lg:p-10"
                style="background-color: #161616;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
            >
                <div class="w-10 h-10 flex items-center justify-center mb-6" style="background-color: {{ $primaryColor }};">
                    <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-black uppercase tracking-wide text-base mb-6" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';">
                    Openingstijden
                </h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        @php
                            $day      = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours    = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center">
                            <span class="text-sm" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">{{ $day }}</span>
                            <span class="text-sm font-semibold" style="color: {{ $isClosed ? 'rgba(255,255,255,0.2)' : $primaryColor }}; font-family: '{{ $bodyFont }}';">
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map --}}
        @if($mapEmbed)
            <div class="mt-4 aspect-[21/9] w-full overflow-hidden">
                {!! $mapEmbed !!}
            </div>
        @else
            <div
                class="mt-4 aspect-[21/9] w-full flex items-center justify-center"
                style="background-color: #111111;"
            >
                <div class="text-center">
                    <svg class="w-14 h-14 mx-auto mb-4 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="text-xs uppercase tracking-widest" style="color: rgba(255,255,255,0.2); font-family: '{{ $bodyFont }}';">Google Maps</span>
                </div>
            </div>
        @endif
    </div>
</section>
