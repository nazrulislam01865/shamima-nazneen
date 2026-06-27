<?php

namespace App\Support;

use Illuminate\Support\Str;

final class Media
{
    public static function url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        $path = trim((string) $path);

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            return $path;
        }

        if (Str::startsWith($path, ['assets/', 'images/'])) {
            return asset($path);
        }

        if (str_starts_with($path, '/assets/') || str_starts_with($path, '/images/')) {
            return asset(ltrim($path, '/'));
        }

        $normalizedPath = ltrim($path, '/');

        if (str_starts_with($normalizedPath, 'storage/')) {
            $normalizedPath = substr($normalizedPath, 8);
        }

        if (str_starts_with($normalizedPath, 'public/')) {
            $normalizedPath = substr($normalizedPath, 7);
        }

        return route('media.public', ['path' => $normalizedPath]);
    }
}
