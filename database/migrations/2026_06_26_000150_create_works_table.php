<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->constrained('work_categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('year');
            $table->string('credit')->nullable();
            $table->string('role')->nullable();
            $table->string('platform')->nullable();
            $table->longText('short_description');
            $table->string('image_path', 500)->nullable();
            $table->string('link_name')->nullable();
            $table->string('link_url', 500)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('show_on_home')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['category_id', 'year']);
            $table->index(['show_on_home', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
