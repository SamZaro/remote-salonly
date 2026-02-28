<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');
        $schemes = $this->colorSchemes();
        $sectionDefaults = $this->sectionDefaults();
        $nav = $this->defaultNavigation();

        foreach ($this->definitions() as $i => $def) {
            if (! isset($categories[$def['category']])) {
                $this->command->warn("  ⚠ Category '{$def['category']}' not found, skipping '{$def['name']}'");

                continue;
            }

            $template = Template::updateOrCreate(
                ['slug' => $def['slug']],
                [
                    'category_id' => $categories[$def['category']],
                    'name' => $def['name'],
                    'description' => $def['description'],
                    'sort_order' => $i + 1,
                    'is_active' => true,
                    'navigation_items' => $nav,
                    'default_config' => [],
                    'theme_config' => array_merge(
                        $schemes[$def['scheme']] ?? [],
                        [
                            'color_scheme' => $def['scheme'],
                            'font_family' => $def['font'].', sans-serif',
                            'heading_font_family' => $def['heading_font'],
                            'font_size_base' => '16px',
                            'navbar_sticky' => true,
                            'navbar_transparent' => false,
                        ]
                    ),
                ]
            );

            $this->seedSections($template, $def, $sectionDefaults[$def['category']]);
            $this->command->info("  ✓ {$def['name']}");
        }

        $this->command->info('Templates seeded successfully!');
    }

    // ─── Template Definitions ──────────────────────────────────
    // Nieuw template? Voeg 1 regel toe.
    private function definitions(): array
    {
        return [
            // Kapsalons
            ['slug' => 'wave',     'category' => 'kapsalons',         'name' => 'Wave',     'description' => 'Moderne en stijlvolle template voor kapsalons.',          'scheme' => 'ocean',  'font' => 'Poppins',       'heading_font' => 'Playfair Display, serif',   'hero_title' => 'Welkom bij onze salon',              'hero_subtitle' => 'Waar stijl en vakmanschap samenkomen'],
            ['slug' => 'icon',     'category' => 'kapsalons',         'name' => 'Icon',     'description' => 'Iconische en opvallende template voor kapsalons.',         'scheme' => 'modern', 'font' => 'Montserrat',    'heading_font' => 'Cormorant Garamond, serif', 'hero_title' => 'Jouw stijl, ons vakmanschap',        'hero_subtitle' => 'Ontdek de iconische look die bij jou past'],
            ['slug' => 'nova',     'category' => 'kapsalons',         'name' => 'Nova',     'description' => 'Frisse en moderne template voor kapsalons.',               'scheme' => 'trendy',  'font' => 'Inter',         'heading_font' => 'Outfit, sans-serif',        'hero_title' => 'Een frisse look begint hier',        'hero_subtitle' => 'Moderne technieken voor een stralend resultaat'],
            ['slug' => 'pure',     'category' => 'kapsalons',         'name' => 'Pure',     'description' => 'Minimalistisch en elegant design voor kapsalons.',          'scheme' => 'minimal', 'font' => 'DM Sans',       'heading_font' => 'DM Serif Display, serif',   'hero_title' => 'Puur vakmanschap',                   'hero_subtitle' => 'Eenvoud en elegantie in elk detail'],
            ['slug' => 'studio',   'category' => 'kapsalons',         'name' => 'Studio',   'description' => 'Creatieve en trendy template voor kapsalons.',             'scheme' => 'rose',    'font' => 'Nunito',        'heading_font' => 'Abril Fatface, serif',      'hero_title' => 'Welkom in onze studio',              'hero_subtitle' => 'Creatief, trendy en altijd op maat'],

            // Barbershops
            ['slug' => 'barbero',  'category' => 'barbershops',       'name' => 'Barbero',  'description' => 'Stoere en mannelijke template voor barbershops.',           'scheme' => 'luxury',  'font' => 'Roboto',        'heading_font' => 'Oswald, sans-serif',        'hero_title' => 'De Beste Barbershop',                'hero_subtitle' => 'Traditioneel vakmanschap met een moderne twist'],
            ['slug' => 'razor',    'category' => 'barbershops',       'name' => 'Razor',    'description' => 'Scherpe en krachtige template voor barbershops.',           'scheme' => 'forest', 'font' => 'Barlow',        'heading_font' => 'Bebas Neue, sans-serif',    'hero_title' => 'Scherp in stijl',                    'hero_subtitle' => 'Precisie en kracht in elke knipbeurt'],
            ['slug' => 'shadow',   'category' => 'barbershops',       'name' => 'Shadow',    'description' => 'Professionele en strakke template voor barbershops.',       'scheme' => 'minimal', 'font' => 'Inter',         'heading_font' => 'Inter, sans-serif',         'hero_title' => 'Jouw barbershop ervaring',           'hero_subtitle' => 'Waar traditie en moderne stijl samenkomen'],
            ['slug' => 'urban',    'category' => 'barbershops',       'name' => 'Urban',     'description' => 'Editoriaal luxury barbershop design met scherpe hoeken en groot lettertype.', 'scheme' => 'luxury', 'font' => 'Barlow',        'heading_font' => 'Barlow Condensed, sans-serif', 'hero_title' => 'Sharp Looks.<br>Clean Cuts.',        'hero_subtitle' => 'Premium barbershop voor de moderne gentleman'],

            // Schoonheidssalons
            ['slug' => 'blossom',  'category' => 'schoonheidssalons', 'name' => 'Blossom',  'description' => 'Zachte en elegante template voor schoonheidssalons.',       'scheme' => 'beauty',  'font' => 'Lato',          'heading_font' => 'Playfair Display, serif',   'hero_title' => 'Ontdek jouw natuurlijke schoonheid', 'hero_subtitle' => 'Zachte verzorging en stralende resultaten'],
            ['slug' => 'essence',  'category' => 'schoonheidssalons', 'name' => 'Essence',  'description' => 'Verfijnd en luxueus design voor schoonheidssalons.',        'scheme' => 'luxury',  'font' => 'Source Sans 3', 'heading_font' => 'Cormorant, serif',          'hero_title' => 'De essentie van schoonheid',         'hero_subtitle' => 'Luxueuze behandelingen voor een stralende uitstraling'],
            ['slug' => 'glow',     'category' => 'schoonheidssalons', 'name' => 'Glow',     'description' => 'Warm minimalistisch design voor schoonheidssalons.',         'scheme' => 'beauty',  'font' => 'Raleway',       'heading_font' => 'Raleway, sans-serif',       'hero_title' => 'Mooi haar begint bij vakmanschap',   'hero_subtitle' => 'Persoonlijke verzorging in een ontspannen sfeer'],
        ];
    }

    // ─── Section Defaults per Category ─────────────────────────
    private function sectionDefaults(): array
    {
        return [
            'kapsalons' => [
                'cta_text' => 'Maak een afspraak',
                'slider' => ['title' => 'Onze Looks',         'subtitle' => 'Inspiratie'],
                'about' => ['title' => 'Over Ons',           'subtitle' => 'Onze passie',      'description' => 'Wij zijn gepassioneerde kappers met jarenlange ervaring. Ons team staat klaar om jou de beste service te bieden.'],
                'features' => ['title' => 'Waarom Ons Kiezen',  'subtitle' => 'Onze kwaliteiten'],
                'jumbotron' => ['title' => 'Jouw Nieuwe Look Begint Hier', 'subtitle' => 'Professioneel, persoonlijk en met passie'],
                'services' => ['title' => 'Onze Diensten',      'subtitle' => 'Wat wij bieden'],
                'gallery' => ['title' => 'Galerij',            'subtitle' => 'Ons werk'],
                'pricing' => ['title' => 'Prijzen',            'subtitle' => 'Onze tarieven'],
                'parallax' => ['title' => 'Ervaar Onze Salon',  'subtitle' => 'Sfeerimpressie'],
                'accordion' => ['title' => 'Veelgestelde Vragen', 'subtitle' => 'FAQ'],
                'cta' => ['title' => 'Klaar voor een nieuwe look?', 'subtitle' => 'Maak vandaag nog een afspraak', 'cta_text' => 'Maak een afspraak', 'cta_url' => '#contact'],
                'team' => ['title' => 'Ons Team',           'subtitle' => 'Maak kennis met onze stylisten', 'members' => [
                    ['name' => 'Sophie de Vries',   'role' => 'Hoofdstylist',      'bio' => 'Met meer dan 10 jaar ervaring creëert Sophie de perfecte look voor elke klant.'],
                    ['name' => 'Liam Bakker',       'role' => 'Colorist',          'bio' => 'Gespecialiseerd in balayage en kleuradvies op maat.'],
                    ['name' => 'Emma Jansen',       'role' => 'Stylist',           'bio' => 'Creatief met de schaar en altijd op de hoogte van de nieuwste trends.'],
                ]],
                'testimonials' => ['title' => 'Wat Klanten Zeggen', 'subtitle' => 'Reviews'],
                'contact' => ['title' => 'Contact',            'subtitle' => 'Neem contact op'],
                'contact-form' => ['title' => 'Stuur ons een bericht', 'subtitle' => 'Heeft u een vraag? Wij helpen u graag verder.'],
                'footer' => ['title' => 'Jouw Salon Naam',    'subtitle' => 'Stijlvol genieten van het beste'],
            ],
            'barbershops' => [
                'cta_text' => 'Reserveer Nu',
                'slider' => ['title' => 'Onze Stijlen',           'subtitle' => 'Bekijk ons werk'],
                'about' => ['title' => 'Wie Wij Zijn',           'subtitle' => 'Ons verhaal',       'description' => 'Een authentieke barbershop waar mannen zich thuis voelen. Wij combineren traditionele technieken met hedendaagse stijl.'],
                'features' => ['title' => 'Waarom Wij',             'subtitle' => 'Onze troeven'],
                'jumbotron' => ['title' => 'Ervaar het Verschil',     'subtitle' => 'Traditioneel vakmanschap, moderne uitstraling'],
                'services' => ['title' => 'Onze Behandelingen',     'subtitle' => 'Premium services'],
                'gallery' => ['title' => 'Galerij',                'subtitle' => 'Ons werk'],
                'pricing' => ['title' => 'Tarieven',               'subtitle' => 'Onze prijzen'],
                'parallax' => ['title' => 'Beleef de Sfeer',        'subtitle' => 'Onze barbershop'],
                'accordion' => ['title' => 'Veelgestelde Vragen',    'subtitle' => 'FAQ'],
                'cta' => ['title' => 'Tijd voor een nieuwe look?', 'subtitle' => 'Reserveer nu jouw plek', 'cta_text' => 'Reserveer Nu', 'cta_url' => '#contact'],
                'team' => ['title' => 'Ons Team',                'subtitle' => 'De mannen achter de schaar', 'members' => [
                    ['name' => 'Daan van Dijk',     'role' => 'Head Barber',       'bio' => 'Meester in klassieke en moderne kapsels met oog voor detail.'],
                    ['name' => 'Jayden Smit',       'role' => 'Barber',            'bio' => 'Gespecialiseerd in fades en beard trims met een persoonlijke touch.'],
                    ['name' => 'Noah de Groot',     'role' => 'Junior Barber',     'bio' => 'Jong talent met een passie voor het vak en frisse ideeën.'],
                ]],
                'testimonials' => ['title' => 'Tevreden Klanten',       'subtitle' => 'Ervaringen'],
                'contact' => ['title' => 'Bezoek Ons',             'subtitle' => 'Locatie & Contact'],
                'contact-form' => ['title' => 'Stuur ons een bericht', 'subtitle' => 'Heeft u een vraag of wilt u een afspraak maken?'],
                'footer' => ['title' => 'Jouw Barbershop Naam',   'subtitle' => 'Traditioneel vakmanschap, moderne stijl'],
            ],
            'schoonheidssalons' => [
                'cta_text' => 'Boek een behandeling',
                'slider' => ['title' => 'Onze Behandelingen',     'subtitle' => 'Bekijk de resultaten'],
                'about' => ['title' => 'Over Ons',               'subtitle' => 'Onze visie',        'description' => 'Wij geloven dat iedereen het verdient om te stralen. Ons team van ervaren schoonheidsspecialisten staat klaar om jou te verwennen met de beste behandelingen.'],
                'features' => ['title' => 'Waarom Ons Kiezen',      'subtitle' => 'Onze expertise'],
                'jumbotron' => ['title' => 'Verwennerij op zijn Best', 'subtitle' => 'Luxueuze behandelingen voor een stralende uitstraling'],
                'services' => ['title' => 'Onze Behandelingen',     'subtitle' => 'Wat wij bieden'],
                'gallery' => ['title' => 'Galerij',                'subtitle' => 'Resultaten'],
                'pricing' => ['title' => 'Prijzen',                'subtitle' => 'Onze tarieven'],
                'parallax' => ['title' => 'Ontdek Onze Wereld',     'subtitle' => 'Sfeerimpressie'],
                'accordion' => ['title' => 'Veelgestelde Vragen',    'subtitle' => 'FAQ'],
                'cta' => ['title' => 'Klaar om te stralen?',   'subtitle' => 'Boek vandaag nog een behandeling', 'cta_text' => 'Boek een behandeling', 'cta_url' => '#contact'],
                'team' => ['title' => 'Ons Team',               'subtitle' => 'Maak kennis met onze specialisten', 'members' => [
                    ['name' => 'Lisa Vermeer',      'role' => 'Schoonheidsspecialist', 'bio' => 'Expert in gezichtsbehandelingen en huidverzorging met een holistische aanpak.'],
                    ['name' => 'Noa van den Berg',  'role' => 'Nagelstyliste',         'bio' => 'Creatief in nail art en gespecialiseerd in gel en acryl technieken.'],
                    ['name' => 'Fleur Mulder',      'role' => 'Massagetherapeut',      'bio' => 'Brengt lichaam en geest in balans met ontspannende en therapeutische massages.'],
                ]],
                'testimonials' => ['title' => 'Wat Klanten Zeggen',     'subtitle' => 'Ervaringen'],
                'contact' => ['title' => 'Contact',                'subtitle' => 'Neem contact op'],
                'contact-form' => ['title' => 'Stuur ons een bericht', 'subtitle' => 'Heeft u een vraag? Wij helpen u graag verder.'],
                'footer' => ['title' => 'Jouw Salon Naam',        'subtitle' => 'Schoonheid en zelfzorg op zijn best'],
            ],
        ];
    }

    // ─── Color Schemes ─────────────────────────────────────────
    private function colorSchemes(): array
    {
        return [
            'luxury' => ['primary_color' => '#C8B88A', 'secondary_color' => '#0F0F0F', 'accent_color' => '#D4C4A0', 'background_color' => '#F5F3EF', 'text_color' => '#6B6B6B', 'heading_color' => '#0F0F0F', 'navbar_background' => '#0F0F0F', 'navbar_text_color' => '#f0eeeb', 'navbar_underline_color' => '#C8B88A'],
            'vintage' => ['primary_color' => '#8B4513', 'secondary_color' => '#3E2723', 'accent_color' => '#D2691E', 'background_color' => '#FDF5E6', 'text_color' => '#6D4C41', 'heading_color' => '#3E2723', 'navbar_background' => '#3E2723', 'navbar_text_color' => '#FDF5E6', 'navbar_underline_color' => '#8B4513'],
            'modern' => ['primary_color' => '#2563eb', 'secondary_color' => '#1e293b', 'accent_color' => '#3b82f6', 'background_color' => '#f8fafc', 'text_color' => '#64748b', 'heading_color' => '#0f172a', 'navbar_background' => '#1e293b', 'navbar_text_color' => '#f8fafc', 'navbar_underline_color' => '#2563eb'],
            'trendy' => ['primary_color' => '#8b5cf6', 'secondary_color' => '#18181b', 'accent_color' => '#a78bfa', 'background_color' => '#fafafa', 'text_color' => '#71717a', 'heading_color' => '#18181b', 'navbar_background' => '#18181b', 'navbar_text_color' => '#fafafa', 'navbar_underline_color' => '#8b5cf6'],
            'rose' => ['primary_color' => '#e11d48', 'secondary_color' => '#1f1f1f', 'accent_color' => '#fb7185', 'background_color' => '#fafafa', 'text_color' => '#737373', 'heading_color' => '#171717', 'navbar_background' => '#1f1f1f', 'navbar_text_color' => '#fafafa', 'navbar_underline_color' => '#e11d48'],
            'beauty' => ['primary_color' => '#B5908A', 'secondary_color' => '#6E5F5B', 'accent_color' => '#E8D8D3', 'background_color' => '#FBF9F8', 'text_color' => '#8A7B76', 'heading_color' => '#6E5F5B', 'navbar_background' => '#6E5F5B', 'navbar_text_color' => '#FBF9F8', 'navbar_underline_color' => '#B5908A', 'navbar_cta_background' => '#FBF9F8', 'navbar_cta_text_color' => '#6E5F5B'],
            'peach' => ['primary_color' => '#FF6F61', 'secondary_color' => '#2B2B2B', 'accent_color' => '#FFD6C9', 'background_color' => '#FAFAFA', 'text_color' => '#6B6B6B', 'heading_color' => '#2B2B2B', 'navbar_background' => '#2B2B2B', 'navbar_text_color' => '#FAFAFA', 'navbar_underline_color' => '#FF6F61'],
            'minimal' => ['primary_color' => '#171717', 'secondary_color' => '#0a0a0a', 'accent_color' => '#404040', 'background_color' => '#FAFAFA', 'text_color' => '#737373', 'heading_color' => '#171717', 'navbar_background' => '#0a0a0a', 'navbar_text_color' => '#FAFAFA', 'navbar_underline_color' => '#171717'],
            'natural' => ['primary_color' => '#14b8a6', 'secondary_color' => '#1c1917', 'accent_color' => '#99f6e4', 'background_color' => '#f5f0eb', 'text_color' => '#57534e', 'heading_color' => '#1c1917', 'navbar_background' => '#1c1917', 'navbar_text_color' => '#fafaf9', 'navbar_underline_color' => '#14b8a6'],
            'ocean' => ['primary_color' => '#0077b6', 'secondary_color' => '#0d1b2a', 'accent_color' => '#48cae4', 'background_color' => '#f0f7ff', 'text_color' => '#4a6a8a', 'heading_color' => '#0d1b2a', 'navbar_background' => '#0d1b2a', 'navbar_text_color' => '#f0f7ff', 'navbar_underline_color' => '#0077b6'],
            'forest' => ['primary_color' => '#2d6a4f', 'secondary_color' => '#1b1b1b', 'accent_color' => '#52b788', 'background_color' => '#f9faf8', 'text_color' => '#6b7280', 'heading_color' => '#1b1b1b', 'navbar_background' => '#1b1b1b', 'navbar_text_color' => '#f9faf8', 'navbar_underline_color' => '#2d6a4f'],
            'orange' => ['primary_color' => '#f97316', 'secondary_color' => '#1c1917', 'accent_color' => '#ffedd5', 'background_color' => '#fafaf9', 'text_color' => '#78716c', 'heading_color' => '#1c1917', 'navbar_background' => '#1c1917', 'navbar_text_color' => '#fafaf9', 'navbar_underline_color' => '#f97316'],
            'dark' => ['primary_color' => '#6366f1', 'secondary_color' => '#0f0f0f', 'accent_color' => '#818cf8', 'background_color' => '#111111', 'text_color' => '#a1a1aa', 'heading_color' => '#f4f4f5', 'navbar_background' => '#0a0a0a', 'navbar_text_color' => '#f4f4f5', 'navbar_underline_color' => '#6366f1'],
        ];
    }

    // ─── Seed Sections ─────────────────────────────────────────
    private function seedSections(Template $template, array $def, array $defaults): void
    {
        $template->sections()->delete();

        $sections = [
            ['section_type' => 'hero',         'order' => 1, 'content' => ['title' => $def['hero_title'], 'subtitle' => $def['hero_subtitle'], 'cta_text' => $defaults['cta_text'], 'cta_url' => '#contact']],
            ['section_type' => 'slider',       'order' => 2, 'content' => $defaults['slider']],
            ['section_type' => 'about',        'order' => 3, 'content' => $defaults['about']],
            ['section_type' => 'features',     'order' => 4, 'content' => $defaults['features']],
            ['section_type' => 'jumbotron',    'order' => 5, 'content' => $defaults['jumbotron']],
            ['section_type' => 'services',     'order' => 6, 'content' => $defaults['services']],
            ['section_type' => 'gallery',      'order' => 7, 'content' => $defaults['gallery']],
            ['section_type' => 'pricing',      'order' => 8, 'content' => $defaults['pricing']],
            ['section_type' => 'parallax',     'order' => 9, 'content' => $defaults['parallax']],
            ['section_type' => 'team',         'order' => 10, 'content' => $defaults['team']],
            ['section_type' => 'accordion',    'order' => 11, 'content' => $defaults['accordion']],
            ['section_type' => 'cta',          'order' => 12, 'content' => $defaults['cta']],
            ['section_type' => 'testimonials', 'order' => 13, 'content' => $defaults['testimonials']],
            ['section_type' => 'contact',      'order' => 14, 'content' => $defaults['contact']],
            ['section_type' => 'contact-form', 'order' => 15, 'content' => $defaults['contact-form'] ?? ['title' => 'Stuur ons een bericht', 'subtitle' => 'Heeft u een vraag? Wij helpen u graag verder.']],
            ['section_type' => 'footer',       'order' => 16, 'content' => $defaults['footer']],
        ];

        foreach ($sections as $section) {
            $template->sections()->create(array_merge($section, ['is_active' => true]));
        }
    }

    // ─── Default Navigation ────────────────────────────────────
    private function defaultNavigation(): array
    {
        return [
            ['label' => 'Home',       'target' => '#hero',         'icon' => null, 'is_active' => true],
            ['label' => 'Over Ons',   'target' => '#about',        'icon' => null, 'is_active' => true],
            ['label' => 'Diensten',   'target' => '#services',     'icon' => null, 'is_active' => true],
            ['label' => 'Reviews',    'target' => '#testimonials', 'icon' => null, 'is_active' => true],
            ['label' => 'Contact',    'target' => '#contact',      'icon' => null, 'is_active' => true],
        ];
    }
}
