<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->update('booking.is_active', fn () => false);
    }

    public function down(): void
    {
        $this->migrator->update('booking.is_active', fn () => true);
    }
};
