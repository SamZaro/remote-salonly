{{--
    Level Template: Team Section
    Light section — square photos, orange accent line, editorial layout
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title        = $content['title'] ?? 'Ons Team';
    $subtitle     = $content['subtitle'] ?? 'De mensen achter de schaar';
    $members      = $content['members'] ?? [];
    $memberPhotos = $section?->getMedia('images') ?? collect();

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#111111';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'sm:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Header --}}
        <div
            class="mb-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(20px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center gap-3 mb-6">
                <div class="w-9 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Team</span>
            </div>
            <h2
                class="font-black leading-[0.9]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.03em; color: #ffffff;"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-base font-light" style="color: rgba(255,255,255,0.55); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
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
                        class="group border transition-all duration-300 p-0"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, border-color 0.3s ease; border-color: rgba(255,255,255,0.1);"
                        onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'"
                    >
                        {{-- Square photo --}}
                        <div class="aspect-square overflow-hidden" style="background-color: rgba(255,255,255,0.05);">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
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

                        {{-- Info --}}
                        <div class="p-6">
                            {{-- Orange accent line --}}
                            <div class="w-8 h-0.5 mb-4 transition-all duration-300 group-hover:w-16" style="background-color: {{ $primaryColor }};"></div>

                            <h3
                                class="text-base font-bold uppercase tracking-wide"
                                style="color: #ffffff; font-family: '{{ $headingFont }}';"
                            >
                                {{ $member['name'] ?? '' }}
                            </h3>
                            @if(!empty($member['role']))
                                <p class="text-xs font-semibold uppercase tracking-widest mt-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                                    {{ $member['role'] }}
                                </p>
                            @endif
                            @if(!empty($member['bio']))
                                <p class="text-sm leading-relaxed font-light mt-2" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">
                                    {{ $member['bio'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-base font-light" style="color: rgba(255,255,255,0.5); font-family: '{{ $bodyFont }}';">
                {{ __('Voeg teamleden toe via het dashboard.') }}
            </p>
        @endif

        {{-- CTA --}}
        <div class="mt-14">
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 font-semibold uppercase tracking-widest text-sm transition-colors"
                style="color: rgba(255,255,255,0.7); font-family: '{{ $bodyFont }}';"
                onmouseover="this.style.color='{{ $primaryColor }}'"
                onmouseout="this.style.color='rgba(255,255,255,0.7)'"
            >
                Maak een afspraak
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
