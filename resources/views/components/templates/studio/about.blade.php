{{--
    Template-specifieke about voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Dit Zijn Wij';
    $subtitle = $content['subtitle'] ?? 'Een team van creatieve minds met een passie voor haar';
    $description = $content['description'] ?? 'Bij Studio draait alles om jouw unieke stijl. Ons team van trendsetters en hair artists staat klaar om samen met jou de perfecte look te creëren. Of je nu komt voor een bold transformation of een fresh-up, wij maken er een ervaring van!';
    $features = $content['features'] ?? [
        ['icon' => 'sparkles', 'title' => 'Creatief Team', 'description' => 'Award-winning stylisten'],
        ['icon' => 'trending-up', 'title' => 'Trendsetting', 'description' => 'Altijd up-to-date'],
        ['icon' => 'heart', 'title' => 'Good Vibes', 'description' => 'Relaxte sfeer'],
    ];
    $aboutImage = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
    $headingFont = $theme['heading_font_family'] ?? 'Abril Fatface';
    $bodyFont = $theme['font_family'] ?? 'Nunito';

    // Icons mapping
    $icons = [
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
        'trending-up' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
    ];
@endphp

<section id="about" class="py-24 lg:py-32 relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Image side --}}
            <div class="relative">
                @if($aboutImage)
                    <div class="relative">
                        <div class="absolute inset-0 rounded-3xl rotate-6" style="background: {{ $primaryColor }};"></div>
                        <img
                            src="{{ $aboutImage }}"
                            alt="Over ons"
                            class="relative w-full h-[500px] object-cover rounded-3xl"
                            style="box-shadow: 8px 8px 0 {{ $secondaryColor }};"
                        />
                    </div>
                @else
                    <div class="relative">
                        <div class="absolute inset-0 rounded-3xl rotate-6" style="background: {{ $primaryColor }};"></div>
                        <div
                            class="relative w-full h-[500px] rounded-3xl flex items-center justify-center"
                            style="background: {{ $accentColor }}; box-shadow: 8px 8px 0 {{ $secondaryColor }};"
                        >
                            <svg class="w-24 h-24" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                @endif

                {{-- Stats badge --}}
                <div
                    class="absolute -bottom-6 -right-6 p-6 rounded-2xl bg-white hidden lg:block transform rotate-3"
                    style="box-shadow: 4px 4px 0 {{ $primaryColor }};"
                >
                    <div class="text-center">
                        <p class="text-4xl font-black" style="color: {{ $primaryColor }};">10+</p>
                        <p class="text-sm font-bold" style="color: {{ $headingColor }};">Jaar ervaring</p>
                    </div>
                </div>
            </div>

            {{-- Content side --}}
            <div>
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6"
                    style="background: {{ $primaryColor }}; color: white;"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    ABOUT US
                </div>

                {{-- Title --}}
                <h2
                    class="text-4xl sm:text-5xl font-black mb-6 leading-tight"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle --}}
                <p class="text-xl font-medium mb-6" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </p>

                {{-- Description --}}
                <p class="text-lg mb-10 leading-relaxed" style="color: {{ $textColor }};">
                    {{ $description }}
                </p>

                {{-- Features --}}
                <div class="grid sm:grid-cols-3 gap-6 mb-10">
                    @foreach($features as $index => $feature)
                        <div
                            class="p-4 rounded-2xl text-center transform transition-transform hover:scale-105 hover:-rotate-2"
                            style="background: {{ $index === 0 ? $primaryColor : ($index === 1 ? $secondaryColor : $accentColor) }}; box-shadow: 4px 4px 0 {{ $index === 2 ? $secondaryColor : $accentColor }};"
                        >
                            <div class="w-12 h-12 rounded-xl mx-auto mb-3 flex items-center justify-center" style="background: {{ $index === 2 ? $primaryColor : 'white' }}20;">
                                <svg class="w-6 h-6" style="color: {{ $index === 2 ? $headingColor : 'white' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $icons[$feature['icon']] ?? $icons['sparkles'] !!}
                                </svg>
                            </div>
                            <h4 class="font-bold mb-1" style="color: {{ $index === 2 ? $headingColor : 'white' }};">{{ $feature['title'] }}</h4>
                            <p class="text-sm" style="color: {{ $index === 2 ? $textColor : 'white' }}; opacity: 0.9;">{{ $feature['description'] }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#team"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-bold transition-all hover:scale-105"
                    style="background: {{ $secondaryColor }}; color: white; box-shadow: 4px 4px 0 {{ $primaryColor }};"
                >
                    Meet the Team
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
