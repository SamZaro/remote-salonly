{{--
    Template-specifieke team voor Razor (Vintage Barbershop)

    Vierkante foto's, scherpe hoeken, Google-review stijl, vintage kleuren
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
    $primaryColor = $theme['primary_color'] ?? '#8B4513';
    $secondaryColor = $theme['secondary_color'] ?? '#3E2723';
    $accentColor = $theme['accent_color'] ?? '#D2691E';
    $backgroundColor = $theme['background_color'] ?? '#FDF5E6';
    $textColor = $theme['text_color'] ?? '#6D4C41';
    $headingColor = $theme['heading_color'] ?? '#3E2723';

    $headingFont = $theme['heading_font_family'] ?? 'Bebas Neue';
    $bodyFont = $theme['font_family'] ?? 'Barlow';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $accentColor }}15;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                Team
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Team Grid --}}
        @if(count($members) > 0)
            <div class="grid gap-6 {{ $gridCols }}">
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
                        class="p-6 transition-all duration-300 hover:-translate-y-1 group"
                        style="background-color: {{ $backgroundColor }}; box-shadow: 0 4px 20px rgba(0,0,0,0.05);"
                    >
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
                                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                                >
                                    <svg class="w-16 h-16 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex items-center gap-4">
                            <div>
                                <h3 class="font-bold" style="color: {{ $headingColor }};">
                                    {{ $member['name'] ?? '' }}
                                </h3>
                                @if(!empty($member['role']))
                                    <span class="text-sm opacity-70" style="color: {{ $textColor }};">
                                        {{ $member['role'] }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-3 text-sm leading-relaxed opacity-80" style="color: {{ $textColor }};">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: {{ $textColor }};">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif

        {{-- Bottom CTA --}}
        <div class="text-center mt-12">
            <a
                href="#contact"
                class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest transition-colors hover:opacity-80"
                style="color: {{ $primaryColor }};"
            >
                Maak een afspraak
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
