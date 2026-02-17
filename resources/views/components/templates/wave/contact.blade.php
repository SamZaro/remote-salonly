{{--
    Template-specifieke contact sectie voor Wave (High-End Salon)

    Luxe & Chic met editorial fashion feel
    Kleuren: Zwart #0F0F0F, Off-white #F5F3EF, Champagne goud #C8B88A, Warm grijs #8A8A8A
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Contact';
    $subtitle = $content['subtitle'] ?? 'Bezoek Ons';
    $address = $content['address'] ?? 'Herengracht 456, 1017 CA Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? 'info@wave-salon.nl';
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

    // Theme kleuren - consistent met color scheme
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';      // Accents
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F'; // Donkere secties
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';       // Hover states
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF'; // Lichte secties
    $textColor = $theme['text_color'] ?? '#6B6B6B';           // Body tekst
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';     // Headings
@endphp

<section id="contact" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="max-w-3xl mx-auto text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
                <span
                    class="text-xs font-medium uppercase tracking-[0.3em]"
                    style="color: {{ $primaryColor }};"
                >
                    {{ $subtitle }}
                </span>
                <div class="h-px w-16" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-light"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Contact grid --}}
        <div class="grid lg:grid-cols-3 gap-8 mb-16">
            {{-- Adres --}}
            <div class="text-center p-10 border transition-all duration-300 hover:-translate-y-1" style="border-color: {{ $secondaryColor }}10; background-color: #ffffff;">
                <div
                    class="w-16 h-16 mx-auto mb-6 flex items-center justify-center"
                    style="background-color: {{ $primaryColor }};"
                >
                    <svg class="w-7 h-7" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg font-light mb-4"
                    style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    Adres
                </h3>
                <p class="mb-6" style="color: {{ $textColor }};">
                    {{ $address }}
                </p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 text-xs font-medium uppercase tracking-widest transition-colors"
                    style="color: {{ $primaryColor }};"
                >
                    Route plannen
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            {{-- Telefoon --}}
            <div
                class="text-center p-10 transition-all duration-300 hover:-translate-y-1"
                style="background-color: {{ $secondaryColor }};"
            >
                <div
                    class="w-16 h-16 mx-auto mb-6 flex items-center justify-center border"
                    style="border-color: {{ $primaryColor }};"
                >
                    <svg class="w-7 h-7" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg font-light mb-4 text-white"
                    style="font-family: 'Playfair Display', Georgia, serif;"
                >
                    Bel Ons
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="text-2xl font-light block transition-opacity hover:opacity-80"
                    style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm mt-4 text-white/50">
                    Direct een afspraak maken
                </p>
            </div>

            {{-- E-mail --}}
            <div class="text-center p-10 border transition-all duration-300 hover:-translate-y-1" style="border-color: {{ $secondaryColor }}10; background-color: #ffffff;">
                <div
                    class="w-16 h-16 mx-auto mb-6 flex items-center justify-center"
                    style="background-color: {{ $primaryColor }};"
                >
                    <svg class="w-7 h-7" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg font-light mb-4"
                    style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    E-mail
                </h3>
                <a
                    href="mailto:{{ $email }}"
                    class="text-lg block transition-colors hover:opacity-80"
                    style="color: {{ $headingColor }};"
                >
                    {{ $email }}
                </a>
                <p class="text-sm mt-4" style="color: {{ $textColor }};">
                    We reageren binnen 24 uur
                </p>
            </div>
        </div>

        {{-- Opening hours --}}
        <div class="max-w-2xl mx-auto mb-16">
            <div class="text-center mb-8">
                <h3
                    class="text-2xl font-light"
                    style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    Openingstijden
                </h3>
                <div class="w-12 h-px mx-auto mt-4" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <div class="grid sm:grid-cols-2 gap-x-12 gap-y-3">
                @foreach($openingHours as $entry)
                    @php
                        $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                        $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                        $isClosed = str_contains(strtolower($hours), 'gesloten');
                    @endphp
                    <div class="flex justify-between items-center py-3 border-b" style="border-color: {{ $secondaryColor }}10;">
                        <span style="color: {{ $textColor }};">{{ $day }}</span>
                        <span class="{{ $isClosed ? 'opacity-50' : '' }}" style="color: {{ $isClosed ? $textColor : $primaryColor }};">
                            {{ $hours }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Map --}}
        @if($mapEmbed)
            <div class="mb-16">
                <div class="aspect-[21/9] w-full">
                    {!! $mapEmbed !!}
                </div>
            </div>
        @else
            {{-- Placeholder map --}}
            <div
                class="aspect-[21/9] w-full flex items-center justify-center mb-16"
                style="background-color: {{ $secondaryColor }}08;"
            >
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4" style="color: {{ $textColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span style="color: {{ $textColor }};">Google Maps</span>
                </div>
            </div>
        @endif

        {{-- Contact Form --}}
        <div class="max-w-2xl mx-auto">
            <div class="p-10 lg:p-14 border relative" style="border-color: {{ $secondaryColor }}10; background-color: #ffffff;">
                {{-- Gold corner --}}
                <div
                    class="absolute top-0 right-0 w-20 h-20"
                    style="background: linear-gradient(135deg, {{ $primaryColor }} 50%, transparent 50%);"
                ></div>

                <div class="text-center mb-10 relative">
                    <h3
                        class="text-2xl font-light mb-3"
                        style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                    >
                        {{ __('Stuur een bericht') }}
                    </h3>
                    <p style="color: {{ $textColor }};">
                        {{ __('Vragen of opmerkingen? Wij horen graag van u.') }}
                    </p>
                </div>

                <livewire:contact-form :theme="[
                    'primary_color' => $primaryColor,
                    'secondary_color' => $secondaryColor,
                    'background_color' => $backgroundColor,
                    'text_color' => $textColor,
                    'heading_color' => $headingColor,
                ]" />
            </div>
        </div>

        {{-- Bottom note --}}
        <div class="mt-12 text-center">
            <p class="text-sm" style="color: {{ $textColor }};">
                Gratis parkeren in de buurt • Rolstoeltoegankelijk
            </p>
        </div>
    </div>
</section>
