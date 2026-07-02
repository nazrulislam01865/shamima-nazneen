<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\MediaItemRequest;
use App\Models\MediaItem;
use App\Support\RichTextSanitizer;
use App\Support\YouTube;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MediaItemController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $type = in_array(request('type'), ['image', 'video'], true) ? request('type') : 'image';

        return $this->renderIndex($type);
    }

    public function images(): View
    {
        return $this->renderIndex('image');
    }

    public function videos(): View
    {
        return $this->renderIndex('video');
    }

    private function renderIndex(string $forcedType): View
    {
        $type = $forcedType === 'video' ? 'video' : 'image';
        $query = MediaItem::query()
            ->where('type', $type)
            ->orderBy('sort_order')
            ->orderByDesc('year');

        if (request()->boolean('home')) {
            $query->where('show_on_home', true);
        }

        if (request()->boolean('profiles')) {
            $query->where('show_in_profiles', true);
        }

        if (request()->boolean('gallery')) {
            $query->where('show_in_gallery', true);
        }

        if (request('search')) {
            $search = trim((string) request('search'));
            $query->where(fn ($mediaQuery) => $mediaQuery
                ->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%"));
        }

        $mediaItems = $query->get();

        return view('admin.media-items.index', [
            'mediaItems' => $mediaItems,
            'forcedType' => $type,
        ]);
    }

    public function create(): View
    {
        $defaultType = in_array(request('type'), ['image', 'video'], true) ? request('type') : 'image';
        $defaultShowOnHome = request()->boolean('home');
        $defaultShowInProfiles = request()->boolean('profiles');
        $defaultShowInGallery = ! request()->has('gallery') || request()->boolean('gallery');

        return view('admin.media-items.create', compact(
            'defaultType',
            'defaultShowOnHome',
            'defaultShowInProfiles',
            'defaultShowInGallery',
        ));
    }

    public function store(MediaItemRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image']);
        $data['description'] = RichTextSanitizer::clean($data['description'] ?? null);
        $data['type'] = $data['type'] === 'video' ? 'video' : 'image';
        $data['image_path'] = $data['type'] === 'image'
            ? $this->storeUploadedFile($request->file('image'), 'media')
            : null;

        if ($data['type'] === 'image') {
            $data['youtube_url'] = null;
        } else {
            $data['youtube_url'] = YouTube::watchUrl($data['youtube_url'] ?? null);
            $data['alt_text'] = null;
            $data['fallback_text'] = null;
        }

        $data['sort_order'] = ((int) MediaItem::query()->where('type', $data['type'])->max('sort_order')) + 10;

        MediaItem::query()->create($data);

        return redirect()
            ->route('admin.media-items.index', $this->contextQuery($request, $data['type']))
            ->with('success', ucfirst($data['type']).' gallery item created successfully.');
    }

    public function edit(MediaItem $mediaItem): View
    {
        return view('admin.media-items.edit', compact('mediaItem'));
    }

    public function update(MediaItemRequest $request, MediaItem $mediaItem): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image']);
        $data['description'] = RichTextSanitizer::clean($data['description'] ?? null);
        $data['type'] = $mediaItem->type === 'video' ? 'video' : 'image';

        if ($data['type'] === 'video') {
            $oldPath = $mediaItem->image_path;
            $data['image_path'] = null;
            $data['youtube_url'] = YouTube::watchUrl($request->input('youtube_url'));
            $data['alt_text'] = null;
            $data['fallback_text'] = null;
            $mediaItem->update($data);
            $this->deleteStoredFile($oldPath);
        } else {
            $imagePath = $this->removeUploadedFileIfRequested($request->boolean('remove_image'), $mediaItem->image_path);
            $data['image_path'] = $this->storeUploadedFile($request->file('image'), 'media', $imagePath);
            $data['youtube_url'] = null;
            $mediaItem->update($data);
        }

        return redirect()
            ->route('admin.media-items.index', $this->contextQuery($request, $data['type']))
            ->with('success', ucfirst($data['type']).' gallery item updated successfully.');
    }

    public function destroy(MediaItem $mediaItem): RedirectResponse
    {
        $path = $mediaItem->image_path;
        $mediaItem->delete();
        $this->deleteStoredFile($path);

        return back()->with('success', ucfirst($mediaItem->type).' gallery item deleted successfully.');
    }

    /**
     * @return array<string, int|string>
     */
    private function contextQuery(MediaItemRequest $request, string $type): array
    {
        $query = ['type' => $type === 'video' ? 'video' : 'image'];

        if ($request->boolean('home') || request()->boolean('home')) {
            $query['home'] = 1;
        }

        if ($request->boolean('profiles') || request()->boolean('profiles')) {
            $query['profiles'] = 1;
        }

        if ($request->boolean('gallery') || request()->boolean('gallery')) {
            $query['gallery'] = 1;
        }

        return $query;
    }
}
