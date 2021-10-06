<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PublishersTableSeeder extends Seeder
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
            Publisher::create([
                'name' => 'publisher ' . $faker->lastName,
                'address' => $faker->address,
                'email' => $faker->email,
                'contact_number' => $faker->e164PhoneNumber,
            ]);
        }
    }
}
