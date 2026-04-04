<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <x-filament::icon
                    icon="heroicon-o-exclamation-triangle"
                    class="h-6 w-6 text-warning-500"
                />
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ __('Email provider not configured') }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('You have not yet configured your own email provider. As a result, emails (such as password resets) are sent via the default system configuration.') }}
                </p>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('For a professional appearance with your own sender address, configure your own SMTP server or email provider.') }}
                </p>
                <div class="mt-4">
                    <x-filament::button
                        :href="$this->getEmailProvidersUrl()"
                        tag="a"
                        color="warning"
                        icon="heroicon-m-cog-6-tooth"
                    >
                        {{ __('Configure Email Provider') }}
                    </x-filament::button>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
