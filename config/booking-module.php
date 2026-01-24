<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Booking Module Enabled
    |--------------------------------------------------------------------------
    |
    | This option controls whether the booking module is enabled for this site.
    | When disabled, booking routes and components will not be available.
    |
    */
    'enabled' => env('BOOKING_MODULE_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | The URL prefix for all booking-related routes.
    |
    */
    'route_prefix' => env('BOOKING_ROUTE_PREFIX', 'booking'),

    /*
    |--------------------------------------------------------------------------
    | Styles
    |--------------------------------------------------------------------------
    |
    | Default styling configuration for the booking module.
    | These can be overridden per template if needed.
    |
    */
    'styles' => [
        'primary_color' => 'var(--color-primary, #3b82f6)',
        'primary_hover' => 'var(--color-primary-600, #2563eb)',
        'accent_color' => 'var(--color-accent, #10b981)',
        'text_color' => 'var(--color-text, #1f2937)',
        'background_color' => 'var(--color-background, #ffffff)',
        'border_color' => 'var(--color-border, #e5e7eb)',
    ],
];
