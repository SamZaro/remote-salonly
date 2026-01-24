# Laravel Boost Guidelines

**Laad dit bestand alleen wanneer je Laravel/Livewire/Filament/PHP best practices nodig hebt.**

## PHP Best Practices

### Type Safety
- Always use explicit return type declarations
- Use PHP 8 constructor property promotion
- Never allow empty `__construct()` with zero parameters

```php
// ✅ Correct
public function __construct(public GitHub $github) {}

protected function isAccessible(User $user, ?string $path = null): bool
{
    return $user->canAccess($path);
}

// ❌ Wrong
public function __construct() {} // Empty constructor
```

### Control Structures
- Always use curly braces, even for single-line statements

### Comments
- Prefer PHPDoc blocks over inline comments
- Add useful array shape type definitions
- Comments only for _very_ complex logic

### Enums
- Keys should be TitleCase: `FavoritePerson`, `Monthly`

## Laravel Core

### Artisan Commands
- Use `php artisan make:*` for all new files (migrations, controllers, models, etc.)
- Always pass `--no-interaction` to Artisan commands
- Use `php artisan make:class` for generic PHP classes

### Database & Eloquent
- **Always use Eloquent relationships** with return type hints
- Avoid `DB::`; prefer `Model::query()`
- Prevent N+1 problems with eager loading
- Use query builder only for very complex operations

### Model Creation
- Create factories and seeders for new models
- Ask user about additional needs via `list-artisan-commands`

### APIs
- Default to Eloquent API Resources
- Use API versioning unless existing routes differ

### Controllers & Validation
- **Always create Form Request classes** for validation
- Include validation rules AND custom error messages
- Check sibling Form Requests for array vs string rules

### Queues
- Use queued jobs with `ShouldQueue` interface for time-consuming operations

### Authentication & Authorization
- Use Laravel's built-in features (gates, policies, Sanctum)

### URL Generation
- Prefer named routes: `route('name')` over hardcoded URLs

### Configuration
- **NEVER** use `env()` outside config files
- Always use `config('app.name')`, not `env('APP_NAME')`

### Testing
- Use model factories in tests
- Check factory custom states before manual setup
- Use `fake()->randomDigit()` or `$this->faker->word()`
- Create feature tests by default: `php artisan make:test [options] <n>`
- Pass `--unit` for unit tests

### Vite Error
If "Unable to locate file in Vite manifest" error:
- Run `npm run build`
- Or ask user to run `npm run dev` / `composer run dev`

## Laravel 12 Specifics

### Streamlined Structure
- **No** `app/Console/Kernel.php` - use `bootstrap/app.php`
- **No** `app/Http/Middleware/` files - register in `bootstrap/app.php`
- `bootstrap/providers.php` contains service providers
- Commands auto-register from `app/Console/Commands/`

### Database
- Column modifications: include ALL previous attributes or they'll be dropped
- Eager loading limits: `$query->latest()->limit(10)` (native since Laravel 11)

### Models
- Casts in `casts()` method, not `$casts` property (follow project conventions)

## Livewire 3

### Core Principles
- Use `search-docs` tool for version-specific documentation
- Create components: `php artisan make:livewire [Posts\\CreatePost]`
- State lives on server, UI reflects it
- All requests hit Laravel backend - **always validate** and authorize

### Best Practices
- Components require **single root element**
- Use `wire:loading` and `wire:dirty` for loading states
- **Always** add `wire:key` in loops:

```blade
@foreach ($items as $item)
    <div wire:key="item-{{ $item->id }}">
        {{ $item->name }}
    </div>
@endforeach
```

### Lifecycle Hooks
```php
public function mount(User $user) { $this->user = $user; }
public function updatedSearch() { $this->resetPage(); }
```

### Key Changes from Livewire 2
- `wire:model.live` for real-time (default is deferred)
- Namespace: `App\Livewire` (not `App\Http\Livewire`)
- Events: `$this->dispatch()` (not `emit` or `dispatchBrowserEvent`)
- Layout: `components.layouts.app` (not `layouts.app`)

### New Directives
- `wire:show`, `wire:transition`, `wire:cloak`, `wire:offline`, `wire:target`

### Alpine.js
- Included with Livewire - don't manually include
- Plugins: persist, intersect, collapse, focus

### JavaScript Hooks
```js
document.addEventListener('livewire:init', function () {
    Livewire.hook('request', ({ fail }) => {
        if (fail && fail.status === 419) {
            alert('Your session expired');
        }
    });

    Livewire.hook('message.failed', (message, component) => {
        console.error(message);
    });
});
```

### Testing Livewire
```php
Livewire::test(Counter::class)
    ->assertSet('count', 0)
    ->call('increment')
    ->assertSet('count', 1)
    ->assertSee(1)
    ->assertStatus(200);

// Check component exists on page
$this->get('/posts/create')
    ->assertSeeLivewire(CreatePost::class);
```

### 📚 Uitgebreide Livewire Documentatie

Voor complete Livewire 3.x referentie, zie de modulaire docs in `docs/livewire/`:

- **livewire/README.md** - Overzicht, gebruik scenario's, quick lookup guide (start hier!)
- **livewire/livewire-core.md** - Component essentials, properties, actions, lifecycle hooks
- **livewire/livewire-forms.md** - Forms, validatie, file uploads, multi-step forms
- **livewire/livewire-advanced.md** - Events, Alpine integratie, JavaScript API, pagination
- **livewire/livewire-directives.md** - Complete wire:* directive reference met alle modifiers
- **livewire/livewire-patterns.md** - UI patterns (modals, search, tabs), testing, troubleshooting

**Prompt:** `"Lees docs/livewire/README.md voor Livewire scenario's"`

## Filament 4

### Core Concepts
- Server-Driven UI (SDUI) framework for Laravel
- Built on Livewire, Alpine.js, Tailwind CSS
- Use `search-docs` tool for official documentation
- Utilize static `make()` methods for components

### Artisan Commands
- Use Filament-specific commands to create files
- Find commands: `list-artisan-commands` or `php artisan --help`
- Always pass `--no-interaction` and valid `--options`

### Core Features
- **Actions**: Handle interactions (buttons, modals, logic)
- **Forms**: Dynamic forms in resources, action modals, filters
- **Infolists**: Read-only data lists
- **Notifications**: Flash notifications
- **Panels**: Top-level container for pages, resources, etc.
- **Resources**: CRUD interfaces for Eloquent models (`app/Filament/Resources`)
- **Schemas**: Define UI structure (forms, tables, lists)
- **Tables**: Interactive with filtering, sorting, pagination
- **Widgets**: Dashboard components (charts, stats)

### Relationships
```php
Forms\Components\Select::make('user_id')
    ->label('Author')
    ->relationship('author')
    ->required(),
```

### Filament 4 Breaking Changes
- File visibility: `private` by default
- `deferFilters` is now default (users click button to apply)
- `Grid`, `Section`, `Fieldset` no longer span all columns by default
- `all` pagination not available by default
- All actions extend `Filament\Actions\Action` (not `Filament\Tables\Actions`)
- Layout components moved to `Filament\Schemas\Components`
- New `Repeater` component for Forms
- Icons use `Filament\Support\Icons\Heroicon` Enum

### Component Organization
- Schema components: `Schemas/Components/`
- Table columns: `Tables/Columns/`
- Table filters: `Tables/Filters/`
- Actions: `Actions/`

### Testing Filament
```php
// Ensure authentication first
livewire(ListUsers::class)
    ->assertCanSeeTableRecords($users)
    ->searchTable($users->first()->name)
    ->assertCanSeeTableRecords($users->take(1));

livewire(CreateUser::class)
    ->fillForm([
        'name' => 'Howdy',
        'email' => 'howdy@example.com',
    ])
    ->call('create')
    ->assertNotified()
    ->assertRedirect();

// Multiple panels
use Filament\Facades\Filament;
Filament::setCurrentPanel('app');

// Calling actions
livewire(EditInvoice::class, ['invoice' => $invoice])
    ->callAction('send');
```

### 📚 Uitgebreide Filament Documentatie

Voor complete Filament 4.x referentie, zie de modulaire docs in `docs/filament/`:

- **filament/README.md** - Overzicht, gebruik scenario's, best practices, troubleshooting (start hier!)
- **filament/filament-core.md** - Resources, CRUD operations, Navigation, Authorization
- **filament/filament-tables.md** - Columns, Filters, Actions, Layout, Grouping
- **filament/filament-forms.md** - Form Fields, Validation, Schemas, Layouts
- **filament/filament-actions.md** - Actions, Modals, Notifications, Infolists
- **filament/filament-advanced.md** - Widgets, Multi-tenancy, Styling, Custom Pages
- **filament/filament-testing.md** - Testing resources/actions, Deployment, Performance

**Token besparing:** 70-85% door modulair laden (lees alleen wat je nodig hebt)

**Prompt:** `"Lees docs/filament/README.md voor Filament overzicht en scenario's"`

## Tailwind CSS 4

### Import Syntax
```css
/* ❌ Tailwind v3 */
@tailwind base;
@tailwind components;
@tailwind utilities;

/* ✅ Tailwind v4 */
@import "tailwindcss";
```

### Best Practices
- Check existing Tailwind conventions first
- Extract repeated patterns into Blade/JSX/Vue components
- Think through class placement and order
- Use `search-docs` for official examples

### Spacing
```html
<!-- ✅ Use gap utilities -->
<div class="flex gap-8">
    <div>Item 1</div>
    <div>Item 2</div>
</div>

<!-- ❌ Don't use margins -->
<div class="flex">
    <div class="mr-8">Item 1</div>
    <div>Item 2</div>
</div>
```

### Dark Mode
- Support dark mode if existing pages/components do
- Use `dark:` prefix

### Deprecated Utilities (v4)

| Deprecated | Replacement |
|------------|-------------|
| `bg-opacity-*` | `bg-black/*` |
| `text-opacity-*` | `text-black/*` |
| `border-opacity-*` | `border-black/*` |
| `divide-opacity-*` | `divide-black/*` |
| `ring-opacity-*` | `ring-black/*` |
| `placeholder-opacity-*` | `placeholder-black/*` |
| `flex-shrink-*` | `shrink-*` |
| `flex-grow-*` | `grow-*` |
| `overflow-ellipsis` | `text-ellipsis` |
| `decoration-slice` | `box-decoration-slice` |
| `decoration-clone` | `box-decoration-clone` |

**Note**: Opacity values are still numeric.
**Note**: `corePlugins` not supported in v4.

## Laravel Pint

### Code Formatting
- **Must run** `vendor/bin/pint --dirty` before commit
- Ensures code matches project style
- **Don't** run `vendor/bin/pint --test`
- Just run `vendor/bin/pint` to fix issues

## PHPUnit Testing

### Core Rules
- All tests must be PHPUnit classes (no Pest)
- Create tests: `php artisan make:test --phpunit <name>`
- Convert Pest tests to PHPUnit if found
- Run singular test after every update
- Ask about full test suite after feature complete
- Test happy, failure, and edge cases
- **Never remove tests without approval**

### Running Tests
```bash
# All tests
php artisan test

# Specific file
php artisan test tests/Feature/ExampleTest.php

# Specific test (recommended after changes)
php artisan test --filter=testName
```

### Test Enforcement
- Every change **must be tested**
- Write new test or update existing
- Run affected tests to ensure they pass
- Run minimal tests for speed

## Laravel Herd

- Application served at: `https://[kebab-case-project-dir].test`
- Use `get-absolute-url` tool for valid URLs
- **Never** run commands to make site available
- Always available through Herd

## Search Documentation Tool

### Usage
- Can pass multiple queries at once
- Most relevant results returned first

### Query Types
1. **Simple word searches** (auto-stemming)
   - `query=authentication` → finds 'authenticate', 'auth'
2. **Multiple words** (AND logic)
   - `query=rate limit` → both "rate" AND "limit"
3. **Quoted phrases** (exact position)
   - `query="infinite scroll"` → adjacent, in order
4. **Mixed queries**
   - `query=middleware "rate limit"` → "middleware" AND exact phrase
5. **Multiple queries**
   - `queries=["authentication", "middleware"]` → ANY of these

## Summary: Key Enforcement Rules

1. **Always** run Pint before commit
2. **Always** create Form Requests for validation
3. **Always** use type hints and return types
4. **Always** test changes (PHPUnit, not Pest)
5. **Always** use `config()`, never `env()` outside config files
6. **Always** add `wire:key` in Livewire loops
7. **Never** remove tests without approval
8. **Never** use inline validation in controllers
9. **Never** skip eager loading (prevent N+1)
10. **Prefer** Eloquent over raw queries
