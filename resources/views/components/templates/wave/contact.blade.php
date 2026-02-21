{{--
    Wave Template: Contact Section
    "Coastal Minimal" — rounded cards, wave accent, gradient icons, Livewire form
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
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

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';
@endphp

<section id="contact" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Wave divider top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="#ffffff">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15]"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Contact info cards --}}
        <div class="grid lg:grid-cols-3 gap-6 mb-14">
            {{-- Address --}}
            <div
                class="group rounded-2xl p-8 text-center transition-all duration-500 hover:-translate-y-1 hover:shadow-lg"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: #ffffff; box-shadow: 0 1px 3px {{ $secondaryColor }}06; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                <div
                    class="w-12 h-12 mx-auto mb-5 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $accentColor }}10); border: 1px solid {{ $primaryColor }}12;"
                >
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg mb-3"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                >
                    Adres
                </h3>
                <p class="text-[14px] mb-4 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $address }}
                </p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-[0.1em] transition-colors duration-300"
                    style="color: {{ $primaryColor }};"
                >
                    Route plannen
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            {{-- Phone --}}
            <div
                class="group rounded-2xl p-8 text-center transition-all duration-500 hover:-translate-y-1 hover:shadow-lg"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $accentColor }}); box-shadow: 0 4px 20px {{ $primaryColor }}30; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
            >
                <div
                    class="w-12 h-12 mx-auto mb-5 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110"
                    style="background-color: rgba(255,255,255,0.15);"
                >
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg mb-3 text-white"
                    style="font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                >
                    Bel Ons
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="text-xl font-bold block transition-opacity hover:opacity-80 text-white mb-2"
                    style="font-family: '{{ $headingFont }}', serif;"
                >
                    {{ $phone }}
                </a>
                <p class="text-[13px] text-white/70">
                    Direct een afspraak maken
                </p>
            </div>

            {{-- Email --}}
            <div
                class="group rounded-2xl p-8 text-center transition-all duration-500 hover:-translate-y-1 hover:shadow-lg"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: #ffffff; box-shadow: 0 1px 3px {{ $secondaryColor }}06; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
            >
                <div
                    class="w-12 h-12 mx-auto mb-5 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $accentColor }}10); border: 1px solid {{ $primaryColor }}12;"
                >
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3
                    class="text-lg mb-3"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                >
                    E-mail
                </h3>
                <a
                    href="mailto:{{ $email }}"
                    class="text-[15px] block transition-opacity hover:opacity-80 mb-2"
                    style="color: {{ $headingColor }};"
                >
                    {{ $email }}
                </a>
                <p class="text-[13px]" style="color: {{ $textColor }};">
                    We reageren binnen 24 uur
                </p>
            </div>
        </div>

        {{-- Opening hours --}}
        <div
            class="max-w-2xl mx-auto mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="text-center mb-8">
                <h3
                    class="text-2xl"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                >
                    Openingstijden
                </h3>
                <div class="w-10 h-[2px] mx-auto mt-4 rounded-full" style="background: linear-gradient(to right, {{ $primaryColor }}, {{ $accentColor }});"></div>
            </div>
            <div class="grid sm:grid-cols-2 gap-x-12 gap-y-0">
                @foreach($openingHours as $entry)
                    @php
                        $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                        $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                        $isClosed = str_contains(strtolower($hours), 'gesloten');
                    @endphp
                    <div
                        class="flex justify-between items-center py-3.5"
                        style="border-bottom: 1px solid {{ $primaryColor }}08;"
                    >
                        <span class="text-[14px]" style="color: {{ $textColor }};">{{ $day }}</span>
                        <span
                            class="text-[14px] font-medium {{ $isClosed ? 'opacity-40' : '' }}"
                            style="color: {{ $isClosed ? $textColor : $primaryColor }};"
                        >
                            {{ $hours }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Map --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            @if($mapEmbed)
                <div class="rounded-2xl overflow-hidden min-h-[350px]" style="box-shadow: 0 4px 20px {{ $secondaryColor }}08;">
                    <div class="h-full w-full">{!! $mapEmbed !!}</div>
                </div>
            @else
                <div
                    class="w-full min-h-[350px] flex items-center justify-center rounded-2xl"
                    style="background-color: {{ $primaryColor }}18; border: 1px dashed {{ $primaryColor }}35;"
                >
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto mb-3" style="color: {{ $primaryColor }}50;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="text-[11px] uppercase tracking-[0.2em]" style="color: {{ $textColor }}90;">Google Maps</span>
                    </div>
                </div>
            @endif
        </div>

        {{-- Bottom note --}}
        <div class="mt-10 text-center">
            <p class="text-[13px]" style="color: {{ $textColor }};">
                Gratis parkeren in de buurt &bull; Rolstoeltoegankelijk
            </p>
        </div>
    </div>
</section>
