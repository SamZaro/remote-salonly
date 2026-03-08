<x-button-link.default
    {{ $attributes }}
    {{ $attributes->merge(['class' => 'text-orange-50 bg-orange-500 hover:bg-orange-600 focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800']) }}
>
    {{ $slot }}
</x-button-link.default>
