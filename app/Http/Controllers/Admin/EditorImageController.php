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
