<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->json('profile_card_links')->nullable()->after('social_links');
        });

        DB::table('site_settings')->orderBy('id')->get()->each(function (object $settings): void {
            $existing = json_decode((string) ($settings->social_links ?? ''), true);

            if (! is_array($existing)) {
                return;
            }

            $definitions = [
                'wikipedia' => ['title' => 'Wikipedia Profile', 'description' => 'Open the public Wikipedia profile and biography reference.'],
                'imdb' => ['title' => 'IMDb Profile', 'description' => 'View screen credits and the public IMDb profile.'],
                'chorki' => ['title' => 'Chorki Cast Profile', 'description' => 'Explore the public Chorki cast and platform profile.'],
                'youtube' => ['title' => 'YouTube Features', 'description' => 'Watch public interviews, appearances, and video features.'],
                'facebook' => ['title' => 'Facebook Features', 'description' => 'Visit the official Facebook page and public features.'],
            ];

            $links = collect($definitions)
                ->map(function (array $definition, string $key) use ($existing): ?array {
                    $url = trim((string) ($existing[$key] ?? ''));

                    return $url === '' ? null : [
                        'title' => $definition['title'],
                        'url' => $url,
                        'description' => $definition['description'],
                    ];
                })
                ->filter()
                ->values()
                ->all();

            if ($links !== []) {
                DB::table('site_settings')->where('id', $settings->id)->update([
                    'profile_card_links' => json_encode($links, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->dropColumn('profile_card_links');
        });
    }
};
