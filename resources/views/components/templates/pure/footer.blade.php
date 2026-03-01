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
    $description = $content['description'] ?? 'Natuurlijke haarverzorging in harmonie met de aarde. 100% biologisch, vegan en duurzaam.';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';

    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

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
    {{-- Botanical decorations — more visible on dark background --}}
    <div class="absolute top-0 right-0 opacity-[0.07]">
        <svg class="w-72 h-72" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
            <path d="M50 35 L30 25" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
            <path d="M50 50 L70 38" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
            <path d="M50 65 L32 58" stroke="currentColor" stroke-width="0.5" opacity="0.3"/>
        </svg>
    </div>
    <div class="absolute bottom-0 left-0 opacity-[0.05]">
        <svg class="w-56 h-56" viewBox="0 0 100 100" fill="none" style="color: {{ $primaryColor }};">
            <path d="M50 5 C50 5, 90 30, 85 70 C80 95, 50 95, 50 95 C50 95, 20 95, 15 70 C10 30, 50 5, 50 5z" fill="currentColor"/>
            <path d="M50 15 L50 85" stroke="currentColor" stroke-width="0.5" opacity="0.5"/>
        </svg>
    </div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pt-16 lg:pt-24 pb-10 lg:pb-14">

        {{-- Hero company name statement --}}
        <div class="mb-16 lg:mb-20">
            <div class="w-16 h-px mb-8" style="background-color: {{ $primaryColor }};"></div>
            <h2
                class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold leading-none"
                style="color: #ffffff; font-family: '{{ $headingFont }}', serif;"
            >
                {{ $companyName }}
            </h2>
            @if($description)
                <p
                    class="mt-6 text-lg lg:text-xl max-w-xl leading-relaxed"
                    style="color: rgba(255,255,255,0.50); font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    {{ $description }}
                </p>
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
                    Navigatie
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
                            <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Adres</span>
                            <span class="text-base leading-relaxed" style="color: rgba(255,255,255,0.70); font-family: '{{ $bodyFont }}', sans-serif;">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">Telefoon</span>
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
                            <span class="text-xs font-bold uppercase tracking-wider block mb-1" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">E-mail</span>
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
                    Volg ons
                </h4>

                @if($facebookUrl || $instagramUrl)
                    <div class="flex items-center gap-3 mb-10">
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
                    </div>
                @endif

                {{-- CTA --}}
                <a
                    href="#contact"
                    class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold tracking-widest uppercase rounded-none transition-opacity duration-200 hover:opacity-80"
                    style="background-color: {{ $primaryColor }}; color: #ffffff; font-family: '{{ $bodyFont }}', sans-serif;"
                >
                    Afspraak maken
                    <svg class="w-4 h-4 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
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
                Alleen biologische producten
            </p>
        </div>
    </div>
</footer>
