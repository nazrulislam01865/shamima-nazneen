<?php

namespace App\Http\Controllers;

use App\Models\BiographySection;
use App\Models\ContentSection;
use App\Models\MediaItem;
use Illuminate\Contracts\View\View;

class BiographyController extends Controller
{
    public function index(): View
    {
        $page = ContentSection::query()
            ->where('page', 'biography')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $sections = BiographySection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $images = MediaItem::query()
            ->where('type', 'image')
            ->where('is_active', true)
            ->where('show_in_biography', true)
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->limit(12)
            ->get();

        $videos = MediaItem::query()
            ->where('type', 'video')
            ->where('is_active', true)
            ->where('show_in_biography', true)
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->limit(8)
            ->get();

        return view('frontend.biography', compact('page', 'sections', 'images', 'videos'));
    }
}
