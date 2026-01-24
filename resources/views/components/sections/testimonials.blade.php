@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'What Our Clients Say';
    $subtitle = $content['subtitle'] ?? '';
    $testimonials = $content['items'] ?? [];
@endphp

<section
    id="testimonials"
    class="py-20 px-4"
    style="background-color: {{ $theme['secondary_color'] ?? '#f3f4f6' }}15;"
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

        {{-- Testimonials Grid --}}
        @if(count($testimonials) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div
                        class="p-6 rounded-lg shadow-sm"
                        style="background-color: {{ $theme['background_color'] ?? '#ffffff' }};"
                    >
                        {{-- Quote --}}
                        <blockquote
                            class="text-lg mb-4"
                            style="color: {{ $theme['text_color'] ?? '#1f2937' }};"
                        >
                            "{{ $testimonial['quote'] ?? '' }}"
                        </blockquote>

                        {{-- Author --}}
                        <div class="flex items-center gap-4">
                            @if(isset($testimonial['avatar']))
                                <img
                                    src="{{ $testimonial['avatar'] }}"
                                    alt="{{ $testimonial['name'] ?? '' }}"
                                    class="w-12 h-12 rounded-full object-cover"
                                >
                            @else
                                <div
                                    class="w-12 h-12 rounded-full flex items-center justify-center text-white font-semibold"
                                    style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                                >
                                    {{ substr($testimonial['name'] ?? 'A', 0, 1) }}
                                </div>
                            @endif

                            <div>
                                <p
                                    class="font-semibold"
                                    style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                                >
                                    {{ $testimonial['name'] ?? '' }}
                                </p>
                                @if(isset($testimonial['role']))
                                    <p
                                        class="text-sm"
                                        style="color: {{ $theme['text_color'] ?? '#1f2937' }}; opacity: 0.7;"
                                    >
                                        {{ $testimonial['role'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">
                No testimonials defined yet.
            </p>
        @endif
    </div>
</section>
