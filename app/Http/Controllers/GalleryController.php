<?php

namespace App\Http\Controllers;

use App\Models\ContentSection;
use App\Models\MediaItem;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $type = in_array(request('type'), ['image', 'video'], true) ? request('type') : null;

        return $this->renderGallery($type);
    }

    public function videos(): View
    {
        return $this->renderGallery('video');
    }

    private function renderGallery(?string $initialType = null): View
    {
        $page = ContentSection::query()
            ->where('page', 'gallery')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $items = MediaItem::query()
            ->where('is_active', true)
            ->where('show_in_gallery', true)
            ->orderBy('sort_order')
            ->orderByDesc('is_featured')
            ->orderByDesc('year')
            ->get();

        $categories = $items->pluck('category')->filter()->unique()->sort()->values();

        return view('frontend.gallery', compact('page', 'items', 'categories', 'initialType'));
    }
}
