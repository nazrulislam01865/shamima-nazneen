<?php

namespace App\Support;

use App\Models\MediaItem;
use Illuminate\Database\Eloquent\Collection;

final class MediaLibrary
{
    /**
     * @return Collection<int, MediaItem>
     */
    public static function items(string $type = 'image'): Collection
    {
        $type = $type === 'video' ? 'video' : 'image';

        return MediaItem::query()
            ->where('type', $type)
            ->orderBy('title')
            ->orderByDesc('year')
            ->get();
    }

    /**
     * @return Collection<int, MediaItem>
     */
    public static function images(): Collection
    {
        return self::items('image');
    }

    /**
     * @return Collection<int, MediaItem>
     */
    public static function videos(): Collection
    {
        return self::items('video');
    }

    public static function imagePath(?int $mediaItemId): ?string
    {
        if (! $mediaItemId) {
            return null;
        }

        return MediaItem::query()
            ->whereKey($mediaItemId)
            ->where('type', 'image')
            ->value('image_path');
    }

    public static function videoUrl(?int $mediaItemId): ?string
    {
        if (! $mediaItemId) {
            return null;
        }

        return MediaItem::query()
            ->whereKey($mediaItemId)
            ->where('type', 'video')
            ->value('youtube_url');
    }

    public static function imageIdForPath(?string $path): ?int
    {
        if (blank($path)) {
            return null;
        }

        return MediaItem::query()
            ->where('type', 'image')
            ->where('image_path', $path)
            ->value('id');
    }

    public static function videoIdForUrl(?string $url): ?int
    {
        $watchUrl = YouTube::watchUrl($url);

        if (! $watchUrl) {
            return null;
        }

        return MediaItem::query()
            ->where('type', 'video')
            ->where('youtube_url', $watchUrl)
            ->value('id');
    }

    public static function fallbackTextForPath(?string $path, ?string $default = null): string
    {
        $default = trim((string) $default) ?: 'Image is not available.';

        if (blank($path)) {
            return $default;
        }

        static $fallbacks = [];

        if (! array_key_exists($path, $fallbacks)) {
            $fallbacks[$path] = MediaItem::query()
                ->where('type', 'image')
                ->where('image_path', $path)
                ->value('fallback_text');
        }

        return trim((string) $fallbacks[$path]) ?: $default;
    }

    public static function altTextForPath(?string $path, ?string $default = null): string
    {
        $default = trim((string) $default) ?: 'Image';

        if (blank($path)) {
            return $default;
        }

        static $alts = [];

        if (! array_key_exists($path, $alts)) {
            $alts[$path] = MediaItem::query()
                ->where('type', 'image')
                ->where('image_path', $path)
                ->value('alt_text');
        }

        return trim((string) $alts[$path]) ?: $default;
    }

    public static function registerImage(
        ?string $path,
        string $title,
        string $category,
        ?string $fallbackText = null,
        ?string $altText = null,
    ): ?MediaItem {
        if (blank($path)) {
            return null;
        }

        return MediaItem::query()->firstOrCreate(
            ['type' => 'image', 'image_path' => $path],
            [
                'title' => trim($title) ?: 'Website image',
                'alt_text' => trim((string) $altText) ?: (trim($title) ?: 'Website image'),
                'category' => trim($category) ?: 'Website Media',
                'fallback_text' => trim((string) $fallbackText) ?: null,
                'show_in_gallery' => false,
                'show_on_home' => false,
                'show_in_profiles' => false,
                'show_in_biography' => false,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => ((int) MediaItem::query()->max('sort_order')) + 10,
            ],
        );
    }

    public static function registerVideo(
        ?string $url,
        string $title,
        string $category,
        ?string $description = null,
    ): ?MediaItem {
        $watchUrl = YouTube::watchUrl($url);

        if (! $watchUrl) {
            return null;
        }

        return MediaItem::query()->firstOrCreate(
            ['type' => 'video', 'youtube_url' => $watchUrl],
            [
                'title' => trim($title) ?: 'Website video',
                'category' => trim($category) ?: 'Website Media',
                'description' => $description,
                'show_in_gallery' => false,
                'show_on_home' => false,
                'show_in_profiles' => false,
                'show_in_biography' => false,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => ((int) MediaItem::query()->max('sort_order')) + 10,
            ],
        );
    }
}
