@php
    $record = $getRecord();
    $sections = $record?->sections()->with('media')->ordered()->get() ?? collect();
    $hasMedia = $sections->contains(fn ($section) => $section->media->isNotEmpty());
@endphp

<div class="space-y-6">
    @if ($hasMedia)
        @foreach ($sections as $section)
            @if ($section->media->isNotEmpty())
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <x-filament::badge>
                            {{ ucfirst($section->section_type) }}
                        </x-filament::badge>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $section->media->count() }} {{ trans_choice('image|images', $section->media->count()) }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @foreach ($section->media as $media)
                            <div class="group relative h-32 w-32 overflow-hidden rounded border border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-800">
                                <img
                                    src="{{ $media->getUrl() }}"
                                    alt="{{ $media->name }}"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                    title="{{ $media->file_name }} ({{ $media->human_readable_size }})"
                                />
                                <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity group-hover:opacity-100">
                                    <span class="text-xs text-white">{{ $media->collection_name }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="flex flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 p-12 text-center dark:border-gray-700">
            <x-filament::icon
                icon="heroicon-o-photo"
                class="mb-4 h-12 w-12 text-gray-400 dark:text-gray-500"
            />
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('No section images uploaded yet.') }}
            </p>
            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                {{ __('Upload images via the Sections tab.') }}
            </p>
        </div>
    @endif
</div>
