# Filament 4.x Forms - Validation

> Documentatie voor Claude Code - Filament 4.x validation rules en methodes

## Overzicht

Filament biedt dedicated validation methods die zowel backend als frontend validatie ondersteunen. Gebruik waar mogelijk de Filament-methodes i.p.v. raw Laravel rules voor optimale frontend feedback.

---

## Beschikbare Validation Rules

### Datum Rules

```php
// After - waarde moet na datum zijn
Field::make('start_date')->after('tomorrow')
Field::make('end_date')->after('start_date') // vergelijk met ander veld

// After or equal
Field::make('end_date')->afterOrEqual('start_date')

// Before - waarde moet voor datum zijn
Field::make('start_date')->before('first day of next month')
Field::make('start_date')->before('end_date')

// Before or equal
Field::make('start_date')->beforeOrEqual('end_date')
```

### String Rules

```php
Field::make('name')->alpha()        // alleen alfabetisch
Field::make('name')->alphaDash()    // alfanumeriek + dash/underscore
Field::make('name')->alphaNum()     // alleen alfanumeriek
Field::make('name')->ascii()        // alleen 7-bit ASCII
Field::make('name')->string()       // moet string zijn

// Start/End with
Field::make('name')->startsWith(['a', 'b'])
Field::make('name')->endsWith(['bot'])
Field::make('name')->doesntStartWith(['admin'])
Field::make('name')->doesntEndWith(['admin'])
```

### Vergelijking Rules

```php
// Groter/kleiner dan ander veld
Field::make('newNumber')->gt('oldNumber')   // greater than
Field::make('newNumber')->gte('oldNumber')  // greater than or equal
Field::make('newNumber')->lt('oldNumber')   // less than
Field::make('newNumber')->lte('oldNumber')  // less than or equal

// Gelijk/verschillend
Field::make('password')->same('passwordConfirmation')
Field::make('backup_email')->different('email')
Field::make('password')->confirmed() // vereist {field}_confirmation veld
```

### Required Rules

```php
Field::make('name')->required()
Field::make('name')->requiredIf('field', 'value')
Field::make('name')->requiredIfAccepted('field') // als field is "yes", "on", 1, true
Field::make('name')->requiredUnless('field', 'value')
Field::make('name')->requiredWith('field,another_field')
Field::make('name')->requiredWithAll('field,another_field')
Field::make('name')->requiredWithout('field,another_field')
Field::make('name')->requiredWithoutAll('field,another_field')

// Asterisk tonen/verbergen
TextInput::make('name')
    ->required()
    ->markAsRequired(false) // verberg asterisk

TextInput::make('name')
    ->markAsRequired() // toon asterisk zonder required validation
```

### Prohibited Rules

```php
Field::make('name')->prohibited()                        // moet leeg zijn
Field::make('name')->prohibitedIf('field', 'value')     // leeg als field=value
Field::make('name')->prohibitedUnless('field', 'value') // leeg tenzij field=value
Field::make('name')->prohibits('field')                  // als gevuld, moet other leeg
Field::make('name')->prohibits(['field', 'another'])     // meerdere velden
```

### Format Rules

```php
Field::make('ip_address')->ip()
Field::make('ip_address')->ipv4()
Field::make('ip_address')->ipv6()
Field::make('mac_address')->macAddress()
Field::make('data')->json()
Field::make('color')->hexColor()
Field::make('url')->activeUrl() // valid A/AAAA DNS record
```

### Pattern Rules

```php
Field::make('email')->regex('/^.+@.+$/i')
Field::make('email')->notRegex('/^.+$/i')
```

### List Rules

```php
Field::make('status')->in(['pending', 'completed'])
Field::make('status')->notIn(['cancelled', 'rejected'])
Field::make('status')->enum(MyStatus::class)
```

> **Let op:** Toggle buttons, checkbox list, radio en select passen automatisch `in()` toe op basis van opties.

### Identifier Rules

```php
Field::make('identifier')->uuid()  // RFC 4122 UUID
Field::make('identifier')->ulid()  // ULID format
```

### Overige Rules

```php
Field::make('name')->nullable()     // standaard als required niet aanwezig
Field::make('name')->filled()       // niet leeg wanneer aanwezig
Field::make('number')->multipleOf(2)
```

---

## Database Validation: Exists & Unique

### Exists Rule

```php
// Basis - gebruikt model van form
Field::make('invitation')->exists()

// Custom table/model
use App\Models\Invitation;
Field::make('invitation')->exists(table: Invitation::class)

// Custom column
Field::make('invitation')->exists(column: 'id')

// Met query modificatie
use Illuminate\Validation\Rules\Exists;
Field::make('invitation')
    ->exists(modifyRuleUsing: function (Exists $rule) {
        return $rule->where('is_active', 1);
    })
```

### Scoped Exists (met Global Scopes)

```php
// Gebruikt Eloquent model met global scopes (soft deletes, multi-tenancy)
TextInput::make('email')->scopedExists()

// Met query modificatie
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

TextInput::make('email')
    ->scopedExists(modifyQueryUsing: function (Builder $query) {
        return $query->withoutGlobalScope(SoftDeletingScope::class);
    })
```

### Unique Rule

```php
// Basis - negeert automatisch huidige record in resource
Field::make('email')->unique()

// Custom table/model
use App\Models\User;
Field::make('email')->unique(table: User::class)

// Custom column
Field::make('email')->unique(column: 'email_address')

// Niet negeren van huidige record
Field::make('email')->unique(ignoreRecord: false)

// Specifiek record negeren
Field::make('email')->unique(ignorable: $ignoredUser)

// Met query modificatie
use Illuminate\Validation\Rules\Unique;
Field::make('email')
    ->unique(modifyRuleUsing: function (Unique $rule) {
        return $rule->where('is_active', 1);
    })
```

### Scoped Unique (met Global Scopes)

```php
// Gebruikt Eloquent model met global scopes
TextInput::make('email')->scopedUnique()

// Met query modificatie
TextInput::make('email')
    ->scopedUnique(modifyQueryUsing: function (Builder $query) {
        return $query->withoutGlobalScope(SoftDeletingScope::class);
    })
```

> **Belangrijk:** Standaard Laravel `exists`/`unique` rules gebruiken geen Eloquent global scopes (soft deletes, multi-tenancy). Gebruik `scopedExists()` en `scopedUnique()` wanneer dit nodig is.

---

## Custom Rules

### Via rules() Method

```php
// Laravel validation rules
TextInput::make('slug')->rules(['alpha_dash'])

// Custom Rule class
TextInput::make('slug')->rules([new Uppercase()])
```

### Closure Rules

```php
use Closure;

TextInput::make('slug')->rules([
    fn (): Closure => function (string $attribute, $value, Closure $fail) {
        if ($value === 'foo') {
            $fail('The :attribute is invalid.');
        }
    },
])
```

### Closure Rules met Utility Injection

```php
use Filament\Schemas\Components\Utilities\Get;
use Closure;

TextInput::make('slug')->rules([
    fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
        if ($get('other_field') === 'foo' && $value !== 'bar') {
            $fail("The {$attribute} is invalid.");
        }
    },
])
```

---

## Validation Customization

### Custom Validation Attribute

```php
TextInput::make('name')
    ->validationAttribute('full name')

// Dynamisch met closure
TextInput::make('name')
    ->validationAttribute(fn () => __('fields.full_name'))
```

### Custom Validation Messages

```php
TextInput::make('email')
    ->unique()
    ->validationMessages([
        'unique' => 'The :attribute has already been registered.',
    ])
```

### HTML in Validation Messages

```php
TextInput::make('password')
    ->required()
    ->rules([new CustomRule()])
    ->allowHtmlValidationMessages() // LET OP: XSS risico!
```

---

## Validation Control

### Validation Uitschakelen voor Niet-Opgeslagen Velden

```php
TextInput::make('name')
    ->required()
    ->saved(false)
    ->validatedWhenNotDehydrated(false)
```

---

## Utility Injection Parameters

Beschikbaar in closures voor `validationAttribute()`, `validationMessages()`, en `validatedWhenNotDehydrated()`:

| Parameter | Type | Beschrijving |
|-----------|------|--------------|
| `$component` | `Field` | Huidige field component |
| `$get` | `Get` | Functie voor form data ophalen |
| `$livewire` | `Component` | Livewire component instance |
| `$model` | `?string` | Eloquent model FQN |
| `$operation` | `string` | Huidige operatie (create/edit/view) |
| `$rawState` | `mixed` | Waarde vóór state casts |
| `$record` | `?Model` | Eloquent record |
| `$state` | `mixed` | Huidige waarde |

---

## Belangrijke Opmerkingen

1. **Frontend Validatie:** Filament's dedicated methods ondersteunen frontend validatie, raw Laravel rules via `rules()` niet altijd.

2. **Attribute Namen:** Sommige Laravel rules werken niet correct via `rules()` omdat ze afhankelijk zijn van correcte attribute namen.

3. **Global Scopes:** Gebruik `scopedExists()` en `scopedUnique()` voor soft deletes en multi-tenancy ondersteuning.

4. **Auto In-Rule:** Select, radio, checkbox list en toggle buttons passen automatisch `in()` validation toe.

---

## Referenties

- [Filament Docs](https://filamentphp.com/docs/4.x/forms/validation)
- [Laravel Validation](https://laravel.com/docs/validation)
