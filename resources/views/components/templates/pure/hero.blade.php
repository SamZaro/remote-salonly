{{--
    Template-specifieke hero voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Puur.<br>Natuurlijk.<br>Jij.';
    $subtitle = $content['subtitle'] ?? 'Ontdek de kracht van natuurlijke haarverzorging';
    $ctaText = $content['cta_text'] ?? 'Boek Nu';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';      // Emerald
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';  // Stone dark
    $accentColor = $theme['accent_color'] ?? '#10b981';        // Light emerald
    $backgroundColor = $theme['background_color'] ?? '#fafaf9'; // Stone light
    $textColor = $theme['text_color'] ?? '#78716c';            // Stone grey
    $headingColor = $theme['heading_color'] ?? '#1c1917';      // Stone dark
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background-color: {{ $backgroundColor }};"
>
    {{-- Organic shape decorations --}}
    <div class="absolute top-0 right-0 w-1/2 h-full opacity-5">
        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $primaryColor }};">
            <path fill="currentColor" d="M45.3,-51.2C58.3,-40.9,68.2,-25.3,71.2,-8.2C74.2,8.9,70.3,27.5,59.5,40.6C48.7,53.7,31,61.3,12.7,65.2C-5.6,69.1,-24.5,69.3,-40.1,61.1C-55.7,52.9,-68,36.3,-72.1,18.1C-76.2,-0.1,-72.1,-19.9,-62,-35.1C-51.9,-50.3,-35.8,-60.9,-19.2,-64.8C-2.6,-68.7,14.5,-65.9,29.9,-59.6C45.3,-53.3,59,-46.5,45.3,-51.2Z" transform="translate(100 100)" />
        </svg>
    </div>
    <div class="absolute bottom-0 left-0 w-1/3 h-2/3 opacity-5">
        <svg viewBox="0 0 200 200" class="w-full h-full" style="color: {{ $accentColor }};">
            <path fill="currentColor" d="M39.5,-48.7C52.9,-37.2,66.6,-26.4,72.1,-11.8C77.6,2.8,74.9,21.2,65.4,34.6C55.9,48,39.6,56.4,22.8,61.6C6,66.8,-11.3,68.8,-27.3,63.5C-43.3,58.2,-58,45.6,-65.7,29.5C-73.4,13.4,-74.1,-6.2,-68,-23.1C-61.9,-40,-49,-54.2,-34.4,-65.4C-19.8,-76.6,-3.5,-84.8,9.6,-82.1C22.7,-79.4,26.1,-60.2,39.5,-48.7Z" transform="translate(100 100)" />
        </svg>
    </div>

    {{-- Leaf pattern overlay --}}
    <div class="absolute inset-0 opacity-[0.02]" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M30 5 Q40 20 30 35 Q20 20 30 5\" fill=\"none\" stroke=\"%23059669\" stroke-width=\"1\"/%3E%3C/svg%3E'); background-size: 60px 60px;"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                {{-- Eco badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-8"
                    style="background-color: {{ $primaryColor }}15; color: {{ $primaryColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    100% Natuurlijk
                </div>

                {{-- Titel --}}
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-light mb-8 leading-tight"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {!! $title !!}
                </h1>

                {{-- Subtitel --}}
                <p
                    class="text-lg sm:text-xl mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed"
                    style="color: {{ $textColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{ $subtitle }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                >
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full text-white transition-all duration-300 hover:shadow-lg"
                        style="background-color: {{ $primaryColor }};"
                    >
                        {{ $ctaText }}
                        <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="#about"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full transition-all duration-300"
                        style="color: {{ $primaryColor }};"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Ontdek meer
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-8 mt-12 pt-8 border-t" style="border-color: {{ $primaryColor }}20;">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Vegan producten</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Duurzaam</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm" style="color: {{ $textColor }};">Cruelty-free</span>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                @if($backgroundImage)
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-[3rem] opacity-20 blur-2xl" style="background-color: {{ $primaryColor }};"></div>
                        <img
                            src="{{ $backgroundImage }}"
                            alt="Pure Natural Salon"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover rounded-[2rem]"
                        />
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-[3rem] opacity-10 blur-2xl" style="background-color: {{ $primaryColor }};"></div>
                        <div
                            class="relative w-full h-[500px] lg:h-[600px] rounded-[2rem] flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $accentColor }}10);"
                        >
                            <svg class="w-20 h-20" style="color: {{ $primaryColor }}30;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                    </div>
                @endif

                {{-- Floating leaf card --}}
                <div
                    class="absolute -bottom-6 -left-6 p-5 rounded-2xl bg-white shadow-xl hidden lg:block"
                    style="box-shadow: 0 20px 60px {{ $primaryColor }}15;"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-full flex items-center justify-center"
                            style="background-color: {{ $primaryColor }}15;"
                        >
                            <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-sm" style="color: {{ $headingColor }};">Eco-Certified</p>
                            <p class="text-xs" style="color: {{ $textColor }};">Groene salon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2">
            <div class="w-6 h-10 rounded-full border-2 flex items-start justify-center p-1.5" style="border-color: {{ $primaryColor }}40;">
                <div class="w-1 h-2 rounded-full animate-bounce" style="background-color: {{ $primaryColor }};"></div>
            </div>
        </div>
    </div>
</section>
