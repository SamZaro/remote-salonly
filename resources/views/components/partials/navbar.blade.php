@props([
    'theme' => [],
    'template' => null,
    'navigation' => [],
])

@php
    $isSticky = $theme['navbar_sticky'] ?? true;
    $isTransparent = $theme['navbar_transparent'] ?? false;

    // Smart defaults: fallback naar template kleuren als navbar kleuren niet expliciet zijn ingesteld
    $navbarBg = $theme['navbar_background'] ?? $theme['secondary_color'] ?? '#ffffff';
    $navbarText = $theme['navbar_text_color'] ?? $theme['primary_color'] ?? '#111827';

    $bgColor = $isTransparent ? 'transparent' : $navbarBg;
    $textColor = $navbarText;

    // Logo configuratie op basis van theme_config
    $logoType = $theme['logo']['type'] ?? 'text';
    $logoText = $theme['logo']['text'] ?? $template?->name ?? config('app.name');
    $logoImage = ($logoType === 'image') ? $template?->logo_url : null;
@endphp

<div>
<nav
    x-data="{
        mobileMenuOpen: false,
        scrolled: false,
        isDesktop: window.innerWidth >= 1024
    }"
    x-init="
        window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 });
        window.addEventListener('resize', () => { isDesktop = window.innerWidth >= 1024 });
    "
    :class="{ 'shadow-lg': scrolled || !isDesktop }"
    class="w-full z-50 transition-all duration-300 {{ $isSticky ? 'fixed top-0 left-0' : 'relative' }}"
    style="background-color: {{ $bgColor }}"
    :style="(scrolled || !isDesktop) ? 'background-color: {{ $navbarBg }}' : 'background-color: {{ $bgColor }}'"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo (Left) --}}
            <div class="flex-shrink-0">
                <a href="#hero" class="flex items-center">
                    @if($logoType === 'image' && $logoImage)
                        <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-14 sm:h-14">
                    @else
                        <span
                            class="text-2xl font-bold"
                            style="color: {{ $textColor }}"
                            :style="scrolled ? 'color: {{ $navbarText }}' : 'color: {{ $textColor }}'"
                        >
                            {{ $logoText }}
                        </span>
                    @endif
                </a>
            </div>

            {{-- Desktop Navigation (Center) --}}
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex items-center space-x-8">
                    @foreach($navigation as $item)
                        <x-partials.navbar-item
                            :href="'#' . $item['slug']"
                            :textColor="$textColor"
                            :scrolledColor="$navbarText"
                            :underlineColor="$theme['navbar_underline_color'] ?? $theme['primary_color'] ?? '#3b82f6'"
                        >
                            {{ $item['title'] }}
                        </x-partials.navbar-item>
                    @endforeach
                </div>
            </div>

            {{-- Right side: Booking button + Mobile menu --}}
            <div class="flex items-center flex-shrink-0">
                @bookingEnabled
                    <div class="hidden md:block">
                        <livewire:booking.booking-trigger
                            style="navbar"
                            :background-color="$theme['primary_color'] ?? '#3b82f6'"
                            :text-color="$theme['secondary_color'] ?? '#ffffff'"
                        />
                    </div>
                @endbookingEnabled

                {{-- Mobile menu button --}}
                <div class="md:hidden">
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="inline-flex items-center justify-center p-3 rounded-md focus:outline-none"
                    style="color: {{ $textColor }}"
                    :style="scrolled ? 'color: {{ $navbarText }}' : 'color: {{ $textColor }}'"
                >
                    <svg
                        class="h-7 w-7"
                        x-show="!mobileMenuOpen"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg
                        class="h-7 w-7"
                        x-show="mobileMenuOpen"
                        x-cloak
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div
        x-show="mobileMenuOpen"
        x-collapse
        class="md:hidden border-t border-black/10"
        style="background-color: {{ $navbarBg }};"
    >
        <div class="divide-y divide-black/10">
            @foreach($navigation as $item)
                <a
                    href="#{{ $item['slug'] }}"
                    @click="mobileMenuOpen = false"
                    class="block px-4 py-4 text-center text-base font-medium transition-colors duration-200 hover:bg-black/5 active:bg-black/10"
                    style="color: {{ $navbarText }};"
                >
                    {{ $item['title'] }}
                </a>
            @endforeach
            @bookingEnabled
                <div class="px-4 py-4">
                    <livewire:booking.booking-trigger
                        style="mobile"
                        :background-color="$theme['primary_color'] ?? '#3b82f6'"
                        :text-color="$theme['secondary_color'] ?? '#ffffff'"
                    />
                </div>
            @endbookingEnabled
        </div>
    </div>
</nav>

{{-- Spacer for fixed navbar (niet bij transparante navbar) --}}
@if($isSticky && !$isTransparent)
    <div class="h-20"></div>
@endif
</div>
