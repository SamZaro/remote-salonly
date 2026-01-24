<div>
    @if(!$selectedDate)
        <div class="rounded-lg border-2 border-dashed border-gray-200 p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-2 text-sm text-gray-500">{{ __('Selecteer eerst een datum') }}</p>
        </div>
    @elseif(empty($this->groupedSlots))
        <div class="rounded-lg border-2 border-dashed border-gray-200 p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="mt-2 text-sm text-gray-500">{{ __('Geen beschikbare tijdslots op deze datum') }}</p>
        </div>
    @else
        <div class="space-y-6" wire:loading.class="opacity-50">
            {{-- Selected date display --}}
            <div class="text-sm text-gray-600">
                <span class="font-medium text-gray-900 capitalize">{{ $this->formattedDate }}</span>
            </div>

            @foreach($this->groupedSlots as $period => $slots)
                <div>
                    <h4 class="mb-3 flex items-center text-sm font-medium text-gray-700">
                        @if($period === 'morning')
                            <svg class="mr-2 h-4 w-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Ochtend') }}
                        @elseif($period === 'afternoon')
                            <svg class="mr-2 h-4 w-4 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Middag') }}
                        @else
                            <svg class="mr-2 h-4 w-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                            {{ __('Avond') }}
                        @endif
                    </h4>
                    <div class="grid grid-cols-3 gap-2 sm:grid-cols-4">
                        @foreach($slots as $slot)
                            <button
                                type="button"
                                wire:key="slot-{{ $slot }}"
                                wire:click="selectTime('{{ $slot }}')"
                                @class([
                                    'rounded-md border px-3 py-2 text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1',
                                    'border-primary-600 bg-primary-600 text-white' => $selectedTime === $slot,
                                    'border-gray-200 bg-white text-gray-700 hover:border-primary-300 hover:bg-primary-50' => $selectedTime !== $slot,
                                ])
                            >
                                {{ $slot }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
