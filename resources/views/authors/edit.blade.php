@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
    <div class="block_container">
    <div class="edit_form_wrapper" id="editFormWrapper{{$author->id}}">
        <div class="edit_form_container">
            <div>
                <form id="editForm" action="{{route('authors.update', $author->id)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <input name="first_name" type="text" placeholder="first_name" value="{{$author->first_name}}">
                    <input name="last_name" type="text" placeholder="last_name"
                           value="{{$author->last_name}}">
                    <input name="biography" type="text"  placeholder="publication_year"
                           value="{{$author->biography}}">

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
