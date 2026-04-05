{{--
    Glaze Template: Contact Section
    Three-column grid with rose accent panels
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'template' => null,
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Contact';
    $address = $content['address'] ?? 'Voorbeeldstraat 10, 1234 AB Amsterdam';
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
            ['day' => __('Thursday'), 'hours' => '09:00 - 21:00'],
            ['day' => __('Friday'), 'hours' => '09:00 - 18:00'],
            ['day' => __('Saturday'), 'hours' => '09:00 - 17:00'],
            ['day' => __('Sunday'), 'hours' => __('Closed')],
        ];
    }

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        {{-- Header --}}
        <div class="text-center mb-14">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">{{ __('Get in touch') }}</span>
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Content grid --}}
        <div class="grid md:grid-cols-3 gap-5" x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);">

            {{-- Address & Contact --}}
            <div class="rounded-2xl p-8" style="background-color: {{ $primaryColor }};">
                <h3 class="text-xl font-bold text-white mb-5" style="font-family: '{{ $headingFont }}', sans-serif;">{{ __('Address & Contact') }}</h3>
                <div class="text-white/90 text-base space-y-1">
                    @foreach(explode(',', $address) as $line)
                        <p>{{ trim($line) }}</p>
                    @endforeach
                    <p class="font-semibold pt-3">{{ $phone }}</p>
                </div>
            </div>

            {{-- Image --}}
            <div class="rounded-2xl overflow-hidden bg-gray-100">
                @if($image)
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover" />
                @else
                    <div class="w-full h-full min-h-[250px] flex items-center justify-center" style="background-color: {{ $primaryColor }}08;">
                        <svg class="w-12 h-12 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Opening Hours --}}
            <div class="rounded-2xl p-8" style="background-color: {{ $primaryColor }};">
                <h3 class="text-xl font-bold text-white mb-5" style="font-family: '{{ $headingFont }}', sans-serif;">{{ __('Opening Hours') }}</h3>
                <div class="space-y-1.5">
                    @foreach($openingHours as $entry)
                        <p class="text-white/90 text-base">
                            {{ $entry['day'] }}: {{ $entry['hours'] }}
                        </p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
