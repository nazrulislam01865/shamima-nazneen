<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest;
use App\Models\Work;
use App\Models\WorkCategory;
use App\Support\MediaLibrary;
use App\Support\RichTextSanitizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function index(): View
    {
        $query = Work::query()->with('category')->orderBy('sort_order')->orderByDesc('year');

        if (request()->boolean('home')) {
            $query->where('show_on_home', true);
        }

        if (request('category')) {
            $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', request('category')));
        }

        if (request('search')) {
            $search = trim((string) request('search'));
            $query->where(fn ($workQuery) => $workQuery
                ->where('title', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('platform', 'like', "%{$search}%"));
        }

        $works = $query->get();
        $categories = WorkCategory::query()->orderBy('sort_order')->get();

        return view('admin.works.index', compact('works', 'categories'));
    }

    public function create(): View
    {
        $categories = WorkCategory::query()->where('is_active', true)->orderBy('sort_order')->get();
        $defaultShowOnHome = request()->boolean('home');

        return view('admin.works.create', compact('categories', 'defaultShowOnHome'));
    }

    public function store(WorkRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id']);
        $data['external_links'] = $this->normaliseLinks($data['external_links'] ?? []);
        $data['link_name'] = $data['external_links'][0]['label'] ?? null;
        $data['link_url'] = $data['external_links'][0]['url'] ?? null;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);
        $data['short_description'] = RichTextSanitizer::clean($data['short_description']);
        $categoryName = WorkCategory::query()->whereKey($data['category_id'])->value('name') ?: 'Works';
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'works', null,
            $data['title'], $categoryName
        );
        $data['sort_order'] = ((int) Work::query()->max('sort_order')) + 10;
        Work::query()->create($data);
        $this->registerLinkedVideos($data['external_links'], $data['title'], $categoryName, $data['short_description']);

        return redirect()
            ->route('admin.works.index', $request->boolean('home') ? ['home' => 1] : [])
            ->with('success', 'Work created successfully.');
    }

    public function edit(Work $work): View
    {
        $categories = WorkCategory::query()->orderBy('sort_order')->get();

        return view('admin.works.edit', compact('work', 'categories'));
    }

    public function update(WorkRequest $request, Work $work): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id']);
        $data['external_links'] = $this->normaliseLinks($data['external_links'] ?? []);
        $data['link_name'] = $data['external_links'][0]['label'] ?? null;
        $data['link_url'] = $data['external_links'][0]['url'] ?? null;
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $work->slug ?? $data['title'], $work->id);
        $data['short_description'] = RichTextSanitizer::clean($data['short_description']);
        $categoryName = WorkCategory::query()->whereKey($data['category_id'])->value('name') ?: 'Works';
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'works', $work->image_path,
            $data['title'], $categoryName
        );
        $work->update($data);
        $this->registerLinkedVideos($data['external_links'], $data['title'], $categoryName, $data['short_description']);

        return redirect()
            ->route('admin.works.index', $request->boolean('home') ? ['home' => 1] : [])
            ->with('success', 'Work updated successfully.');
    }

    public function destroy(Work $work): RedirectResponse
    {
        $this->deleteStoredFile($work->image_path);
        $work->delete();

        return back()->with('success', 'Work deleted successfully.');
    }


    /**
     * @param array<int, array<string, mixed>> $links
     * @return array<int, array{label: string, url: string}>
     */
    private function normaliseLinks(array $links): array
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
     * Keep YouTube links entered against a work inside the central media library.
     *
     * @param array<int, array{label: string, url: string}> $links
     */
    private function registerLinkedVideos(array $links, string $title, string $category, ?string $description): void
    {
        foreach ($links as $link) {
            MediaLibrary::registerVideo(
                $link['url'] ?? null,
                ($link['label'] ?? null) ?: $title,
                $category,
                trim(strip_tags((string) $description)) ?: null,
            );
        }
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'work';
        $slug = $base;
        $counter = 2;

        while (Work::query()->where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
