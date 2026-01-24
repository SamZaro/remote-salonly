{{--
    Template-specifieke hero voor Icon (Hair Salon)

    Moderne, frisse kapsalon voor mannen en vrouwen
    Props: $content, $theme, $section
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Your Hair,<br>Your Style';
    $subtitle = $content['subtitle'] ?? 'Professionele haarverzorging voor mannen en vrouwen';
    $ctaText = $content['cta_text'] ?? 'Maak Afspraak';
    $ctaLink = $content['cta_link'] ?? '#contact';
    $backgroundImage = $section?->getFirstMediaUrl('background') ?: ($content['background_image'] ?? null);

    // Theme kleuren - frisse, zachte kleuren (lichtblauw + mint)
    $primaryColor = $theme['primary_color'] ?? '#0ea5e9';
    $secondaryColor = $theme['secondary_color'] ?? '#14b8a6';
    $textColor = '#1f2937';
    $lightBg = '#f8fafc';
@endphp

<section
    id="hero"
    class="relative min-h-screen flex items-center overflow-hidden"
    style="background: linear-gradient(135deg, {{ $lightBg }} 0%, #fff 50%, {{ $primaryColor }}08 100%);"
>


    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Content --}}
            <div class="text-center lg:text-left">
                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-8"
                    style="background: linear-gradient(135deg, {{ $primaryColor }}15, {{ $secondaryColor }}15); color: {{ $primaryColor }};"
                >
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background: {{ $primaryColor }};"></span>
                    Nu beschikbaar voor afspraken
                </div>

                {{-- Titel --}}
                <h1
                    class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6 leading-tight"
                    style="color: {{ $textColor }};"
                >
                    {!! $title !!}
                </h1>

                {{-- Subtitel --}}
                <p class="text-lg sm:text-xl mb-10 max-w-xl mx-auto lg:mx-0 text-gray-600">
                    {{ $subtitle }}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a
                        href="{{ $ctaLink }}"
                        class="group inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl text-white transition-all duration-300 hover:scale-105 hover:shadow-xl"
                        style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }}); box-shadow: 0 10px 40px {{ $primaryColor }}40;"
                    >
                        {{ $ctaText }}
                        <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a
                        href="#services"
                        class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-xl transition-all duration-300 hover:bg-gray-100"
                        style="color: {{ $textColor }};"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Bekijk diensten
                    </a>
                </div>

                {{-- Trust indicators --}}
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-6 mt-12 pt-8 border-t border-gray-200">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-2">
                            @for($i = 0; $i < 4; $i++)
                                <div
                                    class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center text-xs font-bold text-white"
                                    style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                                >
                                    {{ ['A', 'S', 'M', 'L'][$i] }}
                                </div>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600">500+ happy clients</span>
                    </div>
                    <div class="flex items-center gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        @endfor
                        <span class="text-sm text-gray-600 ml-1">4.9 rating</span>
                    </div>
                </div>
            </div>

            {{-- Image --}}
            <div class="relative">
                @if($backgroundImage)
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-3xl opacity-20 blur-2xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                        <img
                            src="{{ $backgroundImage }}"
                            alt="Hair Salon"
                            class="relative w-full h-[500px] lg:h-[600px] object-cover rounded-3xl shadow-2xl"
                        />
                    </div>
                @else
                    {{-- Placeholder --}}
                    <div class="relative">
                        <div class="absolute -inset-4 rounded-3xl opacity-20 blur-2xl" style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"></div>
                        <div
                            class="relative w-full h-[500px] lg:h-[600px] rounded-3xl flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}10, {{ $secondaryColor }}10);"
                        >
                            <div class="text-center">
                                <svg class="w-24 h-24 mx-auto mb-4" style="color: {{ $primaryColor }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664"/>
                                </svg>
                                <span class="text-gray-400">Hero afbeelding</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Floating card --}}
                <div
                    class="absolute -bottom-6 -left-6 p-4 rounded-2xl bg-white shadow-xl hidden lg:block"
                    style="box-shadow: 0 20px 60px rgba(0,0,0,0.1);"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center"
                            style="background: linear-gradient(135deg, {{ $primaryColor }}, {{ $secondaryColor }});"
                        >
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Direct boeken</p>
                            <p class="text-sm text-gray-500">Online beschikbaar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10">
        <div class="flex flex-col items-center gap-2">
            <div class="w-8 h-12 rounded-full border-2 border-gray-300 flex items-start justify-center p-2">
                <div class="w-1.5 h-3 rounded-full bg-gray-400 animate-bounce"></div>
            </div>
        </div>
    </div>
</section>
