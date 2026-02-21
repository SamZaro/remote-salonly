<?php

namespace App\ContactForm;

use App\Settings\ContactFormSettings;

class ContactFormModuleManager
{
    /**
     * Check if the contact form module is enabled.
     *
     * The module is enabled when both:
     * 1. The config setting is enabled (CONTACT_FORM_MODULE_ENABLED env)
     * 2. The admin has activated contact form in settings
     */
    public static function isEnabled(): bool
    {
        if (! config('contact-form-module.enabled', false)) {
            return false;
        }

        try {
            return app(ContactFormSettings::class)->is_active;
        } catch (\Exception) {
            return true;
        }
    }
}
