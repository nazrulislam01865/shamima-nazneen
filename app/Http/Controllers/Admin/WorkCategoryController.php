<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkCategoryRequest;
use App\Models\WorkCategory;
use App\Support\MediaLibrary;
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
        $data['home_links'] = $this->normaliseHomeLinks($data['home_links'] ?? []);
        $data['link_label'] = $data['home_links'][0]['label'] ?? null;
        $data['forward_url'] = $data['home_links'][0]['url'] ?? null;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']);
        $data['home_image_path'] = $this->resolveLibraryImage(
            $request, 'home_image', 'remove_home_image', 'library_media_id', 'work-categories', null,
            ($data['home_title'] ?? null) ?: $data['name'], 'Selected Works Cards'
        );
        $data['sort_order'] = ((int) WorkCategory::query()->max('sort_order')) + 10;
        WorkCategory::query()->create($data);
        $this->registerLinkedVideos($data['home_links'], ($data['home_title'] ?? null) ?: $data['name']);

        return redirect()->route('admin.work-categories.index')->with('success', 'Work category created successfully.');
    }

    public function edit(WorkCategory $workCategory): View
    {
        return view('admin.work-categories.edit', compact('workCategory'));
    }

    public function update(WorkCategoryRequest $request, WorkCategory $workCategory): RedirectResponse
    {
        $data = $request->safe()->except(['home_image', 'remove_home_image', 'library_media_id']);
        $data['home_links'] = $this->normaliseHomeLinks($data['home_links'] ?? []);
        $data['link_label'] = $data['home_links'][0]['label'] ?? null;
        $data['forward_url'] = $data['home_links'][0]['url'] ?? null;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $workCategory->id);
        $data['home_image_path'] = $this->resolveLibraryImage(
            $request, 'home_image', 'remove_home_image', 'library_media_id', 'work-categories', $workCategory->home_image_path,
            ($data['home_title'] ?? null) ?: $data['name'], 'Selected Works Cards'
        );
        $workCategory->update($data);
        $this->registerLinkedVideos($data['home_links'], ($data['home_title'] ?? null) ?: $data['name']);

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


    /**
     * @param array<int, array<string, mixed>> $links
     * @return array<int, array{label: string, url: string}>
     */
    private function normaliseHomeLinks(array $links): array
    {
        return collect($links)
            ->map(fn (array $link): array => [
                'label' => trim((string) ($link['label'] ?? '')),
                'url' => trim((string) ($link['url'] ?? '')),
            ])
            ->filter(fn (array $link): bool => $link['label'] !== '' && $link['url'] !== '')
            ->values()
            ->all();
    }

    /**
     * @param array<int, array{label: string, url: string}> $links
     */
    private function registerLinkedVideos(array $links, string $title): void
    {
        foreach ($links as $link) {
            MediaLibrary::registerVideo(
                $link['url'] ?? null,
                ($link['label'] ?? null) ?: $title,
                'Selected Works Cards',
            );
        }
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
