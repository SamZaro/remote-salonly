<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TemplateSection extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'template_id',
        'section_type',
        'order',
        'content',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('background')
            ->singleFile();

        $this->addMediaCollection('images');

        $this->addMediaCollection('slider_images')
            ->onlyKeepLatest(6);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(400)
            ->format('webp')
            ->quality(85)
            ->nonQueued()
            ->performOnCollections('images');

        // Slider images - optimized for full-width hero-style sliders
        $this->addMediaConversion('slider')
            ->width(1920)
            ->height(1080)
            ->format('webp')
            ->quality(85)
            ->nonQueued()
            ->performOnCollections('slider_images');

        $this->addMediaConversion('slider_thumb')
            ->width(400)
            ->height(225)
            ->format('webp')
            ->quality(80)
            ->nonQueued()
            ->performOnCollections('slider_images');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order');
    }

    public function scopeOfType(Builder $query, string $sectionType): Builder
    {
        return $query->where('section_type', $sectionType);
    }
}
