<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Models\MenuItem;
use App\Support\MediaLibrary;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MenuItemController extends Controller
{
    use HandlesUploads;

    public function index(): View
    {
        $location = in_array(request('location'), ['header', 'footer'], true)
            ? request('location')
            : 'header';

        $menuItems = MenuItem::query()
            ->where('location', $location)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.menu-items.index', compact('menuItems', 'location'));
    }

    public function create(): View
    {
        $defaultLocation = in_array(request('location'), ['header', 'footer'], true)
            ? request('location')
            : 'header';

        return view('admin.menu-items.create', compact('defaultLocation'));
    }

    public function store(MenuItemRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['icon'], $data['remove_icon']);
        $data['icon_path'] = $this->storeUploadedFile($request->file('icon'), 'menu-icons');
        $data['sort_order'] = ((int) MenuItem::query()->where('location', $data['location'])->max('sort_order')) + 10;

        MenuItem::query()->create($data);

        MediaLibrary::registerImage($data['icon_path'] ?? null, $data['label'].' menu icon', 'Navigation Icons', 'Menu icon is not available.');
        MediaLibrary::registerVideo($data['url'] ?? null, $data['label'], ucfirst($data['location']).' Menu Links');

        return redirect()
            ->route('admin.menu-items.index', ['location' => $data['location']])
            ->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menuItem): View
    {
        return view('admin.menu-items.edit', compact('menuItem'));
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem): RedirectResponse
    {
        $data = $request->validated();
        unset($data['icon'], $data['remove_icon']);
        $data['icon_path'] = $this->removeUploadedFileIfRequested($request->boolean('remove_icon'), $menuItem->icon_path);
        $data['icon_path'] = $this->storeUploadedFile($request->file('icon'), 'menu-icons', $data['icon_path']);

        if ($menuItem->location !== $data['location']) {
            $data['sort_order'] = ((int) MenuItem::query()->where('location', $data['location'])->max('sort_order')) + 10;
        }

        $menuItem->update($data);

        MediaLibrary::registerImage($data['icon_path'] ?? null, $data['label'].' menu icon', 'Navigation Icons', 'Menu icon is not available.');
        MediaLibrary::registerVideo($data['url'] ?? null, $data['label'], ucfirst($data['location']).' Menu Links');

        return redirect()
            ->route('admin.menu-items.index', ['location' => $data['location']])
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $location = $menuItem->location;
        $this->deleteStoredFile($menuItem->icon_path);
        $menuItem->delete();

        return redirect()
            ->route('admin.menu-items.index', ['location' => $location])
            ->with('success', 'Menu item deleted successfully.');
    }
}
