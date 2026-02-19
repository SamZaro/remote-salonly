{{--
    Template-specifieke team voor Studio (Creative Hair Studio)

    Creatief, energiek, rotaties, rounded-3xl, box-shadow offset, font-black Montserrat
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Meet The Crew';
    $subtitle = $content['subtitle'] ?? 'De creatievelingen achter jouw look';
    $members = $content['members'] ?? [];

    $memberPhotos = $section?->getMedia('images') ?? collect();

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };

    $rotations = ['-rotate-2', 'rotate-1', '-rotate-1', 'rotate-2'];
    $shadowColors = [$primaryColor, $secondaryColor, $accentColor, $primaryColor];
@endphp

<section id="team" class="py-24 lg:py-32 relative overflow-hidden" style="background: linear-gradient(135deg, {{ $accentColor }}50, {{ $backgroundColor }});">


    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6 transform rotate-2"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                </svg>
                TEAM
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6"
                style="color: {{ $headingColor }}; font-family: 'Montserrat', 'Poppins', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-xl max-w-2xl mx-auto" style="color: {{ $textColor }};">
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
                        $rotation = $rotations[$index % count($rotations)];
                        $shadowColor = $shadowColors[$index % count($shadowColors)];
                    @endphp
                    <div
                        class="text-center p-8 rounded-3xl transition-all duration-300 hover:scale-105 {{ $rotation }} hover:rotate-0 group"
                        style="background: white; box-shadow: 6px 6px 0 {{ $shadowColor }};"
                    >
                        {{-- Photo --}}
                        <div class="mx-auto mb-6 w-32 h-32 rounded-full overflow-hidden ring-4" style="--tw-ring-color: {{ $primaryColor }}30;">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-white"
                                    style="background: {{ $index % 2 === 0 ? $primaryColor : $secondaryColor }};"
                                >
                                    <svg class="w-14 h-14 opacity-70" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Name --}}
                        <h3 class="text-lg font-bold mb-1" style="color: {{ $headingColor }};">
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <span class="text-sm font-medium" style="color: {{ $primaryColor }};">
                                {{ $member['role'] }}
                            </span>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-3 text-sm leading-relaxed" style="color: {{ $textColor }};">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-lg" style="color: {{ $textColor }};">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif
    </div>
</section>
