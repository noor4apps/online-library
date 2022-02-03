<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call(PublishersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BookCategoriesTableSeeder::class);
        $this->call(ShelvesTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(BookAuthorsTableSeeder::class);
    }
}
