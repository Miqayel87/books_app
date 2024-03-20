<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(CreateAuthorRequest $request)
    {
        Author::create($request->validated());
        return redirect()->route('authors.index');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(CreateAuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->validated());
        return redirect()->route('authors.index');
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();
        return redirect()->route('authors.index');
    }
}
