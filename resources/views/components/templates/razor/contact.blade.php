{{--
    Template-specifieke contact sectie voor Razor (Barbershop)

    Adres, telefoonnummer en openingstijden (geen contactformulier)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Bezoek Ons';
    $subtitle = $content['subtitle'] ?? 'Walk-ins welkom, afspraak aanbevolen';
    $address = $content['address'] ?? 'Hoofdstraat 123, 1234 AB Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? '';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => 'Maandag', 'hours' => 'Gesloten'],
        ['day' => 'Dinsdag', 'hours' => '09:00 - 18:00'],
        ['day' => 'Woensdag', 'hours' => '09:00 - 18:00'],
        ['day' => 'Donderdag', 'hours' => '09:00 - 21:00'],
        ['day' => 'Vrijdag', 'hours' => '09:00 - 18:00'],
        ['day' => 'Zaterdag', 'hours' => '09:00 - 17:00'],
        ['day' => 'Zondag', 'hours' => 'Gesloten'],
    ];
    $mapEmbed = $content['map_embed'] ?? '';

    // Theme kleuren met defaults (consistent met shadow pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    // Lichte tekstkleur voor donkere achtergronden (consistent patroon)
    $lightTextColor = '#ffffff';
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                Contact
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <p class="text-lg opacity-70" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Adres --}}
            <div
                class="p-8 text-center transition-all duration-300 hover:-translate-y-1"
                style="background-color: {{ $secondaryColor }};"
            >
                <div
                    class="w-16 h-16 mx-auto mb-6 flex items-center justify-center"
                    style="background-color: {{ $primaryColor }};"
                >
                    <svg class="w-8 h-8" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold uppercase tracking-wider mb-4" style="color: {{ $lightTextColor }};">
                    Adres
                </h3>
                <p class="leading-relaxed" style="color: {{ $lightTextColor }}; opacity: 0.8;">
                    {{ $address }}
                </p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 mt-6 text-sm font-bold uppercase tracking-wider transition-colors hover:opacity-80"
                    style="color: {{ $primaryColor }};"
                >
                    Route plannen
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            {{-- Telefoon --}}
            <div
                class="p-8 text-center transition-all duration-300 hover:-translate-y-1"
                style="background-color: {{ $primaryColor }};"
            >
                <div
                    class="w-16 h-16 mx-auto mb-6 flex items-center justify-center border-2"
                    style="border-color: {{ $secondaryColor }};"
                >
                    <svg class="w-8 h-8" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold uppercase tracking-wider mb-4" style="color: {{ $secondaryColor }};">
                    Bel Ons
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="text-2xl font-bold block transition-colors hover:opacity-80"
                    style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm mt-4 opacity-70" style="color: {{ $secondaryColor }};">
                    Direct een afspraak maken? Bel ons!
                </p>
            </div>

            {{-- Openingstijden --}}
            <div
                class="p-8 text-center transition-all duration-300 hover:-translate-y-1"
                style="background-color: {{ $secondaryColor }};"
            >
                <div
                    class="w-16 h-16 mx-auto mb-6 flex items-center justify-center"
                    style="background-color: {{ $primaryColor }};"
                >
                    <svg class="w-8 h-8" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold uppercase tracking-wider mb-4" style="color: {{ $lightTextColor }};">
                    Openingstijden
                </h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center text-sm">
                            <span style="color: {{ $lightTextColor }}; opacity: 0.7;">{{ $day }}</span>
                            <span style="color: {{ $isClosed ? $lightTextColor : $primaryColor }}; opacity: {{ $isClosed ? '0.4' : '1' }};">
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map embed --}}
        @if($mapEmbed)
            <div class="mt-12">
                <div class="aspect-[21/9] w-full">
                    {!! $mapEmbed !!}
                </div>
            </div>
        @else
            {{-- Placeholder map --}}
            <div
                class="mt-12 aspect-[21/9] w-full flex items-center justify-center"
                style="background-color: {{ $secondaryColor }};"
            >
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="text-sm uppercase tracking-widest" style="color: {{ $lightTextColor }}; opacity: 0.6;">Google Maps</span>
                </div>
            </div>
        @endif

        {{-- Bottom note --}}
        <div class="mt-12 text-center">
            <p class="text-sm opacity-60" style="color: {{ $textColor }};">
                Gratis parkeren mogelijk in de omgeving. Rolstoeltoegankelijk.
            </p>
        </div>
    </div>
</section>
