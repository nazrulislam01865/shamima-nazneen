<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Http\Controllers\Concerns\UsesMediaLibrary;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeroSlideRequest;
use App\Models\HeroSlide;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HeroSlideController extends Controller
{
    use HandlesUploads;
    use UsesMediaLibrary;

    public function index(): View
    {
        $heroSlides = HeroSlide::query()->orderBy('sort_order')->get();

        return view('admin.hero-slides.index', compact('heroSlides'));
    }

    public function create(): View
    {
        return view('admin.hero-slides.create');
    }

    public function store(HeroSlideRequest $request): RedirectResponse
    {
        $data = $this->slideData($request);
        $data['image_path'] = $this->resolveLibraryImage(
            $request,
            'image',
            'remove_image',
            'library_media_id',
            'hero',
            null,
            $request->input('title') ?: 'Hero slide image',
            'Hero Slider',
        );
        $data['sort_order'] = ((int) HeroSlide::query()->max('sort_order')) + 10;
        HeroSlide::query()->create($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created successfully. The image is also available in Gallery / Media Library.');
    }

    public function edit(HeroSlide $heroSlide): View
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(HeroSlideRequest $request, HeroSlide $heroSlide): RedirectResponse
    {
        $data = $this->slideData($request);
        $data['image_path'] = $this->resolveLibraryImage(
            $request,
            'image',
            'remove_image',
            'library_media_id',
            'hero',
            $heroSlide->image_path,
            $request->input('title') ?: 'Hero slide image',
            'Hero Slider',
        );
        $heroSlide->update($data);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        $path = $heroSlide->image_path;
        $heroSlide->delete();
        $this->deleteStoredFile($path);

        return back()->with('success', 'Hero slide deleted successfully.');
    }

    private function slideData(HeroSlideRequest $request): array
    {
        $validated = $request->validated();

        return [
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'button_label' => null,
            'button_url' => null,
            'settings' => [
                'text_alignment' => $validated['text_alignment'],
                'vertical_position' => $validated['vertical_position'],
                'text_color' => $validated['text_color'],
                'overlay_opacity' => (int) $validated['overlay_opacity'],
                'title_size' => (int) $validated['title_size'],
                'subtitle_size' => (int) $validated['subtitle_size'],
            ],
            'is_active' => $request->boolean('is_active'),
        ];
    }
}
