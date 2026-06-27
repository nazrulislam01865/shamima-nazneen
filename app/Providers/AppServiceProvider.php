<?php

namespace App\Providers;

use App\Models\ContactInquiry;
use App\Models\CustomPage;
use App\Models\MenuItem;
use App\Models\SiteSetting;
use App\Support\AdminPageRegistry;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        try {
            $settings = Schema::hasTable('site_settings')
                ? SiteSetting::current()
                : new SiteSetting(['site_name' => config('app.name')]);
        } catch (Throwable) {
            $settings = new SiteSetting(['site_name' => config('app.name')]);
        }

        View::share('siteSettings', $settings);

        try {
            $customPages = Schema::hasTable('custom_pages')
                ? CustomPage::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get()
                : collect();
        } catch (Throwable) {
            $customPages = collect();
        }

        View::share('headerCustomPages', $customPages->where('show_in_header', true)->values());
        View::share('footerCustomPages', $customPages->where('show_in_footer', true)->values());

        try {
            $menuItems = Schema::hasTable('menu_items')
                ? MenuItem::query()->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get()
                : collect();
        } catch (Throwable) {
            $menuItems = collect();
        }

        View::share('headerMenuItems', $menuItems->where('location', 'header')->values());
        View::share('footerMenuItems', $menuItems->where('location', 'footer')->values());

        View::composer('layouts.admin', function ($view): void {
            try {
                $count = Schema::hasTable('contact_inquiries')
                    ? ContactInquiry::query()->where('status', 'new')->count()
                    : 0;
            } catch (Throwable) {
                $count = 0;
            }

            $view->with([
                'adminNewInquiryCount' => $count,
                'adminPages' => AdminPageRegistry::all(),
            ]);
        });
    }
}
