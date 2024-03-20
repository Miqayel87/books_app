<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('authors')->paginate(10);
        $authors = Author::all();
        return view('books.index', compact('books', 'authors'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(CreateBookRequest $request)
    {
        $newBook = Book::create($request->validated());

        foreach ($request->authors as $authorId) {
            BookAuthor::create([
                'book_id' => $newBook->id,
                'author_id' => $authorId
            ]);
        }

        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(CreateBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());

        BookAuthor::where('book_id', $book->id)->delete();

        foreach ($request->authors as $authorId) {
            BookAuthor::create([
                'book_id' => $book->id,
                'author_id' => $authorId
            ]);
        }

        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = Book::with('authors')->findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function search(Request $request)
    {
        $books = Book::with('authors')
            ->where('title', 'like', '%' . $request->keyword . '%')
            ->orWhere('description', 'like', '%' . $request->keyword . '%')
            ->orWhere('publication_year', 'like', '%' . $request->keyword . '%')
            ->orWhereHas('authors', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->keyword . '%');
            })
            ->paginate(10);

        $authors = Author::all();
        return view('books.index', compact('books', 'authors'));
    }
}
