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
        ]);

        User::create([
            'login' => 'login',
            'password' => '$2y$10$tSHMCrv1FxyIUwauRAZbxeCacqiM9wHHIZ9EStG4K5iPN320DWjc6',
        ]);
    }
}
