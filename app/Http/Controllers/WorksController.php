<?php

namespace App\Http\Controllers;

use App\Models\ContentSection;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Contracts\View\View;

class WorksController extends Controller
{
    public function index(): View
    {
        $requestedCategory = request()->string('category')->trim()->toString();

        $page = ContentSection::query()
            ->where('page', 'works')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('section_key');

        $categories = WorkCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $works = Work::query()
            ->with('category')
            ->whereHas('category', fn ($query) => $query->where('is_active', true))
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('is_featured')
            ->orderByDesc('year')
            ->get();

        $activeCategory = $categories->firstWhere('slug', $requestedCategory)?->slug;
        $decades = $works
            ->map(fn (Work $work): string => ((int) floor($work->year / 10) * 10).'s')
            ->unique()
            ->sortDesc()
            ->values();

        return view('frontend.works', compact('page', 'categories', 'works', 'activeCategory', 'decades'));
    }
}
