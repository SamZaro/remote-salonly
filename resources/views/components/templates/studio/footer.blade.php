{{--
    Template-specifieke footer voor Studio (Creative Hair Studio)

    Creatief, Energiek & Trendy - vrolijk, creatief, sociaal
    Props: $content, $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    // Content met defaults
    $companyName = $content['company_name'] ?? 'Studio';
    $description = $content['description'] ?? 'Waar creativiteit en stijl samenkomen. Your hair, your rules.';
    $address = $content['address'] ?? 'Creativelaan 42, Amsterdam';
    $phone = $content['phone'] ?? '+31 20 123 4567';
    $email = $content['email'] ?? 'hey@studio-hair.nl';
    $socialLinks = $content['social_links'] ?? [
        'instagram' => '#',
        'tiktok' => '#',
        'facebook' => '#',
    ];

    // Theme kleuren - dynamisch met Peach defaults
    $primaryColor = $theme['primary_color'] ?? '#FF6F61';
    $secondaryColor = $theme['secondary_color'] ?? '#2B2B2B';
    $accentColor = $theme['accent_color'] ?? '#FFD6C9';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $headingFont = $theme['heading_font_family'] ?? 'Abril Fatface';
    $bodyFont = $theme['font_family'] ?? 'Nunito';

    // Social icons
    $socialIcons = [
        'instagram' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>',
        'tiktok' => '<path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>',
        'facebook' => '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>',
    ];
@endphp

<footer id="footer" class="py-16 lg:py-20 relative overflow-hidden" style="background: {{ $secondaryColor }};">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(white 2px, transparent 2px); background-size: 40px 40px;"></div>



    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid gap-12 lg:grid-cols-4">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                {{-- Logo --}}
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-12 h-12 rounded-2xl flex items-center justify-center transform -rotate-6"
                        style="background: {{ $primaryColor }};"
                    >
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-white" style="font-family: '{{ $headingFont }}', sans-serif;">
                        {{ $companyName }}
                    </span>
                </div>

                <p class="text-base mb-8 max-w-sm" style="color: white; opacity: 0.7;">
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
                                class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-rotate-6"
                                style="background: {{ $primaryColor }};"
                                aria-label="{{ ucfirst($platform) }}"
                            >
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    {!! $socialIcons[$platform] ?? '' !!}
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Contact --}}
            <div>
                <h4
                    class="text-sm font-bold uppercase tracking-wider mb-6 px-3 py-1 rounded-full inline-block"
                    style="background: {{ $primaryColor }}; color: white;"
                >
                    Contact
                </h4>
                <div class="space-y-4">
                    <p class="text-sm" style="color: white; opacity: 0.8;">
                        {{ $address }}
                    </p>
                    <p>
                        <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="text-sm transition-opacity hover:opacity-100" style="color: {{ $accentColor }};">
                            {{ $phone }}
                        </a>
                    </p>
                    <p>
                        <a href="mailto:{{ $email }}" class="text-sm transition-opacity hover:opacity-100" style="color: {{ $accentColor }};">
                            {{ $email }}
                        </a>
                    </p>
                </div>
            </div>

            {{-- Quick links --}}
            <div>
                <h4
                    class="text-sm font-bold uppercase tracking-wider mb-6 px-3 py-1 rounded-full inline-block"
                    style="background: {{ $primaryColor }}; color: white;"
                >
                    Menu
                </h4>
                <nav class="space-y-3">
                    <a href="#services" class="block text-sm transition-all hover:translate-x-2" style="color: white; opacity: 0.8;">Services</a>
                    <a href="#pricing" class="block text-sm transition-all hover:translate-x-2" style="color: white; opacity: 0.8;">Prijzen</a>
                    <a href="#gallery" class="block text-sm transition-all hover:translate-x-2" style="color: white; opacity: 0.8;">Gallery</a>
                    <a href="#contact" class="block text-sm transition-all hover:translate-x-2" style="color: white; opacity: 0.8;">Contact</a>
                </nav>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="mt-12 pt-8 border-t flex flex-col sm:flex-row items-center justify-between gap-4" style="border-color: white; border-opacity: 0.1;">
            <p class="text-sm" style="color: white; opacity: 0.5;">
                © {{ date('Y') }} {{ $companyName }}. All vibes reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-sm transition-opacity hover:opacity-100" style="color: white; opacity: 0.5;">Privacy</a>
                <a href="#" class="text-sm transition-opacity hover:opacity-100" style="color: white; opacity: 0.5;">Terms</a>
            </div>
        </div>
    </div>
</footer>
