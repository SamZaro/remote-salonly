# Template & Color Scheme Systeem — Volledige Analyse

## 1. Architectuur Overzicht

```
┌──────────────────────────────────────────────────────────────┐
│                    ADMIN PANEL (Filament)                     │
│  TemplateFormSchema → color_scheme, theme_config, nav_items  │
└───────────────────────────┬──────────────────────────────────┘
                            │ saves to DB
                            ▼
┌──────────────────────────────────────────────────────────────┐
│                    DATABASE (JSON columns)                    │
│  Template.theme_config    │  Template.navigation_items       │
│  TemplateSection.content  │  SiteSettings.template_config    │
└───────────────────────────┬──────────────────────────────────┘
                            │ loaded by
                            ▼
┌──────────────────────────────────────────────────────────────┐
│                    TemplateService                            │
│  getTheme() = merge(defaults, template, site_settings)       │
│  resolveSectionView() = template-specific → fallback         │
└───────────────────────────┬──────────────────────────────────┘
                            │ passes to
                            ▼
┌──────────────────────────────────────────────────────────────┐
│                    BLADE VIEWS                                │
│  @props(['content', 'theme', 'section'])                     │
│  $theme['primary_color'], $theme['navbar_background'], etc.  │
└──────────────────────────────────────────────────────────────┘
```

---

## 2. Models

### Template (`app/Models/Template.php`)

| Field | Type | Purpose |
|---|---|---|
| `category_id` | bigint FK | Link naar Category |
| `name` | string | Weergavenaam |
| `slug` | string (unique) | Identifier (bijv. `projecto`) |
| `description` | string | Beschrijving |
| `theme_config` | JSON → array | Alle kleuren, fonts, navbar instellingen |
| `navigation_items` | JSON → array | Menu structuur |
| `default_config` | JSON → array | Key-value configuratie |
| `sort_order` | integer | Volgorde |
| `is_active` | boolean | Zichtbaarheid |

**Relaties:** `category()` BelongsTo, `sections()` HasMany, `activeSections()` HasMany (active + ordered)
**Media:** `preview`, `logo`, `favicon` collections

### TemplateSection (`app/Models/TemplateSection.php`)

| Field | Type | Purpose |
|---|---|---|
| `template_id` | bigint FK | Link naar Template |
| `section_type` | string | Type (hero, about, services, etc.) |
| `order` | integer | Volgorde op pagina |
| `content` | JSON → array | Sectie-specifieke data (title, items, etc.) |
| `is_active` | boolean | Zichtbaarheid |

**Media:** `background` (single), `images` (multiple), `slider_images` (max 6)

### SiteSettings (`app/Settings/SiteSettings.php` — Spatie Laravel Settings)

| Property | Type | Purpose |
|---|---|---|
| `site_name` | string | Site naam |
| `logo` | ?string | Logo referentie |
| `template_slug` | ?string | Actieve template identifier |
| `template_config` | ?array | Site-specifieke overrides |

---

## 3. Theme Config Merge Prioriteit

```
1. TemplateService::getDefaultTheme()     ← baseline
2. Template->theme_config                  ← template-specifiek (uit DB)
3. SiteSettings->template_config           ← site-specifieke overrides
```

Elke laag overschrijft de vorige via `array_merge()`.

### Default Theme (`TemplateService::getDefaultTheme()`)

```php
[
    'primary_color'        => '#3b82f6',
    'secondary_color'      => '#64748b',
    'accent_color'         => '#f59e0b',
    'background_color'     => '#ffffff',
    'text_color'           => '#1f2937',
    'heading_color'        => '#111827',
    'font_family'          => 'Inter',
    'heading_font_family'  => 'Poppins',
    'font_size_base'       => '16px',
    'navbar_background'    => '#ffffff',
    'navbar_text_color'    => '#111827',
    'navbar_sticky'        => true,
    'navbar_transparent'   => false,
]
```

---

## 4. Color Scheme Systeem

### Beschikbare Schemes (`TemplateFormSchema::getColorSchemes()`)

| Scheme | Primary | Secondary | Accent | Background | Text | Heading | Navbar BG | Navbar Text | Navbar Underline |
|---|---|---|---|---|---|---|---|---|---|
| **custom** | — | — | — | — | — | — | — | — | — |
| **luxury** | `#C8B88A` | `#0F0F0F` | `#D4C4A0` | `#F5F3EF` | `#6B6B6B` | `#0F0F0F` | `#0F0F0F` | `#C8B88A` | `#C8B88A` |
| **vintage** | `#8B4513` | `#3E2723` | `#D2691E` | `#FDF5E6` | `#6D4C41` | `#3E2723` | `#3E2723` | `#FDF5E6` | `#8B4513` |
| **modern** | `#2563eb` | `#1e293b` | `#3b82f6` | `#f8fafc` | `#64748b` | `#0f172a` | `#1e293b` | `#f8fafc` | `#2563eb` |
| **trendy** | `#8b5cf6` | `#18181b` | `#a78bfa` | `#fafafa` | `#71717a` | `#18181b` | `#18181b` | `#fafafa` | `#8b5cf6` |
| **natural** | `#14b8a6` | `#1c1917` | `#99f6e4` | `#44403c` | `#78716c` | `#1c1917` | `#1c1917` | `#fafaf9` | `#14b8a6` |
| **rose** | `#e11d48` | `#1f1f1f` | `#fb7185` | `#fafafa` | `#737373` | `#171717` | `#1f1f1f` | `#fafafa` | `#e11d48` |
| **beauty** | `#E8D8D3` | `#6E5F5B` | `#F2E7E4` | `#FBF9F8` | `#8A7B76` | `#6E5F5B` | `#6E5F5B` | `#FBF9F8` | `#E8D8D3` |
| **peach** | `#FF6F61` | `#2B2B2B` | `#FFD6C9` | `#FAFAFA` | `#6B6B6B` | `#2B2B2B` | `#2B2B2B` | `#FAFAFA` | `#FF6F61` |
| **minimal** | `#171717` | `#0a0a0a` | `#404040` | `#FAFAFA` | `#737373` | `#171717` | `#0a0a0a` | `#FAFAFA` | `#171717` |
| **ocean** | `#0077b6` | `#0d1b2a` | `#48cae4` | `#f0f7ff` | `#4a6a8a` | `#0d1b2a` | `#0d1b2a` | `#f0f7ff` | `#0077b6` |
| **forest** | `#2d6a4f` | `#1b1b1b` | `#52b788` | `#f9faf8` | `#6b7280` | `#1b1b1b` | `#1b1b1b` | `#f9faf8` | `#2d6a4f` |
| **dark** | `#6366f1` | `#0f0f0f` | `#818cf8` | `#111111` | `#a1a1aa` | `#f4f4f5` | `#0a0a0a` | `#f4f4f5` | `#6366f1` |

> **Opmerking:** De `beauty` scheme heeft in de TemplateSeeder afwijkende waarden (`primary_color: #B5908A`, `accent_color: #E8D8D3`). De TemplateFormSchema is leidend voor het admin-formulier.

### Color Role Definities

| Key | Rol | Typisch gebruik in Blade |
|---|---|---|
| `primary_color` | Hoofd-accent | Buttons, highlights, decoratieve elementen, icon achtergronden |
| `secondary_color` | Donker/contrast | Donkere secties, card achtergronden, hero overlay |
| `accent_color` | Secundair accent | Hover states, gradient stops, subtiele accenten |
| `background_color` | Lichte achtergrond | Sectie achtergronden (about, services, etc.) |
| `text_color` | Body tekst | Paragrafen, beschrijvingen |
| `heading_color` | Heading tekst | H1-H6 titels |
| `navbar_background` | Navbar achtergrond | Fallback: `secondary_color` |
| `navbar_text_color` | Navbar tekst/logo | Fallback: `primary_color` |
| `navbar_underline_color` | Actieve link underline | Fallback: `primary_color` |

### Hoe `color_scheme` werkt

1. **Opslaan:** Wanneer een gebruiker een scheme selecteert in admin, worden alle scheme-kleuren toegepast op de individuele color fields EN wordt `color_scheme` opgeslagen in `theme_config`
2. **Detectie:** `detectActiveScheme()` vergelijkt `primary_color`, `secondary_color`, `accent_color` (case-insensitive) met alle schemes
3. **Hydration:** Bij het laden van het formulier wordt eerst `theme_config.color_scheme` gecheckt, daarna `detectActiveScheme()` als fallback

---

## 5. View Resolutie (Fallback Systeem)

```
1. components/templates/{template-slug}/{section-type}   ← template-specifiek
2. components/sections/{section-type}                     ← default fallback
3. components/sections/default                            ← ultieme fallback
```

### Beschikbare Section Types

`hero`, `about`, `services`, `testimonials`, `contact`, `footer`, `gallery`, `pricing`, `slider`, `accordion`, `faq`, `content`, `jumbotron`, `portfolio`, `features`, `parallax`, `team`, `cta`

### Blade View Props (standaard voor elke sectie)

```php
@props([
    'content' => [],    // Uit TemplateSection.content (JSON)
    'theme' => [],      // Merged theme config
    'section' => null,  // TemplateSection model (voor media)
])
```

### Hoe secties kleuren gebruiken (voorbeeld)

```php
// In elke sectie blade:
$primaryColor     = $theme['primary_color'] ?? '#f59e0b';
$secondaryColor   = $theme['secondary_color'] ?? '#1f2937';
$textColor        = $theme['text_color'] ?? '#333333';
$headingColor     = $theme['heading_color'] ?? $textColor;
$backgroundColor  = $theme['background_color'] ?? '#ffffff';

// Toegepast via inline styles:
style="background-color: {{ $backgroundColor }};"
style="color: {{ $primaryColor }};"
```

---

## 6. Navbar Systeem

**File:** `resources/views/components/partials/navbar.blade.php`

### Color Logica

```php
$navbarBg    = $theme['navbar_background']      ?? $theme['secondary_color'] ?? '#ffffff';
$navbarText  = $theme['navbar_text_color']      ?? $theme['primary_color']   ?? '#111827';
$underline   = $theme['navbar_underline_color'] ?? $theme['primary_color']   ?? '#3b82f6';
$isSticky    = $theme['navbar_sticky']          ?? true;
$isTransparent = $theme['navbar_transparent']   ?? false;
```

### Features

- Alpine.js: scroll detectie, mobile menu toggle, responsive breakpoint (1024px)
- Logo: text-based of image (uit media library), fallback naar template name/app name
- Navbar variant: `default` of `centered` (via `theme_config.navbar.variant`)
- Booking integratie: Livewire component in navbar

---

## 7. Template Toewijzingen (Seeder)

| Template | Categorie | Color Scheme | Font Family | Heading Font |
|---|---|---|---|---|
| **wave** | kapsalons | `ocean` | Poppins | Playfair Display |
| **icon** | kapsalons | `vintage` | Montserrat | Cormorant Garamond |
| **nova** | kapsalons | `trendy` | Inter | Outfit |
| **pure** | kapsalons | `minimal` | DM Sans | DM Serif Display |
| **studio** | kapsalons | `rose` | Nunito | Abril Fatface |
| **barbero** | barbershops | `luxury` | Roboto | Oswald |
| **razor** | barbershops | `vintage` | Barlow | Bebas Neue |
| **shadow** | barbershops | `minimal` | Inter | Inter |
| **blossom** | schoonheidssalons | `beauty` | Lato | Playfair Display |
| **essence** | schoonheidssalons | `luxury` | Source Sans 3 | Cormorant |

### Categories (CategorySeeder)

| Slug | Naam | Icon |
|---|---|---|
| `kapsalons` | Kapsalons | heroicon-o-scissors |
| `barbershops` | Barbershops | heroicon-o-scissors |
| `schoonheidssalons` | Schoonheidssalons | heroicon-o-sparkles |

### Standaard Secties per Template (15 stuks, order 1-15)

| Order | Section Type | Inhoud |
|---|---|---|
| 1 | `hero` | Titel, subtitel, CTA button + URL |
| 2 | `slider` | Titel, subtitel |
| 3 | `about` | Titel, subtitel, beschrijving |
| 4 | `features` | Titel, subtitel |
| 5 | `jumbotron` | Titel, subtitel |
| 6 | `services` | Titel, subtitel |
| 7 | `gallery` | Titel, subtitel |
| 8 | `pricing` | Titel, subtitel |
| 9 | `parallax` | Titel, subtitel |
| 10 | `team` | Titel, subtitel |
| 11 | `accordion` | Titel, subtitel |
| 12 | `cta` | Titel, subtitel, CTA button + URL |
| 13 | `testimonials` | Titel, subtitel |
| 14 | `contact` | Titel, subtitel |
| 15 | `footer` | Titel, subtitel |

Section defaults (titles/descriptions) zijn per categorie geconfigureerd in `TemplateSeeder::sectionDefaults()`.

### Standaard Navigatie (alle templates)

```php
['label' => 'Home',       'target' => '#hero',         'icon' => null, 'is_active' => true],
['label' => 'Over Ons',   'target' => '#about',        'icon' => null, 'is_active' => true],
['label' => 'Diensten',   'target' => '#services',     'icon' => null, 'is_active' => true],
['label' => 'Reviews',    'target' => '#testimonials', 'icon' => null, 'is_active' => true],
['label' => 'Contact',    'target' => '#contact',      'icon' => null, 'is_active' => true],
```

---

## 8. Data Flow: Request → Rendered Page

```
GET / (HomeController::index)
  │
  ├─ TemplateService::getActiveTemplate()
  │   └─ SiteSettings.template_slug → Template::where('slug')->with('sections')
  │      └─ Cached 1 uur
  │
  ├─ TemplateService::getTheme()
  │   └─ array_merge(defaults, template.theme_config, site.template_config)
  │
  ├─ TemplateService::getSections()
  │   └─ activeSections (is_active=true, ordered by order)
  │
  ├─ TemplateService::getNavigationItems()
  │   └─ Filter is_active, transform label/target → title/slug
  │
  └─ view('home', [template, sections, theme, navigation])
      │
      ├─ navbar partial → $theme (navbar_background, navbar_text_color, etc.)
      │
      └─ foreach $sections:
          └─ resolveSectionView($type, $slug)
              ├─ 1st: templates/{slug}/{type}.blade.php
              ├─ 2nd: sections/{type}.blade.php
              └─ 3rd: sections/default.blade.php
                  └─ @props(['content', 'theme', 'section'])
```

---

## 9. Provisioning (API)

**Route:** `POST /api/provision-template`
**Header:** `X-Provision-Token`

Stelt `template_slug` en optioneel `template_config` in via SiteSettings. Cleared cache na provisioning.

---

## 10. Key Files Referentie

| Doel | File |
|---|---|
| Template model | `app/Models/Template.php` |
| Section model | `app/Models/TemplateSection.php` |
| Template service | `app/Services/TemplateService.php` |
| Form schema (admin) | `app/Filament/Schemas/TemplateFormSchema.php` |
| Site settings | `app/Settings/SiteSettings.php` |
| Homepage controller | `app/Http/Controllers/HomeController.php` |
| Homepage view | `resources/views/home.blade.php` |
| Navbar partial | `resources/views/components/partials/navbar.blade.php` |
| Template views | `resources/views/components/templates/{slug}/` |
| Default section views | `resources/views/components/sections/` |
| Template seeder | `database/seeders/TemplateSeeder.php` |
| Category seeder | `database/seeders/CategorySeeder.php` |
| Provisioning | `app/Http/Controllers/ProvisionController.php` |
