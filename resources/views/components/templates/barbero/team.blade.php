{{--
    Template-specifieke team voor Barbero (Luxury Barbershop)

    Corner accents, uppercase tracking, goud accenten, vierkante foto's
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Ons Team';
    $subtitle = $content['subtitle'] ?? 'De mannen achter de schaar';
    $members = $content['members'] ?? [];

    $memberPhotos = $section?->getMedia('images') ?? collect();

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                </svg>
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 uppercase tracking-wider"
                style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-2xl mx-auto opacity-70 uppercase tracking-widest" style="color: {{ $backgroundColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Team Grid --}}
        @if(count($members) > 0)
            <div class="grid gap-8 {{ $gridCols }}">
                @foreach($members as $index => $member)
                    @php
                        $photo = $memberPhotos[$index] ?? null;
                        $photoUrl = $photo?->getUrl('thumb');
                        $initials = collect(explode(' ', $member['name'] ?? ''))
                            ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    <div
                        class="relative p-6 border transition-all duration-300 hover:border-opacity-100 group"
                        style="border-color: {{ $primaryColor }}40; background-color: {{ $secondaryColor }};"
                    >
                        {{-- Corner accents --}}
                        <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                        <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>
                        <div class="absolute bottom-0 left-0 w-4 h-4 border-b-2 border-l-2" style="border-color: {{ $primaryColor }};"></div>
                        <div class="absolute bottom-0 right-0 w-4 h-4 border-b-2 border-r-2" style="border-color: {{ $primaryColor }};"></div>

                        {{-- Photo --}}
                        <div class="w-full aspect-square mb-6 overflow-hidden">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center"
                                    style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }};"
                                >
                                    <svg class="w-16 h-16 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="text-center">
                            <h3 class="text-lg font-bold uppercase tracking-wide mb-1" style="color: {{ $backgroundColor }};">
                                {{ $member['name'] ?? '' }}
                            </h3>
                            @if(!empty($member['role']))
                                <span class="text-xs uppercase tracking-wider" style="color: {{ $primaryColor }};">
                                    {{ $member['role'] }}
                                </span>
                            @endif
                            @if(!empty($member['bio']))
                                <p class="mt-3 text-sm leading-relaxed opacity-70" style="color: {{ $backgroundColor }};">
                                    {{ $member['bio'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center opacity-60" style="color: {{ $backgroundColor }};">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif
    </div>
</section>
