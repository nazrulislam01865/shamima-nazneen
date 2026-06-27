<?php

namespace App\Support;

final class YouTube
{
    public static function id(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $patterns = [
            '~youtu\.be/([A-Za-z0-9_-]{6,})~',
            '~youtube\.com/watch\?[^#]*v=([A-Za-z0-9_-]{6,})~',
            '~youtube(?:-nocookie)?\.com/(?:embed|shorts|live)/([A-Za-z0-9_-]{6,})~',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches) === 1) {
                return $matches[1];
            }
        }

        return preg_match('~^[A-Za-z0-9_-]{6,}$~', $url) === 1 ? $url : null;
    }

    public static function embedUrl(?string $url): ?string
    {
        $id = self::id($url);

        return $id ? "https://www.youtube-nocookie.com/embed/{$id}" : null;
    }

    public static function watchUrl(?string $url): ?string
    {
        $id = self::id($url);

        return $id ? "https://www.youtube.com/watch?v={$id}" : null;
    }

    public static function thumbnailUrl(?string $url): ?string
    {
        $id = self::id($url);

        return $id ? "https://i.ytimg.com/vi/{$id}/hqdefault.jpg" : null;
    }
}
