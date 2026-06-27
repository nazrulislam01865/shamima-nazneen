<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BiographySection;
use App\Models\ContactInquiry;
use App\Models\ContentSection;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\MediaItem;
use App\Models\Testimonial;
use App\Models\Work;
use App\Models\WorkCategory;
use App\Support\AdminPageRegistry;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    public function __invoke(string $page): View
    {
        $pageConfig = AdminPageRegistry::find($page);

        if (! $pageConfig) {
            throw new NotFoundHttpException('The requested admin page does not exist.');
        }

        $metrics = $this->metrics($page);
        $sectionSummary = ContentSection::query()
            ->where('page', $page)
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active')
            ->first();

        return view('admin.pages.show', [
            'pageKey' => $page,
            'pageConfig' => $pageConfig,
            'metrics' => $metrics,
            'sectionTotal' => (int) ($sectionSummary?->total ?? 0),
            'sectionActive' => (int) ($sectionSummary?->active ?? 0),
        ]);
    }

    /**
     * @return array<string, array{value:int,label:string}>
     */
    private function metrics(string $page): array
    {
        return match ($page) {
            'home' => [
                'content' => $this->metric(ContentSection::query()->where('page', 'home')->count(), 'sections'),
                'slider' => $this->metric(HeroSlide::query()->count(), 'slides'),
                'featured-works' => $this->metric(Work::query()->where('show_on_home', true)->count(), 'shown on home'),
                'home-images' => $this->metric(MediaItem::query()->where('type', 'image')->where('show_on_home', true)->count(), 'shown on home'),
                'home-videos' => $this->metric(MediaItem::query()->where('type', 'video')->where('show_on_home', true)->count(), 'shown on home'),
                'testimonials' => $this->metric(Testimonial::query()->count(), 'quotes'),
                'events' => $this->metric(Event::query()->count(), 'events'),
                'inquiries' => $this->metric(ContactInquiry::query()->where('status', 'new')->count(), 'new messages'),
            ],
            'biography' => [
                'content' => $this->metric(ContentSection::query()->where('page', 'biography')->count(), 'page sections'),
                'timeline' => $this->metric(BiographySection::query()->count(), 'biography sections'),
            ],
            'works' => [
                'content' => $this->metric(ContentSection::query()->where('page', 'works')->count(), 'page sections'),
                'categories' => $this->metric(WorkCategory::query()->count(), 'categories'),
                'archive' => $this->metric(Work::query()->count(), 'works'),
            ],
            'gallery' => [
                'content' => $this->metric(ContentSection::query()->where('page', 'gallery')->count(), 'page sections'),
                'media' => $this->metric(MediaItem::query()->count(), 'media items'),
                'images' => $this->metric(MediaItem::query()->where('type', 'image')->count(), 'images'),
                'videos' => $this->metric(MediaItem::query()->where('type', 'video')->count(), 'videos'),
            ],
            default => [],
        };
    }

    /**
     * @return array{value:int,label:string}
     */
    private function metric(int $value, string $label): array
    {
        return compact('value', 'label');
    }
}
