<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_sections', function (Blueprint $table): void {
            $table->id();
            $table->string('page', 50)->default('home');
            $table->string('section_key', 80);
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('secondary_text')->nullable();
            $table->string('button_label')->nullable();
            $table->string('button_url', 500)->nullable();
            $table->string('image_path', 500)->nullable();
            $table->json('settings')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['page', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_sections');
    }
};
