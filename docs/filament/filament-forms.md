# Filament 4 - Forms

> **Complete referentie voor Form Fields, Validation, Schemas en Layouts**

## 📋 Inhoud

1. [Overview](#overview)
2. [Form Fields](#form-fields)
3. [Validation](#validation)
4. [Schemas & Layouts](#schemas--layouts)
5. [Advanced Fields](#advanced-fields)
6. [File Uploads](#file-uploads)
7. [Rich Content](#rich-content)
8. [Repeaters & Builders](#repeaters--builders)
9. [Pro Tips](#pro-tips)

---

## Overview

Forms in Filament worden declaratief gedefinieerd met PHP classes. Geen Blade views nodig!

### Basic Form Setup

```php
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

public static function form(Schema $schema): Schema
{
    return $schema
        ->components([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            
            TextInput::make('email')
                ->email()
                ->required(),
            
            Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->default('draft'),
        ]);
}
```

---

## Form Fields

### Text Input

```php
TextInput::make('name')
    ->label('Naam')
    ->placeholder('Vul uw naam in')
    ->helperText('Uw volledige naam')
    ->hint('Minimaal 3 karakters')
    ->required()
    ->minLength(3)
    ->maxLength(255)
    ->default('John Doe')
    ->disabled()
    ->readonly() // Verschil met disabled: wordt wel submitted
    ->autofocus()
    ->autocomplete('name')
    ->datalist(['John', 'Jane', 'Bob']) // Suggesties
    ->prefix('€')
    ->suffix('per maand')
    ->mask('9999-9999-9999-9999') // Credit card
    ->stripCharacters(['-', ' '])
    ->tel() // Tel format
    ->url() // URL format
    ->numeric()
    ->integer()
    ->minValue(0)
    ->maxValue(100)
    ->step(5)
    ->live(onBlur: true) // Live validation
    ->afterStateUpdated(fn (string $state, callable $set) => 
        $set('slug', Str::slug($state))
    )
```

### Email Input

```php
TextInput::make('email')
    ->email()
    ->unique(Customer::class, 'email', ignoreRecord: true)
    ->required()
```

### Password Input

```php
TextInput::make('password')
    ->password()
    ->required()
    ->minLength(8)
    ->confirmed() // Vereist password_confirmation field
    ->revealable() // Toggle visibility
    ->dehydrated(fn ($state) => filled($state)) // Alleen hashen als ingevuld
    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
```

### Textarea

```php
Textarea::make('description')
    ->rows(5)
    ->cols(20)
    ->minLength(50)
    ->maxLength(500)
    ->autosize() // Auto groei
    ->resize('vertical') // none, vertical, horizontal, both
```

### Select

```php
use Filament\Forms\Components\Select;

Select::make('status')
    ->options([
        'draft' => 'Draft',
        'reviewing' => 'In review',
        'published' => 'Gepubliceerd',
    ])
    ->default('draft')
    ->required()
    ->searchable()
    ->native(false) // Custom UI
    ->multiple() // Multiple select
    ->preload() // Load options direct
    ->allowHtml() // HTML in options
    ->optionsLimit(50)
```

### Select Met Relationship

```php
Select::make('author_id')
    ->relationship('author', 'name')
    ->searchable()
    ->preload()
    ->required()
    ->createOptionForm([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
    ])
    ->editOptionForm([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
    ])
```

### Checkbox

```php
Checkbox::make('is_active')
    ->label('Actief')
    ->helperText('Activeer om zichtbaar te maken')
    ->default(true)
    ->inline(false) // Label positie
    ->accepted() // Must be checked (terms)
```

### Toggle

```php
Toggle::make('is_active')
    ->label('Status')
    ->onIcon('heroicon-m-check')
    ->offIcon('heroicon-m-x-mark')
    ->onColor('success')
    ->offColor('danger')
    ->inline(false)
```

### Radio

```php
Radio::make('status')
    ->options([
        'draft' => 'Draft',
        'published' => 'Published',
    ])
    ->descriptions([
        'draft' => 'Niet zichtbaar voor publiek',
        'published' => 'Zichtbaar voor iedereen',
    ])
    ->inline() // Horizontaal
    ->inlineLabel(false)
    ->boolean() // true/false waarden
```

### Checkbox List

```php
CheckboxList::make('technologies')
    ->options([
        'php' => 'PHP',
        'javascript' => 'JavaScript',
        'python' => 'Python',
    ])
    ->descriptions([
        'php' => 'Server-side scripting',
        'javascript' => 'Client-side scripting',
    ])
    ->columns(2)
    ->gridDirection('row')
    ->searchable()
    ->bulkToggleable()
```

### Date-Time Picker

```php
DateTimePicker::make('published_at')
    ->label('Publicatiedatum')
    ->native(false) // Custom UI
    ->displayFormat('d-m-Y H:i')
    ->format('Y-m-d H:i:s')
    ->timezone('Europe/Amsterdam')
    ->seconds(false)
    ->minDate(now())
    ->maxDate(now()->addMonths(3))
    ->default(now())
    ->required()
```

### Date Picker

```php
DatePicker::make('birth_date')
    ->displayFormat('d-m-Y')
    ->minDate(now()->subYears(100))
    ->maxDate(now()->subYears(18))
    ->native(false)
```

### Time Picker

```php
TimePicker::make('alarm_at')
    ->seconds(false)
    ->minutesStep(15)
```

### Color Picker

```php
ColorPicker::make('color')
    ->rgba() // Include alpha
    ->hex()
```

### Tags Input

```php
TagsInput::make('tags')
    ->separator(',')
    ->splitKeys(['Tab', 'Enter', ','])
    ->suggestions([
        'laravel',
        'filament',
        'livewire',
    ])
    ->newestFirst()
```

### Key-Value

```php
KeyValue::make('metadata')
    ->keyLabel('Sleutel')
    ->valueLabel('Waarde')
    ->reorderable()
    ->addActionLabel('Metadata toevoegen')
```

### Slider

```php
Slider::make('rating')
    ->min(0)
    ->max(10)
    ->step(0.5)
    ->marks([
        0 => 'Slecht',
        5 => 'Gemiddeld',
        10 => 'Uitstekend',
    ])
```

### Toggle Buttons

```php
ToggleButtons::make('status')
    ->options([
        'draft' => 'Draft',
        'reviewing' => 'In review',
        'published' => 'Published',
    ])
    ->icons([
        'draft' => 'heroicon-m-pencil',
        'reviewing' => 'heroicon-m-eye',
        'published' => 'heroicon-m-check',
    ])
    ->colors([
        'draft' => 'info',
        'reviewing' => 'warning',
        'published' => 'success',
    ])
    ->inline()
    ->grouped()
```

### Hidden

```php
Hidden::make('user_id')
    ->default(auth()->id())
```

---

## Validation

### Built-in Rules

```php
TextInput::make('email')
    ->email()
    ->required()
    ->unique(Customer::class, 'email', ignoreRecord: true)
    ->minLength(5)
    ->maxLength(255)
    ->confirmed()
    ->alpha()
    ->alphaDash()
    ->alphaNum()
    ->url()
    ->uuid()
    ->json()
    ->regex('/pattern/')
    ->startsWith('https://')
    ->endsWith('.com')
    ->doesntStartWith('http://')
    ->doesntEndWith('.dev')
    ->containsDigit()
```

### Custom Rules

```php
TextInput::make('tax_id')
    ->rules([
        'required',
        'regex:/^[0-9]{9}B[0-9]{2}$/',
        function () {
            return function (string $attribute, $value, Closure $fail) {
                if (! $this->validateTaxId($value)) {
                    $fail('Dit BTW-nummer is ongeldig.');
                }
            };
        },
    ])
```

### Unique Validation

```php
TextInput::make('email')
    ->unique(
        table: Customer::class,
        column: 'email',
        ignoreRecord: true, // Ignore huidig record bij edit
        modifyRuleUsing: fn (Unique $rule) => 
            $rule->where('organization_id', auth()->user()->organization_id)
    )
```

### Exists Validation

```php
Select::make('user_id')
    ->exists(table: 'users', column: 'id')
```

### Required If/Unless

```php
TextInput::make('company_name')
    ->requiredIf('customer_type', 'business')
    ->requiredUnless('customer_type', 'private')
    ->requiredWith(['tax_id', 'vat_number'])
    ->requiredWithAll(['tax_id', 'vat_number'])
    ->requiredWithout(['first_name', 'last_name'])
    ->requiredWithoutAll(['first_name', 'last_name'])
```

### Distinct

```php
Repeater::make('emails')
    ->schema([
        TextInput::make('email')
            ->distinct()
            ->email(),
    ])
```

### Custom Validation Messages

```php
TextInput::make('name')
    ->required()
    ->validationMessages([
        'required' => 'De naam is verplicht.',
        'max' => 'De naam mag maximaal :max karakters zijn.',
    ])
```

### Real-time Validation

```php
TextInput::make('email')
    ->email()
    ->live(onBlur: true) // Valideer bij blur
    ->afterStateUpdated(fn ($state, callable $set) => 
        $set('username', Str::slug($state))
    )
```

### Form-level Validation

```php
// In page class
protected function getValidationRules(): array
{
    return [
        'data.email' => ['required', 'email', 'unique:users,email'],
        'data.password' => ['required', 'min:8', 'confirmed'],
    ];
}
```

---

## Schemas & Layouts

### Sections

```php
use Filament\Forms\Components\Section;

Section::make('Persoonlijke gegevens')
    ->description('Basisinformatie over de klant')
    ->schema([
        TextInput::make('first_name'),
        TextInput::make('last_name'),
    ])
    ->columns(2)
    ->collapsible()
    ->collapsed()
    ->icon('heroicon-m-user')
    ->iconColor('primary')
```

### Tabs

```php
use Filament\Forms\Components\Tabs;

Tabs::make('Klant details')
    ->tabs([
        Tabs\Tab::make('Basis')
            ->icon('heroicon-m-user')
            ->schema([
                TextInput::make('name'),
                TextInput::make('email'),
            ]),
        
        Tabs\Tab::make('Adres')
            ->icon('heroicon-m-map-pin')
            ->badge(fn ($state) => empty($state['street']) ? 'Incomplete' : null)
            ->schema([
                TextInput::make('street'),
                TextInput::make('city'),
            ]),
        
        Tabs\Tab::make('Extra')
            ->schema([
                Textarea::make('notes'),
            ]),
    ])
    ->activeTab(1) // Default tab (1-indexed)
    ->contained(false) // Geen border
```

### Wizard

```php
use Filament\Forms\Components\Wizard;

Wizard::make([
    Wizard\Step::make('Klant info')
        ->description('Basisgegevens')
        ->schema([
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
        ])
        ->icon('heroicon-m-user'),
    
    Wizard\Step::make('Bedrijfsinfo')
        ->description('Optionele bedrijfsgegevens')
        ->schema([
            TextInput::make('company_name'),
            TextInput::make('vat_number'),
        ])
        ->icon('heroicon-m-building-office'),
    
    Wizard\Step::make('Afronden')
        ->description('Controleer en bevestig')
        ->schema([
            Placeholder::make('review')
                ->content(fn ($get) => 
                    view('filament.forms.customer-review', ['data' => $get('../../')])
                ),
        ])
        ->icon('heroicon-m-check'),
])
    ->skippable()
    ->submitAction(view('filament.forms.wizard-submit-button'))
```

### Grid

```php
use Filament\Forms\Components\Grid;

Grid::make(3) // 3 kolommen
    ->schema([
        TextInput::make('first_name')
            ->columnSpan(1),
        TextInput::make('last_name')
            ->columnSpan(1),
        TextInput::make('email')
            ->columnSpan(1),
        Textarea::make('bio')
            ->columnSpanFull(), // Volledige breedte
    ])
```

### Fieldset

```php
use Filament\Forms\Components\Fieldset;

Fieldset::make('Naam')
    ->schema([
        TextInput::make('first_name')
            ->label('Voornaam'),
        TextInput::make('last_name')
            ->label('Achternaam'),
    ])
```

### Split

```php
use Filament\Forms\Components\Split;

Split::make([
    Section::make([
        TextInput::make('name'),
        TextInput::make('email'),
    ]),
    Section::make([
        Textarea::make('notes'),
    ]),
])->from('md')
```

### Group

Groepeer fields zonder visuele container:

```php
use Filament\Schemas\Components\Group;

Group::make()
    ->schema([
        TextInput::make('first_name'),
        TextInput::make('last_name'),
    ])
    ->columns(2)
```

> **Filament 4 Note:** `Group` is verplaatst van `Filament\Forms\Components\Group` naar `Filament\Schemas\Components\Group`

### Placeholder

Toon read-only content:

```php
use Filament\Forms\Components\Placeholder;

Placeholder::make('created')
    ->label('Aangemaakt op')
    ->content(fn ($record): string => 
        $record?->created_at?->diffForHumans() ?? '-'
    )
```

### View

Render custom Blade view:

```php
use Filament\Forms\Components\View;

View::make('filament.forms.components.custom-info')
```

---

## Advanced Fields

### File Upload

```php
use Filament\Forms\Components\FileUpload;

FileUpload::make('avatar')
    ->image()
    ->avatar()
    ->imageEditor() // Inline crop/rotate
    ->imageCropAspectRatio('1:1')
    ->imageResizeMode('cover')
    ->imageResizeTargetWidth('300')
    ->imageResizeTargetHeight('300')
    ->directory('avatars')
    ->disk('public')
    ->visibility('public')
    ->downloadable()
    ->openable()
    ->acceptedFileTypes(['image/png', 'image/jpeg'])
    ->maxSize(1024) // KB
    ->minSize(100)
    ->multiple()
    ->maxFiles(5)
    ->reorderable()
    ->appendFiles() // Voeg toe ipv replace
    ->previewable()
    ->panelLayout('grid')
```

### File Upload - Document

```php
FileUpload::make('attachments')
    ->disk('private')
    ->directory('documents')
    ->acceptedFileTypes(['application/pdf'])
    ->multiple()
    ->downloadable()
    ->openable()
```

### Rich Editor (TipTap)

```php
use Filament\Forms\Components\RichEditor;

RichEditor::make('content')
    ->toolbarButtons([
        'attachFiles',
        'blockquote',
        'bold',
        'bulletList',
        'codeBlock',
        'h2',
        'h3',
        'italic',
        'link',
        'orderedList',
        'redo',
        'strike',
        'underline',
        'undo',
    ])
    ->fileAttachmentsDisk('public')
    ->fileAttachmentsDirectory('uploads')
    ->fileAttachmentsVisibility('public')
```

### Markdown Editor

```php
use Filament\Forms\Components\MarkdownEditor;

MarkdownEditor::make('content')
    ->toolbarButtons([
        'attachFiles',
        'blockquote',
        'bold',
        'bulletList',
        'codeBlock',
        'heading',
        'italic',
        'link',
        'orderedList',
        'redo',
        'strike',
        'table',
        'undo',
    ])
    ->fileAttachmentsDisk('public')
    ->fileAttachmentsDirectory('uploads')
```

### Code Editor

```php
use Filament\Forms\Components\CodeEditor;

CodeEditor::make('source_code')
    ->language('php')
    ->lineNumbers()
    ->height('200px')
```

---

## Repeaters & Builders

### Repeater

```php
use Filament\Forms\Components\Repeater;

Repeater::make('contacts')
    ->schema([
        TextInput::make('name')
            ->required(),
        TextInput::make('email')
            ->email()
            ->required(),
        TextInput::make('phone'),
    ])
    ->columns(3)
    ->defaultItems(1)
    ->addActionLabel('Contact toevoegen')
    ->reorderable()
    ->reorderableWithButtons()
    ->collapsible()
    ->collapsed()
    ->itemLabel(fn (array $state): ?string => 
        $state['name'] ?? null
    )
    ->minItems(1)
    ->maxItems(10)
    ->deleteAction(
        fn (Action $action) => $action->requiresConfirmation()
    )
    ->relationship('contacts') // Voor relations
```

### Repeater Grid

```php
Repeater::make('team_members')
    ->schema([
        Select::make('user_id')
            ->relationship('user', 'name')
            ->required(),
        Select::make('role')
            ->options([
                'admin' => 'Admin',
                'editor' => 'Editor',
            ])
            ->required(),
    ])
    ->grid(2)
    ->addActionLabel('Teamlid toevoegen')
```

### Builder

Dynamische content blocks (Gutenberg-style):

```php
use Filament\Forms\Components\Builder;

Builder::make('content')
    ->blocks([
        Builder\Block::make('heading')
            ->schema([
                TextInput::make('content')
                    ->label('Titel')
                    ->required(),
                Select::make('level')
                    ->options([
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                    ])
                    ->required(),
            ])
            ->icon('heroicon-m-bars-3-bottom-left'),
        
        Builder\Block::make('paragraph')
            ->schema([
                Textarea::make('content')
                    ->label('Tekst')
                    ->required(),
            ])
            ->icon('heroicon-m-bars-3-bottom-left'),
        
        Builder\Block::make('image')
            ->schema([
                FileUpload::make('url')
                    ->label('Afbeelding')
                    ->image()
                    ->required(),
                TextInput::make('alt')
                    ->label('Alt tekst')
                    ->required(),
            ])
            ->icon('heroicon-m-photo'),
    ])
    ->blockNumbers(false)
    ->collapsible()
    ->collapsed()
```

---

## Pro Tips

### 1. Form Data Hydration

```php
// In CreateRecord page
protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = auth()->id();
    return $data;
}

// In EditRecord page
protected function mutateFormDataBeforeFill(array $data): array
{
    unset($data['password']);
    return $data;
}

protected function mutateFormDataBeforeSave(array $data): array
{
    if (empty($data['password'])) {
        unset($data['password']);
    }
    return $data;
}
```

### 2. Conditional Fields

```php
Select::make('customer_type')
    ->options([
        'private' => 'Particulier',
        'business' => 'Zakelijk',
    ])
    ->live(),

TextInput::make('company_name')
    ->required()
    ->visible(fn (Get $get) => $get('customer_type') === 'business'),

TextInput::make('vat_number')
    ->visible(fn (Get $get) => $get('customer_type') === 'business'),
```

### 3. Dependent Selects

```php
Select::make('country_id')
    ->relationship('country', 'name')
    ->live()
    ->afterStateUpdated(function (Set $set) {
        $set('state_id', null);
        $set('city_id', null);
    }),

Select::make('state_id')
    ->relationship(
        'state',
        'name',
        fn (Builder $query, Get $get) => 
            $query->where('country_id', $get('country_id'))
    )
    ->live()
    ->disabled(fn (Get $get) => ! $get('country_id')),

Select::make('city_id')
    ->relationship(
        'city',
        'name',
        fn (Builder $query, Get $get) => 
            $query->where('state_id', $get('state_id'))
    )
    ->disabled(fn (Get $get) => ! $get('state_id')),
```

### 4. Calculate Fields

```php
TextInput::make('quantity')
    ->numeric()
    ->live(onBlur: true)
    ->afterStateUpdated(function (Get $get, Set $set) {
        self::updateTotal($get, $set);
    }),

TextInput::make('price')
    ->numeric()
    ->prefix('€')
    ->live(onBlur: true)
    ->afterStateUpdated(function (Get $get, Set $set) {
        self::updateTotal($get, $set);
    }),

TextInput::make('total')
    ->numeric()
    ->prefix('€')
    ->disabled()
    ->dehydrated(false),

// Helper method
public static function updateTotal(Get $get, Set $set): void
{
    $quantity = (float) $get('quantity');
    $price = (float) $get('price');
    
    $set('total', number_format($quantity * $price, 2, '.', ''));
}
```

### 5. File Upload With Preview

```php
FileUpload::make('images')
    ->image()
    ->multiple()
    ->reorderable()
    ->imageEditor()
    ->imagePreviewHeight('250')
    ->panelLayout('grid')
    ->downloadable()
    ->openable()
    ->deletable(fn ($record) => auth()->user()->can('delete', $record))
```

### 6. Custom Validation Rule Class

```php
// App/Rules/ValidDutchPostalCode.php
class ValidDutchPostalCode implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[1-9][0-9]{3}\s?[A-Z]{2}$/i', $value);
    }

    public function message()
    {
        return 'De :attribute moet een geldige Nederlandse postcode zijn.';
    }
}

// In form
TextInput::make('postal_code')
    ->rules([new ValidDutchPostalCode])
```

### 7. Relationship With Create Modal

```php
Select::make('author_id')
    ->relationship('author', 'name')
    ->searchable()
    ->preload()
    ->createOptionForm([
        TextInput::make('name')
            ->required(),
        TextInput::make('email')
            ->email()
            ->required()
            ->unique('users', 'email'),
        TextInput::make('password')
            ->password()
            ->required()
            ->minLength(8),
    ])
    ->createOptionUsing(function (array $data): int {
        return User::create([
            ...$data,
            'password' => Hash::make($data['password']),
        ])->getKey();
    })
```

### 8. Form With Steps (Wizard)

```php
// In CreateRecord page
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateCustomer extends CreateRecord
{
    use HasWizard;

    protected function getSteps(): array
    {
        return [
            Step::make('Basis')->schema([...]),
            Step::make('Adres')->schema([...]),
            Step::make('Details')->schema([...]),
        ];
    }

    public function hasSkippableSteps(): bool
    {
        return true;
    }
}
```

---

## Form Recipe: Complete Example

```php
use Filament\Forms\Components\*;
use Filament\Schemas\Schema;

public static function form(Schema $schema): Schema
{
    return $schema
        ->schema([
            Tabs::make('Klant Details')
                ->tabs([
                    Tabs\Tab::make('Algemeen')
                        ->icon('heroicon-m-user')
                        ->schema([
                            Section::make('Basisinformatie')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('first_name')
                                                ->label('Voornaam')
                                                ->required()
                                                ->maxLength(255),
                                            
                                            TextInput::make('last_name')
                                                ->label('Achternaam')
                                                ->required()
                                                ->maxLength(255),
                                            
                                            TextInput::make('email')
                                                ->email()
                                                ->required()
                                                ->unique(ignoreRecord: true),
                                            
                                            TextInput::make('phone')
                                                ->tel()
                                                ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                                        ]),
                                ])
                                ->columns(2),
                            
                            Section::make('Account')
                                ->schema([
                                    Select::make('customer_type')
                                        ->options([
                                            'private' => 'Particulier',
                                            'business' => 'Zakelijk',
                                        ])
                                        ->required()
                                        ->live(),
                                    
                                    TextInput::make('company_name')
                                        ->visible(fn (Get $get) => 
                                            $get('customer_type') === 'business'
                                        )
                                        ->required(fn (Get $get) => 
                                            $get('customer_type') === 'business'
                                        ),
                                    
                                    Toggle::make('is_active')
                                        ->label('Actief')
                                        ->default(true),
                                ]),
                        ]),
                    
                    Tabs\Tab::make('Adres')
                        ->icon('heroicon-m-map-pin')
                        ->schema([
                            Section::make()
                                ->schema([
                                    TextInput::make('street')
                                        ->label('Straat'),
                                    
                                    Grid::make(2)
                                        ->schema([
                                            TextInput::make('postal_code')
                                                ->label('Postcode'),
                                            
                                            TextInput::make('city')
                                                ->label('Stad'),
                                        ]),
                                    
                                    Select::make('country_id')
                                        ->relationship('country', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                ]),
                        ]),
                    
                    Tabs\Tab::make('Extra')
                        ->icon('heroicon-m-document-text')
                        ->schema([
                            FileUpload::make('avatar')
                                ->image()
                                ->avatar()
                                ->imageEditor()
                                ->disk('public')
                                ->directory('avatars'),
                            
                            Textarea::make('notes')
                                ->label('Notities')
                                ->rows(5)
                                ->columnSpanFull(),
                            
                            TagsInput::make('tags')
                                ->label('Tags')
                                ->suggestions([
                                    'vip',
                                    'wholesale',
                                    'retail',
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
}
```

---

## Zie Ook

- [Core Documentation](./filament-core.md) - Resources en CRUD
- [Tables Documentation](./filament-tables.md) - Table columns
- [Actions Documentation](./filament-actions.md) - Form actions
