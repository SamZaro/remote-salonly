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
                    {{ __('E-mailprovider niet geconfigureerd') }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Je hebt nog geen eigen e-mailprovider ingesteld. Hierdoor worden e-mails (zoals wachtwoord reset) verstuurd via de standaard systeemconfiguratie.') }}
                </p>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Voor een professionele uitstraling met je eigen afzenderadres, configureer je eigen SMTP-server of e-mailprovider.') }}
                </p>
                <div class="mt-4">
                    <x-filament::button
                        :href="$this->getEmailProvidersUrl()"
                        tag="a"
                        color="warning"
                        icon="heroicon-m-cog-6-tooth"
                    >
                        {{ __('E-mailprovider instellen') }}
                    </x-filament::button>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
