{{--
    Glaze Template: Footer Section
    Dark footer with rose accents and rounded elements
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

    $primaryColor = $theme['primary_color'] ?? '#e11d48';
    $secondaryColor = $theme['secondary_color'] ?? '#1f1f1f';
    $accentColor = $theme['accent_color'] ?? '#fb7185';
    $textColor = $theme['text_color'] ?? '#737373';
    $headingColor = $theme['heading_color'] ?? '#171717';
    $backgroundColor = $theme['background_color'] ?? '#fafafa';
    $headingFont = $theme['heading_font_family'] ?? 'Outfit';
    $bodyFont = $theme['font_family'] ?? 'Inter';

    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<footer id="footer" class="relative pt-20 pb-12" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Brand --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-3 mb-8">
                <div class="h-0.5 w-12 rounded-full" style="background: linear-gradient(to right, transparent, {{ $primaryColor }});"></div>
                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
                </svg>
                <div class="h-0.5 w-12 rounded-full" style="background: linear-gradient(to left, transparent, {{ $primaryColor }});"></div>
            </div>

            @if($logoType === 'image' && $logoImage)
                <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-16 sm:h-20 mx-auto mb-4">
            @else
                <h3
                    class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-3"
                    style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', sans-serif;"
                >
                    {{ $companyName }}
                </h3>
            @endif
        </div>

        {{-- Three columns --}}
        <div class="grid md:grid-cols-3 gap-12 lg:gap-16 mb-16">

            {{-- Navigation --}}
            <div class="text-center md:text-left">
                <h4 class="text-xs font-semibold uppercase tracking-[0.25em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Navigation') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a href="#{{ $item['slug'] }}" class="text-sm transition-colors duration-200 hover:text-white" style="color: rgba(255,255,255,0.35);">
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div class="text-center md:text-left">
                <h4 class="text-xs font-semibold uppercase tracking-[0.25em] mb-6" style="color: {{ $primaryColor }};">
                    Contact
                </h4>
                <ul class="space-y-4">
                    @if($address)
                        <li class="flex items-start gap-3 justify-center md:justify-start">
                            <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                            </svg>
                            <span class="text-sm" style="color: rgba(255,255,255,0.45);">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li class="flex items-center gap-3 justify-center md:justify-start">
                            <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-sm transition-colors duration-200 hover:text-white" style="color: rgba(255,255,255,0.45);">
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li class="flex items-center gap-3 justify-center md:justify-start">
                            <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                            </svg>
                            <a href="mailto:{{ $email }}" class="text-sm transition-colors duration-200 hover:text-white" style="color: rgba(255,255,255,0.45);">
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Social + CTA --}}
            <div class="text-center md:text-left">
                <h4 class="text-xs font-semibold uppercase tracking-[0.25em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Follow us') }}
                </h4>

                @if($facebookUrl || $instagramUrl)
                    <div class="flex items-center gap-3 mb-8 justify-center md:justify-start">
                        @if($facebookUrl)
                            <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200 hover:scale-110"
                                style="background-color: {{ $primaryColor }}; color: #ffffff;"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                </svg>
                            </a>
                        @endif
                        @if($instagramUrl)
                            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer"
                                class="w-10 h-10 flex items-center justify-center rounded-full transition-all duration-200 hover:scale-110"
                                style="background-color: {{ $primaryColor }}; color: #ffffff;"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif

                <a href="#contact"
                    class="inline-flex items-center justify-center px-7 py-3 text-sm font-semibold uppercase tracking-widest rounded-full transition-all duration-300 hover:scale-105"
                    style="background-color: {{ $primaryColor }}; color: #ffffff; box-shadow: 0 4px 16px {{ $primaryColor }}30;"
                >
                    {{ __('Make appointment') }}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4" style="border-top: 1px solid rgba(255,255,255,0.06);">
            <p class="text-xs" style="color: rgba(255,255,255,0.20);">{{ $copyright }}</p>
        </div>
    </div>
</footer>
