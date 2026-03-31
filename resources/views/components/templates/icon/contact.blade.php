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
    $title = $content['title'] ?? __('Come Visit Us');
    $subtitle = $content['subtitle'] ?? __('We look forward to welcoming you in our salon');
    $address = $content['address'] ?? 'Keizersgracht 123, 1015 CJ Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? 'info@iconsalon.nl';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => __('Monday'), 'hours' => __('Closed')],
        ['day' => __('Tuesday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Wednesday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Thursday'), 'hours' => '09:00 - 21:00'],
        ['day' => __('Friday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Saturday'), 'hours' => '09:00 - 17:00'],
        ['day' => __('Sunday'), 'hours' => __('Closed')],
    ];
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
                    {{ __('Address') }}
                </h3>
                <p class="text-[14px] leading-[1.7] mb-5" style="color: {{ $textColor }};">
                    {{ $address }}
                </p>
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
                    {{ __('Call Us') }}
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="block text-2xl mb-3 transition-opacity duration-300 hover:opacity-80"
                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    {{ $phone }}
                </a>
                <p class="text-[13px]" style="color: {{ $backgroundColor }}40;">
                    {{ __('Make an appointment directly') }}
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
                    {{ __('Opening Hours') }}
                </h3>
                <div class="space-y-2.5">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'closed') || str_contains(strtolower($hours), 'gesloten');
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

        {{-- Bottom note --}}
        <div
            class="mt-10 text-center"
            x-data x-intersect.once="$el.style.opacity = 1"
            style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
        >
            <p class="text-[13px]" style="color: {{ $textColor }}60;">
                {{ __('Free parking available nearby. Wheelchair accessible.') }}
            </p>
        </div>
    </div>
</section>
