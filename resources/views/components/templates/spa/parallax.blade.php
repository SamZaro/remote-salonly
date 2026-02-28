{{--
    Spa Template: Parallax Section
    Serene spa & wellness — fixed background with elegant overlay and bold promo text
    Fonts: Lustria (headings) + Lato (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? '25% OFF';
    $subtitle = $content['subtitle'] ?? 'For All Spa Procedures — During This Weekend For All Clients';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] flex items-center justify-center overflow-hidden"
>
    @if($backgroundImage)
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $backgroundImage }}');"></div>
    @endif

    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}dd 0%, {{ $secondaryColor }}cc 100%);"></div>

    {{-- Decorative elements --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full opacity-[0.04]" style="border: 2px solid #ffffff;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] h-[350px] rounded-full opacity-[0.06]" style="border: 1px solid #ffffff;"></div>

    <div
        class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'scale(1)'"
        style="opacity: 0; transform: scale(0.95); transition: all 0.8s ease-out;"
    >
        <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>

        <h2
            class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold mb-4"
            style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-xl md:text-2xl max-w-2xl mx-auto leading-relaxed" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif; font-weight: 300;">
                {{ $subtitle }}
            </p>
        @endif

        <div class="w-16 h-px mx-auto mt-8" style="background-color: {{ $primaryColor }}60;"></div>
    </div>
</section>
