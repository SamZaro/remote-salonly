<?php

namespace App\Livewire\Booking;

use App\Services\BookingAvailabilityService;
use App\Settings\BookingSettings;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Component;

class BookingCalendar extends Component
{
    public ?string $selectedDate = null;

    #[Locked]
    public string $currentMonth;

    #[Locked]
    public int $maxAdvanceDays;

    public function mount(?string $selectedDate = null): void
    {
        $this->selectedDate = $selectedDate ?? now()->format('Y-m-d');
        $this->currentMonth = Carbon::parse($this->selectedDate)->startOfMonth()->format('Y-m-d');
        $this->maxAdvanceDays = app(BookingSettings::class)->max_advance_booking_days;
    }

    public function previousMonth(): void
    {
        $newMonth = Carbon::parse($this->currentMonth)->subMonth();
        $today = now()->startOfMonth();

        if ($newMonth->gte($today)) {
            $this->currentMonth = $newMonth->format('Y-m-d');
        }
    }

    public function nextMonth(): void
    {
        $newMonth = Carbon::parse($this->currentMonth)->addMonth();
        $maxDate = now()->addDays($this->maxAdvanceDays)->endOfMonth();

        if ($newMonth->lte($maxDate)) {
            $this->currentMonth = $newMonth->format('Y-m-d');
        }
    }

    public function selectDate(string $date): void
    {
        $this->selectedDate = $date;
        $this->dispatch('date-selected', date: $date);
    }

    public function getCalendarDaysProperty(): array
    {
        $month = Carbon::parse($this->currentMonth);
        $startOfMonth = $month->copy()->startOfMonth();
        $endOfMonth = $month->copy()->endOfMonth();

        $today = now()->startOfDay();
        $maxDate = now()->addDays($this->maxAdvanceDays)->endOfDay();

        $availabilityService = app(BookingAvailabilityService::class);

        // Get start of calendar grid (Monday before or on start of month)
        $calendarStart = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);
        $calendarEnd = $endOfMonth->copy()->endOfWeek(Carbon::SUNDAY);

        $days = [];
        $current = $calendarStart->copy();

        while ($current->lte($calendarEnd)) {
            $isCurrentMonth = $current->month === $month->month;
            $isPast = $current->lt($today);
            $isFuture = $current->gt($maxDate);
            $isToday = $current->isSameDay($today);
            $isSelected = $this->selectedDate && $current->format('Y-m-d') === $this->selectedDate;

            $hasAvailability = false;
            if ($isCurrentMonth && ! $isPast && ! $isFuture) {
                $slots = $availabilityService->getAvailableSlotsForDate($current);
                $hasAvailability = count($slots) > 0;
            }

            $days[] = [
                'date' => $current->format('Y-m-d'),
                'day' => $current->day,
                'isCurrentMonth' => $isCurrentMonth,
                'isPast' => $isPast,
                'isFuture' => $isFuture,
                'isToday' => $isToday,
                'isSelected' => $isSelected,
                'hasAvailability' => $hasAvailability,
                'isDisabled' => ! $isCurrentMonth || $isPast || $isFuture || ! $hasAvailability,
            ];

            $current->addDay();
        }

        return $days;
    }

    public function getMonthNameProperty(): string
    {
        return Carbon::parse($this->currentMonth)->translatedFormat('F Y');
    }

    public function getCanGoPreviousProperty(): bool
    {
        $previousMonth = Carbon::parse($this->currentMonth)->subMonth();

        return $previousMonth->gte(now()->startOfMonth());
    }

    public function getCanGoNextProperty(): bool
    {
        $nextMonth = Carbon::parse($this->currentMonth)->addMonth();

        return $nextMonth->lte(now()->addDays($this->maxAdvanceDays)->endOfMonth());
    }

    public function render()
    {
        return view('livewire.booking.calendar');
    }
}
