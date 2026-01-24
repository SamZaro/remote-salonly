{{--
    Template-specifieke contact sectie voor Icon (Hair Salon)

    Adres, telefoonnummer en openingstijden (geen contactformulier)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Kom Langs';
    $subtitle = $content['subtitle'] ?? 'Wij verwelkomen je graag in onze salon';
    $address = $content['address'] ?? 'Keizersgracht 123, 1015 CJ Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? 'info@iconsalon.nl';
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

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16">
            <span
                class="inline-block text-sm font-semibold mb-4 px-4 py-1 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
            >
                Contact
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6" style="color: {{ $textColor }};">
                {{ $title }}
            </h2>
            <p class="text-lg text-gray-600">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Contact cards --}}
        <div class="grid gap-6 md:grid-cols-3 mb-12">
            {{-- Adres --}}
            <div
                class="p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl bg-white"
                style="box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
            >
                <div
                    class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15);"
                >
                    <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-3" style="color: {{ $textColor }};">
                    Adres
                </h3>
                <p class="text-gray-600 mb-4">
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
                class="p-8 rounded-2xl text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-xl text-white"
                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}30;"
            >
                <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-white/20 flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-3">
                    Bel Ons
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="text-2xl font-bold block transition-opacity hover:opacity-80"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm mt-3 opacity-80">
                    Direct een afspraak maken
                </p>
            </div>

            {{-- Openingstijden --}}
            <div
                class="p-8 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-xl bg-white"
                style="box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
            >
                <div
                    class="w-16 h-16 mx-auto mb-6 rounded-2xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15);"
                >
                    <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-4 text-center" style="color: {{ $textColor }};">
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
                            <span class="text-gray-600">{{ $day }}</span>
                            <span class="{{ $isClosed ? 'text-gray-400' : '' }}" style="{{ !$isClosed ? 'color: ' . $primaryColor . '; font-weight: 600;' : '' }}">
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map --}}
        @if($mapEmbed)
            <div class="rounded-2xl overflow-hidden" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div class="aspect-[21/9] w-full">
                    {!! $mapEmbed !!}
                </div>
            </div>
        @else
            {{-- Placeholder map --}}
            <div
                class="rounded-2xl aspect-[21/9] w-full flex items-center justify-center"
                style="background: linear-gradient(135deg, {{ $primaryColor }}05, {{ $secondaryColor }}05);"
            >
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                    <span class="text-gray-400">Google Maps</span>
                </div>
            </div>
        @endif

        {{-- Contact Form Section --}}
        <div class="mt-16 max-w-2xl mx-auto">
            <div
                class="p-8 lg:p-12 rounded-2xl bg-white relative overflow-hidden"
                style="box-shadow: 0 10px 40px rgba(0,0,0,0.08);"
            >
                {{-- Decorative gradient border --}}
                <div
                    class="absolute inset-0 rounded-2xl opacity-10"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); padding: 2px;"
                ></div>

                <div class="relative">
                    <div class="text-center mb-8">
                        <div
                            class="w-14 h-14 mx-auto mb-4 rounded-xl flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15);"
                        >
                            <svg class="w-7 h-7" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3" style="color: {{ $textColor }};">
                            {{ __('Stuur ons een bericht') }}
                        </h3>
                        <p class="text-gray-600 text-sm">
                            {{ __('Heeft u een vraag of wilt u een afspraak maken? Laat het ons weten!') }}
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

        {{-- Bottom note --}}
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500">
                Gratis parkeren in de buurt. Rolstoeltoegankelijk.
            </p>
        </div>
    </div>
</section>
