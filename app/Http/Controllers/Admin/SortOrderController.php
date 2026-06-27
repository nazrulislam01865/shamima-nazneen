<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSortOrderRequest;
use App\Models\BiographySection;
use App\Models\ContentSection;
use App\Models\CustomPage;
use App\Models\Event;
use App\Models\HeroSlide;
use App\Models\MediaItem;
use App\Models\MenuItem;
use App\Models\Testimonial;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SortOrderController extends Controller
{
    /**
     * @var array<string, class-string<Model>>
     */
    private const RESOURCES = [
        'content-sections' => ContentSection::class,
        'hero-slides' => HeroSlide::class,
        'biography-sections' => BiographySection::class,
        'work-categories' => WorkCategory::class,
        'works' => Work::class,
        'media-items' => MediaItem::class,
        'testimonials' => Testimonial::class,
        'events' => Event::class,
        'custom-pages' => CustomPage::class,
        'menu-items' => MenuItem::class,
    ];

    public function __invoke(AdminSortOrderRequest $request, string $resource): JsonResponse
    {
        $modelClass = self::RESOURCES[$resource] ?? null;
        abort_unless($modelClass, 404);

        $ids = array_values($request->validated()['order']);
        $foundIds = $modelClass::query()->whereIn('id', $ids)->pluck('id')->map(fn ($id) => (int) $id)->all();

        if (count($foundIds) !== count($ids)) {
            return response()->json(['message' => 'One or more items could not be reordered. Refresh the page and try again.'], 422);
        }

        DB::transaction(function () use ($modelClass, $ids): void {
            $selectedLookup = array_fill_keys($ids, true);
            $submittedIndex = 0;

            $globalOrder = $modelClass::query()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->pluck('id')
                ->map(fn ($id) => (int) $id)
                ->all();

            foreach ($globalOrder as $position => $id) {
                if (isset($selectedLookup[$id])) {
                    $globalOrder[$position] = $ids[$submittedIndex++];
                }
            }

            foreach ($globalOrder as $index => $id) {
                $modelClass::query()->whereKey($id)->update(['sort_order' => ($index + 1) * 10]);
            }
        });

        return response()->json(['message' => 'Sequence saved.']);
    }
}
