{{--
    King Template: Team Section
    "Royal Throne" — editorial cards, diamond accents, bold barbershop team showcase
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Our Barbers');
    $subtitle = $content['subtitle'] ?? __('Master craftsmen at your service');
    $members = $content['members'] ?? [];

    $memberPhotos = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-24 lg:py-36" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ __('The Crew') }}
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $backgroundColor }}60;">
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
                    @endphp
                    <div
                        class="group relative text-center transition-all duration-500"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                    >
                        {{-- Photo --}}
                        <div class="relative mx-auto mb-6 w-40 h-40 overflow-hidden">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center"
                                    style="background-color: {{ $secondaryColor }}; border: 1px solid {{ $primaryColor }}15;"
                                >
                                    <svg class="w-16 h-16 opacity-30" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Gold corner accents on hover --}}
                            <div class="absolute top-0 left-0 w-4 h-px opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background-color: {{ $primaryColor }};"></div>
                            <div class="absolute top-0 left-0 w-px h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background-color: {{ $primaryColor }};"></div>
                            <div class="absolute bottom-0 right-0 w-4 h-px opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background-color: {{ $primaryColor }};"></div>
                            <div class="absolute bottom-0 right-0 w-px h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background-color: {{ $primaryColor }};"></div>
                        </div>

                        {{-- Name --}}
                        <h3
                            class="text-[17px] mb-1"
                            style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
                        >
                            {{ $member['name'] ?? '' }}
                        </h3>

                        {{-- Role --}}
                        @if(!empty($member['role']))
                            <div class="flex items-center justify-center gap-2.5 mt-2">
                                <div class="w-1.5 h-1.5 rotate-45 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                                <span class="text-[11px] font-semibold uppercase tracking-[0.15em]" style="color: {{ $primaryColor }};">
                                    {{ $member['role'] }}
                                </span>
                            </div>
                        @endif

                        {{-- Bio --}}
                        @if(!empty($member['bio']))
                            <p class="mt-4 text-[13px] leading-relaxed max-w-xs mx-auto" style="color: {{ $backgroundColor }}50;">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-[15px]" style="color: {{ $backgroundColor }}50;">
                {{ __('Add team members via the dashboard.') }}
            </p>
        @endif

        {{-- Diamond divider --}}
        <div class="flex items-center justify-center gap-0 mt-14">
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }}40;"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }}40;"></div>
            <div class="w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }};"></div>
            <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }}40;"></div>
            <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }}40;"></div>
        </div>
    </div>
</section>
