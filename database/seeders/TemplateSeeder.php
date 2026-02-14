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
        $defaultNav = [
            ['label' => 'Home', 'target' => '#hero', 'icon' => null, 'is_active' => true],
            ['label' => 'Over Ons', 'target' => '#about', 'icon' => null, 'is_active' => true],
            ['label' => 'Diensten', 'target' => '#services', 'icon' => null, 'is_active' => true],
            ['label' => 'Reviews', 'target' => '#testimonials', 'icon' => null, 'is_active' => true],
            ['label' => 'Contact', 'target' => '#contact', 'icon' => null, 'is_active' => true],
        ];

        $templates = [
            // ──────────────────────────────────────────────
            // Kapsalons
            // ──────────────────────────────────────────────
            [
                'category_slug' => 'kapsalons',
                'name' => 'Coupe',
                'slug' => 'coupe',
                'description' => 'Moderne en stijlvolle template voor kapsalons.',
                'sort_order' => 1,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'modern',
                    'primary_color' => '#2563eb',
                    'secondary_color' => '#1e293b',
                    'accent_color' => '#3b82f6',
                    'background_color' => '#f8fafc',
                    'text_color' => '#64748b',
                    'heading_color' => '#0f172a',
                    'font_family' => 'Poppins, sans-serif',
                    'heading_font_family' => 'Playfair Display, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#1e293b',
                    'navbar_text_color' => '#f8fafc',
                    'navbar_underline_color' => '#2563eb',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'kapsalons',
                'name' => 'Icon',
                'slug' => 'icon',
                'description' => 'Iconische en opvallende template voor kapsalons.',
                'sort_order' => 2,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'vintage',
                    'primary_color' => '#c9a227',
                    'secondary_color' => '#1a1a1a',
                    'accent_color' => '#d4af37',
                    'background_color' => '#ffffff',
                    'text_color' => '#555555',
                    'heading_color' => '#1a1a1a',
                    'font_family' => 'Montserrat, sans-serif',
                    'heading_font_family' => 'Cormorant Garamond, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#1a1a1a',
                    'navbar_text_color' => '#c9a227',
                    'navbar_underline_color' => '#c9a227',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'kapsalons',
                'name' => 'Nova',
                'slug' => 'nova',
                'description' => 'Frisse en moderne template voor kapsalons.',
                'sort_order' => 3,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'trendy',
                    'primary_color' => '#8b5cf6',
                    'secondary_color' => '#18181b',
                    'accent_color' => '#a78bfa',
                    'background_color' => '#fafafa',
                    'text_color' => '#71717a',
                    'heading_color' => '#18181b',
                    'font_family' => 'Inter, sans-serif',
                    'heading_font_family' => 'Outfit, sans-serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#18181b',
                    'navbar_text_color' => '#fafafa',
                    'navbar_underline_color' => '#8b5cf6',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'kapsalons',
                'name' => 'Pure',
                'slug' => 'pure',
                'description' => 'Minimalistisch en elegant design voor kapsalons.',
                'sort_order' => 4,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'minimal',
                    'primary_color' => '#171717',
                    'secondary_color' => '#0a0a0a',
                    'accent_color' => '#404040',
                    'background_color' => '#FAFAFA',
                    'text_color' => '#737373',
                    'heading_color' => '#171717',
                    'font_family' => 'DM Sans, sans-serif',
                    'heading_font_family' => 'DM Serif Display, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#0a0a0a',
                    'navbar_text_color' => '#FAFAFA',
                    'navbar_underline_color' => '#171717',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'kapsalons',
                'name' => 'Studio',
                'slug' => 'studio',
                'description' => 'Creatieve en trendy template voor kapsalons.',
                'sort_order' => 5,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'rose',
                    'primary_color' => '#e11d48',
                    'secondary_color' => '#1f1f1f',
                    'accent_color' => '#fb7185',
                    'background_color' => '#fff1f2',
                    'text_color' => '#737373',
                    'heading_color' => '#171717',
                    'font_family' => 'Nunito, sans-serif',
                    'heading_font_family' => 'Abril Fatface, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#1f1f1f',
                    'navbar_text_color' => '#fff1f2',
                    'navbar_underline_color' => '#e11d48',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],

            // ──────────────────────────────────────────────
            // Barbershops
            // ──────────────────────────────────────────────
            [
                'category_slug' => 'barbershops',
                'name' => 'Barbero',
                'slug' => 'barbero',
                'description' => 'Stoere en mannelijke template voor barbershops.',
                'sort_order' => 1,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'luxury',
                    'primary_color' => '#C8B88A',
                    'secondary_color' => '#0F0F0F',
                    'accent_color' => '#D4C4A0',
                    'background_color' => '#F5F3EF',
                    'text_color' => '#6B6B6B',
                    'heading_color' => '#0F0F0F',
                    'font_family' => 'Roboto, sans-serif',
                    'heading_font_family' => 'Oswald, sans-serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#0F0F0F',
                    'navbar_text_color' => '#C8B88A',
                    'navbar_underline_color' => '#C8B88A',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'barbershops',
                'name' => 'Razor',
                'slug' => 'razor',
                'description' => 'Scherpe en krachtige template voor barbershops.',
                'sort_order' => 2,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'vintage',
                    'primary_color' => '#c9a227',
                    'secondary_color' => '#1a1a1a',
                    'accent_color' => '#d4af37',
                    'background_color' => '#ffffff',
                    'text_color' => '#555555',
                    'heading_color' => '#1a1a1a',
                    'font_family' => 'Barlow, sans-serif',
                    'heading_font_family' => 'Bebas Neue, sans-serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#1a1a1a',
                    'navbar_text_color' => '#c9a227',
                    'navbar_underline_color' => '#c9a227',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'barbershops',
                'name' => 'Projecto',
                'slug' => 'projecto',
                'description' => 'Professionele en strakke template voor barbershops.',
                'sort_order' => 3,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'minimal',
                    'primary_color' => '#171717',
                    'secondary_color' => '#0a0a0a',
                    'accent_color' => '#404040',
                    'background_color' => '#FAFAFA',
                    'text_color' => '#737373',
                    'heading_color' => '#171717',
                    'font_family' => 'Inter, sans-serif',
                    'heading_font_family' => 'Inter, sans-serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#0a0a0a',
                    'navbar_text_color' => '#FAFAFA',
                    'navbar_underline_color' => '#171717',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],

            // ──────────────────────────────────────────────
            // Schoonheidssalons
            // ──────────────────────────────────────────────
            [
                'category_slug' => 'schoonheidssalons',
                'name' => 'Blossom',
                'slug' => 'blossom',
                'description' => 'Zachte en elegante template voor schoonheidssalons.',
                'sort_order' => 1,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'beauty',
                    'primary_color' => '#E8D8D3',
                    'secondary_color' => '#6E5F5B',
                    'accent_color' => '#F2E7E4',
                    'background_color' => '#FBF9F8',
                    'text_color' => '#8A7B76',
                    'heading_color' => '#6E5F5B',
                    'font_family' => 'Lato, sans-serif',
                    'heading_font_family' => 'Playfair Display, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#6E5F5B',
                    'navbar_text_color' => '#FBF9F8',
                    'navbar_underline_color' => '#E8D8D3',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
                'default_config' => [],
            ],
            [
                'category_slug' => 'schoonheidssalons',
                'name' => 'Essence',
                'slug' => 'essence',
                'description' => 'Verfijnd en luxueus design voor schoonheidssalons.',
                'sort_order' => 2,
                'is_active' => true,
                'theme_config' => [
                    'color_scheme' => 'luxury',
                    'primary_color' => '#C8B88A',
                    'secondary_color' => '#0F0F0F',
                    'accent_color' => '#D4C4A0',
                    'background_color' => '#F5F3EF',
                    'text_color' => '#6B6B6B',
                    'heading_color' => '#0F0F0F',
                    'font_family' => 'Source Sans 3, sans-serif',
                    'heading_font_family' => 'Cormorant, serif',
                    'font_size_base' => '16px',
                    'navbar_background' => '#0F0F0F',
                    'navbar_text_color' => '#C8B88A',
                    'navbar_underline_color' => '#C8B88A',
                    'navbar_sticky' => true,
                    'navbar_transparent' => false,
                ],
                'navigation_items' => $defaultNav,
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
        $sections = [
            // ──────────────────────────────────────────────
            // Kapsalons
            // ──────────────────────────────────────────────
            'coupe' => $this->kapsalonSections(
                heroTitle: 'Welkom bij onze salon',
                heroSubtitle: 'Waar stijl en vakmanschap samenkomen',
            ),
            'icon' => $this->kapsalonSections(
                heroTitle: 'Jouw stijl, ons vakmanschap',
                heroSubtitle: 'Ontdek de iconische look die bij jou past',
            ),
            'nova' => $this->kapsalonSections(
                heroTitle: 'Een frisse look begint hier',
                heroSubtitle: 'Moderne technieken voor een stralend resultaat',
            ),
            'pure' => $this->kapsalonSections(
                heroTitle: 'Puur vakmanschap',
                heroSubtitle: 'Eenvoud en elegantie in elk detail',
            ),
            'studio' => $this->kapsalonSections(
                heroTitle: 'Welkom in onze studio',
                heroSubtitle: 'Creatief, trendy en altijd op maat',
            ),

            // ──────────────────────────────────────────────
            // Barbershops
            // ──────────────────────────────────────────────
            'barbero' => $this->barbershopSections(
                heroTitle: 'De Beste Barbershop',
                heroSubtitle: 'Traditioneel vakmanschap met een moderne twist',
            ),
            'razor' => $this->barbershopSections(
                heroTitle: 'Scherp in stijl',
                heroSubtitle: 'Precisie en kracht in elke knipbeurt',
            ),
            'projecto' => [
                [
                    'section_type' => 'hero',
                    'order' => 1,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Jouw barbershop ervaring',
                        'subtitle' => 'Waar traditie en moderne stijl samenkomen',
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
                        'subtitle' => 'Ons verhaal',
                        'description' => 'Wij zijn een team van gepassioneerde barbers met jarenlange ervaring. Bij ons draait alles om het perfecte kapsel, een ontspannen sfeer en persoonlijke aandacht. Van een klassieke fade tot een stijlvolle baardtrim - wij zorgen ervoor dat je er op je best uitziet.',
                        'items' => [
                            ['title' => 'Ervaren Barbers', 'description' => 'Ons team bestaat uit gecertificeerde professionals met oog voor detail', 'icon' => 'users'],
                            ['title' => 'Premium Producten', 'description' => 'Wij werken uitsluitend met hoogwaardige producten', 'icon' => 'shield'],
                            ['title' => 'Scherpe Prijzen', 'description' => 'Topkwaliteit voor een eerlijke prijs', 'icon' => 'check'],
                        ],
                    ],
                ],
                [
                    'section_type' => 'services',
                    'order' => 3,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Onze Behandelingen',
                        'subtitle' => 'Wat wij bieden',
                        'items' => [
                            [
                                'title' => 'Knippen',
                                'description' => 'Van klassieke coupes tot moderne fades en textured crops. Onze barbers luisteren naar jouw wensen en creëren de perfecte look.',
                                'icon' => 'scissors',
                            ],
                            [
                                'title' => 'Baard Trimmen',
                                'description' => 'Een strakke baardtrim of een volledige baard verzorging. Wij brengen jouw baard in topvorm met precisie en vakmanschap.',
                                'icon' => 'razor',
                            ],
                            [
                                'title' => 'Hot Towel Shave',
                                'description' => 'De ultieme barbershop ervaring. Een traditionele scheerbeurt met warme handdoeken voor een gladde en verzorgde huid.',
                                'icon' => 'towel',
                            ],
                            [
                                'title' => 'Knippen & Baard',
                                'description' => 'Het complete pakket: een stijlvol kapsel gecombineerd met een verzorgde baard. De perfecte combi voor de moderne man.',
                                'icon' => 'star',
                            ],
                            [
                                'title' => 'Wenkbrauwen',
                                'description' => 'Netjes bijgewerkte wenkbrauwen voor een verzorgde uitstraling. Snel en pijnloos door onze ervaren barbers.',
                                'icon' => 'check',
                            ],
                            [
                                'title' => 'Haar & Huid Verzorging',
                                'description' => 'Advies en behandelingen voor gezond haar en een verzorgde huid. Met premium producten afgestemd op jouw behoeften.',
                                'icon' => 'shield',
                            ],
                        ],
                    ],
                ],
                [
                    'section_type' => 'testimonials',
                    'order' => 4,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Wat Klanten Zeggen',
                        'subtitle' => 'Reviews',
                        'items' => [
                            ['name' => 'Mark de Boer', 'role' => 'Vaste klant', 'quote' => 'Beste barbershop in de stad. De sfeer is top en mijn fade zit altijd perfect. Kom hier al jaren en ga niet meer weg.'],
                            ['name' => 'Thomas Visser', 'role' => 'Vaste klant', 'quote' => 'Eindelijk een barbershop die begrijpt wat ik wil. Goede service, scherpe prijzen en altijd een goed gesprek.'],
                            ['name' => 'Kevin Bakker', 'role' => 'Nieuwe klant', 'quote' => 'Op aanraden van een vriend hier geweest. De hot towel shave was een geweldige ervaring. Zeker een aanrader!'],
                        ],
                    ],
                ],
                [
                    'section_type' => 'contact',
                    'order' => 5,
                    'is_active' => true,
                    'content' => [
                        'title' => 'Contact',
                        'subtitle' => 'Bezoek ons',
                    ],
                ],
            ],

            // ──────────────────────────────────────────────
            // Schoonheidssalons
            // ──────────────────────────────────────────────
            'blossom' => $this->schoonheidssalonSections(
                heroTitle: 'Ontdek jouw natuurlijke schoonheid',
                heroSubtitle: 'Zachte verzorging en stralende resultaten',
            ),
            'essence' => $this->schoonheidssalonSections(
                heroTitle: 'De essentie van schoonheid',
                heroSubtitle: 'Luxueuze behandelingen voor een stralende uitstraling',
            ),
        ];

        foreach ($sections as $templateSlug => $templateSections) {
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

    private function kapsalonSections(string $heroTitle, string $heroSubtitle): array
    {
        return [
            [
                'section_type' => 'hero',
                'order' => 1,
                'is_active' => true,
                'content' => [
                    'title' => $heroTitle,
                    'subtitle' => $heroSubtitle,
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
        ];
    }

    private function barbershopSections(string $heroTitle, string $heroSubtitle): array
    {
        return [
            [
                'section_type' => 'hero',
                'order' => 1,
                'is_active' => true,
                'content' => [
                    'title' => $heroTitle,
                    'subtitle' => $heroSubtitle,
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
        ];
    }

    private function schoonheidssalonSections(string $heroTitle, string $heroSubtitle): array
    {
        return [
            [
                'section_type' => 'hero',
                'order' => 1,
                'is_active' => true,
                'content' => [
                    'title' => $heroTitle,
                    'subtitle' => $heroSubtitle,
                    'cta_text' => 'Boek een behandeling',
                    'cta_url' => '#contact',
                ],
            ],
            [
                'section_type' => 'about',
                'order' => 2,
                'is_active' => true,
                'content' => [
                    'title' => 'Over Ons',
                    'subtitle' => 'Onze visie',
                    'description' => 'Wij geloven dat iedereen het verdient om te stralen. Ons team van ervaren schoonheidsspecialisten staat klaar om jou te verwennen met de beste behandelingen.',
                ],
            ],
            [
                'section_type' => 'services',
                'order' => 3,
                'is_active' => true,
                'content' => [
                    'title' => 'Onze Behandelingen',
                    'subtitle' => 'Wat wij bieden',
                ],
            ],
            [
                'section_type' => 'testimonials',
                'order' => 4,
                'is_active' => true,
                'content' => [
                    'title' => 'Wat Klanten Zeggen',
                    'subtitle' => 'Ervaringen',
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
        ];
    }
}
