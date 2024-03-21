<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{

    public function create($request)
    {
        $newAuthor = new Author($request->validated());
        return $newAuthor->save();
    }

    public function update($request, $id)
    {
        $author = $this->getOne($id);
        return $author->update($request->validated());
    }

    public function delete($id)
    {
        return $this->getOne($id)->delete();
    }

    public function getOne($id)
    {
        return Author::findOrFail($id);
    }

    public function getAll()
    {
        return Author::all();
    }

}










