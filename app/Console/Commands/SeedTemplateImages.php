<?php

namespace App\Console\Commands;

use App\Models\Template;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SeedTemplateImages extends Command
{
    protected $signature = 'app:seed-template-images
                            {template? : Template slug (e.g. "pure"). Omit to seed all templates.}
                            {--dry-run : Show what would be seeded without actually seeding}';

    protected $description = 'Seed template and section images from database/seeders/images/templates/';

    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png'];

    /**
     * Section type → media collection mapping.
     * 'single' = singleFile collection, 'multiple' = multiple files.
     */
    private const SECTION_MEDIA_MAP = [
        'hero' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'about' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'jumbotron' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'parallax' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'cta' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'contact-form' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'contact' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'content' => ['collection' => 'background', 'type' => 'single', 'folder' => null],
        'image_text' => ['collection' => 'image', 'type' => 'single', 'folder' => null],
        'text_image' => ['collection' => 'image', 'type' => 'single', 'folder' => null],
        'slider' => ['collection' => 'slider_images', 'type' => 'multiple', 'folder' => 'slider'],
        'gallery' => ['collection' => 'images', 'type' => 'multiple', 'folder' => 'gallery'],
        'team' => ['collection' => 'images', 'type' => 'multiple', 'folder' => 'team'],
    ];

    /**
     * Template-level media collections (single file each).
     */
    private const TEMPLATE_MEDIA = ['preview', 'logo'];

    public function handle(): int
    {
        $slug = $this->argument('template');
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->components->warn('Dry-run mode — no images will be seeded.');
        }

        $query = Template::with('sections');
        if ($slug) {
            $query->where('slug', $slug);
        }

        $templates = $query->get();

        if ($templates->isEmpty()) {
            $this->components->error($slug
                ? "Template '{$slug}' not found."
                : 'No templates found. Run TemplateSeeder first.');

            return self::FAILURE;
        }

        foreach ($templates as $template) {
            $this->seedTemplate($template, $dryRun);
        }

        $this->newLine();
        $this->components->info('Done!');

        return self::SUCCESS;
    }

    private function seedTemplate(Template $template, bool $dryRun): void
    {
        $basePath = database_path("seeders/images/templates/{$template->slug}");

        $this->newLine();
        $this->components->info("Template: {$template->name} ({$template->slug})");

        if (! File::isDirectory($basePath)) {
            $this->components->warn("  No image folder found at: {$basePath}");

            return;
        }

        // Template-level media (preview, logo)
        foreach (self::TEMPLATE_MEDIA as $collection) {
            $file = $this->findImage($basePath, $collection);

            if ($file) {
                if ($dryRun) {
                    $this->components->twoColumnDetail("  Template → {$collection}", basename($file));
                } else {
                    $template->clearMediaCollection($collection);
                    $template->addMedia($file)
                        ->preservingOriginal()
                        ->toMediaCollection($collection);
                    $this->components->twoColumnDetail("  Template → {$collection}", '<fg=green>'.basename($file).'</>');
                }
            } else {
                $this->components->twoColumnDetail("  Template → {$collection}", '<fg=yellow>MISSING</>');
            }
        }

        // Section-level media
        $sections = $template->sections()->get();
        $sectionsWithMedia = collect(self::SECTION_MEDIA_MAP)->keys();

        foreach ($sectionsWithMedia as $sectionType) {
            $section = $sections->firstWhere('section_type', $sectionType);
            $map = self::SECTION_MEDIA_MAP[$sectionType];

            if (! $section) {
                continue;
            }

            if ($map['type'] === 'single') {
                $file = $this->findImage($basePath, $sectionType.'-'.$map['collection']);

                if ($file) {
                    if ($dryRun) {
                        $this->components->twoColumnDetail("  {$sectionType} → {$map['collection']}", basename($file));
                    } else {
                        $section->clearMediaCollection($map['collection']);
                        $section->addMedia($file)
                            ->preservingOriginal()
                            ->toMediaCollection($map['collection']);
                        $this->components->twoColumnDetail("  {$sectionType} → {$map['collection']}", '<fg=green>'.basename($file).'</>');
                    }
                } else {
                    $this->components->twoColumnDetail("  {$sectionType} → {$map['collection']}", '<fg=yellow>MISSING</>');
                }
            } else {
                $folder = $basePath.'/'.$map['folder'];
                $files = $this->findImages($folder);

                if ($files->isNotEmpty()) {
                    if ($dryRun) {
                        $this->components->twoColumnDetail("  {$sectionType} → {$map['collection']}", $files->count().' file(s)');
                    } else {
                        $section->clearMediaCollection($map['collection']);
                        foreach ($files as $file) {
                            $section->addMedia($file)
                                ->preservingOriginal()
                                ->toMediaCollection($map['collection']);
                        }
                        $this->components->twoColumnDetail("  {$sectionType} → {$map['collection']}", '<fg=green>'.$files->count().' file(s)</>');
                    }
                } else {
                    $this->components->twoColumnDetail("  {$sectionType} → {$map['collection']}", '<fg=yellow>MISSING (empty folder: '.$map['folder'].'/) </>');
                }
            }
        }
    }

    /**
     * Find a single image by name with extension priority: jpg > jpeg > png.
     */
    private function findImage(string $directory, string $name): ?string
    {
        foreach (self::ALLOWED_EXTENSIONS as $ext) {
            $path = $directory.'/'.$name.'.'.$ext;
            if (File::exists($path)) {
                return $path;
            }
        }

        return null;
    }

    /**
     * Find all images in a directory, sorted by name.
     * Extension priority per basename: jpg > jpeg > png (no duplicates).
     *
     * @return \Illuminate\Support\Collection<int, string>
     */
    private function findImages(string $directory): \Illuminate\Support\Collection
    {
        if (! File::isDirectory($directory)) {
            return collect();
        }

        $files = collect(File::files($directory))
            ->filter(fn ($file) => in_array(strtolower($file->getExtension()), self::ALLOWED_EXTENSIONS))
            ->sortBy(fn ($file) => $file->getFilename());

        // Deduplicate by basename (extension priority)
        $seen = [];
        $result = collect();

        foreach ($files as $file) {
            $basename = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            if (! isset($seen[$basename])) {
                $seen[$basename] = true;
                $result->push($file->getPathname());
            }
        }

        return $result;
    }
}
