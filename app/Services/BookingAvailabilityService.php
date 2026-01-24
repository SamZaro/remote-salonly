<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Models\AvailabilityException;
use App\Models\Booking;
use App\Models\BusinessHours;
use App\Settings\BookingSettings;
use Carbon\Carbon;

class BookingAvailabilityService
{
    public function __construct(
        protected BookingSettings $settings
    ) {}

    /**
     * Get available time slots for a specific date.
     *
     * @return array<string>
     */
    public function getAvailableSlotsForDate(Carbon $date): array
    {
        // Check if date is in the allowed booking range
        if (! $this->isDateBookable($date)) {
            return [];
        }

        // Get business hours for this day of week
        $businessHours = $this->getBusinessHoursForDate($date);
        if (! $businessHours) {
            return [];
        }

        // Generate all possible slots
        $slots = $this->generateTimeSlots(
            $businessHours['open_time'],
            $businessHours['close_time'],
            $businessHours['slot_duration']
        );

        // Filter out already booked slots
        $bookedSlots = $this->getBookedSlotsForDate($date);

        // Filter out slots that are in the past (for today)
        $availableSlots = [];
        foreach ($slots as $slot) {
            if (in_array($slot, $bookedSlots)) {
                continue;
            }

            // Check lead time requirement
            if ($date->isToday()) {
                $slotTime = Carbon::parse($date->format('Y-m-d').' '.$slot);
                $minBookingTime = now()->addHours($this->settings->booking_lead_time);
                if ($slotTime->lt($minBookingTime)) {
                    continue;
                }
            }

            $availableSlots[] = $slot;
        }

        return $availableSlots;
    }

    /**
     * Check if a specific time slot is available.
     */
    public function isSlotAvailable(Carbon $date, string $time): bool
    {
        $availableSlots = $this->getAvailableSlotsForDate($date);

        return in_array($time, $availableSlots);
    }

    /**
     * Check if a date is within the bookable range.
     */
    protected function isDateBookable(Carbon $date): bool
    {
        $today = now()->startOfDay();
        $maxDate = now()->addDays($this->settings->max_advance_booking_days)->endOfDay();

        return $date->gte($today) && $date->lte($maxDate);
    }

    /**
     * Get business hours for a specific date, accounting for exceptions.
     *
     * @return array{open_time: string, close_time: string, slot_duration: int}|null
     */
    protected function getBusinessHoursForDate(Carbon $date): ?array
    {
        // Check for exceptions first
        $exception = AvailabilityException::where('date', $date->format('Y-m-d'))->first();

        if ($exception) {
            if (! $exception->is_available) {
                return null; // Closed on this date
            }

            // Use custom hours if available
            if ($exception->custom_open_time && $exception->custom_close_time) {
                return [
                    'open_time' => $exception->custom_open_time,
                    'close_time' => $exception->custom_close_time,
                    'slot_duration' => $this->settings->default_slot_duration,
                ];
            }
        }

        // Get regular business hours
        $dayOfWeek = $date->dayOfWeek; // 0 = Sunday, 6 = Saturday
        $businessHours = BusinessHours::where('day_of_week', $dayOfWeek)->first();

        if (! $businessHours || ! $businessHours->is_open) {
            return null;
        }

        return [
            'open_time' => $businessHours->open_time,
            'close_time' => $businessHours->close_time,
            'slot_duration' => $businessHours->slot_duration,
        ];
    }

    /**
     * Generate time slots between open and close time.
     *
     * @return array<string>
     */
    protected function generateTimeSlots(string $openTime, string $closeTime, int $slotDuration): array
    {
        $slots = [];
        $current = Carbon::parse($openTime);
        $end = Carbon::parse($closeTime);

        while ($current->lt($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($slotDuration);
        }

        return $slots;
    }

    /**
     * Get already booked time slots for a date.
     *
     * @return array<string>
     */
    protected function getBookedSlotsForDate(Carbon $date): array
    {
        return Booking::where('booking_date', $date->format('Y-m-d'))
            ->whereIn('status', [BookingStatus::Pending, BookingStatus::Confirmed])
            ->pluck('booking_time')
            ->map(fn ($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();
    }
}
