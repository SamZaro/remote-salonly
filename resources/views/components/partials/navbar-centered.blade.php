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
    :style="(scrolled || !isDesktop) ? 'background-color: {{ $navbarBg }}' : 'background-color: {{ $bgColor }}'"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Desktop Navigation - Centered Layout --}}
        <div class="hidden lg:flex flex-col items-center justify-center py-6">
            {{-- Logo bovenaan gecentreerd --}}
            <a href="#hero" class="flex items-center mb-4">
                @if($logoType === 'image' && $logoImage)
                    <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-12 w-auto">
                @else
                    <span
                        class="text-2xl font-bold"
                        :style="scrolled ? 'color: {{ $navbarText }}' : 'color: {{ $textColor }}'"
                    >
                        {{ $logoText }}
                    </span>
                @endif
            </a>

            {{-- Nav items gecentreerd eronder --}}
            <div class="flex items-center gap-8">
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
                @bookingEnabled
                    <livewire:booking.booking-trigger
                        style="navbar"
                        :background-color="$theme['primary_color'] ?? '#3b82f6'"
                        :text-color="$theme['secondary_color'] ?? '#ffffff'"
                    />
                @endbookingEnabled
            </div>
        </div>

        {{-- Mobile: Logo and Menu Button --}}
        <div class="lg:hidden flex items-center justify-between w-full h-20">
            <a href="#hero" class="flex items-center">
                @if($logoType === 'image' && $logoImage)
                    <img src="{{ $logoImage }}" alt="{{ $logoText }}" class="h-8 w-auto">
                @else
                    <span
                        class="text-xl font-bold"
                        :style="scrolled ? 'color: {{ $navbarText }}' : 'color: {{ $textColor }}'"
                    >
                        {{ $logoText }}
                    </span>
                @endif
            </a>

                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none"
                    :style="scrolled ? 'color: {{ $navbarText }}' : 'color: {{ $textColor }}'"
                >
                    <svg
                        class="h-6 w-6"
                        x-show="!mobileMenuOpen"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg
                        class="h-6 w-6"
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

    {{-- Mobile menu --}}
    <div
        x-show="mobileMenuOpen"
        x-collapse
        class="lg:hidden"
        style="background-color: {{ $navbarBg }};"
    >
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">
            @foreach($navigation as $item)
                <a
                    href="#{{ $item['slug'] }}"
                    @click="mobileMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 hover:bg-black/5 active:bg-black/10"
                    style="color: {{ $navbarText }};"
                >
                    {{ $item['title'] }}
                </a>
            @endforeach
            @bookingEnabled
                <livewire:booking.booking-trigger
                    style="mobile"
                    :background-color="$theme['primary_color'] ?? '#3b82f6'"
                    :text-color="$theme['secondary_color'] ?? '#ffffff'"
                />
            @endbookingEnabled
        </div>
    </div>
</nav>

{{-- Spacer for fixed navbar (niet bij transparante navbar) --}}
@if($isSticky && !$isTransparent)
    <div class="h-20 lg:h-[120px]"></div>
@endif
</div>
