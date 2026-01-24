@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Pricing';
    $subtitle = $content['subtitle'] ?? '';
    $plans = $content['plans'] ?? [];
@endphp

<section
    id="pricing"
    class="py-20 px-4"
    style="background-color: {{ $theme['background_color'] ?? '#ffffff' }};"
>
    <div class="max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-16">
            @if($subtitle)
                <p
                    class="text-sm font-semibold uppercase tracking-wider mb-2"
                    style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                >
                    {{ $subtitle }}
                </p>
            @endif

            <h2
                class="text-3xl md:text-4xl font-bold"
                style="
                    font-family: {{ $theme['heading_font_family'] ?? 'inherit' }};
                    color: {{ $theme['heading_color'] ?? '#111827' }};
                "
            >
                {{ $title }}
            </h2>
        </div>

        {{-- Pricing Grid --}}
        @if(count($plans) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
                @foreach($plans as $plan)
                    <div
                        class="p-8 rounded-lg border-2 transition-shadow hover:shadow-xl {{ ($plan['featured'] ?? false) ? 'relative' : '' }}"
                        style="
                            border-color: {{ ($plan['featured'] ?? false) ? ($theme['primary_color'] ?? '#3b82f6') : 'transparent' }};
                            background-color: {{ $theme['background_color'] ?? '#ffffff' }};
                        "
                    >
                        @if($plan['featured'] ?? false)
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 px-4 py-1 rounded-full text-sm font-semibold text-white"
                                style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                            >
                                Most Popular
                            </div>
                        @endif

                        <h3
                            class="text-xl font-semibold mb-2"
                            style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                        >
                            {{ $plan['name'] ?? '' }}
                        </h3>

                        <div class="mb-4">
                            <span
                                class="text-4xl font-bold"
                                style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                            >
                                {{ $plan['price'] ?? '' }}
                            </span>
                            @if(isset($plan['period']))
                                <span style="color: {{ $theme['text_color'] ?? '#1f2937' }}; opacity: 0.7;">
                                    /{{ $plan['period'] }}
                                </span>
                            @endif
                        </div>

                        @if(isset($plan['description']))
                            <p
                                class="mb-6"
                                style="color: {{ $theme['text_color'] ?? '#1f2937' }};"
                            >
                                {{ $plan['description'] }}
                            </p>
                        @endif

                        @if(isset($plan['features']) && is_array($plan['features']))
                            <ul class="space-y-3 mb-8">
                                @foreach($plan['features'] as $feature)
                                    <li class="flex items-center gap-2">
                                        <svg
                                            class="w-5 h-5 shrink-0"
                                            style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span style="color: {{ $theme['text_color'] ?? '#1f2937' }};">
                                            {{ $feature }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <a
                            href="{{ $plan['cta_url'] ?? '#contact' }}"
                            class="block w-full py-3 px-6 rounded-lg font-semibold text-center transition-all duration-300"
                            style="
                                background-color: {{ ($plan['featured'] ?? false) ? ($theme['primary_color'] ?? '#3b82f6') : 'transparent' }};
                                color: {{ ($plan['featured'] ?? false) ? '#ffffff' : ($theme['primary_color'] ?? '#3b82f6') }};
                                border: 2px solid {{ $theme['primary_color'] ?? '#3b82f6' }};
                            "
                        >
                            {{ $plan['cta_text'] ?? 'Get Started' }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">
                No pricing plans defined yet.
            </p>
        @endif
    </div>
</section>
