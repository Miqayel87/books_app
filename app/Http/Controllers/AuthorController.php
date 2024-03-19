<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\CreateBookRequest;
use App\Models\author;
use App\Models\book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $authors = Author::all();
        return view('authors', ['authors'=>$authors]);
    }

    public function create(CreateAuthorRequest $request){
        $newAuthor = new Author;

        $newAuthor->first_name = $request->first_name;
        $newAuthor->last_name = $request->last_name;
        $newAuthor->biography = $request->biography;

        $newAuthor->save();

        return redirect()->back();
    }

    public function update($id, CreateAuthorRequest $request){
        $authorToUpdate = Author::where('id', $id)->first();

        $authorToUpdate->first_name = $request->first_name;
        $authorToUpdate->last_name = $request->last_name;
        $authorToUpdate->biography = $request->biography;

        $authorToUpdate->save();

        return redirect()->back();
    }

    public function delete($id){
        Author::where('id', $id)->delete();
        return redirect()->back();
    }
}
