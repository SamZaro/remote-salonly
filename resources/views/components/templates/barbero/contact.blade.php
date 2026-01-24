{{--
    Template-specifieke contact sectie voor Barbero (Barbershop)

    Contact & afspraak maken in vintage barbershop stijl
    Props zijn identiek: $content en $theme
--}}
@props([
    'content' => [],
    'theme' => [],
])

@php
    $title = $content['title'] ?? 'Kom Langs';
    $subtitle = $content['subtitle'] ?? 'Walk-ins welkom, afspraken gegarandeerd';
    $address = $content['address'] ?? '';
    $phone = $content['phone'] ?? '';
    $email = $content['email'] ?? '';
    $openingHours = $content['opening_hours'] ?? [];

    $primaryColor = $theme['primary_color'] ?? '#c9a227';
    $secondaryColor = $theme['secondary_color'] ?? '#1a1a1a';
    $textColor = $theme['text_color'] ?? '#333333';
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
    $accentColor = $theme['accent_color'] ?? '#f5f5f5';
@endphp
<section id="contact" class="py-20 lg:py-28" style="background-color: {{ $secondaryColor }};">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="flex items-center justify-center gap-4 mb-6">
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <div class="w-12 h-px" style="background-color: {{ $primaryColor }};"></div>
            </div>
            <h2
                class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 uppercase tracking-wider text-white"
                style="font-family: 'Playfair Display', Georgia, serif;"
            >
                {{ $title }}
            </h2>
            @if($subtitle)
                <p class="text-lg max-w-xl mx-auto opacity-70 uppercase tracking-widest text-white">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Contact Info Cards --}}
            <div class="space-y-6">
                {{-- Phone - prominent --}}
                @if($phone)
                    <a
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                        class="block p-8 border-2 transition-all duration-300 hover:scale-[1.02]"
                        style="border-color: {{ $primaryColor }}; background-color: {{ $primaryColor }};"
                    >
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 border-2 flex items-center justify-center" style="border-color: {{ $secondaryColor }};">
                                <svg class="w-8 h-8" style="color: {{ $secondaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold uppercase tracking-widest mb-1" style="color: {{ $secondaryColor }}; opacity: 0.7;">Bel direct</span>
                                <span class="block text-2xl font-bold" style="color: {{ $secondaryColor }};">{{ $phone }}</span>
                            </div>
                        </div>
                    </a>
                @endif

                {{-- Address --}}
                @if($address)
                    <div class="p-8 border" style="border-color: {{ $primaryColor }}40;">
                        <div class="flex items-start gap-6">
                            <div class="w-16 h-16 border-2 flex items-center justify-center flex-shrink-0" style="border-color: {{ $primaryColor }};">
                                <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="block text-sm font-bold uppercase tracking-widest mb-2" style="color: {{ $primaryColor }};">Adres</span>
                                <span class="block text-lg text-white opacity-90">{{ $address }}</span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Opening Hours --}}
            <div class="p-8 border" style="border-color: {{ $primaryColor }}40;">
                <div class="flex items-start gap-6">
                    <div class="w-16 h-16 border-2 flex items-center justify-center flex-shrink-0" style="border-color: {{ $primaryColor }};">
                        <svg class="w-8 h-8" style="color: {{ $primaryColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="block text-sm font-bold uppercase tracking-widest mb-6" style="color: {{ $primaryColor }};">Openingstijden</span>
                        @if(count($openingHours) > 0)
                            <div class="space-y-3">
                                @foreach($openingHours as $key => $value)
                                    @if(is_array($value))
                                        <div class="flex justify-between items-center pb-3 border-b" style="border-color: {{ $primaryColor }}20;">
                                            <span class="font-medium text-white opacity-70">{{ $value['day'] ?? '' }}</span>
                                            <span class="font-bold" style="color: {{ $primaryColor }};">{{ $value['hours'] ?? '' }}</span>
                                        </div>
                                    @else
                                        <div class="flex justify-between items-center pb-3 border-b" style="border-color: {{ $primaryColor }}20;">
                                            <span class="font-medium text-white opacity-70">{{ $key }}</span>
                                            <span class="font-bold" style="color: {{ $primaryColor }};">{{ $value }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-lg text-white opacity-90">{{ __('Neem contact op voor onze openingstijden.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
