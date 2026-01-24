# Filament Spatie Media Library Plugin Documentation

## Overview
Officiële Filament plugin voor Spatie's Laravel Media Library package. Gratis, open source en volledig Filament 4.0 compatible.

**Package:** `filament/spatie-laravel-media-library-plugin`
**Repository:** https://github.com/filamentphp/spatie-laravel-media-library-plugin
**Spatie Docs:** https://spatie.be/docs/laravel-medialibrary

## Version Compatibility

| Plugin | Filament | PHP  | Laravel |
|--------|----------|------|---------|
| 3.x    | ^3.0     | ^8.1 | ^10.0   |
| 4.x    | ^4.0     | ^8.2 | ^11.28+ |

## Installatie

```bash
# Install plugin
composer require filament/spatie-laravel-media-library-plugin:"^4.0" -W

# Install Spatie Media Library (if not yet installed)
composer require spatie/laravel-medialibrary

# Publish migrations
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"

# Run migrations
php artisan migrate
```

## Model Setup

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        // Single file collection
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300);

                $this->addMediaConversion('large')
                    ->width(1200)
                    ->height(800)
                    ->format('webp')
                    ->quality(85);
            });

        // Multiple files collection
        $this->addMediaCollection('gallery')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(400)
                    ->height(300)
                    ->format('webp');
            });
    }
}
```

## Form Component

### Basic Usage

```php
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

SpatieMediaLibraryFileUpload::make('avatar')
```

### With Collection

```php
SpatieMediaLibraryFileUpload::make('featured_image')
    ->collection('featured_image')
    ->image()
    ->maxSize(5120) // 5MB
```

### Complete Example

```php
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

SpatieMediaLibraryFileUpload::make('featured_image')
    ->label('Featured Image')
    ->collection('featured_image')

    // Image specific
    ->image()
    ->imageEditor()
    ->imageEditorAspectRatios([
        null, // Free crop
        '16:9',
        '4:3',
        '1:1',
    ])

    // Size & validation
    ->maxSize(5120) // 5MB in KB
    ->minSize(100)
    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])

    // Storage
    ->disk('public')
    ->directory('featured-images')
    ->visibility('public')

    // Responsive images
    ->responsiveImages()

    // Show conversion instead of original
    ->conversion('thumb')

    // UI
    ->helperText('Recommended: 1200x800px, max 5MB')
    ->required();
```

### Multiple Files

```php
SpatieMediaLibraryFileUpload::make('gallery')
    ->collection('gallery')
    ->multiple()
    ->reorderable() // Drag & drop ordering
    ->maxFiles(10)
    ->minFiles(1)
    ->image()
    ->responsiveImages()
    ->conversion('thumb');
```

### Reorderable Files

```php
SpatieMediaLibraryFileUpload::make('attachments')
    ->multiple()
    ->reorderable() // Enables drag & drop
    ->collection('attachments');
```

## Custom Properties

### Static Properties

```php
SpatieMediaLibraryFileUpload::make('image')
    ->customProperties([
        'category' => 'product',
        'featured' => true,
    ]);
```

### Dynamic Properties

```php
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\Image\Image;

SpatieMediaLibraryFileUpload::make('image')
    ->image()
    ->customProperties(function (TemporaryUploadedFile $file): array {
        $image = Image::load($file->getRealPath());

        return [
            'width' => $image->getWidth(),
            'height' => $image->getHeight(),
            'uploaded_by' => auth()->id(),
        ];
    });
```

### Filter Media by Custom Properties

```php
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Collection;

SpatieMediaLibraryFileUpload::make('images')
    ->collection('products')
    ->customProperties(fn (Get $get): array => [
        'product_id' => $get('product_id'),
    ])
    ->filterMediaUsing(
        fn (Collection $media, Get $get): Collection => $media->where(
            'custom_properties.product_id',
            $get('product_id')
        )
    );
```

## Custom Headers

Vooral nuttig voor S3 caching:

```php
SpatieMediaLibraryFileUpload::make('attachments')
    ->customHeaders([
        'CacheControl' => 'max-age=86400',
        'ContentDisposition' => 'inline',
    ]);
```

## Responsive Images

```php
SpatieMediaLibraryFileUpload::make('image')
    ->responsiveImages() // Auto generate responsive sizes
    ->conversion('large');
```

**Model setup voor responsive images:**

```php
public function registerMediaCollections(): void
{
    $this->addMediaCollection('images')
        ->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('large')
                ->width(1920)
                ->height(1080)
                ->format('webp')
                ->withResponsiveImages(); // Enable responsive
        });
}
```

## Conversions

### Specify Conversion to Display

```php
SpatieMediaLibraryFileUpload::make('avatar')
    ->conversion('thumb') // Show thumb in form
```

### Conversions Disk

Store conversions on different disk:

```php
SpatieMediaLibraryFileUpload::make('attachments')
    ->disk('public') // Original file
    ->conversionsDisk('s3'); // Conversions on S3
```

## Manipulations

Run manipulations on upload:

```php
SpatieMediaLibraryFileUpload::make('attachments')
    ->manipulations([
        'thumb' => ['orientation' => '90'],
        'large' => ['greyscale' => []],
    ]);
```

## Rich Editor File Attachments

Gebruik Spatie Media Library voor file attachments in RichEditor:

### Model Setup

```php
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;

class Post extends Model implements HasMedia, HasRichContent
{
    use InteractsWithMedia;
    use InteractsWithRichContent;

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
            );
    }
}
```

**Belangrijk:** De rich content attribute moet `nullable` zijn in database.

### Custom Collection

```php
$this->registerRichContent('content')
    ->fileAttachmentProvider(
        SpatieMediaLibraryFileAttachmentProvider::make()
            ->collection('content-attachments')
    );
```

### Preserve Filenames

```php
SpatieMediaLibraryFileAttachmentProvider::make()
    ->preserveFilenames()
```

### Custom Media Name

```php
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;

SpatieMediaLibraryFileAttachmentProvider::make()
    ->mediaName(fn (TemporaryUploadedFile $file): string =>
        Str::random() . '_' . $file->getClientOriginalName()
    );
```

### Custom Properties in Rich Editor

```php
SpatieMediaLibraryFileAttachmentProvider::make()
    ->customProperties(['archived' => false]);
```

## Table Column

```php
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

SpatieMediaLibraryImageColumn::make('avatar')
    ->collection('avatars')
    ->conversion('thumb')
    ->size(40)
    ->circular();
```

### Multiple Images

```php
SpatieMediaLibraryImageColumn::make('gallery')
    ->collection('gallery')
    ->conversion('thumb')
    ->limit(3)
    ->ring(2) // Ring size: 0,1,2,4
    ->overlap(4); // Overlap: 0,2,3,4
```

### All Collections

```php
SpatieMediaLibraryImageColumn::make('avatar')
    ->allCollections(); // Show from all collections
```

### Filter Media in Column

```php
use Illuminate\Support\Collection;

SpatieMediaLibraryImageColumn::make('images')
    ->filterMediaUsing(
        fn (Collection $media): Collection => $media->where(
            'custom_properties.featured',
            true
        )
    );
```

### N+1 Prevention

```php
// In ListResource
protected function getTableQuery(): Builder
{
    return parent::getTableQuery()->with(['media']);
}
```

## Infolist Entry

```php
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

SpatieMediaLibraryImageEntry::make('avatar')
    ->collection('avatars')
    ->conversion('thumb')
    ->size(100);
```

### Multiple Images

```php
SpatieMediaLibraryImageEntry::make('gallery')
    ->collection('gallery')
    ->conversion('thumb');
```

### Filter Media

```php
use Illuminate\Support\Collection;

SpatieMediaLibraryImageEntry::make('images')
    ->filterMediaUsing(
        fn (Collection $media): Collection => $media->where(
            'custom_properties.gallery_id',
            12345
        )
    );
```

## Disk Configuration

### Default Disk

Files worden geupload naar disk gedefinieerd in Filament config of `FILESYSTEM_DISK` env variable.

```bash
# .env
FILESYSTEM_DISK=public
```

### Per Collection Disk

```php
public function registerMediaCollections(): void
{
    $this->addMediaCollection('avatars')
        ->useDisk('s3'); // Override disk
}
```

### Per Field Disk

```php
SpatieMediaLibraryFileUpload::make('attachment')
    ->disk('s3')
    ->visibility('private');
```

## Private Files

Spatie ondersteunt geen private files out-of-the-box. Workarounds:

### S3 Bucket Config

Configure bucket as private, then:

```php
SpatieMediaLibraryFileUpload::make('document')
    ->disk('s3')
    ->visibility('private'); // Generates temporary URLs
```

## Media Conversions (Spatie)

Conversions worden gedefinieerd in model:

```php
public function registerMediaCollections(): void
{
    $this->addMediaCollection('images')
        ->registerMediaConversions(function (Media $media) {
            // Thumb
            $this->addMediaConversion('thumb')
                ->width(300)
                ->height(300)
                ->sharpen(10);

            // Medium
            $this->addMediaConversion('medium')
                ->width(800)
                ->height(600)
                ->format('webp')
                ->quality(85);

            // Large with responsive
            $this->addMediaConversion('large')
                ->width(1920)
                ->height(1080)
                ->format('webp')
                ->quality(90)
                ->withResponsiveImages()
                ->nonQueued(); // Process direct
        });
}
```

### Queued Conversions

```php
$this->addMediaConversion('large')
    ->queued(); // Process via queue
```

### Non-Queued Conversions

```php
$this->addMediaConversion('thumb')
    ->nonQueued(); // Process directly
```

## Rendering Media in Blade

### Get Media URL

```php
// Original
$post->getFirstMediaUrl('featured_image');

// Conversion
$post->getFirstMediaUrl('featured_image', 'large');

// With fallback
$post->getFirstMediaUrl('featured_image', 'large') ?: asset('images/placeholder.jpg');
```

### Get Media Object

```php
$media = $post->getFirstMedia('featured_image');

if ($media) {
    $url = $media->getUrl();
    $thumbUrl = $media->getUrl('thumb');
    $width = $media->getCustomProperty('width');
}
```

### Responsive Images

```php
$media = $post->getFirstMedia('featured_image');

<img
    src="{{ $media->getUrl('large') }}"
    srcset="{{ $media->getSrcset('large') }}"
    sizes="(max-width: 768px) 100vw, 50vw"
    alt="{{ $post->title }}"
/>
```

### Multiple Media

```php
@foreach($post->getMedia('gallery') as $media)
    <img
        src="{{ $media->getUrl('thumb') }}"
        alt="{{ $media->name }}"
    />
@endforeach
```

## Praktische Voorbeelden

### Single Image Upload

```php
// Form
SpatieMediaLibraryFileUpload::make('avatar')
    ->collection('avatars')
    ->image()
    ->avatar()
    ->imageEditor()
    ->circleCropper()
    ->maxSize(2048);

// Model
public function registerMediaCollections(): void
{
    $this->addMediaCollection('avatars')
        ->singleFile()
        ->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('thumb')
                ->width(200)
                ->height(200)
                ->format('webp');
        });
}

// Blade
@if($user->hasMedia('avatars'))
    <img src="{{ $user->getFirstMediaUrl('avatars', 'thumb') }}" />
@endif
```

### Product Gallery

```php
// Form
SpatieMediaLibraryFileUpload::make('product_images')
    ->collection('products')
    ->multiple()
    ->reorderable()
    ->maxFiles(8)
    ->image()
    ->imageEditor()
    ->responsiveImages()
    ->conversion('medium')
    ->helperText('Upload tot 8 productfoto\'s');

// Model
public function registerMediaCollections(): void
{
    $this->addMediaCollection('products')
        ->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('thumb')
                ->width(300)
                ->height(300);

            $this->addMediaConversion('medium')
                ->width(800)
                ->height(600)
                ->withResponsiveImages();

            $this->addMediaConversion('large')
                ->width(1600)
                ->height(1200)
                ->format('webp')
                ->quality(90);
        });
}

// Blade
<div class="grid grid-cols-4 gap-4">
    @foreach($product->getMedia('products') as $media)
        <a href="{{ $media->getUrl('large') }}" data-lightbox="gallery">
            <img
                src="{{ $media->getUrl('medium') }}"
                srcset="{{ $media->getSrcset('medium') }}"
                alt="{{ $product->name }}"
                class="rounded-lg"
            />
        </a>
    @endforeach
</div>
```

### Document Uploads

```php
// Form
SpatieMediaLibraryFileUpload::make('documents')
    ->collection('documents')
    ->multiple()
    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
    ->maxSize(10240) // 10MB
    ->downloadable()
    ->previewable(false);

// Blade
<ul>
    @foreach($post->getMedia('documents') as $media)
        <li>
            <a href="{{ $media->getUrl() }}" download>
                {{ $media->file_name }} ({{ $media->human_readable_size }})
            </a>
        </li>
    @endforeach
</ul>
```

### Conditional Media per Repeater

```php
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Utilities\Get;

Repeater::make('sections')
    ->schema([
        TextInput::make('title'),

        SpatieMediaLibraryFileUpload::make('image')
            ->collection('section_images')
            ->customProperties(fn (Get $get): array => [
                'section_id' => $get('../../id') ?? uniqid(),
            ])
            ->filterMediaUsing(
                fn (Collection $media, Get $get): Collection => $media->where(
                    'custom_properties.section_id',
                    $get('../../id')
                )
            ),
    ]);
```

## Integratie met Filament Fabricator

```php
// PageBlock
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

public static function getBlockSchema(): Block
{
    return Block::make('hero')
        ->schema([
            TextInput::make('title'),

            SpatieMediaLibraryFileUpload::make('hero_image')
                ->collection('heroes')
                ->image()
                ->responsiveImages()
                ->conversion('hero'),
        ]);
}

// Page Model
public function registerMediaCollections(): void
{
    $this->addMediaCollection('heroes')
        ->singleFile()
        ->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('hero')
                ->width(1920)
                ->height(1080)
                ->format('webp')
                ->withResponsiveImages();
        });
}

// Blade
@aware(['page'])

@if($page->hasMedia('heroes'))
    <img
        src="{{ $page->getFirstMediaUrl('heroes', 'hero') }}"
        srcset="{{ $page->getFirstMedia('heroes')->getSrcset('hero') }}"
    />
@endif
```

## Tips & Best Practices

1. **Gebruik Collections** - Groepeer media logisch per type
2. **Enable Responsive Images** - Voor betere performance
3. **WebP Format** - Kleinere bestandsgrootte, betere kwaliteit
4. **Queue Conversions** - Voor grote bestanden/veel conversions
5. **Custom Properties** - Voor filtering en metadata
6. **N+1 Prevention** - Eager load media in queries
7. **Disk Separation** - Originals op public, conversions op CDN
8. **Validation** - Altijd maxSize en acceptedFileTypes instellen

## Common Patterns

### Eager Load Media

```php
// In Resource
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->with(['media']);
}

// In Controller
$posts = Post::with('media')->get();
```

### Delete Old Media on Update

```php
// Wordt automatisch gedaan door Spatie bij singleFile()
$this->addMediaCollection('avatar')->singleFile();
```

### Custom Media Model

```php
// config/media-library.php
'media_model' => App\Models\CustomMedia::class,
```

### Generate Missing Conversions

```bash
php artisan media-library:regenerate
```

### Clear Media

```php
// All media
$model->clearMediaCollection('images');

// Specific media
$media->delete();
```

## Troubleshooting

### Images niet zichtbaar

```bash
# Link storage
php artisan storage:link

# Check permissions
chmod -R 755 storage/app/public
```

### Conversions niet gegenereerd

```bash
# Regenerate
php artisan media-library:regenerate

# Check queue
php artisan queue:work
```

### Memory issues

```php
// Use queued conversions
$this->addMediaConversion('large')
    ->queued();
```

### GD vs Imagick

```php
// config/media-library.php
'image_driver' => 'imagick', // or 'gd'
```

## Resources

- [Officiële Filament Docs](https://filamentphp.com/plugins/filament-spatie-media-library)
- [Spatie Media Library Docs](https://spatie.be/docs/laravel-medialibrary)
- [GitHub Repository](https://github.com/filamentphp/spatie-laravel-media-library-plugin)
