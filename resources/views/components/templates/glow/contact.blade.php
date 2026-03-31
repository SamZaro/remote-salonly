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
    $subtitle = $content['subtitle'] ?? __('We warmly welcome you');
    $address = $content['address'] ?? 'Prinsengracht 456, 1017 KE Amsterdam';
    $phone = $content['phone'] ?? '020 - 123 4567';
    $email = $content['email'] ?? 'info@salon.nl';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => __('Monday'), 'hours' => __('Closed')],
        ['day' => __('Tuesday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Wednesday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Thursday'), 'hours' => '09:00 - 21:00'],
        ['day' => __('Friday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Saturday'), 'hours' => '09:00 - 17:00'],
        ['day' => __('Sunday'), 'hours' => __('Closed')],
    ];
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
                <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: {{ $headingColor }};">{{ __('Address') }}</h3>
                <p class="text-lg mb-4 leading-relaxed" style="color: {{ $textColor }};">{{ $address }}</p>
            </div>

            {{-- Phone --}}
            <div class="p-8" style="background-color: {{ $secondaryColor }}; border-radius: 12px; color: {{ $backgroundColor }};">
                <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: {{ $primaryColor }};">{{ __('Call us') }}</h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="text-2xl font-bold block mb-2 transition-opacity hover:opacity-80"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm" style="color: {{ $primaryColor }};">{{ __('Happy to help!') }}</p>
            </div>

            {{-- Opening hours --}}
            <div class="p-8" style="background-color: white; border-radius: 12px;">
                <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: {{ $headingColor }};">{{ __('Opening Hours') }}</h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'closed') || str_contains(strtolower($hours), 'gesloten');
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

    </div>
</section>
