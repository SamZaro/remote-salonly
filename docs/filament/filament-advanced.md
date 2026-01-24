# Filament 4 - Advanced Features

> **Complete referentie voor Widgets, Multi-tenancy, Styling, Custom Pages en meer**

## 📋 Inhoud

1. [Widgets](#widgets)
2. [Custom Pages](#custom-pages)
3. [Global Search](#global-search)
4. [Multi-tenancy](#multi-tenancy)
5. [Styling & Theming](#styling--theming)
6. [Clusters](#clusters)
7. [User Menu](#user-menu)
8. [Advanced Techniques](#advanced-techniques)

---

## Widgets

Widgets zijn componenten voor dashboards en resource pages die stats, charts en custom content tonen.

### Stats Widget

```bash
php artisan make:filament-widget StatsOverview --stats-overview
```

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Totaal klanten', Customer::count())
                ->description('32k toename')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('Omzet', '€' . number_format(Order::sum('total'), 2))
                ->description('7% toename')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Gemiddelde bestelwaarde', '€' . number_format(Order::avg('total'), 2))
                ->description('3% afname')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }
}
```

### Chart Widget

```bash
php artisan make:filament-widget OrdersChart --chart
```

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Bestellingen';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
            ->between(
                start: now()->subYear(),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Bestellingen',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // of 'bar', 'doughnut', 'pie', 'polarArea', 'radar'
    }
}
```

### Table Widget

```bash
php artisan make:filament-widget LatestOrders --table
```

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.name'),
                Tables\Columns\TextColumn::make('total')
                    ->money('eur'),
                Tables\Columns\BadgeColumn::make('status'),
            ]);
    }
}
```

### Custom Widget

```bash
php artisan make:filament-widget CustomWidget
```

```php
<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CustomWidget extends Widget
{
    protected static string $view = 'filament.widgets.custom-widget';
    
    protected int | string | array $columnSpan = 2;
    
    protected static ?int $sort = 4;
}
```

```blade
{{-- resources/views/filament/widgets/custom-widget.blade.php --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <x-filament::icon
                icon="heroicon-o-rocket-launch"
                class="h-10 w-10 text-primary-500"
            />
            <div>
                <h2 class="text-lg font-semibold">Custom Widget</h2>
                <p class="text-sm text-gray-500">Jouw eigen content hier</p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
```

### Widget op Resource Page

```php
// In resource class
public static function getWidgets(): array
{
    return [
        CustomerStats::class,
    ];
}

// In resource page (EditCustomer)
protected function getHeaderWidgets(): array
{
    return [
        CustomerStats::class,
    ];
}

protected function getFooterWidgets(): array
{
    return [
        CustomerActivity::class,
    ];
}
```

### Widget Grid

```php
// In page class
protected function getHeaderWidgetsColumns(): int | array
{
    return 3;
}

// Of responsive
protected function getHeaderWidgetsColumns(): int | array
{
    return [
        'sm' => 1,
        'md' => 2,
        'lg' => 3,
    ];
}

// In widget class
protected int | string | array $columnSpan = [
    'md' => 2,
    'xl' => 1,
];
```

### Widget Polling

Auto-refresh widgets:

```php
protected static ?string $pollingInterval = '10s';

// Of conditional
public function getPollingInterval(): ?string
{
    if (! $this->isVisible()) {
        return null;
    }

    return '5s';
}
```

---

## Custom Pages

### Custom Page Aanmaken

```bash
php artisan make:filament-page Settings
```

```php
<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static string $view = 'filament.pages.settings';
    
    protected static ?string $navigationGroup = 'Systeem';
    
    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_name' => setting('site_name'),
            'site_email' => setting('site_email'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('site_name')
                    ->label('Sitenaam')
                    ->required(),
                
                TextInput::make('site_email')
                    ->label('Email')
                    ->email()
                    ->required(),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Opslaan')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        setting([
            'site_name' => $data['site_name'],
            'site_email' => $data['site_email'],
        ]);

        Notification::make()
            ->success()
            ->title('Instellingen opgeslagen')
            ->send();
    }
}
```

```blade
{{-- resources/views/filament/pages/settings.blade.php --}}
<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}
        
        <div class="mt-6">
            {{ $this->getFormActions() }}
        </div>
    </form>
</x-filament-panels::page>
```

### Page Met Actions

```php
protected function getHeaderActions(): array
{
    return [
        Action::make('clearCache')
            ->label('Cache wissen')
            ->icon('heroicon-m-trash')
            ->requiresConfirmation()
            ->action(function () {
                Artisan::call('cache:clear');
                
                Notification::make()
                    ->success()
                    ->title('Cache gewist')
                    ->send();
            }),
    ];
}
```

### Page Met Widgets

```php
protected function getHeaderWidgets(): array
{
    return [
        ServerStatsWidget::class,
    ];
}
```

---

## Global Search

### Global Search Configureren

```php
// In resource class
protected static ?string $recordTitleAttribute = 'name';

// Of custom
public static function getGlobalSearchResultTitle(Model $record): string
{
    return $record->full_name;
}

// Details tonen
public static function getGlobalSearchResultDetails(Model $record): array
{
    return [
        'Email' => $record->email,
        'Telefoon' => $record->phone,
    ];
}

// URL aanpassen
public static function getGlobalSearchResultUrl(Model $record): ?string
{
    return CustomerResource::getUrl('edit', ['record' => $record]);
}

// Query customizen
public static function getGlobalSearchEloquentQuery(): Builder
{
    return parent::getGlobalSearchEloquentQuery()
        ->with(['organization', 'contacts']);
}

// Attributen voor search
protected static ?string $globalSearchAttributes = ['email', 'phone'];
```

### Global Search Debounce

```php
// In AdminPanelProvider
public function panel(Panel $panel): Panel
{
    return $panel
        ->globalSearchDebounce('500ms')
        ->globalSearchFieldKeyBindings(['command+k', 'ctrl+k']);
}
```

---

## Multi-tenancy

Multi-tenancy zorgt ervoor dat users alleen data van hun eigen organisatie/team zien.

### Tenant Model Setup

```php
// In User model
public function organization(): BelongsTo
{
    return $this->belongsTo(Organization::class);
}

// In Organization model
public function members(): HasMany
{
    return $this->hasMany(User::class);
}
```

### Panel Tenancy Config

```php
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;

public function panel(Panel $panel): Panel
{
    return $panel
        ->tenant(Organization::class)
        ->tenantProfile(OrganizationProfile::class)
        ->tenantRegistration(RegisterOrganization::class)
        ->tenantRoutePrefix('org')
        ->tenantMiddleware([
            // Custom middleware
        ])
        ->requiresTenantSubscription(); // For billing
}
```

### Tenant Profile Page

```bash
php artisan make:filament-page OrganizationProfile --type=tenant-profile
```

```php
<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;

class OrganizationProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Organisatie profiel';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                
                TextInput::make('email')
                    ->email()
                    ->required(),
            ]);
    }
}
```

### Tenant Registration

```bash
php artisan make:filament-page RegisterOrganization --type=tenant-registration
```

```php
<?php

namespace App\Filament\Pages;

use App\Models\Organization;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterOrganization extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Nieuwe organisatie';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('slug')
                    ->required()
                    ->unique(Organization::class, 'slug'),
            ]);
    }

    protected function handleRegistration(array $data): Organization
    {
        $organization = Organization::create($data);

        $organization->members()->attach(auth()->user());

        return $organization;
    }
}
```

### Scoping Queries Per Tenant

```php
// In resource class
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->whereBelongsTo(Filament::getTenant());
}

// In model
protected static function booted(): void
{
    static::addGlobalScope('organization', function (Builder $builder) {
        if (Filament::hasTenant()) {
            $builder->whereBelongsTo(Filament::getTenant());
        }
    });
}

// Auto-assign tenant bij create
protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['organization_id'] = Filament::getTenant()->id;
    
    return $data;
}
```

### Tenant Billing

```php
use Filament\Panel;
use Filament\Pages\Tenancy\RegisterTenant;

public function panel(Panel $panel): Panel
{
    return $panel
        ->tenant(Organization::class)
        ->tenantBillingProvider(new StripeBillingProvider())
        ->requiresTenantSubscription();
}

// In Organization model
public function canAccessPanel(Panel $panel): bool
{
    return $this->hasActiveSubscription();
}
```

---

## Styling & Theming

### Custom Colors

```php
use Filament\Support\Colors\Color;

public function panel(Panel $panel): Panel
{
    return $panel
        ->colors([
            'primary' => Color::Amber,
            'danger' => Color::Rose,
            'gray' => Color::Slate,
            'info' => Color::Blue,
            'success' => Color::Emerald,
            'warning' => Color::Orange,
        ]);
}

// Of custom hex colors
->colors([
    'primary' => '#6366f1',
])
```

### Dark Mode

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->darkMode(true) // Enable
        ->darkMode(false) // Disable
        ->darkModeForceIcon('heroicon-o-moon');
}
```

### Custom Theme

```bash
php artisan make:filament-theme
```

Dit creëert `resources/css/filament/admin/theme.css`:

```css
@import '/vendor/filament/filament/resources/css/index.css';

@config 'tailwind.config.js';

/* Custom styles */
.fi-topbar {
    background-color: theme('colors.primary.600');
}

.fi-sidebar {
    background-color: theme('colors.gray.50');
}

.dark .fi-sidebar {
    background-color: theme('colors.gray.900');
}
```

Registreer in panel:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->viteTheme('resources/css/filament/admin/theme.css');
}
```

### CSS Hooks

Target specifieke elementen:

```css
/* Table header */
.fi-ta-header-cell {
    background-color: theme('colors.gray.100');
}

/* Form section */
.fi-fo-section {
    border-radius: theme('borderRadius.xl');
}

/* Action button */
.fi-btn-primary {
    box-shadow: theme('boxShadow.lg');
}
```

### Brand Logo

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->brandName('My Application')
        ->brandLogo(asset('images/logo.svg'))
        ->darkModeBrandLogo(asset('images/logo-dark.svg'))
        ->brandLogoHeight('2rem')
        ->favicon(asset('images/favicon.png'));
}
```

### Custom Icons

```bash
composer require blade-ui-kit/blade-heroicons
```

```php
// In config/filament.php
'icons' => [
    'panels::sidebar.collapse-button' => 'heroicon-o-chevron-left',
    'panels::sidebar.expand-button' => 'heroicon-o-chevron-right',
],
```

### Font Family

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->font('Inter');
}
```

---

## Clusters

Clusters groeperen resources en pages logisch samen met eigen navigation.

### Cluster Aanmaken

```bash
php artisan make:filament-cluster Shop
```

```php
<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Shop extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    
    protected static ?string $navigationLabel = 'Winkel';
    
    protected static ?int $navigationSort = 1;
}
```

### Resource in Cluster

```bash
php artisan make:filament-resource Product --cluster=Shop
```

```php
<?php

namespace App\Filament\Clusters\Shop\Resources;

use App\Filament\Clusters\Shop;
use Filament\Resources\Resource;

class ProductResource extends Resource
{
    protected static ?string $cluster = Shop::class;
    
    // Rest of resource...
}
```

### Page in Cluster

```bash
php artisan make:filament-page Reports --cluster=Shop
```

---

## User Menu

### Custom User Menu Items

```php
use Filament\Navigation\MenuItem;

public function panel(Panel $panel): Panel
{
    return $panel
        ->userMenuItems([
            MenuItem::make()
                ->label('Instellingen')
                ->url(route('settings'))
                ->icon('heroicon-o-cog-6-tooth'),
            
            MenuItem::make()
                ->label('Profiel')
                ->url(fn (): string => ProfileResource::getUrl())
                ->icon('heroicon-o-user'),
            
            'logout' => MenuItem::make()
                ->label('Uitloggen'),
        ]);
}
```

---

## Advanced Techniques

### 1. Resource Sub-Navigation

```php
use Filament\Resources\Pages\Page;

public static function getRecordSubNavigation(Page $page): array
{
    return $page->generateNavigationItems([
        Pages\ViewCustomer::class,
        Pages\EditCustomer::class,
        Pages\ManageCustomerOrders::class,
        Pages\ManageCustomerInvoices::class,
    ]);
}
```

### 2. Custom Panel Path

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->id('admin')
        ->path('beheer') // Custom path
        ->homeUrl('/dashboard');
}
```

### 3. Top Navigation

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->topNavigation()
        ->maxContentWidth('full');
}
```

### 4. Render Hooks

Inject custom HTML op specifieke plekken:

```php
use Filament\View\PanelsRenderHook;

public function panel(Panel $panel): Panel
{
    return $panel
        ->renderHook(
            PanelsRenderHook::BODY_START,
            fn (): string => Blade::render('<div>Custom header</div>'),
        )
        ->renderHook(
            PanelsRenderHook::SIDEBAR_NAV_START,
            fn (): string => view('filament.custom-sidebar-item'),
        );
}
```

Available hooks:
- `BODY_START`
- `BODY_END`
- `HEAD_START`
- `HEAD_END`
- `SIDEBAR_NAV_START`
- `SIDEBAR_NAV_END`
- `TOPBAR_START`
- `TOPBAR_END`
- `FOOTER`
- `GLOBAL_SEARCH_START`
- `GLOBAL_SEARCH_END`
- `USER_MENU_START`
- `USER_MENU_END`

### 5. SPA Mode

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->spa();
}
```

### 6. Unsaved Changes Alerts

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->unsavedChangesAlerts();
}
```

### 7. Database Notifications

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->databaseNotifications()
        ->databaseNotificationsPolling('30s');
}
```

### 8. Collapsible Sidebar

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->sidebarCollapsibleOnDesktop()
        ->sidebarFullyCollapsibleOnDesktop();
}
```

### 9. Navigation Badge

```php
protected static ?string $navigationBadge = '12';

protected static ?string $navigationBadgeColor = 'warning';

// Dynamic
public static function getNavigationBadge(): ?string
{
    return static::getModel()::where('status', 'pending')->count();
}

public static function getNavigationBadgeColor(): ?string
{
    $count = static::getNavigationBadge();
    
    return $count > 10 ? 'danger' : 'primary';
}
```

### 10. Resource Loading States

```php
// In resource page
protected $queryString = [
    'tableFilters',
    'tableSortColumn',
    'tableSortDirection',
];

public function mount(): void
{
    $this->authorizeAccess();
}
```

---

## Pro Tips

### 1. Custom Dashboard

```php
// In AdminPanelProvider
use App\Filament\Pages\Dashboard;

public function panel(Panel $panel): Panel
{
    return $panel
        ->pages([
            Dashboard::class,
        ])
        ->default(); // Set as default page
}
```

### 2. Multiple Panels

```bash
php artisan make:filament-panel app
```

```php
// In AppServiceProvider
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\Filament\AppPanelProvider;

public function register(): void
{
    $this->app->register(AdminPanelProvider::class);
    $this->app->register(AppPanelProvider::class);
}
```

### 3. Panel Middleware

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->authMiddleware([
            Authenticate::class,
            'verified',
        ])
        ->middleware([
            // Panel-wide middleware
        ]);
}
```

### 4. Custom Login Page

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->login(CustomLogin::class)
        ->registration(CustomRegister::class)
        ->passwordReset(CustomPasswordReset::class)
        ->emailVerification(CustomEmailVerification::class);
}
```

### 5. Layout Customization

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->maxContentWidth('full')
        ->sidebarWidth('15rem')
        ->topbar(false);
}
```

### 6. Resource Discovery

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->discoverResources(
            in: app_path('Filament/Resources'),
            for: 'App\\Filament\\Resources'
        )
        ->discoverPages(
            in: app_path('Filament/Pages'),
            for: 'App\\Filament\\Pages'
        )
        ->discoverWidgets(
            in: app_path('Filament/Widgets'),
            for: 'App\\Filament\\Widgets'
        )
        ->discoverClusters(
            in: app_path('Filament/Clusters'),
            for: 'App\\Filament\\Clusters'
        );
}
```

---

## Widget Recipe: Complete Dashboard

```php
<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $thisMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();

        $thisMonthRevenue = Order::where('created_at', '>=', $thisMonth)
            ->sum('total');
        
        $lastMonthRevenue = Order::whereBetween('created_at', [$lastMonth, $thisMonth])
            ->sum('total');

        $percentageChange = $lastMonthRevenue > 0
            ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 100;

        return [
            Stat::make('Totaal Klanten', Customer::count())
                ->description(Customer::where('created_at', '>=', $thisMonth)->count() . ' deze maand')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            
            Stat::make('Actieve Bestellingen', Order::where('status', 'processing')->count())
                ->description(Order::where('status', 'pending')->count() . ' in afwachting')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),
            
            Stat::make('Omzet Deze Maand', '€' . number_format($thisMonthRevenue, 2))
                ->description(number_format($percentageChange, 1) . '% ' . ($percentageChange >= 0 ? 'toename' : 'afname'))
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger')
                ->chart([
                    Order::whereBetween('created_at', [$lastMonth, $lastMonth->copy()->addDays(7)])->sum('total'),
                    Order::whereBetween('created_at', [$lastMonth->copy()->addDays(7), $lastMonth->copy()->addDays(14)])->sum('total'),
                    Order::whereBetween('created_at', [$lastMonth->copy()->addDays(14), $lastMonth->copy()->addDays(21)])->sum('total'),
                    Order::whereBetween('created_at', [$lastMonth->copy()->addDays(21), $thisMonth])->sum('total'),
                    Order::whereBetween('created_at', [$thisMonth, $thisMonth->copy()->addDays(7)])->sum('total'),
                    Order::whereBetween('created_at', [$thisMonth->copy()->addDays(7), $thisMonth->copy()->addDays(14)])->sum('total'),
                    Order::whereBetween('created_at', [$thisMonth->copy()->addDays(14), now()])->sum('total'),
                ]),
            
            Stat::make('Voorraadwaarde', '€' . number_format(Product::sum(\DB::raw('stock * price')), 2))
                ->description(Product::where('stock', '<', 10)->count() . ' producten laag')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
```

---

## Zie Ook

- [Core Documentation](./filament-core.md) - Resources basics
- [Forms Documentation](./filament-forms.md) - Form fields in custom pages
- [Actions Documentation](./filament-actions.md) - Actions in widgets/pages
- [Testing Documentation](./filament-testing.md) - Test advanced features
