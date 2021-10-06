<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Publisher;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
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
            Book::create([
                'title' => $faker->sentence(6, true),
                'isbn' => $faker->isbn10(),
                'quantity' => $faker->randomElement([1, 2, 3, 4]),
                'edition' => 'V' . $faker->randomElement([1, 2, 3, 4]),
                'volume' => 'N' . $faker->randomElement([1, 2, 3, 4]),
                'publisher_id' => Publisher::inRandomOrder()->first()->id
            ]);
        }
    }
}
