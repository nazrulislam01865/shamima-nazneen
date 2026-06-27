<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\BiographySectionRequest;
use App\Models\BiographySection;
use App\Support\RichTextSanitizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class BiographySectionController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function index(): View
    {
        $biographySections = BiographySection::query()->orderBy('sort_order')->get();

        return view('admin.biography-sections.index', compact('biographySections'));
    }

    public function create(): View
    {
        return view('admin.biography-sections.create');
    }

    public function store(BiographySectionRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['content'] = RichTextSanitizer::clean($data['content']);
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'biography', null,
            $data['title'], 'Biography'
        );
        $data['sort_order'] = ((int) BiographySection::query()->max('sort_order')) + 10;
        BiographySection::query()->create($data);

        return redirect()->route('admin.biography-sections.index')->with('success', 'Biography section created successfully.');
    }

    public function edit(BiographySection $biographySection): View
    {
        return view('admin.biography-sections.edit', compact('biographySection'));
    }

    public function update(BiographySectionRequest $request, BiographySection $biographySection): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $biographySection->id);
        $data['content'] = RichTextSanitizer::clean($data['content']);
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'biography', $biographySection->image_path,
            $data['title'], 'Biography'
        );
        $biographySection->update($data);

        return redirect()->route('admin.biography-sections.index')->with('success', 'Biography section updated successfully.');
    }

    public function destroy(BiographySection $biographySection): RedirectResponse
    {
        $this->deleteStoredFile($biographySection->image_path);
        $biographySection->delete();

        return back()->with('success', 'Biography section deleted successfully.');
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'section';
        $slug = $base;
        $counter = 2;

        while (BiographySection::query()->where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
