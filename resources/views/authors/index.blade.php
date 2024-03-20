@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    <div class="container">


        <div style="margin-top: 50px">
            <h2>Authors</h2>
            @if(auth()->user() && auth()->user()->admin)
                <div class="create_button_container">
                    <a href="{{route('authors.create')}}">
                        <button class="action_button create">Create</button>
                    </a>
                </div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Biography</th>
                    @if(auth()->user() && auth()->user()->admin)
                        <th colspan="2">Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{$author->id}}</td>
                        <td>{{$author->first_name}}</td>
                        <td>{{$author->last_name}}</td>
                        <td>{{$author->biography}}</td>
                        @if(auth()->user() && auth()->user()->admin)
                            <td>
                                <a href="{{route('authors.edit', $author->id)}}">
                                    <button onclick="showEditForm({{$author->id}})" class="action_button edit">Edit
                                    </button>
                                </a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('authors.destroy', $author->id) }}">
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
                    '<select name="authors[]">@foreach($authors as $author)<option value="{{$author->id}}">{{$author->first_name}}</option>@endforeach()</select>'
                );
            }
        })

        {{--function addAuthorForEdit(id){--}}
        {{--    console.log($("#" + id))--}}
        {{--    $("#" + id).append(--}}
        {{--        '<select name="newAuthors[]">@foreach($authors as $author)<option value="{{$author->id}}">{{$author->first_name}}</option>@endforeach()</select>'--}}
        {{--    )--}}
        {{--}--}}

        function deleteBookAuthor(id) {
            console.log(id)
            $("#" + id).remove();
        }

    </script>

@endsection
