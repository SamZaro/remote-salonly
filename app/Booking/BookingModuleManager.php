<?php

namespace App\Booking;

use App\Settings\BookingSettings;

class BookingModuleManager
{
    /**
     * Check if the booking module is enabled.
     *
     * The module is enabled when both:
     * 1. The config setting is enabled (BOOKING_MODULE_ENABLED env)
     * 2. The admin has activated bookings in settings
     */
    public static function isEnabled(): bool
    {
        if (! config('booking-module.enabled', false)) {
            return false;
        }

        try {
            return app(BookingSettings::class)->is_active;
        } catch (\Exception) {
            return true;
        }
    }

    /**
     * Get the route prefix for booking routes.
     */
    public static function getRoutePrefix(): string
    {
        return config('booking-module.route_prefix', 'booking');
    }

    /**
     * Get the booking URL.
     */
    public static function getBookingUrl(): string
    {
        return url(self::getRoutePrefix());
    }

    /**
     * Get style configuration.
     */
    public static function getStyles(): array
    {
        return config('booking-module.styles', []);
    }

    /**
     * Get a specific style value.
     */
    public static function getStyle(string $key, ?string $default = null): ?string
    {
        return config("booking-module.styles.{$key}", $default);
    }
}
