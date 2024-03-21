<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAll(10);
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
        $this->bookService->create($request);
        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        $book = $this->bookService->getOne($id);
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(CreateBookRequest $request, $id)
    {
        $this->bookService->update($request, $id);
        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $this->bookService->delete($id);
        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = $this->bookService->getOne($id);
        return view('books.show', compact('book'));
    }

    public function search(Request $request)
    {
        $books = $this->bookService->search($request->keyword);
        $authors = Author::all();
        return view('books.index', compact('books', 'authors'));
    }
}
