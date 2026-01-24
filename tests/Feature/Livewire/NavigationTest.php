<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Navigation;
use App\Settings\SiteSettings;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\Feature\FeatureTest;

class NavigationTest extends FeatureTest
{
    protected function setUp(): void
    {
        parent::setUp();

        // Set site settings for testing
        DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'site_name')
            ->update(['payload' => json_encode('My Site')]);

        DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'logo')
            ->update(['payload' => json_encode(null)]);

        // Clear cached settings
        app()->forgetInstance(SiteSettings::class);
    }

    public function test_displays_default_logo_when_no_custom_logo_set(): void
    {
        Livewire::test(Navigation::class)
            ->assertSee('images/logos/oasis-logo.png');
    }

    public function test_displays_site_name_in_alt_text(): void
    {
        Livewire::test(Navigation::class)
            ->assertSee('My Site');
    }

    public function test_displays_custom_logo_when_set(): void
    {
        // Update settings to have a custom logo
        DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'logo')
            ->update([
                'payload' => json_encode('logos/custom-logo.png'),
            ]);

        // Clear cached settings
        app()->forgetInstance(SiteSettings::class);

        Livewire::test(Navigation::class)
            ->assertSee('storage/logos/custom-logo.png');
    }

    public function test_displays_fallback_alt_text_when_site_name_not_set(): void
    {
        // Update settings to have empty site_name
        DB::table('settings')
            ->where('group', 'site')
            ->where('name', 'site_name')
            ->update([
                'payload' => json_encode(''),
            ]);

        // Clear cached settings
        app()->forgetInstance(SiteSettings::class);

        Livewire::test(Navigation::class)
            ->assertSee('Kapsalon Oasis Logo');
    }
}
