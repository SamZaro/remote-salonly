{{--
    Fade Template: Team Section
    Dark section — square photos, gold accent line, editorial layout
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title        = $content['title'] ?? __('Our Team');
    $subtitle     = $content['subtitle'] ?? __('The men behind the scissors');
    $members      = $content['members'] ?? [];
    $memberPhotos = $section?->getMedia('images') ?? collect();

    $primaryColor    = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor  = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont     = $theme['heading_font_family'] ?? 'Rajdhani, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Outfit, sans-serif';

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
                <div class="w-10 h-0.5 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">Team</span>
            </div>
            <h2
                class="font-bold uppercase leading-[0.85]"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.4rem, 4.5vw, 4rem); letter-spacing: -0.02em; color: #ffffff;"
            >
                {{ $title }}
            </h2>
            <p class="mt-3 text-base font-light" style="color: rgba(255,255,255,0.45); font-family: '{{ $bodyFont }}';">{{ $subtitle }}</p>
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
                        style="opacity: 0; transform: translateY(20px); transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, transform 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $loop->index * 0.1 }}s, border-color 0.3s ease; border-color: rgba(200,184,138,0.15);"
                        onmouseover="this.style.borderColor='{{ $primaryColor }}'"
                        onmouseout="this.style.borderColor='rgba(200,184,138,0.15)'"
                    >
                        {{-- Square photo --}}
                        <div class="aspect-square overflow-hidden" style="background-color: rgba(200,184,138,0.05);">
                            @if($photoUrl)
                                <img
                                    src="{{ $photoUrl }}"
                                    alt="{{ $member['name'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span
                                        class="text-3xl font-bold"
                                        style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}';"
                                    >
                                        {{ $initials }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-6">
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
                                <p class="text-sm leading-relaxed font-light mt-2" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">
                                    {{ $member['bio'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-base font-light" style="color: rgba(255,255,255,0.4); font-family: '{{ $bodyFont }}';">
                {{ __('Add team members via the dashboard.') }}
            </p>
        @endif

        <div class="mt-14">
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 font-semibold uppercase tracking-widest text-sm transition-colors"
                style="color: rgba(255,255,255,0.6); font-family: '{{ $bodyFont }}';"
                onmouseover="this.style.color='{{ $primaryColor }}'"
                onmouseout="this.style.color='rgba(255,255,255,0.6)'"
            >
                {{ __('Book an appointment') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
