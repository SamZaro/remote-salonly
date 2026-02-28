{{--
    Template-specifieke footer voor Essence (Soft Luxury Salon)

    Elegant, verfijnd en vrouwelijk - bridal, balayage & boutique salons
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $companyName = $content['company_name'] ?? 'Essence';
    $description = $content['description'] ?? 'Waar schoonheid en verfijning samenkomen. Luxury hair & beauty voor de moderne vrouw.';
    $address = $content['address'] ?? 'Keizersgracht 123, Amsterdam';
    $phone = $content['phone'] ?? '+31 20 123 4567';
    $email = $content['email'] ?? 'info@essence-salon.nl';
    $socialLinks = $content['social_links'] ?? [
        'instagram' => '#',
        'facebook' => '#',
    ];

    // Theme kleuren - Soft Luxury palette
    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $accentColor = $theme['accent_color'] ?? '#F2E7E4';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['background_color'] ?? '#FBF9F8';

    $headingFont = $theme['heading_font_family'] ?? 'Cormorant';
    $bodyFont = $theme['font_family'] ?? 'Source Sans 3';

    // Social icons
    $socialIcons = [
        'instagram' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>',
        'facebook' => '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>',
        'pinterest' => '<path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/>',
    ];
@endphp

<footer id="footer" class="py-16 lg:py-20" style="background-color: {{ $secondaryColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-4">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <h3
                    class="text-2xl font-light mb-4"
                    style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', Georgia, serif;"
                >
                    {{ $companyName }}
                </h3>
                <p class="text-sm mb-6 max-w-md leading-relaxed" style="color: {{ $backgroundColor }}; opacity: 0.7;">
                    {{ $description }}
                </p>

                {{-- Social links --}}
                <div class="flex items-center gap-4">
                    @foreach($socialLinks as $platform => $url)
                        @if($url)
                            <a
                                href="{{ $url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 flex items-center justify-center transition-all duration-300 hover:opacity-70"
                                style="background-color: {{ $backgroundColor }}15;"
                                aria-label="{{ ucfirst($platform) }}"
                            >
                                <svg class="w-4 h-4" style="color: {{ $backgroundColor }};" fill="currentColor" viewBox="0 0 24 24">
                                    {!! $socialIcons[$platform] ?? '' !!}
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Contact info --}}
            <div>
                <h4 class="text-xs font-medium uppercase tracking-widest mb-6" style="color: {{ $primaryColor }};">Contact</h4>
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
                <h4 class="text-xs font-medium uppercase tracking-widest mb-6" style="color: {{ $primaryColor }};">Menu</h4>
                <nav class="space-y-3">
                    <a href="#services" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Services</a>
                    <a href="#pricing" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Prijzen</a>
                    <a href="#about" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Over ons</a>
                    <a href="#contact" class="block text-sm transition-opacity hover:opacity-70" style="color: {{ $backgroundColor }}; opacity: 0.8;">Contact</a>
                </nav>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="mt-16 pt-8 border-t flex flex-col sm:flex-row items-center justify-between gap-4" style="border-color: {{ $backgroundColor }}15;">
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
