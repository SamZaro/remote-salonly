{{--
    Template-specifieke team voor Blossom (Beauty Salon)

    Ronde foto's, gradient accenten, hearts, rounded-2xl cards, zacht en vrouwelijk
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

    // Theme kleuren
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

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <span
                class="inline-flex items-center gap-2 text-sm font-medium mb-4 px-5 py-2 rounded-full"
                style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $secondaryColor }};"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                Team
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-6"
                style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }};">
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
                        class="text-center p-8 rounded-2xl bg-white transition-all duration-300 hover:-translate-y-1 hover:shadow-xl relative overflow-hidden group"
                        style="box-shadow: 0 4px 20px {{ $primaryColor }}10;"
                    >
                        {{-- Decorative corner --}}
                        <div
                            class="absolute top-0 right-0 w-20 h-20 rounded-bl-[3rem] opacity-10"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        ></div>

                        {{-- Photo --}}
                        <div class="relative mx-auto mb-6 w-36 h-36 rounded-full overflow-hidden ring-4 ring-offset-4" style="--tw-ring-color: {{ $primaryColor }}40; --tw-ring-offset-color: white;">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-white"
                                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                                >
                                    <svg class="w-14 h-14 opacity-70" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Name --}}
                        <h3 class="text-lg font-semibold mb-1" style="color: {{ $headingColor }};">
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <span
                                class="inline-flex items-center gap-1 text-sm font-medium px-3 py-1 rounded-full"
                                style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10); color: {{ $secondaryColor }};"
                            >
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                {{ $member['role'] }}
                            </span>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-4 text-sm leading-relaxed" style="color: {{ $textColor }};">
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
