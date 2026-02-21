@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Contact Us';
    $subtitle = $content['subtitle'] ?? '';
    $email = $content['email'] ?? '';
    $phone = $content['phone'] ?? '';
    $address = $content['address'] ?? '';
@endphp

<section
    id="contact"
    class="py-20 px-4"
    style="background-color: {{ $theme['background_color'] ?? '#ffffff' }};"
>
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12">
            {{-- Contact Info --}}
            <div>
                @if($subtitle)
                    <p
                        class="text-sm font-semibold uppercase tracking-wider mb-2"
                        style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                    >
                        {{ $subtitle }}
                    </p>
                @endif

                <h2
                    class="text-3xl md:text-4xl font-bold mb-6"
                    style="
                        font-family: {{ $theme['heading_font_family'] ?? 'inherit' }};
                        color: {{ $theme['heading_color'] ?? '#111827' }};
                    "
                >
                    {{ $title }}
                </h2>

                <div class="space-y-4">
                    @if($email)
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center"
                                style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }}20;"
                            >
                                <svg class="w-5 h-5" style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <a
                                href="mailto:{{ $email }}"
                                class="hover:underline"
                                style="color: {{ $theme['text_color'] ?? '#1f2937' }};"
                            >
                                {{ $email }}
                            </a>
                        </div>
                    @endif

                    @if($phone)
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center"
                                style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }}20;"
                            >
                                <svg class="w-5 h-5" style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <a
                                href="tel:{{ $phone }}"
                                class="hover:underline"
                                style="color: {{ $theme['text_color'] ?? '#1f2937' }};"
                            >
                                {{ $phone }}
                            </a>
                        </div>
                    @endif

                    @if($address)
                        <div class="flex items-start gap-3">
                            <div
                                class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0"
                                style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }}20;"
                            >
                                <svg class="w-5 h-5" style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span style="color: {{ $theme['text_color'] ?? '#1f2937' }};">
                                {!! nl2br(e($address)) !!}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Opening Hours placeholder --}}
            <div class="flex flex-col justify-center">
                <h3
                    class="text-2xl font-bold mb-6"
                    style="
                        font-family: {{ $theme['heading_font_family'] ?? 'inherit' }};
                        color: {{ $theme['heading_color'] ?? '#111827' }};
                    "
                >
                    Openingstijden
                </h3>
                <div class="space-y-3">
                    @php
                        $openingHours = $content['opening_hours'] ?? [
                            ['day' => 'Maandag', 'hours' => 'Gesloten'],
                            ['day' => 'Dinsdag', 'hours' => '09:00 - 18:00'],
                            ['day' => 'Woensdag', 'hours' => '09:00 - 18:00'],
                            ['day' => 'Donderdag', 'hours' => '09:00 - 21:00'],
                            ['day' => 'Vrijdag', 'hours' => '09:00 - 18:00'],
                            ['day' => 'Zaterdag', 'hours' => '09:00 - 17:00'],
                            ['day' => 'Zondag', 'hours' => 'Gesloten'],
                        ];
                    @endphp
                    @foreach($openingHours as $entry)
                        @php
                            $day = is_array($entry) ? ($entry['day'] ?? '') : $entry;
                            $hours = is_array($entry) ? ($entry['hours'] ?? '') : '';
                            $isClosed = str_contains(strtolower($hours), 'gesloten');
                        @endphp
                        <div class="flex justify-between items-center text-sm py-1">
                            <span style="color: {{ $theme['text_color'] ?? '#1f2937' }};">{{ $day }}</span>
                            <span
                                class="{{ $isClosed ? 'opacity-50' : 'font-semibold' }}"
                                style="color: {{ $isClosed ? ($theme['text_color'] ?? '#1f2937') : ($theme['primary_color'] ?? '#3b82f6') }};"
                            >
                                {{ $hours }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
