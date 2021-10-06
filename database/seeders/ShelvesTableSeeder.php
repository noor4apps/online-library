<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Shelf;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShelvesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Shelf::create([
                'name' => $faker->sentence(2, true),
                'slug' => str::slug($faker->sentence(2, true)),
                'category_id' => Category::inRandomOrder()->first()->id
            ]);
        }
    }
}
