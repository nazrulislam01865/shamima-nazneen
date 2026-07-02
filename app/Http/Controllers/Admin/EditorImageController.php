<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\MediaLibrary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditorImageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ], [
            'image.required' => 'Choose an image before uploading.',
            'image.image' => 'Upload a valid JPG, PNG, or WEBP image.',
            'image.mimes' => 'Upload a JPG, PNG, or WEBP image.',
            'image.max' => 'The image must be 8 MB or smaller.',
        ], [
            'image' => 'image',
        ]);

        $file = $validated['image'];
        $path = $file->store('page-content', 'public');

        MediaLibrary::registerImage(
            $path,
            Str::headline(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) ?: 'Page content image',
            'Custom Page Content',
        );

        return response()->json([
            'url' => Storage::disk('public')->url($path),
        ]);
    }
}
