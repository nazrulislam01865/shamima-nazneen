<?php

namespace App\Models;

use App\Support\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkCategory extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'home_links' => 'array',
            'show_on_home' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'category_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getHomeImageUrlAttribute(): ?string
    {
        return Media::url($this->home_image_path);
    }

    /**
     * @return array<int, array{label: string, url: string}>
     */
    public function getResolvedHomeLinksAttribute(): array
    {
        $links = collect($this->home_links ?? [])
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

        return [[
            'label' => $this->link_label ?: 'View '.$this->name.' →',
            'url' => $this->forward_url ?: route('works.index', ['category' => $this->slug]),
        ]];
    }
}
