<?php

namespace App\Models;

use App\Support\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Work extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'external_links' => 'array',
            'is_featured' => 'boolean',
            'show_on_home' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(WorkCategory::class, 'category_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute(): ?string
    {
        return Media::url($this->image_path);
    }
    /**
     * @return array<int, array{label: string, url: string}>
     */
    public function getResolvedExternalLinksAttribute(): array
    {
        $links = collect($this->external_links ?? [])
            ->map(fn ($link): array => [
                'label' => trim((string) ($link['label'] ?? '')),
                'url' => trim((string) ($link['url'] ?? '')),
            ])
            ->filter(fn (array $link): bool => $link['label'] !== '' && $link['url'] !== '')
            ->values()
            ->all();

        if ($links !== []) {
            return $links;
        }

        return $this->link_name && $this->link_url
            ? [['label' => $this->link_name, 'url' => $this->link_url]]
            : [];
    }

}
