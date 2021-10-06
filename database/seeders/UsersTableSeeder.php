<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        User::create([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'contact_number' => $faker->e164PhoneNumber,
            'address' => $faker->address,
            'is_admin' => '1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'contact_number' => $faker->e164PhoneNumber,
                'address' => $faker->address,
                'is_admin' => '0',
                'email' => $faker->email,
                'password' => bcrypt('12345678'),
            ]);
        }
    }
}
