<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkCategoryRequest;
use App\Models\WorkCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class WorkCategoryController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function index(): View
    {
        $workCategories = WorkCategory::query()->withCount('works')->orderBy('sort_order')->get();

        return view('admin.work-categories.index', compact('workCategories'));
    }

    public function create(): View
    {
        return view('admin.work-categories.create');
    }

    public function store(WorkCategoryRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['home_image', 'remove_home_image', 'library_media_id']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['name']);
        $data['home_links'] = null;
        $data['link_label'] = null;
        $data['forward_url'] = null;
        $data['home_image_path'] = $this->resolveLibraryImage(
            $request,
            'home_image',
            'remove_home_image',
            'library_media_id',
            'work-categories',
            null,
            ($data['home_title'] ?? null) ?: $data['name'],
            'Selected Works Cards'
        );
        $data['sort_order'] = ((int) WorkCategory::query()->max('sort_order')) + 10;

        WorkCategory::query()->create($data);

        return redirect()->route('admin.work-categories.index')->with('success', 'Work category created successfully.');
    }

    public function edit(WorkCategory $workCategory): View
    {
        return view('admin.work-categories.edit', compact('workCategory'));
    }

    public function update(WorkCategoryRequest $request, WorkCategory $workCategory): RedirectResponse
    {
        $data = $request->safe()->except(['home_image', 'remove_home_image', 'library_media_id']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $workCategory->slug ?? $data['name'], $workCategory->id);
        $data['home_links'] = null;
        $data['link_label'] = null;
        $data['forward_url'] = null;
        $data['home_image_path'] = $this->resolveLibraryImage(
            $request,
            'home_image',
            'remove_home_image',
            'library_media_id',
            'work-categories',
            $workCategory->home_image_path,
            ($data['home_title'] ?? null) ?: $data['name'],
            'Selected Works Cards'
        );

        $workCategory->update($data);

        return redirect()->route('admin.work-categories.index')->with('success', 'Work category updated successfully.');
    }

    public function destroy(WorkCategory $workCategory): RedirectResponse
    {
        if ($workCategory->works()->exists()) {
            return back()->with('error', 'This category has works. Move or delete those works first.');
        }

        $this->deleteStoredFile($workCategory->home_image_path);
        $workCategory->delete();

        return back()->with('success', 'Work category deleted successfully.');
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'category';
        $slug = $base;
        $counter = 2;

        while (WorkCategory::query()->where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
