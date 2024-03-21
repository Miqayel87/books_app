<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookAuthor;

class BookService
{
    public function create($request)
    {
        $newBook = new Book($request->validated());

        foreach ($request->authors as $authorId) {
            $bookAuthor = new BookAuthor([
                'book_id' => $newBook->id,
                'author_id' => $authorId
            ]);

            $bookAuthor->save();
        }

        return $newBook->save();
    }

    public function update($request, $id)
    {
        $book = $this->getOne($id);
        $book->update($request->validated());

        BookAuthor::where('book_id', $book->id)->delete();

        foreach ($request->authors as $authorId) {
            $bookAuthor = new BookAuthor([
                'book_id' => $book->id,
                'author_id' => $authorId
            ]);

            $bookAuthor->save();
        }

        return $book;
    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getOne($id)
    {
        return Book::with('authors')->findOrFail($id);
    }

    public function getAll($pagination = null)
    {
        if ($pagination) {
            return Book::with('authors')->paginate($pagination);
        }

        return Book::with('authors')->get();
    }

    public function search($keyword)
    {
        return Book::with('authors')
            ->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhere('publication_year', 'like', '%' . $keyword . '%')
            ->orWhereHas('authors', function ($query) use ($keyword) {
                $query->where('first_name', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);
    }
}










