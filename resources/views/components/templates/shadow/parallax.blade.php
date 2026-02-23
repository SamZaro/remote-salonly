{{--
    Template-specifieke parallax voor Shadow (Barbershop)

    Professionele bouw en constructie stijl
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Kwaliteit & Vakmanschap';
    $subtitle = $content['subtitle'] ?? 'Uw project in vertrouwde handen';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
@endphp

<section
    id="parallax"
    class="relative min-h-[50vh] flex items-center justify-center overflow-hidden"
>
    {{-- Parallax Background --}}
    @if($backgroundImage)
        <div
            class="absolute inset-0 bg-cover bg-center bg-fixed"
            style="background-image: url('{{ $backgroundImage }}');"
        ></div>
    @endif

    {{-- Dark overlay --}}
    <div class="absolute inset-0" style="background: linear-gradient(to right, {{ $secondaryColor }}f0, {{ $secondaryColor }}dd);"></div>

    {{-- Diagonal stripes decoration --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-1/3 h-full" style="background: repeating-linear-gradient(-45deg, {{ $primaryColor }}, {{ $primaryColor }} 2px, transparent 2px, transparent 20px);"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">
        {{-- Construction icon --}}
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-lg mb-8" style="background-color: {{ $primaryColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>

        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 text-white"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
        >
            {!! $title !!}
        </h2>

        @if($subtitle)
            <p class="text-lg sm:text-xl text-white/80 max-w-2xl mx-auto">
                {{ $subtitle }}
            </p>
        @endif

        {{-- Stats bar decoration --}}
        <div class="flex items-center justify-center gap-8 mt-12">
            <div class="text-center">
                <div class="text-3xl font-bold" style="color: {{ $primaryColor }};">25+</div>
                <div class="text-sm text-white/60 uppercase tracking-wider">Jaar ervaring</div>
            </div>
            <div class="w-px h-12 bg-white/20"></div>
            <div class="text-center">
                <div class="text-3xl font-bold" style="color: {{ $primaryColor }};">500+</div>
                <div class="text-sm text-white/60 uppercase tracking-wider">Projecten</div>
            </div>
            <div class="w-px h-12 bg-white/20"></div>
            <div class="text-center">
                <div class="text-3xl font-bold" style="color: {{ $primaryColor }};">100%</div>
                <div class="text-sm text-white/60 uppercase tracking-wider">Tevreden</div>
            </div>
        </div>
    </div>
</section>
