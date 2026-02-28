{{--
    Glow Template: Contact Section
    Warm minimalist — clean layout, no decorative corners or gradient cards
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Contact';
    $subtitle = $content['subtitle'] ?? 'Wij verwelkomen je graag';
    $address = $content['address'] ?? 'Prinsengracht 456, 1017 KE Amsterdam';
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

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Raleway';
    $bodyFont = $theme['font_family'] ?? 'Raleway';
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block" style="color: {{ $secondaryColor }};">
                Contact
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold mb-4" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;">
                {{ $title }}
            </h2>
            <p class="text-lg" style="color: {{ $textColor }};">{{ $subtitle }}</p>
        </div>

        {{-- Contact grid --}}
        <div class="grid gap-6 lg:grid-cols-3 mb-10">
            {{-- Address --}}
            <div class="p-8" style="background-color: white; border-radius: 12px;">
                <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: {{ $headingColor }};">Adres</h3>
                <p class="text-lg mb-4 leading-relaxed" style="color: {{ $textColor }};">{{ $address }}</p>
                <a
                    href="https://maps.google.com/?q={{ urlencode($address) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="text-sm font-semibold transition-opacity hover:opacity-70"
                    style="color: {{ $secondaryColor }};"
                >
                    Route plannen &rarr;
                </a>
            </div>

            {{-- Phone --}}
            <div class="p-8" style="background-color: {{ $secondaryColor }}; border-radius: 12px; color: {{ $backgroundColor }};">
                <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: {{ $primaryColor }};">Bel ons</h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="text-2xl font-bold block mb-2 transition-opacity hover:opacity-80"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm" style="color: {{ $primaryColor }};">Wij helpen je graag!</p>
            </div>

            {{-- Opening hours --}}
            <div class="p-8" style="background-color: white; border-radius: 12px;">
                <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: {{ $headingColor }};">Openingstijden</h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center">
                            <span style="color: {{ $textColor }};">{{ $day }}</span>
                            <span class="{{ $isClosed ? 'opacity-50' : 'font-medium' }}" style="color: {{ $isClosed ? $textColor : $headingColor }};">
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Map --}}
        <div>
            @if($mapEmbed)
                <div class="overflow-hidden min-h-[320px]" style="border-radius: 12px;">
                    <div class="h-full w-full">{!! $mapEmbed !!}</div>
                </div>
            @else
                <div
                    class="w-full min-h-[320px] flex items-center justify-center"
                    style="background-color: {{ $primaryColor }}; border-radius: 12px;"
                >
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto mb-3" style="color: {{ $secondaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Google Maps</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
