<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            OtherSeeder::class,
            CategorySeeder::class,
            SeriesSeeder::class,
            PostSeeder::class,
            BookmarkSeeder::class,
            LikeSeeder::class
        ]);
    }
}
