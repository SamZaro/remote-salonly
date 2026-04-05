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
            ['slug' => 'wave',     'category' => 'kapsalons',         'name' => 'Wave',     'description' => 'Moderne en stijlvolle template voor kapsalons.',          'scheme' => 'ocean',  'font' => 'Poppins',       'heading_font' => 'Playfair Display, serif',   'hero_title' => 'Your Style,<br>Our Passion',         'hero_subtitle' => 'Professional hair care in a relaxed atmosphere'],
            ['slug' => 'icon',     'category' => 'kapsalons',         'name' => 'Icon',     'description' => 'Iconische en opvallende template voor kapsalons.',         'scheme' => 'modern', 'font' => 'Montserrat',    'heading_font' => 'Cormorant Garamond, serif', 'hero_title' => 'Your Style, Our Craftsmanship',      'hero_subtitle' => 'Discover the iconic look that suits you'],
            ['slug' => 'nova',     'category' => 'kapsalons',         'name' => 'Nova',     'description' => 'Frisse en moderne template voor kapsalons.',               'scheme' => 'trendy',  'font' => 'Inter',         'heading_font' => 'Outfit, sans-serif',        'hero_title' => 'Your New Look',           'hero_subtitle' => 'Craftsmanship with a modern twist'],
            ['slug' => 'pure',     'category' => 'kapsalons',         'name' => 'Pure',     'description' => 'Natuurlijk en organisch design met botanische elementen voor kapsalons.',          'scheme' => 'natural', 'font' => 'Roboto',        'heading_font' => 'Lustria, serif',            'hero_title' => 'Naturally Crafted. Beautifully You.', 'hero_subtitle' => 'Simplicity and elegance in every detail'],
            ['slug' => 'studio',   'category' => 'kapsalons',         'name' => 'Studio',   'description' => 'Creatieve en trendy template voor kapsalons.',             'scheme' => 'rose',    'font' => 'Nunito',        'heading_font' => 'Abril Fatface, serif',      'hero_title' => 'Create Your<br>Signature Look',      'hero_subtitle' => 'Where creativity and style meet. Your hair, your statement.'],
            ['slug' => 'level',    'category' => 'kapsalons',         'name' => 'Level',    'description' => 'Dynamisch editorial design voor trendy kapsalons met oranje accent.', 'scheme' => 'orange',  'font' => 'Jost',          'heading_font' => 'Syne, sans-serif',          'hero_title' => 'Your Hair.<br>Your Story.',          'hero_subtitle' => 'Creative cuts with an eye for detail'],

            // Barbershops
            ['slug' => 'barbero',  'category' => 'barbershops',       'name' => 'Barbero',  'description' => 'Stoere en mannelijke template voor barbershops.',           'scheme' => 'luxury',  'font' => 'Roboto',        'heading_font' => 'Oswald, sans-serif',        'hero_title' => 'The Best Barbershop',                'hero_subtitle' => 'Traditional craftsmanship with a modern twist'],
            ['slug' => 'razor',    'category' => 'barbershops',       'name' => 'Razor',    'description' => 'Scherpe en krachtige template voor barbershops.',           'scheme' => 'forest', 'font' => 'Barlow',        'heading_font' => 'Bebas Neue, sans-serif',    'hero_title' => 'Sharp Looks.<br>Clean Cuts.',        'hero_subtitle' => 'Traditional craftsmanship with modern flair'],
            ['slug' => 'shadow',   'category' => 'barbershops',       'name' => 'Shadow',    'description' => 'Professionele en strakke template voor barbershops.',       'scheme' => 'minimal', 'font' => 'Inter',         'heading_font' => 'Inter, sans-serif',         'hero_title' => 'Your barbershop experience',          'hero_subtitle' => 'Where tradition and modern style come together'],
            ['slug' => 'urban',    'category' => 'barbershops',       'name' => 'Urban',     'description' => 'Editoriaal luxury barbershop design met scherpe hoeken en groot lettertype.', 'scheme' => 'luxury', 'font' => 'Barlow',        'heading_font' => 'Barlow Condensed, sans-serif', 'hero_title' => 'Sharp Looks.<br>Clean Cuts.',        'hero_subtitle' => 'Traditional craftsmanship with modern flair'],
            ['slug' => 'fade',     'category' => 'barbershops',       'name' => 'Fade',      'description' => 'Creatief en energiek barbershop design met luxe gouden accenten.',               'scheme' => 'luxury', 'font' => 'Outfit',        'heading_font' => 'Rajdhani, sans-serif',         'hero_title' => 'Sharp Cuts.<br>Bold Style.',         'hero_subtitle' => 'Where precision meets creativity'],
            ['slug' => 'king',     'category' => 'barbershops',       'name' => 'King',      'description' => 'Premium barbershop template met royaal en bold design voor de moderne gentleman.', 'scheme' => 'luxury', 'font' => 'Manrope',       'heading_font' => 'DM Serif Display, serif',      'hero_title' => 'Rule Your<br>Style',                 'hero_subtitle' => 'Premium grooming for the modern king'],

            // Schoonheidssalons
            ['slug' => 'blossom',  'category' => 'schoonheidssalons', 'name' => 'Blossom',  'description' => 'Zachte en elegante template voor schoonheidssalons.',       'scheme' => 'beauty',  'font' => 'Lato',          'heading_font' => 'Playfair Display, serif',   'hero_title' => 'Bloom Into<br>Your Beauty', 'hero_subtitle' => 'Luxury hair care, beauty & wellness for the modern woman'],
            ['slug' => 'essence',  'category' => 'schoonheidssalons', 'name' => 'Essence',  'description' => 'Verfijnd en luxueus design voor schoonheidssalons.',        'scheme' => 'luxury',  'font' => 'Source Sans 3', 'heading_font' => 'Cormorant, serif',          'hero_title' => 'Timeless<br>Elegance',               'hero_subtitle' => 'Where beauty and refinement meet'],
            ['slug' => 'glow',     'category' => 'schoonheidssalons', 'name' => 'Glow',     'description' => 'Warm minimalistisch design voor schoonheidssalons.',         'scheme' => 'beauty',  'font' => 'Raleway',       'heading_font' => 'Raleway, sans-serif',       'hero_title' => 'Beautiful hair starts<br>with craftsmanship', 'hero_subtitle' => 'Personal hair care and beauty in a relaxed atmosphere'],
            ['slug' => 'spa',      'category' => 'schoonheidssalons', 'name' => 'Spa',      'description' => 'Sereen spa & wellness design met elegante typografie.',        'scheme' => 'beauty',  'font' => 'Lato',          'heading_font' => 'Lustria, serif',            'hero_title' => 'Revitalize Your Beauty,<br>Revitalize Your Soul', 'hero_subtitle' => 'Discover pure relaxation and personal beauty treatments in an atmosphere of calm and luxury'],
            ['slug' => 'blush',    'category' => 'schoonheidssalons', 'name' => 'Blush',    'description' => 'Elegant nail studio template met luxueuze gouden accenten en verfijnde typografie.', 'scheme' => 'luxury',  'font' => 'Nunito Sans',   'heading_font' => 'Cormorant Garamond, serif', 'hero_title' => 'Nails That<br>Inspire',              'hero_subtitle' => 'Where precision meets beauty'],
            ['slug' => 'glaze',    'category' => 'schoonheidssalons', 'name' => 'Glaze',    'description' => 'Trendy en modern nail studio design met gedurfde rose accenten en strakke typografie.', 'scheme' => 'rose',    'font' => 'Inter',         'heading_font' => 'Outfit, sans-serif',        'hero_title' => 'Nails That<br>Speak Volumes',        'hero_subtitle' => 'Bold style meets flawless precision'],
        ];
    }

    // ─── Section Defaults per Category ─────────────────────────
    private function sectionDefaults(): array
    {
        return [
            'kapsalons' => [
                'cta_text' => 'Book Appointment',
                'slider' => ['title' => 'Our Styles',         'subtitle' => 'Creative. Personal. On-trend.'],
                'about' => ['title' => 'Who We Are',          'subtitle' => 'Passion for hair, eye for detail', 'description' => 'We believe a great haircut is more than just a visit to the salon. It is a moment of attention — for your hair, your style and you as a person. Our team consists of driven stylists who continuously keep up with the latest trends.'],
                'features' => ['title' => 'Why Choose Us',    'subtitle' => 'What sets us apart'],
                'jumbotron' => ['title' => 'Your New Look Starts Here', 'subtitle' => 'Professional, personal and passionate'],
                'services' => ['title' => 'Our Services',     'subtitle' => 'What we offer'],
                'gallery' => ['title' => 'Our Work',          'subtitle' => 'View our most recent looks'],
                'pricing' => ['title' => 'Price List',        'subtitle' => 'Transparent pricing, honest quality'],
                'parallax' => ['title' => 'Experience Our Salon', 'subtitle' => 'Atmosphere impression'],
                'accordion' => ['title' => 'Frequently Asked Questions', 'subtitle' => 'FAQ'],
                'cta' => ['title' => 'Ready for a new look?', 'subtitle' => 'Book your appointment today', 'cta_text' => 'Book Appointment', 'cta_url' => '#contact'],
                'team' => ['title' => 'Our Team',             'subtitle' => 'Meet our stylists', 'members' => [
                    ['name' => 'Sophie de Vries',   'role' => 'Head Stylist',      'bio' => 'With over 10 years of experience, Sophie creates the perfect look for every client.'],
                    ['name' => 'Liam Bakker',       'role' => 'Colorist',          'bio' => 'Specialised in balayage and custom colour advice.'],
                    ['name' => 'Emma Jansen',       'role' => 'Stylist',           'bio' => 'Creative with the scissors and always up to date with the latest trends.'],
                ]],
                'testimonials' => ['title' => 'What Customers Say', 'subtitle' => 'Reviews'],
                'contact' => ['title' => 'Visit Us',          'subtitle' => 'Appointments recommended, walk-ins always welcome'],
                'contact-form' => ['title' => 'Send us a message', 'subtitle' => 'Have a question? We are happy to help.'],
                'footer' => ['title' => 'Your Salon Name',    'subtitle' => 'Stylish enjoyment at its best'],
            ],
            'barbershops' => [
                'cta_text' => 'Book Now',
                'slider' => ['title' => 'Our Styles',              'subtitle' => 'View our work'],
                'about' => ['title' => 'Who We Are',              'subtitle' => 'Our story',         'description' => 'An authentic barbershop where men feel right at home. We combine traditional techniques with contemporary style.'],
                'features' => ['title' => 'Why Choose Us',          'subtitle' => 'Our strengths'],
                'jumbotron' => ['title' => 'Experience the Difference', 'subtitle' => 'Traditional craftsmanship, modern look'],
                'services' => ['title' => 'Our Services',           'subtitle' => 'Premium services'],
                'gallery' => ['title' => 'Gallery',                'subtitle' => 'Our work'],
                'pricing' => ['title' => 'Price List',             'subtitle' => 'Our rates'],
                'parallax' => ['title' => 'Feel the Atmosphere',    'subtitle' => 'Our barbershop'],
                'accordion' => ['title' => 'Frequently Asked Questions', 'subtitle' => 'FAQ'],
                'cta' => ['title' => 'Ready for a new look?',     'subtitle' => 'Book your spot today', 'cta_text' => 'Book Now', 'cta_url' => '#contact'],
                'team' => ['title' => 'Our Team',                 'subtitle' => 'The men behind the scissors', 'members' => [
                    ['name' => 'Daan van Dijk',     'role' => 'Head Barber',       'bio' => 'Master of classic and modern cuts with an eye for detail.'],
                    ['name' => 'Jayden Smit',       'role' => 'Barber',            'bio' => 'Specialist in fades and beard trims with a personal touch.'],
                    ['name' => 'Noah de Groot',     'role' => 'Junior Barber',     'bio' => 'Young talent with a passion for the craft and fresh ideas.'],
                ]],
                'testimonials' => ['title' => 'What Customers Say',  'subtitle' => 'Experiences'],
                'contact' => ['title' => 'Visit Us',               'subtitle' => 'Location and Contact'],
                'contact-form' => ['title' => 'Send us a message',  'subtitle' => 'Have a question or want to book an appointment?'],
                'footer' => ['title' => 'Your Barbershop Name',    'subtitle' => 'Traditional craftsmanship, modern style'],
            ],
            'schoonheidssalons' => [
                'cta_text' => 'Book a Treatment',
                'slider' => ['title' => 'Our Treatments',          'subtitle' => 'View our results'],
                'about' => ['title' => 'About Us',                'subtitle' => 'Our vision',        'description' => 'We believe everyone deserves to feel radiant. Our team of experienced beauty specialists is ready to pamper you with the finest treatments.'],
                'features' => ['title' => 'Why Choose Us',          'subtitle' => 'Our expertise'],
                'jumbotron' => ['title' => 'Pampering at its Best',  'subtitle' => 'Luxury treatments for a radiant appearance'],
                'services' => ['title' => 'Our Treatments',         'subtitle' => 'What we offer'],
                'gallery' => ['title' => 'Gallery',                'subtitle' => 'Results'],
                'pricing' => ['title' => 'Prices',                 'subtitle' => 'Our rates'],
                'parallax' => ['title' => 'Discover Our World',     'subtitle' => 'Atmosphere impression'],
                'accordion' => ['title' => 'Frequently Asked Questions', 'subtitle' => 'FAQ'],
                'cta' => ['title' => 'Ready to glow?',         'subtitle' => 'Book a treatment today', 'cta_text' => 'Book a Treatment', 'cta_url' => '#contact'],
                'team' => ['title' => 'Our Team',               'subtitle' => 'Meet our specialists', 'members' => [
                    ['name' => 'Lisa Vermeer',      'role' => 'Beauty Specialist',  'bio' => 'Expert in facial treatments and skin care with a holistic approach.'],
                    ['name' => 'Noa van den Berg',  'role' => 'Nail Stylist',       'bio' => 'Creative in nail art and specialised in gel and acrylic techniques.'],
                    ['name' => 'Fleur Mulder',      'role' => 'Massage Therapist',  'bio' => 'Brings body and mind into balance with relaxing and therapeutic massages.'],
                ]],
                'testimonials' => ['title' => 'What Customers Say',  'subtitle' => 'Experiences'],
                'contact' => ['title' => 'Contact',                'subtitle' => 'Get in touch'],
                'contact-form' => ['title' => 'Send us a message',  'subtitle' => 'Have a question? We are happy to help.'],
                'footer' => ['title' => 'Your Salon Name',         'subtitle' => 'Beauty and self-care at its best'],
            ],
        ];
    }

    // ─── Color Schemes ─────────────────────────────────────────
    private function colorSchemes(): array
    {
        return [
            'luxury' => ['primary_color' => '#C8B88A', 'secondary_color' => '#0F0F0F', 'accent_color' => '#D4C4A0', 'background_color' => '#F5F3EF', 'text_color' => '#6B6B6B', 'heading_color' => '#0F0F0F', 'navbar_background' => '#0F0F0F', 'navbar_text_color' => '#f0eeeb', 'navbar_underline_color' => '#C8B88A', 'navbar_cta_text_color' => '#ffffff'],
            'vintage' => ['primary_color' => '#8B4513', 'secondary_color' => '#3E2723', 'accent_color' => '#D2691E', 'background_color' => '#FDF5E6', 'text_color' => '#6D4C41', 'heading_color' => '#3E2723', 'navbar_background' => '#3E2723', 'navbar_text_color' => '#FDF5E6', 'navbar_underline_color' => '#8B4513', 'navbar_cta_text_color' => '#ffffff'],
            'modern' => ['primary_color' => '#2563eb', 'secondary_color' => '#1e293b', 'accent_color' => '#3b82f6', 'background_color' => '#f8fafc', 'text_color' => '#64748b', 'heading_color' => '#0f172a', 'navbar_background' => '#1e293b', 'navbar_text_color' => '#f8fafc', 'navbar_underline_color' => '#2563eb', 'navbar_cta_text_color' => '#ffffff'],
            'trendy' => ['primary_color' => '#c31bcc', 'secondary_color' => '#18181b', 'accent_color' => '#d285eb', 'background_color' => '#fafafa', 'text_color' => '#71717a', 'heading_color' => '#18181b', 'navbar_background' => '#18181b', 'navbar_text_color' => '#fafafa', 'navbar_underline_color' => '#c31bcc', 'navbar_cta_text_color' => '#ffffff'],
            'rose' => ['primary_color' => '#e11d48', 'secondary_color' => '#1f1f1f', 'accent_color' => '#fb7185', 'background_color' => '#fafafa', 'text_color' => '#737373', 'heading_color' => '#171717', 'navbar_background' => '#1f1f1f', 'navbar_text_color' => '#fafafa', 'navbar_underline_color' => '#e11d48', 'navbar_cta_text_color' => '#ffffff'],
            'beauty' => ['primary_color' => '#B5908A', 'secondary_color' => '#6E5F5B', 'accent_color' => '#E8D8D3', 'background_color' => '#FBF9F8', 'text_color' => '#8A7B76', 'heading_color' => '#6E5F5B', 'navbar_background' => '#6E5F5B', 'navbar_text_color' => '#FBF9F8', 'navbar_underline_color' => '#B5908A', 'navbar_cta_background' => '#FBF9F8', 'navbar_cta_text_color' => '#6E5F5B'],
            'peach' => ['primary_color' => '#FF6F61', 'secondary_color' => '#2B2B2B', 'accent_color' => '#FFD6C9', 'background_color' => '#FAFAFA', 'text_color' => '#6B6B6B', 'heading_color' => '#2B2B2B', 'navbar_background' => '#2B2B2B', 'navbar_text_color' => '#FAFAFA', 'navbar_underline_color' => '#FF6F61', 'navbar_cta_text_color' => '#ffffff'],
            'minimal' => ['primary_color' => '#171717', 'secondary_color' => '#0a0a0a', 'accent_color' => '#404040', 'background_color' => '#FAFAFA', 'text_color' => '#737373', 'heading_color' => '#171717', 'navbar_background' => '#0a0a0a', 'navbar_text_color' => '#FAFAFA', 'navbar_underline_color' => '#171717', 'navbar_cta_text_color' => '#ffffff'],
            'natural' => ['primary_color' => '#14b8a6', 'secondary_color' => '#1c1917', 'accent_color' => '#99f6e4', 'background_color' => '#f0f0f0', 'text_color' => '#57534e', 'heading_color' => '#1c1917', 'navbar_background' => '#1c1917', 'navbar_text_color' => '#ffffff', 'navbar_underline_color' => '#14b8a6', 'navbar_cta_background' => '#14b8a6', 'navbar_cta_text_color' => '#ffffff'],
            'ocean' => ['primary_color' => '#0077b6', 'secondary_color' => '#0d1b2a', 'accent_color' => '#48cae4', 'background_color' => '#f0f7ff', 'text_color' => '#4a6a8a', 'heading_color' => '#0d1b2a', 'navbar_background' => '#0d1b2a', 'navbar_text_color' => '#f0f7ff', 'navbar_underline_color' => '#0077b6', 'navbar_cta_text_color' => '#ffffff'],
            'forest' => ['primary_color' => '#2d6a4f', 'secondary_color' => '#1b1b1b', 'accent_color' => '#52b788', 'background_color' => '#f9faf8', 'text_color' => '#6b7280', 'heading_color' => '#1b1b1b', 'navbar_background' => '#1b1b1b', 'navbar_text_color' => '#f9faf8', 'navbar_underline_color' => '#2d6a4f', 'navbar_cta_text_color' => '#ffffff'],
            'orange' => ['primary_color' => '#f97316', 'secondary_color' => '#1c1917', 'accent_color' => '#ffedd5', 'background_color' => '#fafaf9', 'text_color' => '#78716c', 'heading_color' => '#1c1917', 'navbar_background' => '#1c1917', 'navbar_text_color' => '#fafaf9', 'navbar_underline_color' => '#f97316', 'navbar_cta_text_color' => '#ffffff'],
            'dark' => ['primary_color' => '#6366f1', 'secondary_color' => '#0f0f0f', 'accent_color' => '#818cf8', 'background_color' => '#111111', 'text_color' => '#a1a1aa', 'heading_color' => '#f4f4f5', 'navbar_background' => '#0a0a0a', 'navbar_text_color' => '#f4f4f5', 'navbar_underline_color' => '#6366f1', 'navbar_cta_text_color' => '#ffffff'],
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
            ['section_type' => 'contact-form', 'order' => 15, 'content' => $defaults['contact-form'] ?? ['title' => 'Send us a message', 'subtitle' => 'Have a question? We are happy to help.']],
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
            ['label' => 'About',      'target' => '#about',        'icon' => null, 'is_active' => true],
            ['label' => 'Services',   'target' => '#services',     'icon' => null, 'is_active' => true],
            ['label' => 'Reviews',    'target' => '#testimonials', 'icon' => null, 'is_active' => true],
            ['label' => 'Contact',    'target' => '#contact',      'icon' => null, 'is_active' => true],
        ];
    }
}
