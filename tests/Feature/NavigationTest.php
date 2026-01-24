<?php

namespace Tests\Feature;

use App\Livewire\Navigation;
use App\Models\Template;
use App\Settings\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Set up a test template
        $this->template = Template::factory()->create([
            'slug' => 'test-template',
            'is_active' => true,
            'navigation_items' => [
                ['title' => 'Home', 'slug' => 'hero', 'is_active' => true],
                ['title' => 'About', 'slug' => 'about', 'is_active' => true],
                ['title' => 'Contact', 'slug' => 'contact', 'is_active' => true],
            ],
        ]);

        // Set the template in SiteSettings
        $settings = app(SiteSettings::class);
        $settings->template_slug = 'test-template';
        $settings->save();
    }

    public function test_navigation_component_renders(): void
    {
        Livewire::test(Navigation::class)
            ->assertStatus(200)
            ->assertViewIs('livewire.navigation');
    }

    public function test_navigation_shows_template_navigation_items(): void
    {
        Livewire::test(Navigation::class)
            ->assertSee('Home')
            ->assertSee('About')
            ->assertSee('Contact')
            ->assertSee('href="#hero"', false)
            ->assertSee('href="#about"', false)
            ->assertSee('href="#contact"', false);
    }

    public function test_navigation_returns_empty_array_when_no_template(): void
    {
        $settings = app(SiteSettings::class);
        $settings->template_slug = null;
        $settings->save();

        $component = Livewire::test(Navigation::class);

        $this->assertEmpty($component->navItems);
    }

    public function test_navigation_filters_inactive_items(): void
    {
        $this->template->update([
            'navigation_items' => [
                ['title' => 'Active', 'slug' => 'active', 'is_active' => true],
                ['title' => 'Inactive', 'slug' => 'inactive', 'is_active' => false],
            ],
        ]);

        // Clear cache to get fresh navigation items
        app(\App\Services\TemplateService::class)->clearCache();

        Livewire::test(Navigation::class)
            ->assertSee('Active')
            ->assertDontSee('Inactive');
    }
}
