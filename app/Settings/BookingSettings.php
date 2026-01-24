<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class BookingSettings extends Settings
{
    public bool $is_active;

    public int $default_slot_duration;

    public int $booking_lead_time;

    public int $max_advance_booking_days;

    public static function group(): string
    {
        return 'booking';
    }
}
