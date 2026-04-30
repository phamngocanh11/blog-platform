<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 11 bản ghi cho bảng password_reset_tokens
        for ($i = 0; $i < 11; $i++) {
            DB::table('password_reset_tokens')->insert([
                'email' => fake()->unique()->safeEmail(),
                'token' => Str::random(60),
                'created_at' => now(),
            ]);
        }

        // Tạo 11 bản ghi cho bảng sessions
        for ($i = 0; $i < 11; $i++) {
            DB::table('sessions')->insert([
                'id' => Str::uuid(),
                'user_id' => null,
                'ip_address' => fake()->ipv4(),
                'user_agent' => fake()->userAgent(),
                'payload' => Str::random(50),
                'last_activity' => time(),
            ]);
        }
    }
}
