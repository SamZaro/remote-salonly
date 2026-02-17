{{--
    Icon Template: Contact Section
    "Warm Atelier" — warm canvas, gold accents, editorial info cards, sharp edges
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
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

    // Theme kleuren — Warm Atelier palette
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';
@endphp

<section id="contact" class="py-24 lg:py-36" style="background-color: {{ $primaryColor }}04; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                    Contact
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Contact info cards --}}
        <div class="grid gap-6 lg:gap-8 md:grid-cols-3 mb-14">

            {{-- Address card --}}
            <div
                class="group relative p-8 lg:p-10 text-center transition-all duration-500 hover:shadow-lg"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
            >
                {{-- Gold top accent — expands on hover --}}
                <div
                    class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                    style="background-color: {{ $primaryColor }};"
                ></div>

                {{-- Icon --}}
                <div
                    class="w-11 h-11 rounded-full flex items-center justify-center mx-auto mb-6"
                    style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}12;"
                >
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>

                <h3
                    class="text-xl mb-3"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    Adres
                </h3>
                <p class="text-[14px] leading-[1.7] mb-5" style="color: {{ $textColor }};">
                    {{ $address }}
                </p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="group/link inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-[0.15em] transition-all duration-300 hover:gap-3"
                    style="color: {{ $primaryColor }};"
                >
                    Route plannen
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            {{-- Phone card (dark variant) --}}
            <div
                class="group relative p-8 lg:p-10 text-center transition-all duration-500 hover:shadow-lg"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $secondaryColor }}; box-shadow: 0 1px 8px rgba(0,0,0,0.08); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.12s;"
            >
                {{-- Gold top accent — expands on hover --}}
                <div
                    class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                    style="background-color: {{ $primaryColor }};"
                ></div>

                {{-- Icon --}}
                <div
                    class="w-11 h-11 rounded-full flex items-center justify-center mx-auto mb-6"
                    style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}12;"
                >
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>

                <h3
                    class="text-xl mb-3"
                    style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    Bel Ons
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="block text-2xl mb-3 transition-opacity duration-300 hover:opacity-80"
                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    {{ $phone }}
                </a>
                <p class="text-[13px]" style="color: {{ $backgroundColor }}40;">
                    Direct een afspraak maken
                </p>
            </div>

            {{-- Opening hours card --}}
            <div
                class="group relative p-8 lg:p-10 transition-all duration-500 hover:shadow-lg"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.24s;"
            >
                {{-- Gold top accent — expands on hover --}}
                <div
                    class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                    style="background-color: {{ $primaryColor }};"
                ></div>

                {{-- Icon --}}
                <div
                    class="w-11 h-11 rounded-full flex items-center justify-center mx-auto mb-6"
                    style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}12;"
                >
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <h3
                    class="text-xl mb-5 text-center"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    Openingstijden
                </h3>
                <div class="space-y-2.5">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center text-[13px] py-0.5">
                            <span style="color: {{ $textColor }};">{{ $day }}</span>
                            @if($isClosed)
                                <span style="color: {{ $textColor }}50;">{{ $hours }}</span>
                            @else
                                <span style="color: {{ $primaryColor }}; font-weight: 600;">{{ $hours }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map + Contact Form naast elkaar op groot scherm --}}
        <div class="grid lg:grid-cols-2 gap-8 items-stretch mb-16">

            {{-- Map --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            >
                @if($mapEmbed)
                    <div class="overflow-hidden h-full min-h-[350px]" style="border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.05);">
                        <div class="h-full w-full">{!! $mapEmbed !!}</div>
                    </div>
                @else
                    <div
                        class="w-full h-full min-h-[350px] flex items-center justify-center"
                        style="background-color: {{ $primaryColor }}15; border: 1px solid {{ $primaryColor }}25;"
                    >
                        <div class="text-center">
                            <svg class="w-14 h-14 mx-auto mb-3" style="color: {{ $primaryColor }}50;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <span class="text-[11px] uppercase tracking-[0.2em]" style="color: {{ $textColor }}90;">Google Maps</span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Contact form --}}
            <div
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                <div
                    class="relative p-8 lg:p-12 h-full"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03);"
                >
                    {{-- Label above form --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center gap-3 mb-6">
                            <span class="w-8 h-px" style="background-color: {{ $primaryColor }};"></span>
                            <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                                Stuur ons een bericht
                            </span>
                            <span class="w-8 h-px" style="background-color: {{ $primaryColor }};"></span>
                        </div>
                        <h3
                            class="text-2xl sm:text-3xl mb-3"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                        >
                            {{ __('Neem Contact Op') }}
                        </h3>
                        <p class="text-[14px] leading-relaxed" style="color: {{ $textColor }};">
                            {{ __('Heeft u een vraag of wilt u een afspraak maken? Laat het ons weten!') }}
                        </p>
                    </div>

                    {{-- Gold divider --}}
                    <div class="flex items-center justify-center gap-0 mb-8">
                        <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                        <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                        <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                    </div>

                    <livewire:contact-form :theme="[
                        'primary_color' => $primaryColor,
                        'secondary_color' => $secondaryColor,
                        'accent_color' => $accentColor,
                        'background_color' => $backgroundColor,
                        'text_color' => $textColor,
                        'heading_color' => $headingColor,
                        'heading_font_family' => $headingFont,
                        'font_family' => $bodyFont,
                    ]" />
                </div>
            </div>

        </div>

        {{-- Bottom note --}}
        <div
            class="mt-10 text-center"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
        >
            <p class="text-[13px]" style="color: {{ $textColor }}60;">
                Gratis parkeren in de buurt. Rolstoeltoegankelijk.
            </p>
        </div>
    </div>
</section>
