<?php

namespace App\Filament\Schemas;

use App\Settings\SiteSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class TemplateFormSchema
{
    /**
     * General tab - with optional category field and preview image for admin.
     */
    public static function generalTab(bool $includeCategory = true, bool $isAdmin = false): Tab
    {
        $schema = [];

        if ($includeCategory) {
            $schema[] = Select::make('category_id')
                ->label(__('Category'))
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->nullable();
        }

        $schema = array_merge($schema, [
            TextInput::make('name')
                ->label(__('Name'))
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (Set $set, ?string $state, string $context) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
            TextInput::make('slug')
                ->label(__('Slug'))
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true)
                ->helperText(__('The unique identifier for this template.')),
            Textarea::make('description')
                ->label(__('Description'))
                ->rows(3)
                ->columnSpanFull(),
        ]);

        // Add admin-only fields
        if ($isAdmin) {
            $schema = array_merge($schema, [
                TextInput::make('sort_order')
                    ->label(__('Sort Order'))
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label(__('Is Active'))
                    ->default(true),
            ]);
        }

        // Logo configuration schema
        $logoConfigSchema = [
            Select::make('theme_config.logo.type')
                ->label(__('Logo Type'))
                ->options([
                    'text' => __('Text'),
                    'image' => __('Image'),
                ])
                ->default('text')
                ->afterStateHydrated(function (Select $component, ?string $state) {
                    if (empty($state)) {
                        $component->state('text');
                    }
                })
                ->live()
                ->required(),
            TextInput::make('theme_config.logo.text')
                ->label(__('Logo Text'))
                ->placeholder(__('Company Name'))
                ->afterStateHydrated(function (TextInput $component, ?string $state) {
                    if (empty($state)) {
                        $siteName = app(SiteSettings::class)->site_name;
                        $component->state($siteName);
                    }
                })
                ->visible(fn ($get) => $get('theme_config.logo.type') === 'text')
                ->helperText(__('Text to display as logo. Leave empty to use template name.')),
            SpatieMediaLibraryFileUpload::make('logo')
                ->label(__('Logo Image'))
                ->collection('logo')
                ->image()
                ->imageEditor()
                ->acceptedFileTypes(['image/png', 'image/jpeg'])
                ->maxSize(2048)
                ->visible(fn ($get) => $get('theme_config.logo.type') === 'image')
                ->helperText(__('Max 2MB. Supports .png and .jpg formats.')),
        ];

        // Add preview image for admin users only
        if ($isAdmin) {
            $logoConfigSchema[] = SpatieMediaLibraryFileUpload::make('preview')
                ->label(__('Preview Image'))
                ->collection('preview')
                ->image()
                ->imageEditor()
                ->helperText(__('Preview image shown in template selection. Only visible to administrators.'))
                ->columnSpanFull();
        }

        $sections = [];

        // Add Basic Information section FIRST for admin users
        if ($isAdmin) {
            $sections[] = Section::make(__('Basic Information'))
                ->schema($schema)
                ->columns(2);
        }

        // Then add configuration sections (Logo & Favicon side by side on large screens)
        $sections[] = Grid::make(['default' => 1, 'lg' => 2])
            ->schema([
                Section::make(__('Logo'))
                    ->schema($logoConfigSchema),
                Section::make(__('Favicon'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('favicon')
                            ->label(__('Favicon'))
                            ->collection('favicon')
                            ->image()
                            ->imageEditor()
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/vnd.microsoft.icon'])
                            ->maxSize(512)
                            ->helperText(__('Max 512KB. Recommended: 32x32 or 64x64 pixels.')),
                    ]),
            ]);

        return Tab::make(__('General'))
            ->icon('heroicon-o-information-circle')
            ->schema($sections);
    }

    /**
     * Media tab - shows overview of all section images (read-only).
     */
    public static function mediaTab(): Tab
    {
        return Tab::make(__('Media'))
            ->icon('heroicon-o-photo')
            ->schema([
                Section::make(__('Section Images'))
                    ->description(__('Overview of all images uploaded to template sections. Manage images via the Sections tab.'))
                    ->schema([
                        ViewField::make('section_images_overview')
                            ->view('filament.common.forms.section-images-overview')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /**
     * Get available Google Fonts for typography selection.
     * Key = font name (used for Google Fonts URL)
     * Value = display label
     */
    public static function getGoogleFonts(): array
    {
        return [
            // Sans-serif fonts
            'Inter' => 'Inter',
            'Poppins' => 'Poppins',
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
            'Nunito' => 'Nunito',
            'Raleway' => 'Raleway',
            'Source Sans 3' => 'Source Sans 3',
            'Ubuntu' => 'Ubuntu',
            'Oswald' => 'Oswald',
            'PT Sans' => 'PT Sans',
            'Rubik' => 'Rubik',
            'Work Sans' => 'Work Sans',
            'Quicksand' => 'Quicksand',
            'DM Sans' => 'DM Sans',
            'Manrope' => 'Manrope',
            'Space Grotesk' => 'Space Grotesk',
            // Serif fonts
            'Playfair Display' => 'Playfair Display (Serif)',
            'Merriweather' => 'Merriweather (Serif)',
            'Libre Baskerville' => 'Libre Baskerville (Serif)',
            'Lora' => 'Lora (Serif)',
            'Cormorant Garamond' => 'Cormorant Garamond (Serif)',
            'DM Serif Display' => 'DM Serif Display (Serif)',
            // System fonts
            'system-ui' => 'System Default',
        ];
    }

    /**
     * Get predefined color schemes.
     *
     * Color roles:
     * - primary_color: Main accent (buttons, highlights, decorative elements)
     * - secondary_color: Dark/contrast color (dark section backgrounds, cards)
     * - accent_color: Secondary accent (hover states, gradients with primary)
     * - background_color: Light section backgrounds
     * - text_color: Body text
     * - heading_color: Heading text
     */
    public static function getColorSchemes(): array
    {
        return [
            'custom' => [
                'label' => __('Custom'),
                'colors' => null,
            ],
            'luxury' => [
                'label' => __('Luxury'),
                'colors' => [
                    'primary_color' => '#C8B88A',      // Champagne gold - accents
                    'secondary_color' => '#0F0F0F',   // Deep black - dark sections
                    'accent_color' => '#D4C4A0',      // Light gold - hover/secondary
                    'background_color' => '#F5F3EF', // Off-white - light sections
                    'text_color' => '#6B6B6B',        // Warm grey - body text
                    'heading_color' => '#0F0F0F',    // Black - headings
                    'navbar_background' => '#0F0F0F',
                    'navbar_text_color' => '#C8B88A',
                    'navbar_underline_color' => '#C8B88A',
                ],
            ],
            'vintage' => [
                'label' => __('Vintage'),
                'colors' => [
                    'primary_color' => '#8B4513',     // Saddle brown - accents
                    'secondary_color' => '#3E2723',  // Dark brown - dark sections
                    'accent_color' => '#D2691E',     // Chocolate - hover
                    'background_color' => '#FDF5E6', // Old lace - light sections
                    'text_color' => '#6D4C41',       // Brown grey - body text
                    'heading_color' => '#3E2723',   // Dark brown - headings
                    'navbar_background' => '#3E2723',
                    'navbar_text_color' => '#FDF5E6',
                    'navbar_underline_color' => '#8B4513',
                ],
            ],
            'modern' => [
                'label' => __('Modern'),
                'colors' => [
                    'primary_color' => '#2563eb',    // Blue - accents
                    'secondary_color' => '#1e293b', // Slate - dark sections
                    'accent_color' => '#3b82f6',    // Light blue - hover
                    'background_color' => '#f8fafc', // Light grey - light sections
                    'text_color' => '#64748b',      // Slate grey - body text
                    'heading_color' => '#0f172a',   // Dark slate - headings
                    'navbar_background' => '#1e293b',
                    'navbar_text_color' => '#f8fafc',
                    'navbar_underline_color' => '#2563eb',
                ],
            ],
            'trendy' => [
                'label' => __('Trendy'),
                'colors' => [
                    'primary_color' => '#8b5cf6',    // Purple - accents
                    'secondary_color' => '#18181b', // Zinc dark - dark sections
                    'accent_color' => '#a78bfa',    // Light purple - hover
                    'background_color' => '#fafafa', // Zinc light - light sections
                    'text_color' => '#71717a',      // Zinc grey - body text
                    'heading_color' => '#18181b',   // Zinc dark - headings
                    'navbar_background' => '#18181b',
                    'navbar_text_color' => '#fafafa',
                    'navbar_underline_color' => '#8b5cf6',
                ],
            ],
            'natural' => [
                'label' => __('Natural'),
                'colors' => [
                    'primary_color' => '#14b8a6',    // Teal - 500 - accents
                    'secondary_color' => '#1c1917', // Stone dark - dark sections
                    'accent_color' => '#99f6e4',    // Light emerald - hover
                    'background_color' => '#44403c', // Stone - 700
                    'text_color' => '#78716c',      // Stone grey - body text
                    'heading_color' => '#1c1917',   // Stone dark - headings
                    'navbar_background' => '#1c1917',
                    'navbar_text_color' => '#fafaf9',
                    'navbar_underline_color' => '#14b8a6',
                ],
            ],
            'rose' => [
                'label' => __('Rose'),
                'colors' => [
                    'primary_color' => '#e11d48',    // Rose - accents
                    'secondary_color' => '#1f1f1f', // Neutral dark - dark sections
                    'accent_color' => '#fb7185',    // Light rose - hover
                    'background_color' => '#fafafa', // Near white - light sections
                    'text_color' => '#737373',      // Neutral grey - body text
                    'heading_color' => '#171717',   // Neutral dark - headings
                    'navbar_background' => '#1f1f1f',
                    'navbar_text_color' => '#fafafa',
                    'navbar_underline_color' => '#e11d48',
                ],
            ],
            'beauty' => [
                'label' => __('Beauty'),
                'colors' => [
                    'primary_color' => '#E8D8D3',    // Nude roze - accents
                    'secondary_color' => '#6E5F5B', // Donker taupe - dark sections
                    'accent_color' => '#F2E7E4',    // Poeder roze - hover
                    'background_color' => '#FBF9F8', // Roomwit - light sections
                    'text_color' => '#8A7B76',      // Warm taupe grey - body text
                    'heading_color' => '#6E5F5B',   // Donker taupe - headings
                    'navbar_background' => '#6E5F5B',
                    'navbar_text_color' => '#FBF9F8',
                    'navbar_underline_color' => '#E8D8D3',
                ],
            ],
            'peach' => [
                'label' => __('Peach'),
                'colors' => [
                    'primary_color' => '#FF6F61',    // Coral - accents
                    'secondary_color' => '#2B2B2B', // Donker grafiet - dark sections
                    'accent_color' => '#FFD6C9',    // Warm perzik - hover
                    'background_color' => '#FAFAFA', // Gebroken wit - light sections
                    'text_color' => '#6B6B6B',      // Warm grey - body text
                    'heading_color' => '#2B2B2B',   // Donker grafiet - headings
                    'navbar_background' => '#2B2B2B',
                    'navbar_text_color' => '#FAFAFA',
                    'navbar_underline_color' => '#FF6F61',
                ],
            ],
            'minimal' => [
                'label' => __('Minimal'),
                'colors' => [
                    'primary_color' => '#171717',      // Neutral 900 - accents
                    'secondary_color' => '#0a0a0a',    // Neutral 950 - dark sections
                    'accent_color' => '#404040',       // Neutral 700 - hover
                    'background_color' => '#FAFAFA',   // Neutral 50 - light sections
                    'text_color' => '#737373',         // Neutral 500 - body text
                    'heading_color' => '#171717',      // Neutral 900 - headings
                    'navbar_background' => '#0a0a0a',
                    'navbar_text_color' => '#FAFAFA',
                    'navbar_underline_color' => '#171717',
                ],
            ],
            'ocean' => [
                'label' => __('Ocean'),
                'colors' => [
                    'primary_color' => '#0077b6',      // Deep ocean blue - accents
                    'secondary_color' => '#0d1b2a',    // Dark navy - dark sections
                    'accent_color' => '#48cae4',       // Light cyan - hover
                    'background_color' => '#f0f7ff',   // Ice blue - light sections
                    'text_color' => '#4a6a8a',         // Steel blue - body text
                    'heading_color' => '#0d1b2a',      // Dark navy - headings
                    'navbar_background' => '#0d1b2a',
                    'navbar_text_color' => '#f0f7ff',
                    'navbar_underline_color' => '#0077b6',
                ],
            ],
            'forest' => [
                'label' => __('Forest'),
                'colors' => [
                    'primary_color' => '#2d6a4f',      // Forest green - accents
                    'secondary_color' => '#1b1b1b',    // Near black - dark sections
                    'accent_color' => '#52b788',       // Light green - hover
                    'background_color' => '#f9faf8',   // Off white - light sections
                    'text_color' => '#6b7280',         // Cool grey - body text
                    'heading_color' => '#1b1b1b',      // Near black - headings
                    'navbar_background' => '#1b1b1b',
                    'navbar_text_color' => '#f9faf8',
                    'navbar_underline_color' => '#2d6a4f',
                ],
            ],
            'dark' => [
                'label' => __('Dark'),
                'colors' => [
                    'primary_color' => '#6366f1',      // Indigo - accents
                    'secondary_color' => '#0f0f0f',    // Near black - dark sections
                    'accent_color' => '#818cf8',       // Light indigo - hover
                    'background_color' => '#111111',   // Dark background
                    'text_color' => '#a1a1aa',         // Zinc grey - body text
                    'heading_color' => '#f4f4f5',      // Zinc light - headings
                    'navbar_background' => '#0a0a0a',
                    'navbar_text_color' => '#f4f4f5',
                    'navbar_underline_color' => '#6366f1',
                ],
            ],
        ];
    }

    /**
     * Normalize a font family value by extracting the primary font name.
     * Handles CSS font-family strings like "Playfair Display, serif" -> "Playfair Display"
     */
    public static function normalizeFontFamily(?string $fontFamily): ?string
    {
        if (empty($fontFamily)) {
            return null;
        }

        // Split by comma and take the first font
        $primaryFont = explode(',', $fontFamily)[0];

        // Remove quotes and trim whitespace
        $primaryFont = trim($primaryFont, " \t\n\r\0\x0B'\"");

        // Check if this font exists in our options
        $availableFonts = self::getGoogleFonts();
        if (array_key_exists($primaryFont, $availableFonts)) {
            return $primaryFont;
        }

        return null;
    }

    /**
     * Generate option label with color swatches.
     */
    public static function getSchemeLabel(string $schemeKey): HtmlString
    {
        $schemes = self::getColorSchemes();
        $label = $schemes[$schemeKey]['label'] ?? $schemeKey;

        if ($schemeKey === 'custom' || ! isset($schemes[$schemeKey]['colors'])) {
            return new HtmlString($label);
        }

        $colors = $schemes[$schemeKey]['colors'];
        $swatches = collect(['primary_color', 'secondary_color', 'accent_color'])
            ->map(fn ($key) => sprintf(
                '<span class="inline-block w-6 h-4 rounded-medium border border-gray-300 dark:border-gray-600" style="background-color: %s;"></span>',
                $colors[$key]
            ))
            ->implode('');

        return new HtmlString('<span class="inline-flex items-center gap-2">'.$swatches.'<span>'.$label.'</span></span>');
    }

    /**
     * Detect which color scheme matches the current theme colors.
     * Returns 'custom' if no scheme matches.
     */
    public static function detectActiveScheme(?array $themeConfig): string
    {
        if (empty($themeConfig)) {
            return 'custom';
        }

        $schemes = self::getColorSchemes();
        $currentPrimary = strtolower($themeConfig['primary_color'] ?? '');
        $currentSecondary = strtolower($themeConfig['secondary_color'] ?? '');
        $currentAccent = strtolower($themeConfig['accent_color'] ?? '');

        foreach ($schemes as $key => $scheme) {
            if ($key === 'custom' || ! isset($scheme['colors'])) {
                continue;
            }

            $schemePrimary = strtolower($scheme['colors']['primary_color'] ?? '');
            $schemeSecondary = strtolower($scheme['colors']['secondary_color'] ?? '');
            $schemeAccent = strtolower($scheme['colors']['accent_color'] ?? '');

            // Match on primary, secondary and accent colors
            if ($currentPrimary === $schemePrimary &&
                $currentSecondary === $schemeSecondary &&
                $currentAccent === $schemeAccent) {
                return $key;
            }
        }

        return 'custom';
    }

    /**
     * Theme tab - colors and typography settings.
     */
    public static function themeTab(): Tab
    {
        $colorSchemes = self::getColorSchemes();

        return Tab::make(__('Theme'))
            ->icon('heroicon-o-paint-brush')
            ->schema([
                Section::make(__('Color Scheme'))
                    ->description(__('Choose a preset or customize your own. The active scheme is highlighted with a green border.'))
                    ->schema([
                        ToggleButtons::make('color_scheme')
                            ->label(__('Color Scheme'))
                            ->options(
                                collect($colorSchemes)->mapWithKeys(fn ($scheme, $key) => [
                                    $key => self::getSchemeLabel($key),
                                ])->toArray()
                            )
                            ->default('custom')
                            ->inline()
                            ->live()
                            ->afterStateHydrated(function (ToggleButtons $component, $state, $record) {
                                // First check if color_scheme is explicitly saved in theme_config
                                if ($record && method_exists($record, 'getAttribute')) {
                                    $themeConfig = $record->getAttribute('theme_config');

                                    // Use saved color_scheme if available, otherwise detect from colors
                                    if (! empty($themeConfig['color_scheme'])) {
                                        $component->state($themeConfig['color_scheme']);
                                    } else {
                                        $detectedScheme = self::detectActiveScheme($themeConfig);
                                        $component->state($detectedScheme);
                                    }
                                }
                            })
                            ->afterStateUpdated(function (Set $set, ?string $state) use ($colorSchemes) {
                                // Save the selected color_scheme slug
                                $set('theme_config.color_scheme', $state);

                                // Apply colors from the selected scheme
                                if ($state && $state !== 'custom' && isset($colorSchemes[$state]['colors'])) {
                                    $colors = $colorSchemes[$state]['colors'];
                                    foreach ($colors as $key => $value) {
                                        $set("theme_config.{$key}", $value);
                                    }
                                }
                            })
                            ->colors([
                                'custom' => 'gray',
                                'luxury' => 'warning',
                                'vintage' => 'warning',
                                'modern' => 'info',
                                'trendy' => 'info',
                                'natural' => 'success',
                                'rose' => 'danger',
                                'beauty' => 'warning',
                                'peach' => 'danger',
                                'minimal' => 'gray',
                                'ocean' => 'info',
                                'forest' => 'success',
                                'dark' => 'gray',
                            ])
                            ->columnSpanFull(),
                    ]),
                Section::make(__('Colors'))
                    ->schema([
                        ColorPicker::make('theme_config.primary_color')
                            ->label(__('Primary Color')),
                        ColorPicker::make('theme_config.secondary_color')
                            ->label(__('Secondary Color')),
                        ColorPicker::make('theme_config.accent_color')
                            ->label(__('Accent Color')),
                        ColorPicker::make('theme_config.background_color')
                            ->label(__('Background Color')),
                        ColorPicker::make('theme_config.text_color')
                            ->label(__('Text Color')),
                        ColorPicker::make('theme_config.heading_color')
                            ->label(__('Heading Color')),
                    ])->columns(4),
                Section::make(__('Navbar'))
                    ->schema([
                        Select::make('theme_config.navbar_variant')
                            ->label(__('Navigation Style'))
                            ->options([
                                'default' => __('Default'),
                                'centered' => __('Centered'),
                            ])
                            ->default('default'),
                        ColorPicker::make('theme_config.navbar_background')
                            ->label(__('Background'))
                            ->afterStateHydrated(function (ColorPicker $component, ?string $state, Get $get) {
                                if (empty($state)) {
                                    $secondaryColor = $get('theme_config.secondary_color');
                                    if ($secondaryColor) {
                                        $component->state($secondaryColor);
                                    }
                                }
                            }),
                        ColorPicker::make('theme_config.navbar_text_color')
                            ->label(__('Text Color')),
                        ColorPicker::make('theme_config.navbar_underline_color')
                            ->label(__('Underline Color'))
                            ->afterStateHydrated(function (ColorPicker $component, ?string $state, Get $get) {
                                if (empty($state)) {
                                    $primaryColor = $get('theme_config.primary_color');
                                    if ($primaryColor) {
                                        $component->state($primaryColor);
                                    }
                                }
                            }),
                        Toggle::make('theme_config.navbar_sticky')
                            ->label(__('Sticky'))
                            ->default(true),
                        Toggle::make('theme_config.navbar_transparent')
                            ->label(__('Transparent'))
                            ->default(false),
                    ])->columns(4),
                Section::make(__('Typography'))
                    ->schema([
                        Select::make('theme_config.heading_font_family')
                            ->label(__('Heading Font Family'))
                            ->options(self::getGoogleFonts())
                            ->default('Poppins')
                            ->afterStateHydrated(function (Select $component, ?string $state) {
                                $normalized = self::normalizeFontFamily($state);
                                $component->state($normalized ?? 'Poppins');
                            })
                            ->searchable()
                            ->live(),
                        Select::make('theme_config.font_family')
                            ->label(__('Font Family'))
                            ->options(self::getGoogleFonts())
                            ->default('Inter')
                            ->afterStateHydrated(function (Select $component, ?string $state) {
                                $normalized = self::normalizeFontFamily($state);
                                $component->state($normalized ?? 'Inter');
                            })
                            ->searchable()
                            ->live(),
                        Select::make('theme_config.font_size_base')
                            ->label(__('Base Font Size'))
                            ->options([
                                '14px' => '14px (Small)',
                                '15px' => '15px',
                                '16px' => '16px (Default)',
                                '17px' => '17px',
                                '18px' => '18px (Large)',
                            ])
                            ->default('16px')
                            ->live(),
                        ViewField::make('font_preview')
                            ->view('filament.common.forms.font-preview')
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }

    /**
     * Navigation tab - menu items repeater.
     */
    public static function navigationTab(): Tab
    {
        return Tab::make(__('Navigation'))
            ->icon('heroicon-o-bars-3')
            ->schema([
                Section::make(__('Navigation Items'))
                    ->schema([
                        Repeater::make('navigation_items')
                            ->label(__('Menu Items'))
                            ->schema([
                                TextInput::make('label')
                                    ->label(__('Label'))
                                    ->required(),
                                TextInput::make('target')
                                    ->label(__('Target'))
                                    ->helperText(__('Section ID (e.g., #about) or URL'))
                                    ->required(),
                                Toggle::make('is_active')
                                    ->label(__('Active'))
                                    ->default(true),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->reorderable()
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /**
     * Default Config tab - key-value pairs.
     */
    public static function defaultConfigTab(): Tab
    {
        return Tab::make(__('Default Config'))
            ->icon('heroicon-o-cog-6-tooth')
            ->schema([
                Section::make(__('Default Configuration'))
                    ->description(__('Default configuration values that will be applied when this template is used.'))
                    ->schema([
                        Repeater::make('default_config')
                            ->label(__('Configuration'))
                            ->schema([
                                TextInput::make('key')
                                    ->label(__('Key'))
                                    ->required(),
                                TextInput::make('value')
                                    ->label(__('Value'))
                                    ->required(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->reorderable()
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /**
     * Get all tabs for admin panel (includes category and preview image).
     */
    public static function adminTabs(): array
    {
        return [
            self::generalTab(includeCategory: true, isAdmin: true),
            self::navigationTab(),
            self::themeTab(),
            self::mediaTab(),
            self::defaultConfigTab(),
        ];
    }

    /**
     * Get all tabs for user dashboard (excludes category, preview image, and default config).
     */
    public static function dashboardTabs(): array
    {
        return [
            self::generalTab(includeCategory: false, isAdmin: false),
            self::navigationTab(),
            self::themeTab(),
            self::mediaTab(),
        ];
    }
}
