# Refactor Advies

## Samenvatting

De codebase is **over het algemeen goed gestructureerd** met duidelijke service layer patterns, proper Livewire 3 gebruik, en een goed ontworpen template systeem. Er zijn echter significante verbeterpunten.

### Top 5 Prioriteiten

1. **BUG: Verkeerde views in PostmarkSettings en MailgunSettings** — Renderen de AmazonSES view i.p.v. hun eigen view
2. **Ontbrekende Booking tests** — Compleet ongetest feature (models, resources, Livewire components)
3. **Admin/Dashboard Filament resource duplicatie** — BookingResource, AvailabilityExceptionResource, BusinessHoursResource zijn 95-100% identiek gekopieerd
4. **Fat ProvisionController** — 216 regels met business logica, herhaalde token validatie, directe DB calls
5. **69 magic permission strings** — Verspreid over seeders, policies en code zonder centrale enum/constante

---

## Kritiek (moet gefixt)

### 1. BUG: Verkeerde view rendering in Livewire Settings componenten

**Bestand**: `app/Livewire/Filament/PostmarkSettings.php:31`
**Bestand**: `app/Livewire/Filament/MailgunSettings.php:31`

**Probleem**: Beide componenten renderen `livewire.filament.amazon-ses-settings` i.p.v. hun eigen view.

**Oplossing**: Corrigeer de `render()` methode:
```php
// PostmarkSettings.php
public function render()
{
    return view('livewire.filament.postmark-settings');
}

// MailgunSettings.php
public function render()
{
    return view('livewire.filament.mailgun-settings');
}
```

---

### 2. Ontbrekende Booking feature tests

**Bestand**: `tests/` — geheel ontbrekend

**Probleem**: Het complete booking feature is ongetest:
- Geen tests voor Booking model/factory
- Geen tests voor BookingResource (Admin + Dashboard)
- Geen Livewire tests voor BookingButton, BookingCalendar, BookingSection, BookingWizard, BookingTimeSlots
- Geen tests voor BusinessHours en AvailabilityException
- Geen tests voor BookingAvailabilityService
- Geen tests voor ManageBookingSettings pagina

**Oplossing**: Maak minimaal aan:
- `tests/Feature/Filament/Admin/Resources/BookingResourceTest.php`
- `tests/Feature/Filament/Dashboard/Resources/BookingResourceTest.php`
- `tests/Feature/Livewire/Booking/BookingWizardTest.php`
- `tests/Feature/Services/BookingAvailabilityServiceTest.php`

---

### 3. Ontbrekende Booking policies

**Bestand**: `app/Policies/` — ontbreekt voor Booking, BusinessHours, AvailabilityException

**Probleem**: `BookingPermissionsSeeder` maakt 7 permissions aan (`booking.view`, `booking.create`, etc.) maar er zijn geen corresponderende Policy classes.

**Oplossing**: Maak policies aan:
```bash
php artisan make:policy BookingPolicy --model=Booking
php artisan make:policy BusinessHoursPolicy --model=BusinessHours
php artisan make:policy AvailabilityExceptionPolicy --model=AvailabilityException
```

---

### 4. Hardcoded wachtwoorden in UserSeeder

**Bestand**: `database/seeders/UserSeeder.php:20,25`

**Probleem**: Wachtwoorden staan hardcoded in de seeder:
```php
'password' => Hash::make('Tangerboy1978'),
'password' => Hash::make('oostermeent-west'),
```

**Oplossing**: Gebruik environment variabelen:
```php
'password' => Hash::make(env('SEED_ADMIN_PASSWORD', Str::random(16))),
```

---

### 5. Config model bevat business logica

**Bestand**: `app/Models/Config.php:19-91`

**Probleem**: Het model bevat static methods `get()`, `set()`, `getAll()` met encryptie/decryptie logica. Dit hoort in `ConfigService` (die al bestaat).

**Oplossing**: Verplaats alle static methods naar `ConfigService`. Houd het model dun — alleen ORM mapping en eventueel een `scopeByKey()` scope.

---

## Hoge prioriteit

### 6. Admin/Dashboard Filament resource duplicatie

**Bestanden**:
- `app/Filament/Admin/Resources/Bookings/BookingResource.php` vs `app/Filament/Dashboard/Resources/Bookings/BookingResource.php` — **100% identiek**
- `app/Filament/Admin/Resources/AvailabilityExceptions/` vs `app/Filament/Dashboard/Resources/AvailabilityExceptions/` — **100% identiek**
- `app/Filament/Admin/Resources/BusinessHours/` vs `app/Filament/Dashboard/Resources/BusinessHours/` — **~95% identiek**
- `app/Filament/Admin/Resources/EmailProviders/` vs `app/Filament/Dashboard/Resources/EmailProviders/` — **~95% identiek**
- `app/Filament/Admin/Resources/Templates/RelationManagers/SectionsRelationManager.php` vs Dashboard versie — **identiek**

**Probleem**: Wijzigingen moeten op 2 plekken worden doorgevoerd. Hoge kans op divergentie.

**Oplossing**: Maak shared base classes:
```
app/Filament/Shared/Resources/
    BookingResource.php        (shared logica)
    AvailabilityExceptionResource.php
    BusinessHoursResource.php
    EmailProviderResource.php

app/Filament/Admin/Resources/Bookings/
    BookingResource.php extends Shared\BookingResource
        // Alleen admin-specifieke overrides

app/Filament/Dashboard/Resources/Bookings/
    BookingResource.php extends Shared\BookingResource
        // Alleen dashboard-specifieke overrides (canAccess, permissions)
```

---

### 7. Fat ProvisionController

**Bestand**: `app/Http/Controllers/ProvisionController.php` (216 regels)

**Probleem**:
- Token validatie herhaald in 3 methods (regels 19-26, 83-89, 163-168)
- Business logica in controller: permission sync, role assignment (regels 161-215)
- Directe `DB::table()` calls i.p.v. models (regels 109-130)
- String vergelijking `'false' === 'true'` (regel 178)

**Oplossing**:
1. Maak `ValidateProvisionToken` middleware
2. Maak `ProvisionService` voor business logica
3. Maak `FormRequest` classes voor validatie
4. Gebruik models/Settings i.p.v. `DB::table()`

---

### 8. Ontbrekende #[Computed] in Booking Livewire componenten

**Bestand**: `app/Livewire/Booking/BookingCalendar.php:54-120`

**Probleem**: `getCalendarDaysProperty()` is een 45-regel berekening met DB queries die bij elke render wordt herberekend. Geen `#[Computed]` attribute.

**Bestanden met zelfde probleem**:
- `BookingTimeSlots.php:23` — `getGroupedSlotsProperty()`
- `BookingButton.php:23,28` — `getBookingUrlProperty()`, `getIsEnabledProperty()`
- `BookingSection.php:46-74` — 4 property methods zonder `#[Computed]`
- `BookingTrigger.php:30-38` — 2 property methods zonder `#[Computed]`

**Oplossing**: Voeg `#[Computed]` toe aan alle computed property methods:
```php
use Livewire\Attributes\Computed;

#[Computed]
public function calendarDays(): array
{
    // ... bestaande logica
}
```

Voorbeeld correct gebruik: `app/Livewire/Navigation.php:13-35` gebruikt wél `#[Computed]` — dit is het goede patroon.

---

### 9. Magic permission strings centraliseren

**Bestanden**:
- `database/seeders/RolesAndPermissionsSeeder.php:20-100` — 69 permission strings
- `database/seeders/BookingPermissionsSeeder.php:17-25` — 7 permission strings
- Alle Policy classes — refereren naar dezelfde strings

**Probleem**: Permission namen zijn magic strings verspreid over de codebase. Typo = stille fout.

**Oplossing**: Maak `app/Enums/Permission.php`:
```php
enum Permission: string
{
    case ViewUsers = 'view users';
    case CreateUsers = 'create users';
    case UpdateUsers = 'update users';
    case DeleteUsers = 'delete users';
    // ...
    case BookingView = 'booking.view';
    case BookingCreate = 'booking.create';
    // etc.
}
```

---

### 10. Inconsistente $casts property vs casts() method

**Bestanden met oude `$casts` property**:
- `app/Models/User.php:57-62`
- `app/Models/Template.php:29-35`
- `app/Models/TemplateSection.php:25-29`
- `app/Models/Category.php:24-27`

**Bestanden met correcte `casts()` method**:
- `app/Models/Booking.php:25-31` ✓
- `app/Models/BusinessHours.php:20-27` ✓
- `app/Models/AvailabilityException.php:20-26` ✓

**Oplossing**: Converteer alle models naar `casts()` method:
```php
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
```

---

### 11. Ontbrekende casts in Announcement model

**Bestand**: `app/Models/Announcement.php:12-22`

**Probleem**: Geen enkele cast gedefinieerd. Datetime velden (`starts_at`, `ends_at`) en boolean velden (`is_active`, `is_dismissible`, `show_for_customers`, `show_on_frontend`, `show_on_user_dashboard`) worden niet gecast.

**Oplossing**:
```php
protected function casts(): array
{
    return [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'is_dismissible' => 'boolean',
        'show_for_customers' => 'boolean',
        'show_on_frontend' => 'boolean',
        'show_on_user_dashboard' => 'boolean',
    ];
}
```

---

### 12. Ontbrekende preventLazyLoading()

**Bestand**: `app/Providers/AppServiceProvider.php`

**Probleem**: `Model::preventLazyLoading()` is niet actief. N+1 query issues worden niet gedetecteerd.

**Oplossing**:
```php
public function boot(): void
{
    Model::preventLazyLoading(! $this->app->isProduction());
    // ... bestaande code
}
```

---

## Medium prioriteit

### 13. Fat Livewire settings componenten

**Bestand**: `app/Livewire/Filament/GeneralSettings.php` — 266 regels, 8 tabs
**Bestand**: `app/Livewire/Filament/OpenGraphImageSettings.php` — 265 regels

**Probleem**: Te veel verantwoordelijkheden in één component. GeneralSettings beheert email config, app config, analytics, auth, verificatie, social links in 8 tabs.

**Oplossing**: Splits in kleinere componenten per tab of groepeer verwante instellingen.

---

### 14. Email provider settings duplicatie

**Bestanden**:
- `app/Livewire/Filament/SmtpSettings.php` (78 regels)
- `app/Livewire/Filament/ResendSettings.php` (66 regels)
- `app/Livewire/Filament/PostmarkSettings.php` (66 regels)
- `app/Livewire/Filament/MailgunSettings.php` (77 regels)
- `app/Livewire/Filament/AmazonSesSettings.php` (77 regels)

**Probleem**: Alle volgen exact hetzelfde patroon (boot, mount, form, save) met minimale verschillen.

**Oplossing**: Maak `BaseEmailProviderSettings` class met shared mount/save logica:
```php
abstract class BaseEmailProviderSettings extends Component
{
    abstract protected function configKeys(): array;
    abstract protected function formSchema(): array;
    // Shared mount(), save(), boot() logica
}
```

OAuth providers doen dit wél goed via `OauthProviderSettings` abstract base class.

---

### 15. Ontbrekende SectionType en ColorScheme enums

**Bestanden**:
- `database/seeders/TemplateSeeder.php:128-132` — magic strings `'hero'`, `'about'`, `'services'`, etc.
- `database/seeders/TemplateSeeder.php:109-119` — magic strings `'luxury'`, `'vintage'`, `'modern'`, etc.
- `database/factories/TemplateSectionFactory.php:22` — zelfde magic strings

**Oplossing**: Maak enums:
```php
// app/Enums/SectionType.php
enum SectionType: string
{
    case Hero = 'hero';
    case About = 'about';
    case Services = 'services';
    case Testimonials = 'testimonials';
    case Contact = 'contact';
    case Pricing = 'pricing';
    case Gallery = 'gallery';
    // etc.
}

// app/Enums/ColorScheme.php
enum ColorScheme: string
{
    case Luxury = 'luxury';
    case Vintage = 'vintage';
    case Modern = 'modern';
    // etc.
}
```

---

### 16. OAuthController callback te complex

**Bestand**: `app/Http/Controllers/Auth/OAuthController.php:35-122`

**Probleem**: De `callback()` methode handelt user creation, 9 individuele parameter updates, email verificatie en login af in één methode.

**Oplossing**: Extract naar `OAuthUserSyncService`:
```php
class OAuthUserSyncService
{
    public function syncUser(SocialiteUser $oauthUser, string $provider): User
    {
        // User creation/update
        // Parameter sync via mapping array i.p.v. 9 individuele calls
    }
}
```

---

### 17. Inline form schemas in Filament resources

**Bestand**: `app/Filament/Admin/Resources/Users/UserResource.php:48-97` — 50 regels inline
**Bestand**: `app/Filament/Admin/Resources/Announcements/AnnouncementResource.php:41-97` — 56 regels inline

**Probleem**: Form schemas staan inline in de resource terwijl het project al dedicated schema classes heeft (bijv. `TemplateFormSchema.php` — uitstekend patroon).

**Oplossing**: Extract naar `app/Filament/Schemas/UserFormSchema.php` en `AnnouncementFormSchema.php`, vergelijkbaar met het bestaande `TemplateFormSchema` patroon.

---

### 18. Zwakke Filament resource tests

**Bestanden**: `tests/Feature/Filament/Admin/Resources/*.php`

**Probleem**: Alle resource tests controleren alleen HTTP 200 status. Geen gebruik van Filament testing helpers.

**Oplossing**: Gebruik Filament testing helpers:
```php
public function test_user_form_has_required_fields(): void
{
    Livewire::test(CreateUser::class)
        ->assertFormFieldExists('name')
        ->assertFormFieldExists('email')
        ->assertFormFieldExists('password');
}

public function test_user_table_has_columns(): void
{
    Livewire::test(ListUsers::class)
        ->assertTableColumnExists('name')
        ->assertTableColumnExists('email');
}
```

---

### 19. Ontbrekende return type hints in models

**Bestanden**:
- `app/Models/User.php` — `getPublicName()`, `isAdmin()`, `isPhoneNumberVerified()`, `canImpersonate()`, `scopeAdmin()` missen return types
- `app/Models/Booking.php` — `scopeUpcoming()`, `scopeByStatus()` missen `Builder` return type
- `app/Models/OauthLoginProvider.php` — missing `enabled` boolean cast

**Oplossing**:
```php
public function getPublicName(): string { ... }
public function isAdmin(): bool { ... }
public function scopeAdmin(Builder $query): Builder { ... }
```

---

### 20. Herhaalde table columns in Filament resources

**Probleem**: `TextColumn::make('created_at')->dateTime(config('app.datetime_format'))->sortable()` verschijnt in 8+ resources.

**Oplossing**: Voeg toe aan `CrudDefaults` of `ListDefaults` trait:
```php
trait ListDefaults
{
    protected static function createdAtColumn(): TextColumn
    {
        return TextColumn::make('created_at')
            ->dateTime(config('app.datetime_format'))
            ->sortable();
    }
}
```

---

### 21. BookingWizard::submit() doet te veel

**Bestand**: `app/Livewire/Booking/BookingWizard.php:139-190`

**Probleem**: De `submit()` methode combineert rate limiting, validatie, slot verificatie, DB save, en 2x email verzending. Geen database transactie bij email falen.

**Oplossing**:
1. Wrap DB operaties in `DB::transaction()`
2. Verplaats email verzending naar een queued job `SendBookingConfirmationJob`
3. Extract booking creation naar `BookingService`

---

### 22. Hardcoded Nederlands telefoonnummer regex

**Bestand**: `app/Livewire/Booking/BookingWizard.php:65`

**Probleem**: `'regex:/^(\+31|0)[1-9][0-9]{8}$/'` is hardcoded voor Nederlandse telefoonnummers.

**Oplossing**: Verplaats naar `config/booking-module.php`:
```php
'phone_regex' => env('BOOKING_PHONE_REGEX', '/^(\+31|0)[1-9][0-9]{8}$/'),
```

---

## Lage prioriteit

### 23. CrudDefaults en ListDefaults traits onderbenut

**Bestanden**:
- `app/Filament/CrudDefaults.php` — alleen `getRedirectUrl()` (7 regels)
- `app/Filament/ListDefaults.php` — alleen `getTableRecordsPerPageSelectOptions()` (7 regels)

**Probleem**: Traits bestaan maar worden nauwelijks gebruikt en bevatten minimale functionaliteit.

**Oplossing**: Breid uit met herbruikbare patterns (created_at columns, toggle columns, status filters) en gebruik ze in alle resources.

---

### 24. Ontbrekende query scopes in meerdere models

**Bestanden**:
- `app/Models/Announcement.php` — geen scopes (active, current, forFrontend, forDashboard)
- `app/Models/OauthLoginProvider.php` — geen `scopeEnabled()`, `scopeByProvider()`
- `app/Models/BusinessHours.php` — geen `scopeOpen()`, `scopeForDay()`
- `app/Models/AvailabilityException.php` — geen `scopeForDate()`, `scopeInDateRange()`
- `app/Models/User.php` — geen `scopeNotBlocked()`, `scopeVerified()`

**Oplossing**: Voeg relevante query scopes toe. Voorbeeld:
```php
// Announcement.php
public function scopeActive(Builder $query): Builder
{
    return $query->where('is_active', true);
}

public function scopeCurrent(Builder $query): Builder
{
    return $query->where('starts_at', '<=', now())
                 ->where('ends_at', '>=', now());
}
```

---

### 25. VerificationProvider model mist HasFactory trait

**Bestand**: `app/Models/VerificationProvider.php`

**Probleem**: Enige model zonder `HasFactory` trait. Inconsistent met alle andere models.

---

### 26. Ontbrekende media conversions in Template en Category

**Bestanden**:
- `app/Models/Template.php:37-47` — 3 media collections maar geen conversions
- `app/Models/Category.php:30-33` — preview collection maar geen conversions

**Probleem**: TemplateSection heeft wél uitstekende conversions (WebP, thumb, slider). Template en Category missen dit.

**Oplossing**: Voeg conversions toe voor preview/logo/favicon collections:
```php
public function registerMediaConversions(?Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(400)->height(300)
        ->format('webp')->quality(85)
        ->nonQueued()
        ->performOnCollections('preview', 'logo');
}
```

---

### 27. Ontbrekende time casts

**Bestanden**:
- `app/Models/BusinessHours.php` — `open_time`, `close_time` niet gecast
- `app/Models/AvailabilityException.php` — `custom_open_time`, `custom_close_time` niet gecast

---

### 28. Dag namen duplicatie

**Bestanden**:
- `database/seeders/BusinessHoursSeeder.php:13-20` — Dag namen array
- `app/Models/BusinessHours.php:31-39` — Zelfde array gedupliceerd

**Oplossing**: Centraliseer in constante of gebruik `Carbon::getDays()` met vertalingen.

---

### 29. Hardcoded default theme kleuren in TemplateService

**Bestand**: `app/Services/TemplateService.php:238-254`

**Probleem**: 14 hex color waarden hardcoded in `getDefaultTheme()`.

**Oplossing**: Verplaats naar `config/templates.php` of een `DefaultTheme` constante class.

---

### 30. @props ontbreekt in ~13 wrapper componenten

**Bestanden**: Diverse UI componenten in `resources/views/components/` zoals `button-link/primary.blade.php`, `effect/glow.blade.php`

**Probleem**: Geen `@props([])` declaratie, hoewel ze wel `$attributes` en `$slot` gebruiken.

**Oplossing**: Voeg `@props([])` toe voor consistentie en duidelijkheid.

---

## Per directory bevindingen

### app/Models/ (14 bestanden)

| Model | Casts | Return Types | Scopes | Media | Issues |
|-------|-------|-------------|--------|-------|--------|
| User | ✗ property | ✗ 5 missen | 1 scope | - | Converteer casts, add types |
| Template | ✗ property | ✓ | 3 scopes | ✗ Geen conversions | Add conversions |
| TemplateSection | ✗ property | ✓ | 3 scopes | ✓ Excellent | Converteer casts |
| Announcement | ✗ Geen | - | 0 scopes | - | **Kritiek: add casts + scopes** |
| Config | - | ✓ | 0 scopes | - | **Kritiek: verplaats logica** |
| Booking | ✓ method | ✗ scopes | 2 scopes | - | Add Builder types |
| BusinessHours | ✓ method | ✗ accessor | 0 scopes | - | Add time casts |
| AvailabilityException | ✓ method | - | 0 scopes | - | Add time casts |
| Category | ✗ property | ✓ | 2 scopes | ✗ Geen conversions | Add conversions |
| OauthLoginProvider | ✗ Geen | - | 0 scopes | - | Add enabled cast |
| Address | - | ✓ | 0 scopes | - | Minimaal, ok |
| EmailProvider | - | - | 0 scopes | - | Minimaal, ok |
| VerificationProvider | - | - | 0 scopes | - | Add HasFactory |
| UserParameter | - | ✓ | 0 scopes | - | Add byName scope |

### app/Filament/ (95 bestanden)

**Positief**:
- Schema classes in `app/Filament/Schemas/` zijn uitstekend (TemplateFormSchema, SectionFormSchemas, IconSets)
- SectionsRelationManager is goed geïmplementeerd met cache invalidatie
- TemplateResource delegeert correct naar schema classes

**Negatief**:
- Massive resource duplicatie tussen Admin en Dashboard panels
- UserResource en AnnouncementResource hebben fat inline schemas
- CrudDefaults/ListDefaults traits worden niet gebruikt

### app/Livewire/ (29 bestanden)

**Positief**:
- Navigation.php is het gouden voorbeeld (`#[Computed]`, clean)
- Booking componenten hebben goede event flow (Calendar → TimeSlots → Wizard)
- OAuth settings gebruiken proper abstract base class
- Correct Livewire 3 patterns: `#[On]`, `#[Locked]`, `#[Reactive]`, `#[Validate]`

**Negatief**:
- **BUG**: PostmarkSettings en MailgunSettings renderen verkeerde view
- Booking componenten missen `#[Computed]` attributes
- Email provider settings zijn gedupliceerd (5 bijna identieke classes)
- GeneralSettings en OpenGraphImageSettings zijn te groot (265+ regels)

### app/Services/ (12 bestanden)

**Positief**: Uitstekend — alle services volgen Single Responsibility Principle, proper DI, caching in TemplateService, rate limiting in OneTimePasswordService, interface pattern voor verificatie providers.

**Negatief**: Minor — TemplateService heeft hardcoded default kleuren, ConfigService vangt generic Exception.

### app/Http/Controllers/ (12 bestanden)

**Positief**: Meeste controllers zijn dun (HomeController, LoginController, RegisterController).

**Negatief**: ProvisionController is fat (216 regels), OAuthController callback is te complex.

### routes/ (4 bestanden)

**Positief**: Clean en minimal, proper middleware gebruik, named routes.

**Negatief**: Minor — ontbrekende route model binding voor `{slug}`, API routes missen middleware-based auth.

### tests/ (22 bestanden)

**Positief**: OTP login/register tests zijn excellent met proper mocking. HomeControllerTest en NavigationTest zijn goed.

**Negatief**: Geen booking tests, zwakke Filament resource tests (alleen HTTP 200), geen unit tests, inconsistente database setup approach.

### database/seeders/ (13 bestanden)

**Positief**: Goed gestructureerd, TemplateSeeder is clean met definitions pattern.

**Negatief**: 69 magic permission strings, hardcoded wachtwoorden, dag namen duplicatie, magic section types en color scheme strings.

### resources/views/ (~198 bestanden)

**Positief**: Geen business logica in Blade views, proper @props gebruik (85%), inline styles zijn correct voor dynamische theming, clean layout hiërarchie.

**Negatief**: Minor — ~13 wrapper componenten missen `@props([])`.
