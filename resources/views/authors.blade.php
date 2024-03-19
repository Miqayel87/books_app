@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Add Author</h2>
        <form action="{{route('author.create')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <textarea name="last_name" id="last_name" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea name="biography" id="biography" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>

        <div style="margin-top: 50px">
            <h2>Books</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Biography</th>
                    <th colspan="2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{$author->id}}</td>
                        <td>{{$author->first_name}}</td>
                        <td>{{$author->last_name}}</td>
                        <td>{{$author->biography}}</td>
                        <td>
                            <button onclick="showEditForm({{$author->id}})" class="action_button edit">Edit</button>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('author.delete', $author->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="action_button delete" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <div class="edit_form_wrapper" id="editFormWrapper{{$author->id}}">
                        <div class="edit_form_container">
                            <div>
                                <form id="editForm" action="{{route('author.update', $author->id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <input name="first_name" type="text" placeholder="first_name" value="{{$author->first_name}}">
                                    <input name="last_name" type="text" placeholder="last_name"
                                           value="{{$author->last_name}}">
                                    <input name="biography"  placeholder="publication_year"
                                              value="{{$author->biography}}">

                                    <button type="submit">Save</button>
                                    <button onclick="showEditForm({{$author->id}})" type="button">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
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

        function deleteBookAuthor(id){
            console.log(id)
            $("#" + id).remove();
        }

    </script>

@endsection
