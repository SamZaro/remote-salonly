{{--
    Template-specifieke contact voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Contact';
    $subtitle = $content['subtitle'] ?? 'Kom langs of neem contact op';
    $address = $content['address'] ?? "Herengracht 456\n1017 CA Amsterdam";
    $phone = $content['phone'] ?? '+31 20 123 4567';
    $email = $content['email'] ?? 'hello@pure-salon.nl';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => 'Maandag', 'hours' => 'Gesloten'],
        ['day' => 'Dinsdag - Vrijdag', 'hours' => '09:00 - 19:00'],
        ['day' => 'Zaterdag', 'hours' => '09:00 - 17:00'],
        ['day' => 'Zondag', 'hours' => 'Gesloten'],
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $textColor = $theme['text_color'] ?? '#78716c';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
@endphp

<section id="contact" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-16"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-6"
                style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Contact
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Contact cards --}}
            <div class="space-y-6"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{-- Address --}}
                <div class="bg-white p-6 rounded-2xl" style="box-shadow: 0 4px 20px {{ $primaryColor }}08;">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}15;"
                        >
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium mb-1" style="color: {{ $headingColor }};">Adres</h4>
                            <p class="text-sm whitespace-pre-line" style="color: {{ $textColor }};">{{ $address }}</p>
                        </div>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="bg-white p-6 rounded-2xl" style="box-shadow: 0 4px 20px {{ $primaryColor }}08;">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}15;"
                        >
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium mb-1" style="color: {{ $headingColor }};">Telefoon</h4>
                            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-sm hover:opacity-70 transition-opacity" style="color: {{ $textColor }};">
                                {{ $phone }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="bg-white p-6 rounded-2xl" style="box-shadow: 0 4px 20px {{ $primaryColor }}08;">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}15;"
                        >
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium mb-1" style="color: {{ $headingColor }};">Email</h4>
                            <a href="mailto:{{ $email }}" class="text-sm hover:opacity-70 transition-opacity" style="color: {{ $textColor }};">
                                {{ $email }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Opening hours & Map --}}
            <div class="lg:col-span-2 space-y-6"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
            >
                {{-- Opening hours --}}
                <div class="bg-white p-8 rounded-2xl" style="box-shadow: 0 4px 20px {{ $primaryColor }}08;">
                    <h4 class="font-medium mb-6" style="color: {{ $headingColor }};">Openingstijden</h4>
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($openingHours as $time)
                            <div class="flex items-center justify-between py-3 border-b" style="border-color: {{ $primaryColor }}15;">
                                <span class="text-sm" style="color: {{ $textColor }};">{{ $time['day'] }}</span>
                                <span class="text-sm font-medium" style="color: {{ $headingColor }};">{{ $time['hours'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Map placeholder --}}
                <div
                    class="relative h-64 rounded-2xl flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $accentColor }}10);"
                >
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto mb-3" style="color: {{ $primaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="text-sm" style="color: {{ $primaryColor }}50;">Kaart integratie</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
