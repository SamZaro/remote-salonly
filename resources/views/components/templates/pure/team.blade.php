{{--
    Pure Template: Team Section
    Natural & Botanical — team cards with hover effect and transparent watermark
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Ons Team';
    $subtitle = $content['subtitle'] ?? 'Maak kennis met onze stylisten';
    $members = $content['members'] ?? [];
    $memberPhotos = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $accentColor }}20;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div
            class="text-center mb-16 relative"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <span
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 whitespace-nowrap pointer-events-none select-none font-bold"
                style="font-size: clamp(3rem, 8vw, 5rem); opacity: 0.04; color: {{ $secondaryColor }}; font-family: '{{ $headingFont }}', serif;"
            >Our Team</span>

            <span class="text-xs font-semibold uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $subtitle }}
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                {{ $title }}
            </h2>
            <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                Maak kennis met onze specialisten
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
                        class="text-center group"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        x-bind:style="'opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s;'"
                    >
                        {{-- Photo --}}
                        <div class="relative mb-6 overflow-hidden rounded-none">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-72 object-cover transition-transform duration-700 group-hover:scale-105"
                                />
                            @else
                                <div
                                    class="w-full h-72 flex items-center justify-center text-3xl font-bold"
                                    style="background-color: {{ $accentColor }}30; color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;"
                                >
                                    {{ $initials }}
                                </div>
                            @endif
                            {{-- Hover overlay --}}
                            <div
                                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 opacity-0 group-hover:opacity-100"
                                style="background-color: {{ $primaryColor }}40;"
                            ></div>
                        </div>

                        {{-- Name --}}
                        <h3 class="text-lg font-bold mb-1" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif;">
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <span class="text-sm font-medium uppercase tracking-wider" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                                {{ $member['role'] }}
                            </span>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-3 leading-relaxed" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif
    </div>
</section>
