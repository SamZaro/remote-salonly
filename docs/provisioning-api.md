# Provisioning API — Remote Site

Deze site ontvangt provisioning-requests van de SaaS-applicatie (salonblaze) via de `ProvisionController`.

## Authenticatie

Alle endpoints vereisen een `X-Provision-Token` header die moet matchen met `config('app.provision_token')`.

---

## Endpoints

### POST `/api/provision-user`

Maakt een customer-gebruiker aan of updatet een bestaande.

**Payload:**
```json
{
  "name": "string (required)",
  "email": "string|email (required)",
  "password": "string (required, pre-hashed)"
}
```

**Wat er gebeurt:**
1. User wordt aangemaakt of bijgewerkt via `updateOrCreate` op email
2. `customer` role wordt toegekend (als die nog niet toegekend is)

**Response:**
```json
{ "success": true, "user_id": 1 }
```

---

### POST `/api/provision-template`

Stelt het actieve template in voor de site.

**Payload:**
```json
{
  "template_slug": "string (required)",
  "template_config": "array (optional)"
}
```

**Wat er gebeurt:**
1. `template_slug` wordt opgeslagen in de `settings` tabel
2. `template_config` wordt opgeslagen (indien aanwezig)
3. Template- en settings-cache worden geleegd

**Response:**
```json
{ "success": true, "message": "Template configuration saved", "template_slug": "coupe" }
```

---

### POST `/api/sync-modules`

Synchroniseert module-activatie op basis van het abonnementstype van de klant.

**Payload:**
```json
{
  "modules": {
    "booking_widget": "true",
    "contact_form": "false"
  }
}
```

Waarden zijn strings (`"true"` / `"false"`), afkomstig uit de `Product.metadata` van het actieve abonnement in de SaaS-app.

**Wat er gebeurt:**
1. `BookingSettings::is_active` wordt gezet op basis van `modules.booking_widget`
2. `ContactFormSettings::is_active` wordt gezet op basis van `modules.contact_form`
3. Alleen de feature flags worden bijgewerkt — permissions worden **niet** gemanipuleerd

**Response:**
```json
{ "success": true, "modules": { "booking_widget": true, "contact_form": true } }
```

---

## Twee-lagen architectuur (modules)

Module-toegang wordt op twee lagen gecontroleerd:

| Laag | Vraag | Bron |
|------|-------|------|
| **Feature flag** | Is de module actief voor deze site? | `syncModules` → `BookingSettings::is_active` / `ContactFormSettings::is_active` |
| **Permissions** | Mag de customer-rol deze module gebruiken? | `BookingPermissionsSeeder` / `ContactFormPermissionsSeeder` (statisch, altijd aanwezig) |

**Gate-check:**
```php
BookingModuleManager::isEnabled() && $user->can('booking.view')
ContactFormModuleManager::isEnabled() && $user->can('contact_form.view')
```

- `BookingModuleManager::isEnabled()` = `config('booking-module.enabled')` **AND** `BookingSettings::is_active`
- `ContactFormModuleManager::isEnabled()` = `config('contact-form-module.enabled')` **AND** `ContactFormSettings::is_active`
- Permissions zijn statisch: de customer-rol heeft altijd permissions via de seeders
- De feature flags (via `syncModules`) bepalen of modules zichtbaar zijn op basis van het abonnementstype

**Voorbeeld:**
- Klant met Starter abonnement → `booking_widget: "false"`, `contact_form: "false"` → modules verborgen
- Klant met Pro/Premium abonnement → `contact_form: "true"` → contact formulier zichtbaar
- Klant met Premium abonnement → `booking_widget: "true"` → booking widget zichtbaar

---

## Timing: wanneer wordt syncModules aangeroepen?

1. **Bij site provisioning** — `ProvisionSite` job in de SaaS-app roept dit endpoint aan direct na het aanmaken van de site
2. **Bij subscription-wijziging** — `SyncSubscriptionModules` listener in de SaaS-app stuurt updated metadata bij upgrade/downgrade

---

## Relevante bestanden

| Bestand | Rol |
|---------|-----|
| `app/Http/Controllers/ProvisionController.php` | Alle provisioning endpoints |
| `app/Booking/BookingModuleManager.php` | `isEnabled()` — combineert env + settings |
| `app/ContactForm/ContactFormModuleManager.php` | `isEnabled()` — combineert env + settings |
| `app/Settings/BookingSettings.php` | Persistent module-status (booking) |
| `app/Settings/ContactFormSettings.php` | Persistent module-status (contact form) |
| `database/seeders/BookingPermissionsSeeder.php` | Statische permissions voor admin + customer (booking) |
| `database/seeders/ContactFormPermissionsSeeder.php` | Statische permissions voor admin + customer (contact form) |
| `database/seeders/RolesAndPermissionsSeeder.php` | Basis rollen en template permissions |
| `routes/api.php` | Route registratie provisioning endpoints |
