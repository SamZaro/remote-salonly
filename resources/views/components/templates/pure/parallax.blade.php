{{--
    Pure Template: Parallax Section
    Natural & Botanical — fixed background with teal gradient overlay and botanical decoration
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Puur & Natuurlijk';
    $subtitle = $content['subtitle'] ?? 'Ontdek de kracht van natuurlijke schoonheid';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $textColor = $theme['text_color'] ?? '#57534e';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] flex items-center justify-center overflow-hidden"
>
    {{-- Parallax Background --}}
    @if($backgroundImage)
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $backgroundImage }}');"></div>
        {{-- Overlay for image readability --}}
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}cc 0%, {{ $primaryColor }}aa 100%);"></div>
    @else
        {{-- Light teal background when no image --}}
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }} 0%, {{ $primaryColor }}dd 100%);"></div>
    @endif

    {{-- Decorative circles --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full opacity-[0.08]" style="border: 2px solid #ffffff;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] h-[350px] rounded-full opacity-[0.10]" style="border: 1px solid #ffffff;"></div>

    {{-- Botanical leaf decoration --}}
    <div class="absolute bottom-8 left-8 opacity-[0.10]">
        <svg class="w-32 h-32" viewBox="0 0 100 100" fill="none" style="color: #ffffff;">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
        </svg>
    </div>

    <div
        class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'scale(1)'"
        style="opacity: 0; transform: scale(0.95); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
    >
        <div class="w-16 h-px mx-auto mb-8" style="background-color: rgba(255,255,255,0.5);"></div>

        <h2
            class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-4"
            style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-xl md:text-2xl max-w-2xl mx-auto leading-relaxed" style="color: rgba(255,255,255,0.85); font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $subtitle }}
            </p>
        @endif

        <div class="w-16 h-px mx-auto mt-8" style="background-color: rgba(255,255,255,0.3);"></div>
    </div>
</section>
