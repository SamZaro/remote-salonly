@props([
    'content' => [],
    'theme' => [],
    'template' => null,
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Contact';
    $address = $content['address'] ?? 'Oostermeent West 15, 7274 SP Huizen';
    $phone = $content['phone'] ?? '035-5447595';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);

    // Openingstijden - flexibele structuur
    $rawHours = $content['opening_hours'] ?? [];
    $openingHours = collect($rawHours)->map(function ($entry) {
        return [
            'day' => $entry['day'] ?? $entry['label'] ?? '',
            'hours' => $entry['hours'] ?? $entry['time'] ?? $entry['value'] ?? '',
        ];
    })->toArray();

    if (empty($openingHours)) {
        $openingHours = [
            ['day' => 'Maandag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Dinsdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Woensdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Donderdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Vrijdag', 'hours' => '09:00 - 21:00'],
            ['day' => 'Zaterdag', 'hours' => '09:00 - 18:00'],
            ['day' => 'Zondag', 'hours' => 'Gesloten'],
        ];
    }

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#14B8A6';
    $backgroundColor = $theme['background_color'] ?? '#FFFFFF';
    $textColor = $theme['text_color'] ?? '#57534E';
    $headingColor = $theme['heading_color'] ?? '#44403C';

    // Logo configuratie op basis van theme_config
    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<section id="contact" class="py-16 lg:py-24" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl font-extrabold mb-4"
                style="color: {{ $headingColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Content grid --}}
        <div class="grid md:grid-cols-3 gap-6" x-intersect="$el.classList.add('fadeInUp')">

            {{-- Adres & Contact --}}
            <div class="rounded p-8" style="background-color: {{ $primaryColor }};">
                <h3 class="text-2xl font-medium text-white mb-4">Adres & Contact</h3>
                <div class="text-white text-lg space-y-1">
                    @foreach(explode(',', $address) as $line)
                        <p>{{ trim($line) }}</p>
                    @endforeach
                    <p class="font-semibold pt-2">{{ $phone }}</p>
                </div>
            </div>

            {{-- Afbeelding --}}
            <div class="rounded overflow-hidden bg-gray-100">
                @if($image)
                    <img
                        src="{{ $image }}"
                        alt="{{ $title }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full min-h-[250px] flex items-center justify-center" style="background-color: {{ $textColor }}20;">
                        <svg class="w-12 h-12 opacity-30" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Openingstijden --}}
            <div class="rounded p-8" style="background-color: {{ $primaryColor }};">
                <h3 class="text-2xl font-medium text-white mb-4">Openingstijden</h3>
                <div class="space-y-1">
                    @foreach($openingHours as $entry)
                        <p class="text-white text-lg">
                            {{ $entry['day'] }}: {{ $entry['hours'] }}
                        </p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
