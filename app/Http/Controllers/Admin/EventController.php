<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\WorkCategory;
use App\Support\MediaLibrary;
use App\Support\RichTextSanitizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function index(): View
    {
        $events = Event::query()->with('workCategory')->orderBy('sort_order')->orderByDesc('event_date')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        $categories = WorkCategory::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.events.create', compact('categories'));
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id']);
        $data['description'] = RichTextSanitizer::clean($data['description'] ?? null);
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'events', null,
            $data['title'], 'Events & Appearances'
        );
        $data['sort_order'] = ((int) Event::query()->max('sort_order')) + 10;
        Event::query()->create($data);
        MediaLibrary::registerVideo($data['link_url'] ?? null, $data['link_name'] ?? $data['title'], 'Events & Appearances', trim(strip_tags((string) ($data['description'] ?? ''))) ?: null);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event): View
    {
        $categories = WorkCategory::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        $data = $request->safe()->except(['image', 'remove_image', 'library_media_id']);
        $data['description'] = RichTextSanitizer::clean($data['description'] ?? null);
        $data['image_path'] = $this->resolveLibraryImage(
            $request, 'image', 'remove_image', 'library_media_id', 'events', $event->image_path,
            $data['title'], 'Events & Appearances'
        );
        $event->update($data);
        MediaLibrary::registerVideo($data['link_url'] ?? null, $data['link_name'] ?? $data['title'], 'Events & Appearances', trim(strip_tags((string) ($data['description'] ?? ''))) ?: null);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->deleteStoredFile($event->image_path);
        $event->delete();

        return back()->with('success', 'Event deleted successfully.');
    }
}
