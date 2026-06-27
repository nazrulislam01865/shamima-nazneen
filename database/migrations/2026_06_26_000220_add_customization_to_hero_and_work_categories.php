<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_slides', function (Blueprint $table): void {
            $table->json('settings')->nullable()->after('button_url');
        });

        Schema::table('work_categories', function (Blueprint $table): void {
            $table->json('home_links')->nullable()->after('forward_url');
        });
    }

    public function down(): void
    {
        Schema::table('work_categories', function (Blueprint $table): void {
            $table->dropColumn('home_links');
        });

        Schema::table('hero_slides', function (Blueprint $table): void {
            $table->dropColumn('settings');
        });
    }
};
