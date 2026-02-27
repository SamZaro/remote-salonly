{{--
    Glow Template: Team Section
    Warm minimalist — clean cards, no decorative corners or ring borders
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

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
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

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $accentColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div
            class="text-center mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
        >
            <span class="text-xs font-semibold uppercase tracking-[0.2em] mb-4 block" style="color: {{ $secondaryColor }};">
                Team
            </span>
            <h2 class="text-4xl sm:text-5xl font-bold mb-4" style="color: {{ $headingColor }}; font-family: 'Raleway', sans-serif;">
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
                        class="text-center"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        x-bind:style="'opacity: 0; transform: translateY(16px); transition: all 0.6s ease-out {{ $index * 0.1 }}s;'"
                    >
                        {{-- Photo --}}
                        <div class="w-32 h-32 mx-auto mb-5 overflow-hidden" style="border-radius: 50%;">
                            @if($photoUrl)
                                <img src="{{ $photoUrl }}" alt="{{ $member['name'] ?? '' }}" class="w-full h-full object-cover" />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-xl font-bold"
                                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                                >
                                    {{ $initials }}
                                </div>
                            @endif
                        </div>

                        {{-- Name --}}
                        <h3 class="text-lg font-bold mb-1" style="color: {{ $headingColor }};">
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <span class="text-sm font-medium uppercase tracking-wider" style="color: {{ $textColor }};">
                                {{ $member['role'] }}
                            </span>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-3 leading-relaxed" style="color: {{ $textColor }};">
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
    </div>
</section>
