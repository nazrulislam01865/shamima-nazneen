<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaFileController extends Controller
{
    public function __invoke(string $path): BinaryFileResponse
    {
        $normalizedPath = str_replace('\\', '/', trim($path));
        $normalizedPath = ltrim($normalizedPath, '/');

        if ($normalizedPath === '' || str_contains($normalizedPath, '..')) {
            abort(404);
        }

        foreach (['storage/', 'public/', 'app/public/'] as $prefix) {
            if (str_starts_with($normalizedPath, $prefix)) {
                $normalizedPath = substr($normalizedPath, strlen($prefix));
            }
        }

        $candidatePaths = [];

        if (Storage::disk('public')->exists($normalizedPath)) {
            $candidatePaths[] = Storage::disk('public')->path($normalizedPath);
        }

        $publicStoragePath = public_path('storage/'.$normalizedPath);
        if (is_file($publicStoragePath)) {
            $candidatePaths[] = $publicStoragePath;
        }

        $publicPath = public_path($normalizedPath);
        if (is_file($publicPath)) {
            $candidatePaths[] = $publicPath;
        }

        $absolutePath = $candidatePaths[0] ?? null;
        if (! $absolutePath || ! is_file($absolutePath)) {
            abort(404);
        }

        return response()->file($absolutePath, [
            'Content-Type' => mime_content_type($absolutePath) ?: 'application/octet-stream',
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }
}
