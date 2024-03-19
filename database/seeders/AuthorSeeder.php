<?php

namespace Database\Seeders;

use App\Models\author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Author::create([
                'first_name' => 'Author ' . ($i),
                'last_name' => 'Lastname ' . ($i),
                'biography' => 'Biography of Author ' . ($i),
            ]);
        }
    }
}
