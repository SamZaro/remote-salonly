{{--
    Level Template: About Section
    Light section — text LEFT, full-height image RIGHT (reversed from urban)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title        = $content['title'] ?? 'Wie Wij Zijn';
    $subtitle     = $content['subtitle'] ?? 'Passie voor haar, oog voor detail';
    $description  = $content['description'] ?? 'Wij geloven dat een goede knipbeurt meer is dan alleen een bezoek aan de kapper. Het is een moment van aandacht — voor jouw haar, jouw stijl en jou als persoon. Ons team bestaat uit gedreven stylisten die voortdurend bijblijven met de nieuwste trends.';
    $description2 = $content['description2'] ?? 'Met jarenlange ervaring en een scherp oog voor wat bij jou past, creëren wij looks die echt bij je aansluiten. Modern of klassiek, kort of lang — we zorgen dat jij er op jouw best uitziet.';
    $image        = $section?->getFirstMediaUrl('background') ?: ($content['image'] ?? null);
    $stats        = $content['stats'] ?? [
        ['value' => '10+',  'label' => 'Jaar ervaring'],
        ['value' => '3k+',  'label' => 'Blije klanten'],
        ['value' => '6',    'label' => 'Expert stylisten'],
    ];

    $primaryColor    = $theme['primary_color'] ?? '#f97316';
    $secondaryColor  = $theme['secondary_color'] ?? '#2B2B2B';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $textColor       = $theme['text_color'] ?? '#6B6B6B';
    $headingColor    = $theme['heading_color'] ?? '#111111';
    $headingFont     = $theme['heading_font_family'] ?? 'Syne, sans-serif';
    $bodyFont        = $theme['font_family'] ?? 'Jost, sans-serif';
@endphp

<section id="about" class="relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    <div class="grid lg:grid-cols-2 min-h-[80vh]">

        {{-- Text column — LEFT --}}
        <div
            class="flex flex-col justify-center px-8 sm:px-12 lg:px-16 xl:px-20 py-20 lg:py-28 order-2 lg:order-1"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
            style="opacity: 0; transform: translateX(-20px); transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);"
        >
            {{-- Eyebrow --}}
            <div class="flex items-center gap-3 mb-8">
                <div class="w-9 h-1 shrink-0" style="background-color: {{ $primaryColor }};"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                    Over Ons
                </span>
            </div>

            {{-- Heading --}}
            <h2
                class="font-black leading-[0.9] mb-8"
                style="font-family: '{{ $headingFont }}'; font-size: clamp(2.2rem, 4vw, 3.8rem); letter-spacing: -0.03em; color: {{ $headingColor }};"
            >
                {{ $title }}
            </h2>

            {{-- Description --}}
            <p class="text-base leading-relaxed mb-5 font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                {{ $description }}
            </p>
            @if($description2)
                <p class="text-base leading-relaxed mb-10 font-light" style="color: {{ $textColor }}; font-family: '{{ $bodyFont }}';">
                    {{ $description2 }}
                </p>
            @endif

            {{-- CTA link --}}
            <div class="mb-14">
                <a
                    href="#contact"
                    class="group inline-flex items-center gap-3 font-semibold uppercase tracking-widest text-sm transition-colors"
                    style="color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
                    onmouseover="this.style.color='{{ $primaryColor }}'"
                    onmouseout="this.style.color='{{ $secondaryColor }}'"
                >
                    Kennismaken
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Stats row --}}
            <div class="grid grid-cols-3 gap-6 pt-10 border-t" style="border-color: #e8e8e8;">
                @foreach($stats as $stat)
                    <div>
                        <span
                            class="block font-black leading-none mb-1.5"
                            style="font-family: '{{ $headingFont }}'; font-size: clamp(1.8rem, 3.5vw, 2.8rem); color: {{ $primaryColor }}; letter-spacing: -0.03em;"
                        >
                            {{ $stat['value'] }}
                        </span>
                        <span class="block text-xs uppercase tracking-[0.2em] font-medium" style="color: #aaaaaa; font-family: '{{ $bodyFont }}';">
                            {{ $stat['label'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Image column — RIGHT --}}
        <div class="relative order-1 lg:order-2 min-h-[420px] lg:min-h-auto overflow-hidden">
            @if($image)
                <img
                    src="{{ $image }}"
                    alt="Over ons"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                {{-- Subtle orange top accent --}}
                <div class="absolute top-0 left-0 right-0 h-1" style="background-color: {{ $primaryColor }};"></div>
                {{-- Mobile gradient --}}
                <div class="absolute inset-0 lg:hidden" style="background: linear-gradient(to bottom, transparent 60%, {{ $backgroundColor }});"></div>
            @else
                <div class="absolute inset-0 flex items-center justify-center" style="background-color: #f0f0f0;">
                    <svg class="w-20 h-20 opacity-20" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
        </div>

    </div>
</section>
