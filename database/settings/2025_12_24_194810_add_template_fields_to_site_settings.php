<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.template_slug', null);
        $this->migrator->add('site.template_config', null);
    }
};
