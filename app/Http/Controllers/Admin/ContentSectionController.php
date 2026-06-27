<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentSectionRequest;
use App\Models\ContentSection;
use App\Support\AdminPageRegistry;
use App\Support\MediaLibrary;
use App\Support\RichTextSanitizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ContentSectionController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function index(): View
    {
        $availablePages = AdminPageRegistry::all();
        $pageFilter = request('page');

        if (! array_key_exists((string) $pageFilter, $availablePages)) {
            $pageFilter = null;
        }

        $query = ContentSection::query()
            ->when($pageFilter, fn ($sectionQuery) => $sectionQuery->where('page', $pageFilter))
            ->orderBy('page')
            ->orderBy('sort_order');

        $sections = $query->get()->groupBy('page');
        $pageConfig = $pageFilter ? $availablePages[$pageFilter] : null;

        return view('admin.content-sections.index', compact(
            'sections',
            'availablePages',
            'pageFilter',
            'pageConfig',
        ));
    }

    public function create(): View
    {
        $page = request('page', 'home');
        abort_unless($page === 'home', 404);
        $pageConfig = AdminPageRegistry::find($page);

        return view('admin.content-sections.create', compact('page', 'pageConfig'));
    }

    public function store(ContentSectionRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id', 'section_name', 'layout']);
        $data['page'] = 'home';
        $data['section_key'] = $this->uniqueCustomKey($request->string('section_name')->toString());
        $data['description'] = RichTextSanitizer::clean($data['description'] ?? null);
        $data['secondary_text'] = RichTextSanitizer::clean($data['secondary_text'] ?? null);
        $data['settings'] = ['layout' => $request->input('layout', 'image-right')];
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'sections', null,
            $data['title'] ?? $request->input('section_name', 'Home content image'), 'Home Page Content'
        );
        $data['sort_order'] = ((int) ContentSection::query()->where('page', 'home')->max('sort_order')) + 10;

        ContentSection::query()->create($data);
        MediaLibrary::registerVideo($data['button_url'] ?? null, $data['button_label'] ?? ($data['title'] ?? 'Home page video'), 'Home Page Content', trim(strip_tags((string) ($data['description'] ?? ''))) ?: null);

        return redirect()
            ->route('admin.content-sections.index', ['page' => 'home'])
            ->with('success', 'Home-page content section created successfully.');
    }

    public function edit(ContentSection $contentSection): View
    {
        $pageConfig = AdminPageRegistry::find($contentSection->page);

        return view('admin.content-sections.edit', compact('contentSection', 'pageConfig'));
    }

    public function update(ContentSectionRequest $request, ContentSection $contentSection): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id', 'page', 'section_name', 'layout']);
        $data['description'] = RichTextSanitizer::clean($data['description'] ?? null);
        $data['secondary_text'] = RichTextSanitizer::clean($data['secondary_text'] ?? null);

        if ($this->isCustomHomeSection($contentSection)) {
            $settings = $contentSection->settings ?? [];
            $settings['layout'] = $request->input('layout', $settings['layout'] ?? 'image-right');
            $data['settings'] = $settings;
        }

        if ($contentSection->page === 'works') {
            unset($data['button_label'], $data['button_url']);
        }

        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'sections', $contentSection->image_path,
            $data['title'] ?? $contentSection->title ?? 'Page section image', ucfirst($contentSection->page).' Page Content'
        );

        $contentSection->update($data);
        MediaLibrary::registerVideo($data['button_url'] ?? null, $data['button_label'] ?? ($data['title'] ?? $contentSection->title ?? 'Page video'), ucfirst($contentSection->page).' Page Content', trim(strip_tags((string) ($data['description'] ?? ''))) ?: null);

        return redirect()
            ->route('admin.content-sections.index', ['page' => $contentSection->page])
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(ContentSection $contentSection): RedirectResponse
    {
        abort_unless($this->isCustomHomeSection($contentSection), 403, 'Only administrator-created home sections can be deleted.');

        $this->deleteStoredFile($contentSection->image_path);
        $contentSection->delete();

        return redirect()
            ->route('admin.content-sections.index', ['page' => 'home'])
            ->with('success', 'Home-page content section deleted successfully.');
    }

    private function isCustomHomeSection(ContentSection $section): bool
    {
        return $section->page === 'home' && Str::startsWith($section->section_key, 'custom-');
    }

    private function uniqueCustomKey(string $value): string
    {
        $base = 'custom-'.(Str::slug($value) ?: 'content');
        $key = $base;
        $counter = 2;

        while (ContentSection::query()->where('page', 'home')->where('section_key', $key)->exists()) {
            $key = $base.'-'.$counter++;
        }

        return $key;
    }
}
