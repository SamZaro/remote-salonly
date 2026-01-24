<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('booking.is_active', true);
    }

    public function down(): void
    {
        $this->migrator->delete('booking.is_active');
    }
};
