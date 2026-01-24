# Filament 4.x - Custom Styling

> Documentatie voor Claude Code - Gebaseerd op officiële Filament 4.x docs  
> Bronnen: https://filamentphp.com/docs/4.x/styling/

---

## Overzicht

Filament gebruikt Tailwind CSS en biedt uitgebreide mogelijkheden voor styling-aanpassingen via:
- Panel configuratie (kleuren, fonts, logo's)
- CSS hook classes
- Custom themes
- Icon management

---

## Kleuren Configureren

### Standaard Kleuren in Panel Provider

```php
use Filament\Panel;
use Filament\Support\Colors\Color;

public function panel(Panel $panel): Panel
{
    return $panel
        ->colors([
            'danger' => Color::Rose,
            'gray' => Color::Gray,
            'info' => Color::Blue,
            'primary' => Color::Indigo,
            'success' => Color::Emerald,
            'warning' => Color::Orange,
        ]);
}
```

### Beschikbare Tailwind Kleuren

De `Color` class bevat alle Tailwind CSS kleuren:
- `Color::Slate`, `Color::Gray`, `Color::Zinc`, `Color::Neutral`, `Color::Stone`
- `Color::Red`, `Color::Orange`, `Color::Amber`, `Color::Yellow`, `Color::Lime`
- `Color::Green`, `Color::Emerald`, `Color::Teal`, `Color::Cyan`, `Color::Sky`
- `Color::Blue`, `Color::Indigo`, `Color::Violet`, `Color::Purple`, `Color::Fuchsia`
- `Color::Pink`, `Color::Rose`

### Kleur Genereren vanuit Hex/RGB

```php
$panel
    ->colors([
        'primary' => '#6366f1',
    ])

// Of met RGB:
$panel
    ->colors([
        'primary' => 'rgb(99, 102, 241)',
    ])
```

### Custom OKLCH Palette

```php
$panel
    ->colors([
        'primary' => [
            50 => 'oklch(0.969 0.015 12.422)',
            100 => 'oklch(0.941 0.03 12.58)',
            200 => 'oklch(0.892 0.058 10.001)',
            300 => 'oklch(0.81 0.117 11.638)',
            400 => 'oklch(0.712 0.194 13.428)',
            500 => 'oklch(0.645 0.246 16.439)',
            600 => 'oklch(0.586 0.253 17.585)',
            700 => 'oklch(0.514 0.222 16.935)',
            800 => 'oklch(0.455 0.188 13.697)',
            900 => 'oklch(0.41 0.159 10.272)',
            950 => 'oklch(0.271 0.105 12.094)',
        ],
    ])
```

### Kleuren Registreren via FilamentColor Facade

Vanuit een service provider's `boot()` method:

```php
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

FilamentColor::register([
    'danger' => Color::Red,
    'gray' => Color::Zinc,
    'info' => Color::Blue,
    'primary' => Color::Amber,
    'success' => Color::Green,
    'warning' => Color::Amber,
]);
```

### Extra Kleuren Toevoegen

```php
FilamentColor::register([
    'secondary' => Color::Indigo,
]);
```

Nu kan `'secondary'` als kleur worden gebruikt in elk Filament component.

### Kleuren Gebruiken in Components

```php
use Filament\Actions\Action;
use Filament\Forms\Components\Toggle;

Action::make('proceed')
    ->color('success')
    
Toggle::make('is_active')
    ->onColor('success')
```

In Blade:
```blade
<x-filament::badge color="success">
    Active
</x-filament::badge>
```

---

## Fonts Configureren

### Google Font Instellen

```php
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        ->font('Poppins');
}
```

### Font Provider Wijzigen

**Bunny Fonts (standaard, GDPR-compliant):**
```php
// Standaard, geen extra config nodig
```

**Google Fonts:**
```php
use Filament\FontProviders\GoogleFontProvider;

$panel->font('Inter', provider: GoogleFontProvider::class)
```

**Lokale Fonts:**
```php
use Filament\FontProviders\LocalFontProvider;

$panel->font(
    'Inter',
    url: asset('css/fonts.css'),
    provider: LocalFontProvider::class,
)
```

---

## Custom Theme Maken

### Theme Genereren

```bash
php artisan make:filament-theme
```

Voor specifiek panel:
```bash
php artisan make:filament-theme admin
```

Met andere package manager:
```bash
php artisan make:filament-theme --pm=bun
```

### Handmatige Configuratie

**1. Vite config (`vite.config.js`):**
```javascript
input: [
    // ...
    'resources/css/filament/admin/theme.css',
]
```

**2. Panel provider registreren:**
```php
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        ->viteTheme('resources/css/filament/admin/theme.css');
}
```

**3. Compileren:**
```bash
npm run build
```

### @source Directives voor Tailwind

In `theme.css` kun je directories toevoegen waar Tailwind classes worden gescand:

```css
@source '../../../../app/Filament';
@source '../../../../resources/views/filament';
@source '../../../../resources/views/components';
@source '../../../../resources/views/livewire';
@source '../../../../app/Livewire';
```

> **Let op:** Custom theme is VEREIST om Tailwind classes te gebruiken in eigen Blade views!

---

## Dark Mode

### Uitschakelen

```php
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        ->darkMode(false);
}
```

### Default Theme Mode

```php
use Filament\Enums\ThemeMode;
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        ->defaultThemeMode(ThemeMode::Light); // of ThemeMode::Dark
}
```

---

## Logo & Branding

### Brand Name

```php
$panel->brandName('Filament Demo');
```

### Logo URL

```php
$panel->brandLogo(asset('images/logo.svg'));
```

### Logo via Blade View

```php
$panel->brandLogo(fn () => view('filament.admin.logo'));
```

```blade
{{-- resources/views/filament/admin/logo.blade.php --}}
<svg
    viewBox="0 0 128 26"
    xmlns="http://www.w3.org/2000/svg"
    class="h-full fill-gray-500 dark:fill-gray-400"
>
    <!-- ... -->
</svg>
```

### Dark Mode Logo

```php
$panel->darkModeBrandLogo(asset('images/logo-dark.svg'));
```

### Logo Hoogte

```php
$panel
    ->brandLogo(fn () => view('filament.admin.logo'))
    ->brandLogoHeight('2rem');
```

### Favicon

```php
$panel->favicon(asset('images/favicon.png'));
```

---

## CSS Hook Classes

### Concept

Filament gebruikt CSS "hook" classes (prefix: `fi-`) om elementen te targeten zonder Blade views te publiceren.

### Vinden van Hook Classes

Gebruik browser DevTools om elementen te inspecteren. Alle hooks beginnen met `fi-`.

### Styling Toepassen

**Pure CSS:**
```css
.fi-sidebar {
    background-color: #fafafa;
}
```

**Met Tailwind @apply:**
```css
.fi-sidebar {
    @apply bg-gray-50 dark:bg-gray-950;
}
```

**Met !important (spaarzaam gebruiken):**
```css
.fi-sidebar {
    @apply bg-gray-50 dark:bg-gray-950 !important;
}

/* Of per class: */
.fi-sidebar {
    @apply !bg-gray-50 dark:!bg-gray-950;
}
```

### Hook Class Afkortingen

| Prefix | Betekenis |
|--------|-----------|
| `fi-` | Filament |
| `fi-ac-` | Actions package |
| `fi-fo-` | Forms package |
| `fi-in-` | Infolists package |
| `fi-no-` | Notifications package |
| `fi-sc-` | Schema package |
| `fi-ta-` | Tables package |
| `fi-wi-` | Widgets package |
| `btn` | button |
| `col` | column |
| `ctn` | container |
| `wrp` | wrapper |

### Blade Views Publiceren (NIET AANBEVOLEN)

Publiceer alleen als CSS hooks niet voldoende zijn en lock dan Filament versies in `composer.json`.

---

## Icons

### Heroicons (Standaard)

```php
use Filament\Support\Icons\Heroicon;

Action::make('star')
    ->icon(Heroicon::OutlinedStar)
    
Toggle::make('is_starred')
    ->onIcon(Heroicon::Star)
```

Varianten:
- `Heroicon::Star` - Solid
- `Heroicon::OutlinedStar` - Outlined

In Blade:
```blade
@php
    use Filament\Support\Icons\Heroicon;
@endphp

<x-filament::badge :icon="Heroicon::Star">
    Star
</x-filament::badge>
```

### Andere Icon Sets

Na installatie van een Blade Icons package:

```php
Action::make('star')
    ->icon('iconic-star')
```

In Blade:
```blade
<x-filament::badge icon="iconic-star">
    Star
</x-filament::badge>
```

### Custom SVG Icons

**1. Publiceer config:**
```bash
php artisan vendor:publish --tag=blade-icons
```

**2. Uncomment `default` set in `config/blade-icons.php`**

**3. Plaats SVGs in `resources/svg/`**

**4. Gebruik:**
```php
Action::make('star')
    ->icon('icon-star') // voor resources/svg/star.svg
```

### Default Icons Vervangen

```php
use Filament\Support\Facades\FilamentIcon;
use Filament\View\PanelsIconAlias;

FilamentIcon::register([
    PanelsIconAlias::GLOBAL_SEARCH_FIELD => 'fas-magnifying-glass',
    PanelsIconAlias::SIDEBAR_GROUP_COLLAPSE_BUTTON => view('icons.chevron-up'),
]);
```

### Icon Aliases per Package

#### Actions (`Filament\Actions\View\ActionsIconAlias`)
- `ACTION_GROUP` - Trigger button action group
- `CREATE_ACTION_GROUPED` - Grouped create action
- `DELETE_ACTION` - Delete action button
- `DELETE_ACTION_MODAL` - Delete action modal
- `EDIT_ACTION` - Edit action button
- `MODAL_CONFIRMATION` - Confirmation modal
- `VIEW_ACTION` - View action button

#### Forms (`Filament\Forms\View\FormsIconAlias`)
- `COMPONENTS_BUILDER_ACTIONS_CLONE` - Builder clone
- `COMPONENTS_BUILDER_ACTIONS_DELETE` - Builder delete
- `COMPONENTS_BUILDER_ACTIONS_REORDER` - Builder reorder
- `COMPONENTS_REPEATER_ACTIONS_*` - Repeater actions
- `COMPONENTS_SELECT_ACTIONS_CREATE_OPTION` - Select create
- `COMPONENTS_TEXT_INPUT_ACTIONS_SHOW_PASSWORD` - Show password

#### Tables (`Filament\Tables\View\TablesIconAlias`)
- `ACTIONS_FILTER` - Filter action
- `ACTIONS_COLUMN_MANAGER` - Column manager
- `EMPTY_STATE` - Empty state
- `SEARCH_FIELD` - Search input
- `HEADER_CELL_SORT_*` - Sort buttons
- `REORDER_HANDLE` - Drag handle

#### Panels (`Filament\View\PanelsIconAlias`)
- `GLOBAL_SEARCH_FIELD` - Global search
- `SIDEBAR_COLLAPSE_BUTTON` - Sidebar collapse
- `SIDEBAR_GROUP_COLLAPSE_BUTTON` - Group collapse
- `THEME_SWITCHER_*` - Theme buttons
- `USER_MENU_*` - User menu items

#### Notifications (`Filament\Notifications\View\NotificationsIconAlias`)
- `NOTIFICATION_SUCCESS` - Success notification
- `NOTIFICATION_WARNING` - Warning notification
- `NOTIFICATION_DANGER` - Danger notification
- `NOTIFICATION_INFO` - Info notification
- `NOTIFICATION_CLOSE_BUTTON` - Close button

#### Support/UI (`Filament\Support\View\SupportIconAlias`)
- `MODAL_CLOSE_BUTTON` - Modal close
- `PAGINATION_*` - Pagination buttons
- `SECTION_COLLAPSE_BUTTON` - Section collapse
- `BREADCRUMBS_SEPARATOR` - Breadcrumb separator

---

## Praktische Voorbeelden

### Complete Panel Styling Setup

```php
// app/Providers/Filament/AdminPanelProvider.php

use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Enums\ThemeMode;

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        
        // Kleuren
        ->colors([
            'primary' => Color::Indigo,
            'danger' => Color::Rose,
            'gray' => Color::Slate,
            'info' => Color::Sky,
            'success' => Color::Emerald,
            'warning' => Color::Amber,
        ])
        
        // Font
        ->font('Inter')
        
        // Branding
        ->brandName('Mijn App')
        ->brandLogo(asset('images/logo.svg'))
        ->darkModeBrandLogo(asset('images/logo-dark.svg'))
        ->brandLogoHeight('2rem')
        ->favicon(asset('images/favicon.png'))
        
        // Theme
        ->defaultThemeMode(ThemeMode::Light)
        ->viteTheme('resources/css/filament/admin/theme.css');
}
```

### Custom Theme CSS

```css
/* resources/css/filament/admin/theme.css */

@import '/vendor/filament/filament/resources/css/theme.css';

@source '../../../../app/Filament';
@source '../../../../resources/views/filament';
@source '../../../../resources/views/components';

/* Custom sidebar styling */
.fi-sidebar {
    @apply bg-slate-900;
}

/* Custom topbar */
.fi-topbar {
    @apply border-b border-slate-200 dark:border-slate-700;
}

/* Custom buttons */
.fi-btn-primary {
    @apply shadow-lg;
}

/* Custom form inputs */
.fi-fo-text-input {
    @apply rounded-lg;
}

/* Custom table headers */
.fi-ta-header-cell {
    @apply font-semibold uppercase text-xs;
}
```

### Extra Kleuren Registreren (Service Provider)

```php
// app/Providers/AppServiceProvider.php

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

public function boot(): void
{
    FilamentColor::register([
        'brand' => Color::Violet,
        'accent' => Color::Fuchsia,
        'neutral' => Color::Stone,
    ]);
}
```

### Custom Icons Registreren

```php
// app/Providers/AppServiceProvider.php

use Filament\Support\Facades\FilamentIcon;
use Filament\View\PanelsIconAlias;
use Filament\Tables\View\TablesIconAlias;

public function boot(): void
{
    FilamentIcon::register([
        PanelsIconAlias::GLOBAL_SEARCH_FIELD => 'heroicon-o-magnifying-glass-circle',
        TablesIconAlias::EMPTY_STATE => 'heroicon-o-inbox',
        TablesIconAlias::ACTIONS_FILTER => 'heroicon-o-funnel',
    ]);
}
```

---

## Best Practices

1. **Gebruik CSS hooks** in plaats van Blade views te publiceren
2. **Maak altijd een custom theme** als je Tailwind classes in eigen code gebruikt
3. **Gebruik `@apply`** voor Tailwind-consistente styling
4. **Vermijd `!important`** waar mogelijk
5. **Registreer kleuren centraal** via `FilamentColor::register()`
6. **Lock versies** als je toch Blade views publiceert
7. **Test dark mode** bij alle custom styling

---

## Referenties

- [Styling Overview](https://filamentphp.com/docs/4.x/styling/overview)
- [CSS Hooks](https://filamentphp.com/docs/4.x/styling/css-hooks)
- [Colors](https://filamentphp.com/docs/4.x/styling/colors)
- [Icons](https://filamentphp.com/docs/4.x/styling/icons)
- [Panel Configuration](https://filamentphp.com/docs/4.x/panel-configuration)
- [Tailwind CSS Colors](https://tailwindcss.com/docs/customizing-colors)
- [Blade Icons](https://blade-ui-kit.com/blade-icons)
