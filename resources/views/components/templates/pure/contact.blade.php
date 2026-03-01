{{--
    Pure Template: Contact Section
    Natural & Botanical — two-column layout with contact info and opening hours
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Contact';
    $subtitle = $content['subtitle'] ?? 'Neem contact op';
    $address = $content['address'] ?? 'Herengracht 456, 1017 CA Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? 'info@salon.nl';
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

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section id="contact" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Botanical leaf decoration --}}
    <div class="absolute top-12 left-10 opacity-[0.04]">
        <svg class="w-32 h-32" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
        </svg>
    </div>
    <div class="absolute bottom-8 right-8 opacity-[0.03]">
        <svg class="w-24 h-24" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header with watermark --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >Contact</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                Contact
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ $subtitle }}</p>
        </div>

        {{-- Two-column layout --}}
        <div
            class="grid lg:grid-cols-2 gap-0 rounded-none overflow-hidden"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {{-- Left: Contact info on dark background --}}
            <div class="p-10 lg:p-14" style="background-color: {{ $secondaryColor }};">
                {{-- Botanical decoration inside --}}
                <div class="relative">
                    <svg class="absolute -top-4 -right-4 w-20 h-20 opacity-[0.06]" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
                        <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
                    </svg>
                </div>

                <div class="w-12 h-px mb-8" style="background-color: {{ $primaryColor }};"></div>

                <h3 class="text-2xl lg:text-3xl font-bold mb-10" style="color: #ffffff; font-family: '{{ $headingFont }}', serif;">
                    Kom langs of neem contact op
                </h3>

                {{-- Phone --}}
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Telefoon</span>
                    </div>
                    <a
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                        class="text-2xl lg:text-3xl font-bold block transition-opacity hover:opacity-80"
                        style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
                    >
                        {{ $phone }}
                    </a>
                </div>

                {{-- Email --}}
                @if($email)
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">E-mail</span>
                        </div>
                        <a
                            href="mailto:{{ $email }}"
                            class="text-lg font-medium block transition-opacity hover:opacity-80"
                            style="color: rgba(255,255,255,0.85); font-family: '{{ $bodyFont }}', sans-serif;"
                        >
                            {{ $email }}
                        </a>
                    </div>
                @endif

                {{-- Address --}}
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Adres</span>
                    </div>
                    <p class="text-lg leading-relaxed" style="color: rgba(255,255,255,0.85); font-family: '{{ $bodyFont }}', sans-serif;">
                        {{ $address }}
                    </p>
                </div>

                {{-- Route button --}}
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 rounded-none"
                    style="border: 1.5px solid {{ $primaryColor }}; color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                    onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff';"
                    onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $primaryColor }}';"
                >
                    Route plannen
                    <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Right: Opening hours on white --}}
            <div class="p-10 lg:p-14" style="background-color: #ffffff;">
                <div class="w-12 h-px mb-8" style="background-color: {{ $primaryColor }};"></div>

                <h3 class="text-2xl lg:text-3xl font-bold mb-10" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                    Openingstijden
                </h3>

                <div class="space-y-4">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center py-2" style="border-bottom: 1px solid {{ $accentColor }}30;">
                            <span class="text-base" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ $day }}</span>
                            <span
                                class="text-base {{ $isClosed ? 'opacity-40' : 'font-semibold' }}"
                                style="color: {{ $isClosed ? $textColor : $headingColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                            >
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map --}}
        <div
            class="mt-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
        >
            @if($mapEmbed)
                <div class="overflow-hidden min-h-[320px] rounded-none">
                    <div class="h-full w-full">{!! $mapEmbed !!}</div>
                </div>
            @else
                <div
                    class="w-full min-h-[320px] flex items-center justify-center rounded-none"
                    style="background-color: {{ $accentColor }}30;"
                >
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto mb-3" style="color: {{ $primaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="text-sm" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Google Maps</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
