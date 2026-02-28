{{--
    Spa Template: Footer Section
    Serene spa & wellness — elegant dark footer with warm accent tones
    Fonts: Lustria (headings) + Lato (body)
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
    $description = $content['description'] ?? 'Uw bestemming voor pure ontspanning en professionele schoonheidsbehandelingen.';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';

    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    $primaryColor = $theme['primary_color'] ?? '#E8D8D3';
    $secondaryColor = $theme['secondary_color'] ?? '#6E5F5B';
    $textColor = $theme['text_color'] ?? '#8A7B76';
    $headingColor = $theme['heading_color'] ?? '#6E5F5B';
    $backgroundColor = $theme['footer_background'] ?? '#FBF9F8';
    $headingFont = $theme['heading_font_family'] ?? 'Lustria';
    $bodyFont = $theme['font_family'] ?? 'Lato';
@endphp

<footer id="footer" class="py-16" style="background-color: {{ $secondaryColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main content --}}
        <div class="grid md:grid-cols-3 gap-12 mb-12">
            {{-- Brand --}}
            <div>
                <h3 class="text-xl font-bold mb-4" style="color: #ffffff; font-family: '{{ $headingFont }}', serif;">
                    {{ $companyName }}
                </h3>
                @if($description)
                    <p class="text-sm leading-relaxed mb-6" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                        {{ $description }}
                    </p>
                @endif

                {{-- Social --}}
                @if($facebookUrl || $instagramUrl)
                    <div class="flex items-center gap-3">
                        @if($facebookUrl)
                            <a
                                href="{{ $facebookUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 hover:opacity-80"
                                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
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
                                class="w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 hover:opacity-80"
                                style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Navigation --}}
            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest mb-5" style="color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;">
                    {{ __('Navigatie') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="text-sm transition-opacity hover:opacity-70"
                                style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest mb-5" style="color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;">
                    {{ __('Contact') }}
                </h4>
                <ul class="space-y-3">
                    @if($address)
                        <li class="text-sm" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">{{ $address }}</li>
                    @endif
                    @if($phone)
                        <li>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-sm transition-opacity hover:opacity-70" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a href="mailto:{{ $email }}" class="text-sm transition-opacity hover:opacity-70" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="pt-8" style="border-top: 1px solid {{ $primaryColor }}15;">
            <p class="text-xs" style="color: {{ $primaryColor }}50; font-family: '{{ $bodyFont }}', sans-serif;">
                {{ $copyright }}
            </p>
        </div>
    </div>
</footer>
