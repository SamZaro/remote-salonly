{{--
    Urban Template: Team Section
    Light section — square photos, no borders, editorial layout
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title        = $content['title'] ?? 'Ons Team';
    $subtitle     = $content['subtitle'] ?? 'De mannen achter de schaar';
    $members      = $content['members'] ?? [];
    $memberPhotos = $section?->getMedia('images') ?? collect();

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Barlow, sans-serif';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'sm:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-px" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-bold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Team</span>
            </div>
            <h2
                class="font-black uppercase leading-[0.9]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.02em; color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-lg" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
        </div>

        @if(count($members) > 0)
            <div class="grid gap-8 {{ $gridCols }}">
                @foreach($members as $index => $member)
                    @php
                        $photo    = $memberPhotos[$index] ?? null;
                        $photoUrl = $photo?->getUrl('thumb');
                        $initials = collect(explode(' ', $member['name'] ?? ''))
                            ->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    <div
                        class="group"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s;"
                    >
                        {{-- Photo --}}
                        <div class="aspect-square overflow-hidden mb-5" style="background-color: {{ $secondaryColor }};">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    style="filter: grayscale(15%);"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span
                                        class="text-3xl font-black"
                                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';"
                                    >
                                        {{ $initials }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Gold accent line --}}
                        <div class="w-10 h-0.5 mb-4" style="background-color: {{ $primaryColor }};"></div>

                        {{-- Info --}}
                        <h3
                            class="text-xl font-black uppercase tracking-wide"
                            style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}';"
                        >
                            {{ $member['name'] ?? '' }}
                        </h3>
                        @if(!empty($member['role']))
                            <p class="text-sm uppercase tracking-widest mt-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                                {{ $member['role'] }}
                            </p>
                        @endif
                        @if(!empty($member['bio']))
                            <p class="text-sm leading-relaxed mt-3" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-base" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif

        {{-- CTA --}}
        <div class="mt-14">
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 font-bold uppercase tracking-widest text-sm transition-colors"
                style="color: {{ $headingColor }}; font-family: '{{ $bodyFont }}';"
            >
                Maak een afspraak
                <span class="w-8 h-px transition-all duration-300 group-hover:w-14" style="background-color: {{ $primaryColor }};"></span>
            </a>
        </div>
    </div>
</section>
