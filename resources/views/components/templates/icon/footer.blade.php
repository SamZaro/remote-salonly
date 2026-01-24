{{--
    Template-specifieke footer voor Icon (Hair Salon)

    Modern en fris met lichtblauw/mint thema
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
    $description = $content['description'] ?? 'Moderne haarstyling met oog voor detail en persoonlijke service.';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $copyright = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';

    // Social media links
    $socialLinks = $content['social_links'] ?? [];
    $facebookUrl = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    // Theme kleuren - fresh modern salon
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = $theme['text_color'] ?? '#1f2937';
    $backgroundColor = $theme['footer_background'] ?? '#f8fafc';
@endphp

<footer id="footer" class="py-16" style="background-color: {{ $backgroundColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 mb-12">
            {{-- Logo & Description - spans 4 columns --}}
            <div class="lg:col-span-4">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 rounded-xl flex items-center justify-center"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                    >
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold" style="color: {{ $textColor }};">
                        {{ $companyName }}
                    </h3>
                </div>
                @if($description)
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
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
                            class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400 hover:text-white transition-all duration-300"
                            style="background-color: transparent;"
                            onmouseover="this.style.background='linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }})'"
                            onmouseout="this.style.background='transparent'; this.style.color='#9ca3af'"
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
                            class="w-9 h-9 rounded-lg flex items-center justify-center text-gray-400 hover:text-white transition-all duration-300"
                            style="background-color: transparent;"
                            onmouseover="this.style.background='linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }})'"
                            onmouseout="this.style.background='transparent'; this.style.color='#9ca3af'"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Navigation - spans 2 columns --}}
            <div class="lg:col-span-2">
                <h4 class="text-sm font-semibold uppercase tracking-wider mb-4" style="color: {{ $textColor }};">
                    {{ __('Navigatie') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="text-gray-600 hover:text-gray-900 transition-colors text-sm"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact - spans 3 columns --}}
            <div class="lg:col-span-3">
                <h4 class="text-sm font-semibold uppercase tracking-wider mb-4" style="color: {{ $textColor }};">
                    {{ __('Contact') }}
                </h4>
                <ul class="space-y-3">
                    @if($address)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-600 text-sm">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="flex items-center gap-3 text-gray-600 hover:text-gray-900 transition-colors">
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="text-sm">{{ $phone }}</span>
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li>
                            <a href="mailto:{{ $email }}" class="flex items-center gap-3 text-gray-600 hover:text-gray-900 transition-colors">
                                <svg class="w-5 h-5" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm">{{ $email }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- CTA - spans 3 columns --}}
            <div class="lg:col-span-3">
                <h4 class="text-sm font-semibold uppercase tracking-wider mb-4" style="color: {{ $textColor }};">
                    {{ __('Afspraak maken') }}
                </h4>
                <p class="text-gray-600 text-sm mb-4">
                    {{ __('Klaar voor een nieuwe look? Maak vandaag nog een afspraak!') }}
                </p>
                <a
                    href="#contact"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-white text-sm font-medium transition-all duration-300 hover:scale-105 hover:shadow-lg"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                >
                    {{ __('Reserveren') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="pt-8 border-t border-gray-200">
            <p class="text-gray-500 text-sm text-center">
                {{ $copyright }}
            </p>
        </div>
    </div>
</footer>
