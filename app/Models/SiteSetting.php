<?php

namespace App\Models;

use App\Support\Media;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'profile_card_links' => 'array',
        ];
    }

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'site_name' => config('app.name'),
            'media_inquiry_label' => 'Media Inquiry',
            'image_fallback_text' => 'Image is not available.',
        ]);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return Media::url($this->logo_path);
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return Media::url($this->favicon_path);
    }
}
