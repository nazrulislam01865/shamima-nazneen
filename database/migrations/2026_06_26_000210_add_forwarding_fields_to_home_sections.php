<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_categories', function (Blueprint $table): void {
            $table->string('forward_url', 500)->nullable()->after('link_label');
        });

        Schema::table('events', function (Blueprint $table): void {
            $table->foreignId('work_category_id')
                ->nullable()
                ->after('link_url')
                ->constrained('work_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('work_category_id');
        });

        Schema::table('work_categories', function (Blueprint $table): void {
            $table->dropColumn('forward_url');
        });
    }
};
