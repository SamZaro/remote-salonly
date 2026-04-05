{{--
    Blush Template: Contact Section
    Elegant nail studio — three-column contact with warm luxury tones
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'template' => null,
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Contact');
    $address = $content['address'] ?? 'Kerkstraat 42, 1017 GP Amsterdam';
    $phone = $content['phone'] ?? '020-1234567';
    $image = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);

    $rawHours = $content['opening_hours'] ?? [];
    $openingHours = collect($rawHours)->map(function ($entry) {
        return [
            'day' => $entry['day'] ?? $entry['label'] ?? '',
            'hours' => $entry['hours'] ?? $entry['time'] ?? $entry['value'] ?? '',
        ];
    })->toArray();

    if (empty($openingHours)) {
        $openingHours = [
            ['day' => __('Monday'), 'hours' => '09:00 - 18:00'],
            ['day' => __('Tuesday'), 'hours' => '09:00 - 18:00'],
            ['day' => __('Wednesday'), 'hours' => '09:00 - 18:00'],
            ['day' => __('Thursday'), 'hours' => '09:00 - 20:00'],
            ['day' => __('Friday'), 'hours' => '09:00 - 18:00'],
            ['day' => __('Saturday'), 'hours' => '10:00 - 17:00'],
            ['day' => __('Sunday'), 'hours' => __('Closed')],
        ];
    }

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';

    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<section id="contact" class="py-20 lg:py-32" style="background-color: {{ $backgroundColor }}; font-family: {{ $bodyFont }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                </svg>
                <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light mb-4"
                style="color: {{ $headingColor }}; font-family: {{ $headingFont }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $headingColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Content grid --}}
        <div class="grid md:grid-cols-3 gap-6" x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;">

            {{-- Address & Contact --}}
            <div class="p-8 lg:p-10" style="background-color: {{ $secondaryColor }};">
                <h3 class="text-xl font-light mb-6" style="color: {{ $primaryColor }}; font-family: {{ $headingFont }};">{{ __('Address & Contact') }}</h3>
                <div class="space-y-2">
                    @foreach(explode(',', $address) as $line)
                        <p class="text-sm" style="color: rgba(255,255,255,0.60);">{{ trim($line) }}</p>
                    @endforeach
                    <p class="text-sm font-medium pt-3" style="color: {{ $primaryColor }};">{{ $phone }}</p>
                </div>
            </div>

            {{-- Image --}}
            <div class="overflow-hidden">
                @if($image)
                    <img
                        src="{{ $image }}"
                        alt="{{ $title }}"
                        class="w-full h-full object-cover"
                    >
                @else
                    <div class="w-full h-full min-h-[280px] flex items-center justify-center" style="background-color: {{ $accentColor }}30;">
                        <svg class="w-12 h-12 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Opening Hours --}}
            <div class="p-8 lg:p-10" style="background-color: {{ $secondaryColor }};">
                <h3 class="text-xl font-light mb-6" style="color: {{ $primaryColor }}; font-family: {{ $headingFont }};">{{ __('Opening Hours') }}</h3>
                <div class="space-y-2">
                    @foreach($openingHours as $entry)
                        <div class="flex justify-between text-sm">
                            <span style="color: rgba(255,255,255,0.60);">{{ $entry['day'] }}</span>
                            <span style="color: rgba(255,255,255,0.80);">{{ $entry['hours'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
