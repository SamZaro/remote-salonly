{{--
    Template-specifieke testimonials sectie voor Shadow

    Content structure:
    - title: Section title
    - subtitle: Section subtitle
    - items: Array of testimonials with name, role, quote
--}}
@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    // Content met defaults
    $title = $content['title'] ?? 'Klantervaringen';
    $subtitle = $content['subtitle'] ?? 'Wat anderen zeggen';

    $defaultItems = [
        ['name' => 'Mark de Boer', 'role' => 'Vaste klant', 'quote' => 'Beste barbershop in de stad. De sfeer is top en mijn fade zit altijd perfect. Kom hier al jaren en ga niet meer weg.'],
        ['name' => 'Thomas Visser', 'role' => 'Vaste klant', 'quote' => 'Eindelijk een barbershop die begrijpt wat ik wil. Goede service, scherpe prijzen en altijd een goed gesprek.'],
        ['name' => 'Kevin Bakker', 'role' => 'Nieuwe klant', 'quote' => 'Op aanraden van een vriend hier geweest. De hot towel shave was een geweldige ervaring. Zeker een aanrader!'],
    ];
    $items = !empty($content['items']) ? $content['items'] : $defaultItems;

    // Theme kleuren
    $primaryColor = $theme['primary_color'] ?? '#f59e0b';
    $secondaryColor = $theme['secondary_color'] ?? '#1f2937';
    $textColor = $theme['text_color'] ?? '#333333';
    $headingColor = $theme['heading_color'] ?? $textColor;
    $backgroundColor = $theme['background_color'] ?? '#ffffff';
@endphp

<section id="testimonials" class="py-20 lg:py-28" style="background-color: {{ $backgroundColor }};">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        @if($title || $subtitle)
            <div class="mb-24 text-center">
                @if($subtitle)
                    <span
                        class="inline-block px-4 py-1 text-sm font-semibold uppercase tracking-wider rounded-sm mb-4"
                        style="background-color: {{ $primaryColor }}20; color: {{ $primaryColor }};"
                    >
                        {{ $subtitle }}
                    </span>
                @endif
                @if($title)
                    <h2
                        class="text-3xl sm:text-4xl lg:text-5xl font-bold"
                        style="color: {{ $headingColor }};"
                    >
                        {{ $title }}
                    </h2>
                @endif
            </div>
        @endif

        {{-- Testimonials Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($items as $item)
                <figure>
                    <svg
                        class="w-8 h-8 mb-4"
                        style="color: {{ $primaryColor }};"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        viewBox="0 0 18 14"
                    >
                        <path d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z"/>
                    </svg>
                    <blockquote>
                        <p
                            class="text-base lg:text-lg italic font-medium leading-relaxed mb-6"
                            style="color: {{ $headingColor }};"
                        >
                            "{{ $item['quote'] ?? '' }}"
                        </p>
                    </blockquote>
                    <figcaption class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold bg-gray-200"
                            style="color: {{ $secondaryColor }};"
                        >
                            {{ strtoupper(substr($item['name'] ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <cite
                                class="block font-semibold not-italic"
                                style="color: {{ $headingColor }};"
                            >
                                {{ $item['name'] ?? '' }}
                            </cite>
                            @if(!empty($item['role']))
                                <cite
                                    class="block text-sm not-italic opacity-75"
                                    style="color: {{ $textColor }};"
                                >
                                    {{ $item['role'] }}
                                </cite>
                            @endif
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>

    </div>
</section>
