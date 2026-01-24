<div>
    @if($submitted)
        {{-- Success Message --}}
        <div
            class="p-8 rounded-lg text-center"
            style="background-color: {{ $theme['primary_color'] ?? '#3b82f6' }}15;"
        >
            <div class="mb-4">
                <svg class="w-16 h-16 mx-auto" style="color: {{ $theme['primary_color'] ?? '#3b82f6' }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3
                class="text-xl font-bold mb-2"
                style="color: {{ $theme['heading_color'] ?? '#111827' }};"
            >
                {{ __('Bericht verzonden!') }}
            </h3>
            <p style="color: {{ $theme['text_color'] ?? '#1f2937' }};">
                {{ __('Bedankt voor uw bericht. We nemen zo snel mogelijk contact met u op.') }}
            </p>
            <button
                type="button"
                wire:click="$set('submitted', false)"
                class="mt-4 px-6 py-2 rounded-lg font-medium transition-all duration-300 hover:opacity-80"
                style="
                    background-color: {{ $theme['primary_color'] ?? '#3b82f6' }};
                    color: #ffffff;
                "
            >
                {{ __('Nieuw bericht versturen') }}
            </button>
        </div>
    @else
        {{-- Contact Form --}}
        <form wire:submit="submit" class="space-y-4">
            {{-- Honeypot field (hidden from users, visible to bots) --}}
            <div class="hidden" aria-hidden="true">
                <input
                    type="text"
                    name="website"
                    wire:model="website"
                    tabindex="-1"
                    autocomplete="off"
                >
            </div>

            {{-- Name --}}
            <div>
                <label
                    for="contact-name"
                    class="block text-sm font-medium mb-1"
                    style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                >
                    {{ __('Naam') }} <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="contact-name"
                    wire:model="name"
                    class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 transition-colors"
                    style="
                        border-color: {{ $theme['secondary_color'] ?? '#e5e7eb' }};
                        background-color: {{ $theme['background_color'] ?? '#ffffff' }};
                        color: {{ $theme['text_color'] ?? '#1f2937' }};
                    "
                    placeholder="{{ __('Uw naam') }}"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label
                    for="contact-email"
                    class="block text-sm font-medium mb-1"
                    style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                >
                    {{ __('E-mail') }} <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    id="contact-email"
                    wire:model="email"
                    class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 transition-colors"
                    style="
                        border-color: {{ $theme['secondary_color'] ?? '#e5e7eb' }};
                        background-color: {{ $theme['background_color'] ?? '#ffffff' }};
                        color: {{ $theme['text_color'] ?? '#1f2937' }};
                    "
                    placeholder="{{ __('uw@email.nl') }}"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone --}}
            <div>
                <label
                    for="contact-phone"
                    class="block text-sm font-medium mb-1"
                    style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                >
                    {{ __('Telefoon') }}
                </label>
                <input
                    type="tel"
                    id="contact-phone"
                    wire:model="phone"
                    class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 transition-colors"
                    style="
                        border-color: {{ $theme['secondary_color'] ?? '#e5e7eb' }};
                        background-color: {{ $theme['background_color'] ?? '#ffffff' }};
                        color: {{ $theme['text_color'] ?? '#1f2937' }};
                    "
                    placeholder="{{ __('Uw telefoonnummer') }}"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message --}}
            <div>
                <label
                    for="contact-message"
                    class="block text-sm font-medium mb-1"
                    style="color: {{ $theme['heading_color'] ?? '#111827' }};"
                >
                    {{ __('Bericht') }} <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="contact-message"
                    wire:model="message"
                    rows="4"
                    class="w-full px-4 py-3 rounded-lg border focus:outline-none focus:ring-2 transition-colors"
                    style="
                        border-color: {{ $theme['secondary_color'] ?? '#e5e7eb' }};
                        background-color: {{ $theme['background_color'] ?? '#ffffff' }};
                        color: {{ $theme['text_color'] ?? '#1f2937' }};
                    "
                    placeholder="{{ __('Uw bericht...') }}"
                ></textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="w-full py-3 px-6 rounded-lg font-semibold transition-all duration-300 hover:opacity-90 flex items-center justify-center gap-2"
                style="
                    background-color: {{ $theme['primary_color'] ?? '#3b82f6' }};
                    color: #ffffff;
                "
                wire:loading.attr="disabled"
                wire:loading.class="opacity-75 cursor-not-allowed"
            >
                <span wire:loading.remove>{{ __('Verstuur bericht') }}</span>
                <span wire:loading class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ __('Verzenden...') }}
                </span>
            </button>
        </form>
    @endif
</div>
