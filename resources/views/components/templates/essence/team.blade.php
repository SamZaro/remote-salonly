{{--
    Template-specifieke team voor Essence (Soft Luxury Salon)

    Verfijnd, font-light, delicate borders, tracking-[0.3em], minimaal en elegant
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Ons Team';
    $subtitle = $content['subtitle'] ?? 'Maak kennis met onze specialisten';
    $members = $content['members'] ?? [];

    $memberPhotos = $section?->getMedia('images') ?? collect();

    // Theme kleuren - Soft Luxury
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-24 lg:py-32" style="background-color: {{ $accentColor }}40;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="w-12 h-px" style="background-color: {{ $secondaryColor }}40;"></div>
                <span class="text-xs font-medium uppercase tracking-[0.3em]" style="color: {{ $secondaryColor }};">Team</span>
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

        {{-- Team Grid --}}
        @if(count($members) > 0)
            <div class="grid gap-10 {{ $gridCols }}">
                @foreach($members as $index => $member)
                    @php
                        $photo = $memberPhotos[$index] ?? null;
                        $photoUrl = $photo?->getUrl('thumb');
                        $initials = collect(explode(' ', $member['name'] ?? ''))
                            ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    <div class="text-center group">
                        {{-- Photo --}}
                        <div class="relative mx-auto mb-8 w-48 h-48 overflow-hidden transition-all duration-300 group-hover:shadow-lg" style="box-shadow: 0 2px 20px {{ $secondaryColor }}05;">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center"
                                    style="background-color: {{ $accentColor }}; color: {{ $secondaryColor }};"
                                >
                                    <svg class="w-16 h-16 opacity-40" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Name --}}
                        <h3
                            class="text-lg font-light mb-1"
                            style="color: {{ $secondaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                        >
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <span class="text-xs font-medium uppercase tracking-[0.2em]" style="color: {{ $textColor }};">
                                {{ $member['role'] }}
                            </span>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-4 text-sm leading-relaxed font-light max-w-xs mx-auto" style="color: {{ $textColor }};">
                                {{ $member['bio'] }}
                            </p>
                        @endif

                        {{-- Delicate divider --}}
                        <div class="mt-6 mx-auto w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center font-light" style="color: {{ $textColor }};">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif
    </div>
</section>
