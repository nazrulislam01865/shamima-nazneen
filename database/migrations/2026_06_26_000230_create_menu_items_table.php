<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table): void {
            $table->id();
            $table->string('location', 20);
            $table->string('label', 120);
            $table->string('url', 500);
            $table->boolean('open_new_tab')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['location', 'is_active', 'sort_order']);
        });

        $now = now();
        $defaults = [
            ['label' => 'About', 'url' => '/#about'],
            ['label' => 'Biography', 'url' => '/biography'],
            ['label' => 'Works', 'url' => '/works'],
            ['label' => 'Films', 'url' => '/works?category=films'],
            ['label' => 'Videos', 'url' => '/videos'],
            ['label' => 'Gallery', 'url' => '/gallery'],
            ['label' => 'Contact', 'url' => '/#contact'],
        ];

        foreach (['header', 'footer'] as $location) {
            foreach ($defaults as $index => $item) {
                DB::table('menu_items')->insert([
                    'location' => $location,
                    'label' => $item['label'],
                    'url' => $item['url'],
                    'open_new_tab' => false,
                    'is_active' => true,
                    'sort_order' => ($index + 1) * 10,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
