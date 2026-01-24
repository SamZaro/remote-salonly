@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

@php
    $title = $content['title'] ?? 'Frequently Asked Questions';
    $subtitle = $content['subtitle'] ?? '';
    $items = $content['items'] ?? [];
@endphp

<section
    id="faq"
    class="py-20 px-4"
    style="background-color: {{ $theme['secondary_color'] ?? '#f3f4f6' }}15;"
>
    <div class="max-w-3xl mx-auto">
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

        {{-- FAQ Items --}}
        @if(count($items) > 0)
            <div class="space-y-4" x-data="{ openItem: null }">
                @foreach($items as $index => $item)
                    <div
                        class="rounded-lg overflow-hidden"
                        style="background-color: {{ $theme['background_color'] ?? '#ffffff' }};"
                    >
                        <button
                            @click="openItem = openItem === {{ $index }} ? null : {{ $index }}"
                            class="w-full px-6 py-4 text-left flex items-center justify-between"
                        >
                            <span
                                class="font-semibold"
                                style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                            >
                                {{ $item['question'] ?? '' }}
                            </span>
                            <svg
                                class="w-5 h-5 transition-transform duration-200"
                                :class="{ 'rotate-180': openItem === {{ $index }} }"
                                style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div
                            x-show="openItem === {{ $index }}"
                            x-collapse
                            class="px-6 pb-4"
                        >
                            <p style="color: {{ $theme['text_color'] ?? '#1f2937' }};">
                                {{ $item['answer'] ?? '' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">
                No FAQ items defined yet.
            </p>
        @endif
    </div>
</section>
