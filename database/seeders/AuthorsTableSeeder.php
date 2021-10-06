<?php

namespace Database\Seeders;

use App\Models\Author;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Author::create([
                'name' => $faker->name
            ]);
        }
    }
}
