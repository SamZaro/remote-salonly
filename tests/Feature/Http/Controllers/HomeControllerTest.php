<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Template;
use App\Models\TemplateSection;
use App\Settings\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test template with sections
        $this->template = Template::factory()->create([
            'slug' => 'barbero',
            'is_active' => true,
        ]);

        TemplateSection::factory()->create([
            'template_id' => $this->template->id,
            'section_type' => 'hero',
            'order' => 1,
            'is_active' => true,
            'content' => [
                'title' => 'Welcome',
                'subtitle' => 'Test Site',
            ],
        ]);

        // Set template in SiteSettings
        $settings = app(SiteSettings::class);
        $settings->template_slug = 'barbero';
        $settings->save();
    }

    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('home')
            ->assertViewHas('template')
            ->assertViewHas('sections')
            ->assertViewHas('theme')
            ->assertViewHas('navigation');
    }

    public function test_homepage_renders_template_sections(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Welcome')
            ->assertSee('Test Site');
    }

    public function test_homepage_shows_fallback_when_no_template(): void
    {
        $settings = app(SiteSettings::class);
        $settings->template_slug = null;
        $settings->save();

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Welkom')
            ->assertSee('Je website wordt momenteel ingericht');
    }

    public function test_homepage_only_shows_active_sections(): void
    {
        // Create inactive section
        TemplateSection::factory()->create([
            'template_id' => $this->template->id,
            'section_type' => 'about',
            'order' => 2,
            'is_active' => false,
            'content' => ['title' => 'Inactive Section'],
        ]);

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertDontSee('Inactive Section');
    }

    public function test_homepage_renders_sections_in_order(): void
    {
        TemplateSection::factory()->create([
            'template_id' => $this->template->id,
            'section_type' => 'about',
            'order' => 2,
            'is_active' => true,
            'content' => ['title' => 'Second Section'],
        ]);

        TemplateSection::factory()->create([
            'template_id' => $this->template->id,
            'section_type' => 'contact',
            'order' => 3,
            'is_active' => true,
            'content' => ['title' => 'Third Section'],
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        // Verify order by checking HTML structure
        $content = $response->getContent();
        $posHero = strpos($content, 'Welcome');
        $posAbout = strpos($content, 'Second Section');
        $posContact = strpos($content, 'Third Section');

        $this->assertNotFalse($posHero);
        $this->assertNotFalse($posAbout);
        $this->assertNotFalse($posContact);
        $this->assertLessThan($posAbout, $posHero);
        $this->assertLessThan($posContact, $posAbout);
    }
}
