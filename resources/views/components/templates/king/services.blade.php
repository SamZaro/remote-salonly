{{--
    King Template: Services Section
    "Royal Throne" — dark bg, 3-column service cards, gold accents, barbershop pricing
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Our Services');
    $subtitle = $content['subtitle'] ?? __('Crafted for the modern gentleman');
    $services = $content['services'] ?? [
        ['name' => __('Classic Cut'), 'description' => __('A timeless haircut tailored to your face shape and style preference.'), 'price' => '€25', 'features' => [__('Consultation'), __('Wash & Cut'), __('Styling')]],
        ['name' => __('Royal Shave'), 'description' => __('Hot towel treatment with straight razor for the smoothest finish.'), 'price' => '€30', 'features' => [__('Hot Towel'), __('Straight Razor'), __('Aftershave')]],
        ['name' => __('King Package'), 'description' => __('The complete grooming experience — cut, shave, and beard trim.'), 'price' => '€55', 'features' => [__('Full Cut'), __('Beard Trim'), __('Hot Towel Shave')]],
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

<section id="services" class="py-24 lg:py-36" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(14px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="inline-flex items-center gap-3 mb-8">
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
                <span class="uppercase text-[11px] tracking-[0.3em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ __('Services') }}
                </span>
                <span class="w-10 h-px" style="background-color: {{ $primaryColor }};"></span>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.6rem] leading-[1.15] mb-4"
                style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
            >
                {{ $title }}
            </h2>
            <p class="text-[15px] max-w-lg mx-auto leading-relaxed" style="color: {{ $backgroundColor }}60;">
                {{ $subtitle }}
            </p>
        </div>

        {{-- Service cards --}}
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($services as $index => $service)
                <div
                    class="group relative p-8 lg:p-10 text-center transition-all duration-500 hover:shadow-lg"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: {{ $backgroundColor }}; border: 1px solid {{ $headingColor }}06; box-shadow: 0 1px 8px rgba(0,0,0,0.03); opacity: 0; transform: translateY(18px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.12 }}s;"
                >
                    {{-- Gold top accent — expands on hover --}}
                    <div
                        class="absolute top-0 left-0 h-px w-0 group-hover:w-full transition-all duration-700"
                        style="background-color: {{ $primaryColor }};"
                    ></div>

                    {{-- Icon --}}
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-6"
                        style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}15;"
                    >
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/>
                        </svg>
                    </div>

                    {{-- Name --}}
                    <h3
                        class="text-xl mb-2"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
                    >
                        {{ $service['name'] ?? '' }}
                    </h3>

                    {{-- Price --}}
                    @if(!empty($service['price']))
                        <span
                            class="inline-block text-2xl mb-4"
                            style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;"
                        >
                            {{ $service['price'] }}
                        </span>
                    @endif

                    {{-- Diamond divider --}}
                    <div class="flex items-center justify-center gap-0 mb-5">
                        <div class="w-6 h-px" style="background-color: {{ $primaryColor }}40;"></div>
                        <div class="w-1.5 h-1.5 rotate-45 mx-1.5" style="background-color: {{ $primaryColor }};"></div>
                        <div class="w-6 h-px" style="background-color: {{ $primaryColor }}40;"></div>
                    </div>

                    {{-- Description --}}
                    <p class="text-[14px] leading-[1.7] mb-6" style="color: {{ $textColor }};">
                        {{ $service['description'] ?? '' }}
                    </p>

                    {{-- Features --}}
                    @if(!empty($service['features']))
                        <ul class="space-y-2 mb-8">
                            @foreach($service['features'] as $feature)
                                <li class="flex items-center justify-center gap-2.5 text-[13px]" style="color: {{ $headingColor }};">
                                    <div class="w-1 h-1 rotate-45 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Book CTA --}}
                    <a
                        href="#contact"
                        class="group/btn inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.2em] transition-all duration-300 hover:gap-3"
                        style="color: {{ $primaryColor }};"
                    >
                        {{ __('Book Now') }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
