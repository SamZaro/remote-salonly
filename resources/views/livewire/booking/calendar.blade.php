<div class="select-none">
    {{-- Month navigation --}}
    <div class="mb-4 flex items-center justify-between">
        <button
            type="button"
            wire:click="previousMonth"
            @disabled(!$this->canGoPrevious)
            @class([
                'rounded-md p-2 transition-colors',
                'text-gray-400 hover:bg-gray-100 hover:text-gray-600' => $this->canGoPrevious,
                'cursor-not-allowed text-gray-200' => !$this->canGoPrevious,
            ])
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <h3 class="text-base font-semibold text-gray-900 capitalize">
            {{ $this->monthName }}
        </h3>

        <button
            type="button"
            wire:click="nextMonth"
            @disabled(!$this->canGoNext)
            @class([
                'rounded-md p-2 transition-colors',
                'text-gray-400 hover:bg-gray-100 hover:text-gray-600' => $this->canGoNext,
                'cursor-not-allowed text-gray-200' => !$this->canGoNext,
            ])
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>

    {{-- Weekday headers --}}
    <div class="mb-2 grid grid-cols-7 gap-1 text-center text-xs font-medium text-gray-500">
        <div>{{ __('Ma') }}</div>
        <div>{{ __('Di') }}</div>
        <div>{{ __('Wo') }}</div>
        <div>{{ __('Do') }}</div>
        <div>{{ __('Vr') }}</div>
        <div>{{ __('Za') }}</div>
        <div>{{ __('Zo') }}</div>
    </div>

    {{-- Calendar grid --}}
    <div class="grid grid-cols-7 gap-1" wire:loading.class="opacity-50">
        @foreach($this->calendarDays as $day)
            <button
                type="button"
                wire:key="day-{{ $day['date'] }}"
                @if(!$day['isDisabled'])
                    wire:click="selectDate('{{ $day['date'] }}')"
                @endif
                @disabled($day['isDisabled'])
                @class([
                    'relative flex h-10 w-full items-center justify-center rounded-md text-sm transition-colors',
                    'cursor-not-allowed' => $day['isDisabled'],
                    'cursor-pointer' => !$day['isDisabled'],
                    // Not current month
                    'text-gray-300' => !$day['isCurrentMonth'],
                    // Disabled (past, future, no availability)
                    'text-gray-300' => $day['isCurrentMonth'] && $day['isDisabled'] && !$day['isSelected'],
                    // Available
                    'text-gray-900 hover:bg-gray-100' => $day['isCurrentMonth'] && !$day['isDisabled'] && !$day['isSelected'],
                    // Today indicator
                    'font-bold' => $day['isToday'],
                    // Selected
                    'bg-primary-600 text-white hover:bg-primary-700' => $day['isSelected'],
                ])
            >
                <span>{{ $day['day'] }}</span>
                @if($day['isToday'] && !$day['isSelected'])
                    <span class="absolute bottom-1 left-1/2 h-1 w-1 -translate-x-1/2 rounded-full bg-primary-600"></span>
                @endif
            </button>
        @endforeach
    </div>

    {{-- Legend --}}
    <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-gray-500">
        <div class="flex items-center gap-1">
            <span class="h-3 w-3 rounded-full bg-primary-600"></span>
            <span>{{ __('Geselecteerd') }}</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="relative flex h-3 w-3 items-center justify-center rounded-full bg-gray-100">
                <span class="h-1 w-1 rounded-full bg-primary-600"></span>
            </span>
            <span>{{ __('Vandaag') }}</span>
        </div>
        <div class="flex items-center gap-1">
            <span class="h-3 w-3 rounded-full bg-gray-200"></span>
            <span>{{ __('Niet beschikbaar') }}</span>
        </div>
    </div>
</div>
