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
    $title = $content['title'] ?? __('This Is Us');
    $subtitle = $content['subtitle'] ?? __('A team of creative minds with a passion for hair');
    $description = $content['description'] ?? __('At Studio everything revolves around your unique style. Our team of trendsetters and hair artists is ready to create the perfect look with you. Whether you come for a bold transformation or a fresh-up, we make it an experience!');
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
                            alt="{{ __('About us') }}"
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
            </div>
        </div>
    </div>
</section>
