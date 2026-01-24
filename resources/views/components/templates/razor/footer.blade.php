{{--
    Template-specifieke footer voor Razor (Barbershop)

    Bold barbershop stijl met goud/zwart thema
    Props: $content, $theme
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
    $description = $content['description'] ?? 'Premium barbershop voor de moderne gentleman.';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';

    // Social media links
    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    // Theme kleuren met defaults (consistent met projecto pattern)
    $primaryColor = $theme['primary_color'] ?? '#b8860b';
    $secondaryColor = $theme['secondary_color'] ?? '#0f0f0f';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['footer_background'] ?? '#0a0a0a';
    $accentColor = $theme['accent_color'] ?? '#f8f8f8';
    // Lichte tekstkleur voor donkere footer (consistent patroon)
    $lightTextColor = '#ffffff';
@endphp

<footer id="footer" class="py-20" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Top section with bold branding --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-6 mb-8">
                <div class="h-px w-20" style="background-color: {{ $primaryColor }};"></div>
                <div class="w-16 h-16 flex items-center justify-center" style="background-color: {{ $primaryColor }};">
                    <svg class="w-8 h-8" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                    </svg>
                </div>
                <div class="h-px w-20" style="background-color: {{ $primaryColor }};"></div>
            </div>

            <h3
                class="text-4xl font-bold uppercase tracking-[0.2em] mb-4"
                style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $companyName }}
            </h3>

            @if($description)
                <p class="uppercase tracking-widest text-sm" style="color: {{ $lightTextColor }}; opacity: 0.5;">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{-- Main content grid --}}
        <div class="grid md:grid-cols-3 gap-12 mb-16">
            {{-- Navigation --}}
            <div class="text-center md:text-left">
                <h4 class="text-xs font-bold uppercase tracking-[0.3em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Menu') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="transition-colors text-sm uppercase tracking-wider"
                                style="color: {{ $lightTextColor }}; opacity: 0.5;"
                                onmouseover="this.style.opacity='1'"
                                onmouseout="this.style.opacity='0.5'"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div class="text-center">
                <h4 class="text-xs font-bold uppercase tracking-[0.3em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Contact') }}
                </h4>
                <ul class="space-y-4">
                    @if($address)
                        <li class="text-sm" style="color: {{ $lightTextColor }}; opacity: 0.5;">
                            {{ $address }}
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="text-2xl font-bold transition-colors hover:opacity-80"
                                style="color: {{ $primaryColor }}; font-family: 'Playfair Display', Georgia, serif;"
                            >
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a
                                href="mailto:{{ $email }}"
                                class="transition-colors text-sm"
                                style="color: {{ $lightTextColor }}; opacity: 0.5;"
                                onmouseover="this.style.opacity='1'"
                                onmouseout="this.style.opacity='0.5'"
                            >
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Social & CTA --}}
            <div class="text-center md:text-right">
                <h4 class="text-xs font-bold uppercase tracking-[0.3em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Social') }}
                </h4>
                <div class="flex items-center justify-center md:justify-end gap-4 mb-8">
                    @if($facebookUrl)
                        <a
                            href="{{ $facebookUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-12 h-12 flex items-center justify-center transition-all duration-300 hover:scale-110"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
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
                            class="w-12 h-12 flex items-center justify-center transition-all duration-300 hover:scale-110"
                            style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                </div>

                <a
                    href="#contact"
                    class="inline-flex items-center gap-3 px-8 py-4 text-sm font-bold uppercase tracking-wider transition-all duration-300 hover:scale-105 border-2"
                    style="border-color: {{ $primaryColor }}; color: {{ $primaryColor }}; background: transparent;"
                    onmouseover="this.style.background='{{ $primaryColor }}'; this.style.color='{{ $secondaryColor }}'"
                    onmouseout="this.style.background='transparent'; this.style.color='{{ $primaryColor }}'"
                >
                    {{ __('Maak een afspraak') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="pt-8 border-t" style="border-color: {{ $primaryColor }}20;">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm" style="color: {{ $lightTextColor }}; opacity: 0.4;">
                    {{ $copyright }}
                </p>
                <div class="text-xs uppercase tracking-[0.3em]" style="color: {{ $lightTextColor }}; opacity: 0.4;">
                    {{ __('Premium Grooming') }}
                </div>
            </div>
        </div>
    </div>
</footer>
