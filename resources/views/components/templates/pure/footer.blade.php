{{--
    Template-specifieke footer voor Pure (Natural & Wellness Salon)

    Natuurlijk, rustgevend, calm, eco, wellness
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $companyName = $content['company_name'] ?? 'Pure';
    $description = $content['description'] ?? 'Natuurlijke haarverzorging in harmonie met de aarde. 100% biologisch, vegan en duurzaam.';
    $address = $content['address'] ?? 'Herengracht 456, Amsterdam';
    $phone = $content['phone'] ?? '+31 20 123 4567';
    $email = $content['email'] ?? 'hello@pure-salon.nl';
    $socialLinks = $content['social_links'] ?? [
        'instagram' => '#',
        'facebook' => '#',
    ];

    // Theme kleuren - Natural palette
    $primaryColor = $theme['primary_color'] ?? '#059669';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#10b981';
    $backgroundColor = $theme['background_color'] ?? '#fafaf9';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'DM Sans';

    // Social icons
    $socialIcons = [
        'instagram' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>',
        'facebook' => '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>',
    ];
@endphp

<footer id="footer" class="py-16 lg:py-20" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-4">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                {{-- Logo with leaf --}}
                <div class="flex items-center gap-2 mb-4">
                    <div
                        class="w-10 h-10 rounded-full flex items-center justify-center"
                        style="background-color: {{ $primaryColor }}20;"
                    >
                        <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-light" style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', Georgia, serif;">
                        {{ $companyName }}
                    </span>
                </div>

                <p class="text-sm mb-6 max-w-sm leading-relaxed" style="color: {{ $backgroundColor }}; opacity: 0.7;">
                    {{ $description }}
                </p>

                {{-- Eco badges --}}
                <div class="flex flex-wrap gap-4 mb-6">
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs"
                        style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                    >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Vegan
                    </span>
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs"
                        style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                    >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Eco-Certified
                    </span>
                </div>

                {{-- Social links --}}
                <div class="flex items-center gap-3">
                    @foreach($socialLinks as $platform => $url)
                        @if($url)
                            <a
                                href="{{ $url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:opacity-70"
                                style="background-color: {{ $primaryColor }}20;"
                                aria-label="{{ ucfirst($platform) }}"
                            >
                                <svg class="w-4 h-4" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    {!! $socialIcons[$platform] ?? '' !!}
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-sm font-medium uppercase tracking-wider mb-6" style="color: {{ $primaryColor }};">Contact</h4>
                <div class="space-y-4">
                    <p class="text-sm" style="color: {{ $backgroundColor }}; opacity: 0.8;">
                        {{ $address }}
                    </p>
                    <p>
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">
                            {{ $phone }}
                        </a>
                    </p>
                    <p>
                        <a href="mailto:{{ $email }}" class="text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">
                            {{ $email }}
                        </a>
                    </p>
                </div>
            </div>

            {{-- Quick links --}}
            <div>
                <h4 class="text-sm font-medium uppercase tracking-wider mb-6" style="color: {{ $primaryColor }};">Menu</h4>
                <nav class="space-y-3">
                    <a href="#services" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Behandelingen</a>
                    <a href="#pricing" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Prijzen</a>
                    <a href="#about" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Over ons</a>
                    <a href="#contact" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Contact</a>
                </nav>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="mt-12 pt-8 border-t flex flex-col sm:flex-row items-center justify-between gap-4" style="border-color: {{ $backgroundColor }}10;">
            <p class="text-xs" style="color: {{ $backgroundColor }}; opacity: 0.5;">
                © {{ date('Y') }} {{ $companyName }}. Alle rechten voorbehouden.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-xs transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.5;">Privacy</a>
                <a href="#" class="text-xs transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.5;">Voorwaarden</a>
            </div>
        </div>
    </div>
</footer>
