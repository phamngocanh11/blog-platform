<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bookmark;

class BookmarkSeeder extends Seeder
{
    public function run()
    {
        Bookmark::factory()->count(11)->create();
    }
}
