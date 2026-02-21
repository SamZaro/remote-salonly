{{--
    Razor Template: Contact Form section
    Formulier introductie + Livewire contact form
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $email = $content['email'] ?? '';
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="contact-form" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Form intro --}}
            <div class="flex flex-col justify-center">
                <span class="text-xs font-bold uppercase tracking-[0.3em] mb-4" style="color: {{ $primaryColor }};">
                    {{ __('Contact') }}
                </span>
                <h3
                    class="text-2xl sm:text-3xl font-bold mb-4"
                    style="color: {{ $headingColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ __('Stuur ons een bericht') }}
                </h3>
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-px w-12" style="background-color: {{ $primaryColor }};"></div>
                </div>
                <p class="text-lg opacity-70 mb-8" style="color: {{ $textColor }};">
                    {{ __('Heeft u een vraag of wilt u een afspraak maken? Vul het formulier in en wij nemen zo snel mogelijk contact met u op.') }}
                </p>
                @if($email)
                    <a
                        href="mailto:{{ $email }}"
                        class="inline-flex items-center gap-3 text-sm font-bold uppercase tracking-wider transition-colors hover:opacity-80"
                        style="color: {{ $primaryColor }};"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ $email }}
                    </a>
                @endif
            </div>

            {{-- Form --}}
            <div
                class="p-8 lg:p-10"
                style="background-color: {{ $backgroundColor }}; border: 2px solid {{ $primaryColor }};"
            >
                <livewire:contact-form :theme="[
                    'primary_color' => $primaryColor,
                    'secondary_color' => $secondaryColor,
                    'background_color' => $backgroundColor,
                    'text_color' => $textColor,
                    'heading_color' => $textColor,
                ]" />
            </div>
        </div>
    </div>
</section>
