{{--
    King Template: Footer Section
    "Royal Throne" — dark footer, 4-column grid, crown accents, gold details
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $siteName = $content['site_name'] ?? config('app.name', 'King Barbershop');
    $description = $content['description'] ?? __('Premium grooming for the modern gentleman. Every cut, crafted like royalty.');
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $socialLinks = $content['social_links'] ?? [];
    $navigationItems = $content['navigation_items'] ?? [
        ['title' => __('Home'), 'slug' => 'hero'],
        ['title' => __('About'), 'slug' => 'about'],
        ['title' => __('Services'), 'slug' => 'services'],
        ['title' => __('Gallery'), 'slug' => 'gallery'],
        ['title' => __('Contact'), 'slug' => 'contact'],
    ];
    $ctaText = $content['cta_text'] ?? __('Book Your Throne');
    $ctaLink = $content['cta_link'] ?? '#contact';

    $primaryColor = $theme['primary_color'] ?? '#C8B88A';
    $secondaryColor = $theme['secondary_color'] ?? '#0F0F0F';
    $accentColor = $theme['accent_color'] ?? '#D4C4A0';
    $textColor = $theme['text_color'] ?? '#6B6B6B';
    $headingColor = $theme['heading_color'] ?? '#0F0F0F';
    $backgroundColor = $theme['background_color'] ?? '#F5F3EF';
    $headingFont = $theme['heading_font_family'] ?? 'DM Serif Display';
    $bodyFont = $theme['font_family'] ?? 'Manrope';
@endphp

<footer id="footer" style="background-color: {{ $secondaryColor }}; font-family: '{{ $bodyFont }}', sans-serif;">
    {{-- Gold top line --}}
    <div class="w-full h-px" style="background: linear-gradient(to right, transparent, {{ $primaryColor }}40, {{ $primaryColor }}, {{ $primaryColor }}40, transparent);"></div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">

            {{-- Column 1: Brand + Social --}}
            <div class="lg:col-span-1">
                <h3
                    class="text-2xl mb-4"
                    style="color: {{ $backgroundColor }}; font-family: '{{ $headingFont }}', serif; font-weight: 400;"
                >
                    {{ $siteName }}
                </h3>
                {{-- Diamond accent --}}
                <div class="flex items-center gap-0 mb-5">
                    <div class="w-1.5 h-1.5 rotate-45" style="background-color: {{ $primaryColor }};"></div>
                    <div class="w-8 h-px mx-1.5" style="background-color: {{ $primaryColor }}40;"></div>
                </div>
                <p class="text-[13px] leading-[1.7] mb-6" style="color: {{ $backgroundColor }}40;">
                    {{ $description }}
                </p>

                {{-- Social links --}}
                @if(count($socialLinks) > 0)
                    <div class="flex gap-3">
                        @foreach($socialLinks as $social)
                            <a
                                href="{{ $social['url'] ?? '#' }}"
                                class="w-9 h-9 flex items-center justify-center transition-all duration-300 hover:brightness-110"
                                style="border: 1px solid {{ $primaryColor }}20; color: {{ $primaryColor }};"
                                target="_blank"
                                rel="noopener noreferrer"
                                aria-label="{{ $social['platform'] ?? 'Social' }}"
                            >
                                @if(($social['platform'] ?? '') === 'instagram')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                @elseif(($social['platform'] ?? '') === 'facebook')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                @elseif(($social['platform'] ?? '') === 'tiktok')
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                                @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Column 2: Navigation --}}
            <div>
                <h4 class="text-[12px] font-bold uppercase tracking-[0.2em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Navigation') }}
                </h4>
                <ul class="space-y-3">
                    @foreach($navigationItems as $item)
                        <li>
                            <a
                                href="#{{ $item['slug'] ?? '' }}"
                                class="text-[13px] transition-colors duration-300 hover:opacity-80"
                                style="color: {{ $backgroundColor }}40;"
                            >
                                {{ $item['title'] ?? '' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Contact --}}
            <div>
                <h4 class="text-[12px] font-bold uppercase tracking-[0.2em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Contact') }}
                </h4>
                <ul class="space-y-3">
                    @if($address)
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 mt-0.5 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <span class="text-[13px]" style="color: {{ $backgroundColor }}40;">{{ $address }}</span>
                        </li>
                    @endif
                    @if($phone)
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="text-[13px] transition-colors duration-300 hover:opacity-80" style="color: {{ $backgroundColor }}40;">
                                {{ $phone }}
                            </a>
                        </li>
                    @endif
                    @if($email)
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $email }}" class="text-[13px] transition-colors duration-300 hover:opacity-80" style="color: {{ $backgroundColor }}40;">
                                {{ $email }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Column 4: CTA --}}
            <div>
                <h4 class="text-[12px] font-bold uppercase tracking-[0.2em] mb-6" style="color: {{ $primaryColor }};">
                    {{ __('Book Now') }}
                </h4>
                <p class="text-[13px] leading-[1.7] mb-6" style="color: {{ $backgroundColor }}40;">
                    {{ __('Ready for the royal treatment? Book your appointment today.') }}
                </p>
                <a
                    href="{{ $ctaLink }}"
                    class="group inline-flex items-center justify-center px-6 py-3 text-[11px] font-bold uppercase tracking-[0.2em] transition-all duration-300 hover:brightness-110"
                    style="background-color: {{ $primaryColor }}; color: {{ $secondaryColor }};"
                >
                    {{ $ctaText }}
                    <svg class="w-3 h-3 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>

    {{-- Copyright bar --}}
    <div class="py-5" style="border-top: 1px solid {{ $backgroundColor }}08;">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-[11px]" style="color: {{ $backgroundColor }}20;">
                &copy; {{ date('Y') }} {{ $siteName }}. {{ __('All rights reserved.') }}
            </p>
            <div class="flex items-center gap-2">
                <div class="w-1 h-1 rotate-45" style="background-color: {{ $primaryColor }}30;"></div>
                <span class="text-[10px] uppercase tracking-[0.15em]" style="color: {{ $backgroundColor }}15;">
                    {{ __('Crafted with pride') }}
                </span>
                <div class="w-1 h-1 rotate-45" style="background-color: {{ $primaryColor }}30;"></div>
            </div>
        </div>
    </div>
</footer>
