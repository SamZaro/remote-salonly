{{--
    Fade Template: Contact Section
    Dark section — 3-column info cards, gold phone highlight
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title        = $content['title'] ?? __('Visit Us');
    $subtitle     = $content['subtitle'] ?? __('Location and Contact');
    $address      = $content['address'] ?? 'Barber Street 12, 1012 AB Amsterdam';
    $phone        = $content['phone'] ?? '020 - 123 4567';
    $email        = $content['email'] ?? '';
    $openingHours = $content['opening_hours'] ?? [
        ['day' => __('Monday'),    'hours' => '10:00 - 20:00'],
        ['day' => __('Tuesday'),   'hours' => '09:00 - 18:00'],
        ['day' => __('Wednesday'), 'hours' => '09:00 - 18:00'],
        ['day' => __('Thursday'),  'hours' => '09:00 - 20:00'],
        ['day' => __('Friday'),    'hours' => '09:00 - 18:00'],
        ['day' => __('Saturday'),  'hours' => '09:00 - 17:00'],
        ['day' => __('Sunday'),    'hours' => __('Closed')],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Contact</span>
            </div>
            <h2
                class="font-bold uppercase leading-[0.85]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.4rem, 4.5vw, 4rem); letter-spacing: -0.02em; color: #ffffff;"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-base font-light" style="color: rgba(255,255,255,0.45); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        {{-- 3-column info --}}
        <div class="grid gap-4 lg:grid-cols-3">

            {{-- Address --}}
            <div
                class="p-8 lg:p-10 border transition-all duration-300"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: transparent; border-color: rgba(200,184,138,0.15); opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s, border-color 0.3s ease;"
                onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                onmouseout="this.style.borderColor='rgba(200,184,138,0.15)'"
            >
                <div class="w-10 h-10 flex items-center justify-center mb-6" style="background-color: {{ $primaryColor }};">
                    <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold uppercase tracking-wide text-sm mb-3" style="color: #ffffff; font-family: '{{ $headingFont }}';">
                    {{ __('Address') }}
                </h3>
                <p class="text-base leading-relaxed mb-6 font-light" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">
                    {{ $address }}
                </p>
            </div>

            {{-- Phone — gold highlight --}}
            <div
                class="p-8 lg:p-10"
                style="background-color: {{ $primaryColor }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            >
                <div class="w-10 h-10 flex items-center justify-center mb-6 border-2" style="border-color: {{ $secondaryColor }}40;">
                    <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="font-bold uppercase tracking-wide text-sm mb-3" style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}';">
                    {{ __('Call Us') }}
                </h3>
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="block font-bold transition-opacity hover:opacity-80 mb-3"
                    style="color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.6rem; letter-spacing: -0.02em;"
                >
                    {{ $phone }}
                </a>
                <p class="text-sm font-light" style="color: {{ $secondaryColor }}90; font-family: '{{ $bodyFont }}';">
                    {{ __('Want to book an appointment?') }}
                </p>
            </div>

            {{-- Opening hours --}}
            <div
                class="p-8 lg:p-10 border transition-all duration-300"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="background-color: transparent; border-color: rgba(200,184,138,0.15); opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s, border-color 0.3s ease;"
                onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                onmouseout="this.style.borderColor='rgba(200,184,138,0.15)'"
            >
                <div class="w-10 h-10 flex items-center justify-center mb-6" style="background-color: {{ $primaryColor }};">
                    <svg class="w-5 h-5" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold uppercase tracking-wide text-sm mb-5" style="color: #ffffff; font-family: '{{ $headingFont }}';">
                    {{ __('Opening Hours') }}
                </h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        @php
                            $day      = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours    = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'closed') || str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-light" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">{{ $day }}</span>
                            <span class="text-sm font-medium" style="color: {{ $isClosed ? 'rgba(255,255,255,0.2)' : $primaryColor }}; font-family: '{{ $bodyFont }}';">
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
