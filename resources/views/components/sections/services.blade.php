@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Our Services';
    $subtitle = $content['subtitle'] ?? '';
    $services = $content['items'] ?? [];
@endphp

<section
    id="services"
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

        {{-- Services Grid --}}
        @if(count($services) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div
                        class="p-6 rounded-lg transition-shadow hover:shadow-lg"
                        style="background-color: {{ $theme['secondary_color'] ?? '#f3f4f6' }}20;"
                    >
                        @if(isset($service['icon']))
                            <div
                                class="w-12 h-12 rounded-lg flex items-center justify-center mb-4"
                                style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                            >
                                <x-dynamic-component
                                    :component="$service['icon']"
                                    class="w-6 h-6 text-white"
                                />
                            </div>
                        @endif

                        <h3
                            class="text-xl font-semibold mb-3"
                            style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                        >
                            {{ $service['title'] ?? '' }}
                        </h3>

                        <p style="color: {{ $theme['text_color'] ?? '#1f2937' }};">
                            {{ $service['description'] ?? '' }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">
                No services defined yet. Add services in the template configuration.
            </p>
        @endif
    </div>
</section>
