<?php

namespace Tests\Feature\Filament\Dashboard\Pages;

use App\Filament\Dashboard\Pages\ManageSiteSettings;
use App\Settings\SiteSettings;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\Feature\FeatureTest;

class ManageSiteSettingsTest extends FeatureTest
{
    protected function setUp(): void
    {
        parent::setUp();

        // Initialize settings for testing if they don't exist
        $existingSettings = DB::table('settings')
            ->where('group', 'site')
            ->whereIn('name', ['site_name', 'logo'])
            ->count();

        if ($existingSettings === 0) {
            DB::table('settings')->insert([
                [
                    'group' => 'site',
                    'name' => 'site_name',
                    'locked' => false,
                    'payload' => json_encode('My Site'),
                ],
                [
                    'group' => 'site',
                    'name' => 'logo',
                    'locked' => false,
                    'payload' => json_encode(null),
                ],
            ]);
        }
    }

    public function test_can_render_page(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $response = $this->get(ManageSiteSettings::getUrl([], true, 'dashboard'));

        $response->assertSuccessful();
    }

    public function test_can_update_site_settings(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        Livewire::test(ManageSiteSettings::class)
            ->fillForm([
                'site_name' => 'Updated Site Name',
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $settings = app(SiteSettings::class);
        $this->assertEquals('Updated Site Name', $settings->site_name);
    }

    public function test_site_name_is_required(): void
    {
        $user = $this->createUser();
        $this->actingAs($user);

        Livewire::test(ManageSiteSettings::class)
            ->fillForm([
                'site_name' => '',
            ])
            ->call('save')
            ->assertHasFormErrors(['site_name' => 'required']);
    }
}
