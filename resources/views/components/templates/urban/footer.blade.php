{{--
    Urban Template: Footer Section
    Very dark — brand name prominent, 3-column grid, gold accents
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
    $template        = $templateService->getActiveTemplate();
    $navigation      = $templateService->getNavigationItems();

    $companyName  = $content['company_name'] ?? $template?->name ?? config('app.name');
    $description  = $content['description'] ?? 'Premium barbershop voor de moderne gentleman.';
    $address      = $content['address'] ?? '';
    $phone        = $content['phone'] ?? '';
    $email        = $content['email'] ?? '';
    $copyright    = $content['copyright'] ?? '© ' . date('Y') . ' ' . $companyName . '. Alle rechten voorbehouden.';
    $socialLinks  = $content['social_links'] ?? [];
    $facebookUrl  = $socialLinks['facebook'] ?? '';
    $instagramUrl = $socialLinks['instagram'] ?? '';

    $primaryColor   = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $backgroundColor = '#0a0a0a';
    $headingFont    = $theme['heading_font_family'] ?? 'Barlow Condensed, sans-serif';
    $bodyFont       = $theme['font_family'] ?? 'Barlow, sans-serif';
@endphp

<footer id="footer" class="py-20" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-6 sm:px-8 lg:px-12">

        {{-- Brand row --}}
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 pb-14 border-b mb-14" style="border-color: rgba(255,255,255,0.06);">
            <div>
                <h3
                    class="font-black uppercase leading-none tracking-tight mb-2"
                    style="font-family: '{{ $headingFont }}'; font-size: clamp(2rem, 4vw, 3.5rem); letter-spacing: -0.03em; color: {{ $primaryColor }};"
                >
                    {{ $companyName }}
                </h3>
                @if($description)
                    <p class="text-sm uppercase tracking-widest" style="color: rgba(255,255,255,0.25); font-family: '{{ $bodyFont }}';">
                        {{ $description }}
                    </p>
                @endif
            </div>

            {{-- CTA book button --}}
            <a
                href="#contact"
                class="group inline-flex items-center gap-3 px-8 py-4 font-bold uppercase tracking-widest text-sm transition-all hover:opacity-85 shrink-0"
                style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}';"
            >
                Maak afspraak
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- 3-column grid --}}
        <div class="grid md:grid-cols-3 gap-12 mb-14">

            {{-- Navigation --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-[0.35em] mb-6" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                    {{ __('Menu') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigation as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] }}"
                                class="text-sm uppercase tracking-wide transition-colors hover:opacity-100"
                                style="color: rgba(255,255,255,0.35); font-family: '{{ $bodyFont }}';"
                                onmouseover="this.style.color='{{ $primaryColor }}'"
                                onmouseout="this.style.color='rgba(255,255,255,0.35)'"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact info --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-[0.35em] mb-6" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                    {{ __('Contact') }}
                </h4>
                <div class="space-y-4">
                    @if($address)
                        <p class="text-sm leading-relaxed" style="color: rgba(255,255,255,0.35); font-family: '{{ $bodyFont }}';">{{ $address }}</p>
                    @endif
                    @if($phone)
                        <a
                            href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                            class="block font-black transition-opacity hover:opacity-70"
                            style="color: {{ $primaryColor }}; font-family: '{{ $headingFont }}'; font-size: 1.5rem; letter-spacing: -0.02em;"
                        >
                            {{ $phone }}
                        </a>
                    @endif
                    @if($email)
                        <a
                            href="mailto:{{ $email }}"
                            class="block text-sm transition-colors"
                            style="color: rgba(255,255,255,0.35); font-family: '{{ $bodyFont }}';"
                            onmouseover="this.style.color='{{ $primaryColor }}'"
                            onmouseout="this.style.color='rgba(255,255,255,0.35)'"
                        >
                            {{ $email }}
                        </a>
                    @endif
                </div>
            </div>

            {{-- Social --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-[0.35em] mb-6" style="color: {{ $primaryColor }}; font-family: '{{ $bodyFont }}';">
                    {{ __('Volg ons') }}
                </h4>
                <div class="flex gap-3">
                    @if($facebookUrl)
                        <a
                            href="{{ $facebookUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-11 h-11 flex items-center justify-center border transition-all hover:bg-white/5"
                            style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.5);"
                            onmouseover="this.style.borderColor='{{ $primaryColor }}'; this.style.color='{{ $primaryColor }}'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.color='rgba(255,255,255,0.5)'"
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
                            class="w-11 h-11 flex items-center justify-center border transition-all hover:bg-white/5"
                            style="border-color: rgba(255,255,255,0.15); color: rgba(255,255,255,0.5);"
                            onmouseover="this.style.borderColor='{{ $primaryColor }}'; this.style.color='{{ $primaryColor }}'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.color='rgba(255,255,255,0.5)'"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Copyright bar --}}
        <div class="pt-8 border-t flex flex-col sm:flex-row items-center justify-between gap-4" style="border-color: rgba(255,255,255,0.06);">
            <p class="text-xs" style="color: rgba(255,255,255,0.2); font-family: '{{ $bodyFont }}';">
                {{ $copyright }}
            </p>
            <p class="text-xs uppercase tracking-[0.3em]" style="color: rgba(255,255,255,0.2); font-family: '{{ $bodyFont }}';">
                Premium Grooming
            </p>
        </div>
    </div>
</footer>
