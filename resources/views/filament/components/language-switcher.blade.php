<div x-data="{ open: false }" class="relative">
    <button
        x-on:click="open = !open"
        type="button"
        class="flex items-center gap-x-1 rounded-lg px-2 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-white/5"
    >
        <span class="uppercase">{{ app()->getLocale() }}</span>
        <x-filament::icon
            icon="heroicon-m-chevron-down"
            class="h-4 w-4 text-gray-400"
        />
    </button>

    <div
        x-show="open"
        x-on:click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 z-10 mt-1 w-36 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
        style="display: none;"
    >
        <div class="p-1">
            @foreach(['en' => 'English', 'nl' => 'Nederlands', 'de' => 'Deutsch', 'fr' => 'Français', 'es' => 'Español', 'it' => 'Italiano'] as $locale => $label)
                <a
                    href="{{ route('locale.switch', $locale) }}"
                    @class([
                        'flex items-center gap-2 rounded-md px-2 py-1.5 text-sm transition',
                        'bg-primary-50 text-primary-600 dark:bg-primary-400/10 dark:text-primary-400' => app()->getLocale() === $locale,
                        'text-gray-700 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-white/5' => app()->getLocale() !== $locale,
                    ])
                >
                    <span class="w-5 text-center font-mono text-xs uppercase">{{ $locale }}</span>
                    <span>{{ $label }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>
