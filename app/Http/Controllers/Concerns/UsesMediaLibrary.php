<?php

namespace App\Http\Controllers\Concerns;

use App\Support\MediaLibrary;
use Illuminate\Foundation\Http\FormRequest;

trait UsesMediaLibrary
{
    protected function resolveLibraryImage(
        FormRequest $request,
        string $uploadField,
        string $removeField,
        string $libraryField,
        string $directory,
        ?string $currentPath,
        string $title,
        string $category,
        ?string $fallbackText = null,
    ): ?string {
        if ($request->hasFile($uploadField)) {
            $path = $this->storeUploadedFile($request->file($uploadField), $directory, $currentPath);
            MediaLibrary::registerImage($path, $title, $category, $fallbackText);

            return $path;
        }

        if ($request->filled($libraryField)) {
            return MediaLibrary::imagePath($request->integer($libraryField)) ?: $currentPath;
        }

        if ($request->boolean($removeField)) {
            return $this->removeUploadedFileIfRequested(true, $currentPath);
        }

        return $currentPath;
    }
}
