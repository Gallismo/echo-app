<?php

namespace Database\Seeders;

use App\Models\author;
use App\Models\category;
use App\Models\post;
use App\Models\post_categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        author::factory(1000)->create();

        category::factory(10)
            ->create()
            ->each(function ($category) {
                $category->children()->saveMany(category::factory(5)
                    ->make()
                    ->each(function ($category) {
                        $category->children()->saveMany(category::factory(10)->make());
                    }));
            });

        post::factory(10000)->create()->each(function ($post) {
            for ($count = 1; $count <= rand(1,2); $count++) {
                post_categories::create([
                    'post_id' => $post->id,
                    'category_id' => category::inRandomOrder()->first()->id
                ]);
            }
        });
    }
}
