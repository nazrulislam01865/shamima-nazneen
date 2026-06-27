<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Support\YouTube;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media_items', function (Blueprint $table): void {
            $table->boolean('show_in_gallery')->default(true)->after('link_url');
            $table->boolean('show_in_profiles')->default(false)->after('show_on_home');
            $table->boolean('show_in_biography')->default(true)->after('show_in_profiles');
            $table->string('fallback_text', 255)->nullable()->after('description');
        });

        Schema::table('site_settings', function (Blueprint $table): void {
            $table->string('image_fallback_text', 255)
                ->default('Image is not available.')
                ->after('footer_text');
        });

        $this->backfillExistingWebsiteImages();
        $this->backfillExistingWebsiteVideos();
    }

    public function down(): void
    {
        Schema::table('media_items', function (Blueprint $table): void {
            $table->dropColumn(['show_in_gallery', 'show_in_profiles', 'show_in_biography', 'fallback_text']);
        });

        Schema::table('site_settings', function (Blueprint $table): void {
            $table->dropColumn('image_fallback_text');
        });
    }

    private function backfillExistingWebsiteImages(): void
    {
        $sources = [
            ['table' => 'hero_slides', 'path' => 'image_path', 'title' => 'title', 'category' => 'Hero Slider'],
            ['table' => 'content_sections', 'path' => 'image_path', 'title' => 'title', 'category' => 'Page Content'],
            ['table' => 'biography_sections', 'path' => 'image_path', 'title' => 'title', 'category' => 'Biography'],
            ['table' => 'work_categories', 'path' => 'home_image_path', 'title' => 'home_title', 'fallback_title' => 'name', 'category' => 'Selected Works Cards'],
            ['table' => 'works', 'path' => 'image_path', 'title' => 'title', 'category' => 'Works & Filmography'],
            ['table' => 'events', 'path' => 'image_path', 'title' => 'title', 'category' => 'Events & Appearances'],
        ];

        foreach ($sources as $source) {
            if (! Schema::hasTable($source['table']) || ! Schema::hasColumn($source['table'], $source['path'])) {
                continue;
            }

            $columns = ['id', $source['path']];
            if (Schema::hasColumn($source['table'], $source['title'])) {
                $columns[] = $source['title'];
            }
            if (isset($source['fallback_title']) && Schema::hasColumn($source['table'], $source['fallback_title'])) {
                $columns[] = $source['fallback_title'];
            }

            DB::table($source['table'])
                ->whereNotNull($source['path'])
                ->where($source['path'], '!=', '')
                ->orderBy('id')
                ->get($columns)
                ->each(function (object $record) use ($source): void {
                    $title = trim((string) ($record->{$source['title']} ?? ''));
                    if ($title === '' && isset($source['fallback_title'])) {
                        $title = trim((string) ($record->{$source['fallback_title']} ?? ''));
                    }

                    $this->insertLibraryImage(
                        (string) $record->{$source['path']},
                        $title !== '' ? $title : Str::headline($source['category']).' image',
                        $source['category'],
                    );
                });
        }

        if (Schema::hasTable('site_settings')) {
            $settings = DB::table('site_settings')->first();
            if ($settings) {
                $this->insertLibraryImage($settings->logo_path ?? null, 'Website logo', 'Brand Identity');
                $this->insertLibraryImage($settings->favicon_path ?? null, 'Website favicon', 'Brand Identity');
            }
        }
    }

    private function backfillExistingWebsiteVideos(): void
    {
        if (Schema::hasTable('works')) {
            DB::table('works')->orderBy('id')->get()->each(function (object $record): void {
                $title = trim((string) ($record->title ?? '')) ?: 'Work video';
                $links = $this->decodeLinks($record->external_links ?? null);
                if (filled($record->link_url ?? null)) {
                    $links[] = ['label' => $record->link_name ?? null, 'url' => $record->link_url];
                }
                foreach ($links as $link) {
                    $this->insertLibraryVideo($link['url'] ?? null, trim((string) ($link['label'] ?? '')) ?: $title, 'Works & Filmography', strip_tags((string) ($record->short_description ?? '')) ?: null);
                }
            });
        }

        if (Schema::hasTable('work_categories')) {
            DB::table('work_categories')->orderBy('id')->get()->each(function (object $record): void {
                $title = trim((string) ($record->home_title ?? $record->name ?? '')) ?: 'Selected works video';
                $links = $this->decodeLinks($record->home_links ?? null);
                if (filled($record->forward_url ?? null)) {
                    $links[] = ['label' => $record->link_label ?? null, 'url' => $record->forward_url];
                }
                foreach ($links as $link) {
                    $this->insertLibraryVideo($link['url'] ?? null, trim((string) ($link['label'] ?? '')) ?: $title, 'Selected Works Cards');
                }
            });
        }

        $singleLinkSources = [
            ['table' => 'events', 'url' => 'link_url', 'label' => 'link_name', 'title' => 'title', 'category' => 'Events & Appearances', 'description' => 'description'],
            ['table' => 'content_sections', 'url' => 'button_url', 'label' => 'button_label', 'title' => 'title', 'category' => 'Page Content', 'description' => 'description'],
            ['table' => 'menu_items', 'url' => 'url', 'label' => 'label', 'title' => 'label', 'category' => 'Menu Links'],
        ];

        foreach ($singleLinkSources as $source) {
            if (! Schema::hasTable($source['table']) || ! Schema::hasColumn($source['table'], $source['url'])) {
                continue;
            }

            DB::table($source['table'])->orderBy('id')->get()->each(function (object $record) use ($source): void {
                $title = trim((string) ($record->{$source['label']} ?? $record->{$source['title']} ?? '')) ?: 'Website video';
                $description = isset($source['description']) ? strip_tags((string) ($record->{$source['description']} ?? '')) : null;
                $this->insertLibraryVideo($record->{$source['url']} ?? null, $title, $source['category'], $description ?: null);
            });
        }

        if (Schema::hasTable('site_settings')) {
            $settings = DB::table('site_settings')->first();
            $socialLinks = $settings ? json_decode((string) ($settings->social_links ?? ''), true) : null;
            $this->insertLibraryVideo(is_array($socialLinks) ? ($socialLinks['youtube'] ?? null) : null, 'YouTube feature', 'Profiles & Media');
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function decodeLinks(mixed $value): array
    {
        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode((string) $value, true);

        return is_array($decoded) ? array_values(array_filter($decoded, 'is_array')) : [];
    }

    private function insertLibraryVideo(?string $url, string $title, string $category, ?string $description = null): void
    {
        $watchUrl = YouTube::watchUrl($url);

        if (! $watchUrl || DB::table('media_items')->where('type', 'video')->where('youtube_url', $watchUrl)->exists()) {
            return;
        }

        DB::table('media_items')->insert([
            'type' => 'video',
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'youtube_url' => $watchUrl,
            'show_in_gallery' => false,
            'show_on_home' => false,
            'show_in_profiles' => false,
            'show_in_biography' => false,
            'is_featured' => false,
            'is_active' => true,
            'sort_order' => ((int) DB::table('media_items')->max('sort_order')) + 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function insertLibraryImage(?string $path, string $title, string $category): void
    {
        if (blank($path) || DB::table('media_items')->where('type', 'image')->where('image_path', $path)->exists()) {
            return;
        }

        DB::table('media_items')->insert([
            'type' => 'image',
            'title' => $title,
            'category' => $category,
            'image_path' => $path,
            'show_in_gallery' => false,
            'show_on_home' => false,
            'show_in_profiles' => false,
            'show_in_biography' => false,
            'is_featured' => false,
            'is_active' => true,
            'sort_order' => ((int) DB::table('media_items')->max('sort_order')) + 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
