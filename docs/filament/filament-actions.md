# Filament 4 - Actions & Notifications

> **Complete referentie voor Actions, Modals, Notifications, Infolists, Import/Export**

## 📋 Inhoud

1. [Actions Overview](#actions-overview)
2. [Modals](#modals)
3. [Prebuilt Actions](#prebuilt-actions)
4. [Notifications](#notifications)
5. [Infolists](#infolists)
6. [Import/Export](#importexport)
7. [Pro Tips](#pro-tips)

---

## Actions Overview

Actions zijn knoppen die Livewire methods uitvoeren of URLs openen. Ze kunnen overal gebruikt worden: pages, tables, forms, etc.

### Basic Action

```php
use Filament\Actions\Action;

Action::make('activate')
    ->label('Activeren')
    ->icon('heroicon-m-check')
    ->color('success')
    ->action(fn (Customer $record) => $record->activate())
    ->requiresConfirmation()
    ->modalHeading('Klant activeren')
    ->modalDescription('Weet je zeker dat je deze klant wilt activeren?')
    ->modalSubmitActionLabel('Ja, activeren')
    ->successNotificationTitle('Klant geactiveerd')
```

### Action Locations

```php
// Page header actions
protected function getHeaderActions(): array
{
    return [
        Action::make('export'),
        Action::make('import'),
    ];
}

// Form actions (onder form)
protected function getFormActions(): array
{
    return [
        Action::make('save'),
        Action::make('cancel'),
    ];
}

// Table actions (per row)
->recordActions([
    EditAction::make(),
    ViewAction::make(),
])

// Table toolbar actions (boven table)
->toolbarActions([
    CreateAction::make(),
])
```

### Action Button Styles

```php
Action::make('save')
    ->button() // Primary button
    ->outlined() // Outlined button
    ->link() // Link style
    ->grouped() // Groepeer met andere actions
    ->extraAttributes(['class' => 'my-custom-class'])
```

### Action Colors

```php
Action::make('delete')
    ->color('danger')
// Options: primary, success, warning, danger, info, gray
```

### Action Sizes

```php
Action::make('save')
    ->size('sm') // xs, sm, md (default), lg, xl
```

### Action Icons

```php
Action::make('download')
    ->icon('heroicon-m-arrow-down-tray')
    ->iconPosition('after') // Voor of na label
```

### Action URLs

```php
Action::make('view')
    ->url(fn (Customer $record): string => 
        CustomerResource::getUrl('view', ['record' => $record])
    )
    ->openUrlInNewTab()
```

### Action Visibility

```php
Action::make('approve')
    ->visible(fn (Post $record): bool => 
        $record->status === 'pending' && auth()->user()->can('approve', $record)
    )
    ->hidden(fn (Post $record): bool => 
        $record->status === 'approved'
    )
    ->disabled(fn (Post $record): bool => 
        ! $record->isReadyForApproval()
    )
```

### Action Authorization

```php
Action::make('delete')
    ->authorize(fn (Customer $record): bool => 
        auth()->user()->can('delete', $record)
    )
```

---

## Modals

### Basic Modal

```php
Action::make('details')
    ->modalContent(view('filament.customer-details'))
    ->modalHeading('Klant Details')
    ->modalDescription('Bekijk de volledige klantinformatie')
    ->modalSubmitActionLabel('Sluiten')
    ->modalCancelActionLabel('Annuleren')
    ->modalWidth('5xl') // xs, sm, md, lg, xl, 2xl, 3xl, 4xl, 5xl, 6xl, 7xl
```

### Modal Met Form

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

Action::make('editStatus')
    ->form([
        Select::make('status')
            ->options([
                'pending' => 'In afwachting',
                'processing' => 'In behandeling',
                'completed' => 'Afgerond',
            ])
            ->required(),
        
        Textarea::make('notes')
            ->label('Opmerkingen'),
    ])
    ->action(function (array $data, Order $record): void {
        $record->update([
            'status' => $data['status'],
            'notes' => $data['notes'],
        ]);
        
        Notification::make()
            ->success()
            ->title('Status bijgewerkt')
            ->send();
    })
```

### Modal Fill Default Data

```php
Action::make('edit')
    ->fillForm(fn (Customer $record): array => [
        'name' => $record->name,
        'email' => $record->email,
        'phone' => $record->phone,
    ])
    ->form([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
        TextInput::make('phone'),
    ])
    ->action(function (array $data, Customer $record): void {
        $record->update($data);
    })
```

### Modal Confirmation

```php
Action::make('delete')
    ->requiresConfirmation()
    ->modalIcon('heroicon-o-trash')
    ->modalIconColor('danger')
    ->modalHeading('Klant verwijderen')
    ->modalDescription('Weet je zeker dat je deze klant wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.')
    ->modalSubmitActionLabel('Ja, verwijderen')
    ->action(fn (Customer $record) => $record->delete())
```

### Wizard in Modal

```php
use Filament\Forms\Components\Wizard;

Action::make('onboard')
    ->form([
        Wizard::make([
            Wizard\Step::make('Account')
                ->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->required(),
                ]),
            
            Wizard\Step::make('Profile')
                ->schema([
                    FileUpload::make('avatar')->image(),
                    Textarea::make('bio'),
                ]),
            
            Wizard\Step::make('Preferences')
                ->schema([
                    Toggle::make('newsletter'),
                    Select::make('language')->options([...]),
                ]),
        ])
            ->skippable(),
    ])
    ->action(function (array $data): void {
        // Process wizard data
    })
```

### Sliding Modal

```php
Action::make('details')
    ->slideOver()
    ->modalContent(view('...'))
```

### Modal Width

```php
Action::make('details')
    ->modalWidth('7xl')
    ->modalContent(view('...'))
```

### Modal Alignment

```php
Action::make('details')
    ->modalAlignment('start') // start, center (default), end
    ->modalContent(view('...'))
```

### Modal Footer Actions

```php
Action::make('process')
    ->form([...])
    ->modalFooterActions([
        Action::make('processAndNotify')
            ->label('Verwerken & Notificeren')
            ->action(function (array $data, Order $record): void {
                $record->process($data);
                $record->customer->notify(new OrderProcessed($record));
            }),
    ])
```

---

## Prebuilt Actions

### Create Action

```php
use Filament\Actions\CreateAction;

CreateAction::make()
    ->model(Customer::class)
    ->form([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
    ])
    ->mutateFormDataUsing(function (array $data): array {
        $data['user_id'] = auth()->id();
        return $data;
    })
    ->using(function (array $data, string $model): Model {
        return $model::create($data);
    })
    ->successNotificationTitle('Klant aangemaakt')
```

### Edit Action

```php
use Filament\Actions\EditAction;

EditAction::make()
    ->form([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
    ])
    ->mutateRecordDataUsing(function (array $data): array {
        // Modify before filling form
        return $data;
    })
    ->mutateFormDataUsing(function (array $data): array {
        // Modify before saving
        $data['updated_by'] = auth()->id();
        return $data;
    })
```

### View Action

```php
use Filament\Actions\ViewAction;

ViewAction::make()
    ->infolist([
        TextEntry::make('name'),
        TextEntry::make('email'),
        TextEntry::make('created_at')->dateTime(),
    ])
```

### Delete Action

```php
use Filament\Actions\DeleteAction;

DeleteAction::make()
    ->requiresConfirmation()
    ->successNotificationTitle('Klant verwijderd')
    ->before(function (Customer $record) {
        // Cleanup before delete
        $record->orders()->delete();
    })
    ->after(function (Customer $record) {
        // Audit log
        activity()->performedOn($record)->log('deleted');
    })
```

### Replicate Action

```php
use Filament\Actions\ReplicateAction;

ReplicateAction::make()
    ->excludeAttributes(['slug', 'email'])
    ->beforeReplicaSaved(function (Model $replica): void {
        $replica->status = 'draft';
    })
    ->successNotificationTitle('Klant gedupliceerd')
```

### Force Delete Action (Soft Deletes)

```php
use Filament\Actions\ForceDeleteAction;

ForceDeleteAction::make()
    ->requiresConfirmation()
    ->successNotificationTitle('Klant permanent verwijderd')
```

### Restore Action (Soft Deletes)

```php
use Filament\Actions\RestoreAction;

RestoreAction::make()
    ->successNotificationTitle('Klant hersteld')
```

---

## Notifications

### Flash Notifications

```php
use Filament\Notifications\Notification;

Notification::make()
    ->title('Opgeslagen')
    ->body('De klant is succesvol opgeslagen.')
    ->success()
    ->send();

// Of direct in action
Action::make('save')
    ->action(fn () => /* ... */)
    ->successNotification(
        Notification::make()
            ->success()
            ->title('Opgeslagen')
            ->body('Wijzigingen zijn opgeslagen.')
    )
```

### Notification Types

```php
Notification::make()
    ->success() // Groen
    ->warning() // Oranje
    ->danger() // Rood
    ->info() // Blauw
    ->send();
```

### Notification Duration

```php
Notification::make()
    ->title('Bericht')
    ->duration(5000) // 5 seconden (null = permanent)
    ->send();
```

### Notification Actions

```php
Notification::make()
    ->title('Nieuwe bestelling')
    ->body('Er is een nieuwe bestelling binnengekomen.')
    ->actions([
        NotificationAction::make('view')
            ->button()
            ->url(route('orders.show', $order)),
        
        NotificationAction::make('markAsRead')
            ->button()
            ->markAsRead(),
    ])
    ->send();
```

### Notification Icons

```php
Notification::make()
    ->title('Email verzonden')
    ->icon('heroicon-o-envelope')
    ->iconColor('success')
    ->send();
```

### Persistent Notifications

```php
Notification::make()
    ->warning()
    ->title('Belangrijk!')
    ->body('Je abonnement verloopt over 3 dagen.')
    ->persistent() // Blijft tot user dismiss
    ->send();
```

### Send To User

```php
use Filament\Notifications\Notification;

Notification::make()
    ->title('Bericht voor jou')
    ->sendToDatabase($user);
```

### Database Notifications

```bash
php artisan make:notifications-table
php artisan migrate
```

```php
// In panel config
public function panel(Panel $panel): Panel
{
    return $panel
        ->databaseNotifications()
        ->databaseNotificationsPolling('30s');
}

// Send database notification
Notification::make()
    ->title('Nieuwe bestelling')
    ->body('Bestelling #' . $order->number)
    ->icon('heroicon-o-shopping-cart')
    ->actions([
        NotificationAction::make('view')
            ->url(OrderResource::getUrl('view', ['record' => $order])),
    ])
    ->sendToDatabase(auth()->user());

// Send to multiple users
$users = User::where('role', 'admin')->get();
Notification::make()
    ->title('Systeem update')
    ->sendToDatabase($users);
```

### Broadcast Notifications (Real-time)

```bash
composer require pusher/pusher-php-server
```

```php
// In panel config
public function panel(Panel $panel): Panel
{
    return $panel
        ->databaseNotifications()
        ->broadcastNotifications()
        ->databaseNotificationsPolling(null); // Disable polling
}

// Send broadcast notification
Notification::make()
    ->title('Nieuwe chat bericht')
    ->broadcast(auth()->user());
```

---

## Infolists

Read-only weergave van data (alternatief voor View pages).

### Basic Infolist

```php
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Section::make('Klant Informatie')
                ->schema([
                    TextEntry::make('name')
                        ->label('Naam'),
                    
                    TextEntry::make('email')
                        ->icon('heroicon-m-envelope')
                        ->copyable()
                        ->copyMessage('Email gekopieerd!')
                        ->copyMessageDuration(1500),
                    
                    TextEntry::make('phone')
                        ->icon('heroicon-m-phone'),
                    
                    TextEntry::make('created_at')
                        ->dateTime('d-m-Y H:i')
                        ->label('Aangemaakt'),
                ])
                ->columns(2),
        ]);
}
```

### Entry Types

```php
// Text Entry
TextEntry::make('name')
    ->badge()
    ->color('success')
    ->icon('heroicon-m-check')
    ->weight('bold')
    ->size('lg')
    ->limit(50)
    ->html()
    ->markdown()
    ->money('eur')
    ->date('d-m-Y')
    ->dateTime()
    ->since()
    ->formatStateUsing(fn (string $state): string => ucwords($state)),

// Icon Entry
IconEntry::make('is_active')
    ->boolean()
    ->icon(fn ($state) => $state ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
    ->color(fn ($state) => $state ? 'success' : 'danger'),

// Image Entry
ImageEntry::make('avatar')
    ->circular()
    ->size(60),

// Color Entry
ColorEntry::make('color')
    ->copyable(),

// Code Entry (Syntax Highlighting)
CodeEntry::make('source')
    ->language('php'),

// Key-Value Entry
KeyValueEntry::make('metadata')
    ->keyLabel('Sleutel')
    ->valueLabel('Waarde'),

// Repeatable Entry
RepeatableEntry::make('contacts')
    ->schema([
        TextEntry::make('name'),
        TextEntry::make('email'),
    ])
    ->columns(2),
```

### Infolist Layouts

```php
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\Grid;

Section::make('Details')
    ->schema([...])
    ->collapsible()
    ->collapsed(),

Split::make([
    Section::make([...])->grow(),
    Section::make([...])->grow(false),
]),

Grid::make(2)
    ->schema([...]),
```

### Infolist Actions

```php
TextEntry::make('status')
    ->badge()
    ->actions([
        Action::make('edit')
            ->icon('heroicon-m-pencil')
            ->form([
                Select::make('status')->options([...]),
            ])
            ->action(function (array $data, $record): void {
                $record->update($data);
            }),
    ]),
```

---

## Import/Export

### Import Action

```bash
php artisan make:filament-importer Product
```

```php
// In List page
use App\Filament\Imports\ProductImporter;
use Filament\Actions\ImportAction;

protected function getHeaderActions(): array
{
    return [
        ImportAction::make()
            ->importer(ProductImporter::class),
    ];
}
```

### Importer Class

```php
<?php

namespace App\Filament\Imports;

use App\Models\Product;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ProductImporter extends Importer
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            
            ImportColumn::make('sku')
                ->requiredMapping()
                ->rules(['required', 'unique:products,sku']),
            
            ImportColumn::make('price')
                ->numeric()
                ->rules(['required', 'numeric', 'min:0']),
            
            ImportColumn::make('stock')
                ->integer()
                ->rules(['required', 'integer', 'min:0']),
            
            ImportColumn::make('category')
                ->relationship(resolveUsing: 'name')
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?Product
    {
        return Product::firstOrNew([
            'sku' => $this->data['sku'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Je product import is voltooid. ' . 
                number_format($import->successful_rows) . ' ' . 
                str('rij')->plural($import->successful_rows) . ' geïmporteerd.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . 
                     str('rij')->plural($failedRowsCount) . ' gefaald.';
        }

        return $body;
    }
}
```

### Export Action

```php
use Filament\Actions\ExportAction;
use App\Filament\Exports\ProductExporter;

protected function getHeaderActions(): array
{
    return [
        ExportAction::make()
            ->exporter(ProductExporter::class),
    ];
}
```

### Exporter Class

```php
<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id'),
            ExportColumn::make('name'),
            ExportColumn::make('sku'),
            ExportColumn::make('price')
                ->formatStateUsing(fn ($state) => number_format($state, 2)),
            ExportColumn::make('stock'),
            ExportColumn::make('category.name'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Je product export is voltooid. ' . 
                number_format($export->successful_rows) . ' ' . 
                str('rij')->plural($export->successful_rows) . ' geëxporteerd.';

        return $body;
    }
}
```

---

## Pro Tips

### 1. Action Chaining

```php
Action::make('publish')
    ->action(function (Post $record) {
        $record->publish();
    })
    ->successNotification(
        Notification::make()
            ->success()
            ->title('Gepubliceerd')
            ->body('Het bericht is nu live.')
    )
    ->after(function (Post $record) {
        // Send notification to subscribers
        $record->notifySubscribers();
    })
```

### 2. Bulk Actions Met Progress

```php
BulkAction::make('process')
    ->action(function (Collection $records) {
        $records->each(function ($record) {
            $record->process();
            
            Notification::make()
                ->title("Verwerkt: {$record->name}")
                ->success()
                ->send();
        });
    })
    ->deselectRecordsAfterCompletion()
```

### 3. Modal Met Livewire Component

```php
Action::make('details')
    ->modalContent(fn (Customer $record) => 
        new ViewCustomerDetails(['customer' => $record])
    )
```

### 4. Action Groups

```php
use Filament\Actions\ActionGroup;

ActionGroup::make([
    Action::make('edit'),
    Action::make('delete'),
    Action::make('duplicate'),
])
    ->label('Acties')
    ->icon('heroicon-m-ellipsis-vertical')
    ->size('sm')
    ->color('gray')
    ->button()
```

### 5. Conditional Actions

```php
Action::make('approve')
    ->visible(fn (Order $record): bool => 
        $record->status === 'pending' && 
        auth()->user()->can('approve', $record)
    )
    ->action(function (Order $record) {
        $record->approve();
        
        Notification::make()
            ->success()
            ->title('Bestelling goedgekeurd')
            ->body("Bestelling #{$record->number} is goedgekeurd.")
            ->send();
    })
```

### 6. Action With File Download

```php
Action::make('downloadInvoice')
    ->label('Download factuur')
    ->icon('heroicon-m-arrow-down-tray')
    ->url(fn (Order $record) => 
        route('orders.invoice.download', $record)
    )
    ->download()
```

### 7. Multi-Step Action

```php
Action::make('complete')
    ->steps([
        Step::make('verify')
            ->description('Controleer gegevens')
            ->schema([
                Placeholder::make('info')
                    ->content('Controleer of alles correct is'),
            ]),
        
        Step::make('confirm')
            ->description('Bevestig voltooiing')
            ->schema([
                Checkbox::make('confirmed')
                    ->label('Ik bevestig dat alles correct is')
                    ->required(),
            ]),
    ])
    ->action(function (array $data, Order $record) {
        $record->complete();
    })
```

### 8. Action With API Call

```php
Action::make('syncWithStripe')
    ->label('Sync met Stripe')
    ->icon('heroicon-m-arrow-path')
    ->requiresConfirmation()
    ->action(function (Customer $record) {
        try {
            $stripeCustomer = \Stripe\Customer::retrieve($record->stripe_id);
            
            $record->update([
                'stripe_data' => $stripeCustomer->toArray(),
                'synced_at' => now(),
            ]);
            
            Notification::make()
                ->success()
                ->title('Gesynchroniseerd')
                ->body('Klant is gesync met Stripe.')
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->danger()
                ->title('Sync gefaald')
                ->body($e->getMessage())
                ->send();
        }
    })
```

---

## Action Recipe: Complete Example

```php
// In ListCustomers page
protected function getHeaderActions(): array
{
    return [
        ImportAction::make()
            ->importer(CustomerImporter::class)
            ->icon('heroicon-m-arrow-up-tray')
            ->color('gray'),
        
        ExportAction::make()
            ->exporter(CustomerExporter::class)
            ->icon('heroicon-m-arrow-down-tray')
            ->color('gray'),
        
        Action::make('bulkNotify')
            ->label('Bulk notificatie')
            ->icon('heroicon-m-bell')
            ->form([
                Select::make('template')
                    ->options([
                        'newsletter' => 'Nieuwsbrief',
                        'promotion' => 'Promotie',
                        'update' => 'Product update',
                    ])
                    ->required(),
                
                Textarea::make('message')
                    ->required()
                    ->rows(5),
            ])
            ->action(function (array $data) {
                $customers = Customer::where('newsletter_subscribed', true)->get();
                
                foreach ($customers as $customer) {
                    Notification::make()
                        ->title($data['template'])
                        ->body($data['message'])
                        ->sendToDatabase($customer->user);
                }
                
                Notification::make()
                    ->success()
                    ->title('Notificaties verzonden')
                    ->body(count($customers) . ' klanten genotificeerd.')
                    ->send();
            })
            ->requiresConfirmation(),
        
        CreateAction::make()
            ->icon('heroicon-m-plus'),
    ];
}

// Table actions
->recordActions([
    ActionGroup::make([
        ViewAction::make(),
        
        EditAction::make(),
        
        Action::make('sendEmail')
            ->icon('heroicon-m-envelope')
            ->form([
                Select::make('template')
                    ->options([
                        'welcome' => 'Welkom email',
                        'followup' => 'Follow-up',
                    ])
                    ->required(),
            ])
            ->action(function (array $data, Customer $record) {
                Mail::to($record->email)
                    ->send(new CustomerEmail($data['template'], $record));
                
                Notification::make()
                    ->success()
                    ->title('Email verzonden')
                    ->send();
            }),
        
        Action::make('impersonate')
            ->icon('heroicon-m-user')
            ->visible(fn () => auth()->user()->isAdmin())
            ->requiresConfirmation()
            ->action(function (Customer $record) {
                auth()->user()->impersonate($record->user);
                return redirect()->to('/');
            }),
        
        DeleteAction::make(),
    ])
        ->label('Acties')
        ->icon('heroicon-m-ellipsis-vertical')
        ->size('sm')
        ->color('gray')
        ->button(),
])
```

---

## Zie Ook

- [Core Documentation](./filament-core.md) - Resources en authorization
- [Tables Documentation](./filament-tables.md) - Table actions
- [Forms Documentation](./filament-forms.md) - Form fields in modals
