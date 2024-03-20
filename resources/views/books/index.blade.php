@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="container">


        <div style="margin-top: 50px">
            <h2>Books</h2>
            @if(auth()->user() && auth()->user()->admin)
                <div class="create_button_container">
                    <a href="{{route('books.create')}}">
                        <button class="action_button create">Create</button>
                    </a>
                </div>
            @endif
            <div class="search_container">
                <form action='{{ route('book.search') }}' method="GET">
                    <input class="search_input" name="keyword" type="text" placeholder="search" id="searchInput">
                    <button class="search_button" type="submit">Search</button>
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
                    @if(auth()->user() && auth()->user()->admin)
                        <th colspan="2">Actions</th>
                    @endif
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
                        @if(auth()->user() && auth()->user()->admin)
                            <td>
                                <a href="{{ route('books.edit', $book->id) }}">
                                    <button class="action_button edit">Edit</button>
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('books.destroy', $book->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action_button delete" type="submit">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>

                @endforeach
                </tbody>
            </table>

            {{ $books->links('pagination::bootstrap-4') }}
        </div>

    </div>

    <script>
        function search(e) {
            console.log('dksadklas');
        }
    </script>

@endsection
