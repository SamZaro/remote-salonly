<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('booking.default_slot_duration', 30);
        $this->migrator->add('booking.booking_lead_time', 2); // hours minimum in advance
        $this->migrator->add('booking.max_advance_booking_days', 30);
    }

    public function down(): void
    {
        $this->migrator->delete('booking.default_slot_duration');
        $this->migrator->delete('booking.booking_lead_time');
        $this->migrator->delete('booking.max_advance_booking_days');
    }
};
