<?php

namespace App\Models;

use App\Support\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'show_on_home' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function workCategory(): BelongsTo
    {
        return $this->belongsTo(WorkCategory::class, 'work_category_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        return Media::url($this->image_path);
    }

    public function getPublicUrlAttribute(): ?string
    {
        if ($this->workCategory) {
            return route('works.index', ['category' => $this->workCategory->slug]);
        }

        return $this->link_url;
    }
}
