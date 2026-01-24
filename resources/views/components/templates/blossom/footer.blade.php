{{--
    Template-specifieke footer voor Blossom (Luxury Beauty Salon)

    Elegante, zachte stijl met roze/lavendel thema
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
    $description = $content['description'] ?? 'Uw bestemming voor luxe schoonheidsbehandelingen en ultieme ontspanning.';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';

    // Social media links
    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    // Theme kleuren - luxury beauty salon
    $primaryColor = $theme['primary_color'] ?? '#d4919d';
    $secondaryColor = $theme['secondary_color'] ?? '#c9b8d4';
    $accentColor = $theme['accent_color'] ?? '#f5e6d3';
    $textColor = $theme['text_color'] ?? '#4a3f44';
    $backgroundColor = $theme['footer_background'] ?? '#faf8f5';
@endphp

<footer id="footer" class="py-20 relative overflow-hidden" style="background-color: {{ $backgroundColor }};">
    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 w-64 h-64 rounded-full opacity-20" style="background: {{ $primaryColor }}; transform: translate(-50%, -50%);"></div>
    <div class="absolute bottom-0 right-0 w-48 h-48 rounded-full opacity-20" style="background: {{ $secondaryColor }}; transform: translate(50%, 50%);"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        {{-- Top section with logo --}}
        <div class="text-center mb-16">
            <h3
                class="text-3xl font-bold mb-4"
                style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $companyName }}
            </h3>
            @if($description)
                <p class="text-lg max-w-xl mx-auto" style="color: {{ $textColor }}; opacity: 0.7;">
                    {{ $description }}
                </p>
            @endif
        </div>

        <div class="grid md:grid-cols-3 gap-12 mb-16">
            {{-- Quick Links --}}
            <div class="text-center">
                <div
                    class="w-12 h-12 mx-auto mb-6 rounded-full flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20);"
                >
                    <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <h4
                    class="text-lg font-semibold mb-4"
                    style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ __('Navigatie') }}
                </h4>
                <ul class="space-y-2">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="transition-colors text-sm"
                                style="color: {{ $textColor }}80;"
                                onmouseover="this.style.color='{{ $primaryColor }}'"
                                onmouseout="this.style.color='{{ $textColor }}80'"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="text-center">
                <div
                    class="w-12 h-12 mx-auto mb-6 rounded-full flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20);"
                >
                    <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h4
                    class="text-lg font-semibold mb-4"
                    style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ __('Contact') }}
                </h4>
                <ul class="space-y-2">
                    @if($address)
                        <li class="text-sm" style="color: {{ $textColor }}80;">
                            {{ $address }}
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <a
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                                class="text-sm transition-colors"
                                style="color: {{ $textColor }}80;"
                                onmouseover="this.style.color='{{ $primaryColor }}'"
                                onmouseout="this.style.color='{{ $textColor }}80'"
                            >
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a
                                href="mailto:{{ $email }}"
                                class="text-sm transition-colors"
                                style="color: {{ $textColor }}80;"
                                onmouseover="this.style.color='{{ $primaryColor }}'"
                                onmouseout="this.style.color='{{ $textColor }}80'"
                            >
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Social & Newsletter --}}
            <div class="text-center">
                <div
                    class="w-12 h-12 mx-auto mb-6 rounded-full flex items-center justify-center"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}20, {{ $secondaryColor }}20);"
                >
                    <svg class="w-6 h-6" style="color: {{ $primaryColor }};" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h4
                    class="text-lg font-semibold mb-4"
                    style="color: {{ $textColor }}; font-family: 'Playfair Display', Georgia, serif;"
                >
                    {{ __('Volg Ons') }}
                </h4>
                <div class="flex items-center justify-center gap-4">
                    @if($facebookUrl)
                        <a
                            href="{{ $facebookUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); color: white;"
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
                            class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); color: white;"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div
            class="pt-8 border-t text-center"
            style="border-color: {{ $primaryColor }}30;"
        >
            <p class="text-sm" style="color: {{ $textColor }}60;">
                {{ $copyright }}
            </p>
        </div>
    </div>
</footer>
