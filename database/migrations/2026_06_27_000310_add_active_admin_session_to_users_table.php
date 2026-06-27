<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('active_admin_session_id')->nullable()->after('is_admin');
            $table->timestamp('active_admin_login_at')->nullable()->after('active_admin_session_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['active_admin_session_id', 'active_admin_login_at']);
        });
    }
};
