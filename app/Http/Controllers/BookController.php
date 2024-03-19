<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\author;
use App\Models\book;
use App\Models\BookAuthor;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::with('authors')->paginate(10);
        $authors = Author::all();
        return view('books', ['books' => $books, 'authors'=>$authors]);
    }

    public function create(CreateBookRequest $request){
        $newBook = new Book;

        $newBook->title = $request->title;
        $newBook->description = $request->description;
        $newBook->publication_year = $request->publication_year;

        $newBook->save();


        foreach ($request->authors as $authorId){
            $newBookAuthor = new BookAuthor;

            $newBookAuthor->book_id = $newBook->id;
            $newBookAuthor->author_id = $authorId;

            $newBookAuthor->save();
        }


        return redirect()->back();
    }

    public function update($id, CreateBookRequest $request){
        $bookToUpdate = Book::where('id', $id)->first();
        $bookToUpdate->title = $request->title;
        $bookToUpdate->description = $request->description;
        $bookToUpdate->publication_year = $request->publication_year;

        $bookToUpdate->save();

        BookAuthor::where('book_id', $bookToUpdate->id)->delete();

        foreach ($request->authors as $authorId){
            $newBookAuthor = new BookAuthor;

            $newBookAuthor->book_id = $bookToUpdate->id;
            $newBookAuthor->author_id = $authorId;

            $newBookAuthor->save();
        }

        return redirect()->back();
    }

    public function delete($id){
        Book::where('id', $id)->delete();
        return redirect()->back();
    }

    public function search(Request $request){
        $books = Book::with('authors')->where('title', 'like', '%'.$request->keyword.'%')->paginate(10);
        $authors = Author::all();
        return view('books', ['books' => $books, 'authors'=>$authors]);
    }
}
