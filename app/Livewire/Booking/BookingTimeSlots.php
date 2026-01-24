<?php

namespace App\Livewire\Booking;

use App\Services\BookingAvailabilityService;
use Carbon\Carbon;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class BookingTimeSlots extends Component
{
    #[Reactive]
    public ?string $selectedDate = null;

    public ?string $selectedTime = null;

    public function selectTime(string $time): void
    {
        $this->selectedTime = $time;
        $this->dispatch('time-selected', time: $time);
    }

    public function getGroupedSlotsProperty(): array
    {
        if (! $this->selectedDate) {
            return [];
        }

        $service = app(BookingAvailabilityService::class);
        $date = Carbon::parse($this->selectedDate);
        $slots = $service->getAvailableSlotsForDate($date);

        if (empty($slots)) {
            return [];
        }

        $grouped = [
            'morning' => [],
            'afternoon' => [],
            'evening' => [],
        ];

        foreach ($slots as $slot) {
            $hour = (int) substr($slot, 0, 2);

            if ($hour < 12) {
                $grouped['morning'][] = $slot;
            } elseif ($hour < 17) {
                $grouped['afternoon'][] = $slot;
            } else {
                $grouped['evening'][] = $slot;
            }
        }

        return array_filter($grouped, fn ($slots) => ! empty($slots));
    }

    public function getFormattedDateProperty(): string
    {
        if (! $this->selectedDate) {
            return '';
        }

        return Carbon::parse($this->selectedDate)->translatedFormat('l j F Y');
    }

    public function render()
    {
        return view('livewire.booking.time-slots');
    }
}
