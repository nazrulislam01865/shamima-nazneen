<?php

use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BiographySectionController as AdminBiographySectionController;
use App\Http\Controllers\Admin\ContactInquiryController as AdminContactInquiryController;
use App\Http\Controllers\Admin\CustomPageController as AdminCustomPageController;
use App\Http\Controllers\Admin\EditorImageController as AdminEditorImageController;
use App\Http\Controllers\Admin\ContentSectionController as AdminContentSectionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\HeroSlideController as AdminHeroSlideController;
use App\Http\Controllers\Admin\MediaItemController as AdminMediaItemController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SiteSettingsController as AdminSiteSettingsController;
use App\Http\Controllers\Admin\SortOrderController as AdminSortOrderController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\WorkCategoryController as AdminWorkCategoryController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaFileController;
use App\Http\Controllers\WorksController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/biography', [BiographyController::class, 'index'])->name('biography.index');
Route::get('/works', [WorksController::class, 'index'])->name('works.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/videos', [GalleryController::class, 'videos'])->name('videos.index');
Route::get('/pages/{customPage:slug}', [CustomPageController::class, 'show'])->name('pages.show');
Route::get('/media/{path}', MediaFileController::class)->where('path', '.*')->name('media.public');
Route::post('/contact-inquiries', [ContactInquiryController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('inquiries.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->middleware('throttle:5,1')->name('login.store');

    Route::middleware(['auth', 'admin', 'single.admin.session'])->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::get('/pages/{page}', AdminPageController::class)->whereIn('page', ['home', 'biography', 'works', 'gallery'])->name('pages.show');

        Route::get('/account', [AdminAccountController::class, 'edit'])->name('account.edit');
        Route::put('/account', [AdminAccountController::class, 'update'])->name('account.update');

        Route::get('/settings', [AdminSiteSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [AdminSiteSettingsController::class, 'update'])->name('settings.update');

        Route::get('/content-sections', [AdminContentSectionController::class, 'index'])->name('content-sections.index');
        Route::get('/content-sections/create', [AdminContentSectionController::class, 'create'])->name('content-sections.create');
        Route::post('/content-sections', [AdminContentSectionController::class, 'store'])->name('content-sections.store');
        Route::get('/content-sections/{contentSection}/edit', [AdminContentSectionController::class, 'edit'])->name('content-sections.edit');
        Route::put('/content-sections/{contentSection}', [AdminContentSectionController::class, 'update'])->name('content-sections.update');
        Route::delete('/content-sections/{contentSection}', [AdminContentSectionController::class, 'destroy'])->name('content-sections.destroy');

        Route::post('/reorder/{resource}', AdminSortOrderController::class)->whereIn('resource', ['content-sections', 'hero-slides', 'biography-sections', 'work-categories', 'works', 'media-items', 'testimonials', 'events', 'custom-pages', 'menu-items'])->name('reorder');

        Route::post('/editor-images', [AdminEditorImageController::class, 'store'])->name('editor-images.store');
        Route::resource('custom-pages', AdminCustomPageController::class)->parameters(['custom-pages' => 'customPage'])->except('show');
        Route::resource('menu-items', AdminMenuItemController::class)->except('show');

        Route::resource('hero-slides', AdminHeroSlideController::class)->except('show');
        Route::resource('biography-sections', AdminBiographySectionController::class)->except('show');
        Route::resource('work-categories', AdminWorkCategoryController::class)->except('show');
        Route::resource('works', AdminWorkController::class)->except('show');
        Route::get('/gallery-media/images', [AdminMediaItemController::class, 'images'])->name('gallery-media.images');
        Route::get('/gallery-media/videos', [AdminMediaItemController::class, 'videos'])->name('gallery-media.videos');
        Route::resource('media-items', AdminMediaItemController::class)->except('show');
        Route::resource('testimonials', AdminTestimonialController::class)->except('show');
        Route::resource('events', AdminEventController::class)->except('show');

        Route::get('/inquiries', [AdminContactInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [AdminContactInquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}', [AdminContactInquiryController::class, 'update'])->name('inquiries.update');
        Route::delete('/inquiries/{inquiry}', [AdminContactInquiryController::class, 'destroy'])->name('inquiries.destroy');
    });
});
