<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Comment::factory(10)->create()->each(function ($category) {
            Comment::factory(2)->create([
                'parent_id' => $category->id,
            ]);
        });
    }
}
