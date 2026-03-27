{{--
    Shadow Template: Footer Section
    Minimal & Professional — dark geometric footer, sharp edges, Inter typography
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
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. ' . __('All rights reserved.');

    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    $primaryColor = $theme['primary_color'] ?? '#171717';
    $secondaryColor = $theme['secondary_color'] ?? '#0a0a0a';
    $accentColor = $theme['accent_color'] ?? '#404040';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $backgroundColor = $theme['background_color'] ?? '#FAFAFA';
    $headingFont = $theme['heading_font_family'] ?? 'Inter';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    // Logo configuratie op basis van theme_config
    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

{{-- Top accent line --}}
<div class="w-full h-px" style="background-color: {{ $primaryColor }};"></div>

<footer id="footer" class="py-20" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Brand row --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 pb-14 mb-14" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <div>
                @if($logoType === 'image' && $logoImage)
                    <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-14 sm:h-16 mb-3">
                @else
                    <h3
                        class="text-2xl sm:text-3xl font-bold tracking-tight mb-2"
                        style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                    >
                        {{ $companyName }}
                    </h3>
                @endif
            </div>

            {{-- CTA --}}
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 px-8 py-4 text-sm font-semibold uppercase tracking-widest transition-all duration-300 hover:opacity-85 shrink-0"
                style="background-color: {{ $backgroundColor }}; color: {{ $secondaryColor }}; border-radius: 2px;"
            >
                {{ __('Make appointment') }}
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Three columns --}}
        <div class="grid md:grid-cols-3 gap-12 lg:gap-16 mb-14">

            {{-- Navigation --}}
            <div>
                <h4
                    class="text-xs font-semibold uppercase tracking-widest mb-6"
                    style="color: {{ $backgroundColor }};"
                >
                    {{ __('Navigation') }}
                </h4>
                <ul class="space-y-4">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="text-sm transition-colors duration-200 hover:text-white"
                                style="color: rgba(255,255,255,0.40);"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4
                    class="text-xs font-semibold uppercase tracking-widest mb-6"
                    style="color: {{ $backgroundColor }};"
                >
                    Contact
                </h4>
                <ul class="space-y-5">
                    @if($address)
                        <li>
                            <span class="text-[11px] font-semibold uppercase tracking-wider block mb-1" style="color: rgba(255,255,255,0.20);">{{ __('Address') }}</span>
                            <span class="text-sm" style="color: rgba(255,255,255,0.50);">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <span class="text-[11px] font-semibold uppercase tracking-wider block mb-1" style="color: rgba(255,255,255,0.20);">{{ __('Phone') }}</span>
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="text-sm transition-colors duration-200 hover:text-white"
                                style="color: rgba(255,255,255,0.50);"
                            >
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <span class="text-[11px] font-semibold uppercase tracking-wider block mb-1" style="color: rgba(255,255,255,0.20);">{{ __('Email') }}</span>
                            <a
                                href="mailto:{{ $email }}"
                                class="text-sm transition-colors duration-200 hover:text-white"
                                style="color: rgba(255,255,255,0.50);"
                            >
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Social --}}
            <div>
                <h4
                    class="text-xs font-semibold uppercase tracking-widest mb-6"
                    style="color: {{ $backgroundColor }};"
                >
                    {{ __('Follow us') }}
                </h4>

                @if($facebookUrl || $instagramUrl)
                    <div class="flex items-center gap-3 mb-8">
                        @if($facebookUrl)
                            <a
                                href="{{ $facebookUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-11 h-11 flex items-center justify-center transition-all duration-200 hover:opacity-70"
                                style="background-color: rgba(255,255,255,0.06); color: {{ $backgroundColor }}; border-radius: 2px;"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                        @endif
                        @if($instagramUrl)
                            <a
                                href="{{ $instagramUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-11 h-11 flex items-center justify-center transition-all duration-200 hover:opacity-70"
                                style="background-color: rgba(255,255,255,0.06); color: {{ $backgroundColor }}; border-radius: 2px;"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Bottom bar --}}
        <div
            class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4"
            style="border-top: 1px solid rgba(255,255,255,0.06);"
        >
            <p class="text-xs" style="color: rgba(255,255,255,0.25);">
                {{ $copyright }}
            </p>
        </div>
    </div>
</footer>
