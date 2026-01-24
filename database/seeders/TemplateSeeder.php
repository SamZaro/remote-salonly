<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Template;
use App\Models\TemplateSection;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding templates...');
        $templates = $this->seedTemplates();

        $this->command->info('Seeding template sections...');
        $this->seedTemplateSections($templates);

        $this->command->info('Templates seeded successfully!');
    }

    private function seedTemplates(): array
    {
        $templates = [
            // Kappers templates
            [
                'category_slug' => 'kappers',
                'name' => 'Coupe',
                'slug' => 'coupe',
                'description' => 'Moderne en stijlvolle template voor kapperszaken.',
                'sort_order' => 1,
                'is_active' => true,
                'theme_config' => [
                    'primary_color' => '#1a1a2e',
                    'secondary_color' => '#16213e',
                    'accent_color' => '#e94560',
                    'background_color' => '#ffffff',
                    'text_color' => '#333333',
                    'heading_color' => '#1a1a2e',
                    'font_family' => 'Poppins, sans-serif',
                    'heading_font_family' => 'Playfair Display, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#1a1a2e',
                    'navbar_text_color' => '#ffffff',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => [
                    ['label' => 'Home', 'target' => '#hero', 'icon' => null, 'is_active' => true],
                    ['label' => 'Over Ons', 'target' => '#about', 'icon' => null, 'is_active' => true],
                    ['label' => 'Diensten', 'target' => '#services', 'icon' => null, 'is_active' => true],
                    ['label' => 'Reviews', 'target' => '#testimonials', 'icon' => null, 'is_active' => true],
                    ['label' => 'Contact', 'target' => '#contact', 'icon' => null, 'is_active' => true],
                ],
                'default_config' => [],
            ],
            [
                'category_slug' => 'kappers',
                'name' => 'Barbero',
                'slug' => 'barbero',
                'description' => 'Stoere en mannelijke template voor barbershops.',
                'sort_order' => 2,
                'is_active' => true,
                'theme_config' => [
                    'primary_color' => '#2c3e50',
                    'secondary_color' => '#34495e',
                    'accent_color' => '#c0392b',
                    'background_color' => '#ecf0f1',
                    'text_color' => '#2c3e50',
                    'heading_color' => '#1a252f',
                    'font_family' => 'Roboto, sans-serif',
                    'heading_font_family' => 'Oswald, sans-serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#2c3e50',
                    'navbar_text_color' => '#ecf0f1',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => [
                    ['label' => 'Home', 'target' => '#hero', 'icon' => null, 'is_active' => true],
                    ['label' => 'Over Ons', 'target' => '#about', 'icon' => null, 'is_active' => true],
                    ['label' => 'Diensten', 'target' => '#services', 'icon' => null, 'is_active' => true],
                    ['label' => 'Reviews', 'target' => '#testimonials', 'icon' => null, 'is_active' => true],
                    ['label' => 'Contact', 'target' => '#contact', 'icon' => null, 'is_active' => true],
                ],
                'default_config' => [],
            ],
            // Zakelijk templates
            [
                'category_slug' => 'zakelijk',
                'name' => 'Projecto',
                'slug' => 'projecto',
                'description' => 'Professionele template voor zakelijke dienstverleners.',
                'sort_order' => 1,
                'is_active' => true,
                'theme_config' => [
                    'primary_color' => '#0066cc',
                    'secondary_color' => '#004499',
                    'accent_color' => '#ff9900',
                    'background_color' => '#f8f9fa',
                    'text_color' => '#495057',
                    'heading_color' => '#212529',
                    'font_family' => 'Inter, sans-serif',
                    'heading_font_family' => 'Inter, sans-serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#ffffff',
                    'navbar_text_color' => '#212529',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => [
                    ['label' => 'Home', 'target' => '#hero', 'icon' => null, 'is_active' => true],
                    ['label' => 'Over Ons', 'target' => '#about', 'icon' => null, 'is_active' => true],
                    ['label' => 'Diensten', 'target' => '#services', 'icon' => null, 'is_active' => true],
                    ['label' => 'Reviews', 'target' => '#testimonials', 'icon' => null, 'is_active' => true],
                    ['label' => 'Contact', 'target' => '#contact', 'icon' => null, 'is_active' => true],
                ],
                'default_config' => [],
            ],
        ];

        $result = [];
        foreach ($templates as $data) {
            $categorySlug = $data['category_slug'];
            unset($data['category_slug']);

            $category = Category::where('slug', $categorySlug)->first();
            if (! $category) {
                $this->command->warn("  ⚠ Category '{$categorySlug}' not found, skipping template '{$data['name']}'");

                continue;
            }

            $data['category_id'] = $category->id;

            $result[$data['slug']] = Template::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            $this->command->info("  ✓ Template '{$data['name']}' created/updated");
        }

        return $result;
    }

    private function seedTemplateSections(array $templates): void
    {
        // Standard sections for all templates: hero, about, services, testimonials, contact
        $standardSections = [
            'coupe' => [
                [
                    'section_type' => 'hero',
                    'order' => 1,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Welkom bij onze salon',
                        'subtitle' => 'Waar stijl en vakmanschap samenkomen',
                        'cta_text' => 'Maak een afspraak',
                        'cta_url' => '#contact',
                    ],
                ],
                [
                    'section_type' => 'about',
                    'order' => 2,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Over Ons',
                        'subtitle' => 'Onze passie',
                        'description' => 'Wij zijn gepassioneerde kappers met jarenlange ervaring. Ons team staat klaar om jou de beste service te bieden.',
                    ],
                ],
                [
                    'section_type' => 'services',
                    'order' => 3,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Onze Diensten',
                        'subtitle' => 'Wat wij bieden',
                    ],
                ],
                [
                    'section_type' => 'testimonials',
                    'order' => 4,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Wat Klanten Zeggen',
                        'subtitle' => 'Reviews',
                    ],
                ],
                [
                    'section_type' => 'contact',
                    'order' => 5,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Contact',
                        'subtitle' => 'Neem contact op',
                    ],
                ],
            ],
            'barbero' => [
                [
                    'section_type' => 'hero',
                    'order' => 1,
                    'is_active' => true,
                    'content' => [
                        'title' => 'De Beste Barbershop',
                        'subtitle' => 'Traditioneel vakmanschap met een moderne twist',
                        'cta_text' => 'Reserveer Nu',
                        'cta_url' => '#contact',
                    ],
                ],
                [
                    'section_type' => 'about',
                    'order' => 2,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Wie Wij Zijn',
                        'subtitle' => 'Ons verhaal',
                        'description' => 'Een authentieke barbershop waar mannen zich thuis voelen. Wij combineren traditionele technieken met hedendaagse stijl.',
                    ],
                ],
                [
                    'section_type' => 'services',
                    'order' => 3,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Onze Behandelingen',
                        'subtitle' => 'Premium services',
                    ],
                ],
                [
                    'section_type' => 'testimonials',
                    'order' => 4,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Tevreden Klanten',
                        'subtitle' => 'Ervaringen',
                    ],
                ],
                [
                    'section_type' => 'contact',
                    'order' => 5,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Bezoek Ons',
                        'subtitle' => 'Locatie & Contact',
                    ],
                ],
            ],
            'projecto' => [
                [
                    'section_type' => 'hero',
                    'order' => 1,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Professionele Oplossingen',
                        'subtitle' => 'Wij helpen uw bedrijf groeien',
                        'cta_text' => 'Neem Contact Op',
                        'cta_url' => '#contact',
                    ],
                ],
                [
                    'section_type' => 'about',
                    'order' => 2,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Over Ons Bedrijf',
                        'subtitle' => 'Wie wij zijn',
                        'description' => 'Wij zijn een team van professionals die zich inzetten voor het succes van onze klanten. Met jarenlange ervaring leveren wij kwaliteit.',
                    ],
                ],
                [
                    'section_type' => 'services',
                    'order' => 3,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Onze Diensten',
                        'subtitle' => 'Wat wij bieden',
                    ],
                ],
                [
                    'section_type' => 'testimonials',
                    'order' => 4,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Klantervaringen',
                        'subtitle' => 'Wat anderen zeggen',
                    ],
                ],
                [
                    'section_type' => 'contact',
                    'order' => 5,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Contact',
                        'subtitle' => 'Laten we praten',
                    ],
                ],
            ],
        ];

        foreach ($standardSections as $templateSlug => $templateSections) {
            if (! isset($templates[$templateSlug])) {
                continue;
            }

            $template = $templates[$templateSlug];

            // Remove existing sections for this template and recreate
            $template->sections()->delete();

            foreach ($templateSections as $sectionData) {
                TemplateSection::create([
                    'template_id' => $template->id,
                    ...$sectionData,
                ]);
            }

            $this->command->info("  ✓ Sections for '{$templateSlug}' created");
        }
    }
}
