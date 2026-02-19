{{--
    Template-specifieke contact voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Contact';
    $subtitle = $content['subtitle'] ?? 'Wij horen graag van je';
    $address = $content['address'] ?? "Keizersgracht 123\n1015 CJ Amsterdam";
    $phone = $content['phone'] ?? '+31 20 123 4567';
    $email = $content['email'] ?? 'info@essence-salon.nl';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => 'Maandag', 'hours' => 'Gesloten'],
        ['day' => 'Dinsdag - Vrijdag', 'hours' => '09:00 - 20:00'],
        ['day' => 'Zaterdag', 'hours' => '09:00 - 17:00'],
        ['day' => 'Zondag', 'hours' => 'Op afspraak'],
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#6E5F5B';
@endphp

<section id="contact" class="py-24 lg:py-32" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div class="text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Contact</span>
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-6"
                style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto font-light" style="color: {{ $textColor }}; opacity: 0.8;">
                {{ $subtitle }}
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Contact info --}}
            <div class="lg:col-span-1 space-y-8">
                {{-- Address --}}
                <div class="bg-white p-8" style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 flex-shrink-0 flex items-center justify-center"
                            style="background-color: {{ $accentColor }};"
                        >
                            <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium uppercase tracking-wider mb-2" style="color: {{ $secondaryColor }};">Adres</h4>
                            <p class="text-sm whitespace-pre-line" style="color: {{ $textColor }}; opacity: 0.8;">{{ $address }}</p>
                        </div>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="bg-white p-8" style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 flex-shrink-0 flex items-center justify-center"
                            style="background-color: {{ $accentColor }};"
                        >
                            <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium uppercase tracking-wider mb-2" style="color: {{ $secondaryColor }};">Telefoon</h4>
                            <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-sm hover:opacity-70 transition-opacity" style="color: {{ $textColor }};">
                                {{ $phone }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Email --}}
                <div class="bg-white p-8" style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 flex-shrink-0 flex items-center justify-center"
                            style="background-color: {{ $accentColor }};"
                        >
                            <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium uppercase tracking-wider mb-2" style="color: {{ $secondaryColor }};">Email</h4>
                            <a href="mailto:{{ $email }}" class="text-sm hover:opacity-70 transition-opacity" style="color: {{ $textColor }};">
                                {{ $email }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Opening hours --}}
            <div class="lg:col-span-2 bg-white p-8 lg:p-10 h-fit" style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;">
                <h4 class="text-sm font-medium uppercase tracking-wider mb-6" style="color: {{ $secondaryColor }};">Openingstijden</h4>
                <div class="space-y-4">
                    @foreach($openingHours as $time)
                        <div class="flex items-center justify-between py-3 border-b" style="border-color: {{ $primaryColor }}40;">
                            <span class="text-sm" style="color: {{ $textColor }};">{{ $time['day'] }}</span>
                            <span class="text-sm font-medium" style="color: {{ $secondaryColor }};">{{ $time['hours'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
