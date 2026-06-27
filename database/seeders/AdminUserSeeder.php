<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => config('admin.seed_email')],
            [
                'name' => config('admin.seed_name'),
                'password' => Hash::make(config('admin.seed_password')),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
