<?php

namespace App\Models;

use App\Support\Media;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'open_new_tab' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function getPublicUrlAttribute(): string
    {
        $url = trim((string) $this->url);

        if ($url === '') {
            return url('/');
        }

        if (str_starts_with($url, '#')) {
            return url('/').$url;
        }

        if (str_starts_with($url, '/')) {
            return url($url);
        }

        return $url;
    }

    public function getIconUrlAttribute(): ?string
    {
        return Media::url($this->icon_path);
    }

    public function getIconKeyAttribute(): string
    {
        $label = strtolower((string) $this->label);
        $url = strtolower((string) $this->url);
        $haystack = $label.' '.$url;

        return match (true) {
            str_contains($haystack, 'biography') => 'book',
            str_contains($haystack, 'work') => 'briefcase',
            str_contains($haystack, 'film') => 'clapper',
            str_contains($haystack, 'video') => 'video',
            str_contains($haystack, 'gallery') => 'image',
            str_contains($haystack, 'contact') => 'mail',
            str_contains($haystack, 'about') => 'user',
            default => 'link',
        };
    }
}
