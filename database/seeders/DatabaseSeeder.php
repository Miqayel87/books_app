<?php

namespace Database\Seeders;

use App\Models\BookAuthor;
use App\Models\User;
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
        $this->call([
            AuthorSeeder::class,
            BookSeeder::class,
            BookAuthorSeeder::class,
            UserSeeder::class
        ]);
    }
}
