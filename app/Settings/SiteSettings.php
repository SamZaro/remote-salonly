<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    public string $site_name;

    public ?string $logo;

    public ?string $template_slug = null;

    public ?array $template_config = null;

    public static function group(): string
    {
        return 'site';
    }
}
