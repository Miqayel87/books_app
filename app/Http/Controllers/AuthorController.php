<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->getAll();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(CreateAuthorRequest $request)
    {
        $this->authorService->create($request);
        return redirect()->route('authors.index');
    }

    public function edit($id)
    {
        $author = $this->authorService->getOne($id);
        return view('authors.edit', compact('author'));
    }

    public function update(CreateAuthorRequest $request, $id)
    {
        $this->authorService->update($request, $id);
        return redirect()->route('authors.index');
    }

    public function destroy($id)
    {
        $this->authorService->delete($id);
        return redirect()->route('authors.index');
    }
}
