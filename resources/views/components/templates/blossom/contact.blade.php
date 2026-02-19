{{--
    Template-specifieke contact sectie voor Blossom (Luxury Beauty Salon)

    Adres, telefoonnummer en openingstijden (geen contactformulier)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Bezoek Onze Salon';
    $subtitle = $content['subtitle'] ?? 'Wij verwelkomen je graag voor een heerlijke behandeling';
    $address = $content['address'] ?? 'Prinsengracht 456, 1017 KE Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? 'info@blossomsalon.nl';
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

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Contact
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg" style="color: {{ $textColor }}; opacity: 0.7;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Contact cards --}}
        <div class="grid gap-6 md:grid-cols-3 mb-12">
            {{-- Adres --}}
            <div
                class="p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl bg-white relative overflow-hidden"
                style="box-shadow: 0 4px 20px {{ $primaryColor }}10;"
            >
                {{-- Decorative corner --}}
                <div
                    class="absolute top-0 right-0 w-20 h-20 rounded-bl-[3rem] opacity-10"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                ></div>

                <div
                    class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20);"
                >
                    <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg font-bold mb-3"
                    style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    Adres
                </h3>
                <p class="mb-4" style="color: {{ $textColor }}; opacity: 0.7;">
                    {{ $address }}
                </p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-1 text-sm font-semibold transition-colors"
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
                class="p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl text-white relative overflow-hidden"
                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}30;"
            >
                {{-- Decorative corner --}}
                <div class="absolute top-0 right-0 w-20 h-20 rounded-bl-[3rem] bg-white/20"></div>

                <div class="relative">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-white/20 flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3
                        class="text-lg font-bold mb-3"
                        style="font-family: 'Playfair Display', Georgia, serif;"
                    >
                        Bel Ons
                    </h3>
                    <a
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                        class="text-2xl font-bold block transition-opacity hover:opacity-80"
                    >
                        {{ $phone }}
                    </a>
                    <p class="text-sm mt-3 opacity-80">
                        Wij helpen je graag!
                    </p>
                </div>
            </div>

            {{-- Openingstijden --}}
            <div
                class="p-8 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl bg-white relative overflow-hidden"
                style="box-shadow: 0 4px 20px {{ $primaryColor }}10;"
            >
                {{-- Decorative corner --}}
                <div
                    class="absolute top-0 right-0 w-20 h-20 rounded-bl-[3rem] opacity-10"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                ></div>

                <div
                    class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20);"
                >
                    <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg font-bold mb-4 text-center"
                    style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    Openingstijden
                </h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center text-sm py-1">
                            <span style="color: {{ $textColor }}; opacity: 0.7;">{{ $day }}</span>
                            <span
                                class="{{ $isClosed ? 'opacity-50' : 'font-semibold' }}"
                                style="color: {{ $isClosed ? $textColor : $primaryColor }};"
                            >
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map + Contact Form naast elkaar op groot scherm --}}
        <div class="grid lg:grid-cols-2 gap-8 items-stretch">

            {{-- Map --}}
            <div>
                @if($mapEmbed)
                    <div class="rounded-2xl overflow-hidden h-full min-h-[350px]" style="box-shadow: 0 10px 40px {{ $primaryColor }}10;">
                        <div class="h-full w-full">{!! $mapEmbed !!}</div>
                    </div>
                @else
                    <div
                        class="rounded-2xl w-full h-full min-h-[350px] flex items-center justify-center relative overflow-hidden"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}25, {{ $secondaryColor }}25);"
                    >
                        <div class="text-center relative">
                            <svg class="w-16 h-16 mx-auto mb-4" style="color: {{ $primaryColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <span style="color: {{ $primaryColor }}60;">Google Maps</span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Contact Form --}}
            <div>
                <div
                    class="p-8 lg:p-12 rounded-3xl relative overflow-hidden h-full"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}08, {{ $secondaryColor }}08); border: 1px solid {{ $primaryColor }}20;"
                >
                    <div class="relative">
                        <div class="text-center mb-8">
                            <h3
                                class="text-2xl font-bold mb-3"
                                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                            >
                                {{ __('Stuur ons een bericht') }}
                            </h3>
                            <p class="text-sm" style="color: {{ $textColor }}; opacity: 0.7;">
                                {{ __('Heeft u een vraag? Wij helpen u graag verder.') }}
                            </p>
                        </div>

                        <livewire:contact-form :theme="[
                            'primary_color' => $primaryColor,
                            'secondary_color' => $secondaryColor,
                            'background_color' => $backgroundColor,
                            'text_color' => $textColor,
                            'heading_color' => $textColor,
                        ]" />
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom note --}}
        <div class="mt-8 text-center">
            <div
                class="inline-flex items-center gap-2 px-6 py-3 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10);"
            >
                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <p class="text-sm" style="color: {{ $textColor }};">
                    Gratis parkeren in de buurt. Rolstoeltoegankelijk. Thee & koffie van het huis.
                </p>
            </div>
        </div>
    </div>
</section>
