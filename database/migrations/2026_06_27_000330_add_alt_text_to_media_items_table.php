<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('media_items') || Schema::hasColumn('media_items', 'alt_text')) {
            return;
        }

        Schema::table('media_items', function (Blueprint $table): void {
            $table->string('alt_text', 255)->nullable()->after('title');
        });

        DB::table('media_items')
            ->where('type', 'image')
            ->whereNull('alt_text')
            ->orderBy('id')
            ->update(['alt_text' => DB::raw('title')]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('media_items') || ! Schema::hasColumn('media_items', 'alt_text')) {
            return;
        }

        Schema::table('media_items', function (Blueprint $table): void {
            $table->dropColumn('alt_text');
        });
    }
};
