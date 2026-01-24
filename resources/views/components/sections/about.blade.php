@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'About Us';
    $subtitle = $content['subtitle'] ?? '';
    $description = $content['description'] ?? '';
    $image = $section?->getFirstMediaUrl('images');
@endphp

<section
    id="about"
    class="py-20 px-4"
    style="background-color: {{ $theme['background_color'] ?? '#ffffff' }};"
>
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            {{-- Content --}}
            <div>
                @if($subtitle)
                    <p
                        class="text-sm font-semibold uppercase tracking-wider mb-2"
                        style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                    >
                        {{ $subtitle }}
                    </p>
                @endif

                <h2
                    class="text-3xl md:text-4xl font-bold mb-6"
                    style="
                        font-family: {{ $theme['heading_font_family'] ?? 'inherit' }};
                        color: {{ $theme['heading_color'] ?? '#111827' }};
                    "
                >
                    {{ $title }}
                </h2>

                @if($description)
                    <div
                        class="prose prose-lg max-w-none"
                        style="color: {{ $theme['text_color'] ?? '#1f2937' }};"
                    >
                        {!! nl2br(e($description)) !!}
                    </div>
                @endif
            </div>

            {{-- Image --}}
            @if($image)
                <div class="relative">
                    <img
                        src="{{ $image }}"
                        alt="{{ $title }}"
                        class="rounded-lg shadow-xl w-full"
                    >
                </div>
            @endif
        </div>
    </div>
</section>
