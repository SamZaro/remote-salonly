@props([
    'content' => [],
    'theme' => [],
    'section' => null,
])

<section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
        <p class="text-gray-500 text-center">
            Section type "{{ $section?->section_type ?? 'unknown' }}" is not yet implemented.
        </p>
    </div>
</section>
