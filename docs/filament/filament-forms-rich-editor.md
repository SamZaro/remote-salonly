# Filament 4.x Rich Editor

> Documentatie voor Claude Code - Filament Forms Rich Editor component
> Bron: https://filamentphp.com/docs/4.x/forms/rich-editor

## Basis gebruik

```php
use Filament\Forms\Components\RichEditor;

RichEditor::make('content')
```

De Rich Editor gebruikt [TipTap](https://tiptap.dev) als onderliggende editor voor HTML content met image uploads.

## Content opslaan als JSON

Standaard slaat de editor HTML op. Voor JSON opslag:

```php
RichEditor::make('content')
    ->json()
```

**Eloquent model cast vereist:**

```php
class Post extends Model
{
    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }
}
```

## Toolbar configuratie

### Standaard toolbar buttons

```php
RichEditor::make('content')
    ->toolbarButtons([
        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
        ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
        ['table', 'attachFiles'],
        ['undo', 'redo'],
    ])
```

### Alle beschikbare toolbar tools

| Tool | Beschrijving |
|------|-------------|
| `bold`, `italic`, `underline`, `strike` | Basis tekstopmaak |
| `subscript`, `superscript` | Sub- en superscript |
| `link` | Hyperlinks |
| `h1`, `h2`, `h3` | Headings |
| `alignStart`, `alignCenter`, `alignEnd`, `alignJustify` | Tekstuitlijning |
| `blockquote` | Citaatblok |
| `codeBlock` | Codeblok |
| `bulletList`, `orderedList` | Lijsten |
| `table` | Tabel invoegen (3 kolommen, 2 rijen, header row) |
| `attachFiles` | Afbeeldingen uploaden |
| `undo`, `redo` | Ongedaan maken/herhalen |
| `clearFormatting` | Opmaak verwijderen |
| `details` | Collapsible `<details>` sectie |
| `grid` | Responsive grid layout |
| `gridDelete` | Grid verwijderen |
| `highlight` | Tekst markeren met `<mark>` |
| `horizontalRule` | Horizontale lijn |
| `lead` | Lead paragraph class |
| `small` | `<small>` tag |
| `code` | Inline code |
| `textColor` | Tekstkleur wijzigen |

### Tabel-specifieke tools

| Tool | Beschrijving |
|------|-------------|
| `tableAddColumnBefore` | Kolom toevoegen voor huidige |
| `tableAddColumnAfter` | Kolom toevoegen na huidige |
| `tableDeleteColumn` | Kolom verwijderen |
| `tableAddRowBefore` | Rij toevoegen boven huidige |
| `tableAddRowAfter` | Rij toevoegen onder huidige |
| `tableDeleteRow` | Rij verwijderen |
| `tableMergeCells` | Cellen samenvoegen |
| `tableSplitCell` | Cel splitsen |
| `tableToggleHeaderRow` | Header rij aan/uit |
| `tableToggleHeaderCell` | Header cel aan/uit |
| `tableDelete` | Tabel verwijderen |

### Floating toolbars

Toon context-specifieke tools wanneer cursor in bepaald node type staat:

```php
RichEditor::make('content')
    ->floatingToolbars([
        'paragraph' => [
            'bold', 'italic', 'underline', 'strike', 'subscript', 'superscript',
        ],
        'heading' => [
            'h1', 'h2', 'h3',
        ],
        'table' => [
            'tableAddColumnBefore', 'tableAddColumnAfter', 'tableDeleteColumn',
            'tableAddRowBefore', 'tableAddRowAfter', 'tableDeleteRow',
            'tableMergeCells', 'tableSplitCell',
            'tableToggleHeaderRow', 'tableToggleHeaderCell',
            'tableDelete',
        ],
    ])
```

## Tekstkleuren aanpassen

### Eigen kleuren definiëren

```php
RichEditor::make('content')
    ->textColors([
        '#ef4444' => 'Red',
        '#10b981' => 'Green',
        '#0ea5e9' => 'Sky',
    ])
```

### Met dark mode ondersteuning

```php
use Filament\Forms\Components\RichEditor\TextColor;

RichEditor::make('content')
    ->textColors([
        'brand' => TextColor::make('Brand', '#0ea5e9'),
        'warning' => TextColor::make('Warning', '#f59e0b', darkColor: '#fbbf24'),
    ])
```

### Toevoegen aan standaard Tailwind palette

```php
RichEditor::make('content')
    ->textColors([
        'brand' => TextColor::make('Brand', '#0ea5e9'),
        ...TextColor::getDefaults(),
    ])
```

### Custom color picker inschakelen

```php
RichEditor::make('content')
    ->textColors([...])
    ->customTextColors()
```

## Afbeeldingen uploaden

### Configuratie

```php
RichEditor::make('content')
    ->fileAttachmentsDisk('s3')
    ->fileAttachmentsDirectory('attachments')
    ->fileAttachmentsVisibility('private')
```

### Validatie

```php
RichEditor::make('content')
    ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg'])
    ->fileAttachmentsMaxSize(5120) // 5 MB in KB
```

Standaard: `image/png`, `image/jpeg`, `image/gif`, `image/webp` en max 12288 KB (12 MB)

### Afbeeldingen resizen door gebruiker

```php
RichEditor::make('content')
    ->resizableImages()
```

## Rich Content renderen

### Basis rendering

Voor JSON content of private images:

```php
use Filament\Forms\Components\RichEditor\RichContentRenderer;

// Als string
RichContentRenderer::make($record->content)->toHtml()

// In Blade (automatisch Htmlable)
{{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make($record->content) }}
```

### Met private images

```php
RichContentRenderer::make($record->content)
    ->fileAttachmentsDisk('s3')
    ->fileAttachmentsVisibility('private')
    ->toHtml()
```

### Styling in Blade views

**Met Tailwind Typography:**
```html
<div class="prose dark:prose-invert">
    {!! RichContentRenderer::make($record->content) !!}
</div>
```

**Met Filament styling (inclusief grid en text colors):**
```html
<div class="fi-prose">
    {!! RichContentRenderer::make($record->content) !!}
</div>
```

## Security

**Belangrijk:** Raw HTML output altijd sanitizen tegen XSS:

```php
// In eigen Blade views
{!! str($record->content)->sanitizeHtml() !!}
```

`RichContentRenderer` sanitized automatisch.

## Custom Blocks

### Registreren

```php
RichEditor::make('content')
    ->customBlocks([
        HeroBlock::class,
        CallToActionBlock::class,
    ])
```

### Block class genereren

```bash
php artisan make:filament-rich-content-custom-block HeroBlock
```

### Block class structuur

```php
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor\RichContentCustomBlock;
use Filament\Forms\Components\TextInput;

class HeroBlock extends RichContentCustomBlock
{
    public static function getId(): string
    {
        return 'hero';
    }

    public static function getLabel(): string
    {
        return 'Hero section';
    }

    // Modal voor configuratie bij invoegen
    public static function configureEditorAction(Action $action): Action
    {
        return $action
            ->modalDescription('Configure the hero section')
            ->schema([
                TextInput::make('heading')->required(),
                TextInput::make('subheading'),
            ]);
    }

    // Preview in editor
    public static function toPreviewHtml(array $config): string
    {
        return view('rich-editor.blocks.hero.preview', [
            'heading' => $config['heading'],
            'subheading' => $config['subheading'] ?? '',
        ])->render();
    }

    // Dynamisch preview label
    public static function getPreviewLabel(array $config): string
    {
        return "Hero: {$config['heading']}";
    }

    // Rendering voor output
    public static function toHtml(array $config, array $data): string
    {
        return view('rich-editor.blocks.hero.index', [
            'heading' => $config['heading'],
            'subheading' => $config['subheading'],
            'buttonUrl' => $data['categoryUrl'],
        ])->render();
    }
}
```

### Custom blocks renderen met data

```php
RichContentRenderer::make($record->content)
    ->customBlocks([
        HeroBlock::class => [
            'categoryUrl' => $record->category->getUrl(),
        ],
        CallToActionBlock::class,
    ])
    ->toHtml()
```

### Custom blocks panel standaard open

```php
RichEditor::make('content')
    ->customBlocks([...])
    ->activePanel('customBlocks')
```

## Merge Tags

Placeholders die vervangen worden bij rendering.

### Registreren

```php
RichEditor::make('content')
    ->mergeTags([
        'name',
        'today',
    ])
```

### Met custom labels

```php
RichEditor::make('content')
    ->mergeTags([
        'name' => 'Full name',
        'today' => 'Today\'s date',
    ])
```

### Invoegen

- Type `{{` om te zoeken
- Of gebruik "merge tags" tool in toolbar

### Renderen met waarden

```php
RichContentRenderer::make($record->content)
    ->mergeTags([
        'name' => $record->user->name,
        'today' => now()->toFormattedDateString(),
    ])
    ->toHtml()
```

### Met lazy loading (closures)

```php
RichContentRenderer::make($record->content)
    ->mergeTags([
        'name' => fn (): string => $record->user->name,
        'today' => now()->toFormattedDateString(),
    ])
    ->toHtml()
```

### HTML in merge tags

```php
use Illuminate\Support\HtmlString;

RichContentRenderer::make($record->content)
    ->mergeTags([
        'user_name' => $record->user->name, // Plain text
        'user_profile_link' => new HtmlString('<a href="...">View Profile</a>'),
    ])
    ->toHtml()
```

### Merge tags panel standaard open

```php
RichEditor::make('content')
    ->mergeTags([...])
    ->activePanel('mergeTags')
```

## Mentions

References naar andere records via trigger characters.

### Basis met statische items

```php
use Filament\Forms\Components\RichEditor\MentionProvider;

RichEditor::make('content')
    ->mentions([
        MentionProvider::make('@')
            ->items([
                1 => 'Jane Doe',
                2 => 'John Smith',
            ]),
    ])
```

### Meerdere providers

```php
RichEditor::make('content')
    ->mentions([
        MentionProvider::make('@')
            ->items([...]), // Users
        MentionProvider::make('#')
            ->items([
                'bug' => 'Bug',
                'feature' => 'Feature',
            ]), // Tags
    ])
```

### Database search

```php
MentionProvider::make('@')
    ->getSearchResultsUsing(fn (string $search): array => User::query()
        ->where('name', 'like', "%{$search}%")
        ->orderBy('name')
        ->limit(10)
        ->pluck('name', 'id')
        ->all())
    ->getLabelsUsing(fn (array $ids): array => User::query()
        ->whereIn('id', $ids)
        ->pluck('name', 'id')
        ->all())
```

### Mentions renderen met URLs

```php
RichContentRenderer::make($record->content)
    ->mentions([
        MentionProvider::make('@')
            ->getLabelsUsing(fn (array $ids): array => User::query()
                ->whereIn('id', $ids)
                ->pluck('name', 'id')
                ->all())
            ->url(fn (string $id, string $label): string => route('users.show', $id)),
    ])
    ->toHtml()
```

## Rich Content Attributes (Model Trait)

Centraliseer configuratie voor editor én renderer.

### Model setup

```php
use Filament\Forms\Components\RichEditor\MentionProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Filament\Forms\Components\RichEditor\TextColor;

class Post extends Model implements HasRichContent
{
    use InteractsWithRichContent;

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentsDisk('s3')
            ->fileAttachmentsVisibility('private')
            ->customBlocks([
                HeroBlock::class => [
                    'categoryUrl' => fn (): string => $this->category->getUrl(),
                ],
            ])
            ->mergeTags([
                'name' => fn (): string => $this->user->name,
            ])
            ->mergeTagLabels([
                'name' => 'Full name',
            ])
            ->mentions([
                MentionProvider::make('@')->items([...]),
            ])
            ->textColors([
                'brand' => TextColor::make('Brand', '#0ea5e9', darkColor: '#38bdf8'),
            ])
            ->customTextColors()
            ->plugins([
                HighlightRichContentPlugin::make(),
            ]);
    }
}
```

### Automatisch toegepast op editor

```php
// Configuratie wordt automatisch geladen
RichEditor::make('content')
```

### Rendering vanuit model

```php
// Als string
{!! $record->renderRichContent('content') !!}

// Als Htmlable object
{{ $record->getRichContentAttribute('content') }}
```

### In tabellen en infolists

```php
// Automatische rendering
TextColumn::make('content')
TextEntry::make('content')
```

## Plugins (Extensies)

Custom TipTap extensions en toolbar buttons.

### Plugin class structuur

```php
use Filament\Actions\Action;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Support\Facades\FilamentAsset;
use Tiptap\Core\Extension;

class HighlightRichContentPlugin implements RichContentPlugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    // PHP TipTap extensions (server-side rendering)
    public function getTipTapPhpExtensions(): array
    {
        return [
            app(\Tiptap\Marks\Highlight::class, [
                'options' => ['multicolor' => true],
            ]),
        ];
    }

    // JavaScript TipTap extensions (async loaded)
    public function getTipTapJsExtensions(): array
    {
        return [
            FilamentAsset::getScriptSrc('rich-content-plugins/highlight'),
        ];
    }

    // Custom toolbar tools
    public function getEditorTools(): array
    {
        return [
            RichEditorTool::make('highlight')
                ->jsHandler('$getEditor()?.chain().focus().toggleHighlight().run()')
                ->icon(Heroicon::CursorArrowRays),
            RichEditorTool::make('highlightWithCustomColor')
                ->action(arguments: '{ color: $getEditor().getAttributes(\'highlight\')?.[\'data-color\'] }')
                ->icon(Heroicon::CursorArrowRipple),
        ];
    }

    // Actions voor tools met modals
    public function getEditorActions(): array
    {
        return [
            Action::make('highlightWithCustomColor')
                ->fillForm(fn (array $arguments): array => [
                    'color' => $arguments['color'] ?? null,
                ])
                ->schema([
                    ColorPicker::make('color'),
                ])
                ->action(function (array $arguments, array $data, RichEditor $component): void {
                    $component->runCommands(
                        [EditorCommand::make('toggleHighlight', arguments: [['color' => $data['color']]])],
                        editorSelection: $arguments['editorSelection'],
                    );
                }),
        ];
    }
}
```

### Plugin registreren

```php
RichEditor::make('content')
    ->toolbarButtons([
        ['bold', 'highlight', 'highlightWithCustomColor'],
    ])
    ->plugins([
        HighlightRichContentPlugin::make(),
    ])

// Ook bij rendering
RichContentRenderer::make($record->content)
    ->plugins([HighlightRichContentPlugin::make()])
```

### JavaScript extension setup

**1. Installeer npm package:**
```bash
npm install @tiptap/extension-highlight --save-dev
```

**2. Maak JS bestand** (`resources/js/filament/rich-content-plugins/highlight.js`):
```javascript
import Highlight from '@tiptap/extension-highlight'

export default Highlight.configure({
    multicolor: true,
})
```

**3. Build script** (`bin/build.js`):
```javascript
import * as esbuild from 'esbuild'

esbuild.context({
    define: { 'process.env.NODE_ENV': `'production'` },
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'neutral',
    treeShaking: true,
    target: ['es2020'],
    minify: true,
    entryPoints: ['./resources/js/filament/rich-content-plugins/highlight.js'],
    outfile: './resources/js/dist/filament/rich-content-plugins/highlight.js',
}).then(ctx => ctx.rebuild().then(() => ctx.dispose()))
```

**4. Compileer:**
```bash
npm install esbuild --save-dev
node bin/build.js
```

**5. Registreer asset** (in `AppServiceProvider::boot()`):
```php
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;

FilamentAsset::register([
    Js::make('rich-content-plugins/highlight', __DIR__ . '/../../resources/js/dist/filament/rich-content-plugins/highlight.js')
        ->loadedOnRequest(),
]);
```

**6. Publiceer:**
```bash
php artisan filament:assets
```

## Utility Injection

Alle methodes die closures accepteren ondersteunen utility injection:

| Utility | Type | Parameter |
|---------|------|-----------|
| Field | `Filament\Forms\Components\Field` | `$component` |
| Get function | `Filament\Schemas\Components\Utilities\Get` | `$get` |
| Livewire | `Livewire\Component` | `$livewire` |
| Model FQN | `?string` | `$model` |
| Operation | `string` | `$operation` |
| Raw state | `mixed` | `$rawState` |
| Record | `?Model` | `$record` |
| State | `mixed` | `$state` |

## Spatie Media Library integratie

Zie [plugin documentatie](https://filamentphp.com/plugins/filament-spatie-media-library#using-media-library-for-rich-editor-file-attachments) voor integratie met `spatie/laravel-medialibrary`.
