@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Create Book</h2>
        <form action="{{ route('book.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input required type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea required name="description" id="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="publication_year">Publication Year:</label>
                <input required type="number" name="publication_year" id="publication_year" class="form-control">
            </div>
            <div class="form-group">
                <label for="authors_count">Authors Count:</label>
                <input required min="1" type="number" name="authors_count" id="authors_count" class="form-control">
            </div>
            <div style="margin-bottom: 20px" id="authors_select_container" class="authors_select_container">

            </div>

            <button type="submit" class="btn btn-primary">Create</button>

        </form>
     


        <div style="margin-top: 50px">
            <h2>Books</h2>
            <div>
                <form action='{{ route('book.search') }}' method="POST">
                    <input name="keyword" type="text" placeholder="search" id="searchInput">
                    <button type="submit">Search</button>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Publication Year</th>
                        <th>Authors</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>
                                @foreach ($book->authors as $author)
                                    <div>{{ $author->first_name }}</div>
                                @endforeach
                            </td>
                            <td>
                                <button onclick="showEditForm({{ $book->id }})" class="action_button edit">Edit</button>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('book.delete', $book->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action_button delete" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <div class="edit_form_wrapper" id="editFormWrapper{{ $book->id }}">
                            <div class="edit_form_container">
                                <div>
                                    <form id="editForm" action="{{ route('book.update', $book->id) }}" method="POST">
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
                                                    style="background-color: red; height: 100%">x</button>
                                            </div>
                                        @endforeach
                                        <button type="submit">Save</button>
                                        <button onclick="showEditForm({{ $book->id }})" type="button">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            {{ $books->links('pagination::bootstrap-4') }}
        </div>

    </div>

    <script>
        const showEditForm = (id) => {
            $('#editFormWrapper' + id).toggle();
        }

        $("#authors_count").on('keyup', () => {
            $("#authors_select_container").empty();
            for (i = 0; i < $("#authors_count").val(); i++) {
                $('#authors_select_container').append(
                    '<select name="authors[]">@foreach ($authors as $author)<option value="{{ $author->id }}">{{ $author->first_name }}</option>@endforeach()</select>'
                );
            }
        })

        {{-- function addAuthorForEdit(id){ --}}
        {{--    console.log($("#" + id)) --}}
        {{--    $("#" + id).append( --}}
        {{--        '<select name="newAuthors[]">@foreach ($authors as $author)<option value="{{$author->id}}">{{$author->first_name}}</option>@endforeach()</select>' --}}
        {{--    ) --}}
        {{-- } --}}

        function deleteBookAuthor(id) {
            console.log(id)
            $("#" + id).remove();
        }

        function search(e) {
            console.log('dksadklas');
        }
    </script>

@endsection
