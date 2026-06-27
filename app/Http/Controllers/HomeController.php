<?php

namespace App\Http\Controllers;

use App\Models\BiographySection;
use App\Models\ContentSection;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\MediaItem;
use App\Models\Testimonial;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $sections = ContentSection::query()
            ->where('page', 'home')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $slides = HeroSlide::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $homeBiographySections = BiographySection::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $workCategories = WorkCategory::query()
            ->where('is_active', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        $homeWorks = Work::query()
            ->with('category')
            ->whereHas('category', fn ($query) => $query->where('is_active', true))
            ->where('is_active', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->orderByDesc('year')
            ->get();

        $filmWorks = $homeWorks
            ->filter(fn (Work $work): bool => $work->category?->slug === 'films')
            ->take(6);

        $homeImages = MediaItem::query()
            ->where('type', 'image')
            ->where('is_active', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $homeVideos = MediaItem::query()
            ->where('type', 'video')
            ->where('is_active', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->orderByDesc('is_featured')
            ->limit(6)
            ->get();

        $profileMedia = MediaItem::query()
            ->where('is_active', true)
            ->where('show_in_profiles', true)
            ->orderBy('sort_order')
            ->orderByDesc('is_featured')
            ->limit(10)
            ->get();

        $events = Event::query()
            ->with('workCategory')
            ->where('is_active', true)
            ->where('show_on_home', true)
            ->orderBy('sort_order')
            ->orderByDesc('event_date')
            ->limit(4)
            ->get();

        $testimonials = Testimonial::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(5)
            ->get();

        return view('frontend.home', compact(
            'sections',
            'slides',
            'homeBiographySections',
            'workCategories',
            'filmWorks',
            'homeImages',
            'homeVideos',
            'profileMedia',
            'events',
            'testimonials',
        ));
    }
}
