# Filament 4.x - Date-Time Picker

> Bron: https://filamentphp.com/docs/4.x/forms/date-time-picker

## Overzicht

De date-time picker biedt een interactieve interface voor het selecteren van een datum en/of tijd. Er zijn drie varianten beschikbaar:

```php
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;

DateTimePicker::make('published_at')  // Datum + tijd
DatePicker::make('date_of_birth')     // Alleen datum
TimePicker::make('alarm_at')          // Alleen tijd
```

## Storage Format

Pas het opslagformaat aan met `format()` (gebruikt PHP date formatting tokens):

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->format('d/m/Y')
```

Dynamische waarde mogelijk via closure met utility injection.

## Seconden Uitschakelen

Schakel de seconden-input uit met `seconds(false)`:

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('published_at')
    ->seconds(false)
```

## Timezones

Laat gebruikers datums beheren in hun eigen tijdzone:

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('published_at')
    ->timezone('America/New_York')
```

- Data wordt nog steeds opgeslagen in de app's geconfigureerde timezone
- Bij laden wordt geconverteerd naar de opgegeven timezone
- Bij opslaan wordt teruggeconverteerd

### Globale Default Timezone

Stel een default timezone in via `AppServiceProvider`:

```php
use Filament\Support\Facades\FilamentTimezone;

public function boot(): void
{
    FilamentTimezone::set('America/New_York');
}
```

**Let op**: Timezone wordt alleen toegepast wanneer een tijd wordt opgeslagen. `DatePicker` (zonder tijd) past geen timezone toe om ongewenste datumverschuivingen te voorkomen.

## JavaScript Date Picker

Standaard gebruikt Filament de native HTML5 date picker. Schakel de JavaScript picker in met `native(false)`:

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->native(false)
```

**Let op**: De JavaScript picker ondersteunt geen volledige keyboard input zoals de native picker.

### Display Format

Pas het weergaveformaat aan (los van storage format):

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->native(false)
    ->displayFormat('d/m/Y')
```

### Locale

Configureer de locale voor weergave:

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->native(false)
    ->displayFormat('d F Y')
    ->locale('nl')
```

### Tijd Intervallen

Pas de stappen voor uren/minuten/seconden aan:

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('published_at')
    ->native(false)
    ->hoursStep(2)
    ->minutesStep(15)
    ->secondsStep(10)
```

### Eerste Dag van de Week

Configureer de eerste dag van de week (0-7, waarbij maandag = 1, zondag = 7 of 0):

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('published_at')
    ->native(false)
    ->firstDayOfWeek(7)

// Of met helper methods:
DateTimePicker::make('published_at')
    ->native(false)
    ->weekStartsOnMonday()

DateTimePicker::make('published_at')
    ->native(false)
    ->weekStartsOnSunday()
```

### Specifieke Datums Uitschakelen

Voorkom dat bepaalde datums geselecteerd kunnen worden:

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('date')
    ->native(false)
    ->disabledDates(['2000-01-03', '2000-01-15', '2000-01-20'])
```

Dynamisch via closure:

```php
DateTimePicker::make('date')
    ->native(false)
    ->disabledDates(function () {
        return Holiday::pluck('date')->toArray();
    })
```

### Sluiten bij Datumselectie

Sluit de picker automatisch wanneer een datum wordt geselecteerd:

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('date')
    ->native(false)
    ->closeOnDateSelection()

// Conditioneel:
DateTimePicker::make('date')
    ->native(false)
    ->closeOnDateSelection(fn () => FeatureFlag::active())
```

## Datalist (Autocomplete)

Voeg autocomplete opties toe aan de native picker:

```php
use Filament\Forms\Components\TimePicker;

TimePicker::make('appointment_at')
    ->datalist([
        '09:00',
        '09:30',
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '12:00',
    ])
```

**Let op**: Werkt niet met de JavaScript picker. Datalist geeft alleen suggesties, gebruikers kunnen nog steeds vrije waarden invoeren.

### Default Focus Datum

Open de kalender op een specifieke datum (i.p.v. de huidige datum):

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('custom_starts_at')
    ->native(false)
    ->placeholder(now()->startOfMonth())
    ->defaultFocusedDate(now()->startOfMonth())
```

## Affix Text & Icons

### Tekst Prefix/Suffix

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date')
    ->prefix('Starts')
    ->suffix('at midnight')
```

### Icon Prefix/Suffix

```php
use Filament\Forms\Components\TimePicker;
use Filament\Support\Icons\Heroicon;

TimePicker::make('at')
    ->prefixIcon(Heroicon::Play)
    ->suffixIcon(Heroicon::Clock)
```

### Icon Kleur

```php
use Filament\Forms\Components\TimePicker;
use Filament\Support\Icons\Heroicon;

TimePicker::make('at')
    ->prefixIcon(Heroicon::CheckCircle)
    ->prefixIconColor('success')
```

## Read-Only

Maak het veld read-only (niet te verwarren met `disabled()`):

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->readonly()

// Conditioneel:
DatePicker::make('date_of_birth')
    ->readOnly(fn () => ! auth()->user()->isAdmin())
```

**Verschillen met `disabled()`:**
- `readOnly()`: veld wordt nog steeds naar de server gestuurd (gebruik `dehydrated(false)` om dit te voorkomen)
- Geen visuele styling wijzigingen
- Veld is nog steeds focusbaar
- Werkt alleen met native picker (gebruik `disabled()` voor JavaScript picker)

## Validatie

### Min/Max Datum

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->native(false)
    ->minDate(now()->subYears(150))
    ->maxDate(now())
```

Dynamisch met closure:

```php
DatePicker::make('end_date')
    ->native(false)
    ->minDate(fn (Get $get) => $get('start_date'))
    ->maxDate(fn () => now()->addYear())
```

## Utility Injection Parameters

Alle methodes die closures accepteren kunnen de volgende utilities injecteren:

| Utility | Type | Parameter | Beschrijving |
|---------|------|-----------|--------------|
| Field | `Filament\Forms\Components\Field` | `$component` | Huidige field component instance |
| Get function | `Filament\Schemas\Components\Utilities\Get` | `$get` | Functie voor ophalen form data |
| Livewire | `Livewire\Component` | `$livewire` | Livewire component instance |
| Model FQN | `?string<Model>` | `$model` | Eloquent model FQN |
| Operation | `string` | `$operation` | Huidige operatie (`create`, `edit`, `view`) |
| Raw state | `mixed` | `$rawState` | Waarde vóór state casts |
| Record | `?Model` | `$record` | Eloquent record |
| State | `mixed` | `$state` | Huidige waarde |

## Praktijkvoorbeelden

### Afspraak Planner

```php
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Support\Icons\Heroicon;

DateTimePicker::make('appointment_at')
    ->label('Afspraak')
    ->native(false)
    ->displayFormat('d F Y, H:i')
    ->locale('nl')
    ->timezone('Europe/Amsterdam')
    ->seconds(false)
    ->minutesStep(15)
    ->minDate(now())
    ->maxDate(now()->addMonths(3))
    ->weekStartsOnMonday()
    ->closeOnDateSelection()
    ->prefixIcon(Heroicon::Calendar)
    ->required()
```

### Geboortedatum met Leeftijdsbeperking

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('date_of_birth')
    ->label('Geboortedatum')
    ->native(false)
    ->displayFormat('d-m-Y')
    ->locale('nl')
    ->maxDate(now()->subYears(18))  // Minimaal 18 jaar oud
    ->minDate(now()->subYears(120))
    ->defaultFocusedDate(now()->subYears(30))
    ->required()
```

### Werkuren Selector

```php
use Filament\Forms\Components\TimePicker;

TimePicker::make('start_time')
    ->label('Starttijd')
    ->seconds(false)
    ->datalist([
        '08:00', '08:30', '09:00', '09:30', '10:00',
    ])
    ->required()

TimePicker::make('end_time')
    ->label('Eindtijd')
    ->seconds(false)
    ->after('start_time')
    ->required()
```

### Publicatie Planning met Timezone

```php
use Filament\Forms\Components\DateTimePicker;

DateTimePicker::make('published_at')
    ->label('Publiceren op')
    ->native(false)
    ->displayFormat('d M Y, H:i')
    ->timezone(fn () => auth()->user()->timezone ?? 'Europe/Amsterdam')
    ->seconds(false)
    ->minutesStep(5)
    ->minDate(now())
    ->nullable()
    ->helperText('Laat leeg om direct te publiceren')
```

### Vakantieperiode met Geblokkeerde Datums

```php
use Filament\Forms\Components\DatePicker;

DatePicker::make('vacation_start')
    ->label('Vakantie start')
    ->native(false)
    ->displayFormat('d-m-Y')
    ->minDate(now())
    ->disabledDates(function () {
        // Haal geblokkeerde datums uit database
        return BlockedDate::where('year', now()->year)
            ->pluck('date')
            ->map(fn ($date) => $date->format('Y-m-d'))
            ->toArray();
    })
    ->closeOnDateSelection()
    ->required()
```

## Gerelateerde Componenten

- [Select](select.md) - Voor strikte opties i.p.v. datalist
- [Validation](validation.md) - Alle validatieregels
- [Forms Overview](overview.md) - Utility injection uitleg
