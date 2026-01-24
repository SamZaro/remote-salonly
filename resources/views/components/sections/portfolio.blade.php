@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Our Work';
    $subtitle = $content['subtitle'] ?? '';
    $projects = $content['projects'] ?? [];
    $images = $section?->getMedia('images') ?? collect();
@endphp

<section
    id="portfolio"
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

        {{-- Portfolio Grid --}}
        @if(count($projects) > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $index => $project)
                    <div class="group cursor-pointer">
                        <div class="relative aspect-video overflow-hidden rounded-lg mb-4">
                            @if(isset($images[$index]))
                                <img
                                    src="{{ $images[$index]->getUrl() }}"
                                    alt="{{ $project['title'] ?? '' }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                >
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center"
                                    style="background-color: {{ $theme['secondary_color'] ?? '#f3f4f6' }}30;"
                                >
                                    <svg class="w-12 h-12 opacity-50" style="color: {{ $theme['text_color'] ?? '#1f2937' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center"
                                style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }}90;"
                            >
                                @if(isset($project['url']))
                                    <a
                                        href="{{ $project['url'] }}"
                                        target="_blank"
                                        class="px-6 py-2 rounded-lg font-semibold text-white"
                                        style="background-color: {{ $theme['accent_color'] ?? '#f59e0b' }};"
                                    >
                                        View Project
                                    </a>
                                @endif
                            </div>
                        </div>

                        <h3
                            class="text-lg font-semibold mb-1"
                            style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                        >
                            {{ $project['title'] ?? '' }}
                        </h3>

                        @if(isset($project['category']))
                            <p
                                class="text-sm"
                                style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                            >
                                {{ $project['category'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @elseif($images->count() > 0)
            {{-- Fallback: just show images if no projects defined --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($images as $image)
                    <div class="relative aspect-video overflow-hidden rounded-lg">
                        <img
                            src="{{ $image->getUrl() }}"
                            alt="{{ $image->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">
                No portfolio projects defined yet.
            </p>
        @endif
    </div>
</section>
