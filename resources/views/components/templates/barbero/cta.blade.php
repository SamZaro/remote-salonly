{{--
    Template-specifieke CTA voor Barbero (Barbershop)

    Call-to-action in vintage barbershop stijl met goud accenten
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Klaar Voor Een Fresh Look?';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog je afspraak';
    $description = $content['description'] ?? 'Ervaar het verschil van een echte barbershop. Onze vakmannen staan klaar om je de beste behandeling te geven.';
    $ctaText = $content['cta_text'] ?? 'Maak een afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $secondaryCtaText = $content['secondary_cta_text'] ?? 'Bel direct';
    $secondaryCtaLink = $content['secondary_cta_link'] ?? 'tel:+31612345678';
    // Get background image from Spatie Media Library or fallback to content
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren met defaults
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
@endphp

<section id="cta" class="relative py-24 lg:py-32 overflow-hidden" style="background-color: {{ $secondaryColor }};">
    {{-- Achtergrond afbeelding met donkere overlay --}}
    @if($backgroundImage)
        <div class="absolute inset-0 z-0">
            <img
                src="{{ $backgroundImage }}"
                alt="CTA background"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-black/85"></div>
        </div>
    @endif

    {{-- Vintage pattern overlay --}}
    <div class="absolute inset-0 z-0 opacity-5">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, {{ $primaryColor }} 0, {{ $primaryColor }} 1px, transparent 0, transparent 50%); background-size: 20px 20px;"></div>
    </div>

    {{-- Barberpole stripes aan de zijkanten --}}
    <div class="absolute left-0 top-0 bottom-0 w-2 hidden lg:block" style="background: repeating-linear-gradient(180deg, #ffffff 0px, #ffffff 20px, #c41e3a 20px, #c41e3a 40px, #1a3a8f 40px, #1a3a8f 60px);"></div>
    <div class="absolute right-0 top-0 bottom-0 w-2 hidden lg:block" style="background: repeating-linear-gradient(180deg, #ffffff 0px, #ffffff 20px, #c41e3a 20px, #c41e3a 40px, #1a3a8f 40px, #1a3a8f 60px);"></div>

    {{-- Decoratieve hoek elementen --}}
    <div class="absolute top-8 left-8 w-24 h-24 border border-opacity-20 rotate-45 hidden lg:block" style="border-color: {{ $primaryColor }}30;"></div>
    <div class="absolute bottom-8 right-8 w-32 h-32 border border-opacity-20 -rotate-12 hidden lg:block" style="border-color: {{ $primaryColor }}30;"></div>

    <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center">
        {{-- Vintage badge --}}
        <div
            class="flex items-center justify-center gap-4 mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0s;"
        >
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
            <div class="px-4 py-2 border-2 text-xs font-bold uppercase tracking-[0.3em]" style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }};">
                Premium Service
            </div>
            <div class="w-16 h-px" style="background-color: {{ $primaryColor }};"></div>
        </div>

        {{-- Schaar icon --}}
        <div
            class="flex justify-center mb-8"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.15s;"
        >
            <svg class="w-14 h-14" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
            </svg>
        </div>

        {{-- Titel --}}
        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 uppercase tracking-wider"
            style="color: #ffffff; font-family: 'Playfair Display', Georgia, serif; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.3s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {!! $title !!}
        </h2>

        {{-- Subtitel --}}
        <p
            class="text-xl mb-4 uppercase tracking-[0.2em]"
            style="color: {{ $primaryColor }}; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.45s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $subtitle }}
        </p>

        {{-- Beschrijving --}}
        <p
            class="text-lg mb-12 max-w-2xl mx-auto opacity-70 leading-relaxed"
            style="color: #ffffff; opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.55s;"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        >
            {{ $description }}
        </p>

        {{-- CTA Buttons --}}
        <div
            class="flex flex-col sm:flex-row items-center justify-center gap-4"
            x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
            style="opacity: 0; transform: translateY(16px); transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1) 0.65s;"
        >
            {{-- Primary CTA --}}
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold uppercase tracking-widest transition-all duration-300 hover:scale-105 border-2"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-color: {{ $primaryColor }};"
            >
                {{ $ctaText }}
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            {{-- Secondary CTA --}}
            <a
                href="{{ $secondaryCtaLink }}"
                class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold uppercase tracking-widest border-2 transition-all duration-300 hover:bg-opacity-10"
                style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }}; background-color: transparent;"
            >
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                {{ $secondaryCtaText }}
            </a>
        </div>

        {{-- Openingstijden indicator --}}
        <div class="mt-12 pt-8 border-t" style="border-color: {{ $primaryColor }}30;">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-sm uppercase tracking-wider opacity-70" style="color: #ffffff;">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Ma-Za: 09:00 - 20:00</span>
                </div>
                <div class="hidden sm:block w-px h-4" style="background-color: {{ $primaryColor }}40;"></div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Walk-ins welkom</span>
                </div>
            </div>
        </div>
    </div>
</section>
