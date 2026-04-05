{{--
    Blush Template: Features Section
    Elegant nail studio — centered feature cards on dark background
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? __('Why Choose Us');
    $subtitle = $content['subtitle'] ?? __('Our expertise');
    $items = $content['items'] ?? [
        ['title' => __('Expert Nail Artists'), 'description' => __('Our team of certified technicians bring years of experience and continuous training in the latest techniques.'), 'icon' => 'sparkles'],
        ['title' => __('Premium Products'), 'description' => __('We exclusively use high-quality, long-lasting nail products that are gentle on your natural nails.'), 'icon' => 'heart'],
        ['title' => __('Hygiene First'), 'description' => __('All tools are sterilized and we maintain the highest hygiene standards for your safety and comfort.'), 'icon' => 'star'],
        ['title' => __('Relaxing Atmosphere'), 'description' => __('Enjoy a moment of calm in our beautifully designed studio while we create your perfect nails.'), 'icon' => 'chat'],
    ];

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond, serif';
    $bodyFont = $theme['font_family'] ?? 'Nunito Sans, sans-serif';

    $itemCount = count($items);
    $gridCols = match(true) {
        $itemCount <= 2 => 'md:grid-cols-2 max-w-3xl mx-auto',
        $itemCount === 3 => 'md:grid-cols-3',
        default => 'md:grid-cols-2 lg:grid-cols-4',
    };

    $iconMap = [
        'sparkles' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/>',
        'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>',
        'chat' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>',
    ];
@endphp

<section id="features" class="py-20 lg:py-32" style="background-color: {{ $secondaryColor }}; font-family: {{ $bodyFont }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-20">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-16 h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                </svg>
                <div class="w-16 h-px" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <span class="text-xs font-medium uppercase tracking-[0.25em] mb-4 block" style="color: {{ $primaryColor }};">
                {{ $subtitle }}
            </span>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-light"
                style="color: {{ $backgroundColor }}; font-family: {{ $headingFont }};"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="color: {{ $backgroundColor }}; font-family: {{ $headingFont }}; opacity: 0; transform: translateY(12px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Features Grid --}}
        @if(count($items) > 0)
            <div class="grid gap-8 {{ $gridCols }}">
                @foreach($items as $index => $item)
                    <div
                        class="text-center p-8 lg:p-10 transition-all duration-500 hover:-translate-y-1"
                        style="background-color: {{ $primaryColor }}08; border: 1px solid {{ $primaryColor }}15; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.1 }}s;"
                        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    >
                        {{-- Icon --}}
                        <div
                            class="w-14 h-14 flex items-center justify-center mx-auto mb-6"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $iconMap[$item['icon'] ?? 'sparkles'] ?? $iconMap['sparkles'] !!}
                            </svg>
                        </div>

                        <h3
                            class="text-lg font-semibold mb-3"
                            style="color: {{ $backgroundColor }}; font-family: {{ $headingFont }}; font-weight: 600;"
                        >
                            {{ $item['title'] ?? '' }}
                        </h3>
                        <p class="leading-relaxed text-sm" style="color: {{ $textColor }};">
                            {{ $item['description'] ?? '' }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Bottom decorative line --}}
        <div class="flex items-center justify-center mt-20">
            <div class="h-px w-32" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}40, transparent);"></div>
        </div>
    </div>
</section>
