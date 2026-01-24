# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

OAAS-Small (Onepager As A Service) is a Laravel-based application built with the TALL stack (Tailwind, Alpine.js, Laravel, Livewire). It provides a foundation for building one-page websites using a dynamic template system. The application includes a comprehensive admin panel powered by Filament, user dashboard, OAuth authentication, and two-factor authentication.

## Tech Stack
- Laravel 12 (streamlined structure)
- Livewire 3 (namespace: `App\Livewire`, `wire:model.live` for real-time)
- Filament 4 (admin + tenant dashboard)
- Tailwind 4 (`@import "tailwindcss"`, gebruik `bg-black/*` ipv `bg-opacity-*`)
- Laravel Boost integratie

## Belangrijke Commands

```bash
# Development
npm run dev                  # Vite dev server
php artisan test --filter=   # Run specifieke test (altijd na wijzigingen)
./vendor/bin/pint --dirty    # Code formatting (verplicht voor commit)

# Platform issues (ext-pcntl, ext-sockets)
composer install --ignore-platform-reqs --no-interaction --no-scripts --prefer-dist

# Filament resources
php artisan make:filament-resource ResourceName --panel=admin
php artisan make:filament-resource ResourceName --panel=dashboard
```

## Development Commands

### Setup and Installation
```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
```

### Development
```bash
# Start development server
php artisan serve

# Start Vite development server
npm run dev

# Build assets for production
npm run build

# Start queue worker with Horizon
php artisan horizon

# Interact with application via REPL
php artisan tinker
```

### Testing
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run specific test file
php artisan test tests/Feature/FeatureTest.php

# Run tests with coverage
php artisan test --coverage
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Run static analysis with Larastan
./vendor/bin/phpstan analyse
```

### Database
```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Refresh database with seeders
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name
```

### Cache Management
```bash
# Clear all caches
php artisan optimize:clear

# Cache config, routes, and views for performance
php artisan optimize

# Export app configs from database to cache
php artisan app:export-configs
```

### Custom Artisan Commands
```bash
# Create admin user
php artisan app:create-admin-user

# Generate sitemap
php artisan app:generate-sitemap

# Encrypt app configs stored in database
php artisan app:encrypt-configs
```

### Deployment
```bash
# Deploy using Deployer (configure deploy.php first)
vendor/bin/dep deploy
```

## Architecture Overview

### Core Directory Structure

- **app/Services/** - Business logic layer
  - `AddressService` - Address management
  - `AnnouncementService` - Site-wide announcements
  - `ConfigService` - Dynamic configuration access
  - `LoginService` - Authentication handling
  - `OneTimePasswordService` - OTP/2FA functionality
  - `SessionService` - Session management
  - `UserService` - User management operations
  - `UserVerificationService` - User verification flows
- **app/Filament/** - Filament panels and resources
  - **Admin/** - Backend admin panel (Dashboard, Resources, Settings)
  - **Dashboard/** - Customer-facing user dashboard
- **app/Models/** - Eloquent models
- **app/Livewire/** - Livewire components

### Key Models

- **User** - User accounts with roles and permissions
- **Template** - Template metadata (slug, name, theme_config, navigation_items)
- **TemplateSection** - Template sections (section_type, order, content, is_active)
- **Announcement** - Site-wide announcement banners
- **Config** - Dynamic configuration storage
- **Address** - User addresses
- **OauthLoginProvider** - OAuth social login providers
- **VerificationProvider** - User verification methods
- **EmailProvider** - Email sending configuration
- **UserParameter** - Additional user parameters

### Template-Based Homepage System

The application uses a dynamic template system for the homepage. Templates are managed in the database and provisioned from the main application (webthema-onepager).

#### Template Structure

- **Template Model** - Defines template metadata (slug, name, theme_config, navigation_items)
- **TemplateSection Model** - Defines sections within a template (section_type, order, content, is_active)
- **TemplateService** - Core service for loading and rendering templates

#### Template Views

Template-specific views are located in:
```
resources/views/components/templates/{template-slug}/
```

Each template can have sections like:
- `hero.blade.php`
- `about.blade.php`
- `services.blade.php`
- `pricing.blade.php`
- `contact.blade.php`

#### View Resolution

The TemplateService uses a fallback system:
1. Template-specific: `components.templates.{slug}.{section-type}`
2. Default fallback: `components.sections.{section-type}`

#### Provisioning

Templates are provisioned via the `/api/provision-template` endpoint:
- Sets `template_slug` in SiteSettings
- Stores `template_config` for customization
- Clears template cache

#### Navigation

Navigation items are stored in the `navigation_items` JSON column on the Template model. Each item has:
- `title` - Display text
- `slug` - Section ID for anchor links (#hero, #about, etc.)
- `is_active` - Whether to show in nav

#### Theme Configuration

Theme config is merged in this priority:
1. Default theme (defined in TemplateService)
2. Template theme_config (from database)
3. Site-specific template_config (from SiteSettings)

### Filament Admin Panel

The admin panel uses Filament 4 resources following this pattern:

#### Resources (app/Filament/Admin/Resources/)
- **AnnouncementResource** - Manage site announcements
- **UserResource** - User management

#### Settings Pages (app/Filament/Admin/Pages/)
- **GeneralSettings** - General application settings
- **SiteSettings** - Site name, logo, branding
- **AuthSettings** - Authentication settings
- **TwoFactorSettings** - 2FA configuration
- **MailSettings** - Email configuration
- **SocialLoginSettings** - OAuth providers setup

Use `CrudDefaults` and `ListDefaults` traits for consistent Filament resource configuration.

### Filament Dashboard Panel

User-facing dashboard located in `app/Filament/Dashboard/`:
- **Pages/Profile** - User profile management

### Service Layer Pattern

Business logic is encapsulated in service classes rather than controllers or models:

- **ConfigService** - Access dynamic configuration from database with caching
- **UserService** - User CRUD operations and management
- **LoginService** - Authentication logic
- **OneTimePasswordService** - OTP generation and verification
- **UserVerificationService** - User verification workflows
- **SessionService** - Session management
- **AnnouncementService** - Announcement retrieval and display
- **AddressService** - Address management

Controllers should remain thin and delegate to services.
## Reference Docs (On-Demand)

Voor gedetailleerde informatie, zie:

**Core Framework & Best Practices**:
- `docs/laravel-boost.md` - Volledige Laravel/Livewire/Filament/PHP/Tailwind best practices

**Livewire 3.x Specifics** (modulair - laad alleen wat je nodig hebt):
- `docs/livewire/README.md` - Overzicht, gebruik scenario's, quick lookup guide
- `docs/livewire/livewire-core.md` (~300 regels) - Component essentials, properties, actions, lifecycle
- `docs/livewire/livewire-forms.md` (~270 regels) - Forms, validatie, file uploads, multi-step
- `docs/livewire/livewire-advanced.md` (~350 regels) - Events, Alpine integratie, JS API, pagination, lazy loading
- `docs/livewire/livewire-directives.md` (~280 regels) - Complete wire:* directive reference, modifiers
- `docs/livewire/livewire-patterns.md` (~350 regels) - UI patterns (modal, search, tabs), testing, troubleshooting

**Filament 4.x Specifics** (modulair - 70-85% token besparing):
- `docs/filament/README.md` - Overzicht, gebruik scenario's, best practices, troubleshooting, learning path
- `docs/filament/filament-core.md` (~450 regels) - Resources, CRUD operations, Navigation, Authorization, Policies
- `docs/filament/filament-tables.md` (~400 regels) - Columns, Filters, Actions, Layout, Grouping, Query optimization
- `docs/filament/filament-forms.md` (~450 regels) - Form Fields, Validation, Schemas, Layouts, Conditional fields
- `docs/filament/filament-forms-validation.md` (~345 regels) - Complete validation rules reference, exists/unique, custom rules
- `docs/filament/filament-forms-rich-editor.md` (~710 regels) - RichEditor/TipTap, toolbar, images, custom blocks, merge tags, mentions
- `docs/filament/filament-actions.md` (~350 regels) - Actions, Modals, Notifications, Infolists, User feedback
- `docs/filament/filament-advanced.md` (~400 regels) - Widgets, Multi-tenancy, Styling, Custom Pages, Theming
- `docs/filament/filament-custom-css.md` (~640 regels) - Panel styling, kleuren, fonts, themes, CSS hooks, icons
- `docs/filament/filament-testing.md` (~250 regels) - Testing resources/actions, Deployment, Performance tips

### Filament Plugins
- `docs/spatie-media-library.md` - Spatie Media Library v4 - File uploads, collections, conversions, responsive images

### Tailwind CSS 4.1
- `docs/tailwindcss.md` - Tailwind CSS 4.1 documentatie - CSS-first configuratie, nieuwe utilities, theme variabelen, v3 naar v4 migratie

### DaisyUI 5.x
- `docs/DAISYUI-V5.md` - Quick reference voor DaisyUI v5, componenten, themes, configuratie met Tailwind CSS v4
- `docs/DAISYUI-LLMS.md` - Uitgebreide LLM-optimized documentatie - alle componenten, classes, modifiers, colors

### Configuration System

The app stores dynamic configuration in the database (`Config` model) and caches it for performance. Access configs through `ConfigService` rather than directly.

Site settings use Spatie Laravel Settings:
- `SiteSettings` - Site name, logo, colors
- Stored in `settings` table

### Queue System

Laravel Horizon is used for queue management. Background jobs should be dispatched to appropriate queues configured in `config/horizon.php`.

**Navbar varianten**: Configureerbaar via `theme_config.navbar.variant` (`default` of `centered`) in Admin → Templates → Theme Configuration.

## Project Conventions

### Code Style
- **Altijd `./vendor/bin/pint --dirty` runnen voor commit**
- Use FormRequests voor validation - niet in controllers
- Config: gebruik `config('app.name')`, **nooit** `env('APP_NAME')` buiten config files
- Routes: gebruik `route('name')` voor URL generation

### Database
- **Column modifications**: include ALL previous attributes in migration, anders worden ze dropped
- Gebruik model factories in tests (check custom states eerst)
- Eager loading limits: `$query->latest()->limit(10)` (Laravel 11+)

### Models
- Casts in `casts()` method (niet `$casts` property) - volg bestaande conventions

### Laravel 12 Specifics
- **Geen** `app/Console/Kernel.php` - gebruik `bootstrap/app.php`
- **Geen** `app/Http/Middleware/` files - register in `bootstrap/app.php`
- Commands in `app/Console/Commands/` auto-register

### Livewire 3
- Namespace: `App\Livewire` (niet `App\Http\Livewire`)
- `wire:model.live` voor real-time (default is deferred)
- Events: `$this->dispatch()` (niet `emit`)
- Layout: `components.layouts.app`
- Alpine included (persist, intersect, collapse, focus plugins)
- **Altijd single root element**
- **Altijd `wire:key` in loops**: `wire:key="item-{{ $item->id }}"`

**Gedetailleerde Livewire documentatie**: Zie `docs/livewire/` voor uitgebreide referentie (modulair opgesplitst voor efficiënt gebruik)

### Tailwind 4.1
- Import: `@import "tailwindcss"` (niet `@tailwind` directives)
- Opacity: `bg-black/50` (niet `bg-opacity-50`)
- Utilities: `shrink-*` (niet `flex-shrink-*`), `text-ellipsis` (niet `overflow-ellipsis`)
- Spacing: gebruik `gap-*` in lists (geen margins)
- Dark mode: ondersteun altijd als bestaande pages het hebben

**Gedetailleerde Tailwind documentatie**: Zie `docs/tailwindcss.md` voor volledige Tailwind CSS 4.1 referentie

### Testing (PHPUnit - geen Pest)
- **Elke wijziging moet getest worden**
- Run minimale tests: `php artisan test --filter=testName`
- Na feature compleet: vraag of hele suite moet runnen
- Test happy + failure + edge cases
- **Nooit tests verwijderen zonder goedkeuring**

### Common Issues
- **Vite error**: run `npm run build` of `npm run dev`
- **Platform errors**: gebruik `--ignore-platform-reqs` flag



### Testing Conventions

- Feature tests for Filament resources in `tests/Feature/Filament/Admin/Resources/`
- Livewire component tests in `tests/Feature/Livewire/`
- Test both admin and user-facing features
- Use factories for test data creation
- Database is reset between tests (see `phpunit.xml`)
- TestingDatabaseSeeder seeds: RolesAndPermissions, Users, VerificationProviders, SiteSettings

## Important Notes

### Security
- Never commit `.env` files
- Admin panel access controlled via `spatie/laravel-permission`
- Two-factor authentication available via Google Authenticator
- OAuth social login supported (configurable providers)

### Localization
- The app is fully translatable
- Translation files in `lang/` directory
- Use `kkomelin/laravel-translatable-string-exporter` for exporting translations

### Deployment
- Deployment configuration in `deploy.php` using Deployer
- Configure server settings, repository, and domain before first deployment
- Deployment includes npm build, migrations, and optimization steps

### Environment-Specific Features
- Laravel Telescope is only registered in local environment (see `AppServiceProvider`)
- Use `APP_ENV=testing` for test runs (configured in `phpunit.xml`)



**Gebruik in prompts**:
- "Lees docs/laravel-boost.md voor Filament 4 best practices"
- "Check docs/forge-setup.md voor site provisioning flow"
- "Lees docs/forge-setup.md en docs/digitalocean-dns-setup.md voor complete provisioning"
- "Check docs/saasykit/products-plans.md voor pricing types"
- "Lees docs/livewire/README.md voor Livewire scenario's" (start altijd hier)
- "Lees docs/livewire/livewire-core.md voor component basics"
- "Lees docs/livewire/livewire-forms.md voor form validatie"
- "Lees docs/livewire/livewire-advanced.md voor events en Alpine integratie"
- "Lees docs/livewire/livewire-patterns.md voor concrete voorbeelden"
- "Lees docs/filament/README.md voor Filament overzicht en scenario's" (start altijd hier voor Filament)
- "Lees docs/filament/filament-core.md voor Resource en CRUD setup"
- "Lees docs/filament/filament-tables.md voor table configuratie en filters"
- "Lees docs/filament/filament-forms.md voor form building en validatie"
- "Lees docs/filament/filament-actions.md voor actions en modals"
- "Lees docs/filament/filament-advanced.md voor widgets en multi-tenancy"
- "Lees docs/filament/filament-custom-css.md voor panel styling, kleuren, fonts en CSS hooks"
- "Lees docs/filament/filament-forms-validation.md voor validation rules en exists/unique"
- "Lees docs/filament/filament-forms-rich-editor.md voor RichEditor, TipTap en custom blocks"
- "Lees docs/filament/filament-testing.md voor testing en deployment"
- "Lees docs/spatie-media-library.md voor file uploads, collections, conversions, responsive images"
- "Lees docs/tailwindcss.md voor Tailwind CSS 4.1 utilities, configuratie en migratie"
- "Lees docs/DAISYUI-V5.md voor DaisyUI v5 quick reference en configuratie"
- "Lees docs/DAISYUI-LLMS.md voor complete DaisyUI component referentie en classes"
