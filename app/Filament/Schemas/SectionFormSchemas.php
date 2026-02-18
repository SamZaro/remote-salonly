<?php

namespace App\Filament\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

/**
 * Dynamic form schemas for different section types.
 * Each section type has its own content and media schema.
 */
class SectionFormSchemas
{
    /**
     * Get the content schema for a section type.
     *
     * @param  string  $sectionType  The type of section
     * @param  string|null  $categorySlug  Optional category slug for dynamic icon sets
     */
    public static function getContentSchema(string $sectionType, ?string $categorySlug = null): array
    {
        return match ($sectionType) {
            'hero' => self::heroContentSchema(),
            'slider' => self::sliderContentSchema(),
            'about' => self::aboutContentSchema($categorySlug),
            'services' => self::servicesContentSchema($categorySlug),
            'pricing' => self::pricingContentSchema(),
            'contact' => self::contactContentSchema(),
            'testimonials' => self::testimonialsContentSchema(),
            'team' => self::teamContentSchema(),
            'gallery' => self::galleryContentSchema(),
            'parallax' => self::parallaxContentSchema(),
            'faq', 'accordion' => self::faqContentSchema(),
            'cta' => self::ctaContentSchema(),
            'jumbotron' => self::jumbotronContentSchema(),
            'stats' => self::statsContentSchema(),
            'newsletter' => self::newsletterContentSchema(),
            'features' => self::featuresContentSchema($categorySlug),
            'portfolio', 'blog' => self::portfolioContentSchema(),
            'footer' => self::footerContentSchema(),
            'content' => self::contentSectionSchema(),
            'image_text' => self::imageTextContentSchema(),
            'text_image' => self::textImageContentSchema(),
            default => self::defaultContentSchema(),
        };
    }

    /**
     * Get the media schema for a section type.
     */
    public static function getMediaSchema(string $sectionType): array
    {
        return match ($sectionType) {
            'hero', 'cta', 'jumbotron', 'parallax' => self::singleBackgroundMediaSchema(),
            'slider' => self::sliderMediaSchema(),
            'gallery', 'portfolio' => self::multipleImagesMediaSchema(),
            'about', 'contact', 'content' => self::optionalBackgroundMediaSchema(),
            'image_text', 'text_image' => self::imageTextMediaSchema(),
            'team' => self::teamMemberImagesMediaSchema(),
            'services', 'pricing', 'testimonials', 'faq', 'accordion', 'stats', 'newsletter', 'features', 'blog', 'footer' => [],
            default => self::defaultMediaSchema(),
        };
    }

    /**
     * Check if a section type needs a media section.
     */
    public static function hasMedia(string $sectionType): bool
    {
        return match ($sectionType) {
            'hero', 'slider', 'cta', 'jumbotron', 'parallax', 'gallery', 'portfolio', 'about', 'contact', 'content', 'image_text', 'text_image', 'team', 'custom' => true,
            default => false,
        };
    }

    // =========================================================================
    // CONTENT SCHEMAS
    // =========================================================================

    protected static function heroContentSchema(): array
    {
        return [
            Section::make(__('Hero Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Welcome to our site')
                        ->helperText(__('Main headline. Use <br> for line breaks.')),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle'))
                        ->placeholder('Your tagline here'),
                    TextInput::make('content.cta_text')
                        ->label(__('Button Text'))
                        ->placeholder('Get Started'),
                    TextInput::make('content.cta_link')
                        ->label(__('Button Link'))
                        ->placeholder('#contact')
                        ->helperText(__('Section ID (e.g., #contact) or full URL')),
                    Select::make('content.background_position')
                        ->label(__('Background Focus'))
                        ->options([
                            'top' => __('Top'),
                            'center' => __('Center'),
                            'bottom' => __('Bottom'),
                        ])
                        ->default('center')
                        ->helperText(__('Which part of the image should stay visible.')),
                ])->columns(2),
        ];
    }

    protected static function sliderContentSchema(): array
    {
        return [
            Section::make(__('Slider Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Welcome to our site')
                        ->helperText(__('Main headline displayed on all slides. Use <br> for line breaks.')),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle'))
                        ->placeholder('Your tagline here'),
                    TextInput::make('content.cta_text')
                        ->label(__('Button Text'))
                        ->placeholder('Get Started'),
                    TextInput::make('content.cta_link')
                        ->label(__('Button Link'))
                        ->placeholder('#contact')
                        ->helperText(__('Section ID (e.g., #contact) or full URL')),
                    TextInput::make('content.interval')
                        ->label(__('Interval (ms)'))
                        ->placeholder('5000')
                        ->numeric()
                        ->default(5000)
                        ->helperText(__('Time between slides in milliseconds.')),
                    Select::make('content.overlay_opacity')
                        ->label(__('Overlay Darkness'))
                        ->options([
                            '0' => __('None (0%)'),
                            '0.3' => __('Light (30%)'),
                            '0.5' => __('Medium (50%)'),
                            '0.7' => __('Dark (70%)'),
                            '0.85' => __('Very Dark (85%)'),
                        ])
                        ->default('0.5')
                        ->helperText(__('Darkness of the overlay on images.')),
                    Toggle::make('content.autoplay')
                        ->label(__('Autoplay'))
                        ->default(true)
                        ->helperText(__('Automatically advance slides.'))
                        ->inline(false),
                    Toggle::make('content.show_indicators')
                        ->label(__('Show Indicators'))
                        ->default(true)
                        ->helperText(__('Show navigation dots below the slider.'))
                        ->inline(false),
                    Toggle::make('content.show_arrows')
                        ->label(__('Show Arrows'))
                        ->default(true)
                        ->helperText(__('Show navigation arrows on sides.'))
                        ->inline(false),
                ])->columns(2),
        ];
    }

    protected static function aboutContentSchema(?string $categorySlug = null): array
    {
        return [
            Section::make(__('About Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('About Us'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle'))
                        ->placeholder('Our Story'),
                    Textarea::make('content.description')
                        ->label(__('Description'))
                        ->rows(4)
                        ->columnSpanFull(),
                    Repeater::make('content.items')
                        ->label(__('Features'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('Title'))
                                ->required(),
                            TextInput::make('description')
                                ->label(__('Description')),
                            Select::make('icon')
                                ->label(__('Icon'))
                                ->options(IconSets::getServiceIcons($categorySlug))
                                ->allowHtml()
                                ->default(IconSets::getDefaultIcon($categorySlug))
                                ->searchable(),
                        ])
                        ->columns(3)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function servicesContentSchema(?string $categorySlug = null): array
    {
        return [
            Section::make(__('Services Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Our Services'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.items')
                        ->label(__('Services'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('Service Name'))
                                ->required(),
                            TextInput::make('description')
                                ->label(__('Description')),
                            TextInput::make('price')
                                ->label(__('Price'))
                                ->placeholder('25')
                                ->prefixIcon('heroicon-o-currency-euro'),
                            Select::make('icon')
                                ->label(__('Icon'))
                                ->options(IconSets::getServiceIcons($categorySlug))
                                ->allowHtml()
                                ->default(IconSets::getDefaultIcon($categorySlug))
                                ->required()
                                ->searchable(),
                        ])
                        ->columns(4)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function pricingContentSchema(): array
    {
        return [
            Section::make(__('Pricing Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Pricing'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.categories')
                        ->label(__('Categories'))
                        ->schema([
                            TextInput::make('name')
                                ->label(__('Category Name'))
                                ->placeholder('Dames')
                                ->required(),
                            Repeater::make('items')
                                ->label(__('Price Items'))
                                ->schema([
                                    TextInput::make('service')
                                        ->label(__('Service'))
                                        ->required(),
                                    TextInput::make('description')
                                        ->label(__('Description')),
                                    TextInput::make('price')
                                        ->label(__('Price'))
                                        ->required()
                                        ->placeholder('25')
                                        ->prefixIcon('heroicon-o-currency-euro'),
                                ])
                                ->columns(3)
                                ->collapsible()
                                ->collapsed()
                                ->itemLabel(fn (array $state): ?string => ($state['service'] ?? '').' - '.($state['price'] ?? ''))
                                ->defaultItems(1),
                        ])
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? __('New Category'))
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function contactContentSchema(): array
    {
        return [
            Section::make(__('Contact Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Contact Us'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Textarea::make('content.address')
                        ->label(__('Address'))
                        ->rows(2),
                    TextInput::make('content.phone')
                        ->label(__('Phone'))
                        ->tel(),
                    TextInput::make('content.email')
                        ->label(__('Email'))
                        ->email(),
                    Repeater::make('content.opening_hours')
                        ->label(__('Opening Hours'))
                        ->schema([
                            TextInput::make('day')
                                ->label(__('Day'))
                                ->placeholder('Monday - Friday'),
                            TextInput::make('hours')
                                ->label(__('Hours'))
                                ->placeholder('9:00 - 18:00'),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => ($state['day'] ?? '').': '.($state['hours'] ?? ''))
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function testimonialsContentSchema(): array
    {
        return [
            Section::make(__('Testimonials Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('What Our Clients Say'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.items')
                        ->label(__('Testimonials'))
                        ->schema([
                            Textarea::make('quote')
                                ->label(__('Quote'))
                                ->required()
                                ->rows(3)
                                ->columnSpanFull(),
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->required(),
                            TextInput::make('role')
                                ->label(__('Role/Company')),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function teamContentSchema(): array
    {
        return [
            Section::make(__('Team Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Our Team'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.members')
                        ->label(__('Team Members'))
                        ->schema([
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->required(),
                            TextInput::make('role')
                                ->label(__('Role')),
                            Textarea::make('bio')
                                ->label(__('Bio'))
                                ->rows(2),
                        ])
                        ->columns(3)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                        ->defaultItems(0)
                        ->columnSpanFull()
                        ->helperText(__('Upload member photos in the Media section below. Photos are matched to members by order (first photo → first member, etc.).')),
                ])->columns(2),
        ];
    }

    protected static function galleryContentSchema(): array
    {
        return [
            Section::make(__('Gallery Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Our Gallery'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                ])->columns(2),
        ];
    }

    protected static function parallaxContentSchema(): array
    {
        return [
            Section::make(__('Parallax Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('A Bold Statement')
                        ->helperText(__('Main headline. Use <br> for line breaks.')),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle'))
                        ->placeholder('Supporting text for the parallax section'),
                ])->columns(2),
        ];
    }

    protected static function faqContentSchema(): array
    {
        return [
            Section::make(__('FAQ Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Frequently Asked Questions'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.items')
                        ->label(__('Questions'))
                        ->schema([
                            TextInput::make('question')
                                ->label(__('Question'))
                                ->required()
                                ->columnSpanFull(),
                            Textarea::make('answer')
                                ->label(__('Answer'))
                                ->required()
                                ->rows(3)
                                ->columnSpanFull(),
                        ])
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function ctaContentSchema(): array
    {
        return [
            Section::make(__('Call to Action Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Ready to Get Started?'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Textarea::make('content.description')
                        ->label(__('Description'))
                        ->rows(2)
                        ->columnSpanFull(),
                    TextInput::make('content.cta_text')
                        ->label(__('Button Text'))
                        ->placeholder('Contact Us'),
                    TextInput::make('content.cta_link')
                        ->label(__('Button Link'))
                        ->placeholder('#contact'),
                    TextInput::make('content.secondary_cta_text')
                        ->label(__('Secondary Button Text'))
                        ->placeholder('Call Now'),
                    TextInput::make('content.secondary_cta_link')
                        ->label(__('Secondary Button Link'))
                        ->placeholder('tel:+31612345678'),
                ])->columns(2),
        ];
    }

    protected static function jumbotronContentSchema(): array
    {
        return [
            Section::make(__('Jumbotron Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('A Bold Statement'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    TextInput::make('content.cta_text')
                        ->label(__('Button Text'))
                        ->placeholder('Learn More'),
                    TextInput::make('content.cta_link')
                        ->label(__('Button Link'))
                        ->placeholder('#contact'),
                ])->columns(2),
        ];
    }

    protected static function footerContentSchema(): array
    {
        return [
            Section::make(__('Footer Content'))
                ->schema([
                    TextInput::make('content.company_name')
                        ->label(__('Company Name'))
                        ->placeholder('Your Company'),
                    Textarea::make('content.description')
                        ->label(__('Description'))
                        ->rows(2)
                        ->columnSpanFull(),
                    TextInput::make('content.address')
                        ->label(__('Address')),
                    TextInput::make('content.phone')
                        ->label(__('Phone'))
                        ->tel(),
                    TextInput::make('content.email')
                        ->label(__('Email'))
                        ->email(),
                    KeyValue::make('content.social_links')
                        ->label(__('Social Links'))
                        ->keyLabel(__('Platform'))
                        ->valueLabel(__('URL'))
                        ->reorderable()
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function contentSectionSchema(): array
    {
        return [
            Section::make(__('Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder(__('Section Title'))
                        ->helperText(__('Optional title displayed above the content.')),
                    RichEditor::make('content.body')
                        ->label(__('Content'))
                        ->toolbarButtons([
                            // Text formatting
                            ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript'],
                            // Headings
                            ['h1', 'h2', 'h3', 'lead', 'small'],
                            // Alignment
                            ['alignStart', 'alignCenter', 'alignEnd', 'alignJustify'],
                            // Lists & structure
                            ['blockquote', 'bulletList', 'orderedList', 'details'],
                            // Code & styling
                            ['code', 'codeBlock', 'highlight', 'textColor'],
                            // Media & links
                            ['link', 'attachFiles', 'table', 'grid', 'horizontalRule'],
                            // Utilities
                            ['clearFormatting', 'undo', 'redo'],
                        ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('content-attachments')
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function statsContentSchema(): array
    {
        return [
            Section::make(__('Statistics Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Our Numbers'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.items')
                        ->label(__('Statistics'))
                        ->schema([
                            TextInput::make('value')
                                ->label(__('Value'))
                                ->placeholder('500+')
                                ->required(),
                            TextInput::make('label')
                                ->label(__('Label'))
                                ->placeholder('Happy Clients')
                                ->required(),
                        ])
                        ->columns(2)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => ($state['value'] ?? '').' '.($state['label'] ?? ''))
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function newsletterContentSchema(): array
    {
        return [
            Section::make(__('Newsletter Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Subscribe to Our Newsletter'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    TextInput::make('content.button_text')
                        ->label(__('Button Text'))
                        ->placeholder('Subscribe'),
                ])->columns(2),
        ];
    }

    protected static function featuresContentSchema(?string $categorySlug = null): array
    {
        return [
            Section::make(__('Features Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Features'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                    Repeater::make('content.items')
                        ->label(__('Features'))
                        ->schema([
                            TextInput::make('title')
                                ->label(__('Title'))
                                ->required(),
                            Textarea::make('description')
                                ->label(__('Description'))
                                ->rows(2),
                            Select::make('icon')
                                ->label(__('Icon'))
                                ->options(IconSets::getServiceIcons($categorySlug))
                                ->allowHtml()
                                ->default(IconSets::getDefaultIcon($categorySlug))
                                ->searchable(),
                        ])
                        ->columns(3)
                        ->collapsible()
                        ->collapsed()
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->defaultItems(0)
                        ->columnSpanFull(),
                ])->columns(2),
        ];
    }

    protected static function portfolioContentSchema(): array
    {
        return [
            Section::make(__('Portfolio/Blog Content'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder('Our Work'),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle')),
                ])->columns(2),
        ];
    }

    protected static function imageTextContentSchema(): array
    {
        return [
            Section::make(__('Section Header'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder(__('Section Title')),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle'))
                        ->placeholder(__('Section Subtitle')),
                ])->columns(2),
            Section::make(__('Text Content'))
                ->description(__('This text will appear on the right side, next to the image.'))
                ->schema([
                    TextInput::make('content.block_title')
                        ->label(__('Block Title'))
                        ->placeholder(__('Title next to image')),
                    Textarea::make('content.block_text')
                        ->label(__('Block Text'))
                        ->rows(4)
                        ->columnSpanFull(),
                    TextInput::make('content.cta_text')
                        ->label(__('Button Text'))
                        ->placeholder(__('Read More')),
                    TextInput::make('content.cta_link')
                        ->label(__('Button Link'))
                        ->placeholder('#contact'),
                ])->columns(2),
        ];
    }

    protected static function textImageContentSchema(): array
    {
        return [
            Section::make(__('Section Header'))
                ->schema([
                    TextInput::make('content.title')
                        ->label(__('Title'))
                        ->placeholder(__('Section Title')),
                    TextInput::make('content.subtitle')
                        ->label(__('Subtitle'))
                        ->placeholder(__('Section Subtitle')),
                ])->columns(2),
            Section::make(__('Text Content'))
                ->description(__('This text will appear on the left side, next to the image.'))
                ->schema([
                    TextInput::make('content.block_title')
                        ->label(__('Block Title'))
                        ->placeholder(__('Title next to image')),
                    Textarea::make('content.block_text')
                        ->label(__('Block Text'))
                        ->rows(4)
                        ->columnSpanFull(),
                    TextInput::make('content.cta_text')
                        ->label(__('Button Text'))
                        ->placeholder(__('Read More')),
                    TextInput::make('content.cta_link')
                        ->label(__('Button Link'))
                        ->placeholder('#contact'),
                ])->columns(2),
        ];
    }

    protected static function defaultContentSchema(): array
    {
        return [
            Section::make(__('Content'))
                ->description(__('Add custom key-value pairs for this section.'))
                ->schema([
                    KeyValue::make('content')
                        ->label(__('Custom Content'))
                        ->keyLabel(__('Property'))
                        ->valueLabel(__('Value'))
                        ->reorderable()
                        ->columnSpanFull(),
                ]),
        ];
    }

    // =========================================================================
    // MEDIA SCHEMAS
    // =========================================================================

    protected static function singleBackgroundMediaSchema(): array
    {
        return [
            Section::make(__('Media'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('background')
                        ->label(__('Background Image'))
                        ->collection('background')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null, // Free crop
                            '21:9', // Ultra-wide hero
                            '16:9', // Wide hero
                            '3:2',  // Landscape
                        ])
                        ->helperText(__('Tip: Use the image editor to crop your image to 21:9 or 16:9 for best results.'))
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function sliderMediaSchema(): array
    {
        return [
            Section::make(__('Slider Images'))
                ->description(__('Upload up to 6 images for the slider. Drag to reorder.'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('slider_images')
                        ->label(__('Slider Images'))
                        ->collection('slider_images')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null, // Free crop
                            '21:9', // Ultra-wide hero
                            '16:9', // Wide hero
                        ])
                        ->multiple()
                        ->reorderable()
                        ->maxFiles(6)
                        ->minFiles(1)
                        ->conversion('slider_thumb')
                        ->panelLayout('grid')
                        ->columns(2)
                        ->helperText(__('Recommended: 1920x1080px (16:9) or 2560x1080px (21:9). Max 6 images.'))
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function optionalBackgroundMediaSchema(): array
    {
        return [
            Section::make(__('Media'))
                ->description(__('Optional featured image for this section.'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('background')
                        ->label(__('Featured Image'))
                        ->collection('background')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function imageTextMediaSchema(): array
    {
        return [
            Section::make(__('Media'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('image')
                        ->label(__('Section Image'))
                        ->collection('image')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null, // Free crop
                            '4:3',
                            '3:2',
                            '1:1',
                        ])
                        ->helperText(__('The image that will appear next to the text.'))
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function multipleImagesMediaSchema(): array
    {
        return [
            Section::make(__('Media'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('images')
                        ->label(__('Images'))
                        ->collection('images')
                        ->image()
                        ->imageEditor()
                        ->multiple()
                        ->reorderable()
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function teamMemberImagesMediaSchema(): array
    {
        return [
            Section::make(__('Team Member Photos'))
                ->description(__('Upload photos for each team member. The order of photos should match the order of members above.'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('images')
                        ->label(__('Member Photos'))
                        ->collection('images')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null,
                            '1:1',
                            '3:4',
                        ])
                        ->multiple()
                        ->reorderable()
                        ->conversion('thumb')
                        ->panelLayout('grid')
                        ->columns(2)
                        ->helperText(__('Recommended: Square (1:1) or portrait (3:4) photos. Order matches team members above.'))
                        ->columnSpanFull(),
                ]),
        ];
    }

    protected static function defaultMediaSchema(): array
    {
        return [
            Section::make(__('Media'))
                ->schema([
                    SpatieMediaLibraryFileUpload::make('background')
                        ->label(__('Background Image'))
                        ->collection('background')
                        ->image()
                        ->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('images')
                        ->label(__('Images'))
                        ->collection('images')
                        ->image()
                        ->imageEditor()
                        ->multiple()
                        ->reorderable(),
                ])->columns(2),
        ];
    }
}
