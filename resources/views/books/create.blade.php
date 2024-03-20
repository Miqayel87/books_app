@extends('layouts.app')

@section('title', 'Create Book')

@section('content')
    <div class="block_container">

        <h2>Create Book</h2>
        <form action="{{ route('books.store') }}" method="POST">
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
    </div>
    <script>
        $("#authors_count").on('keyup', () => {
            $("#authors_select_container").empty();
            for (i = 0; i < $("#authors_count").val(); i++) {
                $('#authors_select_container').append(
                    '<select name="authors[]">@foreach ($authors as $author)<option value="{{ $author->id }}">{{ $author->first_name }}</option>@endforeach()</select>'
                );
            }
        })
    </script>

@endsection
