{{--
    King Template: About Section
    "Royal Throne" — two-column editorial, offset gold frame, overlapping stats, barbershop royalty
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('The King Standard');
    $subtitle = $content['subtitle'] ?? __('Where every detail matters');
    $description = $content['description'] ?? __('At King, we believe that a great haircut is more than a service — it is an experience. Our master barbers combine traditional craftsmanship with modern techniques to deliver cuts that command attention.');
    $features = $content['features'] ?? [
        __('Master barbers with 10+ years experience'),
        __('Premium grooming products only'),
        __('Complimentary beard consultation'),
        __('Hot towel & straight razor finish'),
    ];
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: null;
    $stats = $content['stats'] ?? [
        ['value' => '10+', 'label' => __('Years')],
        ['value' => '5K+', 'label' => __('Clients')],
        ['value' => '4.9', 'label' => __('Rating')],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<section id="about" class="py-24 lg:py-36" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- Left: Image with offset frame --}}
            <div
                class="relative"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                <div class="relative aspect-[4/5] overflow-hidden">
                    @if($backgroundImage)
                        <img
                            src="{{ $backgroundImage }}"
                            alt="{{ $title }}"
                            class="w-full h-full object-cover"
                            loading="lazy"
                        />
                    @else
                        <div class="w-full h-full" style="background-color: {{ $secondaryColor }};"></div>
                    @endif
                </div>

                {{-- Offset gold frame --}}
                <div
                    class="absolute -bottom-4 -right-4 w-full h-full hidden lg:block pointer-events-none"
                    style="border: 1px solid {{ $primaryColor }}30;"
                ></div>

                {{-- Diamond accent --}}
                <div class="absolute -bottom-2 -right-2 w-4 h-4 rotate-45 hidden lg:block" style="background-color: {{ $primaryColor }};"></div>

                {{-- Stats overlay bar --}}
                <div
                    class="absolute -bottom-6 left-4 right-4 lg:left-8 lg:-right-8 z-10 grid grid-cols-3"
                    style="background-color: {{ $secondaryColor }}; box-shadow: 0 4px 24px rgba(0,0,0,0.15);"
                >
                    @foreach($stats as $index => $stat)
                        <div class="py-5 text-center {{ $index < count($stats) - 1 ? 'border-r' : '' }}" style="border-color: {{ $backgroundColor }}08;">
                            <span class="block text-xl font-bold" style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;">
                                {{ $stat['value'] }}
                            </span>
                            <span class="block text-[10px] uppercase tracking-[0.2em] mt-1" style="color: {{ $backgroundColor }}40;">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="pt-8 lg:pt-0">
                {{-- Label --}}
                <div
                    class="flex items-center gap-3 mb-8"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1);"
                >
                    <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                    <span class="uppercase text-[11px] tracking-[0.3em] font-semibold" style="color: {{ $primaryColor }};">
                        {{ __('About Us') }}
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-3xl sm:text-4xl lg:text-[2.8rem] leading-[1.1] mb-4"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400; opacity: 0; transform: translateY(14px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;"
                >
                    {{ $title }}
                </h2>

                {{-- Diamond divider --}}
                <div
                    class="flex items-center gap-0 mb-6"
                    x-data x-intersect.once="$el.style.opacity = 1"
                    style="opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.2s;"
                >
                    <div class="w-2 h-2 rotate-45" style="border: 1px solid {{ $primaryColor }};"></div>
                    <div class="w-10 h-px mx-2" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-2 h-2 rotate-45" style="background-color: {{ $primaryColor }};"></div>
                </div>

                {{-- Subtitle --}}
                @if($subtitle)
                    <p
                        class="text-[13px] uppercase tracking-[0.15em] font-semibold mb-5"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                        style="color: {{ $primaryColor }}; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;"
                    >
                        {{ $subtitle }}
                    </p>
                @endif

                {{-- Description --}}
                <p
                    class="text-[15px] leading-[1.8] mb-8"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="color: {{ $textColor }}; opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
                >
                    {{ $description }}
                </p>

                {{-- Features grid --}}
                <div
                    class="grid sm:grid-cols-2 gap-3 mb-10"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="opacity: 0; transform: translateY(10px); transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.4s;"
                >
                    @foreach($features as $feature)
                        <div class="flex items-center gap-3 py-2">
                            <div class="w-1.5 h-1.5 rotate-45 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                            <span class="text-[13px] font-medium" style="color: {{ $headingColor }};">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <a
                    href="#services"
                    class="group inline-flex items-center gap-3 text-[12px] font-bold uppercase tracking-[0.2em] transition-all duration-300 hover:gap-4"
                    x-data x-intersect.once="$el.style.opacity = 1"
                    style="color: {{ $primaryColor }}; opacity: 0; transition: all 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.5s;"
                >
                    {{ __('Explore Services') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>
