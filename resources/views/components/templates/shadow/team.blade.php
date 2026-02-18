{{--
    Template-specifieke team voor Shadow (Minimal Barbershop)

    Ultra-minimal, semantic HTML, figure/figcaption, rounded-full, clean
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
    $primaryColor = $theme['primary_color'] ?? '#171717';
    $secondaryColor = $theme['secondary_color'] ?? '#0a0a0a';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        @if($title || $subtitle)
            <div class="mb-24 text-center">
                @if($subtitle)
                    <span
                        class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                        style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                    >
                        {{ $subtitle }}
                    </span>
                @endif
                @if($title)
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                        style="color: {{ $headingColor }};"
                    >
                        {{ $title }}
                    </h2>
                @endif
            </div>
        @endif

        {{-- Team Grid --}}
        @if(count($members) > 0)
            <div class="grid gap-12 {{ $gridCols }}">
                @foreach($members as $index => $member)
                    @php
                        $photo = $memberPhotos[$index] ?? null;
                        $photoUrl = $photo?->getUrl('thumb');
                        $initials = collect(explode(' ', $member['name'] ?? ''))
                            ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    <figure class="text-center">
                        {{-- Photo --}}
                        <div class="mx-auto mb-6 w-36 h-36 rounded-full overflow-hidden">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover"
                                />
                            @else
                                <div
                                    class="w-full h-full rounded-full flex items-center justify-center bg-gray-200"
                                    style="color: {{ $secondaryColor }};"
                                >
                                    <svg class="w-14 h-14 opacity-40" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <figcaption>
                            <cite class="block text-lg font-semibold not-italic mb-1" style="color: {{ $headingColor }};">
                                {{ $member['name'] ?? '' }}
                            </cite>
                            @if(!empty($member['role']))
                                <cite class="block text-sm not-italic opacity-75" style="color: {{ $textColor }};">
                                    {{ $member['role'] }}
                                </cite>
                            @endif
                            @if(!empty($member['bio']))
                                <p class="mt-3 text-sm leading-relaxed max-w-xs mx-auto" style="color: {{ $textColor }};">
                                    {{ $member['bio'] }}
                                </p>
                            @endif
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: {{ $textColor }};">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif
    </div>
</section>
