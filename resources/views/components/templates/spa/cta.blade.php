{{--
    Spa Template: CTA Section
    Serene spa & wellness — elegant call-to-action with warm dark overlay
    Fonts: Lustria (headings) + Lato (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Welcome to Spa Magic';
    $subtitle = $content['subtitle'] ?? 'Boek vandaag nog en laat je verwennen door ons team van experts';
    $ctaText = $content['cta_text'] ?? 'Book an Appointment';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $phone = $content['phone'] ?? '';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<section class="relative py-24 lg:py-32 overflow-hidden">
    @if($backgroundImage)
        <div class="absolute inset-0">
            <img src="{{ $backgroundImage }}" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }}dd 0%, {{ $secondaryColor }}cc 100%);"></div>
        </div>
    @else
        <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $secondaryColor }} 0%, {{ $secondaryColor }}cc 100%);"></div>
    @endif

    {{-- Decorative circles --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] rounded-full opacity-[0.04]" style="border: 2px solid #ffffff;"></div>

    <div
        class="relative z-10 mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 text-center"
        x-data x-intersect.once="$el.style.opacity = 1; $el.style.transform = 'translateY(0)'"
        style="opacity: 0; transform: translateY(20px); transition: all 0.8s ease-out;"
    >
        <div class="w-16 h-px mx-auto mb-8" style="background-color: {{ $primaryColor }};"></div>

        <h2
            class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
            style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
        >
            {{ $title }}
        </h2>

        <p class="text-xl mb-10 max-w-xl mx-auto leading-relaxed" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif; font-weight: 300;">
            {{ $subtitle }}
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a
                href="{{ $ctaLink }}"
                class="inline-flex items-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 hover:shadow-lg"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; border-radius: 4px; font-family: '{{ $bodyFont }}', sans-serif;"
                onmouseover="this.style.backgroundColor='#ffffff'; this.style.color='{{ $secondaryColor }}';"
                onmouseout="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='{{ $secondaryColor }}';"
            >
                {{ $ctaText }}
                <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>

            @if($phone)
                <a
                    href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                    class="inline-flex items-center px-10 py-4 text-sm font-semibold tracking-widest uppercase transition-all duration-300 hover:bg-white/10"
                    style="border: 1.5px solid rgba(255,255,255,0.3); color: #ffffff; border-radius: 4px; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Bel ons
                </a>
            @endif
        </div>
    </div>
</section>
