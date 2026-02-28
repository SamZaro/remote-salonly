{{--
    Template-specifieke testimonials voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Love From Our Clients';
    $subtitle = $content['subtitle'] ?? 'Wat onze happy customers zeggen';
    $testimonials = $content['testimonials'] ?? [
        [
            'name' => 'Lisa M.',
            'role' => '@lisa.styles',
            'quote' => 'Beste balayage ooit! Het team snapt precies wat je wilt en maakt het nog beter dan je had voorgesteld.',
            'rating' => 5,
        ],
        [
            'name' => 'Emma K.',
            'role' => '@emmak_',
            'quote' => 'Super relaxte sfeer, goede muziek en een waanzinnig resultaat. Dit is my go-to salon!',
            'rating' => 5,
        ],
        [
            'name' => 'Sophie V.',
            'role' => '@sophiev.nl',
            'quote' => 'Durfde eindelijk voor die bold color te gaan en ik ben OBSESSED. Kom hier nooit meer weg!',
            'rating' => 5,
        ],
    ];

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#2B2B2B';
    $headingFont = $theme['heading_font_family'] ?? 'Abril Fatface';
    $bodyFont = $theme['font_family'] ?? 'Nunito';

    $rotations = ['-rotate-2', 'rotate-1', '-rotate-1'];
@endphp

<section id="testimonials" class="py-24 lg:py-32 relative overflow-hidden" style="background: linear-gradient(135deg, {{ $accentColor }}50, {{ $backgroundColor }});">


    {{-- Quote marks background --}}
    <div class="absolute top-20 left-1/4 text-[200px] font-serif leading-none opacity-5" style="color: {{ $primaryColor }};">"</div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold mb-6 transform rotate-2"
                style="background: {{ $primaryColor }}; color: white;"
            >
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                REVIEWS
            </div>
            <h2
                class="text-4xl sm:text-5xl lg:text-6xl font-black mb-6"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', sans-serif;"
            >
                {{ $title }}
            </h2>
            <p class="text-xl max-w-2xl mx-auto" style="color: {{ $textColor }};">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Testimonials grid --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $index => $testimonial)
                <div
                    class="p-8 rounded-3xl transition-all duration-300 hover:scale-105 {{ $rotations[$index % 3] }} hover:rotate-0"
                    style="background: white; box-shadow: 6px 6px 0 {{ $index === 1 ? $primaryColor : $secondaryColor }};"
                >
                    {{-- Stars --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < $testimonial['rating']; $i++)
                            <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                    </div>

                    {{-- Quote --}}
                    <p class="text-lg mb-6 leading-relaxed" style="color: {{ $textColor }};">
                        "{{ $testimonial['quote'] }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-white"
                            style="background: {{ $index === 0 ? $primaryColor : ($index === 1 ? $secondaryColor : $accentColor) }}; color: {{ $index === 2 ? $headingColor : 'white' }};"
                        >
                            {{ substr($testimonial['name'], 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold" style="color: {{ $headingColor }};">{{ $testimonial['name'] }}</p>
                            <p class="text-sm" style="color: {{ $primaryColor }};">{{ $testimonial['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Social proof bar --}}
        <div class="mt-16 flex flex-wrap items-center justify-center gap-8">
            <div class="flex items-center gap-3 px-6 py-3 rounded-full" style="background: white; box-shadow: 4px 4px 0 {{ $secondaryColor }};">
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                <span class="font-bold" style="color: {{ $headingColor }};">5K+ Followers</span>
            </div>
            <div class="flex items-center gap-3 px-6 py-3 rounded-full" style="background: white; box-shadow: 4px 4px 0 {{ $primaryColor }};">
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                </svg>
                <span class="font-bold" style="color: {{ $headingColor }};">10K+ Views</span>
            </div>
            <div class="flex items-center gap-3 px-6 py-3 rounded-full" style="background: white; box-shadow: 4px 4px 0 {{ $secondaryColor }};">
                <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <span class="font-bold" style="color: {{ $headingColor }};">4.9 Google Rating</span>
            </div>
        </div>
    </div>
</section>
