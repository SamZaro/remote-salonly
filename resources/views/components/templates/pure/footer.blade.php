{{--
    Pure Template: Footer Section
    Natural & Botanical — bold dark footer with massive typography and teal accents
    Fonts: Lustria (headings) + Roboto (body)
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    use App\Services\TemplateService;

    $templateService = app(TemplateService::class);
    $template = $templateService->getActiveTemplate();
    $navigation = $templateService->getNavigationItems();

    $companyName = $content['company_name'] ?? $template?->name ?? config('app.name');

    // Logo configuratie op basis van theme_config (zelfde als navbar)
    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. ' . __('All rights reserved.');

    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '#';
    $instagramUrl = $socialLinks['instagram'] ?? '#';
    $googleUrl = $socialLinks['google'] ?? '#';
    $tiktokUrl = $socialLinks['tiktok'] ?? '#';

    $primaryColor = $theme['primary_color'] ?? '#14b8a6';
    $secondaryColor = $theme['secondary_color'] ?? '#1c1917';
    $accentColor = $theme['accent_color'] ?? '#99f6e4';
    $textColor = $theme['text_color'] ?? '#57534e';
    $headingColor = $theme['heading_color'] ?? '#1c1917';
    $backgroundColor = $theme['background_color'] ?? '#f0f0f0';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Roboto';
@endphp

<footer id="footer" class="relative overflow-hidden" style="background-color: {{ $secondaryColor }};">

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16 lg:pt-24 pb-10 lg:pb-14">

        {{-- Hero company name / logo statement --}}
        <div class="mb-16 lg:mb-20">
            <div class="w-16 h-px mb-8" style="background-color: {{ $primaryColor }};"></div>
            @if($logoType === 'image' && $logoImage)
                <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-14 sm:h-16">
            @else
                <h2
                    class="text-2xl sm:text-3xl font-bold leading-none"
                    style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
                >
                    {{ $companyName }}
                </h2>
            @endif
        </div>

        {{-- Three columns --}}
        <div class="grid md:grid-cols-3 gap-12 lg:gap-16 mb-16">

            {{-- Navigation --}}
            <div>
                <div class="w-8 h-px mb-6" style="background-color: {{ $primaryColor }};"></div>
                <h4
                    class="text-xs font-bold uppercase tracking-[0.25em] mb-6"
                    style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    {{ __('Navigation') }}
                </h4>
                <ul class="space-y-4">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="text-base lg:text-lg font-medium transition-opacity duration-200 hover:opacity-50"
                                style="color: rgba(255,255,255,0.80); font-family: '{{ $bodyFont }}', sans-serif;"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <div class="w-8 h-px mb-6" style="background-color: {{ $primaryColor }};"></div>
                <h4
                    class="text-xs font-bold uppercase tracking-[0.25em] mb-6"
                    style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    Contact
                </h4>
                <ul class="space-y-5">
                    @if($address)
                        <li>
                            <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ __('Address') }}</span>
                            <span class="text-base leading-relaxed" style="color: rgba(255,255,255,0.70); font-family: '{{ $bodyFont }}', sans-serif;">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ __('Phone') }}</span>
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="text-base transition-opacity hover:opacity-50"
                                style="color: rgba(255,255,255,0.70); font-family: '{{ $bodyFont }}', sans-serif;"
                            >
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ __('Email') }}</span>
                            <a
                                href="mailto:{{ $email }}"
                                class="text-base transition-opacity hover:opacity-50"
                                style="color: rgba(255,255,255,0.70); font-family: '{{ $bodyFont }}', sans-serif;"
                            >
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Social + CTA --}}
            <div>
                <div class="w-8 h-px mb-6" style="background-color: {{ $primaryColor }};"></div>
                <h4
                    class="text-xs font-bold uppercase tracking-[0.25em] mb-6"
                    style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    {{ __('Follow us') }}
                </h4>

                <div class="flex items-center gap-3">
                    @if($facebookUrl)
                        <a
                            href="{{ $facebookUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 flex items-center justify-center rounded-none transition-opacity duration-200 hover:opacity-70"
                            style="background-color: {{ $primaryColor }}; color: #ffffff;"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                    @endif
                    @if($instagramUrl)
                        <a
                            href="{{ $instagramUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 flex items-center justify-center rounded-none transition-opacity duration-200 hover:opacity-70"
                            style="background-color: {{ $primaryColor }}; color: #ffffff;"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                    @if($googleUrl)
                        <a
                            href="{{ $googleUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 flex items-center justify-center rounded-none transition-opacity duration-200 hover:opacity-70"
                            style="background-color: {{ $primaryColor }}; color: #ffffff;"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                        </a>
                    @endif
                    @if($tiktokUrl)
                        <a
                            href="{{ $tiktokUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 flex items-center justify-center rounded-none transition-opacity duration-200 hover:opacity-70"
                            style="background-color: {{ $primaryColor }}; color: #ffffff;"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div
            class="pt-8 flex items-center justify-between gap-6 flex-wrap"
            style="border-top: 1px solid rgba(255,255,255,0.08);"
        >
            <p
                class="text-xs"
                style="color: rgba(255,255,255,0.30); font-family: '{{ $bodyFont }}', sans-serif;"
            >
                {{ $copyright }}
            </p>
            <p
                class="text-xs"
                style="color: rgba(255,255,255,0.18); font-family: '{{ $bodyFont }}', sans-serif;"
            >
                {{ __('Only organic products') }}
            </p>
        </div>
    </div>
</footer>
