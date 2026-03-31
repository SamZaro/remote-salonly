{{--
    Nova Template: CTA Section

    Solid primary-colour background — high visual contrast between accordion and testimonials.
    Two-column layout: bold heading left, action right.
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme'   => [],
    'section' => null,
])

@php
    $title   = $content['title']    ?? __('Ready for a new look?');
    $subtitle = $content['subtitle'] ?? __('Book your appointment today');
    $ctaText = $content['cta_text'] ?? __('Book Appointment');
    $ctaLink         = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren
    $primaryColor   = $theme['primary_color']   ?? '#8b5cf6';
    $secondaryColor = $theme['secondary_color']  ?? '#18181b';
    $accentColor    = $theme['accent_color']     ?? '#a78bfa';
@endphp

<section id="cta" class="relative py-20 lg:py-28 overflow-hidden" style="background-color: {{ $primaryColor }};">

    {{-- Background image --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover opacity-20" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $primaryColor }}cc 0%, {{ $primaryColor }}99 100%);"></div>
        </div>
    @else
        {{-- Subtle diagonal grid texture (fallback when no image) --}}
        <div
            class="absolute inset-0 opacity-[0.06]"
            style="background-image: repeating-linear-gradient(45deg, #ffffff 0, #ffffff 1px, transparent 0, transparent 50%); background-size: 24px 24px;"
        ></div>
    @endif

    {{-- Soft glow blob top-right --}}
    <div
        class="absolute -top-24 -right-24 w-96 h-96 rounded-full blur-3xl opacity-30"
        style="background: {{ $accentColor }};"
    ></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 lg:gap-16">

            {{-- Left: heading block --}}
            <div class="flex-1">
                {{-- Eyebrow --}}
                <div
                    class="flex items-center gap-3 mb-6"
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateX(0)'"
                    style="opacity: 0; transform: translateX(-20px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);"
                >
                    <div class="w-8 h-px" style="background-color: rgba(255,255,255,0.6);"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.3em]" style="color: rgba(255,255,255,0.75);">
                        {{ __('Book now') }}
                    </span>
                </div>

                {{-- Title --}}
                <h2
                    class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-4"
                    style="
                        color: #ffffff;
                        font-family: var(--font-family-heading);
                        opacity: 0;
                        transform: translateY(16px);
                        transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;
                    "
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{ $title }}
                </h2>

                {{-- Subtitle — outline style matching jumbotron --}}
                <p
                    class="text-2xl sm:text-3xl font-extrabold"
                    style="
                        color: transparent;
                        -webkit-text-stroke: 1.5px rgba(255,255,255,0.55);
                        font-family: var(--font-family-heading);
                        opacity: 0;
                        transform: translateY(12px);
                        transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;
                    "
                    x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                >
                    {{ $subtitle }}
                </p>
            </div>

            {{-- Right: CTA buttons --}}
            <div
                class="flex flex-col sm:flex-row lg:flex-col gap-4 lg:shrink-0"
                x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
                style="opacity: 0; transform: translateY(16px); transition: all 0.9s cubic-bezier(0.22, 1, 0.36, 1) 0.35s;"
            >
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center gap-3 px-8 py-4 text-base font-semibold rounded-sm transition-all duration-300 hover:scale-105"
                    style="background-color: {{ $secondaryColor }}; color: #ffffff;"
                >
                    {{ $ctaText }}
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

                <a
                    href="#services"
                    class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-semibold rounded-sm border-2 transition-all duration-300 hover:bg-white/10"
                    style="border-color: rgba(255,255,255,0.5); color: #ffffff;"
                >
                    {{ __('Our services') }}
                </a>
            </div>

        </div>

        {{-- Bottom decorative line --}}
        <div
            class="mt-14 h-px"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'scaleX(1)'"
            style="background: linear-gradient(to right, rgba(255,255,255,0.4), rgba(255,255,255,0.05)); opacity: 0; transform: scaleX(0); transform-origin: left; transition: all 1s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
        ></div>
    </div>
</section>
