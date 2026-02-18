{{--
    Icon Template: Team Section
    "Warm Atelier" — editorial cards, gold accents, Cormorant Garamond, gold dividers, staggered reveal
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

    $primaryColor = $theme['primary_color'] ?? '#8B4513';
    $secondaryColor = $theme['secondary_color'] ?? '#3E2723';
    $accentColor = $theme['accent_color'] ?? '#D2691E';
    $textColor = $theme['text_color'] ?? '#6D4C41';
    $headingColor = $theme['heading_color'] ?? '#3E2723';
    $backgroundColor = $theme['background_color'] ?? '#FDF5E6';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-medium" style="color: {{ $primaryColor }};">
                    Team
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $textColor }};">
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
                        class="group relative text-center p-8 transition-all duration-500"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                    >
                        {{-- Gold top accent — expands on hover --}}
                        <div
                            class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                            style="background-color: {{ $primaryColor }};"
                        ></div>

                        {{-- Photo --}}
                        <div class="mx-auto mb-6 w-36 h-36 overflow-hidden">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center"
                                    style="background-color: {{ $secondaryColor }}; color: {{ $backgroundColor }};"
                                >
                                    <svg class="w-16 h-16 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Name --}}
                        <h3
                            class="text-[17px] mb-1"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                        >
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <div class="flex items-center justify-center gap-2.5 mt-2">
                                <div class="w-1 h-1 rounded-full shrink-0" style="background-color: {{ $primaryColor }};"></div>
                                <span class="text-[12px] font-medium uppercase tracking-[0.1em]" style="color: {{ $primaryColor }};">
                                    {{ $member['role'] }}
                                </span>
                            </div>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-4 text-[14px] leading-relaxed max-w-xs mx-auto" style="color: {{ $textColor }};">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-[15px]" style="color: {{ $textColor }};">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif

        {{-- Gold divider --}}
        <div class="flex items-center justify-center gap-0 mt-14">
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-1 h-1 rounded-full mx-1.5" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-8 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>
    </div>
</section>
