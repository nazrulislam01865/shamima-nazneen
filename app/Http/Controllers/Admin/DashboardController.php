<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\CustomPage;
use App\Models\Event;
use App\Models\MediaItem;
use App\Models\Work;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'works' => Work::query()->count(),
            'images' => MediaItem::query()->where('type', 'image')->count(),
            'videos' => MediaItem::query()->where('type', 'video')->count(),
            'events' => Event::query()->count(),
            'custom_pages' => CustomPage::query()->count(),
            'new_inquiries' => ContactInquiry::query()->where('status', 'new')->count(),
        ];

        $recentInquiries = ContactInquiry::query()->latest()->limit(8)->get();
        $recentWorks = Work::query()->with('category')->latest()->limit(6)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentWorks'));
    }
}
