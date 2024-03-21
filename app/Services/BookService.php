<?php

namespace App\Services;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\BookAuthor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BookService
 *
 * A service class providing methods for managing books in the application.
 *
 * @package App\Services
 */
class BookService
{
    /**
     * Create a new book.
     *
     * @param CreateBookRequest $request
     * @return Book
     */
    public function create(CreateBookRequest $request): Book
    {
        $newBook = new Book($request->validated());
        $newBook->save();

        foreach ($request->authors as $authorId) {
            $bookAuthor = new BookAuthor([
                'book_id' => $newBook->id,
                'author_id' => $authorId
            ]);

            $bookAuthor->save();
        }


        return $newBook;
    }

    /**
     * Update an existing book.
     *
     * @param CreateBookRequest $request
     * @param int $id
     * @return Book
     */
    public function update(CreateBookRequest $request, int $id): Book
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

        $book->save();

        return $book;
    }

    /**
     * Delete a book.
     *
     * @param int $id
     * @return Book
     */
    public function delete(int $id): Book
    {
        $bookToDelete = $this->getOne($id);
        $bookToDelete->delete();
        return $bookToDelete;
    }

    /**
     * Get a single book by ID.
     *
     * @param int $id
     * @return Book
     */
    public function getOne(int $id): Book
    {
        return Book::with('authors')->findOrFail($id);
    }

    /**
     * Get all books.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Book::with('authors')->get();
    }

    /**
     * Get all books with pagination.
     *
     * @param int $pagination
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination(int $pagination): LengthAwarePaginator
    {
        return Book::with('authors')->paginate($pagination);
    }

    /**
     * Search books by keyword.
     *
     * @param string $keyword
     * @return LengthAwarePaginator
     */
    public function search(string $keyword): LengthAwarePaginator
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
