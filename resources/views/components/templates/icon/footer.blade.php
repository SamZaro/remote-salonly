{{--
    Icon Template: Footer Section
    "Warm Atelier" — dark architectural footer, gold accents, refined serif typography
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

    // Content met defaults
    $companyName = $content['company_name'] ?? $template?->name ?? config('app.name');
    $description = $content['description'] ?? 'Moderne haarstyling met oog voor detail en persoonlijke service.';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';

    // Social media links
    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    // Theme kleuren - Warm Atelier
    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $accentColor = $theme['accent_color'] ?? '#d4af37';
    $textColor = $theme['text_color'] ?? '#555555';
    $headingColor = $theme['heading_color'] ?? '#1a1a1a';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $headingFont = $theme['heading_font_family'] ?? 'Cormorant Garamond';
    $bodyFont = $theme['font_family'] ?? 'Montserrat';

    // Footer background with fallback
    $footerBg = $theme['footer_background'] ?? $secondaryColor;
@endphp

{{-- Gold decorative line at the very top --}}
<div class="w-full h-px" style="background-color: {{ $primaryColor }};"></div>

<footer id="footer" class="pt-16 lg:pt-20 pb-0" style="background-color: {{ $footerBg }}; font-family: '{{ $bodyFont }}', sans-serif;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 pb-14">

            {{-- Column 1: Company info + Social --}}
            <div class="lg:col-span-4">
                <h3
                    class="text-xl mb-4"
                    style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 600;"
                >
                    {{ $companyName }}
                </h3>

                @if($description)
                    <p class="text-[13px] leading-relaxed mb-6" style="color: {{ $backgroundColor }}35;">
                        {{ $description }}
                    </p>
                @endif

                {{-- Social Links --}}
                <div class="flex items-center gap-3">
                    @if($facebookUrl)
                        <a
                            href="{{ $facebookUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center transition-all duration-300"
                            style="border: 1px solid {{ $primaryColor }}20; color: {{ $primaryColor }};"
                            onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff'; this.style.borderColor='{{ $primaryColor }}';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $primaryColor }}'; this.style.borderColor='{{ $primaryColor }}20';"
                        >
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                    @endif
                    @if($instagramUrl)
                        <a
                            href="{{ $instagramUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-8 h-8 flex items-center justify-center transition-all duration-300"
                            style="border: 1px solid {{ $primaryColor }}20; color: {{ $primaryColor }};"
                            onmouseover="this.style.backgroundColor='{{ $primaryColor }}'; this.style.color='#ffffff'; this.style.borderColor='{{ $primaryColor }}';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='{{ $primaryColor }}'; this.style.borderColor='{{ $primaryColor }}20';"
                        >
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Column 2: Navigation --}}
            <div class="lg:col-span-2">
                <h4
                    class="uppercase text-[11px] tracking-[0.3em] font-medium mb-6"
                    style="color: {{ $primaryColor }};"
                >
                    {{ __('Navigatie') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="text-[13px] transition-colors duration-300"
                                style="color: {{ $backgroundColor }}40;"
                                onmouseover="this.style.color='{{ $primaryColor }}';"
                                onmouseout="this.style.color='{{ $backgroundColor }}40';"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Contact info --}}
            <div class="lg:col-span-3">
                <h4
                    class="uppercase text-[11px] tracking-[0.3em] font-medium mb-6"
                    style="color: {{ $primaryColor }};"
                >
                    {{ __('Contact') }}
                </h4>
                <ul class="space-y-4">
                    @if($address)
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-[13px]" style="color: {{ $backgroundColor }}40;">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="flex items-center gap-3 transition-colors duration-300"
                                style="color: {{ $backgroundColor }}40;"
                                onmouseover="this.style.color='{{ $primaryColor }}';"
                                onmouseout="this.style.color='{{ $backgroundColor }}40';"
                            >
                                <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-[13px]">{{ $phone }}</span>
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a
                                href="mailto:{{ $email }}"
                                class="flex items-center gap-3 transition-colors duration-300"
                                style="color: {{ $backgroundColor }}40;"
                                onmouseover="this.style.color='{{ $primaryColor }}';"
                                onmouseout="this.style.color='{{ $backgroundColor }}40';"
                            >
                                <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-[13px]">{{ $email }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Column 4: CTA --}}
            <div class="lg:col-span-3">
                <h4
                    class="uppercase text-[11px] tracking-[0.3em] font-medium mb-6"
                    style="color: {{ $primaryColor }};"
                >
                    {{ __('Afspraak maken') }}
                </h4>
                <p class="text-[13px] leading-relaxed mb-6" style="color: {{ $backgroundColor }}35;">
                    {{ __('Klaar voor een nieuwe look? Maak vandaag nog een afspraak!') }}
                </p>
                <a
                    href="#contact"
                    class="inline-flex items-center gap-3 px-6 py-3 text-[11px] font-semibold uppercase tracking-[0.2em] text-white transition-all duration-300 hover:brightness-110"
                    style="background-color: {{ $primaryColor }};"
                >
                    {{ __('Reserveren') }}
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="py-6" style="border-top: 1px solid {{ $backgroundColor }}08;">
            <p class="text-[12px] text-center" style="color: {{ $backgroundColor }}25;">
                {{ $copyright }}
            </p>
        </div>
    </div>
</footer>
