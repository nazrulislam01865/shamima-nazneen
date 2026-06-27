<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_items', function (Blueprint $table): void {
            $table->id();
            $table->string('type', 20); // image or video
            $table->string('title');
            $table->string('category')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_path', 500)->nullable();
            $table->string('youtube_url', 500)->nullable();
            $table->string('link_name')->nullable();
            $table->string('link_url', 500)->nullable();
            $table->boolean('show_on_home')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['type', 'show_on_home', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
