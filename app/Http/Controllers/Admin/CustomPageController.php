<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomPageRequest;
use App\Models\CustomPage;
use App\Support\RichTextSanitizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    public function index(): View
    {
        $customPages = CustomPage::query()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.custom-pages.index', compact('customPages'));
    }

    public function create(): View
    {
        return view('admin.custom-pages.create');
    }

    public function store(CustomPageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']);
        $data['content'] = RichTextSanitizer::clean($data['content']);
        $data['sort_order'] = ((int) CustomPage::query()->max('sort_order')) + 10;

        CustomPage::query()->create($data);

        return redirect()->route('admin.custom-pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(CustomPage $customPage): View
    {
        return view('admin.custom-pages.edit', compact('customPage'));
    }

    public function update(CustomPageRequest $request, CustomPage $customPage): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $customPage->id);
        $data['content'] = RichTextSanitizer::clean($data['content']);
        $customPage->update($data);

        return redirect()->route('admin.custom-pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(CustomPage $customPage): RedirectResponse
    {
        $customPage->delete();

        return back()->with('success', 'Page deleted successfully.');
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'page';
        $slug = $base;
        $counter = 2;

        while (CustomPage::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}
