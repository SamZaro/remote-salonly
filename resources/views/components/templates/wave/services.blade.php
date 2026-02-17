{{--
    Wave Template: Services Section
    "Coastal Minimal" — clean rounded cards, gradient accents, wave transition, staggered reveal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Onze Diensten';
    $subtitle = $content['subtitle'] ?? 'Vakmanschap & Stijl';
    $items = $content['items'] ?? [
        [
            'title' => 'Knippen & Stylen',
            'description' => 'Van klassieke elegantie tot moderne trends - wij creëren de perfecte look die bij jouw persoonlijkheid past.',
            'price' => 'Vanaf €55',
            'icon' => 'scissors',
            'features' => ['Wasbeurt', 'Knipbehandeling', 'Finishing & Styling'],
        ],
        [
            'title' => 'Kleuren & Balayage',
            'description' => 'Subtiele highlights of een volledige transformatie - onze kleurspecialisten toveren elke wens werkelijkheid.',
            'price' => 'Vanaf €85',
            'icon' => 'color',
            'features' => ['Kleuradvies', 'Premium producten', 'Nabehandeling'],
        ],
        [
            'title' => 'Treatments',
            'description' => 'Intensieve verzorging voor beschadigd of droog haar. Geef je haar de luxe die het verdient.',
            'price' => 'Vanaf €45',
            'icon' => 'treatment',
            'features' => ['Keratine', 'Olaplex', 'Deep conditioning'],
        ],
    ];

    $primaryColor = $theme['primary_color'] ?? '#0077b6';
    $secondaryColor = $theme['secondary_color'] ?? '#0d1b2a';
    $accentColor = $theme['accent_color'] ?? '#48cae4';
    $backgroundColor = $theme['background_color'] ?? '#f0f7ff';
    $textColor = $theme['text_color'] ?? '#4a6a8a';
    $headingColor = $theme['heading_color'] ?? '#0d1b2a';
    $headingFont = $theme['heading_font_family'] ?? 'Playfair Display';
    $bodyFont = $theme['font_family'] ?? 'Poppins';

    $icons = [
        'scissors' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>',
        'razor' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6h18M3 6v12a2 2 0 002 2h14a2 2 0 002-2V6M3 6l3-3h12l3 3M9 10v6m6-6v6"/>',
        'color' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        'treatment' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
        'women' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
        'child' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'towel' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
        'star' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>',
        'comb' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 6v14h16V6M8 6V4m4 2V4m4 2V4M8 10v6m4-6v6m4-6v6"/>',
    ];
@endphp

<section id="services" class="relative py-24 lg:py-36 overflow-hidden" style="background-color: {{ $backgroundColor }}; font-family: '{{ $bodyFont }}', sans-serif;">

    {{-- Wave divider top --}}
    <div class="absolute top-0 left-0 right-0">
        <svg class="w-full h-16 sm:h-20" viewBox="0 0 1440 80" preserveAspectRatio="none" fill="#ffffff">
            <path d="M0,0 L0,50 C360,80 720,20 1080,50 C1260,65 1380,40 1440,50 L1440,0 Z"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
        {{-- Section header --}}
        <div
            class="text-center mb-16 lg:mb-20"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <span class="uppercase text-[11px] tracking-[0.2em] font-semibold" style="color: {{ $primaryColor }};">
                    {{ $subtitle }}
                </span>
                <div class="w-8 h-[2px] rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-[2.75rem] leading-[1.15] mb-4"
                style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Services grid --}}
        <div class="grid gap-6 lg:gap-8 md:grid-cols-3">
            @foreach($items as $index => $item)
                <div
                    class="group relative rounded-2xl p-8 lg:p-10 transition-all duration-500 hover:-translate-y-1 hover:shadow-xl"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                    style="background-color: #ffffff; box-shadow: 0 1px 3px {{ $secondaryColor }}08; opacity: 0; transform: translateY(20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) {{ $index * 0.15 }}s;"
                >
                    {{-- Gradient top border on hover --}}
                    <div
                        class="absolute top-0 left-6 right-6 h-[3px] rounded-b-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                        style="background: linear-gradient(to right, {{ $primaryColor }}, {{ $accentColor }});"
                    ></div>

                    {{-- Icon --}}
                    <div
                        class="w-12 h-12 rounded-xl flex items-center justify-center mb-6 transition-all duration-300 group-hover:scale-110"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $accentColor }}10); border: 1px solid {{ $primaryColor }}12;"
                    >
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $icons[$item['icon'] ?? 'scissors'] ?? $icons['scissors'] !!}
                        </svg>
                    </div>

                    {{-- Title --}}
                    <h3
                        class="text-xl mb-3"
                        style="color: {{ $headingColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 700;"
                    >
                        {{ $item['title'] }}
                    </h3>

                    {{-- Description --}}
                    <p class="text-[14px] leading-[1.75] mb-6" style="color: {{ $textColor }};">
                        {{ $item['description'] }}
                    </p>

                    {{-- Feature list --}}
                    @if(isset($item['features']))
                        <div class="mb-6">
                            <ul class="space-y-2">
                                @foreach($item['features'] as $feature)
                                    <li class="flex items-center gap-3 text-[13px]" style="color: {{ $textColor }};">
                                        <svg class="w-3.5 h-3.5 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Price & CTA --}}
                    <div class="flex items-center justify-between pt-6" style="border-top: 1px solid {{ $primaryColor }}08;">
                        <span
                            class="text-lg font-bold"
                            style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif;"
                        >
                            {{ $item['price'] }}
                        </span>
                        <a
                            href="#contact"
                            class="group/link inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-[0.1em] transition-colors duration-300"
                            style="color: {{ $primaryColor }};"
                        >
                            Reserveren
                            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Bottom CTA --}}
        <div
            class="text-center mt-14"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(10px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            <a
                href="#pricing"
                class="group inline-flex items-center gap-3 px-6 py-3 text-sm font-semibold rounded-full transition-all duration-300 hover:shadow-md hover:-translate-y-0.5"
                style="color: {{ $primaryColor }}; border: 1px solid {{ $primaryColor }}30;"
            >
                Bekijk volledige prijslijst
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
