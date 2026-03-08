<x-button-link.default
    {{ $attributes }}
    {{ $attributes->merge(['class' => 'border border-orange-500 text-orange-500 bg-transparent hover:bg-orange-200 focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800']) }}
>
    {{ $slot }}
</x-button-link.default>
