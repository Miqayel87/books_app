<?php

namespace Database\Seeders;

use App\Models\BookAuthor;
use Illuminate\Database\Seeder;

class BookAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            BookAuthor::create([
                'book_id' => ($i),
                'author_id' => ($i),
            ]);
        }

        BookAuthor::create([
            'book_id' => 1,
            'author_id' => 4,
        ]);

        BookAuthor::create([
            'book_id' => 1,
            'author_id' => 6,
        ]);

        BookAuthor::create([
            'book_id' => 3,
            'author_id' => 7,
        ]);

        BookAuthor::create([
            'book_id' => 2,
            'author_id' => 14,
        ]);
    }
}
