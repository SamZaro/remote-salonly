{{--
    Glaze Template: Team Section
    Clean card-based team grid with rose accent hovers
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Our Team');
    $subtitle = $content['subtitle'] ?? __('Meet our specialists');
    $members = $content['members'] ?? [];

    $memberPhotos = $section?->getMedia('images') ?? collect();

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    $memberCount = count($members);
    $gridCols = match(true) {
        $memberCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $memberCount === 3 => 'md:grid-cols-3 max-w-5xl mx-auto',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };
@endphp

<section id="team" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.25em]" style="color: {{ $primaryColor }};">{{ $subtitle }}</span>
                <div class="w-12 h-0.5 rounded-full" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Team Grid --}}
        @if(count($members) > 0)
            <div class="grid gap-8 {{ $gridCols }}" x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'" style="opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);">
                @foreach($members as $index => $member)
                    @php
                        $photo = $memberPhotos[$index] ?? null;
                        $photoUrl = $photo?->getUrl('thumb');
                    @endphp
                    <div class="group text-center">
                        {{-- Photo --}}
                        <div class="relative mx-auto mb-6 w-40 h-40 overflow-hidden rounded-2xl">
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
                                    <svg class="w-14 h-14 opacity-50" fill="currentColor" viewBox="0 0 24 24">
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

                        <h3 class="text-lg font-bold mb-1" style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;">
                            {{ $member['name'] ?? '' }}
                        </h3>

                        @if(!empty($member['role']))
                            <span class="text-sm font-semibold uppercase tracking-wider" style="color: {{ $primaryColor }};">
                                {{ $member['role'] }}
                            </span>
                        @endif

                        @if(!empty($member['bio']))
                            <p class="mt-3 text-sm leading-relaxed max-w-xs mx-auto" style="color: {{ $textColor }};">
                                {{ $member['bio'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                </svg>
                <p style="color: {{ $textColor }};">{{ __('Add team members via the dashboard.') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-center mt-16">
            <div class="h-0.5 w-32 rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}, transparent);"></div>
        </div>
    </div>
</section>
