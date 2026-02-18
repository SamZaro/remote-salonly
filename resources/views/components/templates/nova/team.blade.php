@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Ons Team';
    $subtitle = $content['subtitle'] ?? 'Maak kennis met onze stylisten';
    $members = $content['members'] ?? [];

    // Get member photos from media library (matched by index)
    $memberPhotos = $section?->getMedia('images') ?? collect();

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#8b5cf6';
    $secondaryColor = $theme['secondary_color'] ?? '#18181b';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#71717a';
    $headingColor = $theme['heading_color'] ?? '#18181b';

    // Dynamic grid
    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                </svg>
                <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <span class="text-sm font-medium uppercase tracking-widest mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl font-extrabold"
                style="color: {{ $headingColor }};"
                x-intersect="$el.classList.add('fadeInUp')"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Team Grid --}}
        @if(count($members) > 0)
            <div class="grid gap-8 {{ $gridCols }}" x-intersect="$el.classList.add('fadeInUp')">
                @foreach($members as $index => $member)
                    @php
                        $photo = $memberPhotos[$index] ?? null;
                        $photoUrl = $photo?->getUrl('thumb');
                        $initials = collect(explode(' ', $member['name'] ?? ''))
                            ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    <div class="group text-center">
                        {{-- Photo --}}
                        <div class="relative mx-auto mb-6 w-44 h-44 overflow-hidden rounded-sm">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center"
                                    style="background-color: {{ $secondaryColor }}; color: {{ $primaryColor }};"
                                >
                                    <svg class="w-16 h-16 opacity-60" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Hover overlay --}}
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                style="background: linear-gradient(to top, {{ $primaryColor }}cc, transparent);"
                            ></div>
                        </div>

                        {{-- Name --}}
                        <h3
                            class="text-lg font-bold mb-1 transition-colors duration-300"
                            style="color: {{ $headingColor }};"
                        >
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <span
                                class="text-sm font-medium uppercase tracking-wider"
                                style="color: {{ $primaryColor }};"
                            >
                                {{ $member['role'] }}
                            </span>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-3 text-sm leading-relaxed max-w-xs mx-auto" style="color: {{ $textColor }};">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty state --}}
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" style="color: {{ $textColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                </svg>
                <p style="color: {{ $textColor }};">{{ __('Voeg teamleden toe via het dashboard.') }}</p>
            </div>
        @endif

        {{-- Bottom decorative line --}}
        <div class="flex items-center justify-center mt-16">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
