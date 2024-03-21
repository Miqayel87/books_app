<?php

namespace App\Services;

use App\Http\Requests\CreateAuthorRequest;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AuthorService
 *
 * A service class providing methods for managing authors in the application.
 *
 * @package App\Services
 */
class AuthorService
{
    /**
     * Create a new author.
     *
     * @param CreateAuthorRequest $request
     * @return Author
     */
    public function create(CreateAuthorRequest $request): Author
    {
        $newAuthor = new Author($request->validated());
        $newAuthor->save();
        return $newAuthor;
    }

    /**
     * Update an existing author.
     *
     * @param CreateAuthorRequest $request
     * @param int $id
     * @return Author
     */
    public function update(CreateAuthorRequest $request, int $id): Author
    {
        $author = $this->getOne($id);
        $author->update($request->validated());
        return $author;
    }

    /**
     * Delete an author.
     *
     * @param int $id
     * @return Author
     */
    public function delete(int $id): Author
    {
        $authorToDelete = $this->getOne($id);
        $authorToDelete->delete();
        return $authorToDelete;
    }

    /**
     * Get a single author by ID.
     *
     * @param int $id
     * @return Author
     */
    public function getOne(int $id): Author
    {
        return Author::findOrFail($id);
    }

    /**
     * Get all authors.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Author::all();
    }
}
