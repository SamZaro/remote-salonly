# Filament 4 - Testing & Deployment

> **Complete referentie voor Testing Resources, Tables, Actions en Production Deployment**

## 📋 Inhoud

1. [Testing Setup](#testing-setup)
2. [Testing Resources](#testing-resources)
3. [Testing Tables](#testing-tables)
4. [Testing Forms](#testing-forms)
5. [Testing Actions](#testing-actions)
6. [Testing Notifications](#testing-notifications)
7. [Deployment](#deployment)
8. [Performance](#performance)

---

## Testing Setup

Filament bouwt voort op Laravel's test framework (Pest/PHPUnit) met helpers voor UI testing.

### Installation

```bash
composer require --dev pestphp/pest
composer require --dev pestphp/pest-plugin-laravel
```

### Basic Test Setup

```php
<?php

use App\Models\User;
use App\Filament\Resources\Customers\CustomerResource;
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('can render customers list page', function () {
    $this->get(CustomerResource::getUrl('index'))
        ->assertSuccessful();
});
```

---

## Testing Resources

### Test List Page

```php
use App\Models\Customer;
use App\Filament\Resources\Customers\CustomerResource;

it('can list customers', function () {
    $customers = Customer::factory()->count(10)->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->assertCanSeeTableRecords($customers);
});

it('can search customers', function () {
    $customers = Customer::factory()->count(10)->create();
    $firstName = $customers->first()->name;

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->searchTable($firstName)
        ->assertCanSeeTableRecords($customers->where('name', $firstName))
        ->assertCanNotSeeTableRecords($customers->where('name', '!=', $firstName));
});

it('can sort customers', function () {
    $customers = Customer::factory()->count(10)->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->sortTable('name')
        ->assertCanSeeTableRecords($customers->sortBy('name'), inOrder: true)
        ->sortTable('name', 'desc')
        ->assertCanSeeTableRecords($customers->sortByDesc('name'), inOrder: true);
});
```

### Test Create Page

```php
it('can create customer', function () {
    $newData = Customer::factory()->make();

    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'name' => $newData->name,
            'email' => $newData->email,
            'phone' => $newData->phone,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(Customer::class, [
        'name' => $newData->name,
        'email' => $newData->email,
    ]);
});

it('validates required fields', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'name' => null,
        ])
        ->call('create')
        ->assertHasFormErrors(['name' => 'required']);
});

it('validates unique email', function () {
    $existingCustomer = Customer::factory()->create();

    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'name' => 'Test',
            'email' => $existingCustomer->email,
        ])
        ->call('create')
        ->assertHasFormErrors(['email' => 'unique']);
});
```

### Test Edit Page

```php
it('can render edit page', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->assertFormSet([
            'name' => $customer->name,
            'email' => $customer->email,
        ]);
});

it('can update customer', function () {
    $customer = Customer::factory()->create();
    $newData = Customer::factory()->make();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->fillForm([
            'name' => $newData->name,
            'email' => $newData->email,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($customer->refresh())
        ->name->toBe($newData->name)
        ->email->toBe($newData->email);
});

it('can delete customer', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->callAction('delete');

    $this->assertModelMissing($customer);
});
```

### Test View Page

```php
it('can render view page', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\ViewCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->assertSuccessful();
});
```

### Test Authorization

```php
it('can not list customers without permission', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user);

    $this->get(CustomerResource::getUrl('index'))
        ->assertForbidden();
});

it('can not create customer without permission', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user);

    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->assertForbidden();
});
```

---

## Testing Tables

### Test Columns

```php
it('can render table columns', function () {
    $customers = Customer::factory()->count(10)->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->assertTableColumnExists('name')
        ->assertTableColumnExists('email')
        ->assertTableColumnExists('created_at');
});

it('can hide table columns', function () {
    livewire(CustomerResource\Pages\ListCustomers::class)
        ->assertTableColumnVisible('email')
        ->hideTableColumn('email')
        ->assertTableColumnHidden('email');
});
```

### Test Filters

```php
it('can filter customers', function () {
    $customers = Customer::factory()->count(10)->create();
    $activeCustomers = Customer::factory()->count(5)->create(['is_active' => true]);

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->assertCanSeeTableRecords($customers->merge($activeCustomers))
        ->filterTable('is_active', true)
        ->assertCanSeeTableRecords($activeCustomers)
        ->assertCanNotSeeTableRecords($customers);
});

it('can reset table filters', function () {
    $customers = Customer::factory()->count(10)->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->filterTable('is_active', true)
        ->resetTableFilters()
        ->assertCanSeeTableRecords($customers);
});
```

### Test Actions

```php
it('can delete customer from table', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->callTableAction('delete', $customer);

    $this->assertModelMissing($customer);
});

it('can bulk delete customers', function () {
    $customers = Customer::factory()->count(10)->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->callTableBulkAction('delete', $customers);

    foreach ($customers as $customer) {
        $this->assertModelMissing($customer);
    }
});

it('can export customers', function () {
    $customers = Customer::factory()->count(10)->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->callTableBulkAction('export', $customers);

    // Assert export was queued
    Bus::assertDispatched(function (ExportJob $job) {
        return $job->export->total_rows === 10;
    });
});
```

---

## Testing Forms

### Test Field Validation

```php
it('validates email format', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'email' => 'invalid-email',
        ])
        ->call('create')
        ->assertHasFormErrors(['email' => 'email']);
});

it('validates required fields', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'name' => null,
            'email' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'email' => 'required',
        ]);
});

it('validates min length', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'password' => '123',
        ])
        ->call('create')
        ->assertHasFormErrors(['password' => 'min:8']);
});
```

### Test Conditional Fields

```php
it('shows company fields when customer type is business', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'customer_type' => 'business',
        ])
        ->assertFormFieldExists('company_name')
        ->assertFormFieldExists('vat_number');
});

it('hides company fields when customer type is private', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'customer_type' => 'private',
        ])
        ->assertFormFieldDoesNotExist('company_name')
        ->assertFormFieldDoesNotExist('vat_number');
});
```

### Test File Uploads

```php
use Illuminate\Http\UploadedFile;

it('can upload avatar', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('avatar.jpg');

    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'avatar' => $file,
        ])
        ->call('create');

    Storage::disk('public')->assertExists('avatars/' . $file->hashName());
});

it('validates avatar file type', function () {
    $file = UploadedFile::fake()->create('document.pdf');

    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'avatar' => $file,
        ])
        ->call('create')
        ->assertHasFormErrors(['avatar']);
});
```

### Test Repeater

```php
it('can add repeater items', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'contacts' => [
                ['name' => 'Contact 1', 'email' => 'contact1@example.com'],
                ['name' => 'Contact 2', 'email' => 'contact2@example.com'],
            ],
        ])
        ->assertFormSet([
            'contacts' => [
                ['name' => 'Contact 1', 'email' => 'contact1@example.com'],
                ['name' => 'Contact 2', 'email' => 'contact2@example.com'],
            ],
        ]);
});
```

---

## Testing Actions

### Test Page Actions

```php
it('can call header action', function () {
    livewire(CustomerResource\Pages\ListCustomers::class)
        ->callAction('import')
        ->assertSuccessful();
});

it('can call action with form', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->callAction('updateStatus', data: [
            'status' => 'active',
        ])
        ->assertHasNoActionErrors();

    expect($customer->refresh()->status)->toBe('active');
});
```

### Test Table Actions

```php
it('can edit customer from table', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->callTableAction('edit', $customer)
        ->assertSuccessful();
});

it('can view customer from table', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\ListCustomers::class)
        ->callTableAction('view', $customer)
        ->assertSuccessful();
});
```

### Test Action Modals

```php
it('can open action modal', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->mountAction('delete')
        ->assertActionMounted('delete');
});

it('can fill action modal form', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->mountAction('updateStatus')
        ->setActionData([
            'status' => 'inactive',
            'reason' => 'Customer request',
        ])
        ->callMountedAction()
        ->assertHasNoActionErrors();
});
```

### Test Action Authorization

```php
it('cannot delete customer without permission', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();
    
    $this->actingAs($user);

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->assertActionHidden('delete');
});
```

---

## Testing Notifications

### Test Flash Notifications

```php
it('shows success notification after save', function () {
    $customer = Customer::factory()->create();

    livewire(CustomerResource\Pages\EditCustomer::class, [
        'record' => $customer->getRouteKey(),
    ])
        ->fillForm([
            'name' => 'Updated Name',
        ])
        ->call('save')
        ->assertNotified();
});

it('shows specific notification', function () {
    livewire(CustomerResource\Pages\CreateCustomer::class)
        ->fillForm([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
        ])
        ->call('create')
        ->assertNotified('Customer created successfully');
});
```

### Test Database Notifications

```php
use Filament\Notifications\Notification;

it('sends database notification', function () {
    $user = User::factory()->create();
    
    Notification::make()
        ->title('Test Notification')
        ->sendToDatabase($user);

    $this->assertDatabaseHas('notifications', [
        'notifiable_id' => $user->id,
        'data' => json_encode([
            'title' => 'Test Notification',
        ]),
    ]);
});
```

---

## Deployment

### Pre-Deployment Checklist

```bash
# 1. Update dependencies
composer install --no-dev --optimize-autoloader

# 2. Cache config
php artisan config:cache

# 3. Cache routes
php artisan route:cache

# 4. Cache views
php artisan view:cache

# 5. Cache icons
php artisan icons:cache

# 6. Optimize Filament
php artisan filament:optimize

# 7. Build assets
npm run build
```

### Environment Variables

```env
# Production settings
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_secure_password

# Cache
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

# Filament
FILAMENT_FILESYSTEM_DISK=public
```

### Forge Deployment Script

```bash
cd /home/forge/yourdomain.com

git pull origin main

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:optimize

npm ci
npm run build

php artisan queue:restart
php artisan horizon:terminate
```

### Server Requirements

```
PHP 8.2+
- BCMath Extension
- Ctype Extension
- Fileinfo Extension
- JSON Extension
- Mbstring Extension
- OpenSSL Extension
- PDO Extension
- Tokenizer Extension
- XML Extension
- cURL Extension
- GD or Imagick Extension

MySQL 8.0+ / PostgreSQL 13+
Redis (recommended)
Node.js 20+ (for building assets)
```

### Nginx Configuration

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com;
    root /home/forge/yourdomain.com/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### SSL Configuration (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal (add to crontab)
0 12 * * * /usr/bin/certbot renew --quiet
```

---

## Performance

### Database Optimization

```php
// Eager loading in resources
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->with(['organization', 'contacts'])
        ->withCount(['orders', 'invoices']);
}

// Index columns
Schema::table('customers', function (Blueprint $table) {
    $table->index('email');
    $table->index('organization_id');
    $table->index(['status', 'created_at']);
});
```

### Cache Strategies

```php
// Cache expensive queries
use Illuminate\Support\Facades\Cache;

public static function getStats(): array
{
    return Cache::remember('dashboard-stats', now()->addMinutes(10), function () {
        return [
            'customers' => Customer::count(),
            'revenue' => Order::sum('total'),
            'orders' => Order::where('status', 'pending')->count(),
        ];
    });
}
```

### Queue Jobs

```php
// Queue export jobs
use Filament\Actions\Exports\Jobs\ExportCsv;

protected function getHeaderActions(): array
{
    return [
        ExportAction::make()
            ->exporter(CustomerExporter::class)
            ->job(ExportCsv::class),
    ];
}

// Process in background
php artisan queue:work --tries=3 --timeout=90
```

### Asset Optimization

```bash
# Minify CSS/JS
npm run build

# Optimize images
npm install imagemin-cli
npx imagemin public/images/* --out-dir=public/images/optimized

# Enable compression in Nginx
gzip on;
gzip_types text/plain text/css application/json application/javascript;
gzip_min_length 1000;
```

### OPcache Configuration

```ini
; /etc/php/8.2/fpm/php.ini

opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
opcache.interned_strings_buffer=16
```

---

## Pro Tips

### 1. Test Factories

```php
// CustomerFactory
public function definition(): array
{
    return [
        'name' => fake()->name(),
        'email' => fake()->unique()->safeEmail(),
        'phone' => fake()->phoneNumber(),
        'is_active' => true,
        'organization_id' => Organization::factory(),
    ];
}

// Use in tests
Customer::factory()
    ->count(10)
    ->active()
    ->create();
```

### 2. Testing Helpers

```php
// tests/Pest.php
function actingAsAdmin(): void
{
    test()->actingAs(
        User::factory()->admin()->create()
    );
}

// Use in tests
it('can access admin panel', function () {
    actingAsAdmin();
    
    $this->get('/admin')
        ->assertSuccessful();
});
```

### 3. Database Seeding Voor Tests

```php
// DatabaseSeeder
public function run(): void
{
    if (app()->environment('testing')) {
        $this->call([
            TestUserSeeder::class,
            TestCustomerSeeder::class,
        ]);
    }
}
```

### 4. CI/CD Pipeline (GitHub Actions)

```yaml
# .github/workflows/tests.yml
name: Tests

on: [push, pull_request]

jobs:
  tests:
    runs-on: ubuntu-latest

    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: password
          MYSQL_DATABASE: testing
        ports:
          - 3306:3306

    steps:
      - uses: actions/checkout@v3
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.2
          extensions: mbstring, dom, fileinfo, mysql
          
      - name: Install Dependencies
        run: composer install --no-interaction --prefer-dist
        
      - name: Copy .env
        run: php -r "copy('.env.example', '.env');"
        
      - name: Generate key
        run: php artisan key:generate
        
      - name: Run Tests
        run: php artisan test
        env:
          DB_CONNECTION: mysql
          DB_HOST: 127.0.0.1
          DB_PORT: 3306
          DB_DATABASE: testing
          DB_USERNAME: root
          DB_PASSWORD: password
```

### 5. Health Check Endpoint

```php
// routes/web.php
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'database' => DB::connection()->getPdo() ? 'connected' : 'disconnected',
        'cache' => Cache::has('health-check') ? 'working' : 'not working',
    ]);
});
```

### 6. Error Monitoring (Sentry)

```bash
composer require sentry/sentry-laravel
```

```php
// config/sentry.php
'dsn' => env('SENTRY_LARAVEL_DSN'),
'environment' => env('APP_ENV'),
```

### 7. Performance Monitoring

```php
// App\Providers\AppServiceProvider
use Illuminate\Support\Facades\DB;

public function boot(): void
{
    if (app()->environment('local')) {
        DB::listen(function ($query) {
            if ($query->time > 1000) {
                logger()->warning('Slow query detected', [
                    'sql' => $query->sql,
                    'time' => $query->time,
                ]);
            }
        });
    }
}
```

### 8. Backup Strategy

```bash
# Install spatie/laravel-backup
composer require spatie/laravel-backup

# Configure
php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"

# Run backup
php artisan backup:run

# Schedule daily backup
# In app/Console/Kernel.php
$schedule->command('backup:clean')->daily()->at('01:00');
$schedule->command('backup:run')->daily()->at('02:00');
```

---

## Testing Recipe: Complete Test Suite

```php
<?php

use App\Models\User;
use App\Models\Customer;
use App\Filament\Resources\Customers\CustomerResource;
use function Pest\Laravel\{actingAs, assertDatabaseHas, assertModelMissing};
use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->actingAs(User::factory()->admin()->create());
});

describe('Customer List Page', function () {
    it('can render page', function () {
        $this->get(CustomerResource::getUrl('index'))
            ->assertSuccessful();
    });

    it('can list customers', function () {
        $customers = Customer::factory()->count(10)->create();

        livewire(CustomerResource\Pages\ListCustomers::class)
            ->assertCanSeeTableRecords($customers);
    });

    it('can search customers', function () {
        $customers = Customer::factory()->count(10)->create();
        $searchTerm = $customers->first()->name;

        livewire(CustomerResource\Pages\ListCustomers::class)
            ->searchTable($searchTerm)
            ->assertCanSeeTableRecords(
                $customers->where('name', $searchTerm)
            );
    });

    it('can filter customers by status', function () {
        $activeCustomers = Customer::factory()->count(5)->create(['is_active' => true]);
        $inactiveCustomers = Customer::factory()->count(5)->create(['is_active' => false]);

        livewire(CustomerResource\Pages\ListCustomers::class)
            ->filterTable('is_active', true)
            ->assertCanSeeTableRecords($activeCustomers)
            ->assertCanNotSeeTableRecords($inactiveCustomers);
    });

    it('can sort customers by name', function () {
        $customers = Customer::factory()->count(10)->create();

        livewire(CustomerResource\Pages\ListCustomers::class)
            ->sortTable('name')
            ->assertCanSeeTableRecords(
                $customers->sortBy('name'), 
                inOrder: true
            );
    });

    it('can delete customer from table', function () {
        $customer = Customer::factory()->create();

        livewire(CustomerResource\Pages\ListCustomers::class)
            ->callTableAction('delete', $customer);

        assertModelMissing($customer);
    });
});

describe('Customer Create Page', function () {
    it('can render page', function () {
        $this->get(CustomerResource::getUrl('create'))
            ->assertSuccessful();
    });

    it('can create customer', function () {
        $newData = Customer::factory()->make();

        livewire(CustomerResource\Pages\CreateCustomer::class)
            ->fillForm([
                'name' => $newData->name,
                'email' => $newData->email,
                'phone' => $newData->phone,
                'is_active' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        assertDatabaseHas(Customer::class, [
            'name' => $newData->name,
            'email' => $newData->email,
        ]);
    });

    it('validates required fields', function () {
        livewire(CustomerResource\Pages\CreateCustomer::class)
            ->fillForm([
                'name' => null,
                'email' => null,
            ])
            ->call('create')
            ->assertHasFormErrors([
                'name' => 'required',
                'email' => 'required',
            ]);
    });

    it('validates unique email', function () {
        $existingCustomer = Customer::factory()->create();

        livewire(CustomerResource\Pages\CreateCustomer::class)
            ->fillForm([
                'name' => 'Test Customer',
                'email' => $existingCustomer->email,
            ])
            ->call('create')
            ->assertHasFormErrors(['email' => 'unique']);
    });
});

describe('Customer Edit Page', function () {
    it('can render page', function () {
        $customer = Customer::factory()->create();

        $this->get(CustomerResource::getUrl('edit', ['record' => $customer]))
            ->assertSuccessful();
    });

    it('can retrieve data', function () {
        $customer = Customer::factory()->create();

        livewire(CustomerResource\Pages\EditCustomer::class, [
            'record' => $customer->getRouteKey(),
        ])
            ->assertFormSet([
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
            ]);
    });

    it('can update customer', function () {
        $customer = Customer::factory()->create();
        $newData = Customer::factory()->make();

        livewire(CustomerResource\Pages\EditCustomer::class, [
            'record' => $customer->getRouteKey(),
        ])
            ->fillForm([
                'name' => $newData->name,
                'email' => $newData->email,
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        expect($customer->refresh())
            ->name->toBe($newData->name)
            ->email->toBe($newData->email);
    });

    it('can delete customer', function () {
        $customer = Customer::factory()->create();

        livewire(CustomerResource\Pages\EditCustomer::class, [
            'record' => $customer->getRouteKey(),
        ])
            ->callAction('delete');

        assertModelMissing($customer);
    });
});
```

---

## Zie Ook

- [Core Documentation](./filament-core.md) - Resources overview
- [Tables Documentation](./filament-tables.md) - Table testing details
- [Forms Documentation](./filament-forms.md) - Form field testing
- [Actions Documentation](./filament-actions.md) - Action testing
