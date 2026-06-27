<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUploads
{
    protected function storeUploadedFile(?UploadedFile $file, string $directory, ?string $oldPath = null): ?string
    {
        if (! $file) {
            return $oldPath;
        }

        $path = $file->store($directory, 'public');
        $this->deleteStoredFile($oldPath);

        return $path;
    }

    protected function removeUploadedFileIfRequested(bool $remove, ?string $oldPath): ?string
    {
        if (! $remove) {
            return $oldPath;
        }

        $this->deleteStoredFile($oldPath);

        return null;
    }

    protected function deleteStoredFile(?string $path): void
    {
        if (blank($path) || Str::startsWith($path, ['http://', 'https://', '/', 'assets/', 'images/'])) {
            return;
        }

        if ($this->storedPathIsReferenced($path)) {
            return;
        }

        Storage::disk('public')->delete($path);
    }

    private function storedPathIsReferenced(string $path): bool
    {
        $references = [
            ['media_items', 'image_path'],
            ['hero_slides', 'image_path'],
            ['content_sections', 'image_path'],
            ['biography_sections', 'image_path'],
            ['work_categories', 'home_image_path'],
            ['works', 'image_path'],
            ['events', 'image_path'],
            ['site_settings', 'logo_path'],
            ['site_settings', 'favicon_path'],
            ['menu_items', 'icon_path'],
        ];

        foreach ($references as [$table, $column]) {
            if (Schema::hasTable($table)
                && Schema::hasColumn($table, $column)
                && DB::table($table)->where($column, $path)->exists()) {
                return true;
            }
        }

        return false;
    }
}
