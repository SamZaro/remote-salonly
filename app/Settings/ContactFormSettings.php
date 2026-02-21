<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ContactFormSettings extends Settings
{
    public bool $is_active;

    public static function group(): string
    {
        return 'contact_form';
    }
}
