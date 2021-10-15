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
            $name = $faker->sentence(2, true);
            Shelf::create([
                'name' => $name,
                'slug' => str::slug($name),
                'category_id' => Category::inRandomOrder()->first()->id
            ]);
        }
    }
}
