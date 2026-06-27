<?php

namespace App\Models;

use App\Support\Media;
use App\Support\YouTube;
use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'show_in_gallery' => 'boolean',
            'show_on_home' => 'boolean',
            'show_in_profiles' => 'boolean',
            'show_in_biography' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        return Media::url($this->image_path) ?: YouTube::thumbnailUrl($this->youtube_url);
    }

    public function getEmbedUrlAttribute(): ?string
    {
        return YouTube::embedUrl($this->youtube_url);
    }

    public function getYoutubeWatchUrlAttribute(): ?string
    {
        return YouTube::watchUrl($this->youtube_url);
    }
}
