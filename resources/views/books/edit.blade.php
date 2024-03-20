@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
    <div class="block_container">
        <div class="edit_form_wrapper" id="editFormWrapper{{ $book->id }}">
            <div class="edit_form_container">
                <div>
                    <h2>Edit book {{$book->id}}</h2>
                    <form id="editForm" action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input name="title" type="text" placeholder="title"
                               value="{{ $book->title }}">
                        <input name="description" type="text" placeholder="description"
                               value="{{ $book->description }}">
                        <input name="publication_year" type="number" placeholder="publication_year"
                               value="{{ $book->publication_year }}">
                        @foreach ($book->authors as $author)
                            <div class="book_author_container"
                                 id="{{ 'authorBook' . $author->id . '_' . $book->id }}">
                                {{ $author->first_name }}
                                <input hidden="" value="{{ $author->id }}" type="text"
                                       name="authors[]">
                                <button type="button"
                                        onclick="deleteBookAuthor('{{ 'authorBook' . $author->id . '_' . $book->id }}')"
                                        style="background-color: red; height: 100%">x
                                </button>
                            </div>
                        @endforeach
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteBookAuthor(id) {
            console.log(id)
            $("#" + id).remove();
        }
    </script>
@endsection
