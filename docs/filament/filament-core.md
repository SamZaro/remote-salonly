# Filament 4 - Core Fundamentals

> **Complete referentie voor Resources, CRUD, Navigation, Panel Config en Authorization**

## 📋 Inhoud

1. [Installatie](#installatie)
2. [Resources](#resources)
3. [Listing Records](#listing-records)
4. [Creating Records](#creating-records)
5. [Editing Records](#editing-records)
6. [Viewing Records](#viewing-records)
7. [Deleting Records](#deleting-records)
8. [Relationships](#relationships)
9. [Navigation](#navigation)
10. [Panel Configuration](#panel-configuration)
11. [Authorization](#authorization)

---

## Installatie

### Requirements
- PHP 8.2+
- Laravel 11.28+
- Tailwind CSS 4.1+

### Panel Builder Installeren

```bash
composer require filament/filament:"^4.0"
php artisan filament:install --panels
```

Dit creëert automatisch `app/Providers/Filament/AdminPanelProvider.php`.

### Eerste User Aanmaken

```bash
php artisan make:filament-user
```

Je panel is nu beschikbaar op `/admin`.

---

## Resources

Resources zijn CRUD interfaces voor Eloquent models. Ze definiëren hoe administrators data kunnen beheren met tables en forms.

### Resource Aanmaken

```bash
# Basic resource
php artisan make:filament-resource Customer

# Met auto-generated form/table
php artisan make:filament-resource Customer --generate

# Met soft-deletes
php artisan make:filament-resource Customer --soft-deletes

# Met View page
php artisan make:filament-resource Customer --view

# Simple (modal) resource
php artisan make:filament-resource Customer --simple
```

### Resource Structuur

```
app/Filament/Resources/
└── Customers/
    ├── CustomerResource.php      # Main resource
    ├── Pages/
    │   ├── ListCustomers.php
    │   ├── CreateCustomer.php
    │   └── EditCustomer.php
    ├── Schemas/
    │   └── CustomerForm.php      # Form schema
    └── Tables/
        └── CustomersTable.php    # Table schema
```

### Basic Resource Example

```php
<?php

namespace App\Filament\Resources\Customers;

use App\Models\Customer;
use App\Filament\Resources\Customers\CustomerResource\Pages;
use App\Filament\Resources\Customers\Schemas\CustomerForm;
use App\Filament\Resources\Customers\Tables\CustomersTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $navigationGroup = 'Sales';
    
    protected static ?int $navigationSort = 1;
    
    // Voor globale search
    protected static ?string $recordTitleAttribute = 'name';
    
    public static function form(Schema $schema): Schema
    {
        return CustomerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            // Relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
```

### Model Labels Customizen

```php
protected static ?string $modelLabel = 'klant';
protected static ?string $pluralModelLabel = 'klanten';
protected static ?string $navigationLabel = 'Mijn Klanten';

// Dynamic labels
public static function getModelLabel(): string
{
    return __('filament/resources/customer.label');
}
```

### Eloquent Query Customizen

```php
// Voor hele resource
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('is_active', true)
        ->withoutGlobalScopes(); // Als je global scopes wilt skippen
}

// Global scopes specifiek verwijderen
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->withoutGlobalScopes([ActiveScope::class]);
}
```

### Resource URLs Genereren

```php
use App\Filament\Resources\Customers\CustomerResource;

// Naar List page
CustomerResource::getUrl(); // /admin/customers

// Naar Create page
CustomerResource::getUrl('create'); // /admin/customers/create

// Naar Edit page
CustomerResource::getUrl('edit', ['record' => $customer]);

// Naar andere panel
CustomerResource::getUrl(panel: 'marketing');
```

---

## Listing Records

### Tabs Voor Filtering

```php
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCustomers extends ListRecords
{
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Alle klanten'),
            'active' => Tab::make('Actieve klanten')
                ->badge(Customer::query()->where('active', true)->count())
                ->badgeColor('success')
                ->icon('heroicon-m-check-circle')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('active', true)
                ),
            'inactive' => Tab::make('Inactieve klanten')
                ->badge(Customer::query()->where('active', false)->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('active', false)
                ),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }
}
```

### Table Query Customizen

```php
public static function table(Table $table): Table
{
    return $table
        ->modifyQueryUsing(fn (Builder $query) => 
            $query->with(['organization', 'contacts'])
                  ->withCount('orders')
        );
}
```

---

## Creating Records

### Data Mutatie Voor Save

```php
protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = auth()->id();
    $data['organization_id'] = auth()->user()->organization_id;
    $data['status'] = 'draft';

    return $data;
}
```

### Creation Process Customizen

```php
use Illuminate\Database\Eloquent\Model;

protected function handleRecordCreation(array $data): Model
{
    $customer = static::getModel()::create($data);
    
    // Custom logic
    $customer->assignDefaultRole();
    $customer->sendWelcomeEmail();
    
    return $customer;
}
```

### Redirect After Create

```php
protected function getRedirectUrl(): string
{
    // Terug naar list
    return $this->getResource()::getUrl('index');
    
    // Naar edit page (default)
    return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    
    // Vorige pagina of index
    return $this->previousUrl ?? $this->getResource()::getUrl('index');
}
```

### Panel-wide redirect config

```php
// In AdminPanelProvider
public function panel(Panel $panel): Panel
{
    return $panel
        ->resourceCreatePageRedirect('index') // of 'view' of 'edit'
}
```

### Notificaties

```php
protected function getCreatedNotificationTitle(): ?string
{
    return 'Klant succesvol aangemaakt';
}

// Of volledig custom
protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Klant aangemaakt')
        ->body('De klant is succesvol toegevoegd aan het systeem.')
        ->duration(5000);
}

// Disable notificatie
protected function getCreatedNotification(): ?Notification
{
    return null;
}
```

### Create Another Feature

```php
// Disable feature
protected static bool $canCreateAnother = false;

// Of conditionally
public function canCreateAnother(): bool
{
    return auth()->user()->can('create_multiple_customers');
}

// Data preserveren bij "create another"
protected function preserveFormDataWhenCreatingAnother(array $data): array
{
    return Arr::only($data, ['organization_id', 'is_active']);
}
```

### Lifecycle Hooks

```php
protected function beforeFill(): void
{
    // Voor form fields default values krijgen
}

protected function afterFill(): void
{
    // Na form fields default values krijgen
}

protected function beforeValidate(): void
{
    // Voor form validation
}

protected function afterValidate(): void
{
    // Na form validation
}

protected function beforeCreate(): void
{
    // Voor save naar database
    if (! auth()->user()->team->subscribed()) {
        Notification::make()
            ->warning()
            ->title('Geen actief abonnement!')
            ->send();
        
        $this->halt(); // Stop het proces
    }
}

protected function afterCreate(): void
{
    // Na save naar database
    $this->record->contacts()->create([
        'type' => 'primary',
        'email' => $this->record->email,
    ]);
}
```

### Wizard Voor Creation

```php
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Wizard\Step;

class CreateCustomer extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected function getSteps(): array
    {
        return [
            Step::make('Basis gegevens')
                ->description('Naam en contactinformatie')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required(),
                ]),
            
            Step::make('Adres')
                ->description('Vestigingsadres')
                ->schema([
                    Forms\Components\TextInput::make('street'),
                    Forms\Components\TextInput::make('city'),
                    Forms\Components\TextInput::make('postal_code'),
                ]),
            
            Step::make('Details')
                ->description('Extra informatie')
                ->schema([
                    Forms\Components\Textarea::make('notes')
                        ->columnSpanFull(),
                ]),
        ];
    }

    public function hasSkippableSteps(): bool
    {
        return true; // Allow vrije navigatie
    }
}
```

---

## Editing Records

### Data Mutatie Voor Fill

```php
protected function mutateFormDataBeforeFill(array $data): array
{
    // Verberg sensitive data
    unset($data['password_hash']);
    
    // Transform data
    $data['full_name'] = $data['first_name'] . ' ' . $data['last_name'];
    
    return $data;
}
```

### Data Mutatie Voor Save

```php
protected function mutateFormDataBeforeSave(array $data): array
{
    $data['updated_by'] = auth()->id();
    
    // Verwijder computed fields
    unset($data['full_name']);
    
    return $data;
}
```

### Save Process Customizen

```php
protected function handleRecordUpdate(Model $record, array $data): Model
{
    $record->update($data);
    
    // Custom logic
    if ($record->wasChanged('status')) {
        $record->sendStatusChangeEmail();
    }
    
    return $record;
}
```

### Lifecycle Hooks

```php
protected function beforeFill(): void { }
protected function afterFill(): void { }
protected function beforeValidate(): void { }
protected function afterValidate(): void { }
protected function beforeSave(): void { }
protected function afterSave(): void { }
```

---

## Viewing Records

View pages tonen read-only records data. Geen form fields, maar "entries".

### View Page Genereren

```bash
php artisan make:filament-resource Customer --view
```

### Infolist Definiëren

```php
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;

public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            TextEntry::make('name'),
            TextEntry::make('email'),
            TextEntry::make('phone'),
            TextEntry::make('created_at')
                ->dateTime(),
        ]);
}
```

---

## Deleting Records

### Soft Deletes

```bash
php artisan make:filament-resource Customer --soft-deletes
```

```php
use Filament\Tables\Filters\TrashedFilter;

public static function table(Table $table): Table
{
    return $table
        ->filters([
            TrashedFilter::make(),
        ]);
}

// Query aanpassen
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
}
```

---

## Relationships

### Relation Manager Aanmaken

```bash
php artisan make:filament-relation-manager CustomerResource orders title
```

### Registreren in Resource

```php
public static function getRelations(): array
{
    return [
        RelationManagers\OrdersRelationManager::class,
        RelationManagers\ContactsRelationManager::class,
    ];
}
```

### Relation Manager Example

```php
use Filament\Resources\RelationManagers\RelationManager;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'number';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number'),
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\TextColumn::make('total')
                    ->money('eur'),
            ]);
    }
}
```

---

## Navigation

### Navigation Icons

```php
protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-group';
```

### Navigation Groups

```php
protected static string | UnitEnum | null $navigationGroup = 'Shop';

// Dynamic group
public static function getNavigationGroup(): ?string
{
    return __('filament/navigation.groups.shop');
}
```

### Navigation Sorting

```php
protected static ?int $navigationSort = 2;
```

### Parent Items (Nested Nav)

```php
protected static ?string $navigationParentItem = 'Products';
protected static string | UnitEnum | null $navigationGroup = 'Shop';
```

### Sub-navigation

```php
use Filament\Resources\Pages\Page;

public static function getRecordSubNavigation(Page $page): array
{
    return $page->generateNavigationItems([
        Pages\ViewCustomer::class,
        Pages\EditCustomer::class,
        Pages\EditCustomerContact::class,
        RelationManagers\AddressesRelationManager::class,
        RelationManagers\PaymentsRelationManager::class,
    ]);
}
```

---

## Panel Configuration

### AdminPanelProvider

```php
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        ->default()
        ->id('admin')
        ->path('admin')
        ->login()
        ->colors([
            'primary' => Color::Amber,
        ])
        ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
        ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
        ->pages([
            Pages\Dashboard::class,
        ])
        ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
        ->widgets([
            Widgets\AccountWidget::class,
            Widgets\FilamentInfoWidget::class,
        ])
        ->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ])
        ->authMiddleware([
            Authenticate::class,
        ])
        ->spa()
        ->topNavigation()
        ->sidebarCollapsibleOnDesktop()
        ->brandName('My App')
        ->brandLogo(asset('images/logo.svg'))
        ->favicon(asset('images/favicon.png'))
        ->darkMode(false)
        ->maxContentWidth('full')
        ->databaseNotifications()
        ->databaseNotificationsPolling('30s')
        ->resourceCreatePageRedirect('edit');
}
```

---

## Authorization

### Model Policy

```php
<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_customer');
    }

    public function view(User $user, Customer $customer): bool
    {
        return $user->can('view_customer');
    }

    public function create(User $user): bool
    {
        return $user->can('create_customer');
    }

    public function update(User $user, Customer $customer): bool
    {
        return $user->can('update_customer');
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->can('delete_customer');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_customer');
    }

    public function forceDelete(User $user, Customer $customer): bool
    {
        return $user->can('force_delete_customer');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_customer');
    }

    public function restore(User $user, Customer $customer): bool
    {
        return $user->can('restore_customer');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_customer');
    }

    public function reorder(User $user): bool
    {
        return $user->can('reorder_customer');
    }
}
```

### Policy Registreren

```php
// In AuthServiceProvider
protected $policies = [
    Customer::class => CustomerPolicy::class,
];
```

### Authorization Overslaan

```php
protected static bool $shouldSkipAuthorization = true;
```

---

## Pro Tips

### 1. Resource Class Klein Houden

Gebruik schema & table classes voor clean code:

```php
// ✅ Good
public static function form(Schema $schema): Schema
{
    return CustomerForm::configure($schema);
}

// ❌ Bad: Alles in resource class
public static function form(Schema $schema): Schema
{
    return $schema->components([
        // 100+ regels fields hier...
    ]);
}
```

### 2. Reusable Form Fields

```php
class CustomerForm
{
    public static function getNameField(): TextInput
    {
        return TextInput::make('name')
            ->required()
            ->maxLength(255);
    }
    
    // Gebruik in zowel form als wizard
}
```

### 3. Query Optimization

```php
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->with(['organization', 'contacts']) // Eager load
        ->withCount('orders'); // Count relations
}
```

### 4. Globale Search

```php
protected static ?string $recordTitleAttribute = 'name';

// Of custom
public static function getGlobalSearchResultTitle(Model $record): string
{
    return $record->name . ' - ' . $record->email;
}
```

### 5. Custom URLs

```php
protected static ?string $slug = 'mijn-klanten';
```

---

## Zie Ook

- [Tables Documentation](./filament-tables.md) - Columns, filters, actions
- [Forms Documentation](./filament-forms.md) - Form fields en validation
- [Actions Documentation](./filament-actions.md) - Modals, notifications
- [Advanced Documentation](./filament-advanced.md) - Widgets, tenancy, styling
