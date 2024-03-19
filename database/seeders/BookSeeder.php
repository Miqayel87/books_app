<?php

namespace Database\Seeders;

use App\Models\book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Book::create([
                'title' => 'Book ' . ($i),
                'description' => 'Description of Book ' . ($i),
                'publication_year' => rand(2000, 2022),
            ]);
        }
    }
}
