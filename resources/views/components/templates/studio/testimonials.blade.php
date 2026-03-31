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
    $subtitle = $content['subtitle'] ?? __('What our happy customers say');
    $testimonials = $content['testimonials'] ?? [
        [
            'name' => 'Lisa M.',
            'role' => '@lisa.styles',
            'quote' => __('Best balayage ever! The team knows exactly what you want and makes it even better than you imagined.'),
            'rating' => 5,
        ],
        [
            'name' => 'Emma K.',
            'role' => '@emmak_',
            'quote' => __('Super relaxed atmosphere, good music and an amazing result. This is my go-to salon!'),
            'rating' => 5,
        ],
        [
            'name' => 'Sophie V.',
            'role' => '@sophiev.nl',
            'quote' => __('Finally dared to go for that bold colour and I am OBSESSED. Never leaving!'),
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
    </div>
</section>
