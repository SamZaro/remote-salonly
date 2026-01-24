<div class="min-h-screen bg-gray-50 py-12">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">{{ __('Maak een reservering') }}</h1>
            <p class="mt-2 text-gray-600">{{ __('Kies een datum en tijd die u het beste uitkomt') }}</p>
        </div>

        {{-- Progress indicator --}}
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <div class="flex items-center">
                    {{-- Step 1 --}}
                    <div class="flex items-center">
                        <div @class([
                            'flex h-10 w-10 items-center justify-center rounded-full text-sm font-medium',
                            'bg-primary-600 text-white' => $step >= 1,
                            'bg-gray-200 text-gray-600' => $step < 1,
                        ])>
                            @if($step > 1)
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            @else
                                1
                            @endif
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-900">{{ __('Datum & Tijd') }}</span>
                    </div>

                    {{-- Connector --}}
                    <div @class([
                        'mx-4 h-0.5 w-16',
                        'bg-primary-600' => $step > 1,
                        'bg-gray-200' => $step <= 1,
                    ])></div>

                    {{-- Step 2 --}}
                    <div class="flex items-center">
                        <div @class([
                            'flex h-10 w-10 items-center justify-center rounded-full text-sm font-medium',
                            'bg-primary-600 text-white' => $step >= 2,
                            'bg-gray-200 text-gray-600' => $step < 2,
                        ])>
                            2
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-900">{{ __('Uw gegevens') }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step content --}}
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-900/5 sm:p-8">
            @if($step === 1)
                {{-- Step 1: Date & Time selection --}}
                <div class="grid gap-8 lg:grid-cols-2">
                    <div>
                        <h2 class="mb-4 text-lg font-semibold text-gray-900">{{ __('Kies een datum') }}</h2>
                        <livewire:booking.calendar :selected-date="$selectedDate" />
                    </div>
                    <div>
                        <h2 class="mb-4 text-lg font-semibold text-gray-900">{{ __('Kies een tijd') }}</h2>
                        <livewire:booking.time-slots :selected-date="$selectedDate" />
                    </div>
                </div>

                @error('selectedTime')
                    <div class="mt-4 rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <p class="ml-3 text-sm text-red-700">{{ $message }}</p>
                        </div>
                    </div>
                @enderror

            @else
                {{-- Step 2: Customer details --}}
                <div>
                    <div class="mb-6">
                        <button
                            type="button"
                            wire:click="previousStep"
                            class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                        >
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ __('Terug naar datum & tijd') }}
                        </button>
                    </div>

                    {{-- Selected date/time summary --}}
                    <div class="mb-6 rounded-lg bg-primary-50 p-4">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-2 font-medium text-primary-900">
                                {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l j F Y') }}
                                {{ __('om') }}
                                {{ $selectedTime }}
                            </span>
                        </div>
                    </div>

                    <h2 class="mb-4 text-lg font-semibold text-gray-900">{{ __('Vul uw gegevens in') }}</h2>

                    <form wire:submit="submit" class="space-y-6">
                        {{-- Honeypot field - hidden from users, catches bots --}}
                        <div class="absolute -left-[9999px]" aria-hidden="true">
                            <label for="website">Website</label>
                            <input
                                type="text"
                                id="website"
                                name="website"
                                wire:model="website"
                                tabindex="-1"
                                autocomplete="off"
                            />
                        </div>

                        <div>
                            <label for="customerName" class="block text-sm font-medium text-gray-700">
                                {{ __('Naam') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="customerName"
                                wire:model.blur="customerName"
                                class="mt-1 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                placeholder="{{ __('Uw volledige naam') }}"
                            />
                            @error('customerName')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customerEmail" class="block text-sm font-medium text-gray-700">
                                {{ __('E-mailadres') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                id="customerEmail"
                                wire:model.blur="customerEmail"
                                class="mt-1 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                placeholder="{{ __('uw@email.nl') }}"
                            />
                            @error('customerEmail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customerPhone" class="block text-sm font-medium text-gray-700">
                                {{ __('Telefoonnummer') }} <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="tel"
                                id="customerPhone"
                                wire:model.blur="customerPhone"
                                class="mt-1 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                placeholder="{{ __('0612345678') }}"
                            />
                            @error('customerPhone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                {{ __('Opmerkingen') }}
                            </label>
                            <textarea
                                id="notes"
                                wire:model.blur="notes"
                                rows="4"
                                class="mt-1 block w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                placeholder="{{ __('Heeft u nog speciale wensen of opmerkingen?') }}"
                            ></textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <button
                                type="button"
                                wire:click="previousStep"
                                class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                            >
                                {{ __('Terug') }}
                            </button>
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-75 cursor-not-allowed"
                                class="inline-flex items-center rounded-md bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                            >
                                <span wire:loading.remove wire:target="submit">{{ __('Reservering bevestigen') }}</span>
                                <span wire:loading wire:target="submit" class="inline-flex items-center">
                                    <svg class="mr-2 h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('Bezig...') }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
